<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stocks_model extends CI_Model {

    public $categories_tbl = "tbl_categories";
    public $stocks_tbl = "tbl_stocks";

    public function __construct()
    {
        parent::__construct();
    }

    public function getStocksGrid() {

        $this->db->select("
            cat_description,
            stock_id,
            stock_cat_id,
            stock_description
        ");

        $this->db->join($this->categories_tbl, "cat_id = stock_cat_id", "left");
        $this->db->order_by("cat_description", "asc");

        $rs = $this->db->get($this->stocks_tbl);

        return $rs->result();
    }

    public function getStockById ( $stock_id ) {

        $this->db->select("
            cat_description,
            stock_id,
            stock_cat_id,
            stock_description
        ");

        $this->db->where("stock_id", $stock_id);
        $this->db->join($this->categories_tbl, "cat_id = stock_cat_id", "left");

        $rs = $this->db->get($this->stocks_tbl);

        return $rs->row();
    }

    public function save( $data, $stock_id = null ) {

        if ( $stock_id ) {

            $this->db->where('stock_id', $stock_id);
            $this->db->update($this->stocks_tbl, $data);

            return $stock_id;
        } else {

            $stock = $this->db->insert($this->stocks_tbl, $data);

            if($stock){
                return $this->db->insert_id();
            }else{
                return false;
            }
        }
    }

    public function delete( $data ) {

        $this->db->where("stock_id", $data['stock_id']);
        if ( $this->db->delete( $this->stocks_tbl ) ) return TRUE;
        else return FALSE;
    }

    public function getStocks($id = null){

        $this->db->select("*");
        $rs = $this->db->get($this->stocks_tbl);

        return $rs->result();
    }
}

?>