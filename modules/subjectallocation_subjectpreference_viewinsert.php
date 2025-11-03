<?php
include("config.php");
session_start();
$FID=$_SESSION['Fid'];

?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Subject Selection</title>
    
    
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
        padding-top: 20px;
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
        text-align: left;
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

      <div id="header-banner-div"><h2 id='heading'>Current Selection</h2></div>

      <div id="main-div" class="clearfix">
        <div id="sidebar-div"> 
        <!-- <button onclick="document.location='flolad1.php'">Subject Allocation</button>
        <button onclick="document.location='fload.php'">Edit Allocation</button>
        <button onclick="document.location='currallo.php'">Current Allocation</button> -->
        </div>
       
        <div id="bodyarea-div" class="card-body">
        <div>
 
                    <div>
                        
                    <h4 style="text-align:left;">Faculty Name:</h4>
                            <a onclick="document.location='subjectallocation_subjectpreference.php'" class="add-more-form float-end btn btn-primary">EDIT</a>
                        </h4>
                    </div>

        </div>
        
        <script>var i=0;</script>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <?php 
                    if(isset($_SESSION['status']))
                    {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        unset($_SESSION['status']);
                    }
                ?>

                
                    <div class="card-body">

                        <!-- <form action="code04-06-2023-3-23.php" method="POST"> -->
                        
                        <div class="main-form mt-3 border-bottom">
                                <div class="row">
                                <?php
                                            
                                            $query="select * from selected_subjects where Fid='$FID' order by Pref";
                                            $resu=mysqli_query($conn,$query);
                                            $i=1;
                                            while($row=mysqli_fetch_array($resu))
                                            {
                                            ?>
                                    <div class="col-md-3">
                                        <div class="form-group mb-2">
                                            <?php
                                            echo"<p>Subject $i </p>"; 
                                            $i++;
                                            ?>
                                            
                                            </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-group mb-2">

                                            <p><?php echo $row['Course_code']." - ".$row['Course_name'];
                                            ?></p>
                                         
                                        </div>
                                    </div>
                                    
                                    
            
                                    <!-- <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <button type="button" class="remove-btn btn btn-danger">Remove</button>
                                        </div>
                                    </div> -->
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="paste-new-forms"></div>

                            <!-- <button type="submit" name="save_multiple_data" class="btn btn-primary">Save Multiple Data</button>
                        </form> -->

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

    </body>
</html>