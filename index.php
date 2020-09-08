<?php
session_start();

if(isset($_SESSION["name"])){
    $sname=$_SESSION["name"];

}else{
    $sname="Guest"; 
}

require("conn.php");

$sqlStatement="select *  from category";
$result=mysqli_query($link,$sqlStatement);

if(isset($_GET["id"])){
    $a=$_GET["id"];//取產品類值
}else{
    //登入畫面隨機選擇產品類別顯示
    $sqlStatement_nc="select count(*)  from category";
    $result_nc=mysqli_query($link,$sqlStatement_nc);
    $row_nc=mysqli_fetch_assoc($result_nc);
    $a=($row_nc["count(*)"]);
    $a=(rand(1,$a));
}
$sqlStatement_name="SELECT pid,pname,p.categoryid,price,img,descript FROM product as p join category as c on p.categoryid=c.categoryid where p.categoryid=$a";
$result_name=mysqli_query($link,$sqlStatement_name);
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Home</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<link href="css/style.css" rel="stylesheet">
<style>
body{
    background-image: url("./image/cover/background3.jpeg");
    background-repeat:no-repeat;
    background-size:cover;      
}


</style>
</head>
<body>
    <nav class="navbar navbar-default">
        <p style="text-align:right; position: relative; margin:5px; font-size:18px;">Hello! <?= $sname;?> &nbsp &nbsp</p>
        <div class="container-fluid">
            <div class="navbar-header"><a class="navbar-brand">Snack</a></div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <?php if($sname=="Guest"):?>
                        <a href="sign.php" class="btn btn-info btn-lg" role="button">註冊</a>
                        <a href="login.php" class="btn btn-primary btn-lg" role="button">登入</a>    
                        <?php else: ?>
                        <a href="login.php?logout=1" class="btn btn-warning btn-lg" role="button">登出</a>
                        <a href="cart.php" class="btn btn-success btn-lg" role="button">購物車</a>
                        <a href="secret.php" class="btn btn-primary btn-lg" role="button">會員專用頁</a>
                        <?php endif; ?>   
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div id="myCarousel" class="carousel slide" data-ride="carousel" style="width:100% ">
        <!-- Indicators -->
        <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" >
        <div class="item active">
            <img src="./image/cover/cookie.jpeg" alt="Los Angeles" style="width:100%; height:550px;">
        </div>

        <div class="item">
            <img src="./image/cover/candy.jpeg" alt="Chicago" style="width:100%; height:550px;">
        </div>
        
        <div class="item">
            <img src="./image/cover/drink.jpeg" alt="New york" style="width:100%; height:550px;">
        </div>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
        </a>
    </div>
   
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2" id="col1">
                <h3 class="panel-title" style="text-align:center;">產品類別</h3>
                    <ul class="list-group list-group" id="tab1">  
                        <div class="btn-group">
                        <?php while($row=mysqli_fetch_assoc($result)):?>
                            <a href="index.php?id=<?php echo $row["categoryid"] ?>" class="btn1" role="button"><?=$row["cname"];?></a><br><br>
                        <?php endwhile?>  
                        </div>
                    </ul>
            </div>

            <div class="col-sm-10" id="col2">
                    <h3 class="panel-title" style="text-align:center;">產品</h3>
                    <div class="panel-body">
                        <ul class="list-group list-group">
                        <div class="row">
                            <?php while($row_name=mysqli_fetch_assoc($result_name)):?>   
                            <div class="col-md-4">
                                <div class="thumbnail">
                                <a href="product_item.php?pid=<?= $row_name["pid"]?>">
                                    <img src="<?= $row_name["img"]?>" alt="Lights" width="180px" height="180px">
                                    <div class="caption">
                                    <p>名稱:<?= $row_name["pname"]?></p>
                                    <p>價錢:<?= $row_name["price"]?>元</p>
                                    </div>
                                </a>
                                </div>
                            </div>
                            <?php endwhile?>  
                        </div>
                        </ul>
                    </div>
                     
            </div>
        </div>  
    </div>


    <!-- <img src="./image/candy/水果糖.jpg" alt="Girl in a jacket" width="100" height="100"> -->
    
</body>
</html>
