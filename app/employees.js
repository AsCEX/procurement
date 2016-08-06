
var employees = {
    
    init: function() {
        this.datagrid();
        // this.dialog();
    },
    initForms: function() {
        
    },

    datagrid: function() {

        using('plugins/jquery.client.paging.js', function(){

            $('#dg').datagrid({
                url: site_url + "employees/getEmployees",
                toolbar: [
                    {
                        text: 'Add Employee',
                        iconCls: 'icon-add',
                        handler: function() {
                            employees.create();
                        }
                    },
                    '-',
                    {
                        text: 'Edit Employee',
                        iconCls: 'icon-edit',
                        handler: function() {
                            employees.update();
                        }
                    },
                    '-',
                    {
                        text: 'Delete Employee',
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
                        {field:'pos_name',title:'Position',width:'10%'},
                        {field:'ui_firstname',title:'Firstname',width:'10%'},
                        {field:'ui_middlename',title:'Middle Name',width:'10%',align:'right'},
                        {field:'ui_lastname',title:'Lastname',width:'10%'},
                        {field:'ui_extname',title:'Ext. Name',width:'10%'},
                        {field:'ui_address',title:'Address',width:'30%'},
                        {field:'ui_birthdate',title:'Birthdate',width:'10%'},
                    ]
                ]
            }).datagrid('clientPaging');
        });
    }
}
