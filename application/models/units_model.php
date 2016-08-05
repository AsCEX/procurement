<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Units_model extends CI_Model
{
    /**
     * Holds an array of tables used
     *
     * @var array
     **/
    public $units_tbl = "tbl_units";

    public function __construct()
    {
        parent::__construct();
    }

    public function getUnits($id = null){

        $this->db->select("*");
        $rs = $this->db->get($this->units_tbl);

        return $rs->result();
    }


    public function getUnitById($id = null){

        $this->db->select("*");
        $this->db->where('unit_id', $id);
        $rs = $this->db->get($this->units_tbl);

        return $rs->row();
    }

    public function countRows($where = array()){

        $this->db->select("*");
        $rs = $this->db->get($this->units_tbl);

        return $rs->num_rows();
    }

    public function getLimitUnits($curPage = 1, $rowsPerPage = 10){

        $this->db->select("*");
        $this->db->limit( $rowsPerPage, ($curPage-1) * $rowsPerPage);

        $rs = $this->db->get($this->units_tbl);


        return $rs->result();
    }


    public function save($data, $id = null){
        $data = array(
            'unit_name'   => $data['unit_name']
        );


        if($id){

            $this->db->where('unit_id', $id);
            $this->db->update($this->units_tbl, $data);

            return $id;
        }else{

            $office = $this->db->insert($this->units_tbl, $data);

            if($office){
                return $this->db->insert_id();
            }else{
                return false;
            }
        }
    }

}
