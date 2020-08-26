<?php

if (!isset($_GET["cartid"])){
    die("id not found");
}

$id=$_GET["cartid"];
if(! is_numeric($id)){
    die("id not a number.");
}

$sql=<<<multi
    delete from cart where cartid=$id
    multi;

    require("conn.php");
    mysqli_query($link,$sql);
    header("location:cart.php");
?>