<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Biddings extends MY_Controller {

    public function __construct(){

        parent::__construct();

        $this->load->model('categories_model', 'cat_model');
    }

    public function index()
    {

        $cat = $this->cat_model->getCategories();

        $data['categories'] = $cat;

        $this->load->view('default/header');
        $this->load->view('default/sidebar', $this->sidebar);
        $this->load->view('categories/index', $data);
        $this->load->view('default/footer');
    }

    public function getCategories(){

        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        $groups = $this->cat_model->getLimitCategories($page);
        $rows = $this->cat_model->countRows();
        $info = ['totalRecords'=> $rows, 'recordCount'=> count($groups), 'currentPage'=>$page, 'totalPages'=>ceil($rows/10)];
        $resultSet['info'] = $info;
        $resultSet['data'] = $groups;

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
            'code' => $post['code'],
            'description'   => $post['description']
        );

        $rs = $this->cat_model->save($data, $post['id']);

        if($rs){
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('action'=>$post['action'], 'status'=>'success', 'lastid' => $rs )) );
        }
    }
}
