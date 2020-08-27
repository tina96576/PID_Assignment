<?php
session_start();

if(isset($_SESSION["name"])){
    $sname=$_SESSION["name"];
   
    //echo $smid;

}else{
    $sname="Guest"; 
}
 

//select category
require("conn.php");
$sqlStatement="select *  from category";
$result=mysqli_query($link,$sqlStatement);


if(isset($_GET["id"])){
    $a=$_GET["id"];//取產品類值
    
}else{

    //not choose page then random category
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
    <title>Lab</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="css/style.css" rel="stylesheet"> -->
    <style>
    .thumbnail:hover{
        transform:scale(1.1,1.1);
    }
   
    

    </style>
</head>
<body>

    
    <nav class="navbar navbar-default">
    <p style="text-align:right; position: relative; margin:5px;">Hello! <?= $sname;?> &nbsp &nbsp</p>
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                   
                   
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
                    <a href="sign.php" class="btn btn-info btn-lg" role="button">註冊</a>
                    <a href="login.php" class="btn btn-primary btn-lg" role="button">登入</a>
                    
                    <?php else: ?>
                    
                    <a href="login.php?logout=1" class="btn btn-warning btn-lg" role="button">登出</a>
                    <a href="cart.php" class="btn btn-success btn-lg" role="button">購物車</a>
                    <a href="secret.php" class="btn btn-primary btn-lg" role="button">會員專用頁</a>
                    <?php endif; ?>
                    
                    
                    
                </ul>
                
                
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    


    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3">

                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">產品類別</h3>
                    </div>
                    <div class="panel-body">

                        <ul class="list-group list-group">
                            
                            <?php while($row=mysqli_fetch_assoc($result)):?>
                            <li class="list-group-item"><a href="index.php?id=<?php echo $row["categoryid"] ?>" ><?=$row["cname"];?></a></li>
                            <?php endwhile?>
                            
                            
                        </ul>

                    </div>
                </div>  
                  
            </div>

            <div class="col-sm-9">

                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">產品</h3>
                    </div>
                    <div class="panel-body">

                        <ul class="list-group list-group">
                        <div class="row">

                            <?php while($row_name=mysqli_fetch_assoc($result_name)):?>   
                            
                            <div class="col-md-4">
                                <div class="thumbnail">
                                <a href="product_item.php?pid=<?= $row_name["pid"]?>">
                                
                                    <img src="<?= $row_name["img"]?>" alt="Lights" width="100px" height="100px">

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
  
</div>


        </div>
    </div>



    <!-- <div class="container">
        <div class="bs-callout bs-callout-danger">
            <h4>Cross-browser compatibility</h4>
            <p>Avoid using <code>&lt;select&gt;</code> elements here as they cannot be fully styled in WebKit browsers.</p>
        </div>
    </div> -->


    <!-- <img src="./image/candy/水果糖.jpg" alt="Girl in a jacket" width="100" height="100"> -->
    
</body>
</html>
