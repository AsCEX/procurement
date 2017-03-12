
var request_items = {

        editIndex: undefined,

        loadRequestItems: function(pr_id){


            using('plugins/jquery.client.paging.js', function(){
                $("#pr_items").datagrid({
                    url: site_url + "purchase_request/getRequestItems/" + pr_id,
                    toolbar: [
                        {
                            text: 'Add Items',
                            iconCls: 'icon-add',
                            handler: function(){
                                if($("#pr_department").combobox('getValue') && $("#quarter").combobox('getValue')){
                                    //request_items.append();
                                    request_items.create_pr_item($("#pr_id").val(), $("#pr_department").combobox('getValue'), $("#quarter").combobox('getValue'));
                                }else{
                                    $.messager.alert('Warning','Please select Department and Quarter', 'info');
                                }

                            }
                        },/*
                        {
                            text: 'Done',
                            iconCls: 'icon-add',
                            handler: function(){
                                request_items.endEditing();

                            }
                        },*/
                    ],
                    pagination:"true",
                    pageSize:10,
                    rownumbers:false,
                    fitColumns:false,
                    nowrap: false,
                    fit: true,
                    singleSelect:true,
                    emptyMsg: "No Records",
                    /*view: groupview,
                    groupField:'cat_description',
                    groupFormatter:function(value,rows){
                        return value;
                    },*/
                    columns:[
                        [
                            //{field:'ppmp_code',title:'Code',width:'8%'},
                            {field:'qty',title:'Qty',width:'10%',align:'center',editor:{
                                type: 'numberbox',options:{
                                    precision: 0,
                                }
                            }},
                            {field:'unit_name',title:'Unit',width:'10%'},
                            //{field:'cat_description',title:'Category',width:'20%'},
                            {field:'description',title:'Description',width:'50%'},
                            {field:'item_cost',title:'Item Cost',width:'13%',align:'right',editor:{
                                type: 'numberbox',options:{
                                    precision: 2,
                                },
                                formatter: function(value, row, index){
                                    return accounting.formatMoney(row.item_cost, "");
                                }
                            }},
                            {field:'tot_cost',title:'Cost',width:'13%',align:'right',
                                formatter: function(value, row, index){
                                    if(value){
                                        return accounting.formatMoney(row.tot_cost, "");
                                    }
                                }
                            }
                            /*{field:'action',title:'Action',width:'12%',align:'center',formatter: function(value,row,index){

                                if (row.editing){
                                    var s = '<a href="javascript:void(0)" onclick="request_items.saverow(this)">Save</a> ';
                                    var c = '<a href="javascript:void(0)" onclick="request_items.cancelrow(this)">Cancel</a>';
                                    return s+c;
                                } else {
                                    var e = '<a href="javascript:void(0)" onclick="request_items.editrow(this)">Edit</a> ';
                                    var d = '<a href="javascript:void(0)" onclick="request_items.deleterow(this)">Delete</a>';
                                    return e+d;
                                }

                                }
                            }*/
                        ]
                    ],

                    onEndEdit:function(index,row){
                        var ed_qty = $(this).datagrid('getEditor', {
                            index: index,
                            field: 'qty'
                        });
                        row.qty = $(ed_qty.target).numberbox('getValue');

                        var ed_item_cost = $(this).datagrid('getEditor', {
                            index: index,
                            field: 'item_cost'
                        });
                        row.item_cost = $(ed_item_cost.target).numberbox('getValue');

                        var cost = row.qty * row.item_cost;

                        row.tot_cost = cost.toFixed(2);


                    },
                    onBeforeEdit:function(index,row){
                        row.editing = true;
                        $(this).datagrid('refreshRow', index);
                    },
                    onAfterEdit:function(index,row){
                        row.editing = false;
                        $(this).datagrid('refreshRow', index);
                    },
                    onCancelEdit:function(index,row){
                        row.editing = false;
                        $(this).datagrid('refreshRow', index);
                    },
                    onRowContextMenu: function(e,index,row){
                        e.preventDefault();
                        if(index > -1){
                            console.log(row);
                            $("#pr-dg-menu").data('pri', row.pri_id)
                            $('#pr_items').datagrid('selectRow', index);
                            $(e.target).parents('tr').addClass('datagrid-context-menu');
                            $('#pr-dg-menu').menu('show', {
                                left: e.pageX,
                                top: e.pageY
                            }).menu({
                                onHide: function(){
                                    $(e.target).parents('tr').removeClass('datagrid-context-menu');
                                }
                            });

                        }
                    }
                }).datagrid('clientPaging');
            });

        },
        getRowIndex:  function(target){
            var tr = $(target).closest('tr.datagrid-row');
            return parseInt(tr.attr('datagrid-row-index'));
        },
        editrow: function(target){
            $('#pr_items').datagrid('beginEdit', request_items.getRowIndex(target));
        },
        deleterow: function(target){
            $.messager.confirm('Confirm','Are you sure?',function(r){
                if (r){
                    $('#pr_items').datagrid('deleteRow', request_items.getRowIndex(target));
                }
            });
        },
        saverow: function(target){
            $('#pr_items').datagrid('endEdit', request_items.getRowIndex(target));
        },
        cancelrow: function(target){
            $('#pr_items').datagrid('cancelEdit', request_items.getRowIndex(target));
        },

        create_pr_item: function(pr_id, department, quarter){
            $('#pr-ppmp-dlg').dialog('open')
                .dialog('refresh', site_url + 'purchase_request/dialog_pr_item/' + pr_id + '/' + department + '/' + quarter)
                .dialog('center')
                .dialog('setTitle','Procurement Plans')

        },

        getChanges: function(){
            var rows = $('#ppmp_pr').datagrid('getChanges');
            alert(rows.length+' rows are changed!');
        },
        save: function(){

            var ss = [];
            var rows = $('#ppmp_pr').datagrid('getSelections');
            for(var i=0; i<rows.length; i++){
                var totRows = $("#pr_items").datagrid('getData');
                $("#pr_items").datagrid('appendRow',rows[i]);
            }

            $("#pr_items").datagrid('getPanel').find('a.easyui-linkbutton').linkbutton();


            var items = $("#pr_items").datagrid('getData');
            $("#pr_item_json").val(JSON.stringify(items.rows));

            $("#pr_items").datagrid('loadData', items);

            $("#pr-ppmp-dlg").dialog('close');
            //$.messager.alert('Info', ss.join('<br/>'));
        },

    loadProcurement: function(pr_id, department, quarter){

        using('plugins/jquery.client.paging.js', function(){

            var items = $("#pr_items").datagrid('getData');
            var rows = items.rows;
            var params = [];
            for(var i=0; i<rows.length; i++){
                params.push(rows[i].ppmp_id);
            }

            $("#ppmp_pr").datagrid({
                url: site_url + "purchase_request/getProcurementPlans/" + department + '/' + quarter + '/' + pr_id,
                method: 'post',
                queryParams: {
                    items: JSON.stringify(params)
                },
                pagination:true,
                pageSize:10,
                rownumbers:true,
                fitColumns:false,
                fit: true,
                singleSelect:false,
                nowrap: false,
                columns:[
                    [
                        /*{field:'ppmp_code',title:'Code',width:'8%'},
                        {field:'cat_description',title:'Category',width:'20%'},*/
                        {field:'qty',title:'Qty',width:'10%',align:'right'},
                        {field:'unit_name',title:'Unit',width:'10%'},
                        {field:'description',title:'Description',width:'45%'},
                        {field:'item_cost',title:'Item Cost',width:'15%',align:'right',
                            formatter: function(value, row, index){
                                return accounting.formatMoney(row.item_cost, "");
                            }
                        },
                        {field:'tot_cost',title:'Total Cost',width:'15%',align:'right',
                            formatter: function(value, row, index){
                                return accounting.formatMoney(row.tot_cost, "");
                            }
                        },
                    ]
                ],
            }).datagrid('clientPaging');
        });
    }
}