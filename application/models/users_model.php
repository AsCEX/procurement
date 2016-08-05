<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Users_model extends CI_Model
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

    public function getUsers($id = null){

        $this->db->select("*,
            GROUP_CONCAT( grp_description SEPARATOR ' | ') as user_roles
        ");
        $this->db->join($this->users_group_table, "{$this->users_group_table}.user_id = u_id", "left");
        $this->db->join($this->groups_table, "grp_id = u_grp_id", "left");
        $this->db->join($this->office_table, "ofc_id = u_department_id", "left");
        $this->db->group_by("u_id");

        $rs = $this->db->get($this->users_table);

        return $rs->result();
    }



    public function getUserById($id = null){

        $this->db->select("*");
        $this->db->join($this->groups_table, "grp_id = u_grp_id", "left");
        $this->db->join($this->office_table, "ofc_id = u_department_id", "left");
        $this->db->where('u_id', $id);
        $rs = $this->db->get($this->users_table);

        return $rs->row();
    }

    public function countRows($where = array()){

        $this->db->select("*");
        $rs = $this->db->get($this->users_table);

        return $rs->num_rows();
    }

    public function getLimitUsers($curPage = 1, $rowsPerPage = 10){

        $this->db->select("*");
        $this->db->join($this->groups_table, "grp_id = u_grp_id", "left");
        $this->db->join($this->office_table, "ofc_id = u_department_id", "left");
        $this->db->limit( $rowsPerPage, ($curPage-1) * $rowsPerPage);

        $rs = $this->db->get($this->users_table);


        return $rs->result();
    }


    public function save($data, $id = null){

        if($id){

            $this->db->where('u_id', $id);
            $this->db->update($this->users_table, $data);

            return $id;
        }else{

            $office = $this->db->insert($this->users_table, $data);

            if($office){
                return $this->db->insert_id();
            }else{
                return false;
            }
        }
    }

}
