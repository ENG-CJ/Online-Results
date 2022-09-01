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
<<<<<<< HEAD
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
=======
        $query = "CALL findUser('$username','$password')";
        $result=connection::GetMySqlConnection()->query($query);
        if (mysqli_num_rows($result)>0){
            $data=array("isExist"=>true);
            $row=$result->fetch_assoc();
            $_SESSION['type']=$row['User_Type'];
            $_SESSION['userID']=$row['ID'];
            $_SESSION['username']=$row['Username'];
>>>>>>> f926d552d38f60c5b6eb02138624ccad384e39d7
        }
        else
            $data=array("isExist"=>false);
        
        echo json_encode($data);
    }

}




?>