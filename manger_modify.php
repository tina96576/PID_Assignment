<?php


$id=$_GET["pid"];
if(! is_numeric($id)){
    die("id not a number");
}

require("conn.php");

if(isset($_POST["sure"])){
    $pname=$_POST["text1"];//產品名稱
    $category=$_POST["category"];//產品類別
    $price=$_POST["text2"];//定價
    $quanity=$_POST["text3"];//庫存
    $introduct=$_POST["textarea"];//產品介紹
    $imgpath=processFile ( $_FILES ["file1"] );

  
    $sql="UPDATE product SET pname='$pname',categoryid='$category',price=$price,img='$imgpath',descript='$introduct',cquity=$quanity where pid=$id";
    mysqli_query($link,$sql);
    echo "<script> {window.alert('修改成功'); location.href='manager.php'} </script>";
    
  
}else{

    $sql="SELECT * FROM product as p join category as c on p.categoryid=c.categoryid where p.pid=$id";

    $result=mysqli_query($link,$sql);

    $row=mysqli_fetch_assoc($result);
    
    //var_dump($row);
}



function processFile($objFile) {
   
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
</head>
<body>


  

<div class="container">
    <div class="col-sm-3" ></div>
    <div class="col-sm-6" >
    <h2 style="text-align:center;"></h2>

    <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
        <label for="text1">產品名稱</label>
        <input type="text" class="form-control" id="text2"  name="text1" value=<?=$row['pname']?>>
        </div>
        
        <div class="form-group">
        <label for="exampleFormControlSelect1">類別</label>
        <select class="form-control" id="category" name="category" value='1'>
        <option name="cityid" value='1' <?=( $row["cityId"]==1)?"checked":""?>>糖果</option>
        <option name="cityid" value='2' <?=( $row["cityId"]==2)?"checked":""?>>飲料</option>
        <option name="cityid" value='3' <?=( $row["cityId"]==3)?"checked":""?>>餅乾</option>
        </select>
        </div>

       

        <div class="form-group">
        <label for="text2">定價</label>
        <input type="number" class="form-control" id="text2"  name="text2" value=<?=$row['price']?> min="1" max="99999">
        </div>
        <div class="form-group">
        <label for="text3">庫存量</label>
        <input type="number" class="form-control" id="text3" name="text3" value=<?=$row['cquity']?> min="0" max="99999">
        </div>
        <div class="form-group">
        <label for="textarea" class="col-4 col-form-label" >產品介紹</label> 
        <div class="col-8">
        <textarea id="textarea" name="textarea" cols="40" rows="5" class="form-control" value=<?=$row['descript']?>></textarea>
        </div>
        </div> 
    
        <label for="text4">上傳圖檔</label>
        <input type="file" name="file1" accept="image/*"/>
        
        


        <br>
        <button type="submit" class="btn btn-danger" name="sure" >確認</button>
       
        <a href="manager.php" class="btn btn-primary" role="button">返回</a>

    </form>

    
    </div>
    <div class="col-sm-3"></div>
</div>



</body>
</html>