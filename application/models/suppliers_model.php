<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Suppliers_model extends CI_Model
{
    /**
     * Holds an array of tables used
     *
     * @var array
     **/
    public $suppliers_tbl = "tbl_suppliers";
    public $users_info_table = "tbl_user_informations";

    public function __construct()
    {
        parent::__construct();
    }

    public function getSuppliers($id = null){

        $this->db->select("*");
        $rs = $this->db->get($this->suppliers_tbl);

        return $rs->result();
    }

    public function getSuppliersGrid() {

        $this->db->select("
            ui_id,
            ui_firstname,
            ui_middlename,
            ui_lastname,
            ui_extname,
            ui_address,
            ui_birthdate,
            supp_id,
            supp_business_name,
            supp_address,
            supp_tin
        ");

        $this->db->where("supp_status", 1);
        $this->db->join($this->users_info_table, "supp_ui_id = ui_id", "left");
        $this->db->order_by("ui_lastname", "asc");

        $rs = $this->db->get($this->suppliers_tbl);

        return $rs->result();
    }

    public function getSupplierById($supp_id = null){

        $this->db->select("
            ui_id,
            ui_firstname,
            ui_middlename,
            ui_lastname,
            ui_extname,
            ui_address,
            ui_birthdate,
            supp_id,
            supp_ui_id,
            supp_business_name,
            supp_address,
            supp_tin
        ");

        $this->db->where("supp_id", $supp_id);
        $this->db->join($this->users_info_table, "supp_ui_id = ui_id", "left");
        $this->db->order_by("ui_lastname", "asc");
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


    public function save($data, $supp_id = null, $supp_ui_id = null){

        $ui_id = $this->saveUserInfo($data, $supp_ui_id);

        $supplierData = array(
            'supp_ui_id'            => $ui_id,
            'supp_business_name'    => $data['supp_business_name'],
            'supp_address'          => $data['supp_address'],
            'supp_tin'              => $data['supp_tin'],
            'supp_tin'              => $data['supp_tin'],
            'supp_status'           => 1
        );

        if($supp_id){

            $this->db->where('supp_id', $supp_id);
            $this->db->update($this->suppliers_tbl, $supplierData);

            return $supp_id;
        }else{

            $supplier = $this->db->insert($this->suppliers_tbl, $supplierData);

            if($supplier){
                return $this->db->insert_id();
            }else{
                return false;
            }
        }
    }

    public function saveUserInfo($data, $supp_ui_id = null) {

        $userData = array(
            'ui_firstname'  => $data['ui_firstname'],
            'ui_middlename' => $data['ui_middlename'],
            'ui_lastname'   => $data['ui_lastname'],
            'ui_extname'    => $data['ui_extname'],
            'ui_address'    => $data['ui_address'],
            'ui_birthdate'  => $data['ui_birthdate'],
        );

        if($supp_ui_id) {

            $this->db->where('ui_id', $supp_ui_id);
            $this->db->update($this->users_info_table, $userData);

            return $supp_ui_id;
        } else {

            $userInfo = $this->db->insert($this->users_info_table, $userData);

            if($userInfo){
                return $this->db->insert_id();
            }else{
                return false;
            }
        }
    }

    public function delete( $data ) {

        $supplierData = array(
            'supp_status' => 0
        );

        $this->db->where('supp_id', $data['supp_id']);
        $this->db->update($this->suppliers_tbl, $supplierData);

        return $data['supp_id'];
    }
}
