<?php

use Agmedia\Api\Api;
use Agmedia\Api\Helper\Helper;
use Agmedia\Helpers\Log;
use Agmedia\Api\Connection\Csv;
use Agmedia\Models\Product\Product;
use Agmedia\Models\Product\ProductImage;
use Illuminate\Support\Str;

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

		$data['action_upload_ideus'] = $this->url->link('extension/module/agm_api/formAction', 'user_token=' . $this->session->data['user_token'], 'SSL');
		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/agm_api', $data));
	}


    public function formAction()
    {
        Log::store($this->request->post, 'form');

        Log::store($_FILES, 'form');

        if ( ! isset($this->request->post['action'])) {
            return $this->index();
        }

        if ($this->request->post['action'] == 'ideus_csv') {

        }

        return $this->index();
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


    public function importImages()
    {
        $api = new Api();
        $count = 0;

        $products = products()->where('image', '=', '')
                              ->orWhere('image', '=', 'catalog/products/no-image.jpg')
                              ->pluck('sku', 'product_id');

        foreach ($products as $product_id => $sku) {
            $data = $api->post(agconf('import.api.url_image_suffix'), $api->resolveImageData($sku));

            if (isset($data['response']['result'])) {
                foreach ($data['response']['result'] as $item) {
                    if (isset($item['Attachment']['contents'])) {
                        $image = Helper::base64_to_jpeg(
                            $item['Attachment']['contents'],
                            agconf('import.image_path') . $item['Attachment']['fileName']
                        );

                        Product::query()->where('product_id', $product_id)->update([
                            'image' => $image
                        ]);

                        $count++;
                        sleep(1);
                    }
                }
            }
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode(['inserted' => $count]));
    }


    public function updateBraytronImages()
    {
        $braytron = new Csv\Braytron();

        $braytron->getXML('images');

        $count = 1;

        foreach ($braytron->images as $item) {
            if ( ! empty($item['images']) && $count < 5) {
                $product = Product::query()->where('sku', $item['sku'])->where('mpn', '!=', '1')->first();

                if ($product) {
                    $path = agconf('import.image_path') . 'braytron-' . $item['sku'] . '/';

                    if ( ! is_dir(DIR_IMAGE . $path)) {
                        mkdir(DIR_IMAGE . $path, 0777, true);
                    }

                    $sort_order = 1;

                    foreach ($item['images'] as $image_url) {
                        $image = file_get_contents($image_url);
                        $name = $item['sku'] . '-' . Str::random(9);

                        file_put_contents(DIR_IMAGE . $path . $name, $image);

                        ProductImage::query()->insertGetId([
                            'product_id' => $product['product_id'],
                            'image' => $path . $name,
                            'sort_order' => $sort_order
                        ]);

                        $sort_order++;
                    }

                    $product->update(['mpn' => '1']);

                    $count++;
                }
            }
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode(['inserted' => $count]));
    }


    public function updateQuantity()
    {
        $braytron = new Csv\Braytron();

        $braytron->getXML('quantity');

     /*   $csv = new Csv(DIR_UPLOAD . 'csv/ProductsData-EN.csv');

        $ideus_data = $csv->collect();

        $ideus = new Csv\Ideus($ideus_data->toArray());*/

        $bt = collect($braytron->quantity);
        $data = [];

      /*  foreach ($ideus->getQuantity() as $item) {
            $found = $bt->where('sku', $item['sku'])->first();

            if ($found) {
                $data[$item['sku']] = [
                    'sku' => $item['sku'],
                    'quantity' => $item['quantity'] + $found['quantity']
                ];
            } else {
                $data[$item['sku']] = [
                    'sku' => $item['sku'],
                    'quantity' => $item['quantity']
                ];
            }
        }*/

        foreach ($bt->all() as $item) {
            if ( ! isset($data[$item['sku']])) {
                $data[$item['sku']] = [
                    'sku' => $item['sku'],
                    'quantity' => $item['quantity']
                ];
            }
        }

        $str = '';

        foreach ($data as $item) {
            $str .= '("' . $item['sku'] . '", ' . $item['quantity'] . ', ' . 0 . '),';
        }

        $this->db->query("TRUNCATE TABLE `" . DB_PREFIX . "product_temp`");

        $this->db->query("INSERT INTO " . DB_PREFIX . "product_temp (uid, quantity, price) VALUES " . substr($str, 0, -1) . ";");

        $this->db->query("UPDATE " . DB_PREFIX . "product p INNER JOIN " . DB_PREFIX . "product_temp pt ON p.sku = pt.uid SET p.suplierqty = pt.quantity");

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode(['inserted' => 1]));
    }


	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/agm_api')) {
			$this->error['warning'] = 'Permission error.';
		}

		return !$this->error;
	}
}