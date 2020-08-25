<?php
session_start();

if(isset($_SESSION["name"])){
    $sname=$_SESSION["name"];
    $smid=$_SESSION["mid"];//使用者id

}else{
    $sname="Guest"; 
}
//echo "smid".$smid;
require("conn.php");
$sqlStatement_cartlist=<<<sql
SELECT m.mid,name, pname, quantity,(price*quantity) as tq,img FROM cart as c JOIN member as m on c.mid=m.mid JOIN product as p on p.pid=c.pid where m.mid=$smid
sql;

$result_cartlist=mysqli_query($link,$sqlStatement_cartlist);

while($row_cartlist=mysqli_fetch_assoc($result_cartlist)){

    //echo $row_cartlist["tq"]."<br>";
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
        <p style="text-align:right; position: relative; margin:5px;">Hello! <?= $sname;?> &nbsp &nbsp</p>
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">aa</span>
                   
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand">Brand</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                
                <form class="navbar-form navbar-left">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>

                
                <ul class="nav navbar-nav navbar-right">
                    
                    <?php if($sname=="Guest"):?>
                    <a href="login.php" class="btn btn-primary btn-lg" role="button">登入</a>
                    <?php else: ?>
                    <a href="login.php?logout=1" class="btn btn-warning btn-lg" role="button">登出</a>
                    <?php endif; ?>
                    <a href="secret.php" class="btn btn-primary btn-lg" role="button">會員專用頁</a>
                    
                </ul>
                
                
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    

    
    <div class="container" >
        <div class="row" >
        
            
            <div class="col-sm-12" >
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">購物車清單：</h3>
                    </div>
                    <div class="panel-body">

                        <ul class="list-group list-group">
 
                            <table class="table table-striped">
                            <thead>
                            <tr> 
                                <th>圖片</th>
                                <th>商品名稱</th>
                                <th>數量</th>
                                <th>價格</th>
                                <th>&nbsp</th>
                            </tr>
                            </thead>
                            <tbody>
                           
                            <tr>
                                <td>John</td>
                                <td>Doe</td>
                                <td>john@example.com</td>
                                <td>john@example.com</td>
                                <td>&nbsp
                                
                                <span class="float-right">
                                <a href="#" class="btn btn-success btn-sm" role="button">修改</a>|
                                <a href="#" class="btn btn-danger btn-sm" role="button">刪除</a>
                                
                                </span>
                                
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        </ul>

                    </div>
                </div>  
               
        
            </div>
            

            
        </div>
            
    </div>  
  
    
</body>
</html>


