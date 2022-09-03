GetSemesterNames();
GetClassNames();
DisplayResults();
countPublishOrUnPublish();
$(document).ready(() => {
    CreateDataTable();
})
$("#semesterName").on("change", FetchSubject)
$("#className").on("change", fetchStudents)
$("#saveData").on("click", SaveData)


$("#modal").on("click", ()=>{
    $("#exampleModal").modal("show");
})
$("#load").on("click", fetchVisual)
errorColor = "#C73E1D";
successColor = "#42ba96";


/**
 * 
 * Saves Data To THE database
 * @returns null
 */
function SaveData(e) {

    e.preventDefault();
    if (IsEmptyValues($("#semesterName")) || IsEmptyValues($("#className")) || IsEmptyValues($("#studentNames")))
        SetTost("All Data Must Be Filled ", errorColor);
    else {
        RegisterResults();
        //         validData = new Array();
        //         data = new Array();
        //         var items = ($("form").serializeArray());
        //         items.forEach((item) => {
        //             data.push(item.value)
        //         })
        //         for (var i = 0; i < data.length; i++)
        //            {
        //                 console.log(typeof(data[i]))
        //             if (data[i] >= 0 && data[i] <= 100)
        //             validData.push("Success")
        //         else
        //             validData.push("error");
        //            }

        // // console.log(validData)
        // console.log(items)
        // if (validData.includes("error"))
        //     SetTost("Marks Cannot proceed Under 0 and Above 100.", errorColor)
        // else
        //     RegisterResults();
    }

}



function IsValidMarks(marks) {
    if (marks >= 0 && marks <= 100)
        return true;
    else
        return false;
}

function FetchSubject(e) {
    var SelectedValue = $("#semesterName").val();
    if (SelectedValue != "") {
        let data = {
            action: "fetchSubjDetails",
            semesterName: SelectedValue
        }
        fetchSubjectDetails(data, (response) => {

            let subjectData = response.data;
            if (subjectData.length > 0)

                DisplaySubjects(subjectData);
            else {
                $("#subjectsArea").html("");
                element = `<p class="text-secondary" style="font-weight:700; font-family:poppins;">No Subjects For This Semester</p>`;
                $("#subjectsArea").append(element);
            }



        })

        if ($("#className").val() != "") {
            let data = {
                action: "fetchStudents",
                className: $("#className").val(),
                semester: $("#semesterName").val()
            }
            $.ajax({
                method: "post",
                dataType: "json",
                data: data,
                url: "../api/results.api.php",
                success: (response) => {
                    let responseStudents = response.data;
                    if (responseStudents.length > 0) {
                        $(".error-trackerArea").html("");
                        AppendIntoSelect(responseStudents);
                    }
                    else {
                        $("#studentNames").html("");
                        var option = `<option value="">Select</option>`;
                        var errorLog = `<span class="text-danger" style="font-weight:700; font-family: poppins;">No Students Data Available For The Specified Class Or Semester</span>`
                        $("#studentNames").append(option);
                        $(".error-trackerArea").html("");
                        $(".error-trackerArea").append(errorLog);
                    }
                },
                error: (response) => {
                    console.log(response);
                }
            })
        }
        else {
            $("#studentNames").html("");
            var option = `<option value="">Select</option>`;
            $("#studentNames").append(option);
        }


    }
    else
        $("#subjectsArea").html("");
}

function GetSemesterNames() {

    let belongsSemester = $("#semesterName");
    let data = {
        action: "readSemesterNames"
    };
    $.ajax({
        method: 'POST',
        dataType: "JSON",
        data: data,
        url: "../api/results.api.php",
        success: function (response) {
            let option = "";
            let optionCharts = "";
            let ResponseData = response.data;
            option += '<option value="">Select</option>'
            optionCharts += '<option value="">Select</option>'
            ResponseData.forEach((s) => {

                for (semes in s) {
                    option += `<option value='${s[semes]}'>${s[semes]}`;
                    optionCharts += `<option value='${s[semes]}'>${s[semes]}`;
                }
                option += "</option>";
                optionCharts += "</option>";
            })
            belongsSemester.html(option);
            $("#visualSemester").html(optionCharts);
        },
        error: function (response) {
            console.log(response)
            let responseFromServer = response['responseText'];
            let responseFromLocal = response.data;
            let status = response.status;

        }
    });

}

function fetchSubjectDetails(data, callback) {
    $.ajax({
        method: 'POST',
        dataType: "JSON",
        data: data,
        url: "../api/results.api.php",
        success: function (response) {
            callback(response);
        },
        error: function (response) {
            console.log(response)
            let responseFromServer = response['responseText'];
            let responseFromLocal = response.data;
            let status = response.status;

        }
    });
}


