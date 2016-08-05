<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('procurement_plan_model','ppmp_model');
	}

	public function index()
	{
		$this->load->view('welcome_message');
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
			for($i=1;$i<=12;$i++){
				$temp['sched_' . $i ] = 0;
			}

			foreach($scheds as $key=>$sched ){
				$temp['sched_' . $sched] = $sched_values[$key];
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

	public function dialog(){
		$this->load->view('procurement_plans/dialog/add');
	}

}
