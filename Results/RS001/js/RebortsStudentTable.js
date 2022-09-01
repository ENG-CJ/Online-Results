// loadData();

StudentTable_loadData();

function StudentTable_loadData(username){
    
  
    let sendingData ={
        // Roll:username,
        action:"RebortStudents"

    }
    
    $.ajax({
        method:"POST",
        dataType:"JSON",
        url: "../api/RebortStudentTable.php",
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







// looging markaa soo galesid inta uku wac id result homebage table








// $('#login').on("click",function(event){
//     event.preventDefault();
//     // console.log("table cilick");
//     let username = $("#username").val();
        
//     console.log(username);
//     alert( username);
   
   
//         //   feach_class_Delate(username);
      
       
    
    
    
    
    
//     })   