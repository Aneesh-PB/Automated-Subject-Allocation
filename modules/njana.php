<?php session_start();
 require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Layout 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
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

    #sidebar-div {
        width: 20%;
        min-height: 400px;
        background-color: lightgray;
        float: left;
        text-align: center;
        line-height: 400px;
      } 

      #bodyarea-div {
        width: 100%;
        min-height: 100px;
        background-color: lightblue;
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

                <div class="card mt-4">
                <h2 id='heading'>Subject Selection</h2>
                <br>
                    <div class="card-header">
                        
                        <h4>Name:
                            
                        </h4>
                    </div>
                    <div class="card-body">

                        <form action="codenew.php" method="POST">
                        
                            <div class="main-form mt-3 border-bottom">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <label for="subcount">Subject 1</label>
                                            </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <!-- <label for="">Phone Number</label>
                                            <input type="text" name="phone[]" class="form-control" required placeholder="Enter Phone Number">
                                         -->
                                         <select class="form-control" name="sub[]" id="sub[]" class="form-control" required placeholder="Select Subject" >
                                         <option value="" disabled selected>Select Subject</option>
                                            <?php
                                            $query="select * from subjects";
                                            $resu=mysqli_query($conn,$query);
                                            
                                            while($row=mysqli_fetch_array($resu)){
                                            ?>
                                            
                                            <option value="<?php echo $row['CourseCode'];?>"><?php echo $row['CourseCode']." - ".$row['CourseName'];?></option>
                                            <?php
                                        } 
                                        ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="paste-new-forms"></div>
                            <button type="button" style="margin-top:10px;margin-left:auto;" onclick="document.location='viewinsert.php'" class="btn btn-primary">View Current Selection</button>
                            <button type="submit" style="margin-top:10px;float:right;margin-right:10px;" name="save_multiple_data" class="btn btn-primary">Submit</button>
                            <button type="button" style="margin-top:10px;margin-right:50%;" class="add-more-form float-end btn btn-primary">ADD MORE</button>
                            
                          </form>
  
    </div>
    
      </div>
      <div id="footer-div">Footer</div>
    </div>
  </body>
</html>