function DisplaySubjects(subjects) {
    $("#subjectsArea").html("");
    let displayArea = "";
    for (let i = 0; i < subjects.length; i++) {
        displayArea += `
       
       <div class="form-grouping">
        <label>${subjects[i].Name}</label>
        <input type="text" name="marks[]" id="marks[]" class="form-control" required data-parsley-type="integer" data-parsley-trigger="keyup" />
        <input type="hidden" name="subject_id[]" id ="subject_id[]" value="${subjects[i].SubjectID}" />
   </div>
       `
    }
    $("#subjectsArea").append(displayArea);
}


function SetTost(message, background_Color) {
    Toastify({
        text: message, duration: 3000,
        // destination: "https://github.com/apvarun/toastify-js",
        newWindow: true,
        close: true,
        gravity: "right", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
            background: background_Color,
            fontFamily: "poppins",
            borderRadius: "4px"
        },
        onClick: function () { } // Callback after click
    }).showToast();
}

function GetClassNames() {

    let belongsSemester = $("#className");
    let data = {
        action: "readClassNames"
    };
    $.ajax({
        method: 'POST',
        dataType: "JSON",
        data: data,
        url: "../api/results.api.php",
        success: function (response) {
            let option = "";
            let classOptions = "";
            let ResponseData = response.data;
            option += '<option value="">Select</option>'
            classOptions += '<option value="">Select</option>'
            ResponseData.forEach((s) => {

                for (semes in s) {
                    option += `<option value='${s[semes]}'>${s[semes]}`;
                    classOptions += `<option value='${s[semes]}'>${s[semes]}`;
                }
                option += "</option>";
                classOptions += "</option>";
            })
            belongsSemester.html(option);
            $("#visualClass").append(classOptions);
        },
        error: function (response) {
            console.log(response)
            let responseFromServer = response['responseText'];
            let responseFromLocal = response.data;
            let status = response.status;

        }
    });

}

function RegisterResults() {


    $.ajax({
        method: "POST",
        dataType: "JSON",
        data: $("form").serializeArray(),
        url: "../api/results.api.php",
        beforeSend: () => {

            $("#saveData").html("Wait...");
            $("#saveData").attr("disabled", "disabled");
        },
        success: (response) => {
            $("#saveData").html("Save");
            $("#saveData").attr("disabled", false);
            let responseData = response.data;
            SetTost(responseData, successColor);

        },
        error: (response) => {

            $("#saveData").attr("disabled", false);
            $("#saveData").html("Save");
            console.log(response)
            let statusFromServer = response['responseText'];
            let statusCode = response['status'];
            if (statusCode == 404)
                SetTost("Something Went Wrong The Request Url Was Not Found😶", errorColor)
            else
                SetTost(statusFromServer, errorColor)
        }
    })
}

function IsEmptyValues(value) {
    if (value.val() == "")
        return true;
    else
        return false

}

function fetchStudents(e) {
    if ($("#className").val() != "" && $("#semesterName").val() != "") {
        let data = {
            action: "fetchStudents",
            className: $("#className").val(),
            semester: $("#semesterName").val()
        }
        $.ajax({
            method: "post",
            dataType: "json",
            data: data,
            url: "../api/results.api.php",
            success: (response) => {
                let responseStudents = response.data;
                if (responseStudents.length > 0) {
                    $(".error-trackerArea").html("");
                    AppendIntoSelect(responseStudents);
                }
                else {
                    $("#studentNames").html("");
                    var option = `<option value="">Select</option>`;
                    var errorLog = `<span class="text-danger" style="font-weight:700; font-family: poppins;">No Students Data Available For The Specified Class Or Semester</span>`
                    $("#studentNames").append(option);
                    $(".error-trackerArea").html("");
                    $(".error-trackerArea").append(errorLog);
                }
            },
            error: (response) => {
                console.log(response);
            }
        })

    }
    else {
        $("#studentNames").html("");
        var option = `<option value="">Select</option>`;
        $("#studentNames").append(option);
    }
}

function AppendIntoSelect(data) {
    $("#studentNames").html("");
    options = ``;
    options += `<option value="">Select</option>`
    data.forEach((dat) => {
        options += `<option value="${dat.RollNumber}">${dat.FullName}</option>`
    })
    $("#studentNames").append(options);
}



