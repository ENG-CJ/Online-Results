<?php

require '../config/conn.php';


$action = $_POST['action'];
// request class

if(isset($action)){
   Request::$action();
}

class Request{


    public static function read(){

       
        $query="CALL readUsers()";
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

    public static function GET_STATEMENT(){

       extract($_POST);
        $query="CALL render_user_statement('$user_id','$fromDate','$toDate')";
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
        $query="CALL add_user('$user_id','$username','$password','$role','$status')";
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
    
        $query="CALL update_user('$user_id','$username','$password','$role','$status','$update_id')"; 
      
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
    
        $query="CALL delete_sp('$id')";
        $resultSet= connection::GetMySqlConnection()->query($query);
        $responseData= array();

        if ($resultSet)
            $responseData=array("status"=>true,"data"=>"Successfully Deleted....");
        else
            $responseData=array("status"=>false,"data"=> connection::GetMySqlConnection()->error);
        
        echo json_encode($responseData);
    }
    // Get user balance
    public static function GET_BALANCE(){

        extract($_POST);
        $query="SELECT get_UserBalance('$id') AS `Balance`;";
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

    public static function searchUser(){

        extract($_POST);
        $query="SELECT *FROM users where ID='$id'";
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

}


?>