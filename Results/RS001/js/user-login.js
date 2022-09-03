
errorColor = "#C73E1D";
successColor = "#42ba96";
let statusCreation=false;
username="";
$("#login").on("click", LoginInto)


function LoginInto(e) {
    e.preventDefault();
    if (IsEmpty($("#username"), $("#password")))
        SetMessage("Username And Password is Required", errorColor);
    else {
        
        let userData={
            action: "findUser",
            username : $("#username").val(),
            password : $("#password").val()

        }
        
    
        IsValidUser(userData,(response)=>{
           if (response)
           {
             window.location="../view/dashboard.php";
           }
          else
          SetMessage(`Incorrect username or Password`,errorColor);
        })
        
    }
}


function IsValidUser(data,callBack){
    
    $.ajax({
        method : "POST",
        dataType : "JSON",
        data : data,
        url : "../api/user-login.php",
        beforeSend: ()=>{
            $("#login","disabled",true);
        },
        success: (response)=>{
            var status = response.isExist;
           callBack(status);
        },
        error : (response)=>{
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