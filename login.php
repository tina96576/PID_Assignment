<?php

    session_start();

    if(isset($_GET["logout"])){
        unset($_SESSION["name"]);
        unset($_SESSION["mid"]);
        header("location: index.php");
        exit();
    }
    if(isset($_POST["btnOK"])){
        $Name=$_POST["txtUserName"];
        $Password=$_POST["txtPassword"];
        $Password=hash("sha256", $Password);

        //尋找會員資料
        $sql1="select * from member where name='$Name' and pwd='$Password'";
        require("conn.php");
        $result1=mysqli_query($link,$sql1);
        $row1=mysqli_fetch_assoc($result1);

        //尋找管理者資料
        $sql2="select * from manager where mname='$Name' and mpwd='$Password'";
        $result2=mysqli_query($link,$sql2);
        $row2=mysqli_fetch_assoc($result2);
       

        if($Name=$row1['name'] and $Password=$row1['pwd']){
            if($row1['bid']==1){ //判斷是否為停用會員
                echo "<script> {window.alert('該用戶被禁止'); location.href='index.php'} </script>";
            }else{
                $_SESSION["mid"]=$row1["mid"];
                echo "<script> {window.alert('登入成功'); location.href='index.php'} </script>";
                $_SESSION["name"]=$Name;
                exit();  
            }    
        
        }else if($Name=$row2['mname'] and $Password=$row2['mpwd']){ //判斷是否為管理者
            $_SESSION["mid_manger"]=$row2["managerid"];
            $_SESSION["name_manger"]=$Name;
            header("location: manager.php");
            exit();  
        }
        else{
            echo "<script> {window.alert('無會員資料，請註冊'); location.href='sign.php'} </script>";
            exit();
        } 
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>login</title>
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
            <h1>登入</h1>
            <form method="post" action="login.php">
                <div class="form-group">
                    <label>使用者名稱</label>
                    <input type="text" class="form-control" name="txtUserName"  aria-describedby="emailHelp" placeholder="請輸入使用者名稱" required="required">   
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">密碼</label>
                    <input type="password" id="password" class="form-control" name="txtPassword" required="required" placeholder="密碼長度在6-30字元內，至少包含數字大小寫英文字母" required="required" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,30}$">
                    <input type="checkbox" onclick="showpwd()">顯示<br><br>
                </div>

                <div class="row-md-6" >
                    <button type="submit" class="btn btn-default btn-lg" name="btnOK" ><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 登入</button>
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