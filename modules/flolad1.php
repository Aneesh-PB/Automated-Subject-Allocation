<?php
include("config.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Faculty Load Allocation</title>
    </head>
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

      <div id="header-banner-div">Faculty Load Allocation</div>

      <div id="main-div" class="clearfix">

        <div id="bodyarea-div">
                <form action = "" method = "POST">
                <table border="black" width=100% height=30%>
                <tr>
                <!-- <th>Sl No</th> -->
                <th>Name</th>
                <th>Theory</th>
                <th>Lab</th>
                </tr>
                
                <?php
                $query="select * from faculty";
                $resu=mysqli_query($conn,$query);
                $i=0;$j=1000;
                while($row=mysqli_fetch_array($resu)){
                  ++$i;
                  ++$j;
                ?>
                <tr>
                <td><?php echo $row['FName'];?></td>
                <td><input type="number" name = "<?php echo $i;?>" min="0" max="10"></td>
                <td><input type="number" name = "<?php echo $j;?>"  min="0" max="10"></td>
                </tr>
                <?php } ?>
                
                </table>
                <input type = "submit" name = "submit">
                </form>
              
                <?php
                $query="select * from faculty";
                $resu=mysqli_query($conn,$query);
                $i=0;$j=1000;
                while($row=mysqli_fetch_array($resu)){
                  ++$i;++$j;
                if(isset($_POST['submit']))
                {
                  $Fid =  $row['FID'];  
                  $Theo = $_POST[$i];
                  $Lab = $_POST[$j];
                  $res = mysqli_query($conn,"INSERT INTO `fload` (`FID`, `Theory courses`, `Lab courses`) VALUES ('$Fid', '$Theo', '$Lab');");
                }}
            
                 ?>
        </div>

      </div>
      <div id="footer-div">Footer</div>
    </div>
    </body>
</html>
