<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Stocks extends MY_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('stocks_model');
    }

    public function index() {
        $this->load->view('stocks/default');
    }

    public function getStocksGrid() {

        $stocks = $this->stocks_model->getStocksGrid();

        $resultSet['rows'] = $stocks;
        $resultSet['total'] = count($stocks);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultSet) );
    }

    public function saveStock() {

        $post = $_POST;

        $stock = $this->stocks_model->save( $post, $post['stock_id'] );

        if ( $stock ) {
            $this->output
                ->set_content_type('application/json')
                ->set_output( json_encode( array( 'status' => 'success' ) ) );
        }
    }

    public function deleteStock() {

        $post = $_POST;
        $stock = $this->stocks_model->delete($post);

        if ( $stock ){
            $this->output
                ->set_content_type('application/json')
                ->set_output( json_encode( array( 'status' => 'success' ) ) );
        }
    }

    public function dialog($stock_id = 0){

        $stock = $this->stocks_model->getStockById($stock_id);

        $data['stock'] = ($stock) ? $stock : array();

        $this->load->view('stocks/dialog/add', $data);
    }

}

?>