<form id="fm-units" method="post" novalidate>

    <input type="hidden" name="unit_id" value="<?php echo ($unit_id) ? $unit_id : 0; ?>" />

    <div id="cc" class="easyui-layout" fit="true" style="height:450px;">
        <div data-options="region:'center',title:'Unit'" style="padding:5px;">
            <div class="fitem">
                <label>Name:</label>
                <input name="unit_name" class="easyui-textbox" required="true" align="right" value="<?php echo isset($unit->unit_name) ? $unit->unit_name : ""; ?>">
            </div>
        </div>
    </div>

</form>