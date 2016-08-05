<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Suppliers_model extends CI_Model
{
    /**
     * Holds an array of tables used
     *
     * @var array
     **/
    public $suppliers_tbl = "tbl_suppliers";

    public function __construct()
    {
        parent::__construct();
    }

    public function getSuppliers($id = null){

        $this->db->select("*");
        $rs = $this->db->get($this->suppliers_tbl);

        return $rs->result();
    }


    public function getSupplierById($id = null){

        $this->db->select("*");
        $this->db->where('id', $id);
        $rs = $this->db->get($this->suppliers_tbl);

        return $rs->row();
    }

    public function countRows($where = array()){

        $this->db->select("*");
        $rs = $this->db->get($this->suppliers_tbl);

        return $rs->num_rows();
    }

    public function getLimitSuppliers($curPage = 1, $rowsPerPage = 10){

        $this->db->select("*");
        $this->db->limit( $rowsPerPage, ($curPage-1) * $rowsPerPage);

        $rs = $this->db->get($this->suppliers_tbl);


        return $rs->result();
    }


    public function save($data, $id = null){
        $data = array(
            'business_name'   => $data['business_name'],
            'first_name'   => $data['first_name'],
            'middle_name'   => $data['middle_name'],
            'last_name'   => $data['last_name'],
            'ext_name'   => $data['ext_name'],
            'address'   => $data['address'],
        );


        if($id){

            $this->db->where('id', $id);
            $this->db->update($this->suppliers_tbl, $data);

            return $id;
        }else{

            $office = $this->db->insert($this->suppliers_tbl, $data);

            if($office){
                return $this->db->insert_id();
            }else{
                return false;
            }
        }
    }
}
