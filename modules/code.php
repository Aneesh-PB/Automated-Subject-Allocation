<?php
session_start();
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
    $subj = $_POST['sub'];
 

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
        echo $subname; 
    
        try{
        $query = "INSERT INTO selected_subjects VALUES ('F100','$subject','$subname')";
        $query_run = mysqli_query($conn, $query);
        }
        catch(Exception)
        {
            $_SESSION['status'] = "You cannot choose same subject twice!";
            header("Location: withouttable.php");
            
        }
    }

    // if($query_run)
    // {
    //     $_SESSION['status'] = "Multiple Data Inserted Successfully";
    //     header("Location: withouttable.php");
    //     //exit(0);
    // }
    // else
    // {
    //     $_SESSION['status'] = "Data Not Inserted";
    //     header("Location: withouttable.php");
    //     //exit(0);
    // }
}
?>

<?php
// session_start();
// $con = mysqli_connect("localhost","root","","phptutorials");

// if(isset($_POST['save_multiple_data']))
// {
//     $subj = $_POST['sub'];
//     $phone = $_POST['phone'];

//     foreach($subj as $index => $subject)
//     {
//         $s_name = $names;
//         $s_phone = $phone[$index];
//         // $s_otherfiled = $empid[$index];

//         $query = "INSERT INTO demo (name,phone) VALUES ('$s_name','$s_phone')";
//         $query_run = mysqli_query($con, $query);
//     }

//     if($query_run)
//     {
//         $_SESSION['status'] = "Multiple Data Inserted Successfully";
//         header("Location: insert-multiple-data.php");
//         exit(0);
//     }
//     else
//     {
//         $_SESSION['status'] = "Data Not Inserted";
//         header("Location: insert-multiple-data.php");
//         exit(0);
//     }
// }
?>