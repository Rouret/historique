$(document).ready(function(){
    var ready=false;
    $("#submit").click(function(){
        var host=$("#host").val()
        var dbname=$("#dbname").val()
        var username=$("#username").val()
        var password=$("#password").val()
        if(host!="" && dbname!="" && username!="" && password!=""){
            $.ajax({
                url : '/api/setup.php',
                type : 'GET',
                data : 'host='+host+'&dbname='+dbname+'&username='+username+'&password='+password,
                dataType : 'html',
                success : function(code_html, statut){ // success est toujours en place, bien sûr !
                    var data=JSON.parse(code_html);
                    if(data.hasOwnProperty("success")){
                        ready=true;
                        modal("Success","Wait, u are going to be redirect")
                    }else{
                        modal("Error",data.error)
                    }
                },         
                error : function(resultat, statut, erreur){
                    modal("Error Query",erreur)
                }        
            });
        }
    })
    //depend du component modal
    $("#modal-submit").click(function(){
        if(ready){
            location.href="./main.php";
        }
    })

})