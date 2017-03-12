<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('items_model');
    }

    public function index() {
        $this->load->view('items/default');
    }

    public function getItemsGrid() {
        $items = $this->items_model->getItemsGrid();

        $resultSet['rows'] = $items;
        $resultSet['total'] = count($items);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultSet) );
    }

    public function dialog($item_id = 0){

        $item = $this->items_model->getItemById($item_id);

        $data['item'] = ($item) ? $item : array();

        $this->load->view('items/dialog/add', $data);
    }

    public function saveItem() {

        $post = $_POST;

        $item = $this->items_model->save( $post, $post['item_id'] );

        if ( $item ) {
            $this->output
                ->set_content_type('application/json')
                ->set_output( json_encode( array( 'status' => 'success' ) ) );
        }
    }

    public function deleteItem() {

        $post = $_POST;
        $item = $this->items_model->delete($post);

        if ( $item ){
            $this->output
                ->set_content_type('application/json')
                ->set_output( json_encode( array( 'status' => 'success' ) ) );
        }
    }
}

?>