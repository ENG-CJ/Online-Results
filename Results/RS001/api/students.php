<?php

require '../config/conn.php';
session_start();

$action = $_POST['action'];
// request class

if(isset($action)){
   Request::$action();
}

class Request{

    public static function read(){

       
        $query="CALL readStudents()";
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

    public static function readSemesterNames(){

       
        $query="CALL readSemesterName()";
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
    public static function countStudent(){

       
        $query="CALL countStudents()";
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
    public static function insert(){

        extract($_POST);
        $query="CALL addStudent('$roll','$name','$gender','$mobile','$address','$className','$semesterName')";
        $resultSet= connection::GetMySqlConnection()->query($query);
        $responseData= array();

        if ($resultSet)
            $responseData=array("status"=>true,"data"=>"'$name' Was Registered Successfully😊");
        else
            $responseData=array("status"=>false,"data"=> connection::GetMySqlConnection()->error);
        
        echo json_encode($responseData);


    }
    
    public static function update(){
        extract($_POST);
    
        $query="CALL updateStudent('$roll','$name','$gender','$mobile','$address','$className','$semesterName','$update_id')"; 
      
        $resultSet= connection::GetMySqlConnection()->query($query);
        $responseData= array();

        if ($resultSet)
            $responseData=array("status"=>true,"data"=>"Successfully Updated😊😊");
        else
            $responseData=array("status"=>false,"data"=> connection::GetMySqlConnection()->error);
        
        echo json_encode($responseData);
    }

    public static function delete(){
        extract($_POST);
    
        $query="CALL deleteStudent('$id')";
        $resultSet= connection::GetMySqlConnection()->query($query);
        $responseData= array();

        if ($resultSet)
            $responseData=array("status"=>true,"data"=>"Successfully Deleted....");
        else
            $responseData=array("status"=>false,"data"=> connection::GetMySqlConnection()->error);
        
        echo json_encode($responseData);
    }

    public static function searchStudent(){

        extract($_POST);
        $query="SELECT *FROM students where RollNumber='$id'";
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

    public static function IsExist(){

        extract($_POST);
        $query="CALL ExistStudent('$roll','$mobile')";
        $resultSet= connection::GetMySqlConnection()->query($query);
        $responseData= array();
        $data=array();

        if ($resultSet)
           {
                if (mysqli_num_rows($resultSet)>0)
                    $responseData=array("ExistDta"=>true);
                else
                $responseData=array("ExistData"=>false);
           }
        else
            $responseData=array("status"=>false,"data"=> connection::GetMySqlConnection()->error);
        
        echo json_encode($responseData);


    }




}


?>