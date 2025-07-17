<?php
class ControllerExtensionModuleMakasbCategory extends Controller {
    private $error = array();

    public function index() {
        $this->document->addScript("view/javascript/sortable.js");
        $this->document->addStyle("view/stylesheet/makasb_theme.css");
        $this->document->addScript("view/javascript/makasb_main.js");
        $this->load->language('extension/module/makasb_category');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/category');

        $this->getList();
    }
    protected function getList() {
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('catalog/category', 'user_token=' . $this->session->data['user_token'], true)
        );

        $data['add'] = $this->url->link('catalog/category/add', 'user_token=' . $this->session->data['user_token'], true);
        $data['default_category_list'] = $this->url->link('catalog/category', 'user_token=' . $this->session->data['user_token'], true);


        $data['categories'] = array();

        $data['user_token'] = $this->session->data['user_token'];

        $filter_data = array(
            'sort'  => 'sort',
            'order' => 'ASC'
        );


        $results = $this->model_catalog_category->getCategories($filter_data);

        foreach ($results as $result) {
            $data['categories'][$result['parent_id']][] = array(
                'category_id' => $result['category_id'],
                'name'        => $result['name'],
                'sort_order'  => $result['sort_order']
            );
        }

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        if (isset($this->request->post['selected'])) {
            $data['selected'] = (array)$this->request->post['selected'];
        } else {
            $data['selected'] = array();
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/makasb_category_list', $data));
    }

    public function save_categories() {
        $this->load->model('catalog/category');
        $categories = json_decode(htmlspecialchars_decode($this->request->post['categories']), true);
        if (is_array($categories)) {
            foreach ($categories as $categoryId => $categoryAttr) {
                $this->model_catalog_category->update_category($categoryId, $categoryAttr);
            }
        }
        $this->response->setOutput(json_encode(['success' => true]));
    }

}
