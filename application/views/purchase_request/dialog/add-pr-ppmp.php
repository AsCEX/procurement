
<form id="fm" method="post" novalidate>

    <div id="cc" class="easyui-layout">
        <div data-options="region:'center',split:true,hideCollapsedContent:false,fit=true" style="height:345px;">
            <table id="ppmp_pr" title="" class="easyui-datagrid" fit="true"></table>
        </div>
    </div>

</form>

<script>
    $(function(){
        request_items.loadProcurement(<?php echo $pr_id; ?>, <?php echo $department; ?>, <?php echo $quarter; ?> );
    });
</script>