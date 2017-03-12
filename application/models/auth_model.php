<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Auth_model extends CI_Model
{
    /**
     * Holds an array of tables used
     *
     * @var array
     **/
    public $tbl_users = "tbl_employees";

    public function __construct()
    {
        parent::__construct();
    }

    public function checkUserLogin($username = "", $password = ""){

        $this->db->where('emp_username', $username);
        $this->db->where('emp_password', $password);

        $this->db->join('tbl_user_informations', 'ui_id = emp_ui_id', 'left');

        $rs = $this->db->get($this->tbl_users);

//        echo $this->db->last_query();

        return $rs->result();
    }

}
