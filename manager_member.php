
<?php
session_start();

if(isset($_SESSION["name"])){
    $sname=$_SESSION["name"];
    $smid=$_SESSION["mid"];//使用者id

}else{
    $sname="Guest"; 
}
//echo "smid".$smid;

if(isset($_GET["mid"])){
    $smid=$_GET["mid"];
    require("conn.php");
$sqlStatement_cartlist=<<<sql
SELECT m.mid,name, pname,price, quantity,(price*quantity) as tq,img,btime FROM buy as c JOIN member as m on c.mid=m.mid JOIN product as p on p.pid=c.pid where m.mid=$smid
sql;

$result_cartlist=mysqli_query($link,$sqlStatement_cartlist);
$row_cartlist=mysqli_fetch_assoc($result_cartlist);
}  


// while($row_cartlist=mysqli_fetch_assoc($result_cartlist)){

//     echo $row_cartlist["tq"]."<br>";
// }



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
    
</style>
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

                
                <ul class="nav navbar-nav navbar-right">
                    
                    
                    <a href="login.php?logout=1" class="btn btn-warning btn-lg" role="button">登出</a>
                    
                    <a href="manager.php?" class="btn btn-info btn-lg" role="button">回管理頁</a>
                    
                    
                    
                    
                    
                </ul>
                
                
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
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
                            <tr>  
                                <th>圖片</th>
                                <th>商品名稱</th>
                                <th>單價</th>
                                <th>數量</th>
                                <th>價格</th>
                                <th>時間</th>
                                <th>&nbsp</th>
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
    <div id="ticketInput"></div>                          
    <!-- 對話盒 -->
    <div id="newsModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4>修改</h4>
                </div>
                <div class="modal-body">
                    <form>
                    <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">產品名稱：</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="list-group list-group">
                        <div class="row">


                            <div class="col-md-6">
                                <div class="thumbnail">
                                    <img src="" id="dimg" alt="Lights" width="200px" height="200px">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <form method="post" action="product_item.php?pid=<?= $item?>">
                                    <h4><?= $row_item["descript"]?></h4>

                                    
                                    <div class="buya">
                                    <p>購買數量：<input id="buynumber" name="buynumber" type="number" value="1" min="1"  max="9999"></p>
                                    </div>
                                    <br><br><br>
                                    
                                    <div class="rol-md-6">
                                    
                                   
                                    <a href="#" class="btn btn-danger btn-lg" role="button">確認修改</a>
                                    <a href="index.php" class="btn btn-primary btn-lg" role="button">返回</a>
                                        
                                       
                                    </div>
                                </form>
                              
                                
                            </div>
                        </div>
                        </ul>

                    </div>
                </div>


                    </form>
                </div>
                <div class="modal-footer">
                        <div class="pull-right">
                            <button type="button"
                                    id="okButton"
                                    class="btn btn-success">
                                <span class="glyphicon glyphicon-ok"></span> 確定
                            </button>
                            <button type="button"
                                    id="cancelButton"
                                    class="btn btn-default"
                                    data-dismiss="modal">
                                <span class="glyphicon glyphicon-remove"></span> 取消
                            </button>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 對話盒 -->

<!-- ========== UI 與 JavaScript 分隔線 ========== -->


<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>


<script>



    $(".editItem").click(function () {
       
       
        
        var iIndex = $(this).closest("td").index();
        currentIndex = iIndex;
        alert(iIndex);
        $("buya").val(<?= $row_cartlist['quantity']?>);
        $("thumbnail").val(<?= $row_cartlist['img']?>);
        $("#newsModal").modal( { backdrop: "static" } );


    })


</script>

</body>
</html>





