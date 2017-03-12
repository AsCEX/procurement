
var biddings = {

    pri_id: 0,
    init: function(){
        this.datagrid();
        this.dialog();

    },


    datagrid: function(){
            $("#bids-dg").datagrid({
                url: site_url + "bids/getBids",
                toolbar: [
                    {
                        text: 'Create Request',
                        iconCls: 'icon-add',
                        handler: function(){
                            purchase_request.create();

                        }
                    },
                    '-',
                    {
                        text: 'Edit Request',
                        iconCls: 'icon-edit',
                        handler: function(){
                            purchase_request.update();
                        }
                    },
                    '-',
                    {
                        text: 'Delete Request',
                        iconCls: 'icon-remove',
                        handler: function(){

                        }
                    }
                ],
                pagination:true,
                pageSize:10,
                //rownumbers:true,
                fitColumns:false,
                singleSelect:true,
                emptyMsg: "No Records",
                view: groupview,
                groupField:'pri_id',
                groupFormatter:function(value,rows){
                    console.log(rows);
                    return "PR #" + rows[0].pr_code_id + " : " + "(<strong>" + rows[0].pri_description + "</strong>)";
                },
                columns:[
                    [
                        {field:'bids_id',title:'ID',width:'5%'},
                        {field:'pr_code_id',title:'Code',width:'15%'},
                        {field:'supp_business_name',title:'Department',width:'25%'},
                        {field:'bids_remarks',title:'Date',width:'20%'},
                    ]
                ],
            });
    },

    dialog: function(){

    },

}