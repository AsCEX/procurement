<form id="fm-employees" method="post" novalidate>

    <input type="hidden" name="emp_id" value="<?php echo isset($employee->emp_id) ? $employee->emp_id : ""; ?>" />
    <input type="hidden" name="emp_ui_id" value="<?php echo isset($employee->emp_ui_id) ? $employee->emp_ui_id : ""; ?>" />

    <div id="cc" class="easyui-layout" fit="true" style="height:450px;">
        <div data-options="region:'center',title:'User Info'" class="user-info" style="padding:5px;">
            <div class="fitem" id="fitem-ui-firstname">
                <label>Firstname:</label>
                <input name="ui_firstname" class="easyui-textbox" required="true" align="right" value="<?php echo isset($employee->ui_firstname) ? $employee->ui_firstname : ""; ?>">
            </div>
            <div class="fitem">
                <label>Middle Name:</label>
                <input name="ui_middlename" class="easyui-textbox" required="true" align="right" value="<?php echo isset($employee->ui_middlename) ? $employee->ui_middlename : ""; ?>">
            </div>
            <div class="fitem" id="fitem-ui-lastname">
                <label>Lastname:</label>
                <input name="ui_lastname" class="easyui-textbox" required="true" align="right" value="<?php echo isset($employee->ui_lastname) ? $employee->ui_lastname : ""; ?>">
            </div>
            <div class="fitem">
                <label>Ext. Name:</label>
                <input name="ui_extname" class="easyui-textbox" align="right" value="<?php echo isset($employee->ui_extname) ? $employee->ui_extname : ""; ?>">
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
        <div data-options="region:'east',title:'Employee Info',split:false,hideCollapsedContent:false" class="emp-info" style="padding:5px;width:75%;">
            <div class="fitem" id="fitem-emp-username">
                <label>Username:</label>
                <span>--------</span>
                <input name="emp_username" type="hidden" value="<?php echo isset($employee->emp_username) ? $employee->emp_username : ""; ?>">
            </div>

            <div class="fitem">
                <label>Office:</label>
                <select class="easyui-combobox" editable="false" name="emp_department_id" id="emp_department_id" style="width:350px"
                        url="<?php echo site_url('offices/getComboboxOffices'); ?>/<?php echo isset($employee->emp_department_id) ? $employee->emp_department_id : ''; ?>"
                        method="get"
                        valueField="name"
                        prompt="Select Office"
                        textField="value"
                        required="true">
                </select>
                <a href="javascript:offices.quickMenu('ppmp_office_id');" id="quick-menu" class="offices"><i class="fa fa-external-link-square"></i></a>
            </div>

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
        </div>
    </div>

</form>

<?php if(!isset($employee->emp_id)){ ?>
<script>
    $(function(){

        $(document).on('change', 'form#fm-employees .user-info .fitem:first-of-type span input:first-child, form#fm-employees .user-info .fitem:nth-of-type(3) span input:first-child', function() {

            if ( $("#fitem-ui-lastname span input:first-child").val().length > 1 &&  $("#fitem-ui-firstname span input:first-child").val() != "" ) {

                var firstname = $("#fitem-ui-firstname span input:first-child").val().charAt(0),
                    lastname = $("#fitem-ui-lastname span input:first-child").val();

                var lastnameLength = lastname.split(" ").length;

                if ( lastnameLength > 1 ) {
                    var spaceChar = lastname.indexOf(" ");
                    lastname = lastname.substring(0, spaceChar);
                }

                var username = firstname + lastname;
                username = username.toLowerCase();


                $.post( site_url + 'employees/checkUsername', { username: username }, function(response) {

                    if ( Object.keys(response.result).length > 0 ) {
                        assignUsername ( username + (Object.keys(response.result).length + 1) );
                    } else {
                        assignUsername( username );
                    }
                }, 'json');
            }
        });

        function assignUsername ( username ) {

            $("#fitem-emp-username span").html( username );
            $("input[name='emp_username']").val( username )

            return false;
        }
    });
</script>
<?php } ?>