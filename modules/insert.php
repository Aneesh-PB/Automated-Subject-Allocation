<?php
include("config.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Subject Allocation And Workload</title>
    </head>
    <body>
        <form action = "" method = "POST">
            <table>
            <tr>
               <th>Fid</th>
               <td><input type ="text" name = "Fid"><br></td> 
            </tr>
            <tr>
               <th>Name</th>
               <td><input type ="text" name = "Name"><br></td> 
            </tr>
            <tr>
               <th>Priority</th>
               <td><input type ="text" name = "Priority"><br></td> 
            </tr>
            <tr>
               <th><input type = "submit" name = "submit" ><br></th> 
            </tr>
            </table>

        </form>
        <?php
        if(isset($_POST['submit']))
        {
         $Fid = $_POST['Fid'];   
         $Name = $_POST['Name'];
         $Priority = $_POST['Priority'];
        

        $res = mysqli_query($mysqli,"INSERT into faculty values('$Fid','$Name','$Priority')");
        }
        ?>
    </body>
</html>

