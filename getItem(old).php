
<?php
//phpinfo();
//exit;

$database = "Auction"; //YOUR DATABASE NAME
$user = "db2admin"; 
$pass = "cs174"; //FILL IN PASSWORD

try{
	$conn = db2_connect($database, $user, $pass);
}
catch( Exception $e ){
	echo "Exception: ". $e->getMessage();
}

if( $conn ){
	$sql = "select id, name , DESCRIPTION, POST_PRICE, POST_DATE, POST_TIME, END_DATE, NUMBER_OF_BIDS, IMAGE, CONDITION, POSTER_EMAIL, WINNER_EMAIL
	from items
	where id=100";
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


	echo "
	<html>
	<meta charset=\"utf-8\" />
	<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\" />
	<title>". strtoupper($item['NAME']) ."</title>
	<meta name=\"description\" content=\"\">

	<style>
	#imagesection{
	margin: 0 0 0 2%;
	float: left;
	min-width: 140px;
	width:30%;
	height: 40%;
	background-color:lightgrey;
	border-right: 2px solid grey;
}

	#productimage{
	border: 3px solid 	#f2f2f2;
	width: 97%;
	height: 97%;
}

	#infosection{
	padding: 5px;
	float:left;
	margin: 0 0 0 10px;
	min-width:140px;
	width: 60%;
	height: 100%;
	//background-color:#ebebe0;
	font-family: Roboto;
}

	#infoTitle{
	font-size: 32px;
}
	#infoSeller{
	font-size: 20px;
}
	#infoTimer{
	font-size: 18px;
}
	#timer{
	display:inline;
	color: green;
}

	#bidInput{
	width: 100px;
}
</style>	


	<div id=\"imagesection\">
	<img id=\"productimage\" src=\"". $item['IMAGE'] ."\"> 
	</div>


	<div id=\"infosection\">

	<section id=\"infoTitle\">
	". strtoupper($item['NAME']) . "
	</section>
	<hr>

	<section id=\"infoSeller\">
	Sold by: <a>". $item['POSTER_EMAIL']."</a><br>
	Current Bid: <strong>\$". $item['POST_PRICE'] . "</strong>
	</section>

	<section id=\"infoTimer\">
	Time left: <div id = \"timer\"> ". $item['END_DATE']."</div>
	</section>

	<section id=\"bidPrice\">
	<input id=\"bidInput\" type=\"number\" min=\"". $item['POST_PRICE'] ."\"
	</section>
	<div>

	</html>
	";
	db2_close($conn);
}
else{
	echo db2_conn_error()."<br>";
	echo db2_conn_errormsg()."<br>";
	echo "Connection failed.<br>";
}
?>
