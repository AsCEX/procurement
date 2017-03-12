<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Inventory_model extends CI_Model
{
    /**
     * Holds an array of tables used
     *
     * @var array
     **/
    public $procurement_plan_table = "tbl_procurement_plans";
    public $procurement_schedules_table = "tbl_procurement_schedules";

    public function __construct()
    {
        parent::__construct();
    }

    public function getProcurementPlan($id = null){

        $this->db->select("
            {$this->procurement_plan_table}.id as ppmp_id,
            {$this->procurement_plan_table}.code,
            {$this->procurement_plan_table}.description,
            {$this->procurement_plan_table}.qty,
            {$this->procurement_plan_table}.unit,
            {$this->procurement_plan_table}.budget,
            GROUP_CONCAT( {$this->procurement_schedules_table}.month) as scheds,
            GROUP_CONCAT( {$this->procurement_schedules_table}.value) as sched_values
        ");

        $this->db->join("{$this->procurement_schedules_table}","{$this->procurement_schedules_table}.ppmp_id = {$this->procurement_plan_table}.id","left");
        $this->db->group_by("{$this->procurement_plan_table}.id");
        $rs = $this->db->get($this->procurement_plan_table);

        return $rs->result();
    }

}
