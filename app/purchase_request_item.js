
var request_items = {

        editIndex: undefined,

        loadRequestItems: function(pr_id){


            using('plugins/jquery.client.paging.js', function(){
                $("#pr_items").datagrid({
                    url: site_url + "purchase_request/getRequestItems/" + pr_id,
                    toolbar: [
                        {
                            text: 'Add Item',
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
                        '-',
                        {
                            text: 'Edit Item',
                            iconCls: 'icon-edit',
                            handler: function(){
                                //request_items.update();
                            }
                        },
                        '-',
                        {
                            text: 'Delete Item',
                            iconCls: 'icon-remove',
                            handler: function(){

                            }
                        }
                    ],
                    pagination:"true",
                    pageSize:10,
                    rownumbers:"true",
                    fitColumns:"true",
                    fit: "true",
                    singleSelect:"true",
                    columns:[
                        [
                            {field:'ppmp_code',title:'Code',width:'5%'},
                            {field:'ppmp_description',title:'Description',width:'30%'},
                            {field:'qty',title:'Qty',width:'15%',align:'right'},
                            {field:'unit_name',title:'Unit',width:'20%'},
                            {field:'qty_cost',title:'Cost',width:'15%',align:'right'},
                            {field:'ppmp_id',title:'',width:'10%',align:'center',formatter: function(value,row,index){
                                return '<a id="btn" href="#" class="easyui-linkbutton" data-options="iconCls:\'icon-search\'" onclick="request_items.pr_details()">&nbsp;</a>'
                                +'<a id="btn" href="#" class="easyui-linkbutton" data-options="iconCls:\'icon-remove\'" onclick="request_items.deleteRequestItemGridRow(\'' + index +'\')">&nbsp;</a>';
                            }}
                        ]
                    ],
                    onDblClickCell: request_items.onClickCell,
                    onEndEdit: request_items.onEndEdit,
                    onLoadSuccess:function(){
                        $(this).datagrid('getPanel').find('a.easyui-linkbutton').linkbutton();

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

        checkItems: function(){

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
                if (request_items.endEditing()){
                    $('#pr_items').datagrid('selectRow', index)
                        .datagrid('beginEdit', index);
                    var ed = $('#pr_items').datagrid('getEditor', {index:index,field:field});
                    if (ed){
                        ($(ed.target).data('textbox') ? $(ed.target).textbox('textbox') : $(ed.target)).focus();


                    }
                    request_items.editIndex = index;
                } else {
                    setTimeout(function(){
                        $('#pr_items').datagrid('selectRow', request_items.editIndex);
                    },0);
                }
            }
        },
        onEndEdit: function(index, row){
            /*var ed = $('#ppmp_pr').datagrid('getEditor', {
                index: index,
                field: 'ppmp_id'
            });
            row.productname = $(ed.target).combobox('getText');*/
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
                //nowrap: false,
                columns:[
                    [
                        {field:'ppmp_code',title:'Code',width:'8%'},
                        {field:'ppmp_description',title:'Description',width:'40%'},
                        {field:'qty',title:'Qty',width:'15%',align:'right'},
                        {field:'unit_name',title:'Unit',width:'20%'},
                        {field:'qty_cost',title:'Cost',width:'15%',align:'right'},
                    ]
                ],
            }).datagrid('clientPaging');
        });
    }
}