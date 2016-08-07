var routes = {

    procurement_plan: function(){
        $('#main-content').panel('refresh', site_url + 'procurement_plan/procPlan');
    },

    purchase_request: function(){
        $('#main-content').panel('refresh', site_url + 'purchase_request/dataGrid');
    },

    underconstruction: function(){
        $.messager.alert('Under Construction', 'This module is under construction', 'info');
    },

    // Employees
    employees: function() {
        $('#main-content').panel('refresh', site_url + 'employees');
    },



    // Source Funds
    funds: function() {
        $('#main-content').panel('refresh', site_url + 'funds');
    }

}