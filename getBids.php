
<?php
//phpinfo();
//exit;

include 'connect.php';
	try{
		$conn = db2_connect($database, $dbusername, $dbpassword);
	}
	catch( Exception $e ){
		echo "Exception: ". $e->getMessage();
	}
	$id = $_GET['id'];
	if( $conn ){
		$sql = "select ITEM_ID, NUMBER_OF_BIDS, HIGHEST_BID_AMOUNT, HIGHEST_BIDDER, END_DATE, END_TIME, POSTER_EMAIL
		from bids
		where ITEM_ID= $id";
		$stmt = db2_prepare($conn, $sql);
		
		if( $stmt)
		{
			$result = db2_execute($stmt);
		}
		else
		{
			echo "No results";
		}
		$item = array();
		$item = db2_fetch_assoc($stmt);
		$json = json_encode($item);

			header('Content-type: application/json');

		echo $json;
		db2_close($conn);
	}
	else{
		echo db2_conn_error()."<br>";
		echo db2_conn_errormsg()."<br>";
		echo "Connection failed.<br>";
	}
?>
