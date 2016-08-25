<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Procurement and Inventory Management System</title>

    <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/css/bootstrap.scaffolding.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/css/font-awesome.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/css/themes/black/easyui.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/css/themes/icon.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/css/main.css') ?>">
    <style>
        body{
            visibility: hidden;
        }
        a.easyui-linkbutton.l-btn.l-btn-large {
            margin: 5px 0;
        }
    </style>
    <script type="text/javascript">
        var site_url = "<?php echo site_url(); ?>";
    </script>

</head>

<body class="easyui-layout">
<div region="south" split="false" style="height:30px;line-height:20px;">
    <div class="easyui-layout" fit="true">
        <div region="west" split="false" width="20%" style="padding:0 5px;"><?php echo $this->session->userdata('u_firstname') . " " . $this->session->userdata('u_lastname'); ?></div>
        <div region="center" split="false" style="padding:0 5px;">asdf</div>
        <div region="east" split="false" width="20%" style="padding:0 5px;"><span id="system-clock" style="float:right;"></span></div>
    </div>
</div>


<div data-options="region:'center',title:'Procurement and Inventory Management System'">

    <div class="easyui-layout" fit="true" style="height:250px;">
        <div region="north" style="height:32px;">

            <div id="mm" style="padding:2px 5px;">
                <a href="" class="easyui-linkbutton" data-options="plain:true">Home</a>
                <a href="" class="easyui-menubutton" data-options="plain:true,menu:'#mm1'">Transactions</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" data-options="plain:true">Bids &amp; Awards</a>
                <a href="#" class="easyui-menubutton" data-options="plain:true,menu:'#inventory'">Inventory</a>
                <a href="#" class="easyui-menubutton" data-options="plain:true,menu:'#setup'">Setup</a>
            </div>

            <div id="mm1" style="width:250px;">
                <div onclick="javascript:routes.procurement_plan()" >Procurement Plans</div>
                <div onclick="javascript:routes.purchase_request()" >Purchase Requests</div>
                <div onclick="javascript:routes.underconstruction()" >Purchase Orders</div>
            </div>

            <div id="inventory" style="width:250px;">
                <div onclick="javascript:routes.categories()">Categories</div>
                <div onclick="javascript:routes.categories()">Sub Categories</div>
                <div class="menu-sep"></div>
                <div onclick="javascript:routes.inventories()" >Stocks</div>
            </div>


            <div id="setup" style="width:150px;">
                <div onclick="javascript:routes.employees()">Employees</div>
                <div onclick="javascript:routes.suppliers()">Suppliers</div>
                <div onclick="javascript:routes.positions()">Positions</div>
                <div onclick="javascript:routes.offices()">Departments</div>
                <div class="menu-sep"></div>
                <div onclick="javascript:routes.funds()">Source Funds</div>
                <div class="menu-sep"></div>
                <div onclick="javascript:routes.units()">Units</div>
            </div>


        </div>



        <div region="center">
            <div id="main-content" class="easyui-panel" title="" fit="true" border="false" style="" ></div>
        </div>
    </div>


</div>
<div id="misc"></div>

<script type="text/javascript" src="<?php echo site_url('app/clock.js') ?>"></script>

<script type="text/javascript" src="<?php echo site_url('assets/js/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/plugins/jquery.maskedinput.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/jquery.easyui.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/jquery.edatagrid.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/easyloader.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/plugins/accounting.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('app/router.js') ?>"></script>


<script type="text/javascript" src="<?php echo site_url('app/procurement_plan.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('app/purchase_request.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('app/purchase_request_item.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('app/offices.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('app/categories.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('app/units.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('app/funds.js') ?>"></script>



<script type="text/javascript">
    $(document).ready(function(){
        setTimeout(showBody, 100);
        clock();
    });

    function showBody(){
        $('body').css('visibility', 'visible');
    }
</script>

</body>

</html>