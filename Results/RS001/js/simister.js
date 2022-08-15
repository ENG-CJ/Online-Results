


CLASS_loadData();
countSmister();
// add new 
$("#addsmister").on("click", function (e) {
    $("#SimesterModal").modal("show")
})


//DATATABLE
$(document).ready(function () {
    $('#simistertable').DataTable();
});

$("#savebtn").on("click",SaveData_simester);


// save Data function
function SaveData_simester(e) {
    e.preventDefault();
   let simister_id= $("#simisterID").val();
    let simisterName = $("#simistername").val();
  
    let data ={
        action : "insert_simister",
        simister_id: simister_id,
        simistername : simisterName
      
       
       
    }
    console.log(data)
    $.ajax({
        method : "POST",
        dataType : "JSON",
        url : "../api/simester.php",
        data : data,
        success : function(response){
            let responseData = response.data;
            DisplayMessage("success",responseData);
            loadData();
           // Clear(userName,passcode,browseFile);
        },
        error : function(response){
            console.log(response)
            let responseUsers=response.data;
            let statusReponse=response.status;
            let responseFromServer=response['responseText'];
            if (statusReponse)
                DisplayMessage("error",responseUsers);
            else
            DisplayMessage("error",responseFromServer);
        }
    })
}
    
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

//simistertable



function CLASS_loadData(){
    let sendingData ={
        action:"simisterRead",

    }
    
    $.ajax({
        method:"POST",
        dataType:"JSON",
        url: "../api/simester.php",
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

          
          tr+=`<td> <a class="btn  update_info" update_id=${res['ID']}>
          <i class="fas fa-edit"></i></a>&nbsp;
          <a class="btn delete_info" delete_id=${res['ID']}>
          <i class="fas fa-trash bx-danger bx-lg"></i></a></td>`;

          tr+='</tr>';
       })
       $('#simistertable').append(tr)
            }else{
                displymesag("Error",response);
            }
        },
        error:function(data){

        
        }
    })
}




// update data expensiver
$("#simister_updates").on("click",function(event){
    event.preventDefault();

    let ID=$("#simisterIDupdate").val();
    let Name =$("#simisternameupdate").val();
   
 

    //console.log(simisterid);
    // console.log(price);
    // console.log(Blance);
    let SendingData ={
            action:"update_simester",
            simister_id:ID,
            Name:Name,
            update_id : UpdateID
           
        }


        $.ajax({
            method : "POST",
            dataType : "JSON",
            url : "../api/simester.php",
            data : SendingData,
            success : function(response){
                let responseData = response.data;
                DisplayMessages("success",responseData);
                
               // Clear(userName,passcode,browseFile);
            },
            error : function(response){
                console.log(response)
                let responseclass=response.data;
                let statusReponse=response.status;
                let responseFromServer=response['responseText'];
                if (statusReponse)
                    DisplayMessages("error",responseclass);
                else
                DisplayMessages("error",responseFromServer);
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
            $("#update_simister_Modal").modal('hide');
            success.classList='alert alert-warning d-none ';
            $("#DISPLY")[0].reset();

        },1000);
    }
    else {
        error.classList = "alert alert-danger";
        error.innerHTML = message;
    }
}

$("#simistertable tbody").on("click", "a.update_info", function () {
    let id = $(this).attr("update_id");
    let data = {
        action: "fecthsimester",
        id: id
    }
    
    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "../api/simester.php",
        data: data,
        success: function (response) {
            let data = response.data;
            console.log(data);
            let {ID,  Name } = response.data[0];
            UpdateID = ID;
            $("#simisterIDupdate").val(ID);
            $("#simisternameupdate").val(Name);
          
           console.log(UpdateID)
             $("#update_simister_Modal").modal("show");
        },
        error: function (response) {
            console.log(response)
        }
    })

})



// count smster from database

function countSmister(){
   
    let data = {
        action: "countSmister"
    };
    $.ajax({
        method: 'POST',
        dataType: "JSON",
        data: data,
        url: "../api/simester.php",
        success: function (response) {
            let responseDATA = response.data[0]['Rows'];
            console.log(responseDATA); 
            $("#count_simister").html(responseDATA) 

        },
        error: function (response) {
           
        }
    });

}

//DELATES




function feach_class_Delate(id){

    let SendingData ={
            
        action:"smister_delete",
        
        "id":id
    
    
    }
    
    $.ajax({
        method:"POST",
        dataType:"JSON",
        url:"../api/simester.php",
        data: SendingData,
        success:function(data){
            // console.log(data)
            let status =data.status;
            let response =data.data;
            let html ='';
            let tr ='';
            if(status){
    
            swal("Good job!", response, "success");
         
        
            
                
                
            
            
    
    
            }else{
            swal(response);
            
            }
        },
        error:function(data){
    
    
        
        }
    })
    
    } 
$('#simistertable').on("click","a.delete_info",function(){
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
          swal("Dagnin! ma u bahantahay inaad tirtirto", {
            icon: "success",
          });
          feach_class_Delate(id)
        } else {
          swal("wekuu badbaday datadada");
        }
      });
       
    
    
    
    
    
    })   




