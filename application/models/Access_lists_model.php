<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Access_lists_model extends CI_Model
{
    /**
     * Holds an array of tables used
     *
     * @var array
     **/
    public $access_table = "tbl_access_lists";


    public function __construct()
    {
        parent::__construct();
    }

    public function canAccess($group_id = null, $class=""){

        $this->db->select("*");
        $this->db->where('group_id', $group_id);
        $this->db->where('class', $class);
        $rs = $this->db->get($this->access_table);

        return $rs->num_rows();
    }

}
