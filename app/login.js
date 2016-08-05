
var pim_login = {
    login: function(){

        $('#fm-login').form('submit',{
            url: site_url + 'auth/doLogin',
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){

                if(result){
                    window.location.reload();
                }else{
                    $.messager.alert('Warning','Invalid Account', 'error');
                }
            }
        });
    },

    check: function(){
        alert("SDFSD");
    }
}