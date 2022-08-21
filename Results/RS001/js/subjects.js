
loadData();
countUsers();
GetSemesterNames();
$(document).ready(()=>{
    loadDataTable();
})

// variables
let UpdateID = 0;
let IsValid = false;
// end 

// jquery events
$("#newUser").on("click", function (e) {
    $("#userModal").modal("show")
})


$("#saveData").on("click", SaveData);
$("#editData").on("click", Update);



// update function
function Update(e) {
    e.preventDefault();

    if (CheckEmpty($("#ui_subjectName"), $("#ui_semester")))
        SetMessage("error", "Fill Required info😏😏")
    else {

        // SetMessage("success", "Updated Successfully. 😊😊😊");
        let subjectName = $("#ui_subjectName").val();
        let crSemester = document.getElementById("ui_semester").value;
        let semester = crSemester.toUpperCase();
        let data = {
            action: "searchSemesterName",
            semester: semester
        }
        $.ajax({
            method: "POST",
            dataType: "JSON",
            url: "../api/subjects.php",
            data: data,
            success: function (response) {
                let statusMessage = response.status;
                if (statusMessage) {
                    
                        let data = {
                            action: "update",
                            subject: subjectName,
                            semester: crSemester.toUpperCase(),
                            update_id: UpdateID
                        };
                        $.ajax({
                            method: "POST",
                            dataType: "JSON",
                            url: "../api/subjects.php",
                            data: data,
                            success: function (response) {
                                let responseData = response.data;
                                SetMessage("success", "Updated Successfully. 😊😊😊");
                                loadData();
                                // Clear(userName,passcode,browseFile);
                            },
                            error: function (response) {

                                let responseUsers = response.data;
                                let statusReponse = response.status;
                                let responseFromServer = response['responseText'];
                                if (statusReponse)
                                    DisplayMessage("error", responseUsers);
                                else
                                    DisplayMessage("error", responseFromServer);
                            }
                        })
                
                }
                else
                    SetMessage("error", `Semester ${semester} Is Not Exist!`)
            },
            error: function (response) {
                return response;
            }
        })
       
    }

}

// save Data function
function SaveData(e) {
    e.preventDefault();
    let subjectName = $("#subjectName").val();
    let belongsSemester = $("#belongs_semester").val();

    if (belongsSemester === "Select")
        DisplayMessage("error", "Plz Select The Semester Which Will Take This Subject");
    else {

        let data = {
            action: "insert",
            name: subjectName,
            semesterName: belongsSemester
        }
        console.log(data)
        $.ajax({
            method: "POST",
            dataType: "JSON",
            url: "../api/subjects.php",
            data: data,
            success: function (response) {
                let responseData = response.data;
                DisplayMessage("success", responseData);
                loadData();
                // Clear(userName,passcode,browseFile);
            },
            error: function (response) {
                console.log(response)
                let responseUsers = response.data;
                let statusReponse = response.status;
                let responseFromServer = response['responseText'];
                if (statusReponse)
                    DisplayMessage("error", responseUsers);
                else
                    DisplayMessage("error", responseFromServer);
            }
        })

    }
}

// delete data
function DeleteSubject(id) {
    let data = {
        action: "delete",
        id: id
    }
    $.ajax({
        method: 'POST',
        dataType: "JSON",
        data: data,
        url: "../api/subjects.php",
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

// loads data from database
function loadData() {
    $("#subjectsTable tbody").html("");
    let data = {
        action: "read"
    };
    $.ajax({
        method: 'POST',
        dataType: "JSON",
        data: data,
        url: "../api/subjects.php",
        success: function (response) {

            let responseDATA = response.data;
            let tr = "";
            responseDATA.forEach((items) => {
                tr += "<tr>";
                for (i in items) {
                    tr += `<td>${items[i]}</td>`
                }
                tr += `<td><i class="fas fa-edit edit_user" edit_user_id=${items['SubjectID']} style='cursor: pointer; margin-right: 10px; font-size: 26px; color: green;'></i> <i class="fa-solid fa-trash delete" delete_id=${items['SubjectID']} style=' font-size: 26px; color: red;'></i> </td>`
            })
            $("#subjectsTable tbody").append(tr);

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



//** gets All Semester Names From the database **/
function GetSemesterNames() {

    let belongsSemester = $("#belongs_semester");
    let data = {
        action: "readSemesterNames"
    };
    $.ajax({
        method: 'POST',
        dataType: "JSON",
        data: data,
        url: "../api/subjects.php",
        success: function (response) {
            let option = "";
            let ResponseData = response.data;
            option += '<option value="Select">Select</option>'
            ResponseData.forEach((s) => {

                for (semes in s) {
                    option += `<option value='${s[semes]}'>${s[semes]}`;
                }
                option += "</option>";
            })
            belongsSemester.html(option);
        },
        error: function (response) {
            console.log(response)
            let responseFromServer = response['responseText'];
            let responseFromLocal = response.data;
            let status = response.status;

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



$("#subjectsTable tbody").on("click", "i.edit_user", function () {
    let id = $(this).attr("edit_user_id");
    let currentSemester = document.querySelector("#testID");
    let data = {
        action: "searchSubject",
        id: id
    }

    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "../api/subjects.php",
        data: data,
        success: function (response) {

            let { SubjectID, Name, Belongs_Semester } = response.data[0];
            UpdateID = SubjectID;
            $("#ui_subjectName").val(Name);
            $("#ui_semester").val(Belongs_Semester);

            $("#editModal").modal("show");

        },
        error: function (response) {
            console.log(response)
        }
    })

})

$("#subjectsTable tbody").on("click", "i.delete", function () {
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
            DeleteSubject(userID)
        }
        else
            return;
    })

})



function CheckEmpty(subject, semester) {

    if (subject.val() == "" || semester.val() == "")
        return true;
    else
        return false;

}


function SetMessage(type, message) {
    let messageDiv = document.querySelector(".update-message");
    let spanElement = document.querySelector(".update-message h3 span")
    if (type == "error") {

        messageDiv.classList.remove("hideMessageInfo", "successColor")
        messageDiv.classList.add("showMessage");
        spanElement.innerHTML = message;

            setTimeout(()=>{
                messageDiv.classList.remove("showMessage", "successColor")
                messageDiv.classList.add("hideMessageInfo");
            },3000)
    }
    else {
        messageDiv.classList.remove("hideMessageInfo")
        messageDiv.classList.add("showMessage", "successColor");
        spanElement.innerHTML = message;

        setTimeout(()=>{
            messageDiv.classList.remove("showMessage","successColor")
            messageDiv.classList.add("hideMessageInfo");
        },3000)
    }
}

function loadDataTable(){
  $('#subjectsTable').DataTable();
    
}
