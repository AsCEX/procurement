<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends MY_Controller {

    public function __construct(){

        parent::__construct();

        $this->load->model('categories_model', 'cat_model');
    }

    public function index() {
        $this->load->view('categories/default');
    }

    public function getCategories($cat_id = null){

        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        $categories = $this->cat_model->getLimitCategories($page);

        $cat_data = array();

        foreach($categories as $category){
            $temp = array(
                'name'  => $category->cat_id,
                'value' => $category->cat_code . " - " . $category->cat_description
            );

            if($category->cat_id == $cat_id){
                $temp['selected'] = true;
            }

            $cat_data[] = $temp;

        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($cat_data) );
    }

    public function getCategoriesGrid() {

        $categories = $this->cat_model->getCategories();

        $resultSet['rows'] = $categories;
        $resultSet['total'] = count($categories);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultSet) );
    }

    public function addCategory($id=null)
    {
        $data['categories'] = $this->cat_model->getCategoryById($id);
        $this->load->view('categories/modal/add', $data);
    }

    public function saveCategory(){

        $post = $_POST;

        $data = array(
            'cat_code'          => $post['cat_code'],
            'cat_description'   => $post['cat_description']
        );

        $rs = $this->cat_model->save($data, $post['cat_id']);

        if($rs){
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('action'=>$post['action'], 'status'=>'success', 'lastid' => $rs )) );
        }
    }

    public function dialog($cat_id = 0){

        $category = $this->cat_model->getCategoryById($cat_id);

        $data['category'] = ($category) ? $category : array();
        $data['cat_id'] = $cat_id;

        $this->load->view('categories/dialog/add', $data);
    }
}
