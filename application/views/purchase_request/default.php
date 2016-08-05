<script type="text/javascript" src="<?php echo site_url('app/purchase_request.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('app/purchase_request_item.js') ?>"></script>
<table id="dg" title="Purchase Requests" class="easyui-datagrid" fit="true"></table>
<div id="dlg" style="width:850px;height:650px;"></div>
<div id="pr-ppmp-dlg" style="width:612px;height:420px;"></div>
<script>
    purchase_request.init();
</script>