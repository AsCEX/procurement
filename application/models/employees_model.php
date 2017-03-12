<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define("DEFAULT_PASSWORD", 12345678);

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
            ui_birthdate,
            emp_id,
            emp_ui_id,
            emp_position_id,
            emp_username,
            emp_password
        ");

        if($id){
            $this->db->where("emp_id", $id);
        }

        $this->db->where( "emp_status", 1 );
        $this->db->join($this->users_info_table, "emp_ui_id = ui_id", "left");
        $this->db->join($this->positions_table, "emp_position_id = pos_id", "left");
        $this->db->order_by("ui_lastname", "asc");

        $rs = $this->db->get($this->employees_table);

        return $rs->result();
    }

    public function getEmployeeById( $emp_id ) {

        $this->db->select("*,
            pos_name,
            ui_firstname,
            ui_middlename,
            ui_lastname,
            ui_extname,
            ui_address,
            ui_birthdate,
            emp_id,
            emp_ui_id,
            emp_position_id,
            emp_username,
            emp_password
        ");

        $this->db->where("emp_id", $emp_id);
        $this->db->join($this->users_info_table, "emp_ui_id = ui_id", "left");
        $this->db->join($this->positions_table, "emp_position_id = pos_id", "left");
        $this->db->order_by("ui_lastname", "asc");

        $rs = $this->db->get($this->employees_table);

        return $rs->row();
    }

    public function save( $data, $emp_id = null, $emp_ui_id = null) {

        $ui_id = $this->saveUserInfo($data, $emp_ui_id);

        $data = array(
            'emp_ui_id'         => $ui_id,
            'emp_department_id'   => $data['emp_department_id'],
            'emp_position_id'   => $data['emp_position_id'],
            'emp_username'      => $data['emp_username'],
            'emp_password'      => md5(DEFAULT_PASSWORD),
            'emp_status'        => 1
        );

        if ( $emp_id ) {

            $this->db->where("emp_id", $emp_id);
            $this->db->update($this->employees_table, $data);

            return $emp_id;

        } else {

            $employee = $this->db->insert($this->employees_table, $data);

            if ( $employee ) {
                return $this->db->insert_id();
            } else {
                return false;
            }
        }
    }

    public function saveUserInfo($data, $emp_ui_id = null) {

        $userData = array(
            'ui_firstname'  => $data['ui_firstname'],
            'ui_middlename' => $data['ui_middlename'],
            'ui_lastname'   => $data['ui_lastname'],
            'ui_extname'    => $data['ui_extname'],
            'ui_address'    => $data['ui_address'],
            'ui_birthdate'  => $data['ui_birthdate'],
        );

        if ( $emp_ui_id ) {

            $this->db->where('ui_id', $emp_ui_id);
            $this->db->update($this->users_info_table, $userData);

            return $emp_ui_id;

        } else {

            $userInfo = $this->db->insert($this->users_info_table, $userData);

            if ( $userInfo ){
                return $this->db->insert_id();
            } else {
                return false;
            }
        }
    }

    public function delete( $data ) {

        $this->db->set( "emp_status", 0 );
        $this->db->where( "emp_id", $data['emp_id'] );
        $this->db->update( $this->employees_table );

        if ( $this->db->affected_rows() > 0 ) return TRUE;
        else return FALSE;
    }

    public function checkUsername( $username ) {

        $this->db->like('emp_username', $username, 'after');
        $res = $this->db->get($this->employees_table);

        return $res->result();
    }


}