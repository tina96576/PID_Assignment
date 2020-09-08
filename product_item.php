<?php

//1.觀看產品內容 2.修改購物車產品數量
session_start();

if(isset($_SESSION["name"])){
    $sname=$_SESSION["name"];
    $smid=$_SESSION["mid"];//使用者id
}else{
    $sname="Guest"; 
}

$sqlm="select * from manager where mname='$Name'";
$resultm=mysqli_query($link,$sqlm);
$rowm=mysqli_fetch_assoc($resultm);


//尋找產品id
$item=$_GET["pid"];
require("conn.php");
$sqlStatement_item="SELECT * FROM product where pid=$item";
$result_item=mysqli_query($link,$sqlStatement_item);
$row_item=mysqli_fetch_assoc($result_item);
    
if($_GET["cartpid"]!=""){//修改購物車
    $cart=$_GET["cartpid"];//產品id
    $quity=$_GET["quity"];//選擇產品數量
    $_SESSION['sncart']=$cart;
    require("conn.php");
    $sqlStatement_item="SELECT * FROM product where pid in (select pid from cart where cartid=$cart)";
    $result_item=mysqli_query($link,$sqlStatement_item);
    $row_item=mysqli_fetch_assoc($result_item);
}


$c=$_POST['buynumber'];//購物車選擇數量
if(isset($_POST["cartok"])){

    if( $smid!=""){//判斷是否有使用者
        if($row_item["cquity"]<$c){
            echo "<script> {window.alert('選擇數目已超過庫存量')} </script>";
        }else{
            $sqlStatement_cart="insert into cart (mid,pid,quantity) values ($smid,$item,$c)";
            require("conn.php");
            mysqli_query($link,$sqlStatement_cart);
            echo "<script> {window.alert('成功加入購物車')} </script>";
        }
    }else{
        echo "<script> {window.alert('請先登入'); location.href='login.php'} </script>";
    }
    
}

if(isset($_POST['mod'])){
    $cart= $_SESSION['sncart'];
    $sql="UPDATE cart SET quantity=$c where cartid=$cart";
    mysqli_query($link,$sql);
    header("location:cart.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Snack</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<style>

    body{
        background-image: url("./image/cover/background3.jpeg");
        background-repeat:no-repeat;
        background-size:cover;          
    }

    .navbar-brand{
        
        font-family: Tillana, handwriting;
        font-size: 40px;
        font-weight: bold;
        font-style: oblique;
        padding-top:-10px;
    }

    .product{
        margin-top:30px;
        width:810px;
        height:400px;
        border-radius: 20px;
        border:2px solid gray;
        background-color:white;
    }

    .product .panel-title{
        padding:30px;
        font-size:25px;
        text-align:center;

    }

    img {
        height: 250px;
        width: 250px;
        margin-top:-20px;
        margin-left:60px;
        padding:10px;
        border:1px solid lightgray;
        -webkit-transition: all .3s ease-in; 
    }

    .fullSize {
        transform: scale(1.8,1.8);
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
                    <a href="cart.php" class="btn btn-success btn-lg" role="button">購物車</a>
                    <a href="secret.php" class="btn btn-primary btn-lg" role="button">會員專用頁</a>  
                    <?php endif; ?> 
                </ul>
            </div>
        </div>
    </nav>
    

    <div class="container" >
        <div class="row" >
            <div class="col-sm-2"></div>
            <div class="col-sm-8" >
                <div class="product">
                    <div class="panel-heading"><h3 class="panel-title">產品名稱：<?= $row_item["pname"]?></h3></div>
                    <div class="panel-body">
                        <ul class="list-group list-group">
                        <div class="row">
                            <div class="col-md-6">
                                
                                <img id="imgtab" src="<?= $row_item["img"]?>" alt="Lights">
                                 
                            </div>
                            <div class="col-md-6">
                                <form method="post" action="product_item.php?pid=<?= $item?>">
                                    <h4><?= $row_item["descript"]?></h4>
                                    <p>庫存量：<?= $row_item["cquity"]?></p>
                                    <p>定價：<?= $row_item["price"]?></p>

                                    <div class="rol-md-6">
                                    <?php if(isset($_GET["cartpid"])):?>
                                        <!-- 修改購物車數量 -->
                                        <p>購買數量：<input id="buynumber" name="buynumber" type="number" value=<?=$quity?> min="1"  max="9999"></p><br><br><br>
                                        <button type="submit" class="btn btn-success btn-lg" id="mod" name="mod">確認</button>
                                        <a href="cart.php" class="btn btn-primary btn-lg" role="button">返回</a>
                                    <?php else:?>
                                        <!-- 是否加入購物車 -->
                                        <p>購買數量：<input id="buynumber" name="buynumber" type="number" value="1" min="1"  max="9999"></p><br><br><br>
                                        <button type="submit" class="btn btn-default btn-lg" name="cartok" ><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true" style="color:black"></span> 加入購物車</button>
                                            <a href="index.php" class="btn btn-primary btn-lg" role="button">返回</a>
                                    <?php endif?>
                                    </div>
                                </form>  
                            </div>
                        </div>
                        </ul>
                    </div>
                </div>  
            </div>
            <div class="col-sm-2" >  
        </div>       
    </div>  
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
       
       $('#imgtab').on('click', function(e) {
            $(this).toggleClass('fullSize');
        });


    </script>
</body>
</html>


