
var stocks = {

    init: function() {
        this.datagrid();
        this.dialog();
    },

    initForms: function() {

    },

    datagrid: function() {
        using('plugins/jquery.client.paging.js', function(){
            $('#dg-stocks').datagrid({
                url: site_url + 'stocks/getStocksGrid',
                toolbar: [
                    {
                        text: 'Add Stock',
                        iconCls: 'icon-add',
                        handler: function() {
                            stocks.create();
                        }
                    },
                    '-',
                    {
                        text: 'Edit Stock',
                        iconCls: 'icon-edit',
                        handler: function() {
                            stocks.update();
                        }
                    },
                    '-',
                    {
                        text: 'Delete Stock',
                        iconCls: 'icon-remove',
                        handler: function() {
                            stocks.delete();
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
                        {field:'cat_description',title:'Category',width:'15%',align:'right'},
                        {field:'stock_description',title:'Stock Description',width:'10%'},
                    ]
                ]
            }).datagrid('clientPaging');
        })
    },

    dialog: function() {
        var stocks = this;
        $("#dlg-stocks").dialog({
            resizable: true,
            modal: true,
            closed: true,
            buttons:[{
                text:'Save',
                handler:function(){
                    stocks.save();
                    console.log('here');
                }
            },{
                text:'Close',
                handler:function(){
                    $("#dlg-stocks").dialog('close');
                }
            }]
        });
    },

    create: function() {
        $('#dlg-stocks').dialog('open').dialog('refresh', site_url + 'stocks/dialog').dialog('center').dialog('setTitle','New');
        $('#fm-stocks').form('clear');
    },

    save: function() {
        $('#fm-stocks').form('submit',{
            url: site_url + 'stocks/saveStock',
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                $.messager.alert('Message','Successful', 'info', function(){
                    $('#dlg-stocks').dialog('close');
                    $('#dg-stocks').datagrid('reload');
                });
            }
        });
    },

    update: function() {
        var row = $('#dg-stocks').datagrid('getSelected');
        if (row){
            $('#dlg-stocks').dialog('open').dialog('refresh', site_url + 'stocks/dialog/' + row.stock_id).dialog('center').dialog('setTitle','Edit');
            $('#fm-stocks').form('load',row);
        }
    },

    delete: function() {
        var row = $('#dg-stocks').datagrid('getSelected');
        if ( row ) {
            $.messager.confirm('Confirm', 'Delete Stock?', function(r){
                if ( r ) {
                    $.post( site_url + 'stocks/deleteStock', {stock_id: row.stock_id}, function(response){
                        if ( response.status == 'success' ) {
                            $.messager.alert('Message', 'Successful', 'info', function() {
                                $('#dg-stocks').datagrid('reload');
                            });
                        }
                    }, 'json');
                }
            });
        }
    },
}