<?php
include("config.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Faculty Load Allocation</title>
        <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div id="wrapper-div">
      <div id="logo-div"></div>

      <div id="nav-div">
      <button onclick="document.location='adminhome.php'">Home</button> 
      <button onclick="document.location='flolad1.php'">Load Allocation</button>
      <button onclick="document.location='fload.php'">Edit Allocation</button>
      <button onclick="document.location='currallo.php'">Current Allocation</button>
      </div>

      <div id="header-banner-div">Edit Load Allocation</div>

      <div id="main-div" class="clearfix">
        <div id="bodyarea-div">            
        <form action = "" method = "POST">
        
            <table border="black" width=100% height=30%>
            <tr>
               <th>Name</th>
               <td>
               <!--<td><input type ="text" name = "Fid"></td>-->
               <select class="inpu" name="Fid" >
                <?php
                $query="select * from faculty";
                $resu=mysqli_query($mysqli,$query);
                while($row=mysqli_fetch_array($resu)){
                ?>
                <option value="<?php echo $row['FID'];?>"><?php echo $row['Name'];?></option>
                <?php } ?>
                </select>
                <td>
            </tr>
            <tr>
               <th>Number of theory courses</th>
               <td><input type ="text" name = "Theo"></td> 
            </tr>
            <tr>
               <th>Number of lab courses</th>
               <td><input type ="text" name = "Lab"></td> 
            </tr>
            </table>
            <input type = "submit" name = "submit" >
        </form>
        <?php
        if(isset($_POST['submit']))
        {
         $Fid = $_POST['Fid'];   
         $Theo = $_POST['Theo'];
         $Lab = $_POST['Lab'];
         
        $res = mysqli_query($mysqli,"UPDATE `fload` SET `Theory courses` = '$Theo', `Lab courses` = '$Lab' WHERE `fload`.`FID` = '$Fid';");
        }
        ?>
        </div>

      </div>
      <div id="footer-div">Footer</div>
    </div>
    </body>
</html>

