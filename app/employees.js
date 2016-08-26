
var employees = {
    
    init: function() {
        this.datagrid();
        this.dialog();
    },
    initForms: function() {
        
    },

    datagrid: function() {
        using('plugins/jquery.client.paging.js', function(){
            $('#dg-employees').datagrid({
                url: site_url + "employees/getEmployeesGrid",
                toolbar: [
                    {
                        text: 'Add Employee',
                        iconCls: 'icon-add',
                        handler: function() {
                            employees.create();
                        }
                    },
                    '-',
                    {
                        text: 'Edit Employee',
                        iconCls: 'icon-edit',
                        handler: function() {
                            employees.update();
                        }
                    },
                    '-',
                    {
                        text: 'Delete Employee',
                        iconCls: 'icon-remove',
                        handler: function() {
                            var row = $('#dg-employees').datagrid('getSelected');
                            if ( row ) {
                                $.messager.confirm('Confirm', 'Delete Employee?', function(r) {
                                    if ( r ) {
                                        $.post( site_url + 'employees/deleteEmployee', { emp_id: row.emp_id }, function(response) {
                                            if ( response.status == 'success' ) {
                                                $.messager.alert('Message', 'Success', 'info', function(){
                                                    $('#dg-employees').datagrid('reload');
                                                })
                                            }
                                        }, 'json');
                                    }
                                })
                            }
                        }
                    }
                ],
                pagination:true,
                pageSize:10,
                rownumbers:true,
                fitColumns:"true",
                singleSelect:"true",
                columns:[
                    [
                        {field:'pos_name',title:'Position',width:'10%'},
                        {field:'ui_lastname',title:'Lastname',width:'10%'},
                        {field:'ui_firstname',title:'Firstname',width:'10%'},
                        {field:'ui_middlename',title:'Middle Name',width:'9%'},
                        {field:'ui_extname',title:'Ext. Name',width:'10%'},
                        {field:'ui_address',title:'Address',width:'20%'},
                        {field:'ui_birthdate',title:'Birthdate',width:'10%'},
                        {field:'emp_username',title:'Username',width:'10%'},
                    ]
                ]
            }).datagrid('clientPaging');
        });
    },

    dialog: function() {
        var employees = this;
        $("#dlg-employees").dialog({
            resizable: true,
            modal: true,
            closed: true,
            buttons:[{
                text:'Save',
                handler:function(){
                    employees.save();
                }
            },{
                text:'Close',
                handler:function(){
                    $("#dlg-employees").dialog('close');
                }
            }],
            onLoad: function(){
                $("#emp_ui_birthdate").textbox('textbox').mask("9999-99-99",{placeholder:"yyyy-mm-dd"});

                if ( $("#fitem-emp-username input[name=emp_username]").val().length > 0 ) {
                    $("#fitem-emp-username span").html( $("#fitem-emp-username input[name=emp_username]").val() );
                }
            }
        });
    },

    create: function(){
        $('#dlg-employees').dialog('open').dialog('refresh', site_url + 'employees/dialog').dialog('center').dialog('setTitle','New');
        $('#fm-employees').form('clear');
    },

    save: function() {
        $('#fm-employees').form('submit',{
            url: site_url + 'employees/saveEmployee',
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                $.messager.alert('Message','Successful', 'info', function(){
                    $('#dlg-employees').dialog('close');        // close the dialog
                    $('#dg-employees').datagrid('reload');    // reload the user data
                });
            }
        });
    },

    update: function(){

        var row = $('#dg-employees').datagrid('getSelected');
        if (row){
            $('#dlg-employees').dialog('open').dialog('refresh', site_url + 'employees/dialog/' + row.emp_id).dialog('center').dialog('setTitle','Edit');
            $('#fm-employees').form('load',row);
        }
    },
}
