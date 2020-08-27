<?php

if (!isset($_GET["cartid"])){
    die("id not found");
}

$id=$_GET["cartid"];
if(! is_numeric($id)){
    die("id not a number.");
}

$sql="delete from cart where cartid=$id";

    require("conn.php");
    mysqli_query($link,$sql);
    header("location:cart.php");
?>