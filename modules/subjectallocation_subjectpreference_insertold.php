
<?php
require_once 'config.php';

// if (isset($_POST['submit']))
// {
//     echo 1;
//     $subject=$_POST['sub'];
//     foreach($subject as $index => $subj) 
// {
//     echo $subj;

// }
// }
?>

<?php

if(isset($_POST['save_multiple_data']))
{
    $sno=1;
    $subj = $_POST['sub'];
    $sub_array=array();
    $FID='F700';
    $checkquery="SELECT * from selected_subjects where Fid='$FID'";
        $res=mysqli_query($conn,$checkquery);
        $row = mysqli_fetch_array($res);
        
        if ($row){
            $delquery="DELETE from selected_subjects where Fid='$FID'";
            $res=mysqli_query($conn,$delquery);
        }
    foreach($subj as $index => $subject)
    {
        //echo $subject;
        // $s_name = $names;
        // $s_phone = $phone[$index];
        // $s_otherfiled = $empid[$index];

        

        $subquery="SELECT CourseName from subjects where CourseCode='$subject'";
        
        $res=mysqli_query($conn,$subquery);
        $row = mysqli_fetch_array($res); 
        $subname=$row['CourseName'];
        
        if (in_array($subject,$sub_array)){

            $_SESSION['status'] = "You cannot choose same subject twice!";
            header("Location: subjectallocation_subjectpreference.php");                      
        
        }
    
        else{
            array_push($sub_array,$subject);
        
            try{
            $query = "INSERT INTO selected_subjects VALUES ('$sno','$FID','$subject','$subname')";
            $query_run = mysqli_query($conn, $query);
            $sno++;
            }
        catch(Exception)
        {
            $_SESSION['status'] = "You cannot choose same subject twice!";
            header("Location: subjectallocation_subjectpreference.php");
            
            
            
        }
    }
}
        
    if($query_run)
    {
        $_SESSION['status'] = "Multiple Data Inserted Successfully";
        header("Location: subjectallocation_subjectpreference_viewinsert.php");
        
    }
    // else
    // {
    //     $_SESSION['status'] = "Data Not Inserted";
    //     header("Location: withouttable.php");
    //     //exit(0);
    // }
    
}
?>