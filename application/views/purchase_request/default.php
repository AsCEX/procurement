
<table id="pr-dg" title="Purchase Requests" fit="true"></table>

<div id="dlg" style="width:1100px;height:650px;"></div>
<div id="pr-ppmp-dlg" style="width:1024px;height:420px;"></div>

<div id="edit-pr-item-details-dlg" style="width:460px;height:320px;"></div>


<div id="pr-dg-menu" class="easyui-menu" data-pri="0">
    <div class="menu-links" onclick="purchase_request.editDetails($(this).parent().data('pri'));" >Edit Details</div>
    <div class="menu-links" onclick="" >View Breakdown</div>
    <div class="menu-sep"></div>
    <div class="menu-links" onclick="" >Remove</div>
</div>

<script>
    purchase_request.init();
</script>