<?php
include("config.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Layout 1</title>

    <style type="text/css">
      * {
        margin: 0px;
        padding: 0px;
        box-sizing: border-box;
        font-family: Arial;
      }

      #logo-div {
        width: 100%;
        min-height: 50px;
        background-color: lightgray;
        padding-left: 2%;
        line-height: 50px;
        margin-bottom: 10px;
      }


      #header-banner-div {
        width: 100%;
        min-height: 100px;
        background-color: lightgray;
        text-align: center;
        line-height: 100px;
        margin-bottom: 10px;
      }

      #main-div {
        width: 100%;
        margin-bottom: 10px;
      }

      /* #sidebar-div {
        width: 20%;
        min-height: 400px;
        background-color: lightgray;
        float: left;
        text-align: center;
        line-height: 400px;
      } */

      #bodyarea-div {
        width: 100%;
        min-height: 100px;
        background-color: lightgray;
        float: right;
        text-align: center;
        line-height: 100px;
      }

      #tname{
        text-align:left;
        margin-left: 100px;
        margin-top: 10px;
      }

      .clearfix::after {
        content: "";
        display: block;
        clear: both;
      }

      #footer-div {
        width: 100%;
        min-height: 50px;
        background-color: lightgray;
        text-align: center;
        line-height: 50px;
      }

      #wrapper-div {
        width: 80%;
        margin: auto;
      }


    </style>
  </head>
  <body>
    <div id="wrapper-div">
      <div id="logo-div">Logo</div>


      <div id="header-banner-div">Subject Selection</div>

      <div id="main-div" class="clearfix">
  
        <div id="bodyarea-div">

        <h2 id="tname">Name:</h2>
        <form id="tnameform" method="post" action="">
        <input name="tnamein" type="text">
        
        <input type="submit" name="submit" value="Submit">
    </form>
        
<p>

<form action = "" method = "POST">
            <table border="black" width=100% height=30%>
            <tr>
               <th>Name</th>
               <td>
               <!--<td><input type ="text" name = "Fid"></td>-->
               <select class="inpu" name="CourseCode" >
                <?php
                $query="select * from subjects";
                $resu=mysqli_query($conn,$query);
                while($row=mysqli_fetch_array($resu)){
                ?>
                <option value="<?php echo $row['CourseCode'];?>"><?php echo $row['CourseName'];?></option>
                <?php } ?>
                </select>
                <td>
            </tr>
            <!-- <tr>
               <th>Number of theory courses</th>
               <td><input type ="text" name = "Theo"></td> 
            </tr>
            <tr>
               <th>Number of lab courses</th>
               <td><input type ="text" name = "Lab"></td> 
            </tr>
            <tr> -->
               
            <!-- </tr> -->
            </table>
            <input type = "submit" name = "submit" >
        </form>
        <?php
        if(isset($_REQUEST['submit']))
        {
         //$Fid = $_POST['FId']; 
         //$Fid='F100';  
         $Ccode= $_REQUEST['CourseCode'];
         echo $Ccode;
         //$Cname = 'abc';
         
        $res = mysqli_query($conn,"INSERT INTO `selected_subjects` (`Fid`, `Course_code`, `Course_name`) VALUES ('F100', '101004/IT622T', 'ABC');");
        }
        ?>
    <?php

   

    // $sql ="select coursename from subjects";
    // $result=$conn ->query ($sql);

    // echo "<label for='sub1'>Subject 1:</label>";
    // if ($result ->num_rows>0){
    //     echo "<select name=sublist class='form-control' style='width:200px;'>";
    //     while ($row=$result ->fetch_assoc()){
    //         echo "<option value=$row[id]>$row[coursename].</option>";
            
    //     }
    //     echo "</select>";
    // }
    // else{
    //     echo "0 results";
    //     }
    

    ?>
</p>

        <!-- <form>
                    <label for="sub1">Subject 1:</label>
                    <select id="sub1" name="sub1">
                    <option value="ML">ML</option>
                    <option value="BDA">BDA</option>
                </select>
                <br>
                <label for="sub1">Subject 2:</label>
                    <select id="sub1" name="sub1">
                    <option value="ML">ML</option>
                    <option value="BDA">BDA</option>
                </select>
                </form> -->

        Body Area
    
    </div>
       
      </div>
      <div id="footer-div">Footer</div>
    </div>
  </body>
</html>
