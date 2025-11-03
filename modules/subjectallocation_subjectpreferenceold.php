<?php
include("config.php");
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

      <div id="header-banner-div"><h2>Subject Selection</h2></div>

      <div id="main-div" class="clearfix">
        <div id="sidebar-div"> 
        <!-- <button onclick="document.location='flolad1.php'">Subject Allocation</button>
        <button onclick="document.location='fload.php'">Edit Allocation</button>
        <button onclick="document.location='currallo.php'">Current Allocation</button> -->
        </div>
        
        <div id="bodyarea-div" class="card-body">
        <div>
                        
                        <h4 style="text-align:left;">Faculty Name:</h4>
                        <br>
                    </div>
        

<form action="subjectallocation_subjectpreference_insert.php" method="POST">

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
    <div class="main-form mt-3 border-bottom">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group mb-2">
                    <label for="subcount" id="subjectcount">Subject 2</label>
                    </div>
            </div>
            <div class="col-md-4">
                <div class="form-group mb-2">
                    
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

            <!-- <div class="col-md-4">
                <div class="form-group mb-2">
                    <button type="button" class="remove-btn btn btn-danger">Remove</button>
                </div>
            </div> -->
        </div>
    </div>

    <div class="paste-new-forms"></div>
    <button type="button" style="margin-top:10px;margin-left:auto;" onclick="document.location='subjectallocation_subjectpreference_viewinsert.php'" class="btn btn-primary">View Current Selection</button>
    <button type="submit" style="margin-top:10px;float:right;margin-right:10px;" name="save_multiple_data" class="btn btn-primary">Submit</button>
    <button type="button" style="margin-top:10px;margin-right:50%;" class="add-more-form float-end btn btn-primary">ADD MORE</button>
    
  </form>

</div>

        </div>

      </div>
      <div id="footer-div">Footer</div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        var i=1;
        
        $(document).ready(function () {

            $(document).on('click', '.remove-btn', function () {
                $(this).closest('.main-form').remove();
                i--;
                var subjectcount="Subject"+ i;
                document.getElementById(subjectcount).innerHTML='Subject '+i;

            });
            
            $(document).on('click', '.add-more-form', function () {
                var subjectcount="Subject"+ ++i;
                $('.paste-new-forms').append(`<div class="main-form mt-3 border-bottom">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <label for="subcount" id="subjectcount">Subject ` +i +`</label>
                                            </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            
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
            
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <button type="button" class="remove-btn btn btn-danger">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>`);
            });
        
        });
        $(document).ready(function() {
            $('#subcount').text("Subject "+ ++i);
        //document.getElementById("subcount").innerHTML="Subject "+ ++i;
        });
    </script>
    </body>
</html>