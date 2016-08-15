
var positions = {

    init: function() {
        this.datagrid();
        this.dialog();
    },

    initForms: function() {

    },

    datagrid: function() {

        using('plugins/jquery.client.paging.js', function(){
            $('#dg-positions').datagrid({
                url: site_url + 'positions/getPositions',
                toolbar: [
                    {
                        text: 'Add Position',
                        iconCls: 'icon-add',
                        handler: function() {
                            positions.create();
                        }
                    },
                    '-',
                    {
                        text: 'Edit Position',
                        iconCls: 'icon-edit',
                        handler: function() {
                            positions.update();
                        }
                    },
                    '-',
                    {
                        text: 'Delete Position',
                        iconCls: 'icon-remove',
                        handler: function() {
                            var row = $('#dg-positions').datagrid('getSelected');
                            if ( row ) {
                                $.messager.confirm('Conrim', 'Delete Position?', function(r){
                                    if ( r ) {
                                        $.post( site_url + 'positions/deletePosition', {pos_id: row.pos_id}, function(response){
                                            if ( response.status == 'success' ) {
                                                $.messager.alert('Message','Successful', 'info', function(){
                                                    $('#dg-positions').datagrid('reload');    // reload the user data
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
                        {field:'pos_name',title:'Position Name',width:'10%'},
                    ]
                ]
            }).datagrid('clientPaging');
        })
    },

    dialog: function(){
        var positions = this;
        $("#dlg-positions").dialog({
            resizable: true,
            modal: true,
            closed: true,
            buttons:[{
                text:'Save',
                handler:function(){
                    positions.save();
                }
            },{
                text:'Close',
                handler:function(){
                    $("#dlg-positions").dialog('close');
                }
            }]
        });
    },

    create: function(){
        $('#dlg-positions').dialog('open').dialog('refresh', site_url + 'positions/dialog').dialog('center').dialog('setTitle','New Position');
        $('#fm-positions').form('clear');
    },

    save: function() {
        $('#fm-positions').form('submit',{
            url: site_url + 'positions/savePosition',
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                $.messager.alert('Message','Successful', 'info', function(){
                    $('#dlg-positions').dialog('close');        // close the dialog
                    $('#dg-positions').datagrid('reload');    // reload the user data
                });
            }
        });
    },

    update: function(){

        var row = $('#dg-positions').datagrid('getSelected');
        if (row){
            $('#dlg-positions').dialog('open').dialog('refresh', site_url + 'positions/dialog/' + row.pos_id).dialog('center').dialog('setTitle','Edit Position');
            $('#fm-positions').form('load',row);
        }
    },

}