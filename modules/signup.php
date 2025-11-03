<?php
session_start();
include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was posted
    $user_name = $_POST['uname'];
    $password = $_POST['psw'];

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
        //save to database
        $user_id = random_bytes(20);
        $query = "insert into users (FID,Username,Password) values ('$FID','$Username','$Password')";
        mysqli_query($con, $query);
        header("Location: login.php");
        die;
    } else {
        echo "Wrong username or password";
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Signup</title>

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
            padding: 30px 0px;

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
            color: #fff;
        }

        #wrapper-div {
            width: 80%;
            margin: auto;
        }

        form {
            border: none;
        }

        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 16px 8px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            background-color: #8ebf42;
            color: white;
            padding: 14px 0;
            margin: 10px 0;
            border: none;
            cursor: grabbing;
            width: 100%;
        }

        h1 {
            text-align: center;
            fone-size: 18;
        }

        button:hover {
            opacity: 0.8;
        }

        .formcontainer {
            text-align: left;
            margin: 24px 50px 12px;
            width: 60%;
            margin: 0px auto;
        }

        .container {
            padding: 16px 0;
            text-align: left;
        }

        span.psw {

            padding-top: 0;
            padding-right: 15px;
            text-align: center
        }

        span.psw a {
            color: #0066CC;
            text-decoration: none
        }

        form .checktext {
            display: flex;
            align-items: center;
        }

        form h3 {
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
                padding-left: 35px;
                padding-top: 10px;
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
                <form action="/action_page.php">
                    <h1>Signup to create an account</h1>
                    <div class="formcontainer">
                        <div class="container">
                            <input type="text" placeholder="Enter Username" name="uname" required>
                            <input type="text" placeholder="Enter Email" name="psw" required>
                            <input type="password" placeholder="Enter Password" name="psw" required>
                            <input type="password" placeholder="Confirm Password" name="psw" required>
                        </div>
                        <div class="checktext">
                            <input type="checkbox">
                            <h3>I accept all terms &amp; condition</h3>
                        </div>
                        <button type="submit">Signup</button>
                        <span class="psw">Already have an account? <a href="login.php">Login now</a></span>




                    </div>
                </form>
            </div>
        </div>
        <div id="footer-div">Footer</div>
    </div>
    </div>
</body>

</html>