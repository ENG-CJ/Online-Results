<?php

require '../config/conn.php';
$action = $_POST['action'];
// request class

if(isset($action)){
   Request::$action();
}

class Request{


public static function classregester(){

    extract($_POST);
    $query="INSERT INTO `classes`(`classID`, `Name`) VALUES('$classid','$className')";
    $resultSet= connection::GetMySqlConnection()->query($query);
    $responseData= array();

    if ($resultSet)
        $responseData=array("status"=>true,"data"=>"Successfully Saved....");
    else
        $responseData=array("status"=>false,"data"=> connection::GetMySqlConnection()->error);
    
    echo json_encode($responseData);


}
public static function CLASSRead(){

       
    $query="SELECT `classID`, `Name` FROM `classes` WHERE 1";
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

//updates

public static function fecthclassess(){

    extract($_POST);
    $query="SELECT * FROM classes where classID='$id'";
    $resultSet= connection::GetMySqlConnection()->query($query);
    $responseData= array();
    $data=array();

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

public static function update_class(){
    extract($_POST);

    $query="CALL `update_class`('$class_id','$Name','$update_id')"; 
  
    $resultSet= connection::GetMySqlConnection()->query($query);
    $responseData= array();

    if ($resultSet)
        $responseData=array("status"=>true,"data"=>"Successfully Updated");
    else
        $responseData=array("status"=>false,"data"=> connection::GetMySqlConnection()->error);
    
    echo json_encode($responseData);
}

public static function delete(){
    extract($_POST);

    $query="CALL delete_sp('$id')";
    $resultSet= connection::GetMySqlConnection()->query($query);
    $responseData= array();

    if ($resultSet)
        $responseData=array("status"=>true,"data"=>"Successfully Deleted....");
    else
        $responseData=array("status"=>false,"data"=> connection::GetMySqlConnection()->error);
    
    echo json_encode($responseData);
}


//count
public static function countclass(){

       
    $query="SELECT COUNT(*) as 'Rows' FROM classes";
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



public static function class_delete(){
    extract($_POST);

    $query="DELETE FROM `classes` WHERE classID='$id'";
    $resultSet= connection::GetMySqlConnection()->query($query);
    $responseData= array();

    if ($resultSet)
        $responseData=array("status"=>true,"data"=>"Successfully Deleted....");
    else
        $responseData=array("status"=>false,"data"=> connection::GetMySqlConnection()->error);
    
    echo json_encode($responseData);
}
}

?>