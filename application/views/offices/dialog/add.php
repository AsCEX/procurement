<form id="fm-offices" method="post" novalidate>

    <input type="hidden" name="ofc_id" value="<?php echo ($ofc_id) ? $ofc_id : 0; ?>" />

    <div id="cc" class="easyui-layout" fit="true" style="height:450px;">
        <div data-options="region:'center',title:'Departments'" style="padding:5px;">
            <div class="fitem">
                <label>Initial:</label>
                <input name="ofc_initial" class="easyui-textbox" required="true" align="right" value="<?php echo isset($office->ofc_initial) ? $office->ofc_initial : ""; ?>">
            </div>
            <div class="fitem">
                <label>Code:</label>
                <input name="ofc_code" class="easyui-textbox" required="true" align="right" value="<?php echo isset($office->ofc_code) ? $office->ofc_code : ""; ?>">
            </div>
            <div class="fitem">
                <label>Name:</label>
                <input name="ofc_name" class="easyui-textbox" required="true" align="right" value="<?php echo isset($office->ofc_name) ? $office->ofc_name : ""; ?>">
            </div>
        </div>
    </div>

</form>