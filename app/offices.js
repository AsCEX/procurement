
var offices = {

    init: function() {
        this.datagrid();
        this.dialog();
    },

    initForms: function() {

    },

    datagrid: function() {
        using('plugins/jquery.client.paging.js', function(){
            $('#dg-offices').datagrid({
                url: site_url + 'offices/getOffices',
                toolbar: [
                    {
                        text: 'Add Department',
                        iconCls: 'icon-add',
                        handler: function() {
                            offices.create();
                        }
                    },
                    '-',
                    {
                        text: 'Edit Department',
                        iconCls: 'icon-edit',
                        handler: function() {
                            offices.update();
                        }
                    },
                    '-',
                    {
                        text: 'Delete Department',
                        iconCls: 'icon-remove',
                        handler: function() {

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
                        {field:'ofc_initial',title:'Initial',width:'10%'},
                        {field:'ofc_code',title:'Code',width:'10%'},
                        {field:'ofc_name',title:'Name',width:'40%'},
                    ]
                ]
            }).datagrid('clientPaging');
        })
    },

    dialog: function () {
        var offices = this;
        $("#dlg-offices").dialog({
            resizable: true,
            modal: true,
            closed: true,
            buttons:[{
                text:'Save',
                handler:function(){
                    offices.save();
                }
            },{
                text:'Close',
                handler:function(){
                    $("#dlg-offices").dialog('close');
                }
            }]
        });
    },

    create: function(){
        $('#dlg-offices').dialog('open').dialog('refresh', site_url + 'offices/dialog').dialog('center').dialog('setTitle','New Department');
        $('#fm-offices').form('clear');
    },

    save: function() {
        $('#fm-offices').form('submit',{
            url: site_url + 'offices/saveOffice',
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                $.messager.alert('Message','Successful', 'info', function(){
                    $('#dlg-offices').dialog('close');
                    $('#dg-offices').datagrid('reload');
                });
            }
        });
    },

    update: function() {
        var row = $('#dg-offices').datagrid('getSelected');
        console.log(row);
        if (row){
            $('#dlg-offices').dialog('open').dialog('refresh', site_url + 'offices/dialog/' + row.ofc_id).dialog('center').dialog('setTitle','Edit Department');
            $('#fm-offices').form('load',row);
        }
    }
}