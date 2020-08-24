<?php

    session_start();

    if(isset($_GET["logout"])){
        unset($_SESSION["name"]);
        header("location: index.php");
        exit();
    }

    if(isset($_POST["btnOK"])){
        $Name=$_POST["txtUserName"];
        $Password=$_POST["txtPassword"];
        $Email=$_POST["txtEmail"];
        

        $_SESSION["name"]=$Name;
  
        //echo $Name,$Password;
        $sql="insert into member(name,pwd,email)values('$Name','$Password','$Email')";       
        //var_dump($sql);
    
        require("conn.php");
        mysqli_query($link,$sql);
        header("location: index.php");

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
<link rel="stylesheet" href="style1.css">


<body>

    
    <div class="second">

        <h1>Sign in</h1>

        <form method="post" action="sign.php">
            <div class="form-group">
                <label >Name</label>
                <input type="text" class="form-control" name="txtUserName"  aria-describedby="emailHelp" placeholder="Enter your name" required="required">
                
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="txtPassword" placeholder="Enter password" required="required">
            </div>

            <div class="form-group">
                <label for="Email">Email</label>
                <input type="text" class="form-control" name="txtEmail" placeholder="Enter Email" required="required">
            </div>

            <div class="row" >
                
                <button type="submit" class="btn btn-default btn-lg" name="btnOK" >
                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 註冊
                </button>

                
                
    
                <button type="reset" class="btn btn-default btn-lg">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> 取消
                </button>
    
    
                <button type="button" class="btn btn-default btn-lg" > 
                    <a href="index.php" class="glyphicon glyphicon-home" style="text-decoration:none;" aria-hidden="true">回首頁</a>
                </button>  
                
            </div>
            
            
        </form>
        
       
    
    
    </div>
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.toast.js"></script>
    <script>
        
    </script>
</body>

</html>