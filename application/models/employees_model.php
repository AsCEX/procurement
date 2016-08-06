<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employees_model extends CI_Model
{
    /**
     * Holds an array of tables used
     *
     * @var array
     **/
    public $employees_table = "tbl_employees";
    public $users_info_table = "tbl_user_informations";
    public $positions_table = "tbl_positions";

    public function __construct()
    {
        parent::__construct();
    }

    public function getEmployees( $id = null ) {

        $this->db->select("*,
            pos_name,
            ui_firstname,
            ui_middlename,
            ui_lastname,
            ui_extname,
            ui_address,
            ui_birthdate
        ");

        if($id){
            $this->db->where("emp_id", $id);
        }

        $this->db->join($this->users_info_table, "emp_ui_id = ui_id", "left");
        $this->db->join($this->positions_table, "emp_position_id = pos_id", "left");
        $this->db->order_by("ui_lastname", "asc");

        $rs = $this->db->get($this->employees_table);

        return $rs->result();
    }


}