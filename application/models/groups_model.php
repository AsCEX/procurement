<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Groups_model extends CI_Model
{
    /**
     * Holds an array of tables used
     *
     * @var array
     **/
    public $users_table = "tbl_users";
    public $users_group_table = "tbl_users_groups";
    public $groups_table = "tbl_groups";
    public $office_table = "tbl_offices";

    public function __construct()
    {
        parent::__construct();
    }

    public function getGroups($where = array()){

        $this->db->select("*");
        $rs = $this->db->get($this->groups_table);

        return $rs->result();
    }
    public function getGroupsById($id = null){

        $this->db->select("*");
        $this->db->where('grp_id', $id);
        $rs = $this->db->get($this->groups_table);

        return $rs->row();
    }

    public function countRows($where = array()){

        $this->db->select("*");
        $rs = $this->db->get($this->groups_table);

        return $rs->num_rows();
    }

    public function getLimitGroups($curPage = 1, $rowsPerPage = 10){

        $this->db->select("*");
        $this->db->limit( $rowsPerPage, ($curPage-1) * $rowsPerPage);

        $rs = $this->db->get($this->groups_table);


        return $rs->result();
    }


    public function save($data, $id = null){
        $data = array(
            'grp_name'          => $data['name'],
            'grp_description'   => $data['description']
        );


        if($id){

            $this->db->where('grp_id', $id);
            $this->db->update($this->groups_table, $data);

            return $id;
        }else{

            $group = $this->db->insert($this->groups_table, $data);

            if($group){
                return $this->db->insert_id();
            }else{
                return false;
            }
        }
    }
}
