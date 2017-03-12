<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quarter extends MY_Controller {


    public function __construct(){
        parent::__construct();
    }

    public function getQuarter($selected = 0)
    {

        $quarter_data = array();
        for($i = 1; $i<=4; $i++){
            $temp = array(
                'name'  => $i,
                'value' => 'Quarter ' . $i
            );

            if($selected == $i){
                $temp['selected'] = true;
            }

            $quarter_data[] = $temp;
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($quarter_data) );
    }

}
