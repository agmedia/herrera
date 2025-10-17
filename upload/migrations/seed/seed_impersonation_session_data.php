<?php
/**
 * Seed mock impersonation sessions, events, and OMS rows — with wipes, ranges, and geo cache.
 *
 * Usage (defaults wipe=all, 20 min, ~30 clicks):
 *   php upload/migrations/seed/seed_impersonation_session_data.php --admin_id=12 --customer_id=345 --orders=7047-7059
 *
 * php upload/migrations/seed/seed_impersonation_session_data.php --admin_id=22 --customer_id=636 --orders=7040,7058 --wipe=scoped --session_minutes=30 --clicks=25 --products=8 --categories=6 --brands=3 --product_range=100-2500 --category_range=1-100 --brand_range=1-20
 *
 * php upload/migrations/seed/seed_impersonation_session_data.php \
 * --admin_id=22 --customer_id=636 --orders=7040,7045,7049,7053,7055,7058 \
 * --wipe=scoped --session_minutes=30 --clicks=25 \
 * --products=8 --categories=6 --brands=3 \
 * --product_range=100-2500 --category_range=1-100 --brand_range=1-20
 *
 * Options:
 *   --wipe=all|scoped|none           (default all)
 *   --session_minutes=20             (avg session length; default 20)
 *   --clicks=30                      (approx total events per session; default 30)
 *
 *   --products=5 --categories=3 --brands=2               (# per session)
 *   --product_range=10-1000 --category_range=1-100 --brand_range=1-50
 *
 *   --store_id=0 --store_host=b2b.example.hr --ua="..."
 *   --seed_geoip=1 --geoip_rows=40
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

/* -------- CLI ARGS -------- */
$opts = getopt('', [
    'admin_id:',
    'customer_id:',
    'orders:',

    'wipe::',              // all|scoped|none (default all)
    'session_minutes::',   // default 20
    'clicks::',            // default 30

    // counts per session
    'products::',
    'categories::',
    'brands::',

    // id ranges
    'product_range::',
    'category_range::',
    'brand_range::',

    // store/meta
    'store_id::',
    'store_host::',
    'ua::',

    // geo cache
    'seed_geoip::',
    'geoip_rows::',
]);

if (!isset($opts['admin_id'], $opts['customer_id'], $opts['orders'])) {
    fwrite(STDERR, "Missing required args.\nExample:\n  php upload/cli/seed_impersonation_data.php --admin_id=12 --customer_id=345 --orders=7047-7059\n");
    exit(1);
}

$ADMIN_ID    = (int)$opts['admin_id'];
$CUSTOMER_ID = (int)$opts['customer_id'];
$ORDERS      = parseOrders($opts['orders']);

$WIPE        = strtolower($opts['wipe'] ?? 'all');                // all|scoped|none
$SESS_MIN    = max(5, (int)($opts['session_minutes'] ?? 20));     // >=5
$CLICKS_TGT  = max(6, (int)($opts['clicks'] ?? 30));              // >=6

$PROD_COUNT  = isset($opts['products'])   ? max(0, (int)$opts['products'])   : 5;
$CAT_COUNT   = isset($opts['categories']) ? max(0, (int)$opts['categories']) : 3;
$BRAND_COUNT = isset($opts['brands'])     ? max(0, (int)$opts['brands'])     : 2;

$PROD_RANGE  = parseRange($opts['product_range']  ?? '10-1000', 10, 1000);
$CAT_RANGE   = parseRange($opts['category_range'] ?? '1-100',    1, 100);
$BRAND_RANGE = parseRange($opts['brand_range']    ?? '1-50',     1, 50);

$STORE_ID    = isset($opts['store_id'])   ? (int)$opts['store_id']  : 0;
$STORE_HOST  = isset($opts['store_host']) ? (string)$opts['store_host'] : (php_uname('n') ?: 'localhost');
$UA          = $opts['ua'] ?? randomUA();

