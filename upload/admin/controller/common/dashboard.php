<?php
class ControllerCommonDashboard extends Controller {
	public function index() {
		$this->load->language('common/dashboard');
		
		
		  $this->load->model('user/user');

            $user_info = $this->model_user_user->getUser($this->user->getId());

            if ($user_info) {
                $data['user_group_id'] = $user_info['user_group_id'];
            } else {
                $data['user_group_id'] = 0;
            }

		$this->document->setTitle($this->language->get('heading_title'));

        $data['link_akcije'] = $this->url->link('extension/module/megaSalesPro',
            'user_token=' . $this->session->data['user_token'], true);


        $data['link_grupe'] = $this->url->link('extension/cigroupprice_product',
            'user_token=' . $this->session->data['user_token'], true);


        $data['link_top_kategorije'] = $this->url->link('extension/module/basel_categories&module_id=67',
            'user_token=' . $this->session->data['user_token'], true);


        $data['link_rasvjeta_kategorije'] = $this->url->link('extension/module/basel_categories&module_id=66',
            'user_token=' . $this->session->data['user_token'], true);

        $data['link_proizvodi'] = $this->url->link('extension/basel/productgroups',
            'user_token=' . $this->session->data['user_token'], true);


        $data['link_agapi'] = $this->url->link('extension/module/agm_api',
            'user_token=' . $this->session->data['user_token'], true);

        $data['link_ponuda'] = $this->url->link('sale/order',
            'user_token=' . $this->session->data['user_token'], true);

         $data['excelup'] = $this->url->link('extension/module/excelup',
            'user_token=' . $this->session->data['user_token'], true);
            
            
            	   $data['mobile'] = $this->url->link('extension/module/basel_layerslider',
            '&module_id=69&user_token=' . $this->session->data['user_token'], true);

  $data['desktop'] = $this->url->link('extension/module/basel_layerslider',
            '&module_id=43&user_token=' . $this->session->data['user_token'], true);



		$data['user_token'] = $this->session->data['user_token'];

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		// Check install directory exists
		if (is_dir(DIR_CATALOG . '../install')) {
			$data['error_install'] = $this->language->get('error_install');
		} else {
			$data['error_install'] = '';
		}

		// Dashboard Extensions
		$dashboards = array();

		$this->load->model('setting/extension');

		// Get a list of installed modules
		$extensions = $this->model_setting_extension->getInstalled('dashboard');

		// Add all the modules which have multiple settings for each module
		foreach ($extensions as $code) {
			if ($this->config->get('dashboard_' . $code . '_status') && $this->user->hasPermission('access', 'extension/dashboard/' . $code)) {
				$output = $this->load->controller('extension/dashboard/' . $code . '/dashboard');

				if ($output) {
					$dashboards[] = array(
						'code'       => $code,
						'width'      => $this->config->get('dashboard_' . $code . '_width'),
						'sort_order' => $this->config->get('dashboard_' . $code . '_sort_order'),
						'output'     => $output
					);
				}
			}
		}

		$sort_order = array();

		foreach ($dashboards as $key => $value) {
			$sort_order[$key] = $value['sort_order'];
		}

		array_multisort($sort_order, SORT_ASC, $dashboards);

		// Split the array so the columns width is not more than 12 on each row.
		$width = 0;
		$column = array();
		$data['rows'] = array();

		foreach ($dashboards as $dashboard) {
			$column[] = $dashboard;

			$width = ($width + $dashboard['width']);

			if ($width >= 12) {
				$data['rows'][] = $column;

				$width = 0;
				$column = array();
			}
		}

		if (!empty($column)) {
    			$data['rows'][] = $column;
		}

		if (DIR_STORAGE == DIR_SYSTEM . 'storage/') {
			$data['security'] = $this->load->controller('common/security');
		} else {
			$data['security'] = '';
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		// Run currency update
		if ($this->config->get('config_currency_auto')) {
			$this->load->model('localisation/currency');

			$this->model_localisation_currency->refresh();
		}

		$this->response->setOutput($this->load->view('common/dashboard', $data));
	}
}
