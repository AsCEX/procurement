<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Auth_model extends CI_Model
{
    /**
     * Holds an array of tables used
     *
     * @var array
     **/
    public $tbl_users = "tbl_users";

    public function __construct()
    {
        parent::__construct();
    }

    public function checkUserLogin($username = "", $password = ""){

        $this->db->where('u_username', $username);
        $this->db->where('u_password', $password);

        $rs = $this->db->get($this->tbl_users);

//        echo $this->db->last_query();

        return $rs->result();
    }

}