$SEED_GEO    = isset($opts['seed_geoip']) ? (int)$opts['seed_geoip'] === 1 : true;
$GEO_ROWS    = isset($opts['geoip_rows']) ? max(10, (int)$opts['geoip_rows']) : 40;

/* -------- OC CONFIG -------- */
$root = realpath(__DIR__ . '/..'); // upload/
$configCandidates = [
    $root . '/config.php',
    dirname($root) . '/config.php',
];
$loaded = false;
foreach ($configCandidates as $cfg) { if (is_file($cfg)) { require_once $cfg; $loaded = true; break; } }
if (!$loaded || !defined('DB_HOSTNAME')) { fwrite(STDERR, "Unable to locate config.php with DB_* constants.\n"); exit(1); }

/* -------- DB -------- */
$mysqli = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
if ($mysqli->connect_error) { fwrite(STDERR, "DB connect failed: {$mysqli->connect_error}\n"); exit(1); }
$mysqli->set_charset('utf8mb4');

$PFX   = defined('DB_PREFIX') ? DB_PREFIX : 'oc_';
$now   = new DateTimeImmutable('now');

/* -------- GEO CACHE (Croatia) -------- */
$geoTable = $PFX . 'impersonation_session_geoip_cache';
if ($SEED_GEO) {
    ensureGeoTable($mysqli, $geoTable);
    $seededIps = seedGeoCacheHR($mysqli, $geoTable, $GEO_ROWS);
} else {
    $seededIps = [];
}

// ---- Normalize options safely (arrays/false/null/strings) ------------------
$wipe_raw = $opts['wipe'] ?? 'all';
// If getopt returns multiple values, take the last one
if (is_array($wipe_raw)) $wipe_raw = end($wipe_raw);
// If option provided without value (for :: optional), getopt() gives false
if ($wipe_raw === false || $wipe_raw === null) $wipe_raw = 'all';

$WIPE = strtolower(trim((string)$wipe_raw));
if (!in_array($WIPE, ['all','scoped','none'], true)) {
    $WIPE = 'all';
}
echo "WIPE mode: {$WIPE}\n";

$STORE_ID_PARAM = isset($opts['store_id']) ? (int)$opts['store_id'] : 0;

/* -------- WIPE TABLES -------- */
switch ($WIPE) {
    case 'all':
        echo "Wiping ALL: {$PFX}impersonation_event, {$PFX}impersonation_session, {$PFX}order_manager_sales\n";
        wipe_all($mysqli, $PFX);
        break;

    case 'scoped':
        echo "Wiping SCOPED rows for admin_id={$ADMIN_ID}, customer_id={$CUSTOMER_ID}\n";
        wipe_scoped($mysqli, $PFX, $ADMIN_ID, $CUSTOMER_ID, $ORDERS);
        break;

    case 'none':
    default:
        echo "Wipe disabled.\n";
}

/* -------- SUMMARY -------- */
echo "Seeding sessions for admin_id={$ADMIN_ID}, customer_id={$CUSTOMER_ID}\n";
echo "Orders: [" . implode(',', $ORDERS) . "]\n";
echo "Target: ~{$SESS_MIN} min session, ~{$CLICKS_TGT} clicks per session\n";
echo "Counts -> products: {$PROD_COUNT}, categories: {$CAT_COUNT}, brands: {$BRAND_COUNT}\n";
echo "Ranges -> product_id: {$PROD_RANGE[0]}-{$PROD_RANGE[1]}, category_id: {$CAT_RANGE[0]}-{$CAT_RANGE[1]}, manufacturer_id: {$BRAND_RANGE[0]}-{$BRAND_RANGE[1]}\n";
if ($SEED_GEO) echo "Geo cache seeded: {$GEO_ROWS} rows (@ {$geoTable})\n";

