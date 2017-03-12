<?php

class Positions_model extends CI_Model {

    public $positions_tbl = "tbl_positions";

    public function __construct()
    {
        parent::__construct();
    }

    public function getPositions() {

        $this->db->select("*");
        $rs = $this->db->get($this->positions_tbl);

        return $rs->result();
    }

    public function getPositionById( $id = 0 ) {

        $fields = "pos_id, pos_name";

        $this->db->select($fields);
        $this->db->where("pos_id", $id);

        $rs = $this->db->get($this->positions_tbl);

        return $rs->row();
    }

    public function save( $data, $id = null) {

        $insert = array(
            'pos_name' => $data['pos_name']
        );

        if($id){
            $this->db->where('pos_id', $id);
            $this->db->update($this->positions_tbl, $insert);

            $funds = $id;
        }else{
            $this->db->insert($this->positions_tbl, $insert);
            $funds = $this->db->insert_id();
        }

        return $funds;
    }

    public function delete( $data ) {

        $this->db->where("pos_id", $data['pos_id']);
        if ( $this->db->delete($this->positions_tbl) ) return TRUE;
        else return FALSE;
    }
}