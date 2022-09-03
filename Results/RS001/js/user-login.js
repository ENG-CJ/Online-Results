
errorColor = "#C73E1D";
successColor = "#42ba96";
let statusCreation = false;
username = "";
$("#login").on("click", LoginInto)


function LoginInto(e) {
    e.preventDefault();
    if (IsEmpty($("#username"), $("#password")))
        SetMessage("Username And Password is Required", errorColor);
    else {

        let userData = {
            action: "findUser",
            username: $("#username").val(),
            password: $("#password").val()
        }

        IsValidUser(userData, (response) => {
            console.log(response)
            let isExist = response.isExist;
            let actualData = response.data;
            let IsPublished = response.data['IsPublished'];
            // let { role, username, status } = actualData[0]['data'];
            // console.log(IsPublished);
            // console.log(status+" "+role);
            if (isExist) {


                let { role, username, status } = actualData[0]['data'];
                if (role == "Admin") {
                    if (status == "Active")
                        window.location = "../view/dashboard.php";
                    else
                        ActiveMessage();
                }
                else if (role == "student") {
                    if (status == "Active") {
                        if (IsPublished == "No")
                            window.location = "../Student/1/Gate/NotPublish.php";
                        else if (IsPublished == "Yes")
                            window.location = "../Student/1/result.php?username=" + username;
                        else
                            window.location = "../Student/1/Gate/NotPublish.php";
                    }
                    else
                      ActiveMessage();
                    
                }

                else if (role == "User") {
                    if (status == "Active")
                        window.location = "../view/view-results.php";
                    else
                        ActiveMessage();
                }
            }
            else {
                SetMessage(`Incorrect username or Password`, errorColor);
                $("#password").val("");
            }
            //     console.log(role);
            //     if (actualData=="")
            //       console.log("No Data")
            //     else
            //      console.log("Avialble");
            //    if (response)
            //    {
            //      window.location="../view/dashboard.php";
            //    }
            //   else
            //   SetMessage(`Incorrect username or Password`,errorColor);
        })

    }
}


function IsValidUser(data, callBack) {

    $.ajax({
        method: "POST",
        dataType: "JSON",
        data: data,
        url: "../api/user-login.php",
        beforeSend: () => {
            $("#login", "disabled", true);
        },
        success: (response) => {

            callBack(response);
        },
        error: (response) => {
            console.log(response);
        }
    })

}




// valid option
function IsEmpty(username, password) {
    if (username.val() == "" || password.val() == "")
        return true;
    else
        return false;
}


function ActiveMessage() {
    var message=`<div class="col-12">
    <div class="alert alert-primary " id="alert-message-area" role="alert">
    <i class="fa-solid fa-circle-info mr-3"> </i>
                    
    <h5 style="font-weight: 650; font-family: poppins">   This User [${$("#username").val()}] is Not Active Now. Contact <a href="https://wa.link/48htul" title="Master User" target="_blank" style="color : red">The Admin</a> To Activate Your Username.</h5>
    </div>
</div>`;
    $("#active-message-area").html(message);
    setTimeout(() => {
        $("#active-message-area").html("");
    }, 6000);
}
// toest notify
function SetMessage(message, bgColor) {

    Toastify({
        text: message, duration: 3000,
        // destination: "https://github.com/apvarun/toastify-js",
        newWindow: true,
        close: true,
        gravity: "right", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
            background: bgColor,
            fontFamily: "poppins",
            borderRadius: "4px"
        },
        onClick: function () { } // Callback after click
    }).showToast();

}