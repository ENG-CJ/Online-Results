
loadData();
countUsers();
// variables
let UpdateID = 0;
// end 

// jquery events
$("#newUser").on("click", function (e) {
    $("#userModal").modal("show")
})


$("#saveData").on("click",SaveData);
$("#editData").on("click",Update);

// functions
function DisplayPhoto(e){
    ReadImage(browseFile);
} 


function ReadImage(input){
    if (input && input.files[0]){
        var reader = new FileReader();
        reader.onload=function(e){
            displayImage.src=e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
function Update(e) {
    e.preventDefault();
   
    let user_id= $("#ui_user_id").val();
    let userName = $("#ui_Username").val();
    let passcode = $("#ui_password").val();
    let status = $("#ui_status").val();
    let role = $("#user_type").val();
    let data ={
        action : "update",
        user_id: user_id,
        username : userName,
        password : passcode,
        role : role,
        status : status,
        update_id : UpdateID
       
       
    };

    $.ajax({
        method : "POST",
        dataType : "JSON",
        url : "../api/users.php",
        data : data,
        success : function(response){
            let responseData = response.data;
          alert("Successfully Updated...")
            loadData();
           // Clear(userName,passcode,browseFile);
        },
        error : function(response){
           
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

// save Data function
function SaveData(e) {
    e.preventDefault();
   let user_id= $("#userID").val();
    let userName = $("#Username").val();
    let passcode = $("#password").val();
    let status = $("#status").val();
    let role = $("#type").val();
    let data ={
        action : "insert",
        user_id: user_id,
        username : userName,
        password : passcode,
        role : role,
        status : status
       
       
    }
    console.log(data)
    $.ajax({
        method : "POST",
        dataType : "JSON",
        url : "../api/users.php",
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

// delete data
function DeleteUser(id) {
    let data = {
        action: "delete",
        id: id
    }
    $.ajax({
        method: 'POST',
        dataType: "JSON",
        data: data,
        url: "../api/users.php",
        success: function (response) {


            let status = response.status;
            let message = response.data;
            if (status) {
                Swal.fire(
                    'Commits',
                    message,
                    'success'
                );
                loadData();
            }

        },
        error: function (response) {
            console.log(response)
            let responseMessage = response.data;
            DisplayMessage("error", response)
        }
    });
}

function loadData() {
    $("#usersTable tbody").html("");
    let data = {
        action: "read"
    };
    $.ajax({
        method: 'POST',
        dataType: "JSON",
        data: data,
        url: "../api/users.php",
        success: function (response) {

            let responseDATA = response.data;
            let tr = "";
            responseDATA.forEach((items) => {
                tr += "<tr>";
                for (item in items) {
                    if (item == "Photo")
                        tr += `<td><img style="border: 1px solid silver; width : 50px; height: 50px; border-radius: 50%" src="../uploads/${items[item]}"></td>`
                    else
                        tr += `<td>${items[item]}</td>`
                }
                tr += `<td><i class="fas fa-edit edit_user" edit_user_id=${items['ID']} style='cursor: pointer; margin-right: 10px; font-size: 26px; color: green;'></i> <i class="fa-solid fa-trash delete" delete_id=${items['ID']} style=' font-size: 26px; color: red;'></i> </td>`
            })
            $("#usersTable tbody").append(tr);

        },
        error: function (response) {
            console.log(response)
            let responseFromServer= response['responseText'];
            let responseFromLocal= response.data;
            let status = response.status;
            if (status)
                return;
            else
            alert(responseFromServer)
        }
    });

}



// count Users from database

function countUsers() {
   
    let data = {
        action: "countUser"
    };
    $.ajax({
        method: 'POST',
        dataType: "JSON",
        data: data,
        url: "../api/users.php",
        success: function (response) {
            let responseDATA = response.data[0]['Rows'];
            console.log(responseDATA); 
            $("#count").html(responseDATA) 

        },
        error: function (response) {
           
        }
    });

}
// make request function
function PostRequest(data) {
    $.ajax({
        method: 'POST',
        dataType: "JSON",
        data: data,
        url: "../api/api.php",
        success: function (response) {

            let responseDATA = response.data;
            DisplayMessage("success", responseDATA)
            loadData();

        },
        error: function (response) {
            let responseMessage = response.data;
            DisplayMessage("error", response)
        }
    });
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
/// validations
function Validate(amount, user_id, description) {
    if (amount == "" || user_id == "" || description == "")
        return true;
    else
        return false;
}

function Clear(username, password, img) {
    username="";
    password="";
    img.files=null;
}
//DATATABLE
$(document).ready(function () {
    $('#usersTable ').DataTable();
});

$("#usersTable tbody").on("click", "i.edit_user", function () {
    let id = $(this).attr("edit_user_id");
    let data = {
        action: "searchUser",
        id: id
    }
    
    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "../api/users.php",
        data: data,
        success: function (response) {
            let data = response.data;
            console.log(data);
            let { ID, Password, User_Type, Status, Username } = response.data[0];
            UpdateID = ID;
            $("#ui_user_id").val(ID);
            $("#ui_Username").val(Username);
            $("#ui_password").val(Password);
            $("#ui_status").val(Status);
            $("#user_type").val(User_Type);
           console.log(UpdateID)
             $("#editModal").modal("show");
        },
        error: function (response) {
            console.log(response)
        }
    })

})
$("#usersTable tbody").on("click", "i.delete", function () {
    Swal.fire({
        title: 'Are you sure?',
        text: "Do You Want To Continue To Delete This Record!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            let userID = $(this).attr("delete_id")
            console.log(userID)
            DeleteUser(userID)
        }
        else
            return;
    })

})