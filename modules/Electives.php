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
        font-size:16px
      }


      #main-div {
        width: 100%;
        margin-bottom: 10px;
      }
      
      .clearfix::after {
        content: "";
        display: block;
        clear: both;
      }

      

      #wrapper-div {
        width: 80%;
        margin: auto;
      }
	 
      input[type=text]{
      width: 100%;
      padding: 16px 8px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
      }
      input[type=submit] {
      background-color: #8ebf42;
      color: white;
      padding: 5px 20px;
      margin: 10px 0;
      border: none;
       
      }
      select{
      width:80%;
      padding:5px;
      }
      h1 {
      text-align:center;
      font-size:18;
      }
      button:hover {
      opacity: 0.8;
      }
       .container {
            display: flex;
        }
        
        .column {
            flex: 1;
            padding: 20px;
           
        }
       
      
    </style>
  </head>
<body>
<div id="wrapper-div">	
	<div id="main-div" class="clearfix">  
        <form action="" method="POST">
            <div class="container">
                <div class="column">
                    <label for="Program">Choose a Program:</label>
                    <select id="Program">
                        <option value="IT">IT</option>
                        <option value="CS">CS</option>
                        <option value="AD">AD</option>
                    </select>                    
                </div>
                <div class="column">
                    <label for="Semester">Choose Semester:</label>
                    <select id="Semester">
                        <option value="sem1">Semester 1</option>
                        <option value="sem2">Semester 2</option>
                        <option value="sem3">Semester 3</option>
                        <option value="sem4">Semester 4</option>
                        <option value="sem5">Semester 5</option>
                        <option value="sem6">Semester 6</option>
                      </select>
                </div>
                <div class="column">
                    <label for="Elective">Choose Elective:</label>
                    <select id="Elective">
                        <option value="elective1">Elective 1</option>
                        <option value="elective2">Elective 2</option>
                        <option value="elective3">Elective 3</option>
                        <option value="elective4">Elective 4</option>
                        <option value="elective5">Elective 5</option>
                        <option value="elective6">Elective 6</option>
                      </select>
                </div> 
                <input type="submit" name= "submit"> 
            </div>
          </form>
        <div>
        <table>
        
        <tbody>
<?php

if(isset($_POST['submit'])) {
  $result = mysqli_query($conn, "SELECT * FROM elective;");
 

  // Display the fetched data in an HTML table
  if(mysqli_num_rows($result) > 0) {
    ?>
    <table border="black" >
    <tr style=" padding: 15px;"><th style=" padding: 15px;">Elective No</th><th style=" padding: 15px;">Course Code</th><th>Course Name</th></tr>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
      ?>
      <tr style=" padding: 15px;">
      <td style=" padding: 15px;">  <?php echo $row['elective no']; ?></td>
      <td style=" padding: 15px;">  <?php echo $row['Course Code']; ?></td>
      <td style=" padding: 15px;">  <?php echo $row['Name']; ?></td>
      </tr>
   <?php } ?>
    </table>
    <?php } ?>
  <?php 
  // else { echo 'No data found.'; } ?>

 
<?php }
?>
            </tbody>
            </table>
        </div>      
        
		
	</div>
	</div>
</div>
</body>
</html>
