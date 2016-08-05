var routes = {

    procurement_plan: function(){
        $('#main-content').panel('refresh', site_url + 'procurement_plan/procPlan');
    },

    purchase_request: function(){
        $('#main-content').panel('refresh', site_url + 'purchase_request/dataGrid');
    }

}