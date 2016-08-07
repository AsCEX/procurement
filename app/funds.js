
var funds = {

    init: function() {
        this.datagrid();
        this.dialog();
    },

    initForms: function() {

    },

    datagrid: function() {

        using('plugins/jquery.client.paging.js', function(){
            $('#dg').datagrid({
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
                        {field:'value',title:'Fund Name',width:'10%'},
                    ]
                ]
            }).datagrid('clientPaging');
        })
    },

    dialog: function(){
        var funds = this;
        $("#dlg").dialog({
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
                    $("#dlg").dialog('close');
                }
            }]
        });
    },

    create: function(){
        $('#dlg').dialog('open').dialog('refresh', site_url + 'funds/dialog').dialog('center').dialog('setTitle','New Fund');
        $('#fm').form('clear');
    },

    save: function() {
        $('#fm').form('submit',{
            url: site_url + 'funds/saveSourceFund',
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                $.messager.alert('Message','Successful', 'info', function(){
                    $('#dlg').dialog('close');        // close the dialog
                    $('#dg').datagrid('reload');    // reload the user data
                });
            }
        });
    },

    update: function(){

        var row = $('#dg').datagrid('getSelected');
        console.log(row);
        if (row){
            $('#dlg').dialog('open').dialog('refresh', site_url + 'funds/dialog/' + row.name).dialog('center').dialog('setTitle','Edit Fund');
            $('#fm').form('load',row);
            // url = 'update_user.php?id='+row.id;
        }
    },
}