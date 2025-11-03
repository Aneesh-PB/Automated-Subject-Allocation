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

      <div id="header-banner-div">Current Load Allocation</div>

      <div id="main-div" class="clearfix">
        <div id="bodyarea-div">            
        <table border="black" width=100% height=30%>
                <tr>
                  <th>Fid</th>
                  <th>Name</th>
                  <th>Number of theory courses</th>
                  <th>Number of lab courses</th>
                </tr>
                  
        <?php
                $query1="SELECT * FROM fload INNER JOIN faculty ON fload.FID=faculty.FID";
                $resu1=mysqli_query($mysqli,$query1);
                while($row=mysqli_fetch_array($resu1)){
                  ?>
                <tr>
                  <td><?php echo $row['FID']; ?></td>
                  <td><?php  echo $row['Name']; ?></td>
                  <td><?php echo $row['Theory courses']; ?></td>
                  <td><?php echo $row['Lab courses']; ?></td>
                </tr>
                  <?php } ?>  
        </div>

      </div>
      <div id="footer-div"></div>
    </div>
    </body>
</html>

