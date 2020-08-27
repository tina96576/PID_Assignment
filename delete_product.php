<?php

if (!isset($_GET["pid"])){
    die("id not found");
}

$id=$_GET["pid"];
if(! is_numeric($id)){
    die("id not a number.");
}

$sql=<<<multi
    delete from product where pid=$id
    multi;

    require("conn.php");
    mysqli_query($link,$sql);
    header("location:manager.php");
?>