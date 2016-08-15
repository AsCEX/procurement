
var suppliers = {

    init: function() {
        this.datagrid();
        this.dialog();
    },

    initForms: function() {

    },

    datagrid: function() {
        using('plugins/jquery.client.paging.js', function(){
            $('#dg-suppliers').datagrid({
                url: site_url + 'suppliers/getSuppliersGrid',
                toolbar: [
                    {
                        text: 'Add Supplier',
                        iconCls: 'icon-add',
                        handler: function() {
                            suppliers.create();
                        }
                    },
                    '-',
                    {
                        text: 'Edit Supplier',
                        iconCls: 'icon-edit',
                        handler: function() {
                            suppliers.update();
                        }
                    },
                    '-',
                    {
                        text: 'Delete Supplier',
                        iconCls: 'icon-remove',
                        handler: function() {
                            var row = $('#dg-suppliers').datagrid('getSelected');
                            if ( row ) {
                                $.messager.confirm('Confirm',  'Delete Supplier?', function(r){
                                   if ( r ) {
                                       $.post(site_url + 'suppliers/deleteSupplier', {supp_id: row.supp_id}, function(result){
                                           if ( result.status == 'success' ) {
                                               $.messager.alert('Message','Successful', 'info', function(){
                                                   $('#dg-suppliers').datagrid('reload');
                                               });
                                           }
                                       }, 'json');
                                   }
                                });
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
                        {field:'ui_lastname',title:'Lastname',width:'10%'},
                        {field:'ui_firstname',title:'Firstname',width:'10%'},
                        {field:'ui_middlename',title:'Middle Name',width:'10%'},
                        {field:'ui_extname',title:'Ext. Name',width:'10%'},
                        {field:'ui_address',title:'Address',width:'14%'},
                        {field:'ui_birthdate',title:'Birthdate',width:'10%'},
                        {field:'supp_business_name',title:'Business Name',width:'10%'},
                        {field:'supp_address',title:'Business Address',width:'14%'},
                        {field:'supp_tin',title:'TIN',width:'10%'},
                    ]
                ]
            }).datagrid('clientPaging');
        })
    },

    dialog: function() {
        var suppliers = this;
        $("#dlg-suppliers").dialog({
            resizable: true,
            modal: true,
            closed: true,
            buttons:[{
                text:'Save',
                handler:function(){
                    suppliers.save();
                }
            },{
                text:'Close',
                handler:function(){
                    $("#dlg-suppliers").dialog('close');
                }
            }],
            onLoad: function(){
                $("#supp_ui_birthdate").textbox('textbox').mask("9999-99-99",{placeholder:"yyyy-mm-dd"});
            }
        });
    },

    create: function(){
        $('#dlg-suppliers').dialog('open').dialog('refresh', site_url + 'suppliers/dialog').dialog('center').dialog('setTitle','New');
        $('#fm-suppliers').form('clear');
    },

    save: function() {
        $('#fm-suppliers').form('submit',{
            url: site_url + 'suppliers/saveSupplier',
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                $.messager.alert('Message','Successful', 'info', function(){
                    $('#dlg-suppliers').dialog('close');        // close the dialog
                    $('#dg-suppliers').datagrid('reload');    // reload the user data
                });
            }
        });
    },

    update: function(){

        var row = $('#dg-suppliers').datagrid('getSelected');
        if (row){
            $('#dlg-suppliers').dialog('open').dialog('refresh', site_url + 'suppliers/dialog/' + row.supp_id).dialog('center').dialog('setTitle','Edit');
            $('#fm-suppliers').form('load',row);
        }
    },
}