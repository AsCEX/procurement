var routes = {

    procurement_plan: function(){
        $('#main-content').panel('refresh', site_url + 'procurement_plan/procPlan');
    },

    purchase_request: function(){
        $('#main-content').panel('refresh', site_url + 'purchase_request/dataGrid');
    },


    biddings: function(){
        $('#main-content').panel('refresh', site_url + 'bids/content');
    },

    underconstruction: function(){
        $.messager.alert('Under Construction', 'This module is under construction', 'info');
    },

    // Employees
    employees: function() {
        $('#main-content').panel('refresh', site_url + 'employees');
    },

    // Suppliers
    suppliers: function() {
        $('#main-content').panel('refresh', site_url + 'suppliers');
    },

    // Positions
    positions: function() {
        $('#main-content').panel('refresh', site_url + 'positions');
    },

    // Departments
    offices: function() {
        $('#main-content').panel('refresh', site_url + 'offices');
    },

    // Categories
    categories: function() {
        $('#main-content').panel('refresh', site_url + 'categories');
    },

    // Stocks
    stocks: function () {
        $('#main-content').panel('refresh', site_url + 'stocks');
    },

    // Source Funds
    funds: function() {
        $('#main-content').panel('refresh', site_url + 'funds');
    },

    // Units
    units: function() {
        $('#main-content').panel('refresh', site_url + 'units');
    },

    items: function() {
        $('#main-content').panel('refresh', site_url + 'items');
    }

}
