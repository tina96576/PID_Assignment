<?php
if (isset ( $_POST ["btnOK"] )) {
	processFile ( $_FILES ["file1"] );
}
function processFile($objFile) {
	if ($objFile ["error"] != 0) {
		echo "Upload Fail! ";
		echo "<a href='javascript:window.history.back();'>Back</a>";
		return;
	}
	
	$test = move_uploaded_file ( $objFile ["tmp_name"], "./image/test/" . $objFile ["name"] );
	if (! $test) {
		die ( "move_uploaded_file() faile" );
	}
	
	echo "File uploaded<br />";
	
    echo "./image/test/" .$objFile ["name"]."<br>";
   
	echo "File name: " . $objFile ["name"] . "<br />";
	echo "File type: " . $objFile ["type"] . "<br />";
	echo "File size: " . $objFile ["size"] . "<br />";
	
	echo "--  Done --";
	exit ();


}

//unlink('./image/test/芭樂汁.jpg');

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Lab - Upload file</title>
</head>
<body>
	<form method="post" enctype="multipart/form-data" action="">
		1. Select a file：<input type="file" name="file1" accept="image/*"/><br /> <input
			type="submit" name="btnOK" value="2. 送出資料" />
	</form>
</body>
</html>