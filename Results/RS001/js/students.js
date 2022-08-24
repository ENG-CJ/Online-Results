loadData();
GetSemesterNames();
GetClassNames();
countStudents();
$(document).ready(() => {
    $("#studentsTable").DataTable();
})
errorColor = "#C73E1D";
successColor = "#42ba96";
$("#saveStudent").on("click", Save)
$("#saveData").on("click", UpdateStudent)

id = "0";

function Save(e) {
    if (isEmpty($("#rollNo"), $("#fullName"), $("#number"), $("#address")))
        SetTost("Please Fill The Required Information", "#C73E1D")
    else if (IsNotSelected($("#semester"), $("#class")))
        SetTost("Student Must Be Assigned  Class And Semester", "#C73E1D")
    else if (!IsValidID($("#rollNo")))
        SetTost("Roll Number Must Be Start With [ ST ] Characters", "#C73E1D")
    else {

        let data = {
            action: "IsExist",
            roll: $("#rollNo").val().toUpperCase(),

            mobile: $("#number").val(),

        }
        // requets that checks wheter the student is exist
        $.ajax({
            method: "POST",
            dataType: "JSON",
            url: "../api/students.php",
            data: data,
            success: function (response) {
                let responseData = response.ExistDta;
                if (responseData)
                    SetTost(`Student roll Number or Mobile One Of Them Is Already Exist Plz Choose New One`, errorColor);
                else {
                    let data = {
                        action: "insert",
                        roll: $("#rollNo").val().toUpperCase(),
                        name: $("#fullName").val(),
                        gender: $("#gender").val(),
                        mobile: $("#number").val(),
                        address: $("#address").val(),
                        className: $("#class").val(),
                        semesterName: $("#semester").val()
                    }
                    $.ajax({
                        method: "POST",
                        dataType: "JSON",
                        url: "../api/students.php",
                        data: data,
                        success: function (response) {
                            let responseData = response.data;
                            SetTost(responseData, successColor);


                        },
                        error: function (response) {
                            console.log(response)
                            responseServer = response['status'];
                            responseText = response['responseText'];
                            if (responseServer == 404)
                                SetTost("The request URL Was " + response['statusText'], errorColor)
                            else
                                SetTost(responseText, errorColor);
                        }
                    })
                }

            },
            error: function (response) {
                console.log(response)
                responseServer = response['status'];
                responseText = response['responseText'];
                if (responseServer == 404)
                    SetTost("The request URL Was " + response['statusText'], errorColor)
                else
                    SetTost(responseText, errorColor);
            }
        })

        console.log(data)
        // let data={
        //     action : "IsExist",
        //     roll : $("#rollNo").val().toUpperCase(),
        //     name : $("#fullName").val(),
        //     gender : $("#gender").val(),
        //     mobile : $("#number").val(),
        //     address : $("#address").val(),
        //     className : $("#class").val(),
        //     semesterName : $("#semester").val()
        // }
        // $.ajax({
        //     method: "POST",
        //     dataType: "JSON",
        //     url: "../api/students.php",
        //     data: data,
        //     success: function (response) {
        //         let responseData = response.data;
        //         SetTost(responseData,"	#42ba96");


        //     },
        //     error: function (response) {
        //         console.log(response)
        //         responseServer=response['status'];
        //         responseText=response['responseText'];
        //         if (responseServer==404)
        //             SetTost("The request URL Was "+response['statusText'],"red")
        //         else
        //             SetTost(responseText,"red");
        //     }
        // })
    }
}

