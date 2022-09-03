<?php

require '../config/conn.php';


$action = $_POST['action'];
// request class

if(isset($action)){
   Request::$action();
}

class Request{



// companetion

//insert data
public static function insert_companetion(){

    extract($_POST);
    // if($role='student'){
    $query=" CALL `add_combanetion`('$username','$bassword','$role','$status','$student')";
    $resultSet= connection::GetMySqlConnection()->query($query);
    $responseData= array();

    if ($resultSet)
    $row =$resultSet->fetch_assoc();
    if($row['Message']=='Deny'){
        $responseData=array("status"=>true,"data"=>"Successfully Saved for student....");

    }elseif($row['Message']=='Regestered'){
        $responseData=array("status"=>true,"data"=>"Successfully Saved for admin...");
    }
    else
        $responseData=array("status"=>false,"data"=> connection::GetMySqlConnection()->error);
    
    echo json_encode($responseData);


}











//select users 
public static function readusers(){

       
    $query="CALL `readUsers_for_companetion`()";
    $resultSet= connection::GetMySqlConnection()->query($query);
    $data=array();
    $responseData= array();

    if ($resultSet)
       {
        while ($rows=$resultSet->fetch_assoc())
        {
            $data []=$rows;
        }
        $responseData=array("status"=>true,"data"=>$data);
       }
    else
        $responseData=array("status"=>false,"data"=> connection::GetMySqlConnection()->error);
    
    echo json_encode($responseData);


}




//select students
public static function readstudent(){

       
    $query="CALL `readStudentsID`()";
    $resultSet= connection::GetMySqlConnection()->query($query);
    $data=array();
    $responseData= array();

    if ($resultSet)
       {
        while ($rows=$resultSet->fetch_assoc())
        {
            $data []=$rows;
        }
        $responseData=array("status"=>true,"data"=>$data);
       }
    else
        $responseData=array("status"=>false,"data"=> connection::GetMySqlConnection()->error);
    
    echo json_encode($responseData);


}

// alll read

public static function readCompanetion(){

       
    $query="CALL `read_companetion`()";
    $resultSet= connection::GetMySqlConnection()->query($query);
    $data=array();
    $responseData= array();

    if ($resultSet)
       {
        while ($rows=$resultSet->fetch_assoc())
        {
            $data []=$rows;
        }
        $responseData=array("status"=>true,"data"=>$data);
       }
    else
        $responseData=array("status"=>false,"data"=> connection::GetMySqlConnection()->error);
    
    echo json_encode($responseData);


}


public static function combanetion_delete(){
    extract($_POST);

    $query="DELETE FROM combanition where id='$id'";
    $resultSet= connection::GetMySqlConnection()->query($query);
    $responseData= array();

    if ($resultSet)
        $responseData=array("status"=>true,"data"=>"Successfully Deleted....");
    else
        $responseData=array("status"=>false,"data"=> connection::GetMySqlConnection()->error);
    
    echo json_encode($responseData);
}

//count
// public static function countcompanetion(){

       
//     $query="SELECT COUNT(*) as 'Rows' FROM combanition";
//     $resultSet= connection::GetMySqlConnection()->query($query);
//     $data=array();
//     $responseData= array();

//     if ($resultSet)
//        {
//         while ($rows=$resultSet->fetch_assoc())
//         {
//             $data []=$rows;
//         }
//         $responseData=array("status"=>true,"data"=>$data);
//        }
//     else
//         $responseData=array("status"=>false,"data"=> connection::GetMySqlConnection()->error);
    
//     echo json_encode($responseData);


// }

}

?>