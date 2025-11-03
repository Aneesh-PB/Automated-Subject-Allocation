<?php

//include('allocation functions edit 05-07-2023.php');
include("allocation functions edit 05-07-2023 28-07-2023 6-17pm.php");
if (isset($_POST['seconditer']))
    {
        seconditer();
    }
    
if (isset($_POST['thirditer']))
{
  thirditer();
}
if (isset($_POST['fourthiter']))
{
   
  fourthiter();
}
if (isset($_POST['unalloc']))
{
  unalloc();
}
if (isset($_POST['unallocadd']))
{
  unallocadd();
}
if (isset($_POST['edit']))
{
  unallocadd();
}
$query="select * from faculty order by priority";
$resu=mysqli_query($conn,$query);

while($row=mysqli_fetch_array($resu)){

  $Fid=$row['Fid'];
  
  //echo $Fid;
  $theoryquery="select * from faculty where Fid='$Fid'";
  $theoryres=mysqli_query($conn,$theoryquery);
  $theorycol=mysqli_fetch_array($theoryres);
  $theorynum=$theorycol['Theory'];
  //echo $theorynum;
  if (isset($_POST[$Fid]))
  {
    displaydropdown($Fid);

  }
}

$query="select * from faculty order by priority";
$resu=mysqli_query($conn,$query);
while($row1=mysqli_fetch_array($resu)){

$Fid=$row1['Fid'];

//echo $Fid;
$theoryquery="select * from faculty where Fid='$Fid'";
$theoryres=mysqli_query($conn,$theoryquery);
$theorycol=mysqli_fetch_array($theoryres);
$theorynum=$theorycol['Theory'];
//echo $theorynum;

if (isset($_POST[$Fid.'Edit']))
{

  $temptablecreatequery='Create table if not exists tempallocationedit like tempallocation;';
  $temptablecreatequeryres=mysqli_query($conn,$temptablecreatequery);
  
  $tempselectquery='Select * from tempallocationedit';
  $tempselectqueryres=mysqli_query($conn,$tempselectquery);
  $tempselectquerycol=mysqli_fetch_array($tempselectqueryres);
  if (!$tempselectquerycol){
  $temptableinsertquery='Insert into tempallocationedit (select * from tempallocation)';
  $temptableinsertqueryres=mysqli_query($conn,$temptableinsertquery);
  }
  $deletequery="Delete from tempallocationedit where FacultyID='$Fid'";
  $temptableinsertqueryres=mysqli_query($conn,$deletequery);
  $subcode = $_POST['sub1'];
  $sub_array=array();


  
  foreach($subcode as $index => $courseid)
  {
      $coursequery="Select * from subjects where CourseCode='$courseid'";
      $coursequeryres=mysqli_query($conn,$coursequery);
      $coursecol=mysqli_fetch_array($coursequeryres);
      $coursesem=$coursecol['Semester'];
      $courseprogram=$coursecol['Program'];
      $insertquery="Insert into tempallocationedit (FacultyID,CourseID,AllocationType,Semester,Program) values ('$Fid','$courseid','Theory','$coursesem','$courseprogram')";
      
      $inqueryres=mysqli_query($conn,$insertquery);
      // $s_name = $names;
      // $s_phone = $phone[$index];
      // $s_otherfiled = $empid[$index];

      

      // $subquery="SELECT * from subjects where CourseCode='$subject'";
      
      // $res=mysqli_query($conn,$subquery);
      // $row = mysqli_fetch_array($res); 
      // $subname=$row['CourseName'];
      // $subsem=$row['Semester'];
      // $subprogram=$row['Program'];
          }
    displayafteredit($Fid);
    

  }
}
if (isset($_POST['submit']))
{
  allocsubmit();
}
