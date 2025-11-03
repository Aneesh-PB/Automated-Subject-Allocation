<?php
session_start();

// Access login data from session
if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
  $password = $_SESSION['password'];
  // Use the username as needed in your web page
} else {
  // User is not logged in, handle accordingly
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Web Page</title>
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

      #nav-div {
        width: 100%;
        min-height: 30px;
        background-color: lightgray;
        text-align: center;
        line-height: 30px;
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
        width: 25%;
        min-height: 400px;
        background-color: lightgray;
        float: left;
        text-align: center;
        line-height: 400px;
      }

      #bodyarea-div {
        width: 75%;
        min-height: 400px;
        background-color: white;
        float: right;
        text-align: center;
		padding:30px 0px;
       
      }

      .clearfix::after {
        content: "";
        display: block;
        clear: both;
      }

      #footer-div {
        width: 100%;
        min-height: 50px;
        background-color: black;
        text-align: center;
        line-height: 50px;
		color:#fff;
      }

      #wrapper-div {
        width: 80%;
        margin: auto;
      }
	   form {
      border: none;
      }
      input[type=text], input[type=password] {
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
      padding: 14px 0;
      margin: 10px 0;
      border: none;
      cursor: grabbing;
      width: 100%;
      }
      h1 {
      text-align:center;
      font-size:18;
      }
      button:hover {
      opacity: 0.8;
      }
      .formcontainer {
      text-align: left;
      margin: 24px 50px 12px;
	  width:60%;
	  margin:0px auto;
      }
      .container {
      padding: 16px 0;
      text-align:left;
      }
      span.psw {
      float: right;
      padding-top: 0;
      padding-right: 15px;
	  text-align:center
      }
	  span.psw a
	  {
	  color:#0066CC;
	  text-decoration:none
	  }
	  form .checktext{
		  display: flex;
		  align-items: center;
		}
	   form h3{
		  color: #707070;
		  font-size: 14px;
		  font-weight: 500;
		  margin-left: 10px;
		}
	  @media only screen and (min-width: 780px) {
	  #sidebar-div {
        width: 30%;
		}
		#bodyarea-div {
        width: 70%;
		}
		span.psw {
      	display: block;
      	float: none;
		padding-left:35px; padding-top:10px;
      	}
		
		
	}
      /* Change styles for span on extra small screens */
      @media screen and (max-width: 300px) {
      span.psw {
      display: block;
      float: none;
      }
	  
	  }
    </style>
</head>
<body>
<div id="wrapper-div">
	<div id="logo-div">Logo</div>

	<div id="nav-div">Navigation</div>

	<div id="header-banner-div">Header/Banner</div>

	<div id="main-div" class="clearfix">
		<div id="sidebar-div">Sidebar</div>
		<div id="bodyarea-div">
						
    <h1>Welcome<br /><br /></h1>
    <p>Username : <?php echo $username; ?></p>
    <p>Password : <?php echo $password; ?></p>
		</div>
	</div>
	<div id="footer-div">Footer</div>
	</div>
</div>
  
</body>
</html>