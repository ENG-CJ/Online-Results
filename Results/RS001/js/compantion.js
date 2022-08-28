companetion();
GetuserNames();
GetstudentNames() ;
 $("#savecompanetion").on("click",SaveData_companetion);




 $("#username").attr("disabled",true);

 $("#studentname").attr("disabled",true);

$(document).on('click','.btnremove',function(){
    $(this).closest('tr').remove();
   
  })//btn remove end


$(".students").on("change",function(){
    if($("#role").val() == 'student'){
        $("#studentname").attr("disabled",false);
        $("#username").attr("disabled",true);
    }else if($("#role").val() == 'Admin'){
        $("#username").attr("disabled",false);
        $("#studentname").attr("disabled",true);
    }else if($("#role").val() == 'User'){
        $("#username").attr("disabled",false);
        $("#studentname").attr("disabled",true);    
        }else{
            $("#username").attr("disabled",true);

            $("#studentname").attr("disabled",true);
        }

      });



      // save Data function
function SaveData_companetion(e) {
    e.preventDefault();
    let username= $("#username").val();
    let studentS= $("#studentname").val();
    let bassword = $("#bassword").val();
    let role= $("#role").val();
    let status = $("#status").val();
    let data ={
        action : "insert_companetion",
        student:studentS,
        username: username,
        bassword : bassword,
        role: role,
      
        status : status

      
      
       
       
    }
    console.log(data)
    $.ajax({
        method : "POST",
        dataType : "JSON",
        url : "../api/companetion.php",
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

        setTimeout(() => {
            error.classList = "alert alert-danger d-none"
        }, 2000)
    }
}

//** gets All users Names From the database **/
function GetuserNames() {

    let belongsusers = $("#username");
    let data = {
        action: "readusers"
    };
    $.ajax({
        method: 'POST',
        dataType: "JSON",
        data: data,
        url: "../api/companetion.php",
        success: function (response) {
            let option = "";
            let ResponseData = response.data;
            option += '<option value="Select">Select</option>'
            ResponseData.forEach((s) => {

                for (Username in s) {
                    option += `<option value='${s[Username]}'>${s[Username]}`;
                }
                option += "</option>";
            })
            belongsusers.html(option);
        },
        error: function (response) {
            console.log(response)
            let responseFromServer = response['responseText'];
            let responseFromLocal = response.data;
            let status = response.status;

        }
    });

}
/// all student names

function GetstudentNames() {

    let belongstudents = $("#studentname");
    let data = {
        action: "readstudent"
    };
    $.ajax({
        method: 'POST',
        dataType: "JSON",
        data: data,
        url: "../api/companetion.php",
        success: function (response) {
            let option = "";
            let ResponseData = response.data;
            option += '<option value="Select">Select</option>'
            ResponseData.forEach((s) => {

                for (students in s) {
                    option += `<option value='${s[students]}'>${s[students]}`;
                }
                option += "</option>";
            })
            belongstudents.html(option);
        },
        error: function (response) {
            console.log(response)
            let responseFromServer = response['responseText'];
            let responseFromLocal = response.data;
            let status = response.status;

        }
    });    




}






// load student all read table    

function companetion(){
    $("#companetionTable tbody").html("");
    let data = {
        action: "readCompanetion"
    };
    $.ajax({
        method: 'POST',
        dataType: "JSON",
        data: data,
        url: "../api/companetion.php",
        success: function (response) {

            let responseDATA = response.data;
            let tr = "";
            responseDATA.forEach((items) => {
                tr += "<tr>";
                for (i in items) {
                    tr += `<td>${items[i]}</td>`
                }
                tr += `<td> <i class="fa-solid fa-trash delete" delete_id=${items['id']} style=' font-size: 26px; color: red;'></i> </td>`
            })
            $("#companetionTable tbody").append(tr);

        },
        error: function (response) {
            console.log(response)
            let responseFromServer = response['responseText'];
            let responseFromLocal = response.data;
            let status = response.status;
            if (status)
                return;
            else
                alert(responseFromServer)
        }
    });

}





/// delates

//DELATES




function feach_combanetion_Delate(id){

    let SendingData ={
            
        action:"combanetion_delete",
        
        "id":id
    
    
    }
    
    $.ajax({
        method:"POST",
        dataType:"JSON",
        url:"../api/companetion.php",
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
$('#companetionTable').on("click","i.delete",function(){
    // console.log("table cilick");
    let id = $(this).attr("delete_id");
        
    console.log(id);
   
   
        Swal.fire({
            title: 'Are you sure?',
            text: "Do You Want To Continue To Delete This Record!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
      })
      .then((willDelete) => {
        if (willDelete) {
          swal("Dagnin! ma u bahantahay inaad tirtirto", {
            icon: "success",
          });
          feach_combanetion_Delate(id)
        } else {
          swal("wekuu badbaday datadada");
        }
      });
       
    
    
    
    
    
    })   

    // $(document).ready( function(){
    //     $("#companetionTable").DataTable({
    //         "order":[[0,"desc"]]
    //     });
    // });