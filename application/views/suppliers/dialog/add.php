<form id="fm-suppliers" method="post" novalidate>

    <input type="hidden" name="supp_id" value="<?php echo ($supp_id) ? $supp_id : ""; ?>" />
    <input type="hidden" name="supp_ui_id" value="<?php echo ($supp_ui_id) ? $supp_ui_id : ""; ?>" />

    <div id="cc" class="easyui-layout" fit="true" style="height:450px;">
        <div data-options="region:'center',title:'Supplier Info'" style="padding:5px;">
            <div class="fitem">
                <label>Firstname:</label>
                <input name="ui_firstname" class="easyui-textbox" required="true" align="right" value="<?php echo isset($supplier->ui_firstname) ? $supplier->ui_firstname : ""; ?>">
            </div>
            <div class="fitem">
                <label>Middle Name:</label>
                <input name="ui_middlename" class="easyui-textbox" required="true" align="right" value="<?php echo isset($supplier->ui_middlename) ? $supplier->ui_middlename : ""; ?>">
            </div>
            <div class="fitem">
                <label>Lastname:</label>
                <input name="ui_lastname" class="easyui-textbox" required="true" align="right" value="<?php echo isset($supplier->ui_lastname) ? $supplier->ui_lastname : ""; ?>">
            </div>
            <div class="fitem">
                <label>Ext. Name:</label>
                <input name="ui_extname" class="easyui-textbox" required="true" align="right" value="<?php echo isset($supplier->ui_extname) ? $supplier->ui_extname : ""; ?>">
            </div>
            <div class="fitem">
                <label>Address:</label>
                <input name="ui_address" class="easyui-textbox" required="true" align="right" multiline="true" style="width: 160px; height: 100px;" value="<?php echo isset($supplier->ui_address) ? $supplier->ui_address : ""; ?>">
            </div>
            <div class="fitem">
                <label>Birthdate:</label>
                <input name="ui_birthdate" id="supp_ui_birthdate" class="easyui-textbox" required="true" align="right" value="<?php echo isset($supplier->ui_birthdate) ? $supplier->ui_birthdate : ""; ?>">
            </div>
        </div>
        <div data-options="region:'east',title:'Business Info',split:false,hideCollapsedContent:false" style="padding:5px;width:50%;">
            <div class="fitem">
                <label>Business Name:</label>
                <input name="supp_business_name" class="easyui-textbox" required="true" align="right" value="<?php echo isset($supplier->supp_business_name) ? $supplier->supp_business_name : ""; ?>">
            </div>
            <div class="fitem">
                <label>Business Address:</label>
                <input name="supp_address" class="easyui-textbox" required="true" align="right" multiline="true" style="width: 160px; height: 100px;" value="<?php echo isset($supplier->supp_address) ? $supplier->supp_address : ""; ?>">
            </div>
            <div class="fitem">
                <label>TIN:</label>
                <input name="supp_tin" class="easyui-textbox" required="true" align="right" value="<?php echo isset($supplier->supp_tin) ? $supplier->supp_tin : ""; ?>">
            </div>
        </div>
    </div>

</form>
<style>
    .suppliers .fitem label { width: 122px; }
</style>