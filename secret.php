<?php

session_start();

if(!isset($_SESSION["name"])){
    header("location:login.php");
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>login_system</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<!-- css -->
<link rel="stylesheet" href="style.css">

<body>

    <div class="third">
        <h1>會員系統 － 會員專用</h1>
        <p>This page for member only.</p>

        <div class="wrapper-div" id="buttonitem1">
            <button type="button" class="btn btn-default btn-lg" > 
                <a href="index.php" class="glyphicon glyphicon-home" style="text-decoration:none;" aria-hidden="true">回首頁</a>
            </button>  
        </div>
       
        

    </div>




</body>


</html>