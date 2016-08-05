<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Source_funds_model extends CI_Model
{
    /**
     * Holds an array of tables used
     *
     * @var array
     **/
    public $source_funds_tbl = "tbl_source_funds";

    public function __construct()
    {
        parent::__construct();
    }

    public function getFunds($id = 0){

        $this->db->select("*");
        //$this->db->where('fund_id', $id);
        $rs = $this->db->get($this->source_funds_tbl);

        return $rs->result();
    }

}
