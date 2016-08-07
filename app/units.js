
var units = {

    init: function() {
        this.datagrid();
        this.dialog();
    },

    datagrid: function() {
        using('plugins/jquery.client.paging.js', function(){
            $('#dg-units').datagrid({
                url: site_url + 'units/getUnitsGrid',
                toolbar: [
                    {
                        text: 'Add Unit',
                        iconCls: 'icon-add',
                        handler: function() {
                            units.create();
                        }
                    },
                    '-',
                    {
                        text: 'Edit Unit',
                        iconCls: 'icon-edit',
                        handler: function() {
                            units.update();
                        }
                    },
                    '-',
                    {
                        text: 'Delete Unit',
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
                        {field:'unit_name',title:'Name',width:'10%'},
                    ]
                ]
            }).datagrid('clientPaging');
        })
    },

    dialog: function () {
        var categories = this;
        $("#dlg-units").dialog({
            resizable: true,
            modal: true,
            closed: true,
            buttons:[{
                text:'Save',
                handler:function(){
                    categories.save();
                }
            },{
                text:'Close',
                handler:function(){
                    $("#dlg-units").dialog('close');
                }
            }]
        });
    },

    create: function(){
        $('#dlg-units').dialog('open').dialog('refresh', site_url + 'units/dialog').dialog('center').dialog('setTitle','New');
        $('#fm-units').form('clear');
    },

    save: function() {
        $('#fm-units').form('submit',{
            url: site_url + 'units/saveUnit',
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                $.messager.alert('Message','Successful', 'info', function(){
                    $('#dlg-units').dialog('close');
                    $('#dg-units').datagrid('reload');
                });
            }
        });
    },

    update: function() {
        var row = $('#dg-units').datagrid('getSelected');
        if (row){
            $('#dlg-units').dialog('open').dialog('refresh', site_url + 'units/dialog/' + row.unit_id).dialog('center').dialog('setTitle','Edit');
            $('#fm-units').form('load',row);
        }
    }
}