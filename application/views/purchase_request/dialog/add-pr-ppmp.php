
<form id="pri-fm" method="post" novalidate>

    <div id="cc" class="easyui-layout" fit="true" style="height:345px;">
        <div data-options="region:'center',split:true">
            <table id="ppmp_pr" title="" class="easyui-datagrid" fit="true"></table>
        </div>
    </div>

</form>

<script>
    $(function(){
        request_items.loadProcurement(<?php echo $pr_id; ?>, <?php echo $department; ?>, <?php echo $quarter; ?> );
    });
</script>