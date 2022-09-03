$("#mail").click((e)=>{
e.preventDefault();
    $("#contactModal").modal("show");
   
})

$("#send").click((e)=>{
    e.preventDefault();
   

    if ($("#email").val()=="" || $("#message").val()=="")
       setMessage("error","Plz Fill Required Information 😊🙂")
    else{
        let data ={
            action  : "sendMail",
            emailAddress : $("#email").val(),
            message : $("#message").val()
        }
        SendMyEmail(data);
    }
    
})



function setMessage(type,msg){
    var error_message=`<div class="col-12">
    <div class="alert alert-danger" role="alert">
${msg}
</div>
    </div>`;

    if (type=="error"){
        $(".display-error").html(error_message);
       setTimeout(()=>{
        $(".display-error").html("");
       },2000)

    }
}

function SendMyEmail(data){
    console.log(data);
}