<?php

require '../config/conn.php';


$action = $_POST['action'];
// request rebortresult homebage

if(isset($action)){
   Request::$action();
}

class Request{





    // public static function insert_simister(){

    //     extract($_POST);
    //     $query=" CALL `add_simester`('$simister_id','$simistername')";
    //     $resultSet= connection::GetMySqlConnection()->query($query);
    //     $responseData= array();

    //     if ($resultSet)
    //         $responseData=array("status"=>true,"data"=>"Successfully Saved....");
    //     else
    //         $responseData=array("status"=>false,"data"=> connection::GetMySqlConnection()->error);
        
    //     echo json_encode($responseData);


    // }
    public static function RebortStudents(){
        // $getID = $_GET['id'];
        extract($_POST);
        $query="CALL `RebortStudentsTABLE`( 'ST125265')";
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

   





}

?>