function loadResultData(data, callBackResponse) {
    $("#resultsTable tbody").html("");
    $("#resultsTable thead").html("");

    $.ajax({
        method: 'POST',
        dataType: "JSON",
        data: data,
        url: "../api/results.api.php",
        success: function (response) {
            callBackResponse(response);
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



function DisplayResults() {
    $("#resultsTable tbody").html("");
    $("#resultsTable thead").html("");
    let data = {
        action: "read"
    };
    loadResultData(data, (response) => {
        let responseDATA = response.data;
        let tr = "";
        let tHead = "";
        responseDATA.forEach((items) => {
            tr += "<tr>";
            tHead = "<tr>"
            for (i in items) {
                tHead += `<th>${i}</th>`


            }
            tHead += "<th>Actions</th>"
            tHead += "</tr>"
            for (i in items) {
                if (items[i] == "Fail")
                    tr += `<td style="color : red; font-family: poppins;">${items[i]}</td>`
                if (items[i] != "Fail") {
                    if (items[i] == "No")
                        tr += `<td ><button type="button" class="btn btn-danger disableButton" value="${items[i]}" disable=${items['ResultID']}>${items[i]}</button></td>`
                    else {
                        if (items[i] == "Yes")
                            tr += `<td ><button type="button" class="btn btn-success enableButton" value="${items[i]}" enable=${items['ResultID']}>${items[i]}</button></td>`
                        else
                            if (i == "Precentage")
                                tr += `<td>${items[i]} %</td>`;
                            else
                                tr += `<td>${items[i]}</td>`
                    }
                }


            }
            tr += `<td><i class="fas fa-edit edit_user" edit_user_id=${items['ResultID']} style='cursor: pointer; margin-right: 10px; font-size: 26px; color: green;'></i> <i class="fa-solid fa-trash delete" delete_id=${items['ResultID']} style=' font-size: 26px; color: red;'></i> </td>`
        })
        $("#resultsTable tbody").append(tr);
        $("#resultsTable thead").append(tHead);

    })


}


function CreateDataTable() {
    $('#resultsTable').DataTable();
}

$("#resultsTable tbody").on("click", "button.disableButton", function () {
    Swal.fire({
        title: 'Live Results 😊😊',
        text: "Do You Want To Put This Result on Online?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, I Want😊😊!'
    }).then((result) => {
        if (result.isConfirmed) {
            let resultID = $(this).attr("disable");
            var buttonType = $(this).val()
            UpdateResult(resultID, buttonType);


        }
        else
            return;
    })

})
$("#resultsTable tbody").on("click", "button.enableButton", function () {
    Swal.fire({
        title: 'Live Results 😊😊',
        text: "Do You Want To Unpublish This Result on Online?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, I Want !'
    }).then((result) => {
        if (result.isConfirmed) {
            var resultID = $(this).attr("enable");
            var buttonType = $(this).val()
            UpdateResult(resultID, buttonType);


        }
        else
            return;
    })

})


$("#resultsTable tbody").on("click", "i.delete", function () {
   
    Swal.fire({
        title: 'Are you sure?',
        text: "Do You Want To Continue To Delete This Record?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            let resultID = $(this).attr("delete_id")
            console.log(resultID)
            DeleteResultRecord(resultID)
        }
        else
            return;
    })

})



//? Edit Results  Section Stats Here


// update function

// fetching single reult from data base 
function fetchSingleResult(id){
    let data = {
        action : "fetchSingle",
        id : id
    };
    $.ajax({
        method : "post",
        dataType : "json",
        data : data,
        url : "../api/results.api.php",
        success : (response)=>{
            //! Modal-ka Halkaan Kuso Bandhig hadduu Kushaqeenayo;
            //! Ama (ViewOnModal()) Function-kaas Ayaa Hoos Ku Diyaarsan Inta Ugu Wac Data-da Ubaas
            // alert("This is Not Currently Working..\nThe ID You Want To Update Is "+id+"\nWe Will Stablish This Event, Still Processing...");
            // let { semester_id, FullName, Address } = response.data[0];
            // UpdateID = RollNumber;

            $("#semesterName").val(response['semester_id']);
             $("#className").val(response['class_id']);
             $("#studentNames").val(response['current_student_name']);
             $("#studentEditModal").modal("show");









   
        },
        error : (response)=>{
            console.log(response);
        }
    })

}

$("#resultsTable tbody").on("click", "i.edit_user", function() {
   
    let resultID = $(this).attr("edit_user_id")
    fetchSingleResult(resultID);

     alert("hello");
    console.log(resultID);

    // alert("hello")

   
})




function UpdateResult(id, buttonType) {

    if (buttonType == "No") {
        let data = {
            action: "update",
            publish: "Yes",
            id: id
        }
        UpdateOneResult(data, (response) => {
            let data = response.data;
            SetTost("Successfully Published Result. Student Related This Results Can View Their Results On Their Portal😊", successColor);
            DisplayResults();
        })
    }

    else if (buttonType == "Yes") {
        let data = {
            action: "update",
            publish: "No",
            id: id
        }
        UpdateOneResult(data, (response) => {
            SetTost("This Result Registered As Unpublished Result So Student Related This Results Can't View Their Results On Their Portal😊", successColor);
            DisplayResults();
        })
    }

}

function UpdateOneResult(data, callback) {

    $.ajax({
        method: "post",
        dataType: "json",
        data: data,
        url: "../api/results.api.php",
        success: (response) => {
            callback(response);
        },
        error: (response) => {
            console.log(response);
        }
    })
}


function DeleteResultRecord(id) {
    let data = {
        action: "delete",
        id: id
    }
    $.ajax({
        method: 'POST',
        dataType: "JSON",
        data: data,
        url: "../api/results.api.php",
        success: function (response) {


            let status = response.status;
            let message = response.data;
            if (status) {

                SetTost(`ResultID - ${id} Was Deleted Successfully😊😊`, successColor)
                window.location.reload();
                DisplayResults();




                // window.location.reload();
            }

        },
        error: function (response) {
            console.log(response)
            let responseMessage = response.data;
            DisplayMessage("error", response)
        }
    });
}



// Charts About Students Passed and failed;
function fetchVisual(e) {
    e.preventDefault();
    if ($("#visualSemester").val() == "" || $("#visualClass").val() == "")
        SetTost("To View Exam Chart Provide Specific Class and Semester😊", errorColor);
    else {
        let data = {
            action: "GetPassAndFail",
            className: $("#visualClass").val(),
            semester: $("#visualSemester").val()
        };
        FetchVisualData(data, (response) => {
            let actualData = response.data;
            DrawChart(actualData);
        })
    }
};


function FetchVisualData(data, callback) {
    $.ajax({
        method: "post",
        dataType: "json",
        data: data,
        url: "../api/results.api.php",
        success: (response) => {
            callback(response);
        },
        error: (response) => {
            console.log(response);
        }
    })
}

function DrawChart(data) {
    if (data.length > 0) {
        google.charts.load('current', {
            packages: ['corechart']
        });
        google.setOnLoadCallback(DisplayChart(data));
    } else {
        $("#drawChart").html("");
        $("#messageTracker-2").html("")
        var img = `<img src="../images/data-json.gif" alt="" srcset="" width="400px" height="400px">`;
        $("#messageTracker-2").append(img);
    }



}
function DisplayChart(actual) {

    // console.log(perce)
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Browser');
    data.addColumn('number', 'Percentage');
    actual.forEach((item) => {
        data.addRows([
            [item.Status, parseFloat(item.Percent)]
        ]);
    })


    // // // Set chart options
    var options = { 'title': 'Students Exam Visual Reprsentation Specific Class and Semester', 'width': 520, 'height': 400, is3D: true };

    // // // Instantiate and draw the chart.
    $("#messageTracker-2").html("");
    var chart = new google.visualization.PieChart(document.getElementById('drawChart'));
    chart.draw(data, options);


}



// display data on modal 
function ViewOnModel(response){
    $("#editResultModal").modal("show");

//? Edit Results  Section Stats Here
// fetching single reult from data base 
function fetchSingleResult(id){
    let data = {
        action : "fetchSingle",
        id : id
    };
    $.ajax({
        method : "post",
        dataType : "json",
        data : data,
        url : "../api/results.api.php",
        success : (response)=>{
            //! Modal-ka Halkaan Kuso Bandhig hadduu Kushaqeenayo;
            //! Ama (ViewOnModal()) Function-kaas Ayaa Hoos Ku Diyaarsan Inta Ugu Wac Data-da Ubaas
           // alert("This is Not Currently Working..\nThe ID You Want To Update Is "+id+"\nWe Will Stablish This Event, Still Processing...");
        //    $("#editResultModal").modal("show");
        },
        error : (response)=>{
            console.log(response);
        }
    })
}

// display data on modal 
function ViewOnModel(response){

}
}

// count publish result and unpublish

function countPublishOrUnPublish() {
   
    let data = {
        action: "countPublishOrUnPublish"
    };
    $.ajax({
        method: 'POST',
        dataType: "JSON",
        data: data,
        url: "../api/results.api.php",
        success: function (response) {
           let {Published, Unpublished} = response;
           $("#countPublish").text(Published.Published)
           $("#countUnPublish").text(Unpublished.UnPublished)

        },
        error: function (response) {
           console.log(response)
        }
    });

}
