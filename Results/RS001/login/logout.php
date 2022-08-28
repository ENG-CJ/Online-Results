<?php
session_start();
session_unset();
header("Location: auth-login.php");
?>