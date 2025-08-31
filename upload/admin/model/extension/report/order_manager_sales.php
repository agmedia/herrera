<?php
class ModelExtensionReportOrderManagerSales extends Model {

    /** Aggregated per-manager rows for the top table (now includes sessions count) */
    public function getOrderSalesByManager($data = []) {
        $managers = \Agmedia\Models\User::query()->where('user_group_id', agconf('salesman_id'));

        if (!empty($data['filter_manager'])) {
            $managers->where('user_id', (int)$data['filter_manager']);
        }

        $managers = $managers->get();
        $result   = [];

        // Boundaries for session counting
        $ds = $data['filter_date_start'] ?? date('Y-m-01');
        $de = $data['filter_date_end']   ?? date('Y-m-d');
        $start_dt = $this->db->escape($ds . ' 00:00:00');
        $end_dt   = $this->db->escape($de . ' 23:59:59');

        foreach ($managers as $manager) {
            $customers = \Agmedia\Models\Customer\CustomerToUser::query()
                                                                ->where('user_id', $manager->user_id)->pluck('customer_id');

            $orders = \Agmedia\Models\Order\Order::query()->whereIn('customer_id', $customers);

            if (!empty($data['filter_order_status_id'])) {
                $orders->where('order_status_id', (int)$data['filter_order_status_id']);
            } else {
                $orders->where('order_status_id', '>', 0);
            }

            if (!empty($data['filter_date_start'])) $orders->where('date_added', '>=', $data['filter_date_start']);
            if (!empty($data['filter_date_end']))   $orders->where('date_added', '<=', $data['filter_date_end']);

            $products = 0; $tax = 0; $total = 0;

            foreach ($orders->get() as $order) {
                $products += $order->products->count();
                $tax_row   = $order->totals()->where('code', 'tax')->first();
                $tax      += $tax_row ? (float)$tax_row->value : 0;
                $total    += (float)$order->total;
            }

            // NEW: count sessions for this manager (overlap logic)
            $sessions_count = (int)$this->db->query("
                SELECT COUNT(*) AS c
                FROM `" . DB_PREFIX . "impersonation_session` s
                WHERE s.admin_id = " . (int)$manager->user_id . "
                  AND s.started_at <= '{$end_dt}'
                  AND COALESCE(s.ended_at, s.last_activity_at) >= '{$start_dt}'
            ")->row['c'];

            $result[] = [
                'manager'    => $manager->firstname . ' ' . $manager->lastname,
                'date_start' => $data['filter_date_start'],
                'date_end'   => $data['filter_date_end'],
                'orders'     => $orders->count(),
                'products'   => $products,
                'tax'        => $tax,
                'total'      => $total,
                'sessions'   => $sessions_count
            ];
        }

        return $result;
    }

    /** Detailed per-customer list for one manager (existing section) */
    public function getOrderSalesFromManager($data = []) {
        $customers_ids = \Agmedia\Models\Customer\CustomerToUser::query()
                                                                ->where('user_id', (int)$data['filter_manager'])->pluck('customer_id');

        $customers = \Agmedia\Models\Customer\Customer::query()
                                                      ->whereIn('customer_id', $customers_ids)->get();

        $orders  = \Agmedia\Models\Order\Order::query()->whereIn('customer_id', $customers_ids);
        $reports = \Agmedia\Api\Models\OC_OrderManagerSales::query()->where('user_id', (int)$data['filter_manager']);

        if (!empty($data['filter_order_status_id'])) {
            $orders->where('order_status_id', (int)$data['filter_order_status_id']);
        } else {
            $orders->where('order_status_id', '>', 0);
        }

        if (!empty($data['filter_date_start'])) {
            $orders->where('date_added', '>=', $data['filter_date_start']);
            $reports->where('date_added', '>=', $data['filter_date_start']);
        }
        if (!empty($data['filter_date_end'])) {
            $orders->where('date_added', '<=', $data['filter_date_end']);
            $reports->where('date_added', '<=', $data['filter_date_end']);
        }

        $result = [];

        foreach ($orders->get() as $order) {
            $customer = $customers->where('customer_id', $order->customer_id)->first();
            $report   = $reports->where('order_id', $order->order_id)->first();

            if ($customer) {
                $manager_made = date('d.m.Y', strtotime($order->date_added));
                if ($report) {
                    $manager_made = date('d.m.Y', strtotime($report->start)) .
                                    '... Prijava: ' . date('H:i', strtotime($report->start)) .
                                    ' - Odjava: ' . date('H:i', strtotime($report->end));
                }

                $products = $order->products->count();
                $tax_row  = $order->totals()->where('code', 'tax')->first();
                $tax      = $tax_row ? (float)$tax_row->value : 0;

                $result[] = [
                    'customer' => $customer->firstname . ' ' . $customer->lastname,
                    'manager'  => $manager_made,
                    'products' => $products,
                    'tax'      => $this->currency->format($tax, $this->config->get('config_currency')),
                    'total'    => $this->currency->format($order->total, $this->config->get('config_currency'))
                ];
            }
        }

        return $result;
    }

    /** Sessions for selected manager (IDs match impersonation_event.impersonation_session_id) */
    public function getManagerSessions($data = []) {
        $manager_id = (int)($data['filter_manager'] ?? 0);
        if (!$manager_id) return [];

        // filter window
        $ds = $data['filter_date_start'] ?? date('Y-m-01');
        $de = $data['filter_date_end']   ?? date('Y-m-d');
        $start_dt_sql = "'" . $this->db->escape($ds . ' 00:00:00') . "'";
        $end_dt_sql   = "'" . $this->db->escape($de . ' 23:59:59') . "'";

        $t_s   = DB_PREFIX . 'impersonation_session';
        $t_e   = DB_PREFIX . 'impersonation_event';
        $t_oms = DB_PREFIX . 'order_manager_sales';
        $t_ord = DB_PREFIX . 'order';

        // end expression (handles open sessions)
        $endExpr = 'COALESCE(s.ended_at, s.last_activity_at)';

        $sql = "
      SELECT
        s.id,
        s.started_at AS start_time,
        {$endExpr}    AS end_time,
        GREATEST(0, TIMESTAMPDIFF(MINUTE, s.started_at, {$endExpr})) AS duration_minutes,

        /* 1) Primary: order made during this session (using oc_order.date_added) */
        (
          SELECT o.order_id
          FROM `{$t_ord}` o
          JOIN `{$t_oms}` oms ON oms.order_id = o.order_id
          WHERE oms.user_id = {$manager_id}
            AND oms.customer_id = s.customer_id
            AND o.date_added BETWEEN s.started_at AND {$endExpr}
          ORDER BY o.date_added ASC
          LIMIT 1
        ) AS order_id

      FROM `{$t_s}` s
      WHERE
        (
          s.admin_id = {$manager_id}
          /* Optional legacy: include sessions without admin_id if tied to this manager via OMS in the same window */
          OR (
            s.admin_id = 0 AND EXISTS (
              SELECT 1
              FROM `{$t_oms}` oms2
              WHERE oms2.user_id = {$manager_id}
                AND oms2.customer_id = s.customer_id
                /* Accept either oc_order.date_added (via exists) or OMS window overlap as a fallback */
                AND (
                  /* Fallback to OMS string window if present (cast safely) */
                  (
                    STR_TO_DATE(oms2.start, '%Y-%m-%d %H:%i:%s') <= {$endExpr}
                    AND STR_TO_DATE(oms2.end,   '%Y-%m-%d %H:%i:%s') >= s.started_at
                  )
                  OR oms2.date_added BETWEEN s.started_at AND {$endExpr}
                )
            )
          )
        )
        /* session overlaps filter window */
        AND s.started_at <= {$end_dt_sql}
        AND {$endExpr}   >= {$start_dt_sql}
      ORDER BY s.started_at ASC
    ";

        $rows = $this->db->query($sql)->rows ?: [];

        foreach ($rows as &$r) {
            $r['id']               = (int)$r['id'];
            $r['duration_minutes'] = (int)$r['duration_minutes'];
            $r['order_id']         = isset($r['order_id']) && $r['order_id'] !== '' ? (int)$r['order_id'] : null;
            // keys expected by JS
            $r['start'] = $r['start_time'];
            $r['end']   = $r['end_time'];
            unset($r['start_time'], $r['end_time']);
        }
        return $rows;
    }




    /** Summary + top clicked entities for a session */
    public function getSessionEventStats(int $session_id, int $language_id): array {
        $session_id  = (int)$session_id;
        $language_id = (int)$language_id;

        $summary = $this->db->query("
            SELECT COALESCE(entity_type,'page') AS entity_type, COUNT(*) AS clicks
            FROM `" . DB_PREFIX . "impersonation_event`
            WHERE impersonation_session_id = {$session_id}
            GROUP BY entity_type
            ORDER BY clicks DESC
        ")->rows ?: [];

        $products = $this->db->query("
            SELECT e.entity_id AS product_id, COUNT(*) AS clicks, pd.name
            FROM `" . DB_PREFIX . "impersonation_event` e
            JOIN `" . DB_PREFIX . "product_description` pd
              ON pd.product_id = e.entity_id AND pd.language_id = {$language_id}
            WHERE e.impersonation_session_id = {$session_id}
              AND e.entity_type = 'product'
            GROUP BY e.entity_id, pd.name
            ORDER BY clicks DESC
            LIMIT 10
        ")->rows;

        $categories = $this->db->query("
            SELECT e.entity_id AS category_id, COUNT(*) AS clicks, cd.name
            FROM `" . DB_PREFIX . "impersonation_event` e
            JOIN `" . DB_PREFIX . "category_description` cd
              ON cd.category_id = e.entity_id AND cd.language_id = {$language_id}
            WHERE e.impersonation_session_id = {$session_id}
              AND e.entity_type = 'category'
            GROUP BY e.entity_id, cd.name
            ORDER BY clicks DESC
            LIMIT 10
        ")->rows;

        $manufacturers = $this->db->query("
            SELECT e.entity_id AS manufacturer_id, COUNT(*) AS clicks, m.name
            FROM `" . DB_PREFIX . "impersonation_event` e
            JOIN `" . DB_PREFIX . "manufacturer` m
              ON m.manufacturer_id = e.entity_id
            WHERE e.impersonation_session_id = {$session_id}
              AND e.entity_type = 'manufacturer'
            GROUP BY e.entity_id, m.name
            ORDER BY clicks DESC
            LIMIT 10
        ")->rows;

        $information = $this->db->query("
            SELECT e.entity_id AS information_id, COUNT(*) AS clicks, id.title
            FROM `" . DB_PREFIX . "impersonation_event` e
            JOIN `" . DB_PREFIX . "information_description` id
              ON id.information_id = e.entity_id AND id.language_id = {$language_id}
            WHERE e.impersonation_session_id = {$session_id}
              AND e.entity_type = 'information'
            GROUP BY e.entity_id, id.title
            ORDER BY clicks DESC
            LIMIT 10
        ")->rows;

        return [
            'summary'       => $summary,
            'products'      => $products,
            'categories'    => $categories,
            'manufacturers' => $manufacturers,
            'information'   => $information,
        ];
    }

    /** Timeline series (per minute) of clicks by entity_type for a session */
    public function getSessionEventTimeline(int $session_id): array {
        $session_id = (int)$session_id;

        $rows = $this->db->query("
            SELECT
              DATE_FORMAT(occurred_at, '%Y-%m-%d %H:%i:00') AS ts,
              COALESCE(entity_type,'page') AS entity_type,
              COUNT(*) AS clicks
            FROM `" . DB_PREFIX . "impersonation_event`
            WHERE impersonation_session_id = {$session_id}
            GROUP BY ts, entity_type
            ORDER BY ts ASC
        ")->rows ?: [];

        return $rows; // controller will transform to labels + series
    }


    public function getSessionInfo(int $session_id): array {
        $session_id = (int)$session_id;

        $row = $this->db->query("
        SELECT
            s.id,
            s.session_id,
            s.admin_id,
            s.customer_id,
            s.store_id,
            s.store_host,
            s.admin_from_url,
            s.user_agent,
            s.started_at,
            s.last_activity_at,
            s.ended_at,
            s.duration_seconds,
            HEX(s.ip) AS ip_hex,
            COALESCE(s.ended_at, s.last_activity_at) AS end_time,
            (
                SELECT COUNT(*) FROM `" . DB_PREFIX . "impersonation_event` e
                WHERE e.impersonation_session_id = s.id
            ) AS event_count,
            (
                SELECT oms.order_id
                FROM `" . DB_PREFIX . "order_manager_sales` oms
                WHERE oms.user_id = s.admin_id
                  AND oms.customer_id = s.customer_id
                  AND oms.date_added BETWEEN s.started_at AND COALESCE(s.ended_at, s.last_activity_at)
                ORDER BY oms.date_added ASC
                LIMIT 1
            ) AS order_id
        FROM `" . DB_PREFIX . "impersonation_session` s
        WHERE s.id = {$session_id}
        LIMIT 1
    ")->row;

        if (!$row) return [];

        // IP decode (HEX -> binary -> text)
        $ip = null;
        if (!empty($row['ip_hex']) && ctype_xdigit($row['ip_hex'])) {
            $bin = @pack('H*', $row['ip_hex']);
            $ip  = $bin ? @inet_ntop($bin) : null;
        }

        $geo = $this->geoipLookup($ip);

        // Duration (minutes) – prefer stored seconds if available
        $end = $row['end_time'];
        if (!empty($row['duration_seconds'])) {
            $dur_minutes = (int)round(((int)$row['duration_seconds']) / 60);
        } else {
            $start_ts = strtotime($row['started_at']);
            $end_ts   = strtotime($end ?: $row['last_activity_at']);
            $dur_minutes = max(0, (int)round(($end_ts - $start_ts) / 60));
        }

        return [
            'id'               => (int)$row['id'],
            'admin_id'         => (int)$row['admin_id'],
            'customer_id'      => (int)$row['customer_id'],
            'store_id'         => (int)$row['store_id'],
            'store_host'       => $row['store_host'],
            'admin_from_url'   => $row['admin_from_url'],
            'user_agent'       => $row['user_agent'],
            'started_at'       => $row['started_at'],
            'ended_at'         => $row['ended_at'],
            'last_activity_at' => $row['last_activity_at'],
            'end_time'         => $end,
            'duration_minutes' => $dur_minutes,
            'event_count'      => (int)$row['event_count'],
            'order_id'         => !empty($row['order_id']) ? (int)$row['order_id'] : null,
            'ip'   => $ip,
            'geo'  => $geo
        ];
    }


    // --- Helpers ---------------------------------------------------------------
    private function isPublicIp(string $ip): bool {
        // true = public; false = private/reserved/invalid
        return (bool)filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE);
    }

    private function geoipLookup(string $ip_text): array {
        if (!$ip_text || !$this->isPublicIp($ip_text)) {
            return ['city'=>null,'region'=>null,'country'=>null,'country_code'=>null,'lat'=>null,'lon'=>null,'timezone'=>null,'org'=>null,'asn'=>null,'source'=>null];
        }

        $bin = @inet_pton($ip_text);
        $hex = $bin ? bin2hex($bin) : null;

        // 1) cache hit?
        if ($hex) {
            $row = $this->db->query("
            SELECT city, `region`, country_name AS country, country_code, latitude AS lat, longitude AS lon, timezone, org, asn, source
            FROM `" . DB_PREFIX . "impersonation_session_geoip_cache`
            WHERE ip = 0x{$hex}
        ")->row;
            if ($row) return $row;
        }

        // 2) live lookup (HTTPS, free, no key)
        // ipapi.co: ~1000/day free without signup; city/region/country/lat/lon over HTTPS
        // docs & limits: https://ipapi.co/free/
        $url = "https://ipapi.co/" . rawurlencode($ip_text) . "/json/";
        $ch  = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 2,
            CURLOPT_TIMEOUT        => 3,
            CURLOPT_USERAGENT      => 'AG-OC3-GeoIP/1.0'
        ]);
        $resp = curl_exec($ch);
        $http = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $city = $region = $country = $cc = $tz = $org = $asn = null; $lat = $lon = null;
        if ($http === 200 && $resp) {
            $j = json_decode($resp, true) ?: [];
            // ipapi.co fields
            $city    = $j['city']      ?? null;
            $region  = $j['region']    ?? null;
            $country = $j['country_name'] ?? null;
            $cc      = $j['country']   ?? null;
            $lat     = isset($j['latitude'])  ? (float)$j['latitude']  : null;
            $lon     = isset($j['longitude']) ? (float)$j['longitude'] : null;
            $tz      = $j['timezone'] ?? null;
            $org     = $j['org']      ?? ($j['org_name'] ?? null);
            $asn     = $j['asn']      ?? null;
        }

        // optional fallback (commented). Alternatives:
        //  - IPinfo (free, token, country-level unlimited): https://ipinfo.io/faq  (more data on paid)  :contentReference[oaicite:0]{index=0}
        //  - IP2Location: 50k/mo with key; 1k/day keyless: https://www.ip2location.io/pricing  :contentReference[oaicite:1]{index=1}
        //  - ip-api.com free 45 rpm, HTTP only, non-commercial: https://members.ip-api.com/signup/  :contentReference[oaicite:2]{index=2}
        //  - ipapi.co free 1k/day over HTTPS, no signup: https://ipapi.co/free/  :contentReference[oaicite:3]{index=3}

        $out = [
            'city' => $city, 'region' => $region, 'country' => $country, 'country_code' => $cc,
            'lat'  => $lat,  'lon'    => $lon,    'timezone'=> $tz,      'org'          => $org, 'asn'=> $asn,
            'source'=> 'ipapi.co'
        ];

        // 3) upsert cache
        if ($hex) {
            $this->db->query("REPLACE INTO `" . DB_PREFIX . "impersonation_session_geoip_cache`
            (ip, ip_text, country_code, country_name, `region`, city, latitude, longitude, timezone, org, asn, source, created_at, updated_at)
            VALUES (
              0x{$hex}, '" . $this->db->escape($ip_text) . "',
              " . ($cc ? "'" . $this->db->escape($cc) . "'" : "NULL") . ",
              " . ($country ? "'" . $this->db->escape($country) . "'" : "NULL") . ",
              " . ($region ? "'" . $this->db->escape($region) . "'" : "NULL") . ",
              " . ($city ? "'" . $this->db->escape($city) . "'" : "NULL") . ",
              " . ($lat !== null ? "'" . $this->db->escape((string)$lat) . "'" : "NULL") . ",
              " . ($lon !== null ? "'" . $this->db->escape((string)$lon) . "'" : "NULL") . ",
              " . ($tz ? "'" . $this->db->escape($tz) . "'" : "NULL") . ",
              " . ($org ? "'" . $this->db->escape($org) . "'" : "NULL") . ",
              " . ($asn ? "'" . $this->db->escape($asn) . "'" : "NULL") . ",
              'ipapi.co', NOW(), NOW()
            )");
        }

        return $out;
    }

}
