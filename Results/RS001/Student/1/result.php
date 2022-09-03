
<?php

use ReadStudentInfo as GlobalReadStudentInfo;

include '../../config/conn.php';
session_start();
if(!$_SESSION['username']){
    header("location : ../login/auth-login.php");
    die();
    return;
}
class ReadStudentInfo{
  private   static  $total=0;
  private  static $average=0;
   
  public static function StudentInformation(){
    $studentID=$_GET['username'];
    if ($studentID != $_SESSION['username'])
         $studentID=$_SESSION['username'];
    $statement= "SELECT *FROM students where RollNumber='$studentID';";
     $result= connection::GetMySqlConnection()->query($statement);
    $data=array("data"=>$result->fetch_assoc());
    return $data;
  }

  public static function ResultInformation(){
    $studentID=$_GET['username'];
    if ($studentID != $_SESSION['username'])
        $studentID=$_SESSION['username'];
    $statement= "CALL readFinalResult('$studentID');";
     $result= connection::GetMySqlConnection()->query($statement);
    $data=array();
     while($row = $result->fetch_assoc()){
    
      $data [] =array($row);
     
     }
    return $data;
  }

  public static function getSubjectsLength():int{
    $studentID=$_GET['username'];
    if ($studentID != $_SESSION['username'])
    $studentID=$_SESSION['username'];
    $statement= "CALL GetTotalSubject('$studentID');";
     $result= connection::GetMySqlConnection()->query($statement);
    $length=0;
     while($row = $result->fetch_assoc()){
      $length=$row['Length'];
     }
     
    return $length;
  }

  public static function GetTotal(){
    $studentID=$_GET['username'];
    if ($studentID != $_SESSION['username'])
    $studentID=$_SESSION['username'];
    $statement= "CALL GetTotal('$studentID');";
     $result= connection::GetMySqlConnection()->query($statement);
     $total=0;
     while($row = $result->fetch_assoc()){
      $total=$row['Total'];
     }
     
    return $total;
  }

  public static function GetAverage():float{
    if (self::getSubjectsLength()==0)
      return 0;
    $avg = self::GetTotal() / self::getSubjectsLength();
    return $avg;
  }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Result</title>
    
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/db76417cf2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <style>
        body{
            background-color: #fff;
        }
    </style>

</head>
<body>
<!-- Just an image -->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
    <a class="navbar-brand" href="#"><img src="../../../../../Online-Results/Results/RS001/images/logo.png" width="200" height="60" alt=""></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
    <div class="navbar-nav">
     
      <a class="nav-item nav-link " href="#"><i class="fa-solid fa-user mr-2"></i>ENG-CJ</a>
      <a class="nav-item nav-link" href="../../login/logout.php" style="background-color: #D36B00; color : white; border-radius : 5px; cursor : pointer" title="Logout "><i class="fa-solid fa-right-from-bracket mr-2" ></i>Logout</a>
    
    </div>
  </div>
    </div>
  
</nav>
<!-- end -->
<div class="container mt-5 printArea">
<div class="row">
    <div class="col-xl-12 col-md-12">
    <div class="card" style="border-radius: 40px; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
  <div class="card-header " style="background-color: #EB1D36; border-radius: 5px; color : white; text-align:center;
  font-family : poppins; font-weight : 650; font-size : 20px; ">
    Student Information
  </div>
  <div class="card-body p-5">
    <div class="row">
        <div class="col-md-6">
            <?php foreach(GlobalReadStudentInfo::StudentInformation() as $row): ?>
                <div class="info">
                    <h5 style="font-weight:550; ">Student ID : <span style="font-weight: 450; font-family: serif"><?php echo $row['RollNumber']?></span></h5>
                </div>
                <div class="info">
                    <h5 style="font-weight:550; ">Name : <span style="font-weight: 450;"><?php echo $row['FullName']?></span></h5>
                </div>
                <div class="info">
                    <h5 style="font-weight:550; ">Class : <span style="font-weight: 450;"><?php echo $row['Class']?></span></h5>
                </div>
                <div class="info">
                    <h5 style="font-weight:550; ">Current Semester : <span style="font-weight: 450;"><?php echo $row['Semester']?></span></h5>
                </div>
            <?php endforeach;?>
        </div>

        <div class="col-md-3">
            <div class="percent-info">
                <div class="title">
                <span style="color: #576F72; font-family : sans-serif; font-weight :650">Percent Gained</span>
                </div>
                <div class="average">
                    <h4 style="font-size: 30px; font-weight :700; color :#DA1212 "><?php echo ReadStudentInfo::GetAverage()?>%</h4>
                </div>
                <div class="total-marks">
                    <p style="font-family: sans-serif;">Total Marks : <span style="color: #9D9D9D; font-weight : 700; font-family : poppins"><?php echo ReadStudentInfo::GetTotal()?></span></p>
                </div>
            </div>
        </div>

   
    </div>

    <hr width="100%" style="margin-bottom: 10px">
    <div class="form-group pt-3 pb-3" >
        <label for="" style="color: gray;  font-family : poppins">Semester</label>
        <select name="" id="" class="form-control">
            <option value="">Select</option>
        </select>
    </div>
   

    <div class="row">
        <div class="col-xl-12 col-md-12">
        <table class="table">
  <thead>
    <tr>
      <!-- <th scope="col">#</th> -->
      <th scope="col">Subject</th>
      <th scope="col">Marks</th>
      
    </tr>
  </thead>
  <tbody> 
    <?php foreach(ReadStudentInfo::ResultInformation() as $data):?>
    <?php foreach($data as $row):?>
            <tr>
                <td><?php echo $row['Name']?></td>
                <td><?php echo $row['marks']?></td>
            </tr>
        <?php endforeach;?>
    <?php endforeach; ?>

  </tbody>
</table>
        </div>
        
       
       
    </div>
  </div>
</div>
    </div>
</div>

</div>

<div class="download" >
            <button class="btn btn-secondary hidden-print" onclick="printResult();" type="button"><i class="fa-solid fa-print mr-3"></i>Print</button>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script src="../1/print.js"></script>
<script src="./printThis.js"></script>


<script>
  function printResult(){
    $(".printArea").printThis();
  }
</script>
</body>
</html>