<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Categories_model extends CI_Model
{
    /**
     * Holds an array of tables used
     *
     * @var array
     **/
    public $categories_tbl = "tbl_categories";
    public $sub_categories_tbl = "tbl_sub_categories";

    public function __construct()
    {
        parent::__construct();
    }

    public function getCategories($id = null){

        $this->db->select("*");
        $rs = $this->db->get($this->categories_tbl);

        return $rs->result();
    }


    public function getCategoryById($id = null){

        $this->db->select("*");
        $this->db->where('cat_id', $id);
        $rs = $this->db->get($this->categories_tbl);

        return $rs->row();
    }

    public function countRows($where = array()){

        $this->db->select("*");
        $rs = $this->db->get($this->categories_tbl);

        return $rs->num_rows();
    }

    public function getLimitCategories($curPage = 1, $rowsPerPage = 10){

        $this->db->select("*");
        $this->db->limit( $rowsPerPage, ($curPage-1) * $rowsPerPage);

        $rs = $this->db->get($this->categories_tbl);

        return $rs->result();
    }


    public function save($data, $id = null){

        if($id){

            $this->db->where('cat_id', $id);
            $this->db->update($this->categories_tbl, $data);

            return $id;
        }else{

            $category = $this->db->insert($this->categories_tbl, $data);

            if($category){
                return $this->db->insert_id();
            }else{
                return false;
            }
        }
    }

    public function delete( $data ) {

        $this->db->where("cat_id", $data['cat_id']);
        if ( $this->db->delete( $this->categories_tbl ) ) return TRUE;
        else return FALSE;
    }
}
