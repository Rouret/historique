<div class="register h-100 ">
    <div class="row">
        <div class="col-md-3 register-left">
            <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
            <h3>Welcome</h3>
            <p>You need to put some data before to use Historique</p>
        </div>
        <div class="col-md-9 register-right">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <h3 class="register-heading">About you</h3>
                    <div class="row register-form">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control elment" placeholder="First Name *" value="" id="firstname"/>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control elment" placeholder="Last Name *" value="" id="lastname"/>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control elment" placeholder="Email *" value="" id="email"/>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control elment"  placeholder="Phone *" value="" id="phone"/>
                            </div>
                        </div>
                        <input type="submit" class="btnRegister col-md-3" id="save" value="Save"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $.ajax({
        url : '/api/me.php',
        type : 'GET',
        data : 'query=get',
        dataType : 'html',
        success : function(code_html, statut){
            var data=JSON.parse(code_html);
            if(data.hasOwnProperty("data")){
                data=data.data
                $("#firstname").val(data.firstname);
                $("#lastname").val(data.lastname);
                $("#email").val(data.email);
                $("#phone").val(data.tel);
            }
        },         
        error : function(resultat, statut, erreur){
            modal("Error Query",erreur)
        }        
    });
    $("#save").click(function(){
        var firstname=$("#firstname").val();
        var lastname=$("#lastname").val();
        var email=$("#email").val();
        var phone=$("#phone").val();
        if(firstname!="" && lastname!="" && email!="" && phone!=""){
            console.log('firstname='+firstname+'&lastname='+lastname+'&email='+email+'&phone='+phone)
            $.ajax({
                url : '/api/me.php',
                type : 'GET',
                data : 'query=new&firstname='+firstname+'&lastname='+lastname+'&email='+email+'&phone='+phone,
                dataType : 'html',
                success : function(code_html, statut){
                    var data=JSON.parse(code_html);
                    console.log(data);
                    if(data.hasOwnProperty("success")){
                        modal("Success","Data saved, we can now use historique, and at any time u can change your data")
                    }else{
                        modal("Error",data.error)
                    }
                },         
                error : function(resultat, statut, erreur){
                    modal("Error Query",erreur)
                }        
            });
        }else{
            modal("Error form","You need to fill all field")
        }
    })
</script>