<?php  
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    
   
</head>
<body id="adminquestion">
<div id="header">

<!-----To show the total list to teh student-------->
    <ul id="headerlist">
        <li class="listoption"><a href="indexstudent.php">Home</a></li>
        <li class="listoption"><a href="checkquiz.php">Take Quiz</a></li>
        <li class="listoption"><a>Contact Us</a></li>
        <li class="listoption"><a  href="usersetting.php?change=1">Change Password</a></li>
        <li class="listoption"><a href="../login.php">Log out</a></li>
        <li class="listoption"><a href="usersetting.php?delete=1">Delete Account</a></li>
    </ul>
</div>