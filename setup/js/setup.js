$(document).ready(function(){
    $("#submit").click(function(){
        var host=$("#host").val()
        var dbname=$("#dbname").val()
        var username=$("#username").val()
        var password=$("#password").val()
        console.log(host)
        console.log(dbname)
        console.log(username)
        console.log(password)
        if(host!="" && dbname!="" && username!="" && password!=""){
            $("#submit").click(function(){
                $.ajax({
                    url : '/api/setup.php',
                    type : 'GET',
                    data : 'host='+host+'&dbname='+dbname+'&username='+username+'&password='+password,
                    dataType : 'html',
                    success : function(code_html, statut){ // success est toujours en place, bien sûr !
                        var data=JSON.parse(code_html);
                        if(data.hasOwnProperty("success")){
                            alert("ok")
                        }else{
                            alert(data.error)
                        }
                    },         
                    error : function(resultat, statut, erreur){         
                    }        
                });
            });            
        }
    })
})