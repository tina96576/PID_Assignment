<?php

    session_start();
    require("conn.php");
    if(isset($_GET["logout"])){
        unset($_SESSION["name"]);
        header("location: index.php");
        exit();
    }

    if(isset($_POST["btnOK"])){
        $Name=$_POST["txtUserName"];
        $Password=$_POST["txtPassword"];
        $Password=hash("sha256", $Password);
        $Email=$_POST["txtEmail"];
  
        //尋找會員資料
        $sql2="select * from member where email='$Email'";
        $result2=mysqli_query($link,$sql2);
        $row2=mysqli_fetch_assoc($result2);

        if($row2["email"]==$Email){
            echo "<script> {window.alert('已註冊，請重新登入'); location.href='login.php'} </script>";
            
        }else{
            $sql="insert into member(name,pwd,email)values('$Name','$Password','$Email')";       
            mysqli_query($link,$sql);
            echo "<script> {window.alert('註冊成功，請重新登入'); location.href='login.php'} </script>";
        }  
    }  
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>sign</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="css/style1.css" rel="stylesheet">
</head>

<style type="text/css">
  
  html,body{
      height:100%;
  }
  body{
    background-image: url("./image/cover/background3.jpeg");
    background-repeat:no-repeat;
    background-size:cover;      
    background-attachment:fixed;
    display:flex;
    justify-content:center;
    align-items:center; 
   
  }
  </style>

<body>
    <div class="row">
        <div class="login"> 
                <div class="col-sm-8" id="col5">
                    <h2>會員註冊</h2>
                    <form class="form-inline" method="post" role="form">
                        <div class="group">
                            <label for="user_id">使用者名稱:</label>
                            <input type="text" class="form-control" name="txtUserName" id="user_id" placeholder="請輸入帳號" required="required">
                        </div>
                        <div class="group">
                            <label for="user_password">密碼:</label>
                            <input type="password" class="form-control" id="password" name="txtPassword" required="required" placeholder="密碼長度在6-30字元內，至少包含數字大小寫英文字母" required="required" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,30}$">
                            <br>
                            <input type="checkbox" onclick="showpwd()">
                            <label for="password_show">顯示</label>
                        </div>
                        <div class="group">
                            <label for="Email">信箱:</label>
                            <input type="email" class="form-control" name="txtEmail"   placeholder="請輸入信箱" required="required"  pattern="/^([\w\.\-]){1,64}\@([\w\.\-]){1,64}$/"/>
                        </div>
                        <div class="btn-group">
                            <button type="submit" class="btn" name="btnOK" ><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 註冊</button>
                        </div>  
                        <div class="btn-group">
                            <button type="button" class="btn" > <a href="index.php" class="glyphicon glyphicon-home" style="text-decoration:none; color:white;" >回首頁</a></button>   
                        </div> 

                    </form>
                </div>
        </div>
    </div>
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        function showpwd() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>
</html>