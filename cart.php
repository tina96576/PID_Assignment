<?php
session_start();

if(isset($_SESSION["name"])){
    $sname=$_SESSION["name"];
    $smid=$_SESSION["mid"];//使用者id

}else{
    $sname="Guest"; 
}

require("conn.php");
$sqlStatement_cartlist=<<<sql
    SELECT p.pid,cartid,m.mid,name, pname,price, quantity,(price*quantity) as tq,img,ctime FROM cart as c JOIN member as m on c.mid=m.mid JOIN product as p on p.pid=c.pid where m.mid=$smid
sql;

$result_cartlist=mysqli_query($link,$sqlStatement_cartlist);
$total=0;




if(isset($_GET['buyid'])){
    buy();
}

function buy(){//結帳
    require("conn.php");
    $sqlStatement="select * from cart";
    $result=mysqli_query($link,$sqlStatement);
    while($row=mysqli_fetch_assoc($result)){
        
        $cid=$row['cartid'];//購物車id
        $mid=$row['mid']; //會員id
        $pid=$row['pid']; //產品id
        $quantity=$row['quantity']; //購買數量
        
        $sqlStatement_updateq="UPDATE product SET  cquity=cquity-$quantity where pid=$pid";//更新庫存量
        mysqli_query($link,$sqlStatement_updateq);
        $sqlStatement_insert="insert into buy (mid,pid,quantity) values ($mid, $pid,$quantity)";//加入已購買清單
        mysqli_query($link,$sqlStatement_insert);
    }
    $sqlStatement_empty="truncate table cart";
    mysqli_query($link,$sqlStatement_empty);
    header("location:cart.php");
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lab</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
 
</head>
<style>
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

    body{
        background-image: url("./image/cover/background3.jpeg");
        background-repeat:no-repeat;
        background-size:cover;      
    }
    
</style>
<body>
    <nav class="navbar navbar-default">
        <p style="text-align:right; position: relative; margin:5px;">Hello! <?= $sname;?> &nbsp &nbsp</p>
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand">Snack</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> 
                <ul class="nav navbar-nav navbar-right">
                    <?php if($sname=="Guest"):?>
                    <a href="login.php" class="btn btn-primary btn-lg" role="button">登入</a>
                    <?php else: ?>
                    <a href="login.php?logout=1" class="btn btn-warning btn-lg" role="button">登出</a>
                    <?php endif; ?>
                    <a href="index.php" class="btn btn-info btn-lg" role="button">繼續購物</a>
                    <a href="secret.php" class="btn btn-primary btn-lg" role="button">會員專用頁</a>   
                </ul> 
            </div>
        </div>
    </nav> 
    <div class="container" >
        <div class="row" >
            <div class="col-sm-1" ></div>
            <div class="col-sm-10" >
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">購物車清單：</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row-sm-10">
                        <ul class="list-group list-group" >
                            <table class="table table-striped">
                            <thead>
                            <tr>  
                                <th>圖片</th><th>商品名稱</th><th>單價</th><th>數量</th><th>價格</th><th>時間</th><th>&nbsp</th>
                            </tr>
                            </thead>
                            <tbody> 
                            <?php while($row_cartlist=mysqli_fetch_assoc($result_cartlist)):?>
                            <tr>
                                <td><img src="<?= $row_cartlist['img']?>" alt="Lights" width="50px" height="50px"></td>
                                <td><?= $row_cartlist['pname']?></td>
                                <td><?= $row_cartlist['price']?></td>
                                <td><?= $row_cartlist['quantity']?></td>                              
                                <td><?= $row_cartlist['tq']?></td>                              
                                <td><?= $row_cartlist['ctime']?></td>
                                <?php $total+=$row_cartlist['tq']?>
                                <td>
                                <span class="pull-right">
                                    <!-- 修改 -->
                                    <a href="product_item.php?cartpid=<?= $row_cartlist["cartid"]?>&quity=<?= $row_cartlist["quantity"]?>"> 
                                    <button class="btn btn btn-xs editItem">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true">
                                    </span>
                                    </a>
                                    </button>&nbsp;
                                    <a href="./delete.php?cartid=<?= $row_cartlist["cartid"]?>">
                                    <button class="btn btn-danger btn-xs deleteItem">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true">
                                    </span>
                                    </button>
                                    </a>  
                                </span>                          
                                </td>
                            </tr>
                            <?php endwhile?>
                            
                            </tbody>
                        </table>
                        </ul>
                        </div>
                        <div class="row-sm-2">
                        <hr><h4 style="text-align:right;">總共：$ <?=$total?>元</h4><br>
                        <a href="cart.php?buyid=1" class="btn btn-danger btn-lg" role="button" name="buyok" style="float:right">結帳</a>
                        </div>
                    </div>
                </div>  
            </div> 
        </div>     
    </div>                          
</body>
</html>




