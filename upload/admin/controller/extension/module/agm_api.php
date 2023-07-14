<?php

use Agmedia\Helpers\Log;
use Agmedia\Api\Connection\Csv;
use Agmedia\Models\Product\Product;

class ControllerExtensionModuleAgmApi extends Controller {
	private $error = array();

	public function index() {
        $this->load->language('extension/module/agm_api');
        
        $this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('agm_api', $this->request->post);

			$this->session->data['success'] = 'Uspješno snimljeno';

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}
		
		$data['user_token'] = $this->session->data['user_token'];


		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/agm_api', 'user_token=' . $this->session->data['user_token'], 'SSL')
		);

		$data['action_import_products'] = $this->url->link('extension/module/agm_api', 'user_token=' . $this->session->data['user_token'], 'SSL');
		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/agm_api', $data));
	}
    
    
    public function importProducts()
    {
        $count = 0;
        $path = DIR_UPLOAD . agconf('import.ideus_csv_path');
    
        $csv = new Csv($path);

        $products_for_insert = $csv->collect()->whereIn(21, ['Marka', 'Struhm', 'STRUHM', 'Braytron', 'BRAYTRON'])->toArray();


        if (count($products_for_insert)) {
            $import = new Csv\Generic();
            $collection = [];

            foreach ($products_for_insert as $key => $item) {
                if ($key > 1) {
                    $attr = $import->resolveAttributes($item);
                    $item['attributes'] = $attr;

                    $collection[] = $item;
                }
            }


            //$testing = collect($products_for_insert)->take(5)->toArray();

            foreach ($collection as $item) {
                $has_product = Product::query()->where('sku', $item[0])->first();

                if ( ! $has_product) {
                    $this->load->model('catalog/product');

                    $this->model_catalog_product->addProduct($import->resolveProduct($item));

                    $count++;
                }
            }

        }

        //Log::store($collection, 'csv_herrera');
        
        
        /*$prods = \Agmedia\Models\Product\Product::query()->get();
        
        \Agmedia\Helpers\Log::store($prods->toArray(), 'prods');*/
    
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(/*json_encode(['inserted' => $count])*/json_encode(['inserted' => $count]));
    }

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/agm_api')) {
			$this->error['warning'] = 'Permission error.';
		}

		return !$this->error;
	}
}