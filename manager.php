<?php
session_start();
require("conn.php");
//管理者帳號：cat 密碼：catC123

if(isset($_SESSION["name_manger"])){
    $sname=$_SESSION["name_manger"];  
    //echo $smid;
}else{
    $sname="Guest"; 
}


if(isset($_GET['id'])){
    //列出會員資料
    $mem=array("會員","編號","姓名","信箱","購買項目","權限");
    $sqlStatement="SELECT * FROM member";
    $result_mem=mysqli_query($link,$sqlStatement);
}else{
    //列出所有產品
    $mem=array("產品清單","編號","圖片","產品名稱","類別","定價","庫存量","介紹");
    $sqlStatement="SELECT pid,cname,pname,p.categoryid,price,img,descript,cquity,cname FROM product as p join category as c where p.categoryid=c.categoryid";
    $result_mem=mysqli_query($link,$sqlStatement);
}


if(isset($_GET["noban"])){  //解除封鎖
    $mid=$_GET["noban"];
    $sql="delete from banner where cartid=$mid";
    require("conn.php");
    mysqli_query($link,$sql);

    $sql="UPDATE member SET bid=0 where mid=$mid";
    require("conn.php");
    mysqli_query($link,$sql);
    echo "<script> {window.alert('該用戶已啟用'); location.href='manager.php?id=1'} </script>";
}

if(isset($_GET["ban"])){  //封鎖
    $mid=$_GET["ban"];
    $sql="INSERT INTO banner (mid) VALUES ($mid)";
    require("conn.php");
    mysqli_query($link,$sql);

    $sql="UPDATE member SET bid=1 where mid=$mid";
    require("conn.php");
    mysqli_query($link,$sql);
    echo "<script> {window.alert('該用戶已停用'); location.href='manager.php?id=1'} </script>";
}

$b="<script>cname;</script>";

echo $b;

?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lab</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<style>

.table-striped{
    overflow: scroll;
}

</style>
<body>
    
    <nav class="navbar navbar-default">
    <p style="text-align:right; position: relative; margin:5px;">Hello! <?= $sname;?> &nbsp &nbsp</p>
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" >管理頁</a>
                <ul class="nav navbar-nav">
                <li class="active"></li>
  
                <li class="active"><a href="manager.php?id=1">會員管理</a></li>
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">商品管理 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                    <li><a href="manager.php">商品清單</a></li>
                    <li><a href="add_product.php">新增產品</a></li>
                    <li><a data-target="#myModal" data-toggle="modal">新增產品類別</a></li>
                    </ul>
                </li>
                </ul>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                <a href="login.php?logout=1" class="btn btn-warning btn-lg" role="button">登出</a>
                </ul> 
            </div>
        </div>
    </nav>

    <div class="container">
        <div>
            <div>
                <div class="panel panel-info">
                    <div class="panel-heading"><h3 class="panel-title"><?= $mem[0]?></h3></div>
                    <div class="panel-body"  >
                        <ul class="list-group list-group">
                            <li class="list-group-item">
                            <table class="table table-striped" >
                            <thead>
                            <tr>  
                                <?php for($i=1;$i<count($mem);$i++):?>
                                <th><?= $mem[$i]?></th>
                                <?php  endfor?>
                                <th>&nbsp</th>
                            </tr>
                            </thead>
                            <tbody> 
                            <?php while($row_cartlist=mysqli_fetch_assoc($result_mem)):?>
                            <tr> 
                                <?php if(!isset($row_cartlist['email'])):?>
                                    <!-- 列出產品 -->
                                    <td><?= $row_cartlist['pid']?></td> 
                                    <td><?= $row_cartlist['cname']?></td>
                                    <td><img src="<?= $row_cartlist["img"]?>" alt="Lights" width="100px" height="100px"></td>                                  
                                    <td><?= $row_cartlist['pname']?></td> 
                                    <td><?= $row_cartlist['price']?></td>
                                    <td><?= $row_cartlist['cquity']?></td>
                                    <td><?= $row_cartlist['descript']?></td>
                                    <td>
                                    <span class="pull-right">
                                    <a href="manger_modify.php?pid=<?= $row_cartlist['pid']?>"><button class="btn btn btn-xs editItem"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></a>
                                    <a href="./delete_product.php?pid=<?= $row_cartlist["pid"]?>&pimg=<?= $row_cartlist["img"]?>"><button class="btn btn-danger btn-xs deleteItem"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></a>
                                    </span>
                                    </td>
                                    
                                 <?php else:?>
                                    <!-- 會員資料 -->
                                    <td><?= $row_cartlist['mid']?></td> 
                                    <td><?= $row_cartlist['name']?></td>
                                    <td><?= $row_cartlist['email']?></td>
                                    <td><a href="manager_member.php?memberid=<?=$row_cartlist['mid']?>" class=" btn btn-primary btn-sm" role="button" aria-pressed="true">購買清單</a></td> 
                                    <?php if($row_cartlist['bid']==1):?>
                                        <td><a href="manager.php?id=1&noban=<?=$row_cartlist['mid']?>" class="btn btn-danger btn-sm " role="button" aria-pressed="true">封鎖</a></td>
                                        <?php elseif($row_cartlist['bid']==0):?>
                                        <td><a href="manager.php?id=1&ban=<?=$row_cartlist['mid']?>" class="btn btn-success btn-sm " role="button" aria-pressed="true">正常</a></td>
                                    <?php endif;?>
                                    <td></td>   
                                <?php endif?>   
                            </tr>
                            <?php endwhile?>
                            </tbody>
                            </table>
                            </li>  
                        </ul>
                    </div>
                </div>
            </div>   
        </div>
    </div>

    <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">新增類別</h4>
        </div>
        <div class="modal-body">
        <input type="text" class="form-control" name="cname" id="cname" placeholder="請輸入新類別" required="required"> 
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="send" data-dismiss="modal">OK</button>
            <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<div id="show"></div>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.toast.js"></script>

<script>
    $(function () {
        $("#myModal").click(function () {
            $("#cname").val("");
        })

        $("#send").click(function(){
            $("#myModal").modal("hide");
            var cname=$("#cname").val();
            $("#show").html(cname);
        });

        $("#close").click(function(){
            $("#myModal").modal("hide");
        })
    });
</script>
 
    
</body>
</html>

