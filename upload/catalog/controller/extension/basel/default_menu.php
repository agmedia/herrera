<?php
class ControllerExtensionBaselDefaultMenu extends Controller {
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
					
				$grandchildren_data = array();

				// Level 3
				$grandchildren = $this->model_catalog_category->getCategories($child['category_id']);
				foreach ($grandchildren as $grandchild) {
					
					if ($this->config->get('config_product_count')) {
					$total = ' (' . $this->model_catalog_product->getTotalProducts(array('filter_category_id'  => $grandchild['category_id'])). ')';
					} else {
					$total = '';
					}

                    if($grandchild['image']){
                        $image = $this->model_tool_image->resize($grandchild['image'], 50, 50);
                    } else {
                        $image = 'image/No_Image_Available.jpg';
                    }
					
					$grandchildren_data[] = array(
                        'thumb'    =>  $image,
					'name' => $grandchild['name'] . $total,
					'href' => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'] . '_' . $grandchild['category_id'])
					);
				 }
				
					$filter_data = array(
						'filter_category_id'  => $child['category_id'],
						'filter_sub_category' => true
					);
					
					if ($this->config->get('config_product_count')) {
					$total = ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')';
					} else {
					$total = '';
					}


                    if($child['image']){
                        $image = $this->model_tool_image->resize($child['image'], 50, 50);
                    } else {
                        $image = 'image/No_Image_Available.jpg';
                    }

					$children_data[] = array(
                        'thumb'    =>  $image,
						'name'  => $child['name'] . $total,
                        'column'   => $child['column'] ? $child['column'] : 1,
						'href'  => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id']),
						'grandchildren'	=> $grandchildren_data,
					);
				}

				// Level 1
                if($category['image']){
                    $image = $this->model_tool_image->resize($category['image'], 50, 50);
                } else {
                    $image = 'image/No_Image_Available.jpg';
                }

				$data['categories'][] = array(
                    'thumb'    =>  $image,
					'name'     => $category['name'],
					'children' => $children_data,
					'column'   => $category['column'] ? $category['column'] : 1,
					'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
				);
			}
		}

		return $this->load->view('common/menu', $data);
	}
}
