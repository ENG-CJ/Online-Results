
countclass();
countSmister();


// count clss from database

function countclass(){
   
    let data = {
        action: "countclass"
    };
    $.ajax({
        method: 'POST',
        dataType: "JSON",
        data: data,
        url: "../api/class.php",
        success: function (response) {
            let responseDATA = response.data[0]['Rows'];
            console.log(responseDATA); 
            $("#count_class").html(responseDATA) 

        },
        error: function (response) {
           
        }
    });

}




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










