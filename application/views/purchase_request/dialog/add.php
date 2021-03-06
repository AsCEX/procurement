
<form id="pr-fm" method="post" novalidate>

<input type="hidden" name="pr_id" id="pr_id" value="<?php echo ($pr_id) ? $pr_id : 0; ?>" />
<div id="cc" class="easyui-layout" fit="true" style="height:575px">
    <div data-options="region:'center',title:'Purchase Request',split:true,hideCollapsedContent:false" style="height:300px;">
            <table id="pr_items" title="" fit="true"></table>
    </div>

    <div data-options="region:'west',title:'Details',collapsible:false" style="padding:5px;width:250px;">
            <div class="fitem">
                <label>Department:</label>
                <input id="pr_department" name="pr_department_id" value="<?php echo isset($pr->pr_department_id) ? $pr->pr_department_id : ''; ?>" style="width:200px"/>
            </div>


            <div class="fitem">
                <label>Quarter:</label>
                <input id="quarter" name="pr_quarter" value="<?php echo isset($pr->pr_quarter) ? $pr->pr_quarter : ''; ?>" style="width:200px"/>

            </div>

            <div class="fitem">
                <label>Purpose:</label>
                <input name="pr_purpose" class="easyui-textbox" required="true" multiline="true" style="width:200px;height:100px;" value="<?php echo isset($pr->pr_purpose) ? $pr->pr_purpose : ""; ?>">
            </div>

            <div class="fitem">
                <label>Section:</label>
                <input name="pr_section" class="easyui-textbox" align="right" style="width:200px" value="<?php echo isset($pr->pr_section) ? $pr->pr_section : ''; ?>">
            </div>

            <div class="fitem">
                <label>Requested By:</label>
                <input name="pr_requested_by" class="easyui-numberbox" style="width:200px" align="right" value="<?php echo isset($pr->pr_requested_by) ? $pr->pr_requested_by : ''; ?>">
            </div>


            <div class="fitem">
                <label>SAI No:</label>
                <input name="pr_sai_no" class="easyui-numberbox" align="right" style="width:200px" value="<?php echo isset($pr->pr_sai_no) ? $pr->pr_sai_no : ''; ?>">
            </div>

            <div class="fitem">
                <label>SAI Date:</label>
                <input name="pr_sai_date" id="pr_sai_date" class="easyui-textbox pims_date" style="width:200px" align="right" value="<?php echo isset($pr->sai_date) ? strtotime($pr->sai_date) ? $pr->sai_date : '' : ''; ?>">
            </div>

            <div class="fitem">
                <label>ALOBS No:</label>
                <input name="pr_alobs_no" class="easyui-numberbox" align="right" style="width:200px" value="<?php echo isset($pr->pr_alobs_no) ? $pr->pr_alobs_no : ''; ?>">
            </div>

            <div class="fitem">
                <label>ALOBS Date:</label>
                <input name="pr_alobs_date" id="pr_alobs_date" style="width:200px" class="easyui-textbox pims_date" align="right" value="<?php echo isset($pr->alobs_date) ? strtotime($pr->alobs_date) ? $pr->alobs_date : '' : ''; ?>">
            </div>

            <input type="hidden" id="pr_item_json" name="pr_item_json" value="" />
    </div>
</div>

</form>

<script>
    $(function(){
        purchase_request.initForms();
        request_items.loadRequestItems(<?php echo ($pr_id) ? $pr_id : 0; ?>);
    });
</script>