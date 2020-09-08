<?php

if(isset($_POST["sure"])){
    $pname=$_POST["text1"];//產品名稱
    $category=$_POST["category"];//產品類別
    $price=$_POST["text2"];//定價
    $quanity=$_POST["text3"];//庫存
    $introduct=$_POST["textarea"];//產品介紹
  
    if(empty($_FILES ["file1"]["tmp_name"])){
        echo "<script> {alert('無圖檔');location.href='manger_modify.php?pid=$id'} </script>";
    }else{
        $imgpath=processFile ( $_FILES ["file1"] );//存放在根目錄下
        if(!isset($_GET['pid'])){
            insert_product($imgpath); //將圖片路徑上傳資料庫
        }
    }  
}

function insert_product($imgpath){//新增商品
    require("conn.php");
    $sql="insert into product (pname,categoryid,price,img,descript,cquity) values ('$pname',$category,$price,'$imgpath','$introduct',$quanity)";
    mysqli_query($link,$sql);
}


function processFile($objFile) {//上傳圖片
    $category=$_POST["category"];
	if ($objFile ["error"] != 0) {
		echo "Upload Fail! ";
		return;
	}
	$test = move_uploaded_file ( $objFile ["tmp_name"], "./image/".$category."/" . $objFile ["name"] );
	if (! $test) {
		die ( "move_uploaded_file() faile" );
	}
    $imgpath="./image/".$category."/" .$objFile ["name"];
    return $imgpath;
}

//unlink('./image/test/芭樂汁.jpg');
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add Product</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href="css/style3.css" rel="stylesheet">
</head>
<style>
    body{
        background-image: url("./image/cover/background3.jpeg");
        background-repeat:no-repeat;
        background-size:cover;      
        background-attachment:fixed;
        display:flex;
        justify-content:center;
        align-items:center; 
    }
</style>


<body>


<div class="container">
    <div class="col-sm-3" ></div>
    <div class="col-sm-6" id="col6">
    

    <form method="post" action="" enctype="multipart/form-data">
        <h2 style="text-align:center;">新增商品</h2>
        <div class="form-group"><label for="text1">商品名稱</label><input type="text" class="form-control" id="text2"  name="text1"></div>
        <div class="form-group">
        <label for="exampleFormControlSelect1">類別</label>
        <select class="form-control" id="category" name="category" value='1'><option value='1'>糖果</option><option value='2'>飲料</option><option value='3'>餅乾</option></select>
        </div>
        <div class="form-group"><label for="text2">定價</label><input type="number" class="form-control" id="text2"  name="text2" value=1 min="1" max="99999"></div>
        <div class="form-group"><label for="text3">庫存量</label><input type="number" class="form-control" id="text3" name="text3" value=1 min="0" max="99999"></div>
        <div class="form-group"><label for="textarea" class="col-4 col-form-label">商品介紹</label> 
        <div class="col-8"><textarea id="textarea" name="textarea" cols="40" rows="5" class="form-control"></textarea></div>
        </div> 
        <label for="text4">上傳圖檔
        <input type='file' onchange="readURL(this);" id="file1" name="file1" accept="image/*"/>
        <img id="blah" src="http://placehold.it/180" alt="your image" />
        </label>  
        <br>
        <button type="submit" class="btn btn-danger" name="sure" >確認</button>
        <a href="manager.php" class="btn btn-primary" role="button">返回</a>
    </form>

    
    </div>
    <div class="col-sm-3"></div>
</div>

<script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);};
                    reader.readAsDataURL(input.files[0]);
            }
        }
</script>

</body>
</html>
