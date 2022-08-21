// $("#submit_class").on("click",SaveData);


CLASS_loadData();

let UpdateID = 0;
//DATATABLE
$(document).ready(function () {
    $('#classidtable').DataTable();
});
// function SaveData(e) {
 $("#submit_class").on("click",function(event){
    event.preventDefault();

    let classid =$("#clasid").val();
    let className =$("#classname").val();
   
 

    //console.log(classid);
    // console.log(price);
    // console.log(Blance);
    let SendingData ={
            action:"classregester",
            classid:classid,
            className:className,
           
        }


        $.ajax({
            method : "POST",
            dataType : "JSON",
            url : "../api/class.php",
            data : SendingData,
            success : function(response){
                let responseData = response.data;
                DisplayMessage("success",responseData);
               Loads.ReloadCurrentPage();
                loadData();
               
               // Clear(userName,passcode,browseFile);
            },
            error : function(response){
                console.log(response)
                let responseUsers=response.data;
                let statusReponse=response.status;
                let responseFromServer=response['responseText'];
                console.log(response)
                if (statusReponse)
                    DisplayMessage("error",responseUsers);
                else
                DisplayMessage("error",responseFromServer);
            }
        })
    })





    
// display message 
function DisplayMessage(type = "error", message) {
    let success = document.querySelector(".alert-success");

    let error = document.querySelector(".alert-danger");
    if (type == "blank") {
        error.classList = "alert alert-danger ";
        success.classList = "alert alert-success d-none";
        error.innerHTML = message;
        setTimeout(() => {
            error.classList = "alert alert-danger d-none"
        }, 2000)
    }
    else if (type == "success") {
        error.classList = "alert alert-danger d-none";
        success.classList = "alert alert-success";

        success.innerHTML = message;

        setTimeout(() => {
            success.classList = "alert alert-success d-none"
        }, 2000)
    }
    else {
        error.classList = "alert alert-danger";
        error.innerHTML = message;
    }
}


function CLASS_loadData(){
    let sendingData ={
        action:"CLASSRead",

    }
    
    $.ajax({
        method:"POST",
        dataType:"JSON",
        url: "../api/class.php",
        data: sendingData,
        success:function(data){
            // console.log(data)
            let status =data.status;
            let response =data.data;
            let html ='';
            let tr ='';
            if(status){
             response.forEach(res=>{
           tr +="<tr>";
           for(let r in res){
               tr +=`<td>${res[r]}</td>`;
           }

          
          tr+=`<td> <a class="btn  update_info" update_id=${res['classID']}>
          <i class="fas fa-edit"></i></a>&nbsp;
          <a class="btn delete_info" delete_id=${res['classID']}>
          <i class="fas fa-trash bx-danger bx-lg"></i></a></td>`;

          tr+='</tr>';
       })
       $('#classidtable').append(tr)
            }else{
                displymesag("Error",response);
            }
        },
        error:function(data){

        
        }
    })
}


// update data expensiver
$("#submit_updates").on("click",function(event){
    event.preventDefault();

    let class_id=$("#classidupdate").val();
    let className =$("#classnameupdate").val();
   
 

    //console.log(classid);
    // console.log(price);
    // console.log(Blance);
    let SendingData ={
            action:"update_class",
            class_id:class_id,
            Name:className,
            update_id : UpdateID
           
        }


        $.ajax({
            method : "POST",
            dataType : "JSON",
            url : "../api/class.php",
            data : SendingData,
            success : function(response){
                let responseData = response.data;
                DisplayMessage("success",responseData);
                Loads.ReloadCurrentPage();
                
               // Clear(userName,passcode,browseFile);
            },
            error : function(response){
                console.log(response)
                let responseclass=response.data;
                let statusReponse=response.status;
                let responseFromServer=response['responseText'];
                if (statusReponse)
                {
                    DisplayMessage("error",responseclass);
                    Loads.ReloadCurrentPage();
                    loadData();
                }
                else
                DisplayMessage("error",responseFromServer);
            }
        })
    })
// display message 
function DisplayMessages(type = "error", message) {
    let success = document.querySelector(".alert-success");

    let error = document.querySelector(".alert-danger");
    if (type == "blank") {
        error.classList = "alert alert-danger ";
        success.classList = "alert alert-success d-none";
        error.innerHTML = message;
        setTimeout(() => {
            error.classList = "alert alert-danger d-none"
        }, 2000)
    }
    else if (type == "success") {
        error.classList = "alert alert-danger d-none";
        success.classList = "alert alert-success";

        success.innerHTML = message;

        setTimeout(function(){
            $("#updateModal").modal('hide');
            success.classList='alert alert-warning d-none ';
            $("#DISPLY")[0].reset();

        },1000);
    }
    else {
        error.classList = "alert alert-danger";
        error.innerHTML = message;
    }
}

$("#classidtable tbody").on("click", "a.update_info", function () {
    let id = $(this).attr("update_id");
    let data = {
        action: "fecthclassess",
        id: id
    }
    
    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "../api/class.php",
        data: data,
        success: function (response) {
            let data = response.data;
            console.log(data);
            let {classID,  Name } = response.data[0];
            UpdateID = classID;
            $("#classidupdate").val(classID);
            $("#classnameupdate").val(Name);
          
           console.log(UpdateID)
             $("#updateModal").modal("show");
        },
        error: function (response) {
            console.log(response)
        }
    })

})






function feach_class_Delate(id){

    let SendingData ={
            
        action:"class_delete",
        
        "id":id
    
    
    }
    
    $.ajax({
        method:"POST",
        dataType:"JSON",
        url:"../api/class.php",
        data: SendingData,
        success:function(data){
            // console.log(data)
            let status =data.status;
            let response =data.data;
            let html ='';
            let tr ='';
            if(status){    
            swal("Good job!", response, "success");
            Loads.ReloadCurrentPage();
         
            }else{
            swal(response);
            
            }
        },
        error:function(data){
    
    
        
        }
    })
    
    } 
$('#classidtable').on("click","a.delete_info",function(){
    // console.log("table cilick");
    let id = $(this).attr("delete_id");
        
    console.log(id);
   
    swal({
        title: "Dagniin Dagniin?",
        text: "Ma u bahantahay inaad tirtirto",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
         
          feach_class_Delate(id)
        } else {
          swal("wekuu badbaday datadada");
        }
      });
       
    
    
    
    
    
    })   



// class Loads
class Loads{
    /**
     * Loads Current page to make Refresh
     */
    static ReloadCurrentPage(){
        window.location.reload();
    }
}