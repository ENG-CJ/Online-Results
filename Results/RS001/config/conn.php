
<?php

//^ connection configuration

class connection{

    public static function GetMySqlConnection(){
        $conn = new mysqli("localhost","root","","justresults");
        if ($conn->connect_error)
            return $conn->error;
        else
            return $conn;
    }
}

?>