<?php

require '../config/conn.php';


$action = $_POST['action'];
// request class

if(isset($action)){
   Request::$action();
}

class Request{





    public static function insert_simister(){

        extract($_POST);
        $query=" CALL `add_simester`('$simister_id','$simistername')";
        $resultSet= connection::GetMySqlConnection()->query($query);
        $responseData= array();

        if ($resultSet)
            $responseData=array("status"=>true,"data"=>"Successfully Saved....");
        else
            $responseData=array("status"=>false,"data"=> connection::GetMySqlConnection()->error);
        
        echo json_encode($responseData);


    }
    public static function simisterRead(){

       
        $query="SELECT `ID`, `Name` FROM `simester` WHERE 1";
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

public static function fecthsimester(){

    extract($_POST);
    $query="SELECT * FROM simester where ID='$id'";
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

public static function update_simester(){
    extract($_POST);

    $query="CALL `update_simister`('$simister_id','$Name','$update_id')"; 
  
    $resultSet= connection::GetMySqlConnection()->query($query);
    $responseData= array();

    if ($resultSet)
        $responseData=array("status"=>true,"data"=>"Successfully Updated");
    else
        $responseData=array("status"=>false,"data"=> connection::GetMySqlConnection()->error);
    
    echo json_encode($responseData);
}


//count
public static function countSmister(){

       
    $query="SELECT COUNT(*) as 'Rows' FROM simester";
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

public static function smister_delete(){
    extract($_POST);

    $query="DELETE FROM `simester` WHERE ID='$id'";
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