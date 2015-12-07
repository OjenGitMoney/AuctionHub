
<?php

include 'config.php';
	try{
		$conn = db2_connect($dbname, $username, $password);
	}
	catch( Exception $e ){
		echo "Exception: ". $e->getMessage();
	}
	$user = $_GET['user'];
	$id = $_GET['id'];
	$bid = $_GET['bid'];
	$date = $_GET['date'];
	$time = $_GET['time'];
	if( $conn ){
		$sql = "select ITEM_ID, NUMBER_OF_BIDS, HIGHEST_BID_AMOUNT, HIGHEST_BIDDER, END_DATE, END_TIME, POSTER_EMAIL
		from ".$computerName.".bids
		where ITEM_ID= ".$id." ";
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
		if($item['HIGHEST_BID_AMOUNT'] < $bid)
		{
			/*// INSERTS THE HIGHEST BIDDER
			$sql = "UPDATE ".$computerName.".bids 
			SET (HIGHEST_BIDDER, NUMBER_OF_BIDS, HIGHEST_BID_AMOUNT, DATE_BID_PLACED,TIME_BID_PLACED) = ('".$user."',NUMBER_OF_BIDS + 1, $bid, '".$date."', '".$time."'
			where ITEM_ID = ".$id." ";
			$stmt = db2_prepare($conn, $sql);
			if( $stmt)
				$result = db2_execute($stmt);*/
			
			//INCREASES THE NUMBER OF BIDS
			$sql = "UPDATE ".$computerName.".bids
			SET HIGHEST_BIDDER = '".$user."',
				NUMBER_OF_BIDS = NUMBER_OF_BIDS + 1,
				HIGHEST_BID_AMOUNT = $bid,
				DATE_BID_PLACED = '".$date."',
				TIME_BID_PLACED = '".$time."'
			where ITEM_ID = ".$id."
			";
			$stmt = db2_prepare($conn, $sql);
			if( $stmt)
				$result = db2_execute($stmt);

			/*//SETS THE HIGHEST BID SO FAR
			$sql = "UPDATE ".$computerName.".bids
			SET HIGHEST_BID_AMOUNT = $bid
			where ITEM_ID = ".$id." ";
			$stmt = db2_prepare($conn, $sql);
			if( $stmt)
				$result = db2_execute($stmt);

			//INSERT THE DATE THIS BID WAS PLACED
			
			$sql = "UPDATE ".$computerName.".bids
			SET DATE_BID_PLACED = '".$date."'
			where ITEM_ID = ".$id." ";
			$stmt = db2_prepare($conn, $sql);
			if( $stmt)
				$result = db2_execute($stmt);


			//INSERT THE TIME THIS BID WAS PLACED
			
			$sql = "UPDATE ".$computerName.".bids
			SET TIME_BID_PLACED = '".$time."'
			where ITEM_ID = ".$id." ";
			$stmt = db2_prepare($conn, $sql);
			if( $stmt)
				$result = db2_execute($stmt);*/
			$response = 'yay';
		}
		else
			$response = 'nay';
		echo json_encode($response);
		db2_close($conn);
	}
	else{
		echo db2_conn_error()."<br>";
		echo db2_conn_errormsg()."<br>";
		echo "Connection failed.<br>";
	}
?>
