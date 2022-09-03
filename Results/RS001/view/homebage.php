
<?php
include '../config/conn.php';
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
    $statement= "SELECT *FROM students where RollNumber='$studentID';";
     $result= connection::GetMySqlConnection()->query($statement);
    $data=array("data"=>$result->fetch_assoc());
    return $data;
  }

  public static function ResultInformation(){
    $studentID=$_GET['username'];
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
    $statement= "CALL GetTotal('$studentID');";
     $result= connection::GetMySqlConnection()->query($statement);
     $total=0;
     while($row = $result->fetch_assoc()){
      $total=$row['Total'];
     }
     
    return $total;
  }

  public static function GetAverage():float{
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
    <title>Scool</title>
    <link rel="stylesheet" href="ind.css">
<!-- 
 //botstrap -->
 <link rel="stylesheet" href="../../assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body style="background-color: rgb(112, 167, 113);">
    
    <nav class="navbar  navbar-expand-lg navbar-light bg-light">
        <div class="container">
          <a class="navbar-brand logo" href="#">School  Online</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">

            </ul>
            <ul class="navbar-nav mx-auto">
                
            </ul>
            <ul class="navbar-nav mx-auto">
                
            </ul>
            <ul class="navbar-nav mx-auto">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#"> <i class="fas fa-user"></i>    <?php echo $_SESSION['username'] ?></a>
              </li>
              
              <li class="nav-item">
                <a class="nav-link bg-success" href="#"><i class="fas  fa-unlock-alt"></i>      Logout</a>
              </li>
           
            </ul>
          </div>
        </div>
      </nav>





      <div class="pcoded-main-container ">
    
                    <!-- [ breadcrumb ] start -->

                    <!-- [ breadcrumb ] end -->
               
                            <!-- [ Main Content ] start -->
                                <!-- card -->
                                <?php
                                foreach(ReadStudentInfo::StudentInformation()as $row){

                                  echo ' 
                                 

                                  <div class="card-container col-12">
                                  <div class="row">
                                  <div class="col-3 col-lg-6">
                                      
                                  </div>

                                  <div class="col-lg-7 col-11 mt-5  mx-auto" style="border-radius:55px ; box-shadow: 50px;">
                                      <h1 class="">Simester-win  </h1>
                                      <div class="row">

                                 
                                    <div class="container bg-success">
                                      <div class="titale">
                                      <h1 class="text-center" style="color : white;">student result</h1>
                                  </div>
                              </div>
                                      
                                       <hr>
                                       <div class="card  bg-light">
                                       <div class="row">
                                      <div class="text-right col-md-9 mt-5">
                                       <h4>Student iD: '.$row['RollNumber'].'</h4>
                                       <h5>Student Name:  <span class="text-danger" > '.$row['FullName'].' </span></h5>
                                
                                       <h5>Class: <span class="text-danger"> '.$row['Class'].'</span></h5>
                                    
                                      
                                    
                                       <h5>Curent Simester: <span class="text-danger"> '.$row['Semester'].'</span></h5>
                                    
                                      </div>
                                      <div class="text-right col-md-3 mt-5">
                                       <h4>parecentage:</h4>
                                       <p>Total marks: 19666%</p>
                                      </div>
                                      <hr>
     

                                       <hr>
                                       
                                      </div>
                                      </div> 
                                 
                                  </div>
                                </div>
                                  <div class="col-2">
                                    
                                  </div>
                                 
                              </div>
                                          </div>
                                          </div>


                                 
                                  ';

                                  
                                }
                                
                              ?>
                                
                                <div class="table-responsive">
                                        <table class="table table-bordered border-primary" id="simistertable">
                                        
                                        <thead class="bg-success text-light">
                                        <tr>
                                          <th>Subject</th>
                                         
                                            <th>marks</th>
                                           
                                        </tr>
                                    </thead>
                                            <tbody>
                                              <?php foreach(ReadStudentInfo::ResultInformation() as  $data):?>
                                                <?php foreach($data as $row):?>
                                                  <tr>
                                                    <td style="color: white;"><?php echo $row['Name'] ?></td>
                                                    <td style="color: white;"><?php echo $row['marks'] ?></td>

                                                  </tr>
                                                
                                                <?php endforeach;?>
                                              <?php endforeach;?>
                                            </tbody>
                                        </table>
                                        <h3 style="color: white;">Total : <?php echo ReadStudentInfo::GetTotal()?></h3>
                                        <h3 style="color: white;">Average : <?php echo ReadStudentInfo::GetAverage()?>%</h3>
                                    </div>
                                
                                          
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script src="../js/jquery-3.6.0.min.js"></script>
<script src="../js/RebortsStudentTable.js"></script>

</body>
</html>