/* -------- MAIN LOOP -------- */
foreach ($ORDERS as $orderId) {
    $order = fetchOrder($mysqli, $PFX, $orderId);

    // Session centered around order time (or now) with slight jitter
    $center = $order ? new DateTimeImmutable($order['date_added']) : $now;
    $jitterStart = rand(-2, 2); // minutes
    $jitterEnd   = rand(-2, 2);
    $half        = (int)floor($SESS_MIN / 2);

    $start = $center->sub(new DateInterval('PT' . max(5, $half + $jitterStart) . 'M'));
    $end   = $center->add(new DateInterval('PT' . max(5, $SESS_MIN - $half + $jitterEnd) . 'M'));

    // Pick an IP from HR cache (or random)
    $ipStr  = $seededIps ? $seededIps[array_rand($seededIps)] : randomIPv4();
    $ipHex  = bin2hex(inet_pton($ipStr));

    // Insert session
    $sessionId = insertSession(
        $mysqli, $PFX,
        [
            'session_id'     => 'sess_' . bin2hex(random_bytes(16)),
            'admin_id'       => $ADMIN_ID,
            'customer_id'    => $CUSTOMER_ID,
            'store_id' => ($order && isset($order['store_id'])) ? (int)$order['store_id'] : $STORE_ID_PARAM,
            'store_host'     => $STORE_HOST,
            'admin_from_url' => '/admin/index.php?route=customer/customer/edit&customer_id=' . $CUSTOMER_ID,
            'ip_hex'         => $ipHex,
            'user_agent'     => $UA,
            'started_at'     => $start->format('Y-m-d H:i:s'),
            'last_activity'  => $end->format('Y-m-d H:i:s'),
            'ended_at'       => $end->format('Y-m-d H:i:s'),
            'duration_sec'   => max(0, $end->getTimestamp() - $start->getTimestamp()),
        ]
    );

    // Sample IDs within ranges (fallback to full table if sparse)
    $productIds  = sampleIdsInRange($mysqli, "{$PFX}product",      'product_id',      $PROD_RANGE,  $PROD_COUNT);
    if (count($productIds)  < $PROD_COUNT)  { $productIds  = array_unique(array_merge($productIds,  sampleIds($mysqli, "{$PFX}product",      'product_id',      $PROD_COUNT  - count($productIds)))); }

    $categoryIds = sampleIdsInRange($mysqli, "{$PFX}category",     'category_id',     $CAT_RANGE,   $CAT_COUNT);
    if (count($categoryIds) < $CAT_COUNT)   { $categoryIds = array_unique(array_merge($categoryIds, sampleIds($mysqli, "{$PFX}category",     'category_id',     $CAT_COUNT   - count($categoryIds)))); }

    $brandIds    = sampleIdsInRange($mysqli, "{$PFX}manufacturer", 'manufacturer_id', $BRAND_RANGE, $BRAND_COUNT);
    if (count($brandIds)    < $BRAND_COUNT) { $brandIds    = array_unique(array_merge($brandIds,    sampleIds($mysqli, "{$PFX}manufacturer", 'manufacturer_id', $BRAND_COUNT - count($brandIds)))); }

    // Seed events to hit ~CLICKS_TGT over the session window
    seedEventsApproximately(
        $mysqli, $PFX, $sessionId,
        $start, $end,
        $productIds, $categoryIds, $brandIds,
        $orderId,
        $CLICKS_TGT
    );

    // OMS row
    $omsId = nextOmsId($mysqli, "{$PFX}order_manager_sales");
    insertOMS($mysqli, $PFX, [
        'id'          => $omsId,
        'start'       => $start->format('Y-m-d H:i:s'),
        'end'         => $end->format('Y-m-d H:i:s'),
        'napomena'    => "Seeded by CLI for order {$orderId}",
        'user_id'     => $ADMIN_ID,
        'customer_id' => $CUSTOMER_ID,
        'order_id'    => (int)$orderId,
        'added'       => $now->format('Y-m-d H:i:s'),
        'modified'    => $now->format('Y-m-d H:i:s'),
    ]);

    echo "✔ Session #{$sessionId} (~{$SESS_MIN}m, ~{$CLICKS_TGT} clicks) → OMS #{$omsId} for order {$orderId} (IP {$ipStr})\n";
}

