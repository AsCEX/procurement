<?php

class MY_Controller extends CI_Controller {

    public $sidebar;

    function __construct()
    {
        parent::__construct();

        //$this->load->library(array('ion_auth','form_validation'));
        $this->load->helper(array('url','language'));

        if(!$this->session->userdata('u_id'))
            redirect('auth/login');


        $this->load->model('access_lists_model', 'acl_model');


        //$this->output->enable_profiler(TRUE);
        /*$class = $this->uri->segment(1);
        $group_id = $this->session->userdata('office');
        $canAccess = $this->acl_model->canAccess($group_id, $class);

        if(!$canAccess && $class != "" && $class != 'access_lists' ){
            redirect('access_lists/restricted');
        }

        $this->sidebar['menu'] = $this->sidebar_menu();
        $this->sidebar['class'] = $class;
        $this->sidebar['method'] = $this->uri->segment(2);*/
    }


    public function sidebar_menu(){

        $menu = array(
            array(
                'icon_class'    => 'fa-calendar',
                'label'         => 'Transactions',
                'id'            => 'procurement_plan|purchased_order|purchased_request',
                'items'         => array(
                                        array(
                                            'url' => site_url('procurement_plan'),
                                            'label' => 'Procurement Plans',
                                            'id'    => 'procurement_plan'
                                        ),
                                        array(
                                            'url' => site_url('purchased_request'),
                                            'label' => 'Purchased Requests',
                                            'id'    => 'purchased_request'
                                        ),
                                        array(
                                            'url' => site_url('purchased_order'),
                                            'label' => 'Purchased Orders',
                                            'id'    => 'purchased_order'
                                        ),
                                    )
            ),
            /*array(
                'icon_class'    => 'fa-list-alt',
                'label'         => 'Purchase Requests',
                'id'            => 'purchased_request',
                'items'         => array(
                                        array(
                                            'url' => site_url('purchased_request'),
                                            'label' => 'Purchase Request List',
                                            'id'    => ''
                                        ),
                                        array(
                                            'url' => site_url('purchased_request/create'),
                                            'label' => 'Add PR',
                                            'id'    => 'create'
                                        ),
                                    )
            ),
            array(
                'icon_class'    => 'fa-th-list',
                'label'         => 'Purchase Orders',
                'id'            => 'purchased_order',
                'items'         => array()
            ),*/

            array(
                'icon_class'    => 'fa-cubes',
                'label'         => 'Inventory',
                'id'            => 'inventory',
                'items'         => array(
                    array(
                        'url' => site_url('inventory'),
                        'label' => 'ARE',
                        'id'    => 'inventory'
                    ),
                    array(
                        'url' => site_url('groups'),
                        'label' => 'PRS',
                        'id'    => 'inventory'
                    )
                )
            ),
            array(
                'icon_class'    => 'fa-users',
                'label'         => 'Users',
                'id'            => 'users|groups',
                'items'         => array(
                        array(
                            'url' => site_url('users'),
                            'label' => 'User List',
                            'id'    => 'users'
                        ),
                        array(
                            'url' => site_url('groups'),
                            'label' => 'Groups',
                            'id'    => 'groups'
                        )
                    )
            ),
            array(
                'icon_class'    => 'fa-gears',
                'label'         => 'Settings',
                'id'            => 'settings|categories|suppliers|offices|units',
                'items'         => array(
                    array(
                        'url' => site_url('categories'),
                        'label' => 'Categories',
                        'id'    => 'categories'
                    ),
                    array(
                        'url' => site_url('suppliers'),
                        'label' => 'Suppliers',
                        'id'    => 'suppliers'
                    ),
                    array(
                        'url' => site_url('offices'),
                        'label' => 'Offices',
                        'id'    => 'offices'
                    ),
                    array(
                        'url' => site_url('units'),
                        'label' => 'Units',
                        'id'    => 'units'
                    ),
                )
            ),
        );
        return $menu;
    }

}