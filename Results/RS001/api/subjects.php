<?php

require '../config/conn.php';


$action = $_POST['action'];
// request class

if(isset($action)){
   Request::$action();
}

class Request{

    public static function read(){

       
        $query="CALL readSubjects()";
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
    public static function countUser(){

       
        $query="CALL countUsers()";
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
        $query="CALL addSubject('$name','$semesterName')";
        $resultSet= connection::GetMySqlConnection()->query($query);
        $responseData= array();

        if ($resultSet)
            $responseData=array("status"=>true,"data"=>"Successfully Saved....");
        else
            $responseData=array("status"=>false,"data"=> connection::GetMySqlConnection()->error);
        
        echo json_encode($responseData);


    }
    
    public static function update(){
        extract($_POST);
    
        $query="CALL updateSubject('$subject','$semester','$update_id')"; 
      
        $resultSet= connection::GetMySqlConnection()->query($query);
        $responseData= array();

        if ($resultSet)
            $responseData=array("status"=>true,"data"=>"Successfully Updated....");
        else
            $responseData=array("status"=>false,"data"=> connection::GetMySqlConnection()->error);
        
        echo json_encode($responseData);
    }

    public static function delete(){
        extract($_POST);
    
        $query="CALL deleteSubject('$id')";
        $resultSet= connection::GetMySqlConnection()->query($query);
        $responseData= array();

        if ($resultSet)
            $responseData=array("status"=>true,"data"=>"Successfully Deleted....");
        else
            $responseData=array("status"=>false,"data"=> connection::GetMySqlConnection()->error);
        
        echo json_encode($responseData);
    }

    public static function searchSubject(){

        extract($_POST);
        $query="SELECT *FROM subjects where SubjectID='$id'";
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

    public static function searchSemesterName(){

        extract($_POST);
        $query="CALL searchSemesterName('$semester')";
        $resultSet= connection::GetMySqlConnection()->query($query);
        $responseData= array();
        $data=array();

        if ($resultSet)
           {
                if (mysqli_num_rows($resultSet)>0)
                    $responseData=array("status"=>true);
                else
                $responseData=array("status"=>false);
           }
        else
            $responseData=array("status"=>false,"data"=> connection::GetMySqlConnection()->error);
        
        echo json_encode($responseData);


    }

}


?>