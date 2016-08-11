<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_request extends MY_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('purchased_request_model', 'pr_model');
        $this->load->model('procurement_plan_model', 'ppmp_model');
        $this->load->model('offices_model', 'office_model');
        $this->load->model('categories_model', 'cat_model');
        $this->load->model('units_model');
        $this->load->model('users_model');
        $this->load->model('source_funds_model');
    }



    public function dataGrid(){
        $this->load->view('purchase_request/default');
    }

    public function gridValues(){

        $groups = $this->pr_model->getLimitRequest();
        $rows = $this->pr_model->countRows();

        $resultSet['total'] = $rows;
        $resultSet['rows'] = $groups;

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultSet) );
    }



    public function dialog($pr_id = 0){
        $pr = $this->pr_model->getRequestById($pr_id);

        $data['pr'] = ($pr) ? $pr : array();
        $data['pr_id'] = $pr_id;

        $this->load->view('purchase_request/dialog/add', $data);
    }


    public function dialog_pr_item($pr_id = 0, $department = 0, $quarter = 0){
        $pr = $this->pr_model->getRequestById($pr_id);

        $data['pr'] = ($pr) ? $pr : array();
        $data['department'] = $department;
        $data['quarter'] = $quarter;
        $data['pr_id'] = $pr_id;

        $this->load->view('purchase_request/dialog/add-pr-ppmp', $data);
    }


    public function getRequestItems($pr_id = null){
        $items = array();
        if($pr_id)
            $items = $this->pr_model->getRequestItemsById($pr_id);

        $resultSet['total'] = count($items);
        $resultSet['rows'] = $items;

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultSet) );

    }


    public function getProcurementPlans($department = null, $quarter = null, $pr_id = null){

        $items = json_decode( $this->input->post('items') );



        $ppmp = $this->pr_model->getProcurementPlanPR($pr_id, $department, $quarter, $items);

        $new_ppmp = array();
        foreach($ppmp as $p){
            $temp = (array) $p;
            $scheds = explode(",", $temp['scheds']);
            $sched_values = explode(",", $temp['sched_values']);

            $temp['id'] = $p->ppmp_id;
            for($i=1;$i<=12;$i++){
                $temp['sched_' . $i ] = 0;
            }

            foreach($scheds as $key=>$sched ){
                $temp['sched_' . $sched] = $sched_values[$key];
            }

            $new_ppmp[] = $temp;
        }


        $resultSet['total'] = count($new_ppmp);
        $resultSet['rows'] = $new_ppmp;

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultSet) );

    }

    public function save_request()
    {


        $pr_id = $this->input->post('pr_id');


        $old_pr = ($pr_id) ? true : false;
        $quarter = $this->input->post('pr_quarter');

        $insert = array(
            'pr_department_id' => $this->input->post('pr_department_id'),
            'pr_sai_no' => $this->input->post('pr_sai_no'),
            'pr_sai_date' => (strtotime($this->input->post('pr_sai_date')) > 0) ? date('Y-m-d', strtotime($this->input->post('pr_sai_date') ) ) : '',
            'pr_alobs_no' => $this->input->post('pr_alobs_no'),
            'pr_alobs_date' => (strtotime($this->input->post('pr_alobs_date')) > 0) ? date('Y-m-d', strtotime($this->input->post('pr_alobs_date')) ) : '',
            'pr_quarter' => $quarter,
            'pr_purpose' => $this->input->post('pr_purpose'),
            'pr_section' => $this->input->post('pr_section'),
            'pr_requested_by' => $this->input->post('pr_requested_by')
        );

        $pr_id = $this->pr_model->savePurchasedRequest($insert, $pr_id);

        // Get initial rows, used for deleting request items
        $r_items = $this->pr_model->getRequestItemsById($pr_id);


        $items = json_decode( $this->input->post('pr_item_json') );
        if(!$items){
            $items = array();
        }

        pre_print($items);
        $pri_ids = array();

        foreach($items as $item){
            $item_data = array(
                'pri_pr_id' => $pr_id,
                'pri_ppmp_id'   => $item->ppmp_id,
                'pri_qty'   => $item->qty,
                'pri_description'   => $item->description,
                'pri_cost'  => str_replace(",", "", $item->item_cost)
            );
            if($item->pri_id){
                $pri_ids[] = $item->pri_id;
            }

            $pri_id = $this->pr_model->saveItems($item_data, $item->pri_id);
            $this->ppmp_model->assignPRtoPPMP($pri_id, $item->ppmp_id, $quarter);
        }

        $init_items = array();

        foreach($r_items as $item) {
            $init_items[] = $item['pri_id'];
        }

        $i_cnt = count($init_items);
        $p_cnt = count($pri_ids);

        $deleted_pri = array_merge(array_diff($init_items, $pri_ids), array_diff($pri_ids, $init_items));

        if(count($deleted_pri) < $i_cnt + $p_cnt || count($items) == 0){
            foreach($deleted_pri as $pri_id){
                $this->pr_model->deleteItem($pri_id);
            }
        }
    }
}
