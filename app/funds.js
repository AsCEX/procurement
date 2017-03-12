
var funds = {

    init: function() {
        this.datagrid();
        this.dialog();
    },

    initForms: function() {

    },

    quickMenu: function(el){

        $("#misc").dialog({
            resizable: true,
            modal: true,
            cloased: false,
            width: 750,
            height: 500,
            href: site_url + 'funds',
            buttons:[{
                text:'Close',
                handler:function(){
                    $("#misc").dialog('close');
                }
            }],
            onClose: function(){
                $('#'+el).combobox('reload');
            }
        });
    },


    datagrid: function() {

        using('plugins/jquery.client.paging.js', function(){
            $('#dg-funds').datagrid({
                url: site_url + "funds/getSourceFunds",
                toolbar: [
                    {
                        text: 'Add Fund',
                        iconCls: 'icon-add',
                        handler: function() {
                            funds.create();
                        }
                    },
                    '-',
                    {
                        text: 'Edit Fund',
                        iconCls: 'icon-edit',
                        handler: function() {
                            funds.update();
                        }
                    },
                    '-',
                    {
                        text: 'Delete Fund',
                        iconCls: 'icon-remove',
                        handler: function() {
                            var row = $('#dg-funds').datagrid('getSelected');
                            if ( row ) {
                                $.messager.confirm( 'Confirm', 'Delete Fund', function(r) {
                                   if ( r ) {
                                       $.post( site_url + 'funds/deleteFund', { fund_id: row.name }, function(response){
                                           if ( response.status == 'success' ) {
                                               $.messager.alert('Message', 'Successful', 'info', function(){
                                                   $('#dg-funds').datagrid('reload');
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
                fitColumns:true,
                singleSelect:"true",
                columns:[
                    [
                        {field:'value',title:'Fund Name',width:'100%'},
                    ]
                ]
            }).datagrid('clientPaging');
        })
    },

    dialog: function(){
        var funds = this;
        $("#dlg-funds").dialog({
            resizable: true,
            modal: true,
            closed: true,
            buttons:[{
                text:'Save',
                handler:function(){
                    funds.save();
                }
            },{
                text:'Close',
                handler:function(){
                    $("#dlg-funds").dialog('close');
                }
            }]
        });
    },

    create: function(){
        $('#dlg-funds').dialog('open').dialog('refresh', site_url + 'funds/dialog').dialog('center').dialog('setTitle','New Fund');
        $('#fm-funds').form('clear');
    },

    save: function() {
        $('#fm-funds').form('submit',{
            url: site_url + 'funds/saveSourceFund',
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                $.messager.alert('Message','Successful', 'info', function(){
                    $('#dlg-funds').dialog('close');
                    $('#dg-funds').datagrid('reload');
                });
            }
        });
    },

    update: function(){

        var row = $('#dg-funds').datagrid('getSelected');
        if (row){
            $('#dlg-funds').dialog('open').dialog('refresh', site_url + 'funds/dialog/' + row.name).dialog('center').dialog('setTitle','Edit Fund');
            $('#fm-funds').form('load',row);
            // url = 'update_user.php?id='+row.id;
        }
    },
}