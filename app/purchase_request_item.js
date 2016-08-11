
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
                        },
                    ],
                    pagination:"true",
                    pageSize:10,
                    rownumbers:"true",
                    fitColumns:"true",
                    nowrap: false,
                    fit: true,
                    singleSelect:"true",
                    columns:[
                        [
                            {field:'ppmp_code',title:'Code',width:'4%'},
                            {field:'cat_description',title:'Category',width:'20%'},
                            {field:'description',title:'Description',width:'20%'},
                            {field:'qty',title:'Qty',width:'10%',align:'right',editor:{
                                type: 'numberbox',options:{
                                    precision: 2,
                                    filter: function(e, row){
                                        if(!isNaN(e.key)){
                                            return true;
                                        }else{
                                            if(e.keyCode == 46){
                                                return true;
                                            }
                                            if(e.keyCode == 13){
                                                request_items.endEditing();
                                                return true;
                                            }
                                            return false;
                                        }
                                    }
                                }
                            }},
                            {field:'unit_name',title:'Unit',width:'10%'},
                            {field:'item_cost',title:'Item Cost',width:'10%',align:'right',editor:{
                                type: 'numberbox',options:{
                                    precision: 2,
                                    filter: function(e){
                                        if(!isNaN(e.key)){
                                            return true;
                                        }else{
                                            if(e.keyCode == 46){
                                                return true;
                                            }
                                            if(e.keyCode == 13){
                                                request_items.endEditing();
                                                return true;
                                            }
                                            return false;
                                        }
                                    }
                                }
                            }},
                            {field:'tot_cost',title:'Cost',width:'10%',align:'right',editor:{
                                type: 'numberbox',
                                options:{
                                    precision: 2
                                }
                            }},
                            {field:'ppmp_id',title:'',width:'12%',align:'center',formatter: function(value,row,index){
                                /*return '<a id="btn" href="#" class="easyui-linkbutton" style="color: #fff" onclick="request_items.onClickCell()">details</a> | '
                                +'<a id="btn" href="#" class="easyui-linkbutton" style="color: #fff;" onclick="request_items.deleteRequestItemGridRow(\'' + index +'\')">remove</a>';*/
                                return '<a id="btn" href="#" class="easyui-linkbutton" style="color: #fff;" onclick="request_items.deleteRequestItemGridRow(\'' + index +'\')">remove</a>';
                            }}
                        ]
                    ],
                    onDblClickCell: request_items.onDblClickCell,
                    onEndEdit: request_items.onEndEdit,
                    onClickCell: request_items.onClickCell,
                    onBeginEdit: request_items.calculateCost,
                    onLoadSuccess:function(){
                        //$(this).datagrid('getPanel').find('a.easyui-linkbutton').linkbutton();


                        request_items.editIndex = undefined;

                    }
                }).datagrid('clientPaging');
            });

        },

        deleteRequestItemGridRow: function(index){
            $("#pr_items").datagrid('deleteRow', index);
        },

        pr_details: function(){
            alert("SDLFKJS");
        },


        create_pr_item: function(pr_id, department, quarter){
            $('#pr-ppmp-dlg').dialog('open')
                .dialog('refresh', site_url + 'purchase_request/dialog_pr_item/' + pr_id + '/' + department + '/' + quarter)
                .dialog('center')
                .dialog('setTitle','Procurement Plans')

        },


        calculateCost: function(rowIndex){
            var editors = $('#pr_items').datagrid('getEditors', rowIndex);
            var n1 = $(editors[0].target);
            var n2 = $(editors[1].target);
            var n3 = $(editors[2].target);

            n1.add(n2).numberbox({
                onChange:function(){
                    var cost = n1.numberbox('getValue') * n2.numberbox('getValue');
                    n3.textbox('setValue',cost.toFixed(2));
                }
            })
        },

        endEditing: function (){
            if (request_items.editIndex == undefined){return true}
            if ($('#pr_items').datagrid('validateRow', request_items.editIndex)){
                $('#pr_items').datagrid('endEdit', request_items.editIndex);
                request_items.editIndex = undefined;
                return true;
            } else {
                return false;
            }
        },
        onClickCell: function(index, field){
            if (request_items.editIndex != index){
                request_items.endEditing();
            }
        },
        onDblClickCell: function(index, field){

            if (request_items.editIndex != index){
                if (request_items.endEditing()){
                    $('#pr_items').datagrid('selectRow', index)
                        .datagrid('beginEdit', index);
                    var ed = $('#pr_items').datagrid('getEditor', {index:index,field:field});
                    if (ed){
                        if($(ed.target).data('textbox'))
                        {
                            $(ed.target).textbox('textbox').focus().select().bind('keyup', function(e)
                            {
                                var code = e.keyCode || e.which;
                                if(code == 13) { //Enter keycode
                                    alert("LSDKFJS");
                                    request_items.endEditing();
                                }
                            })
                        }else{
                            $(ed.target).focus();
                        }


                    }
                    request_items.editIndex = index;
                } else {
                    setTimeout(function(){
                        $('#pr_items').datagrid('selectRow', request_items.editIndex);
                    },0);
                }
            }
        },
        onEndEdit: function(index, row, changes){

            //TO DO: check the maximum limit of budget
            /*if(changes.cost*1 > row.limit_budget*1){
                $.messager.alert("Warning", "You entered " + changes.cost +", should not greater than the maximum budget " + row.limit_budget, 'warning');

                $("#pr_items").datagrid('updateRow',{
                    index: index,
                    row: {
                        cost: row.limit_budget
                    }
                });
            }

             if(changes.qty*1 > row.limit_qty*1){
                $.messager.alert("Warning", "You entered " + changes.qty +", should not greater than the maximum quantity " + row.limit_qty, 'warning');

                 $("#pr_items").datagrid('updateRow',{
                     index: index,
                     row: {
                         qty: row.limit_qty
                     }
                 });
             }*/

        },
        append: function(){

        /*
            if (request_items.endEditing()){
                $('#ppmp_pr').datagrid('appendRow',{status:'P'});
                request_items.editIndex = $('#dg').datagrid('getRows').length-1;
                $('#ppmp_pr').datagrid('selectRow', request_items.editIndex)
                    .datagrid('beginEdit', request_items.editIndex);
            }*/
        },
        removeit: function(){
            if (request_items.editIndex == undefined){return}
            $('#pr_items').datagrid('cancelEdit', request_items.editIndex)
                .datagrid('deleteRow', request_items.editIndex);
            request_items.editIndex = undefined;
        },
        accept: function(){
            if (request_items.endEditing()){
                $('#ppmp_pr').datagrid('acceptChanges');
            }
        },
        reject: function(){
            $('#ppmp_pr').datagrid('rejectChanges');
            request_items.editIndex = undefined;
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
                pagination:"true",
                pageSize:10,
                rownumbers:"true",
                fitColumns:"true",
                fit: "true",
                singleSelect:false,
                nowrap: false,
                columns:[
                    [
                        {field:'ppmp_code',title:'Code',width:'8%'},
                        {field:'cat_description',title:'Category',width:'20%'},
                        {field:'description',title:'Description',width:'20%'},
                        {field:'qty',title:'Qty',width:'10%',align:'right'},
                        {field:'unit_name',title:'Unit',width:'10%'},
                        {field:'item_cost',title:'Item Cost',width:'15%'},
                        {field:'tot_cost',title:'Cost',width:'15%',align:'right'},
                    ]
                ],
            }).datagrid('clientPaging');
        });
    }
}