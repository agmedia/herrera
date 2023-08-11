<?php
class ControllerCommonMenu extends Controller {
	public function index() {
		$this->load->language('common/menu');

		// Menu
		$this->load->model('catalog/category');

		$this->load->model('catalog/product');

        $this->load->model('tool/image');

		$data['categories'] = array();

		$categories = $this->model_catalog_category->getCategories(0);

		foreach ($categories as $category) {
			if ($category['top']) {
				// Level 2
				$children_data = array();

				$children = $this->model_catalog_category->getCategories($category['category_id']);

				foreach ($children as $child) {
					$filter_data = array(
						'filter_category_id'  => $child['category_id'],
						'filter_sub_category' => true
					);


                    if($child['image']){
                        $image = $this->model_tool_image->resize($child['image'], 30, 30);
                    } else {
                        $image = false;
                    }


                    $children_data[] = array(
                        'image' => $image,
						'name'  => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
						'href'  => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'])
					);
				}


                if($category['image']){
                    $image = $this->model_tool_image->resize($category['image'], 30, 30);
                } else {
                    $image = false;
                }

				// Level 1
				$data['categories'][] = array(
                    'thumb'    =>  $image,
					'name'     => $category['name'],
					'children' => $children_data,
					'column'   => $category['column'] ? $category['column'] : 1,
					'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
				);
			}
		}


		/*echo '<pre>';
		print_r($data);
        echo '</pre>';*/

		return $this->load->view('common/menu', $data);
	}
}
