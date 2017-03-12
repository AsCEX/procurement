<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Items_model extends CI_Model {

    public $tbl_items = "tbl_items";
    public $tbl_stocks = "tbl_stocks";

    public function __construct()
    {
        parent::__construct();
    }

    public function getItemsGrid() {

        $this->db->select("
            item_id,
            item_stock_id,
            item_description,
            stock_description
        ");

        $this->db->join($this->tbl_stocks, "stock_id = item_stock_id", "left");

        $rs = $this->db->get($this->tbl_items);

        return $rs->result();
    }

    public function getItemById ( $item_id ) {

        $this->db->select("
            item_id,
            item_stock_id,
            item_description,
            stock_description
        ");

        $this->db->where("item_id", $item_id);
        $this->db->join($this->tbl_stocks, "stock_id = item_stock_id", "left");

        $rs = $this->db->get($this->tbl_items);

        return $rs->row();
    }

    public function save( $data, $item_id = null ) {

        if ( $item_id ) {

            $this->db->where("item_id", $item_id);
            $this->db->update($this->tbl_items, $data);

            return $item_id;
        } else {

            if ( $this->db->insert($this->tbl_items, $data) ) return $this->db->insert_id();
            else return FALSE;
        }
    }

    public function delete( $data ) {

        $this->db->where("item_id", $data['item_id']);
        if ( $this->db->delete( $this->tbl_items ) ) return TRUE;
        else return FALSE;
    }
}

?>