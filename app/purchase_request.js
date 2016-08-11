
var purchase_request = {

    init: function(){
        this.datagrid();
        this.dialog();

    },

    initForms: function(){

        $('#pr_department').combobox({
            required:true,
            editable: false,
            url: site_url + 'offices/getComboboxOffices/' + $(this).data('office'),
            valueField: 'name',
            textField: 'value',
            method: 'get',
            prompt: 'Select Department',
            onChange: function(){
                purchase_request.changeQuarterDepartment();
            }
        })


        $('#quarter').combobox({
            required:true,
            editable: false,
            url: site_url + 'quarter/getQuarter',
            valueField: 'name',
            textField: 'value',
            method: 'get',
            prompt: 'Select Quarter',
            onChange: function(){
                purchase_request.changeQuarterDepartment();
            }
        })




    },

    datagrid: function(){

        using('plugins/jquery.client.paging.js', function(){
            $("#pr-dg").datagrid({
                url: site_url + "purchase_request/gridValues",
                toolbar: [
                    {
                        text: 'Create Request',
                        iconCls: 'icon-add',
                        handler: function(){
                            purchase_request.create();

                        }
                    },
                    '-',
                    {
                        text: 'Edit Request',
                        iconCls: 'icon-edit',
                        handler: function(){
                            purchase_request.update();
                        }
                    },
                    '-',
                    {
                        text: 'Delete Request',
                        iconCls: 'icon-remove',
                        handler: function(){

                        }
                    }
                ],
                pagination:"true",
                pageSize:10,
                rownumbers:"true",
                fitColumns:"true",
                singleSelect:"true",
                columns:[
                    [
                        {field:'pr_id',title:'ID',width:'5%'},
                        {field:'pr_code_id',title:'Code',width:'10%'},
                        {field:'dept_name',title:'Department',width:'25%'},
                        {field:'pr_created_date',title:'Date',width:'20%'},
                        {field:'requested_user',title:'Requested By',width:'15%'},
                        {field:'approved_user',title:'Approved By',width:'15%'},
                    ]
                ],
            }).datagrid('clientPaging');
        });
    },

    dialog: function(){
        var self = this;
        $("#dlg").dialog({
            resizable: true,
            modal: true,
            closed: true,
            buttons:[{
                id: 'save_pr',
                text:'Save',
                handler:function(){
                    self.save();

                }
            },{
                text:'Close',
                handler:function(){
                    $("#dlg").dialog('close');
                }
            }],
            onLoad: function(){
                $("#pr_alobs_date").textbox('textbox').mask("99/99/9999",{placeholder:"mm/dd/yyyy"});
                $("#pr_sai_date").textbox('textbox').mask("99/99/9999",{placeholder:"mm/dd/yyyy"});
            }
        });
        $("#pr-ppmp-dlg").dialog({
            resizable: true,
            modal: true,
            closed: true,
            buttons:[{
                text:'Save',
                handler:function(){
                    request_items.save();
                }
            },{
                text:'Close',
                handler:function(){
                    $("#pr-ppmp-dlg").dialog('close');
                }
            }]
        });
    },

    create: function(){
        $('#dlg').dialog('open')
            .dialog('refresh', site_url + 'purchase_request/dialog')
            .dialog('center')
            .dialog('setTitle','New Procurement')

        $('#pr-fm').form('clear');



    },

    update: function(){

        var row = $('#pr-dg').datagrid('getSelected');
        if (row){
            $('#dlg').dialog('open').dialog('refresh', site_url + 'purchase_request/dialog/' + row.pr_id).dialog('center').dialog('setTitle','Purchased Request - ' + row.pr_code_id);
            $('#pr-fm').form('load',row);
            url = 'update_user.php?id='+row.id;
        }
    },

    save: function(){

        $('#save_pr').linkbutton('disable');
        $('#pr-fm').form('submit',{
            url: site_url + 'purchase_request/save_request',
            onSubmit: function(){


                var items = $("#pr_items").datagrid('getData');
                $("#pr_item_json").val(JSON.stringify(items.rows));

                if(!$(this).form('validate'))
                    $('#save_pr').linkbutton('enable');

                return $(this).form('validate');
            },
            success: function(result){

                $.messager.alert('My Title','Successful', 'info', function(){
                    //$('#dlg').dialog('close');
                    $('#pr-dg').datagrid('reload');    // reload the user data
                    $('#pr-items').datagrid('reload');    // reload the user data
                });

                $('#save_pr').linkbutton('enable');
            }
        });
    },

    delete: function(){

        var row = $('#pr-dg').datagrid('getSelected');
        if (row){
            $.messager.confirm('Confirm','Are you sure you want to destroy this user?',function(r){
                if (r){
                    $.post('destroy_user.php',{id:row.id},function(result){
                        if (result.success){
                            $('#pr-dg').datagrid('reload');    // reload the user data
                        } else {
                            $.messager.show({    // show error message
                                title: 'Error',
                                msg: result.errorMsg
                            });
                        }
                    },'json');
                }
            });
        }
    },

    changeQuarterDepartment: function (){
        var items =  $('#pr_items').datagrid('getData');
        if(items.total > 0){
            $.messager.confirm('Warning', 'Changing this will empty the items?', function(r){
                if (r){
                    $('#pr_items').datagrid('loadData', {"total":0,"rows":[]});
                }
            });
        }
}



}