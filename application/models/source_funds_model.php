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

        if($id){
            $this->db->where("fund_id", $id);
        }

        $rs = $this->db->get($this->source_funds_tbl);

        return $rs->result();
    }

    public function getFundById( $id ) {

        $fields = "fund_id, fund_name";

        $this->db->select($fields);
        $this->db->where("fund_id", $id);

        $rs = $this->db->get($this->source_funds_tbl);

        return $rs->row();
    }

    public function save($data, $id = null) {

        $insert = array(
            'fund_name' => $data['fund_name']
        );

        if($id){
            $this->db->where('fund_id', $id);
            $this->db->update($this->source_funds_tbl, $insert);

            $funds = $id;
        }else{
            $this->db->insert($this->source_funds_tbl, $insert);
            $funds = $this->db->insert_id();
        }

        return $funds;
    }

}
