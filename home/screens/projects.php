<div class="m-2" id="allProjects">
   
</div>
<div class="modal fade" id="modal-add-project" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control"maxlength="30" id="title" name="title">
                        <p class="text-danger" id="project-modal-error-title"></p>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Compagny:</label>
                        <input type="text" class="form-control" maxlength="30" id="compagny" name="compagny">
                        <p class="text-danger" id="project-modal-error-compagny"></p>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Description:</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                        <p class="text-danger" id="project-modal-error-description"></p>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Website:</label>
                        <input type="text" class="form-control" id="website" name="website">
                        <p class="text-danger" id="project-modal-error-website"></p>
                    </div>
                    <p class="text-danger" id="project-modal-error"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="project-add-button" type="submit">Add</button>
            </div>
        </div>
    </div>
</div>
<script>
    init()
    function setError(str,id){
        if(id!="all"){
            $("#project-modal-error-"+id).html(str);
        }else{
            $("#project-modal-error").html(str);
        }
        return false
    }
    function displayProjects(data){
        str=""
        data.forEach(project => {
            str+='<div class="card" id="project'+project.id+'" style="width: 18rem;"><div class="card-body">';
            str+='<h5 class="card-title">'+project.name+'</h5>';
            str+='<h6 class="card-subtitle mb-2 text-muted">'+project.compagny+'</h6>';
            str+='<p class="card-text">'+project.description+'</p>';
            str+='<a href="'+project.website+'" class="card-link">Website</a>';
            str+='</div></div>';
        });
        str+='<button type="button" class="btn btn-primary btn-circle add rotate-90-anim" id="project-lauch-modal">+</button>';
        $("#allProjects").html(str)
    }
    function init(){
        $.ajax({
            url : '/api/project.php',
            type : 'GET',
            data : 'query=get',
            dataType : 'html',
            success : function(code_html, statut){
                var data=JSON.parse(code_html);
                data=data.data;
                displayProjects(data)
                console.log(data)
            },         
            error : function(resultat, statut, erreur){
                modal("Error Query",erreur)
            }        
        });
    }
    function check(){
        var title=$("#title").val();
        var description=$("#description").val();
        var compagny=$("#compagny").val();
        var website=$("#website").val();
        var key_verif=true;
        var str="";
        if(title.length<1 || title.length>30){
            key_verif=setError("Title must be between 1 and 30 in character","title")
        }else{
            setError("","title")
        }
        if(compagny.length<1 || compagny.length>30){
            key_verif=setError("Compagny must be between 1 and 30 in character","compagny")
        }else{
            setError("","compagny")
        }
        if(description.length<1){
            key_verif=setError("Description must be greater than 1 character","description")
        }else{
            setError("","description")
        }
        if(website.length<1 ){
            key_verif=setError("Website must be between 1 and 30 in character","website")
        }else{
            setError("","website")
        }
        if(key_verif){
            console.log("end")
            $.ajax({
                url : '/api/project.php',
                type : 'GET',
                data : 'query=new&title='+title+'&compagny='+compagny+'&description='+description+'&website='+website,
                dataType : 'html',
                success : function(code_html, statut){
                    var data=JSON.parse(code_html);
                    if(data.hasOwnProperty("success")){
                        setError("","title")
                        setError("","compagny")
                        setError("","description")
                        setError("","website")
                        setError("","all")
                        init()
                        $("#modal-add-project").modal("hide");
                        modal("Success","A new project has been created")
                    }else{
                        $("#modal-add-project").modal("hide");
                        modal("Error",data.error)
                    }
                },         
                error : function(resultat, statut, erreur){
                    modal("Error Query",erreur)
                }        
            });
        }
    }
    $("body").on("click","#project-lauch-modal",function(){
        $("#modal-add-project").modal();
    })

    $("#project-add-button").on("click",function(){
        check()
    })

</script>