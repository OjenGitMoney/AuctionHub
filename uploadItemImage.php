<?php
$conn = db2_connect('auction','db2admin','cs174');

if ($conn) {

    $itemId = $_POST['itemId'];
	$sql = "SELECT ID FROM OWNER.ITEMS WHERE ID = $itemId";
	$stmt = db2_prepare($conn, $sql);
	if ($stmt) {
	  $result = db2_execute($stmt);
	  if (!$result) {
		 echo "exec errormsg: " .db2_stmt_errormsg($stmt);
		 die("Failed Query");
	  }
	  if (db2_fetch_array($stmt) == 0) {
	    // echo("item no found");
		return;
	  }
	}

	$imageStore = './imageStore';
	$stat = @stat($imageStore);
	if (!$stat) {
		if (!mkdir($imageStore, 0777, true)) {
			die('not make '.$imageStore);
		}
	}
	
	// unique filename
	// Check file is image
	$uploadOk = 1;
	if(isset($_POST["upload"])) {
		$check = getimagesize($_FILES["itemImage"]["tmp_name"]);
		if($check !== false) {
			$uploadOk = 1;
		} else {
			echo "Not image file.";
			return;
		}
	}
	
	$imageFileType = pathinfo(basename($_FILES["itemImage"]["name"]))['extension'];
	$filename = uniqid('IMG_');
    $storeImage = $imageStore . '/' . $filename . '.' . $imageFileType;
	
	if ($uploadOk == 0) {
		echo "File was not uploaded.";
	} else {
		if (move_uploaded_file($_FILES["itemImage"]["tmp_name"], $storeImage) == 0) {
			echo "Error uploading file.";
		}
	}
	
	$sql = "UPDATE OWNER.ITEMS SET IMAGE = clob('$storeImage') WHERE ID = $itemId";
	$stmt = db2_prepare($conn, $sql);
	if ($stmt) {
	  $result = db2_execute($stmt);
	  if (!$result) {
		 echo "exec errormsg: " .db2_stmt_errormsg($stmt);
		 die("Failed update");
	  }
	}
}
else
{
	die("No connect Database");
}
?>
