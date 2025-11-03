<?php
include("config.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Faculty Load Allocation</title>
    </head>
    
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
        background-color: lightblue;
        padding-left: 2%;
        line-height: 50px;
        margin-bottom: 10px;
      }

      #nav-div {
        width: 100%;
        min-height: 30px;
        background-color: lightblue;
        text-align: center;
        line-height: 30px;
        margin-bottom: 10px;
      }

      #header-banner-div {
        width: 100%;
        min-height: 100px;
        background-color: lightblue;
        text-align: center;
        line-height: 100px;
        margin-bottom: 10px;
        font-weight: bold;
      }

      #main-div {
        width: 100%;
        margin-bottom: 10px;
      }

      #sidebar-div {
        width: 20%;
        min-height: 400px;
        background-color: lightblue;
        float: left;
        text-align: center;
        line-height: 70px;
      }

      #bodyarea-div {
        width: 75%;
        min-height: 400px;
        background-color: lightblue;
        float: right;
        text-align: center;
        line-height: 50px;
      }

      .clearfix::after {
        content: "";
        display: block;
        clear: both;
      }

      #footer-div {
        width: 100%;
        min-height: 50px;
        background-color: lightblue;
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

      <div id="nav-div">Navigation</div>

      <div id="header-banner-div">Faculty Load Allocation</div>

      <div id="main-div" class="clearfix">
        <div id="sidebar-div"> 
        <button onclick="document.location='flolad1.php'">Subject Allocation</button>
        <button onclick="document.location='fload.php'">Edit Allocation</button>
        <button onclick="document.location='currallo.php'">Current Allocation</button>
        </div>
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
                $query="select * from faculty order by priority";
                $resu=mysqli_query($conn,$query);
                $i=0;
                $j=1000;
                while($row=mysqli_fetch_array($resu)){
                  
                  ++$i;
                  ++$j;
                  $Fid=$row['Fid'];
                  //echo $Fid;
                  $theoryquery="select * from fload where fid='$Fid'";
                  $theoryres=mysqli_query($conn,$theoryquery);
                  $theorycol=mysqli_fetch_array($theoryres);
                  $theorynum=$theorycol['Theory'];
                  echo $theorynum;
                ?>
                <tr>
                <td rowspan="<?php echo $theorynum;?>"> <?php echo $i;?></td>
                <td rowspan="<?php echo $theorynum;?>"><?php echo $row['FName'];?></td>
                <td><input type="number" name = "<?php echo $j;?>"  min="0" max="10"></td>
                </tr>
                <script>
                  var i=1
                  while(i < "<?php echo $theorynum; ?>")
                  {
                    document.write(`
                    <tr>
      
                    <td><input type="number" name = "<?php echo $j;?>"  min="0" max="10"></td>
                    </tr>`
                    )
                    i++;
                  }
                  console.log('-----')
                  </script>
               
                  <?php }  ?>
                
              </table>
               <input type = "submit" name = "submit">
               </form>
              
                <?php
                // $query="select * from faculty";
                // $resu=mysqli_query($mysqli,$query);
                // $i=0;$j=1000;
                // while($row=mysqli_fetch_array($resu)){
                //   ++$i;++$j;
                // if(isset($_POST['submit']))
                // {
                //   $Fid =  $row['FID'];  
                //   $Theo = $_POST[$i];
                //   $Lab = $_POST[$j];
                //   $res = mysqli_query($mysqli,"INSERT INTO `fload` (`FID`, `Theory courses`, `Lab courses`) VALUES ('$Fid', '$Theo', '$Lab');");
                // }}
                 ?>
        </div>

      </div>
      <div id="footer-div">Footer</div>
    </div>
    </body>
</html>