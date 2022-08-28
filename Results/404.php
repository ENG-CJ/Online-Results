<?php

$error =$_SERVER['REDIRECT_STATUS'];

$error_title="";
$message="";
if ($error ==404)
{
    $error_title="404 Not Found 🙂";
    $message="The Page You're looking for Might Have been Removed"."<br>"."Or Temporary Unavailable ";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JUST RESULTS | 404</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap.datetimepicker.css">
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.css">
	<link rel="stylesheet" href="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

    <!-- Favicon icon -->
    <script src="https://kit.fontawesome.com/db76417cf2.js" crossorigin="anonymous"></script>
    <link rel="icon" href="../../assets/images/favicon.ico" type="image/x-icon">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="../../assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <!-- animation css -->
    <link rel="stylesheet" href="../../assets/plugins/animation/css/animate.min.css">
    <!-- vendor css -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
     <style>

        body{
            background-color: white;
            font-family: poppins;
        }
     </style>
</head>
<body>
    
<div class="jumbotron jumbotron-fluid">
  <div class="container-fluid" style="text-align: center;">
    <h1 class="display-4"><?php echo $error_title ?></h1>
    <p class="lead"><?php echo $message ?> <a href="#" style="color: #6c3fff; font-weight: 700; text-decoration: none; font-family:poppins">Back To Home Page</a></p>
  </div>
        
</div>

</body>
</html>