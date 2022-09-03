<?php
include '../config/conn.php';
session_start();

$action = $_POST['action'];

if (isset($action))
    {
        $userLogin= new UserLogin();
        $userLogin->$action();
    }


class UserLogin{
     function FindUser(){
        extract($_POST);
        $data=array();
        $responseData=array();
        $query = "CALL findUser('$username','$password')";
        $resultSet = connection::GetMySqlConnection()->query($query);
        if (mysqli_num_rows($resultSet)>0){
           
            while($row= $resultSet->fetch_assoc()){
            $data []=array("data"=>$row);
            }
            $Query = "SELECT results.Published FROM results WHERE results.StudentID='$username';";
            $result=connection::GetMySqlConnection()->query($Query);
            foreach($result as $r)
                $data['IsPublished']=$r['Published'];
            $responseData= array("isExist"=>true, "data"=>$data);
            self::SetSession($resultSet);
        }
        else
            $responseData=array("isExist"=>false,"data"=>connection::GetMySqlConnection()->error);

        echo json_encode($responseData);
     }


     private function SetSession($result){
        foreach($result as $row)
        {
            $_SESSION['userID']=$row['id'];
            $_SESSION['username']=$row['username'];
            $_SESSION['type']=$row['role'];
        }
     }
}


?>