function UpdateStudent(e) {
    e.preventDefault();
    if (isEmpty($("#std_roll"), $("#std_name"), $("#std_number"), $("#std_address")))
        SetTost("Please Fill The Required Information", "#C73E1D")
   
    else if (!IsValidID($("#std_roll")))
        SetTost("Roll Number Must Be Start With [ ST ] Characters", "#C73E1D")
    else {

        let data = {
            action: "update",
            roll: $("#std_roll").val().toUpperCase(),
            name : $("#std_name").val(),
            gender: $("#std_gender").val(),
            address : $("#std_address").val(),
            mobile: $("#std_number").val(),
            className : $("#std_className").val(),
            semesterName : $("#std_semesterName").val(),
            update_id : UpdateID

        }
        // requets that checks wheter the student is exist
        $.ajax({
            method: "POST",
            dataType: "JSON",
            url: "../api/students.php",
            data: data,
            success: function (response) {
                let responseData = response.data;
                SetTost(responseData,successColor);
                $("#studentEditModal").modal("hide");
                window.location.reload();
                loadData();

            },
            error: function (response) {
                console.log(response)
                responseServer = response['status'];
                responseText = response['responseText'];
                if (responseServer == 404)
                    SetTost("The request URL Was " + response['statusText'], errorColor)
                else
                    SetTost(responseText, errorColor);
            }
        })

        console.log(data)
      
    }
}
function DeleteStudent(id) {
    let data = {
        action: "delete",
        id: id
    }
    $.ajax({
        method: 'POST',
        dataType: "JSON",
        data: data,
        url: "../api/students.php",
        success: function (response) {


            let status = response.status;
            let message = response.data;
            if (status) {
                SetTost(`RollNumber - ${id} Was Deleted Successfully😊😊`,successColor)
               
                loadData();
                window.location.reload();
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
    $("#studentsTable tbody").html("");
    let data = {
        action: "read"
    };
    $.ajax({
        method: 'POST',
        dataType: "JSON",
        data: data,
        url: "../api/students.php",
        success: function (response) {

            let responseDATA = response.data;
            let tr = "";
            responseDATA.forEach((items) => {
                tr += "<tr>";
                for (i in items) {
                    tr += `<td>${items[i]}</td>`
                }
                tr += `<td><i class="fas fa-edit edit_user" edit_user_id=${items['RollNumber']} style='cursor: pointer; margin-right: 10px; font-size: 26px; color: green;'></i> <i class="fa-solid fa-trash delete" delete_id=${items['RollNumber']} style=' font-size: 26px; color: red;'></i> </td>`
            })
            $("#studentsTable tbody").append(tr);

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
function isEmpty(roll, name, number, address) {
    if (roll.val() == "" || name.val() == "" || number.val() == "" || address.val() == "")
        return true;
    else
        return false;
}


function IsNotSelected(className, semester) {
    if (className.val() == "Select" || semester.val() == "Select")
        return true;
    else
        return false;
}
// function SetTost(message, background_Color) {
//     Toastify({
//         text: message, duration: 3000,
//         // destination: "https://github.com/apvarun/toastify-js",
//         newWindow: true,
//         close: true,
//         gravity: "right", // `top` or `bottom`
//         position: "right", // `left`, `center` or `right`
//         stopOnFocus: true, // Prevents dismissing of toast on hover
//         style: {
//             background: background_Color,
//             fontFamily: "poppins",
//             borderRadius: "4px"
//         },
//         onClick: function () { } // Callback after click
//     }).showToast();
// }

function IsValidID(id) {
    if (id.val().toUpperCase().startsWith("S", 0) && id.val().toUpperCase().startsWith("T", 1))
        return true;
    else
        return false;
}
function GetSemesterNames() {

    let belongsSemester = $("#semester");
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

function GetClassNames() {

    let belongsSemester = $("#class");
    let data = {
        action: "readClassNames"
    };
    $.ajax({
        method: 'POST',
        dataType: "JSON",
        data: data,
        url: "../api/class.php",
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

$("#studentsTable tbody").on("click", "i.delete", function () {
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
            DeleteStudent(userID)
        }
        else
            return;
    })

})

$("#studentsTable tbody").on("click", "i.edit_user", function () {
    let id = $(this).attr("edit_user_id");
    let currentSemester = document.querySelector("#testID");
    let data = {
        action: "searchStudent",
        id: id
    }
    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "../api/students.php",
        data: data,
        success: function (response) {

            let { RollNumber, FullName, Address, Mobile, Gender, Class, Semester } = response.data[0];
            UpdateID = RollNumber;
            $("#std_roll").val(RollNumber);
            $("#std_name").val(FullName);
            $("#std_address").val(Address);
            $("#std_number").val(Mobile);
            $("#std_gender").val(Gender);
            $("#std_className").val(Class);
            $("#std_semesterName").val(Semester);
            $("#studentEditModal").modal("show");

        },
        error: function (response) {
            console.log(response)
        }
    })

})

function countStudents() {
   
    let data = {
        action: "countStudent"
    };
    $.ajax({
        method: 'POST',
        dataType: "JSON",
        data: data,
        url: "../api/students.php",
        success: function (response) {
            let responseDATA = response.data[0]['Rows'];
            console.log(responseDATA); 
            $("#countStudent").html(responseDATA) 

        },
        error: function (response) {
           console.log(response)
        }
    });

}

