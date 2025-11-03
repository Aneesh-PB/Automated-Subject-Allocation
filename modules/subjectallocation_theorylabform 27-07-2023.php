

<?php

include("config.php");



?>
<!DOCTYPE html>
<html>
    <head>
        <title>Lab-Theory Mapping</title>
    </head>
    
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div id="wrapper-div">
      <div id="logo-div"></div>

      <div id="nav-div">
      <button onclick="document.location='adminhome.php'">Home</button>
 

      <div id="header-banner-div">Lab-Theory Mapping</div>

      <div id="main-div" class="clearfix">
        
        <div id="bodyarea-div">
        <form action = "subjectallocation_theorylabformpost.php" method = "POST">
    
          
  
      <table border="black" width=100% height=30%>
                <tr>
                
                <th>S.No</th>
                <th>Lab Subject</th>
                <th>Theory Subject</th>
                </tr>
         
           
        <?php 
         //Display 
         
         $i=1;

         $labcoursequery="select * from course where CourseType='LAB' and CourseSem in ('S1','S3','S5','S7') order by CourseSem";
         $resu=mysqli_query($conn,$labcoursequery);
        
         while($row=mysqli_fetch_array($resu)){
         $allocationcount=0;
           
           
         ?>
         
         <tr>                                        
         <td><?php echo $i++;?></td>
         <td><?php echo $row['CourseCode'].' - '.$row['CourseName'].' - '.$row['CourseSem'].' - '.$row['Program'];?>
         
         </td>
         <td><?php
             
           
            ?>
            <select name="code[]" id="code[]">
                 <option value="None" disabled selected>Select Subject</option>
                 <option value="None">None</option>
                    <?php
                    
                    $theorycoursequery="Select * from course where CourseType='CORE' and CourseSem in ('S1','S3','S5','S7') order by CourseName";
                    $theorycourseres=mysqli_query($conn,$theorycoursequery);
                    while($rows=mysqli_fetch_array($theorycourseres)){                     
                    ?>
                    
                    <option value="<?php echo $rows['CourseCode'];?>"><?php echo $rows['CourseCode'].' - '.$rows['CourseName'].' - '.$rows['CourseSem'].' - '.$rows['Program'];?></option>
                    <?php
                } 
                ?>
                
                    </select>                 
            
          <?php
              }?>             
     
            </td>
         </tr>
         </table>
         <input type = "submit" value="Submit" name = "submit">
          
        </form>
           
        </div>

      </div>
      
    </div>
    <div id="footer-div">Footer</div>
    

    </body>

</html>
   
    
    
