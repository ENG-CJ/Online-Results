<?php
include '../config/conn.php';

$action=$_POST['action'];
if (isset($action))
{
    RequestResult::$action();
}



class RequestResult{


    public static function readSemesterNames(){

       
        $query="CALL readSemesterName()";
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

    public static function fetchSubjDetails(){

       extract($_POST);
        $query="CALL fetchSubjects('$semesterName')";
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

    public static function readClassNames(){

       
        $query="CALL readClassNames()";
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

    public static function fetchStudents(){
        extract($_POST);
       
        $query="CALL fetchStudents('$className','$semester')";
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
    public static function AddResult(){
        sleep(3);
       
        $studentID=$_POST['studentNames'];
        $semesterID= $_POST['semesterName'];
        $className= $_POST['className'];
      

        $query="CALL AddResult('$semesterID','$studentID','0.00','Yes','Pass','$className')";
        $resultSet= connection::GetMySqlConnection()->query($query);
        $data=array();
        $responseData= array();

        if ($resultSet && self::AddMarks())
           {
            $responseData=array("status"=>true,"data"=>"succesfully Inserted");
            
           }
        else
            $responseData=array("status"=>false,"data"=> connection::GetMySqlConnection()->error);
        
        echo json_encode($responseData);


    }


    public static function AddMarks() :bool{
        $success=false;
        $subjectID=$_POST['subject_id'];
        $marks=$_POST['marks'];
        $lastResultID=self::GetLastRowOfResult();
        if ($lastResultID!=0)
         {
            $count=0;
            $total=0;
            $marksData=array();
            for($i=0; $i<count($subjectID); $i++){
                $queryMarks="CALL AddMarks('$subjectID[$i]','$lastResultID','$marks[$i]')";
                $q=connection::GetMySqlConnection()->query($queryMarks);
                if($q)
                    $success=true;
               
                $total+=$marks[$i];
                $count++;
            }
            $pr=($total/$count);
            $Goaan=self::GO_AAMIN($pr);
            $queryUpdate="UPDATE `results` SET `Precentage`='$pr' WHERE result_id='$lastResultID' LIMIT 1";
            $q=connection::GetMySqlConnection()->query($queryUpdate);

            $queryUpdate2="UPDATE `results` SET `Status`='$Goaan' WHERE result_id='$lastResultID' LIMIT 1";
            $q2=connection::GetMySqlConnection()->query($queryUpdate2);
            $queryUpdate3="UPDATE `results` SET `Published`='No' WHERE result_id='$lastResultID' LIMIT 1";
            $q3=connection::GetMySqlConnection()->query($queryUpdate3);

            if ($Goaan != "Fail"){
                $queryUpdate4="UPDATE `results` SET `Decision`='Pass' WHERE result_id='$lastResultID' LIMIT 1";
                $q4=connection::GetMySqlConnection()->query($queryUpdate4);
            }
            else
            {
                $queryUpdate4="UPDATE `results` SET `Decision`='Fail' WHERE result_id='$lastResultID' LIMIT 1";
                $q4=connection::GetMySqlConnection()->query($queryUpdate4);
            }
           // $responseData=array("status"=>true,"data"=>"succesfully Inserted");
         }
         return $success;
    }
    public static function GetLastRowOfResult() : int{
        $query="SELECT result_id FROM results ORDER BY result_id DESC LIMIT 1;";
        $id=0;
        $resultSet=connection::GetMySqlConnection()->query($query);
        if($resultSet){
            $row=$resultSet->fetch_assoc();
            $id=$row['result_id'];
        }
        return $id;
    }

    public static function GO_AAMIN($celcelis):string{
        $status="";
        if ($celcelis>=90 && $celcelis<=100)
          $status="A";
        else if ($celcelis>=80 && $celcelis<=89)
          $status="B";
        else if ($celcelis>=70 && $celcelis<=79)
          $status="C";
        else if ($celcelis>=60 && $celcelis<=69)
          $status="D";
        else if ($celcelis>=50 && $celcelis<=59)
          $status="E";
        else
          $status="Fail";
        
        return $status;
    }


    public static function read(){

       
        $query="CALL readResult()";
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


    public static function update(){
        extract($_POST);
    
        $query="CALL UpdateResult('$id','$publish')"; 
      
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
    
        $query="CALL DeleteResults('$id')";
        $resultSet= connection::GetMySqlConnection()->query($query);
        $responseData= array();

        if ($resultSet)
            $responseData=array("status"=>true,"data"=>"Successfully Deleted....");
        else
            $responseData=array("status"=>false,"data"=> connection::GetMySqlConnection()->error);
        
        echo json_encode($responseData);
    }


    public static function GetPassAndFail(){

       extract($_POST);
        $query="CALL PassAndFail_Visual('$className','$semester')";
        $resultSet= connection::GetMySqlConnection()->query($query);
        $data=array();
        $responseData= array();

        if ($resultSet)
           {
               while( $rows=$resultSet->fetch_assoc())
               {
                $data []=array("Status"=> $rows['Decision'], "Percent"=>$rows['Perecentage']);
               }
                $responseData=array("IsAvailable"=>true,"data"=>$data);
           }
        else
            $responseData=array("status"=>false,"data"=> connection::GetMySqlConnection()->error);
        
        echo json_encode($responseData);


    }




    public static function fetchSingle(){
       $data= array();
       $semesterData=array();
       $studentData=array();
       $classData = array();

       $resultID = $_POST['id'];
       $findResultID= "SELECT *from results WHERE result_id='$resultID';";
       $results=connection::GetMySqlConnection()->query($findResultID);
       foreach($results as $row){

        $studentID=$row['StudentID'];
        $semester=$row['SemesterID'];
        $className = $row['Class'];


        $data['class_id']=$row['Class'];
        $data['student_id']=$row['StudentID'];
        $data['semester_id']=$row['SemesterID'];
        $data['current_student_name']=self::GetStudentName($studentID);
        $studentData[]=self::GetStudentNames($className,$semester);
        $semesterData[]=self::GetSemesterNames();
        $classData[]=self::GetClassNames();
        
       }
       $data['StudentData']=$studentData;
       $data['SemesterData']=$semesterData;
       $data['ClassData']=$classData;

       echo json_encode($data);
    }

    /**gets student name from data base */
    private static function GetStudentName($id):string{
        $name="";
        $findStudent= "SELECT *from Students WHERE RollNumber='$id';";
        $results=connection::GetMySqlConnection()->query($findStudent);
        $row=$results->fetch_assoc();
        $name = $row['FullName'];

        return $name;
    }

    /**Gets student names for the specified class and semester */
    private static function GetStudentNames($className,$semesterName){
        $studentDataArray=array();
        $findStudents= "SELECT *from Students WHERE Class='$className' AND Semester='$semesterName';";
        $results=connection::GetMySqlConnection()->query($findStudents);
        foreach($results as $row){
            $studentDataArray[]=array("StudentNames"=>$row['FullName']);
        }

        return $studentDataArray;
    }

    private static function GetSemesterNames(){
        $semesterDataArray=array();
        $findStudents= "SELECT ID,Name from simester;";
        $results=connection::GetMySqlConnection()->query($findStudents);
        foreach($results as $row){
            $semesterDataArray[]=array("semesterID"=>$row['ID'],"semesterName"=>$row['Name']);
        }

        return $semesterDataArray;
    }

    private static function GetClassNames(){
        $classDataArray=array();
        $findStudents= "SELECT classID, Name from classes;";
        $results=connection::GetMySqlConnection()->query($findStudents);
        foreach($results as $row){
            $classDataArray[]=array("classID"=>$row['classID'],"className"=>$row['Name']);
        }

        return $classDataArray;
    }



    // counting publish and unpublish results from database
    public static function countPublishOrUnPublish(){
        $publish_results=array();
        $unpublish=array();
        $response_data=array();
        $query_Publish_Results="SELECT COUNT(*) as 'Rows' FROM results WHERE Published='Yes';";
        $query_Unpublish_Results="SELECT COUNT(*) as 'Rows_Un' FROM results WHERE Published='No';";

        $results_set1=connection::GetMySqlConnection()->query($query_Publish_Results);
        foreach($results_set1 as $row_published_results){
            $publish_results['Published']=$row_published_results['Rows'];
        }
        $results_set2=connection::GetMySqlConnection()->query($query_Unpublish_Results);
        foreach($results_set2 as $row_unpublished_results){
            $unpublish['UnPublished']=$row_unpublished_results['Rows_Un'];
        }

        $response_data=array("Published"=>$publish_results, "Unpublished"=>$unpublish);

        echo json_encode($response_data);
    }
}


?>