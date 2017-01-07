
var items = {

    init: function() {
        this.datagrid();
        this.dialog();
    },

    initForms: function() {

    },

    datagrid: function() {
        using('plugins/jquery.client.paging.js', function(){
            $('#dg-items').datagrid({
                url: site_url + 'items/getItemsGrid',
                toolbar: [
                    {
                        text: 'Add Item',
                        iconCls: 'icon-add',
                        handler: function() {
                            items.create();
                        }
                    },
                    '-',
                    {
                        text: 'Edit Item',
                        iconCls: 'icon-edit',
                        handler: function() {
                            items.update();
                        }
                    },
                    '-',
                    {
                        text: 'Delete Item',
                        iconCls: 'icon-remove',
                        handler: function() {
                            items.delete();
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
                        {field:'item_stock_id',title:'Item Stock ID',width:'10%',align:'right'},
                        {field:'item_description',title:'Item Description'},
                    ]
                ]
            }).datagrid('clientPaging');
        })
    },

    dialog: function() {
        var items = this;
        $("#dlg-items").dialog({
            resizable: true,
            modal: true,
            closed: true,
            buttons:[{
                text:'Save',
                handler:function(){
                    items.save();
                }
            },{
                text:'Close',
                handler:function(){
                    $("#dlg-items").dialog('close');
                }
            }]
        });
    },

    create: function() {
        $('#dlg-items').dialog('open').dialog('refresh', site_url + 'items/dialog').dialog('center').dialog('setTitle','New');
        $('#fm-items').form('clear');
    },

    save: function() {
        $('#fm-items').form('submit',{
            url: site_url + 'items/saveItem',
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                $.messager.alert('Message','Successful', 'info', function(){
                    $('#dlg-items').dialog('close');
                    $('#dg-items').datagrid('reload');
                });
            }
        });
    },

    update: function() {
        var row = $('#dg-items').datagrid('getSelected');
        console.log(row);
        if (row){
            $('#dlg-items').dialog('open').dialog('refresh', site_url + 'items/dialog/' + row.item_id).dialog('center').dialog('setTitle','Edit');
            $('#fm-items').form('load',row);
        }
    },

    delete: function() {
        var row = $('#dg-items').datagrid('getSelected');
        if ( row ) {
            $.messager.confirm('Confirm', 'Delete Item?', function(r){
                if ( r ) {
                    $.post( site_url + 'items/deleteItem', { item_id: row.item_id}, function(response){
                        if ( response.status == 'success' ) {
                            $.messager.alert('Message', 'Successful', 'info', function() {
                                $('#dg-items').datagrid('reload');
                            });
                        }
                    }, 'json');
                }
            });
        }
    },
}