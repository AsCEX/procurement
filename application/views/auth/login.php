<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Procurement and Inventory Management System</title>

    <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/css/bootstrap.scaffolding.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/css/themes/black/easyui.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/css/themes/icon.css') ?>">

    <script type="text/javascript" src="<?php echo site_url('assets/js/jquery.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('assets/js/jquery.easyui.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('assets/js/easyloader.js') ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('assets/js/plugins/accounting.min.js') ?>"></script>

    <script type="text/javascript">
        var site_url = "<?php echo site_url(); ?>";
    </script>

</head>

<body class="easyui-layout">

<div data-options="region:'center',title:'Procurement and Inventory Management System'">

    <div id="dlg" class="easyui-dialog" style="padding:50px;width:300px;height:300px;"
         closable="false"
         modal="true"
         title="System Login"
         buttons="#dlg-buttons">
        <form id="fm-login" method="post">
            <div class="fitem">
                <label style="width:300px;">Username:</label>
                <input name="u_username" class="easyui-textbox" required="true" align="right">
            </div>

            <div class="fitem">
                <label style="width:300px;">Password:</label>
                <input name="u_password" class="easyui-textbox" required="true" align="right" type="password">
            </div>

        </form>

    </div>

    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="pim_login.login()" style="width:90px">Login</a>
    </div>
</div>

<script type="text/javascript">
    using(site_url + 'app/login.js', function(){

    });
</script>

</body>
</html>