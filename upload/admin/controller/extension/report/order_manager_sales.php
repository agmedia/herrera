<?php
class ControllerExtensionReportOrderManagerSales extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('extension/report/order_manager_sales');

        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('report_order_manager_sales', $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=report', true));
        }

        $data['error_warning'] = $this->error['warning'] ?? '';

        $data['breadcrumbs'] = array();
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
        );
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=report', true)
        );
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/report/order_manager_sales', 'user_token=' . $this->session->data['user_token'], true)
        );

        $data['action'] = $this->url->link('extension/report/order_manager_sales', 'user_token=' . $this->session->data['user_token'], true);
        $data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=report', true);

        $data['report_order_manager_sales_status'] = $this->request->post['report_order_manager_sales_status'] ?? $this->config->get('report_order_manager_sales_status');
        $data['report_order_manager_sales_sort_order'] = $this->request->post['report_order_manager_sales_sort_order'] ?? $this->config->get('report_order_manager_sales_sort_order');

        $data['header']      = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer']      = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/report/order_manager_sales_form', $data));
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'extension/report/order_manager_sales')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        return !$this->error;
    }

    // Main report body
    public function report() {
        $this->load->language('extension/report/order_manager_sales');

        $filter_manager         = $this->request->get['filter_manager']         ?? '';
        $filter_date_start      = $this->request->get['filter_date_start']      ?? date('Y-m-01');
        $filter_date_end        = $this->request->get['filter_date_end']        ?? date('Y-m-d');
        $filter_group           = $this->request->get['filter_group']           ?? 'week';
        $filter_order_status_id = (int)($this->request->get['filter_order_status_id'] ?? 0);
        $page                   = (int)($this->request->get['page'] ?? 1);

        $this->load->model('extension/report/order_manager_sales');

        $data['orders'] = [];
        $filter_data = [
            'filter_manager'         => $filter_manager,
            'filter_date_start'      => $filter_date_start,
            'filter_date_end'        => $filter_date_end,
            'filter_group'           => $filter_group,
            'filter_order_status_id' => $filter_order_status_id,
            'start'                  => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit'                  => $this->config->get('config_limit_admin')
        ];

        $order_total = 0;
        $results = $this->model_extension_report_order_manager_sales->getOrderSalesByManager($filter_data);
        foreach ($results as $result) {
            $order_total += 1;
            $data['orders'][] = array(
                'manager'    => $result['manager'],
                'date_start' => date($this->language->get('date_format_short'), strtotime($result['date_start'])),
                'date_end'   => date($this->language->get('date_format_short'), strtotime($result['date_end'])),
                'orders'     => $result['orders'],
                'products'   => $result['products'],
                'tax'        => $this->currency->format($result['tax'], $this->config->get('config_currency')),
                'total'      => $this->currency->format($result['total'], $this->config->get('config_currency')),
                'sessions'   => (int)$result['sessions']
            );
        }

        if ($filter_manager !== '') {
            $data['manager_orders'] = $this->model_extension_report_order_manager_sales->getOrderSalesFromManager($filter_data);
        }

        $data['user_token'] = $this->session->data['user_token'];

        $this->load->model('localisation/order_status');
        $data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

        $data['managers'] = [];
        $managers = \Agmedia\Models\User::query()->where('user_group_id', agconf('salesman_id'))->get();
        foreach ($managers as $manager) {
            $data['managers'][] = [
                'id'    => $manager->user_id,
                'value' => $manager->firstname . ' ' . $manager->lastname,
            ];
        }

        $data['groups'] = array(
            array('text' => $this->language->get('text_year'),  'value' => 'year'),
            array('text' => $this->language->get('text_month'), 'value' => 'month'),
            array('text' => $this->language->get('text_week'),  'value' => 'week'),
            array('text' => $this->language->get('text_day'),   'value' => 'day'),
        );

        $url = '';
        if (isset($this->request->get['filter_manager']))         $url .= '&filter_manager=' . $this->request->get['filter_manager'];
        if (isset($this->request->get['filter_date_start']))      $url .= '&filter_date_start=' . $this->request->get['filter_date_start'];
        if (isset($this->request->get['filter_date_end']))        $url .= '&filter_date_end=' . $this->request->get['filter_date_end'];
        if (isset($this->request->get['filter_group']))           $url .= '&filter_group=' . $this->request->get['filter_group'];
        if (isset($this->request->get['filter_order_status_id'])) $url .= '&filter_order_status_id=' . $this->request->get['filter_order_status_id'];

        $pagination = new Pagination();
        $pagination->total = $order_total;
        $pagination->page  = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url   = $this->url->link('report/report', 'user_token=' . $this->session->data['user_token'] . '&code=order_manager_sales' . $url . '&page={page}', true);

        $data['pagination'] = $pagination->render();
        $data['results']    = sprintf($this->language->get('text_pagination'),
            ($order_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0,
            ((($page - 1) * $this->config->get('config_limit_admin')) > ($order_total - $this->config->get('config_limit_admin'))) ? $order_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')),
            $order_total, ceil($order_total / $this->config->get('config_limit_admin'))
        );

        $data['filter_manager']         = $filter_manager;
        $data['filter_date_start']      = $filter_date_start;
        $data['filter_date_end']        = $filter_date_end;
        $data['filter_group']           = $filter_group;
        $data['filter_order_status_id'] = $filter_order_status_id;

        return $this->load->view('extension/report/order_manager_sales_info', $data);
    }

    // JSON: sessions for selected manager (timeline)
    public function sessions() {
        $this->response->addHeader('Content-Type: application/json');

        $filter_manager    = (int)($this->request->get['filter_manager']    ?? 0);
        $filter_date_start =       $this->request->get['filter_date_start'] ?? date('Y-m-01');
        $filter_date_end   =       $this->request->get['filter_date_end']   ?? date('Y-m-d');

        if (!$filter_manager) {
            $this->response->setOutput(json_encode(['sessions' => []]));
            return;
        }

        $this->load->model('extension/report/order_manager_sales');
        $sessions = $this->model_extension_report_order_manager_sales->getManagerSessions([
            'filter_manager'    => $filter_manager,
            'filter_date_start' => $filter_date_start,
            'filter_date_end'   => $filter_date_end
        ]);

        $this->response->setOutput(json_encode(['sessions' => $sessions]));
    }

    // JSON: aggregated impersonation events for one session
    public function session_event_stats() {
        $this->response->addHeader('Content-Type: application/json');

        $session_id  = (int)($this->request->get['session_id'] ?? 0);
        if (!$session_id) { $this->response->setOutput(json_encode(['summary'=>[], 'products'=>[], 'categories'=>[], 'manufacturers'=>[], 'information'=>[]])); return; }

        $this->load->model('extension/report/order_manager_sales');
        $language_id = (int)$this->config->get('config_language_id');

        $stats = $this->model_extension_report_order_manager_sales->getSessionEventStats($session_id, $language_id);
        $this->response->setOutput(json_encode($stats));
    }

    // JSON: timeline (per minute) of clicks by entity_type for one session
    public function session_event_timeline() {
        $this->response->addHeader('Content-Type: application/json');

        $session_id  = (int)($this->request->get['session_id'] ?? 0);
        if (!$session_id) { $this->response->setOutput(json_encode(['labels'=>[], 'series'=>[]])); return; }

        $this->load->model('extension/report/order_manager_sales');
        $rows = $this->model_extension_report_order_manager_sales->getSessionEventTimeline($session_id);

        // Transform rows -> labels + series dict
        $labels = [];
        $by_ts  = []; // ts => entity_type => clicks
        foreach ($rows as $r) {
            $ts = $r['ts'];
            if (!isset($by_ts[$ts])) { $by_ts[$ts] = []; $labels[] = $ts; }
            $by_ts[$ts][$r['entity_type']] = (int)$r['clicks'];
        }

        $types = ['product','category','manufacturer','information','search','cart','checkout','page'];
        $series = [];
        foreach ($types as $t) {
            $arr = [];
            foreach ($labels as $ts) {
                $arr[] = isset($by_ts[$ts][$t]) ? (int)$by_ts[$ts][$t] : 0;
            }
            $series[$t] = $arr;
        }

        $this->response->setOutput(json_encode(['labels' => $labels, 'series' => $series]));
    }


    public function session_info() {
        $this->response->addHeader('Content-Type: application/json');
        $session_id = (int)($this->request->get['session_id'] ?? 0);
        if (!$session_id) { $this->response->setOutput(json_encode([])); return; }

        $this->load->model('extension/report/order_manager_sales');
        $info = $this->model_extension_report_order_manager_sales->getSessionInfo($session_id);
        $this->response->setOutput(json_encode($info ?: []));
    }

}