echo "Done.\n";

/* =================== helpers =================== */

function parseOrders(string $input): array {
    $input = trim($input);
    if (preg_match('/^\d+\-\d+$/', $input)) {
        [$a, $b] = array_map('intval', explode('-', $input, 2));
        if ($a > $b) [$a, $b] = [$b, $a];
        return range($a, $b);
    }
    $parts = preg_split('/[\s,;]+/', $input);
    $ids   = array_values(array_filter(array_map('intval', $parts)));
    return array_values(array_unique($ids));
}

function parseRange(string $s, int $defMin, int $defMax): array {
    $s = trim($s);
    if (preg_match('/^(\d+)\-(\d+)$/', $s, $m)) {
        $a = (int)$m[1]; $b = (int)$m[2];
        if ($a > $b) [$a, $b] = [$b, $a];
        return [$a, $b];
    }
    return [$defMin, $defMax];
}

function randomUA(): string {
    $uas = [
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0 Safari/537.36',
        'Mozilla/5.0 (Macintosh; Intel Mac OS X 13_6) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.4 Safari/605.1.15',
        'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:125.0) Gecko/20100101 Firefox/125.0',
    ];
    return $uas[array_rand($uas)];
}

function randomIPv4(): string {
    return sprintf('%d.%d.%d.%d', rand(11, 223), rand(0, 255), rand(0, 255), rand(1, 254));
}

function fetchOrder(mysqli $db, string $pfx, int $orderId): ?array {
    $sql = "SELECT order_id, customer_id, store_id, date_added FROM `{$pfx}order` WHERE order_id = ?";
    $stmt = $db->prepare($sql); if (!$stmt) return null;
    $stmt->bind_param('i', $orderId);
    if (!$stmt->execute()) return null;
    $res = $stmt->get_result();
    $row = $res->fetch_assoc() ?: null;
    $stmt->close();
    return $row;
}

function nextOmsId(mysqli $db, string $table): int {
    $q = $db->query("SELECT COALESCE(MAX(id),0) AS mx FROM `{$table}`");
    $mx = (int)($q ? ($q->fetch_assoc()['mx'] ?? 0) : 0);
    return $mx + 1;
}

/* ---------- GEO CACHE ---------- */

