<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Offices_model extends CI_Model
{
    /**
     * Holds an array of tables used
     *
     * @var array
     **/
    public $offices_tbl = "tbl_offices";

    public function __construct()
    {
        parent::__construct();
    }

    public function getOffices($id = null){

        $this->db->select("*");
        $rs = $this->db->get($this->offices_tbl);

        return $rs->result();
    }


    public function getOfficeById($id = null){

        $this->db->select("*");
        $this->db->where('ofc_id', $id);
        $rs = $this->db->get($this->offices_tbl);

        return $rs->row();
    }

    public function countRows($where = array()){

        $this->db->select("*");
        $rs = $this->db->get($this->offices_tbl);

        return $rs->num_rows();
    }

    public function getLimitOffices($curPage = 1, $rowsPerPage = 10){

        $this->db->select("*");
        $this->db->limit( $rowsPerPage, ($curPage-1) * $rowsPerPage);

        $rs = $this->db->get($this->offices_tbl);


        return $rs->result();
    }


    public function save($data, $id = null){
        $data = array(
            'ofc_code'   => $data['code'],
            'ofc_initial'   => $data['initial'],
            'ofc_name'          => $data['name'],
        );


        if($id){

            $this->db->where('ofc_id', $id);
            $this->db->update($this->offices_tbl, $data);

            return $id;
        }else{

            $office = $this->db->insert($this->offices_tbl, $data);

            if($office){
                return $this->db->insert_id();
            }else{
                return false;
            }
        }
    }
}
