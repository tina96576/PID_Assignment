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
        $sql2="select * from member where email='$Email' and pwd=$Password and name=$Name";
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
</head>

<body>
    <div class="container">
        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h1>註冊</h1>
            <form method="post" action="sign.php">
                <div class="form-group">
                    <label >使用者名稱</label>
                    <input type="text" class="form-control" name="txtUserName"  aria-describedby="emailHelp" placeholder="Enter your name" required="required">    
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">密碼</label>
                    <input type="password" id="password" class="form-control" name="txtPassword" placeholder="密碼長度在6-30字元內，至少包含數字大小寫英文字母" required="required" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,30}$">
                    <input type="checkbox" onclick="showpwd()">顯示<br><br>
                </div>
                <div class="form-group">
                    <label for="Email">Email</label>
                    <input type="text" class="form-control" name="txtEmail" placeholder="請輸入信箱" required="required"  pattern="/^([\w\.\-]){1,64}\@([\w\.\-]){1,64}$/">
                </div>
                <div class="row-md-6" >
                    <button type="submit" class="btn btn-default btn-lg" name="btnOK" ><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 註冊</button>
                    <button type="reset" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> 取消</button>
                    <button type="button" class="btn btn-default btn-lg" > <a href="index.php" class="glyphicon glyphicon-home" style="text-decoration:none;" aria-hidden="true">回首頁</a></button>  
                </div>   
            </form>
        </div>
        <div class="col-md-3"></div>
        </div>
    </div>
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        function showpwd() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            }else {
                x.type = "password";
            }
        }
    </script>
    
</body>
</html>