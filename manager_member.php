
<?php
session_start();
require("conn.php");
if(isset($_SESSION["name_manger"])){
    $sname=$_SESSION["name_manger"];
    $smid=$_SESSION["mid_manger"];//使用者id
}else{
    $sname="Guest"; 
}
//echo "smid".$smid;

if(isset($_GET["memberid"])){
    $smid=$_GET["memberid"];

    $sql_cartlist="SELECT m.mid,name, pname,price, quantity,(price*quantity) as tq,img,btime FROM buy as c JOIN member as m on c.mid=m.mid JOIN product as p on p.pid=c.pid where m.mid=$smid";
    $result_cartlist=mysqli_query($link,$sql_cartlist);
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
<style>
    .table th, .table td {
        text-align: center;
        vertical-align: middle!important;
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
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand">Brand</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav navbar-right">                   
                    <a href="login.php?logout=1" class="btn btn-warning btn-lg" role="button">登出</a>
                    <a href="manager.php?id=1" class="btn btn-info btn-lg" role="button">回上頁</a>  
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
                        <h3 class="panel-title"><?=$row_cartlist['name']?> 交易紀錄：</h3>
                    </div>
                    
                    <div class="panel-body">
                        <div class="row-sm-10">
                        <ul class="list-group list-group" >
 
                            <table class="table table-striped"  >
                            <thead>
                            <tr><th>圖片</th><th>商品名稱</th><th>單價</th> <th>數量</th><th>價格</th><th>時間</th><th>&nbsp</th></tr>
                            </thead>
                            <tbody> 
                            
   
                            <?php while($row_cartlist=mysqli_fetch_assoc($result_cartlist)):?>
                            <tr>
                                <td><img src="<?= $row_cartlist["img"]?>" alt="Lights" width="50px" height="50px"></td>
                                <td><?= $row_cartlist["pname"]?></td>
                                <td><?= $row_cartlist['price']?></td>
                                <td><?= $row_cartlist["quantity"]?></td>                              
                                <td><?= $row_cartlist["tq"]?></td>                              
                                <td><?= $row_cartlist["btime"]?></td> 
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






