<form id="fm-employees" method="post" novalidate>

    <input type="hidden" name="emp_id" value="<?php echo isset($employee->emp_id) ? $employee->emp_id : ""; ?>" />
    <input type="hidden" name="emp_ui_id" value="<?php echo isset($employee->emp_ui_id) ? $employee->emp_ui_id : ""; ?>" />

    <div id="cc" class="easyui-layout" fit="true" style="height:450px;">
        <div data-options="region:'center',title:'Supplier Info'" style="padding:5px;">
            <div class="fitem">
                <label>Firstname:</label>
                <input name="ui_firstname" class="easyui-textbox" required="true" align="right" value="<?php echo isset($employee->ui_firstname) ? $employee->ui_firstname : ""; ?>">
            </div>
            <div class="fitem">
                <label>Middle Name:</label>
                <input name="ui_middlename" class="easyui-textbox" required="true" align="right" value="<?php echo isset($employee->ui_middlename) ? $employee->ui_middlename : ""; ?>">
            </div>
            <div class="fitem">
                <label>Lastname:</label>
                <input name="ui_lastname" class="easyui-textbox" required="true" align="right" value="<?php echo isset($employee->ui_lastname) ? $employee->ui_lastname : ""; ?>">
            </div>
            <div class="fitem">
                <label>Ext. Name:</label>
                <input name="ui_extname" class="easyui-textbox" required="true" align="right" value="<?php echo isset($employee->ui_extname) ? $employee->ui_extname : ""; ?>">
            </div>
            <div class="fitem">
                <label>Address:</label>
                <input name="ui_address" class="easyui-textbox" required="true" align="right" multiline="true" style="width: 160px; height: 100px;" value="<?php echo isset($employee->ui_address) ? $employee->ui_address : ""; ?>">
            </div>
            <div class="fitem">
                <label>Birthdate:</label>
                <input name="ui_birthdate" id="emp_ui_birthdate" class="easyui-textbox" required="true" align="right" value="<?php echo isset($employee->ui_birthdate) ? $employee->ui_birthdate : ""; ?>">
            </div>
        </div>
        <div data-options="region:'east',title:'Business Info',split:false,hideCollapsedContent:false" style="padding:5px;width:50%;">
            <div class="fitem">
                <label>Position:</label>
                <select class="easyui-combobox" editable="false" name="emp_position_id" style="width:250px"
                        url="<?php echo site_url('positions/getPositionsComboBox'); ?>/<?php echo isset($employee->emp_position_id) ? $employee->emp_position_id : ''; ?>"
                        method="get"
                        valueField="name"
                        prompt="Select Position"
                        textField="value"
                        required="true">
                </select>
            </div>
            <div class="fitem">
                <label>Username:</label>
                <input name="emp_username" class="easyui-textbox" required="true" align="right" value="<?php echo isset($employee->emp_username) ? $employee->emp_username : ""; ?>">
            </div>
            <div class="fitem">
                <label>Password:</label>
                <input name="emp_password" class="easyui-textbox" required="true" align="right" value="<?php echo isset($employee->emp_password) ? $employee->emp_password : ""; ?>">
            </div>
        </div>
    </div>

</form>
<style>
    #fm-employees .fitem label { width: 122px; }
    #fm-employees .fitem span.combo { width: 160px !important; }
</style>