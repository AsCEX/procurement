
var procurement_plan = {

    init: function(){
        this.datagrid();
        this.dialog();
    },

    initForms: function() {

        $('#units').combobox({
            required: true,
            editable: false,
            url: site_url + 'units/getUnits',
            valueField: 'name',
            textField: 'value',
            method: 'get',
            prompt: 'Select Units',
            onChange: function () {
                //alert("SDFLJKSDJF");
            }
        })
    },

    datagrid: function(){

        using('plugins/jquery.client.paging.js', function(){
            $("#dg").datagrid({
                url: site_url + "procurement_plan/getProcurementPlans",
                toolbar: [
                    {
                        text: 'Add Procurement',
                        iconCls: 'icon-add',
                        handler: function(){
                            procurement_plan.create();
                        }
                    },
                    '-',
                    {
                        text: 'Edit Procurement',
                        iconCls: 'icon-edit',
                        handler: function(){
                            procurement_plan.update();
                        }
                    },
                    '-',
                    {
                        text: 'Delete Procurement',
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
                        {field:'ppmp_code',title:'Code',width:'5%',rowspan:2},
                        {field:'ppmp_description',title:'General Description',width:'20%',rowspan:2},
                        {field:'qty',title:'Qty',width:'5%',rowspan:2,align:'right'},
                        {field:'unit_name',title:'Unit',width:'5%',rowspan:2},
                        {field:'ppmp_budget',title:'Budget',width:'5%',rowspan:2,align:'right',
                            formatter: function(value, row, index){
                                return accounting.formatMoney(row.ppmp_budget, "");
                            }
                        },
                        {field:'',title:'Schedule',width:'50%',colspan:12}
                    ],
                    [
                        {field:'sched_1',title:'Jan',width:10,align:'center'},
                        {field:'sched_2',title:'Feb',width:10,align:'center'},
                        {field:'sched_3',title:'Mar',width:10,align:'center'},
                        {field:'sched_4',title:'Apr',width:10,align:'center'},
                        {field:'sched_5',title:'May',width:10,align:'center'},
                        {field:'sched_6',title:'Jun',width:10,align:'center'},
                        {field:'sched_7',title:'Jul',width:10,align:'center'},
                        {field:'sched_8',title:'Aug',width:10,align:'center'},
                        {field:'sched_9',title:'Sep',width:10,align:'center'},
                        {field:'sched_10',title:'Oct',width:10,align:'center'},
                        {field:'sched_11',title:'Nov',width:10,align:'center'},
                        {field:'sched_12',title:'Dec',width:10,align:'center'},
                    ]
                ],
            }).datagrid('clientPaging');
        });
    },

    dialog: function(){
        var ppmp = this;
        $("#dlg").dialog({
            resizable: true,
            modal: true,
            closed: true,
            buttons:[{
                text:'Save',
                handler:function(){
                    ppmp.save();
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
        $('#dlg').dialog('open').dialog('refresh', site_url + 'procurement_plan/dialog').dialog('center').dialog('setTitle','New Procurement');
        $('#fm').form('clear');
    },

    update: function(){

        var row = $('#dg').datagrid('getSelected');
        if (row){
            $('#dlg').dialog('open').dialog('refresh', site_url + 'procurement_plan/dialog/' + row.id).dialog('center').dialog('setTitle','Edit Procurement');
            $('#fm').form('load',row);
            url = 'update_user.php?id='+row.id;
        }
    },

    save: function(){

        $('#fm').form('submit',{
            url: site_url + 'procurement_plan/saveProcurementPlan',
            onSubmit: function(){

                var s = '';
                var rows = $('#pg-setting').propertygrid('getChanges');
                for(var i=0; i<rows.length; i++){
                    s += rows[i].name + ':' + rows[i].value + ',';
                }

                $(this).find('#schedules').val(s);

                return $(this).form('validate');
            },
            success: function(result){

                $.messager.alert('My Title','Successful', 'info', function(){
                    $('#dlg').dialog('close');        // close the dialog
                    $('#dg').datagrid('reload');    // reload the user data
                });

            }
        });
    },

    delete: function(){

        var row = $('#dg').datagrid('getSelected');
        if (row){
            $.messager.confirm('Confirm','Are you sure you want to destroy this user?',function(r){
                if (r){
                    $.post('destroy_user.php',{id:row.id},function(result){
                        if (result.success){
                            $('#dg').datagrid('reload');    // reload the user data
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

    getScheduleChages: function(){

        var s = '';
        var rows = $('#pg-setting').propertygrid('getChanges');
        for(var i=0; i<rows.length; i++){
            s += rows[i].name + ':' + rows[i].value + ',';
        }

    }

}