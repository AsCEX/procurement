<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Biddings_model extends CI_Model
{
    /**
     * Holds an array of tables used
     *
     * @var array
     **/
    public $biddings_tbl = "tbl_biddings";
    public $suppliers_tbl = "tbl_suppliers";
    public $purchase_requests_tbl = "tbl_purchase_requests";
    public $purchase_request_items_tbl = "tbl_purchase_request_items";

    public function __construct()
    {
        parent::__construct();
    }

    public function getBiddings($id = null){

        $this->db->select("*");
//        $this->db->join($this->suppliers_tbl);
        if($id){
            $this->db->where('bids_id', $id);
        }
        $rs = $this->db->get($this->biddings_tbl);

        return $rs->result();
    }


    public function getCategoryById($id = null){

        $this->db->select("*");
        $this->db->where('cat_id', $id);
        $rs = $this->db->get($this->categories_tbl);

        return $rs->row();
    }


    public function save($data, $id = null){
        $data = array(
            'cat_code'   => $data['code'],
            'cat_description'   => $data['description']
        );


        if($id){

            $this->db->where('cat_id', $id);
            $this->db->update($this->categories_tbl, $data);

            return $id;
        }else{

            $office = $this->db->insert($this->categories_tbl, $data);

            if($office){
                return $this->db->insert_id();
            }else{
                return false;
            }
        }
    }
}
