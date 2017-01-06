<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class procurement_plan extends CI_Controller {


    public function __construct(){
        parent::__construct();
        $this->load->model('procurement_plan_model','ppmp_model');
    }

    public function index(){

        $month = $this->config->item('pim_months');
        foreach($month as $m){
            pre_print($m);
        }
    }

    public function saveProcurementPlan(){

        $post = $_POST;

        $ppmp_id = $this->ppmp_model->save($post, $post['ppmp_id']);


        if($ppmp_id){
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('status'=>'success', 'lastid' => $ppmp_id )) );
        }

    }

    public function procPlan(){
        $this->load->view('procurement_plans/default');
    }


    public function getProcurementPlans(){

        $page = (isset($_GET['page']) && $_GET['page'] != 'undefined' ) ? $_GET['page'] : 1;

        $pr_id = $this->input->get('pr_id');
        $where = array(
            'office' => $this->input->get('office'),
            'quarter' => $this->input->get('quarter')
        );


        $ppmp = $this->ppmp_model->getLimitProcurementPlan($pr_id, $where, $page);
        $rows = $this->ppmp_model->countRows();
        $new_ppmp = array();

        foreach($ppmp as $p){
            $temp = (array) $p;
            $scheds = explode(",", $temp['scheds']);
            $sched_values = explode(",", $temp['sched_values']);

            $temp['id'] = $p->ppmp_id;
            for($i=1;$i<=4;$i++){
                $temp['sched_' . $i ] = 0;
            }

            foreach($scheds as $key=>$sched ){
                $temp['sched_' . $sched] = number_format($sched_values[$key], 2);
            }

            $new_ppmp[] = $temp;
        }

        //$info = ['totalRecords'=> $rows, 'recordCount'=> count($new_ppmp), 'currentPage'=>$page, 'totalPages'=>ceil($rows/10)];
        $resultSet['total'] = $rows;
        $resultSet['rows'] = $new_ppmp;

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultSet) );

    }


    public function dialog($ppmp_id = 0){
        $ppmp = $this->ppmp_model->getProcurementPlanById($ppmp_id);
        $ppmp_sched = $this->ppmp_model->getProcurementSchedule($ppmp_id);

        $data['ppmp'] = ($ppmp) ? $ppmp : array();
        $data['ppmp_sched'] = ($ppmp_sched) ? $ppmp_sched : array();
        $data['ppmp_id'] = $ppmp_id;

        $this->load->view('procurement_plans/dialog/add', $data);
    }

    public function schedules($ppmp_id=0){
        $scheds = $this->ppmp_model->getSchedules($ppmp_id);

        $quarters = $this->config->item('quarters');

        $ppmp_scheds = array();
        // Loop by quarter
        foreach($quarters as $q=>$quarter){
            // Loop quarter by months
            foreach($quarter as $key=>$value){
                // Loop of scheds from database
                $temp = 0;
                foreach($scheds as $sched){
                    if($key == $sched->pps_month){
                        $temp = $sched->pps_value;
                        break;
                    }
                }

                $ppmp_scheds[] = array(
                    'name'  => $value,
                    'value' => $temp,
                    'group' => 'Quarter ' . ($q+1),
                    'editor'=> array(
                                'type' => 'numberbox',
                                'options'   => array(
                                    'required'  => true,
                                    'align' => 'right',
                                    'min'   => 0,
                                    'precision' => 2
                                )
                            )
                );
            }

        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($ppmp_scheds) );
    }

}
