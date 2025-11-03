<?php
session_start();

// Retrieve submitted form data
$username = $_POST['username'];
$password = $_POST['password'];

// Validate login data
// ... (perform validation logic here)

// Store login data in session
$_SESSION['username'] = $username;
$_SESSION['password'] = $password;

// Redirect to the web page
header('Location: web_page.php');
exit();
?>