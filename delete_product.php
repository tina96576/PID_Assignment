<?php

if (!isset($_GET["pid"])){
    die("id not found");
}

$id=$_GET["pid"];
$pimg=$_GET["pimg"];

if(! is_numeric($id)){
    die("id not a number.");
}

$sql="delete from product where pid=$id";

require("conn.php");
mysqli_query($link,$sql);
unlink($pimg);
header("location:manager.php");
?>