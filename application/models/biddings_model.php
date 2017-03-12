<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Biddings_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getBiddings($id = null){

        $this->db->select("*,
        CONCAT_WS( '-', DATE_FORMAT(pr_created_date, '%y%m'), LPAD(pr_id, 4, 0) ) as pr_code_id");
        $this->db->join('tbl_suppliers', 'bids_supp_id = supp_id', 'left');
        $this->db->join('tbl_user_informations', 'supp_ui_id = ui_id', 'left');
        $this->db->join('tbl_purchase_request_items', 'bids_pri_id = pri_id', 'left');
        $this->db->join('tbl_purchase_requests', 'pri_pr_id = pr_id', 'left');
        if($id){
            $this->db->where('bids_id', $id);
        }
        $rs = $this->db->get('tbl_biddings');

        return $rs->result();
    }

}
