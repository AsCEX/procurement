<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Purchased_request_model extends CI_Model
{
    /**
     * Holds an array of tables used
     *
     * @var array
     **/
    public $pr_tbl = "tbl_purchase_requests";
    public $units_tbl = "tbl_units";
    public $categories_tbl = "tbl_categories";
    public $pr_items_tbl = "tbl_purchase_request_items";
    public $pr_item_details_tbl = "tbl_purchase_request_item_details";
    public $pr_item_detail_specs_tbl = "tbl_purchase_request_item_detail_specs";
    public $offices_tbl = "tbl_offices";
    public $users_tbl = "tbl_users";
    public $procurement_schedules_table = "tbl_procurement_plan_schedules";
    public $procurement_plan_table = "tbl_procurement_plans";

    public function __construct()
    {
        parent::__construct();
    }

    public function getPurchasedRequest($id = null){

        $this->db->select("*,
            CONCAT_WS( '-', DATE_FORMAT(pr_created_date, '%y%m'), LPAD(pr_id, 4, 0) ) as pr_code_id,
            pr_id,
            pr_created_date,
            ofc_name as dept_name
        ");
        $this->db->join($this->offices_tbl, "ofc_id = pr_department_id", "left");
        $this->db->join($this->users_tbl, "u_id = pr_requested_by", "left");

        if($id){
            $this->db->where('pr_id', $id);
        }

        $this->db->from($this->pr_tbl);

        $rs = $this->db->get();

        if($id){
            return $rs->row();
        }else{
            return $rs->result();
        }
    }


    public function countRows($where = array()){

        $this->db->select("*");
        $rs = $this->db->get($this->pr_tbl);

        return $rs->num_rows();
    }

    public function getLimitRequest(){

        $this->db->select("*,
            CONCAT_WS( '-', DATE_FORMAT(pr_created_date, '%y%m'), LPAD(pr_id, 4, 0) ) as pr_code_id,
            pr_id,
            pr_created_date,
            ofc_name as dept_name,
            CONCAT_WS(' ', u_firstname, u_lastname) as requested_user
        ");
        $this->db->join($this->offices_tbl, "ofc_id = pr_department_id", "left");
        $this->db->join($this->users_tbl, "u_id = pr_requested_by", "left");

        $rs = $this->db->get($this->pr_tbl);


        return $rs->result();
    }


    public function getRequestById($id = null){

        $this->db->select("*,
            CONCAT_WS( '-', DATE_FORMAT(pr_created_date, '%y%m'), LPAD(pr_id, 4, 0) ) as pr_code_id,
            pr_id,
            pr_created_date,
            ofc_name as dept_name,
            DATE_FORMAT(pr_alobs_date, '%m/%d/%Y') as alobs_date,
            DATE_FORMAT(pr_sai_date, '%m/%d/%Y') as sai_date
        ");
        $this->db->join($this->offices_tbl, "ofc_id = pr_department_id", "left");
        $this->db->join($this->users_tbl, "u_id = pr_requested_by", "left");

        $this->db->where('pr_id', $id);
        $rs = $this->db->get($this->pr_tbl);

        return $rs->row();
    }

    public function getItemsWithPPMP($pr_id = null){
        $this->db->select("pri_id");
        $this->db->where('pri_pr_id', $pr_id);
        $this->db->from($this->pr_items_tbl);
        $rs = $this->db->get();

        $ids = array();
        foreach($rs->result() as $row){
            $ids[] = $row->pri_id;
        }
        return $ids;
    }

    public function getItems($ppmp_id=null, $pr_id = null){
        $this->db->select("*");
        $this->db->where('pri_pr_id', $pr_id);
        $this->db->where('pri_ppmp_id', $ppmp_id);
        $this->db->from($this->pr_items_tbl);
        $rs = $this->db->get();

        return $rs->row();
    }


    public function viewPurchasedRequest($id = null){

        $this->db->select("
            pr_id,
            pr_sai_no,
            pr_sai_date,
            pr_alobs_no,
            pr_alobs_date,
            pr_quarter,
            pr_purpose,
            pr_created_date,
            ofc_name as dept_name,
            CONCAT_WS( '-', DATE_FORMAT(pr_created_date, '%y%m'), LPAD(pr_id, 4, 0) ) as pr_code_id
        ");
        $this->db->from($this->pr_tbl);
        $this->db->where("pr_id", $id);
        $this->db->join($this->offices_tbl, "ofc_id = pr_department_id", "left");

        $rs = $this->db->get();

        return $rs->result();
    }

    public function getPurchaseItems($pr_id)
    {
        $this->db->select("
            pri_id,
            pri_description,
            pri_qty,
            unit_name,
            pri_cost,
            ppmp_description,
            ppmp_qty,
            ppmp_unit,
            ppmp_budget,
            cat_id,
            cat_code,
            cat_description
        ");
        $this->db->from($this->pr_items_tbl);
        $this->db->where("pri_id", $pr_id);
        $this->db->join($this->procurement_plan_table, "ppmp_id = pri_ppmp_id", "left");
        $this->db->join($this->categories_tbl, "cat_id = ppmp_category_id", "left");
        $this->db->join("{$this->units_tbl}", "unit_id = ppmp_unit", "left");

        $rs = $this->db->get();

        return $rs->result();
    }



    public function getItemDetails($pri_id = null){
        $this->db->select("*");
        $this->db->where('prid_pri_id', $pri_id);
        $this->db->from($this->pr_item_details_tbl);
        $rs = $this->db->get();

        return $rs->result_array();
    }


    public function getItemSpecs($prid_id = null){
        $this->db->select("*");
        $this->db->where('prs_prid_id', $prid_id);
        $this->db->from($this->pr_item_detail_specs_tbl);
        $rs = $this->db->get();

        return $rs->result_array();
    }


    public function getRequestItems(){
        $this->db->select("
            *,
            CONCAT_WS( '-', DATE_FORMAT(pr_created_date, '%y%m'), LPAD(pr_id, 4, 0) ) as pr_code_id
        ");

        $this->db->join($this->pr_tbl, "pr_id = pri_pr_id", "left");
        $this->db->join($this->procurement_plan_table, "pri_ppmp_id = ppmp_id", "left");
        $this->db->join("{$this->units_tbl}", "unit_id = ppmp_unit", "left");

        $this->db->from($this->pr_items_tbl);
        $rs = $this->db->get();

        return $rs->result_array();
    }


    public function getRequestItemsById($pr_id = 0){

        $sql = "SELECT
                ppmp_id,
                pri_id,
                pri_pr_id,
                ppmp_code,
                cat_description,
                pri_description as description,
                pri_qty as qty,
                limit_qty,
                pri_cost as item_cost,
                ROUND(pri_cost*pri_qty,2) as tot_cost,
                ROUND((ppmp_budget/max_qty) * limit_qty, 2) as limit_budget,
                unit_name,
                pri_cost as cost,
                max_qty,
                ppmp_budget
                FROM tbl_purchase_request_items
                LEFT JOIN tbl_procurement_plan_schedules ON pri_id = pps_pri_id
                LEFT JOIN tbl_procurement_plans ON pri_ppmp_id = ppmp_id
                LEFT JOIN (
                        SELECT pps_ppmp_id as max_ppmp_id, sum(pps_value) as max_qty  FROM tbl_procurement_plan_schedules GROUP BY pps_ppmp_id
                ) as tbl_max ON max_ppmp_id = pri_ppmp_id
                LEFT JOIN (
                        SELECT pps_ppmp_id as limit_ppmp_id, sum(pps_value) as limit_qty  FROM tbl_procurement_plan_schedules WHERE pps_pri_id IS NOT NULL GROUP BY pps_ppmp_id, pps_pri_id
                ) as tbl_limit ON limit_ppmp_id = pri_ppmp_id
                LEFT JOIN tbl_categories ON cat_id = ppmp_category_id
                LEFT JOIN tbl_units ON unit_id = ppmp_unit
                WHERE pri_pr_id = $pr_id
                GROUP BY pri_id
                ORDER BY cat_id";

        $qry = $this->db->query($sql);

        return $qry->result_array();
    }




    public function countItemRows(){
        $this->db->select("*");
        $this->db->join($this->pr_tbl, "pr_id = pri_pr_id", "left");

        $this->db->from($this->pr_items_tbl);
        $rs = $this->db->get();

        return $rs->num_rows();
    }


    public function savePurchasedRequest($data, $pr_id = null){

        if($pr_id){
            $data['pr_modified_date']  = date('Y-m-d');
            $data['pr_modified_by']    = $this->session->userdata('user_id');
            $this->db->where('pr_id', $pr_id);
            $ppmp = $this->db->update($this->pr_tbl, $data);
            return $pr_id;
        }else{
            $data['pr_created_date']  = date('Y-m-d');
            $data['pr_created_by']    = $this->session->userdata('user_id');
            $ppmp = $this->db->insert($this->pr_tbl, $data);
            return $this->db->insert_id();
        }

    }

    public function saveItems($data, $pri_id = null){

        if($pri_id){
            $this->db->where('pri_id', $pri_id);
            $ppmp = $this->db->update($this->pr_items_tbl, $data);
            return $pri_id;
        }else{
            $ppmp = $this->db->insert($this->pr_items_tbl, $data);
            return $this->db->insert_id();
        }
    }

    public function saveItemDetails($data, $prid_id = null){

        if($prid_id){
            $this->db->where('prid_id', $prid_id);
            $ppmp = $this->db->update($this->pr_item_details_tbl, $data);
            return $prid_id;
        }else{
            $ppmp = $this->db->insert($this->pr_item_details_tbl, $data);
            return $this->db->insert_id();
        }
    }

    public function saveItemSpecs($data, $prs_id = null){

        if($prs_id){
            $this->db->where('prs_id', $prs_id);
            $ppmp = $this->db->update($this->pr_item_detail_specs_tbl, $data);
            return $prs_id;
        }else{
            $ppmp = $this->db->insert($this->pr_item_detail_specs_tbl, $data);
            return $this->db->insert_id();
        }
    }

    public function deleteItem($pri_id = null, $ppmp_id = null){

        $this->db->where('pps_pri_id', $pri_id);
        $this->db->update('tbl_procurement_plan_schedules', array('pps_pri_id' => null));

        $this->db->where('pri_id', $pri_id);
        $this->db->delete($this->pr_items_tbl);
    }


    public function getProcurementPlanPR($pr_id = null, $department = null, $quarter = null, $items = array()){

        $pr_id = $pr_id ? $pr_id : 0;


        $fields = "";
        $fields .= ($pr_id) ? "IF(pri_id,'checked','') as pri_chk," : "";
        $fields .= "
                pri_id,
                ppmp_id,
                ppmp_code,
                cat_description,
                ppmp_description as description,
                COALESCE(sum(pps_value), 0) as qty,
                unit_name,
                GROUP_CONCAT( pps_quarter) as scheds,
                GROUP_CONCAT( pps_value) as sched_values,
                tot_budget.tot_qty,
                ROUND((ppmp_budget/tot_budget.tot_qty),2) as item_cost,
                ROUND((ppmp_budget/tot_budget.tot_qty) * COALESCE(sum(pps_value), 0), 2) as tot_cost,
                ROUND((ppmp_budget/tot_budget.tot_qty) *  COALESCE(sum(pps_value), 0), 2) as cost,
            ";


        $this->db->select($fields);


        $this->db->join($this->units_tbl, "unit_id = ppmp_unit","left");
        $this->db->join('tbl_categories', "cat_id = ppmp_category_id","left");
        $this->db->join($this->procurement_schedules_table, "pps_ppmp_id = ppmp_id","left");
        $this->db->join("(
                    SELECT sum(pps_value) as tot_qty, pps_ppmp_id  FROM tbl_procurement_plan_schedules GROUP BY pps_ppmp_id
        ) as tot_budget","tot_budget.pps_ppmp_id = ppmp_id","left");

        // if($pr_id)
        $this->db->join($this->pr_items_tbl, "pri_ppmp_id = ppmp_id AND pri_pr_id = " . $pr_id, "left");


        if($quarter){
            $q = (($quarter-1) * 3) + 1;
            $this->db->where_in("pps_quarter", array($q, $q+1, $q+2));
        }else{
            $this->db->where_in("pps_quarter", array(0));
        }

        $office = ($department) ? $department : 0;
        $this->db->where("ppmp_office_id" , $department);
/*
        $this->db->where('pps_pri_id IS NULL', null, false);
        $this->db->or_where('pps_pri_id', $pr_id);*/
        if($items){
            $this->db->where_not_in('ppmp_id', $items);
        }


        $this->db->group_by("ppmp_id");
        $this->db->order_by("cat_id");


        $rs = $this->db->get($this->procurement_plan_table);

        return $rs->result();
    }

}
