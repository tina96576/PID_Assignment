<?php
//會員專用頁(購買紀錄)
session_start();

if(!isset($_SESSION["name"])){
    header("location:login.php");
}

if(isset($_SESSION["name"])){
    $sname=$_SESSION["name"];
    $smid=$_SESSION["mid"];//使用者id

}else{
    $sname="Guest"; 
}
//echo "smid".$smid;
require("conn.php");
$sqlStatement_cartlist=<<<sql
SELECT m.mid,name, pname,price, quantity,(price*quantity) as tq,img,btime FROM buy as c JOIN member as m on c.mid=m.mid JOIN product as p on p.pid=c.pid where m.mid=$smid
sql;
$result_cartlist=mysqli_query($link,$sqlStatement_cartlist);
$total=0;

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Snack</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<style>
    
    body{
        background-image: url("./image/cover/background3.jpeg");
        background-repeat:no-repeat;
        background-size:cover;      
    }

    .table th, .table td {
        text-align: center;
        vertical-align: middle!important;
    }
    .table-striped{
        overflow: scroll;
    }

    .navbar-brand{ 
        font-family: Tillana, handwriting;
        font-size: 40px;
        font-weight: bold;
        font-style: oblique;
        padding-top:-10px;
    }

    
</style>
<body>
    <nav class="navbar navbar-default">
        <p style="text-align:right; position: relative; margin:5px; font-size:18px;">Hello! <?= $sname;?> &nbsp &nbsp</p>
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand">Snack</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <?php if($sname=="Guest"):?>
                    <a href="login.php" class="btn btn-primary btn-lg" role="button">登入</a>
                    <?php else: ?>
                    <a href="login.php?logout=1" class="btn btn-warning btn-lg" role="button">登出</a>
                    <?php endif; ?>
                    <a href="index.php" class="btn btn-info btn-lg" role="button">回首頁</a>  
                </ul> 
            </div>
        </div>
    </nav>
    
    <div class="container" >
        <div class="row" >
            <div class="col-sm-1" ></div>
            <div class="col-sm-10" >
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">購買紀錄：</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row-sm-10">
                        <ul class="list-group list-group" >
                            <table class="table table-striped"  >
                            <thead>
                            <tr><th>圖片</th><th>商品名稱</th><th>單價</th><th>數量</th><th>價格</th><th>時間</th>  </tr>
                            </thead>
                            <tbody> 
                            <?php while($row_cartlist=mysqli_fetch_assoc($result_cartlist)):?>
                            <tr>
                                <td><img src="<?= $row_cartlist['img']?>" alt="Lights" width="50px" height="50px"></td>
                                <td><?= $row_cartlist['pname']?></td>
                                <td><?= $row_cartlist['price']?></td>
                                <td><?= $row_cartlist['quantity']?></td>                              
                                <td><?= $row_cartlist['tq']?></td>                              
                                <td><?= $row_cartlist['btime']?></td>
                                <?php $total+=$row_cartlist['tq']?>
                            </tr>
                            <?php endwhile?>
                            </tbody>
                        </table>
                        </ul>
                        </div>
                        <div class="row-sm-2">
                        </div>
                    </div>
                </div>  
            </div>  
        </div>     
    </div>  



</body>
</html>




