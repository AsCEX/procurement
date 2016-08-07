
var categories = {

    init: function() {
        this.datagrid();
        this.dialog();
    },

    initForms: function() {

    },

    datagrid: function() {
        using('plugins/jquery.client.paging.js', function(){
            $('#dg-categories').datagrid({
                url: site_url + 'categories/getCategoriesGrid',
                toolbar: [
                    {
                        text: 'Add Category',
                        iconCls: 'icon-add',
                        handler: function() {
                            categories.create();
                        }
                    },
                    '-',
                    {
                        text: 'Edit Category',
                        iconCls: 'icon-edit',
                        handler: function() {
                            categories.update();
                        }
                    },
                    '-',
                    {
                        text: 'Delete Category',
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
                        {field:'cat_code',title:'Code',width:'10%'},
                        {field:'cat_description',title:'Description',width:'20%'},
                    ]
                ]
            }).datagrid('clientPaging');
        })
    },

    dialog: function () {
        var categories = this;
        $("#dlg-categories").dialog({
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
                    $("#dlg-categories").dialog('close');
                }
            }]
        });
    },

    create: function(){
        $('#dlg-categories').dialog('open').dialog('refresh', site_url + 'categories/dialog').dialog('center').dialog('setTitle','New');
        $('#fm-categories').form('clear');
    },

    save: function() {
        $('#fm-categories').form('submit',{
            url: site_url + 'categories/saveCategory',
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                $.messager.alert('Message','Successful', 'info', function(){
                    $('#dlg-categories').dialog('close');
                    $('#dg-categories').datagrid('reload');
                });
            }
        });
    },

    update: function() {
        var row = $('#dg-categories').datagrid('getSelected');
        console.log(row);
        if (row){
            $('#dlg-categories').dialog('open').dialog('refresh', site_url + 'categories/dialog/' + row.cat_id).dialog('center').dialog('setTitle','Edit');
            $('#fm-categories').form('load',row);
        }
    }

}