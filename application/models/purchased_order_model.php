<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Purchased_order_model extends CI_Model
{
    /**
     * Holds an array of tables used
     *
     * @var array
     **/
    public $po_tbl = "tbl_purchased_orders";
    public $pr_tbl = "tbl_purchase_requests";
    public $units_tbl = "tbl_units";
    public $categories_tbl = "tbl_categories";
    public $pr_items_tbl = "tbl_purchase_request_items";
    public $pr_item_details_tbl = "tbl_purchase_request_item_details";
    public $pr_item_detail_specs_tbl = "tbl_purchase_request_item_detail_specs";
    public $offices_tbl = "tbl_offices";
    public $users_tbl = "tbl_users";
    public $suppliers_tbl = "tbl_suppliers";
    public $procurement_schedules_table = "tbl_procurement_plan_schedules";
    public $procurement_plan_table = "tbl_procurement_plans";

    public function __construct()
    {
        parent::__construct();
    }

    public function getPurchasedRequest($id = null){

        $this->db->select("*,
            CONCAT_WS( '-', DATE_FORMAT(pr_created_date, '%y%m'), LPAD(po_id, 4, 0) ) as pr_code_id,
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
        $rs = $this->db->get($this->po_tbl);

        return $rs->num_rows();
    }

    public function getLimitOrder($curPage = 1, $rowsPerPage = 10){

        $this->db->select("*,
            CONCAT_WS( '-', DATE_FORMAT(po_created_date, '%y%m'), LPAD(po_id, 4, 0) ) as po_code_id,
            ");
        $this->db->join($this->offices_tbl, "po_department_id = ofc_id", "left");
        $this->db->join($this->suppliers_tbl, "po_department_id = ofc_id", "left");
        $this->db->limit( $rowsPerPage, ($curPage-1) * $rowsPerPage);

        $rs = $this->db->get($this->po_tbl);


        return $rs->result();
    }


    public function getRequestById($id = null){

        $this->db->select("*,
            CONCAT_WS( '-', DATE_FORMAT(pr_created_date, '%y%m'), LPAD(po_id, 4, 0) ) as pr_code_id,
            pr_id,
            pr_created_date,
            ofc_name as dept_name
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

    public function getItems($pri_id = null){
        $this->db->select("*");
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
            CONCAT_WS( '-', DATE_FORMAT(pr_created_date, '%y%m'), LPAD(po_id, 4, 0) ) as pr_code_id
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

    public function deleteItem($pri_id = null){
        $this->db->where('pri_id', $pri_id);
        $this->db->delete($this->pr_items_tbl);
    }


    public function update($data, $id){
        $insert = array(
            'pr_department_id' => $data['office_id'],
            'pr_sai_no'        => $data['sai_no'],
            'pr_sai_date'      => $data['sai_date'],
            'pr_alobs_no'      => $data['alobs_date'],
            'pr_alobs_date'    => $data['alobs_date'],
            'pr_quarter'       => $data['quarter'],
            'pr_purpose'       => $data['purpose'],
            'pr_section'       => $data['section'],
            'pr_modified_date'  => date('Y-m-d'),
            'pr_modified_by'    => $this->session->userdata('user_id')
        );

        $this->db->where('pr_id', $id);
        $ppmp = $this->db->update($this->pr_tbl, $insert); echo $this->db->last_query();

        return $id;
    }

    public function create_purchase_items($data){

        $ppmp = $this->db->insert($this->pr_items_tbl, $data);

        if($ppmp){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    public function update_purchase_items($id, $data){
        if($id){

            $this->db->where('id', $id);
            $this->db->update($this->pr_items_tbl, $data);

            return $id;
        }else{

            $pr_items = $this->db->insert($this->pr_items_tbl, $data);

            if($pr_items){
                return $this->db->insert_id();
            }else{
                return false;
            }
        }
    }


    public function create_item_details($data){

        $pr_details = $this->db->insert($this->pr_item_details_tbl, $data);

        if($pr_details){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    public function update_item_details($pr_item_detail_id, $data){

        if($pr_item_detail_id){

            $this->db->where('pri_id', $pr_item_detail_id);
            $this->db->update($this->pr_item_details_tbl, $data);

        }else{

            $pr_item_details = $this->db->insert($this->pr_item_details_tbl, $data);

            if($pr_item_details){
                return $this->db->insert_id();
            }else{
                return false;
            }
        }

    }

    public function update_item_specs($pr_item_specs_id, $data){

        if($pr_item_specs_id){

            $this->db->where('prs_id', $pr_item_specs_id);
            $this->db->update($this->pr_item_detail_specs_tbl, $data);

        }else{

            $pr_item_details = $this->db->insert($this->pr_item_detail_specs_tbl, $data);

            if($pr_item_details){
                return $this->db->insert_id();
            }else{
                return false;
            }
        }

    }

    public function purgePR($pr_id){
        $items = $this->getPurchaseItems($pr_id);
        $item_ids = array();
        $item_detail_ids = array();
        $item_detail_specs_ids = array();
        foreach($items as $item){
            $item_ids[] = $item->id;

            $details = $this->getPurchaseItemDetails($item->id);
            //pre_print($details);
            foreach($details as $detail){
                $item_detail_ids[] = $detail->id;

                $specs = $this->getPRItemSpecs($detail->id);
                //pre_print($specs);
                foreach($specs as $spec){
                    $item_detail_specs_ids[] = $spec->specs_id;
                }
            }

        }
        if($item_ids)
            //$this->deletePRItems($item_ids);

            if($item_detail_ids)
                $this->deletePRItemDetails($item_detail_ids);

        if($item_detail_specs_ids)
            $this->deletePRItemDetailSpecs($item_detail_specs_ids);
    }


    public function deletePRItems($pr_id){

        if(is_array($pr_id)){
            $this->db->where_in('pri_id', $pr_id);
        }else{
            $this->db->where('pri_id', $pr_id);
        }

        $this->db->delete($this->pr_items_tbl);
    }

    public function deletePRItemDetails($pr_item_id)
    {

        if(is_array($pr_item_id)){
            $this->db->where_in('prid_id', $pr_item_id);
        }else{
            $this->db->where('prid_id', $pr_item_id);
        }


        $this->db->delete($this->pr_item_details_tbl);
    }

    public function deletePRItemDetailSpecs($prid)
    {
        if(is_array($prid)){
            $this->db->where_in('prs_id', $prid);
        }else{
            $this->db->where('prs_id', $prid);
        }

        $this->db->delete($this->pr_item_detail_specs_tbl);
    }

}
