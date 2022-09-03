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

    function findUser(){
        extract($_POST);
        $data=array();

        $query = " CALL `findNewuser`('$username','$password')";
        $result=connection::GetMySqlConnection()->query($query);

     

        if (mysqli_num_rows($result)>0){
            $data=array("isExist"=>true);
            $row=$result->fetch_assoc();
            $_SESSION['type']=$row['role'];
            $_SESSION['ID']=$row['RollNumber'];
            $_SESSION['username']=$row['username'];
            $_SESSION['Semester']=$row['Semester'];
            $_SESSION['Class']=$row['Class'];

        }
      else
            $data=array("isExist"=>false);
        
        echo json_encode($data);
    }






}


?>