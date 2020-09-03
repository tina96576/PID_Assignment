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
if(isset($_GET["pid"]) and $smid!="" and $rowm['name']==""){//判斷是否取得產品id及是否有使用者
    $item=$_GET["pid"];
    require("conn.php");
    $sqlStatement_item="SELECT * FROM product where pid=$item";
    $result_item=mysqli_query($link,$sqlStatement_item);
    $row_item=mysqli_fetch_assoc($result_item);
    
}else if($_GET["cartpid"]!=""){//修改購物車
    $cart=$_GET["cartpid"];//產品id
    $quity=$_GET["quity"];//選擇產品數量
    $_SESSION['sncart']=$cart;
    require("conn.php");
    $sqlStatement_item="SELECT * FROM product where pid in (select pid from cart where cartid=$cart)";
    $result_item=mysqli_query($link,$sqlStatement_item);
    $row_item=mysqli_fetch_assoc($result_item);
    

}else{
    echo "<script> {window.alert('請先登入'); location.href='login.php'} </script>";
}



$c=$_POST['buynumber'];//購物車選擇數量
if(isset($_POST["cartok"])){

    if($row_item["cquity"]<$c){
        echo "<script> {window.alert('選擇數目已超過庫存量')} </script>";
    }else{
        $sqlStatement_cart="insert into cart (mid,pid,quantity) values ($smid,$item,$c)";
        require("conn.php");
        mysqli_query($link,$sqlStatement_cart);
        echo "<script> {window.alert('成功加入購物車')} </script>";
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
    <title>Lab</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

    
    <nav class="navbar navbar-default">
        <p style="text-align:right; position: relative; margin:5px; font-size:15px;">Hello! <?= $sname;?> &nbsp &nbsp</p>
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only"></span>
                   
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand">Brand</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                
                <ul class="nav navbar-nav navbar-right">
                    
                    <?php if($sname=="Guest"):?>
                    <a href="login.php" class="btn btn-primary btn-lg" role="button">登入</a>
                    <?php else: ?>
                    <a href="login.php?logout=1" class="btn btn-warning btn-lg" role="button">登出</a>
                    <a href="cart.php" class="btn btn-success btn-lg" role="button">購物車</a>
                    <?php endif; ?>
                    <a href="secret.php" class="btn btn-primary btn-lg" role="button">會員專用頁</a>  
                </ul>
                
                
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    


    <div class="container" >
        <div class="row" >
            <div class="col-sm-2"></div>
            <div class="col-sm-8" >
                <div class="panel panel-success">
                    <div class="panel-heading"><h3 class="panel-title">產品名稱：<?= $row_item["pname"]?></h3></div>
                    <div class="panel-body">
                        <ul class="list-group list-group">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="thumbnail"><img src="<?= $row_item["img"]?>" alt="Lights" width="200px" height="200px"></div>
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
                                        <button type="submit" class="btn btn-default btn-lg" name="cartok" ><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> 加入購物車</button>
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
  
    
</body>
</html>