function ensureGeoTable(mysqli $db, string $table): void {
    $db->query("
        CREATE TABLE IF NOT EXISTS `{$table}` (
          `ip` VARBINARY(16) NOT NULL,
          `ip_text` VARCHAR(45) NOT NULL,
          `country_code` CHAR(2) NULL,
          `country_name` VARCHAR(64) NULL,
          `region` VARCHAR(128) NULL,
          `city` VARCHAR(128) NULL,
          `latitude` DECIMAL(10,6) NULL,
          `longitude` DECIMAL(10,6) NULL,
          `timezone` VARCHAR(64) NULL,
          `org` VARCHAR(128) NULL,
          `asn` VARCHAR(32) NULL,
          `source` VARCHAR(32) NULL,
          `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
          PRIMARY KEY (`ip`),
          KEY `ip_text` (`ip_text`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");
}

function seedGeoCacheHR(mysqli $db, string $table, int $rows): array {
    $cities = [
        ['Zagreb', 'Grad Zagreb', 45.8150, 15.9819],
        ['Split', 'Splitsko-dalmatinska', 43.5081, 16.4402],
        ['Rijeka', 'Primorsko-goranska', 45.3271, 14.4422],
        ['Osijek', 'Osječko-baranjska', 45.5540, 18.6955],
        ['Zadar', 'Zadarska', 44.1194, 15.2314],
        ['Velika Gorica', 'Zagrebačka', 45.7126, 16.0753],
        ['Pula', 'Istarska', 44.8666, 13.8496],
        ['Slavonski Brod', 'Brodsko-posavska', 45.1603, 18.0156],
        ['Karlovac', 'Karlovačka', 45.4929, 15.5553],
        ['Varaždin', 'Varaždinska', 46.3057, 16.3366],
    ];
    $tz  = 'Europe/Zagreb';
    $ips = [];

    $sql = "
        REPLACE INTO `{$table}`
        (`ip`,`ip_text`,`country_code`,`country_name`,`region`,`city`,
         `latitude`,`longitude`,`timezone`,`org`,`asn`,`source`,`created_at`,`updated_at`)
        VALUES (UNHEX(?), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())
    ";
    $stmt = $db->prepare($sql);
    if (!$stmt) { die('Prepare geo REPLACE failed: ' . $db->error . PHP_EOL); }

    $src = 'seed'; // define once

    for ($i = 0; $i < $rows; $i++) {
        [$city, $region, $lat, $lon] = $cities[$i % count($cities)];

        $ip    = randomIPv4();
        $ipHex = bin2hex(inet_pton($ip));

        $cc      = 'HR';
        $country = 'Croatia';
        $org     = 'Mock ISP';
        $asn     = 'AS65000';

        // 12 placeholders → 12 types:
        // s: ipHex, ip, cc, country, region, city, tz, org, asn, src
        // d: lat, lon
        $stmt->bind_param(
            'ssssssddssss',
            $ipHex, $ip, $cc, $country, $region, $city, $lat, $lon, $tz, $org, $asn, $src
        );

        if (!$stmt->execute()) { die('Geo insert failed: ' . $stmt->error . PHP_EOL); }

        $ips[] = $ip;
    }
    $stmt->close();

    return $ips;
}


/* ---------- SESSION / EVENTS / OMS ---------- */

function insertSession(mysqli $db, string $pfx, array $s): int {
    $sql = "INSERT INTO `{$pfx}impersonation_session`
            (`session_id`,`admin_id`,`customer_id`,`store_id`,`store_host`,`admin_from_url`,`ip`,`user_agent`,
             `started_at`,`last_activity_at`,`ended_at`,`duration_seconds`,`created_at`,`updated_at`)
            VALUES (?,?,?,?,?,?,UNHEX(?),?, ?,?,?,?, NOW(), NOW())";
    $stmt = $db->prepare($sql); if (!$stmt) die("Prepare failed: " . $db->error . "\n");

    $stmt->bind_param(
        'siissssssssi',
        $s['session_id'],
        $s['admin_id'],
        $s['customer_id'],
        $s['store_id'],
        $s['store_host'],
        $s['admin_from_url'],
        $s['ip_hex'],
        $s['user_agent'],
        $s['started_at'],
        $s['last_activity'],
        $s['ended_at'],
        $s['duration_sec']
    );
    if (!$stmt->execute()) die("Insert session failed: " . $stmt->error . "\n");
    $id = $db->insert_id;
    $stmt->close();
    return (int)$id;
}

/** cache DESCRIBE results to avoid repeated I/O */
function colExistsCached(mysqli $db, string $table, string $col): bool {
    static $cache = [];
    $key = $table;
    if (!isset($cache[$key])) {
        $cache[$key] = [];
        if ($res = $db->query("DESCRIBE `{$table}`")) {
            while ($r = $res->fetch_assoc()) $cache[$key][$r['Field']] = true;
        }
    }
    return isset($cache[$key][$col]);
}

/** bind helper with references */
function stmt_bind(mysqli_stmt $stmt, string $types, array $values): void {
    $refs = [];
    foreach ($values as $k => $v) { $refs[$k] = &$values[$k]; }
    array_unshift($refs, $types);
    if (!call_user_func_array([$stmt, 'bind_param'], $refs)) {
        throw new RuntimeException('bind_param failed');
    }
}

function insertEvent(mysqli $db, string $pfx, array $e): void {
    $table = "{$pfx}impersonation_event";

    // Figure out which optional columns exist in this DB
    $has_entity_type = colExistsCached($db, $table, 'entity_type');
    $has_entity_id   = colExistsCached($db, $table, 'entity_id');
    $has_referrer    = colExistsCached($db, $table, 'referrer'); // (should exist, but keep flexible)
    $has_query       = colExistsCached($db, $table, 'query');
    $has_meta        = colExistsCached($db, $table, 'meta');

    // Base columns (always present in your migrations)
    $cols = ['impersonation_session_id','occurred_at','method','route','path','status'];
    $types = ['i','s','s','s','s','i'];
    $vals  = [
        (int)$e['session_id'],
        (string)$e['at'],
        (string)$e['method'],
        (string)$e['route'],
        (string)$e['path'],
        (int)($e['status'] ?? 200)
    ];

    // Optional columns in a deterministic order
    if ($has_referrer) { $cols[]='referrer'; $types[]='s'; $vals[] = isset($e['referrer']) ? (string)$e['referrer'] : null; }
    if ($has_entity_type) { $cols[]='entity_type'; $types[]='s'; $vals[] = $e['entity_type'] ?? null; }
    if ($has_entity_id)   { $cols[]='entity_id';   $types[]='i'; $vals[] = isset($e['entity_id']) ? (int)$e['entity_id'] : null; }
    if ($has_query)       { $cols[]='query';       $types[]='s'; $vals[] = $e['query_json'] ?? null; }
    if ($has_meta)        { $cols[]='meta';        $types[]='s'; $vals[] = $e['meta_json']  ?? null; }

    // Build SQL
    $ph = implode(',', array_fill(0, count($cols), '?'));
    $cols_sql = '`' . implode('`,`', $cols) . '`';
    $sql = "INSERT INTO `{$table}` ({$cols_sql},`created_at`) VALUES ({$ph}, NOW())";

    $stmt = $db->prepare($sql);
    if (!$stmt) { die("Prepare failed: " . $db->error . PHP_EOL); }

    stmt_bind($stmt, implode('', $types), $vals);

    if (!$stmt->execute()) {
        $stmt->close();
        die("Insert event failed: " . $stmt->error . PHP_EOL);
    }
    $stmt->close();
}


function insertOMS(mysqli $db, string $pfx, array $o): void {
    $sql = "INSERT INTO `{$pfx}order_manager_sales`
            (`id`,`start`,`end`,`napomena`,`user_id`,`customer_id`,`order_id`,`date_added`,`date_modified`)
            VALUES (?,?,?,?,?,?,?,?,?)";
    $stmt = $db->prepare($sql); if (!$stmt) die("Prepare failed: " . $db->error . "\n");

    $stmt->bind_param(
        'isssiiiss',
        $o['id'],
        $o['start'],
        $o['end'],
        $o['napomena'],
        $o['user_id'],
        $o['customer_id'],
        $o['order_id'],
        $o['added'],
        $o['modified']
    );
    if (!$stmt->execute()) die("Insert OMS failed: " . $stmt->error . "\n");
    $stmt->close();
}

/* ---------- SAMPLING ---------- */

function sampleIds(mysqli $db, string $table, string $col, int $n): array {
    $n = max(0, $n);
    if ($n === 0) return [];
    $ids = [];
    $sql = "SELECT {$col} AS id FROM `{$table}` ORDER BY RAND() LIMIT {$n}";
    if ($res = $db->query($sql)) while ($r = $res->fetch_assoc()) $ids[] = (int)$r['id'];
    return $ids;
}

function sampleIdsInRange(mysqli $db, string $table, string $col, array $range, int $n): array {
    $n = max(0, $n);
    if ($n === 0) return [];
    [$min, $max] = $range;
    $ids = [];
    $sql = "SELECT {$col} AS id FROM `{$table}` WHERE {$col} BETWEEN ? AND ? ORDER BY RAND() LIMIT {$n}";
    $stmt = $db->prepare($sql); if (!$stmt) return [];
    $stmt->bind_param('ii', $min, $max);
    if ($stmt->execute()) { $res = $stmt->get_result(); while ($r = $res->fetch_assoc()) $ids[] = (int)$r['id']; }
    $stmt->close();
    return $ids;
}

/* ---------- EVENT GEN (approx N clicks over session) ---------- */

function seedEventsApproximately(
    mysqli $db, string $pfx, int $sessionId,
    DateTimeImmutable $start, DateTimeImmutable $end,
    array $productIds, array $categoryIds, array $brandIds,
    int $orderId, int $targetClicks
): void {
    $events = [];

    // Core funnel anchors
    $events[] = ['route'=>'common/home', 'type'=>'page', 'id'=>null, 'path'=>'/', 'ref'=>null];

    foreach ($categoryIds as $cid) {
        $events[] = ['route'=>'product/category', 'type'=>'category', 'id'=>$cid, 'path'=>'index.php?route=product/category&path='.$cid, 'ref'=>'/'];
    }
    foreach ($brandIds as $mid) {
        $events[] = ['route'=>'product/manufacturer/info', 'type'=>'manufacturer', 'id'=>$mid, 'path'=>'index.php?route=product/manufacturer/info&manufacturer_id='.$mid, 'ref'=>'/'];
    }
    foreach ($productIds as $pid) {
        $events[] = ['route'=>'product/product', 'type'=>'product', 'id'=>$pid, 'path'=>'index.php?route=product/product&product_id='.$pid, 'ref'=>'index.php?route=product/category'];
    }

    // Cart & checkout anchors
    $events[] = ['route'=>'checkout/cart',     'type'=>'cart',     'id'=>null, 'path'=>'index.php?route=checkout/cart',     'ref'=>'index.php?route=product/product'];
    $events[] = ['route'=>'checkout/checkout', 'type'=>'checkout', 'id'=>null, 'path'=>'index.php?route=checkout/checkout', 'ref'=>'index.php?route=checkout/cart'];

    if ($orderId > 0) {
        $events[] = ['route'=>'checkout/success', 'type'=>'page', 'id'=>null, 'path'=>'index.php?route=checkout/success', 'ref'=>'index.php?route=checkout/checkout', 'meta'=>['order_id'=>$orderId]];
    }

    // Pad to target clicks with additional browsing
    $base = count($events);
    if ($base < $targetClicks) {
        $pool = [];
        foreach ($categoryIds as $cid) $pool[] = ['route'=>'product/category','type'=>'category','id'=>$cid,'path'=>'index.php?route=product/category&path='.$cid,'ref'=>'/'];
        foreach ($productIds as $pid)   $pool[] = ['route'=>'product/product','type'=>'product','id'=>$pid,'path'=>'index.php?route=product/product&product_id='.$pid,'ref'=>'index.php?route=product/category'];
        foreach ($brandIds as $mid)     $pool[] = ['route'=>'product/manufacturer/info','type'=>'manufacturer','id'=>$mid,'path'=>'index.php?route=product/manufacturer/info&manufacturer_id='.$mid,'ref'=>'/'];
        // add some generic pages/search/info
        $generic = [
            ['route'=>'information/information', 'type'=>'information','id'=>1, 'path'=>'index.php?route=information/information&information_id=1', 'ref'=>'/'],
            ['route'=>'product/search',          'type'=>'search',     'id'=>null, 'path'=>'index.php?route=product/search&search=demo',           'ref'=>'/'],
        ];
        $pool = array_merge($pool, $generic);

        while (count($events) < $targetClicks && $pool) {
            $events[] = $pool[array_rand($pool)];
        }
    }

    // Time spacing across the session window
    $total = max(2, count($events));
    $span  = max(60, $end->getTimestamp() - $start->getTimestamp());
    $step  = (int) floor($span / ($total - 1));

    $t = $start;
    foreach ($events as $i => $ev) {
        $at = $t->format('Y-m-d H:i:s');
        $type = $ev['type']; $id = $ev['id'];
        $route = $ev['route']; $path = $ev['path']; $ref = $ev['ref'] ?? null;
        $query = null; $meta  = isset($ev['meta']) ? json_encode($ev['meta']) : null;

        // Basic query payloads for some types
        if ($type === 'product' && $id)   $query = json_encode(['product_id'=>(string)$id]);
        if ($type === 'category' && $id)  $query = json_encode(['path'=>(string)$id]);
        if ($type === 'manufacturer' && $id) $query = json_encode(['manufacturer_id'=>(string)$id]);

        insertEvent($db, $pfx, [
            'session_id' => (int)$sessionId,
            'at'         => $at,
            'method'     => 'GET',
            'route'      => (string)$route,
            'entity_type'=> $type ?? null,          // may be null
            'entity_id'  => isset($id) ? (int)$id : null,
            'path'       => (string)$path,
            'status'     => 200,
            'referrer'   => $ref ? (string)$ref : null,
            'query_json' => $query,                  // null or JSON string
            'meta_json'  => $meta                    // null or JSON string
        ]);

        // advance time
        $t = $t->add(new DateInterval('PT' . max(1, $step) . 'S'));
    }
}

/* ===== WIPERS (robust with FKs) ========================================= */

function sql_or_die(mysqli $db, string $sql, string $label) {
    if (!$db->query($sql)) {
        die("$label failed: " . $db->error . PHP_EOL);
    }
    return $db->affected_rows;
}

function wipe_all(mysqli $db, string $PFX) {
    // 1) Delete children first (FK safe)
    $ev = sql_or_die($db, "DELETE FROM `{$PFX}impersonation_event`", "Delete events");
    $ss = sql_or_die($db, "DELETE FROM `{$PFX}impersonation_session`", "Delete sessions");
    $om = sql_or_die($db, "DELETE FROM `{$PFX}order_manager_sales`", "Delete OMS");

    // 2) Reset AUTO_INCREMENT (TRUNCATE would fail with FKs)
    @sql_or_die($db, "ALTER TABLE `{$PFX}impersonation_event` AUTO_INCREMENT=1", "AI reset (events)");
    @sql_or_die($db, "ALTER TABLE `{$PFX}impersonation_session` AUTO_INCREMENT=1", "AI reset (sessions)");
    @sql_or_die($db, "ALTER TABLE `{$PFX}order_manager_sales` AUTO_INCREMENT=1", "AI reset (OMS)");

    echo "Wiped ALL → events: {$ev}, sessions: {$ss}, oms: {$om}\n";
}

function wipe_scoped(mysqli $db, string $PFX, int $admin_id, int $customer_id, array $orders) {
    // Child rows first via JOIN on matching sessions
    $ev = sql_or_die($db, "
        DELETE e FROM `{$PFX}impersonation_event` e
        JOIN `{$PFX}impersonation_session` s ON s.id = e.impersonation_session_id
        WHERE s.admin_id = {$admin_id} AND s.customer_id = {$customer_id}
    ", "Scoped delete events");

    // Sessions next (cascades also possible, but we already removed children)
    $ss = sql_or_die($db, "
        DELETE FROM `{$PFX}impersonation_session`
        WHERE admin_id = {$admin_id} AND customer_id = {$customer_id}
    ", "Scoped delete sessions");

    // OMS: by orders if provided, otherwise by admin+customer
    if ($orders) {
        $in = implode(',', array_map('intval', $orders));
        $om = sql_or_die($db, "DELETE FROM `{$PFX}order_manager_sales` WHERE order_id IN ({$in})", "Scoped delete OMS by orders");
    } else {
        $om = sql_or_die($db, "DELETE FROM `{$PFX}order_manager_sales` WHERE user_id = {$admin_id} AND customer_id = {$customer_id}", "Scoped delete OMS by user+customer");
    }

    echo "Wiped SCOPED → events: {$ev}, sessions: {$ss}, oms: {$om}\n";
}
