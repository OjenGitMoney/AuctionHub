
<?php
include 'nav.php';

?>
<html>

<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'></script>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title name='name'></title>
<meta name="description" content="">

<head>
	<style>
	#imagesection{
		margin: 0 0 0 8%;
		float: left;
		min-width: 140px;
		width:30%;
		height: 40%;
		//background-color:lightgrey;
		//border-right: 2px solid grey;
	}

	#productimage{
		border: 3px solid #f2f2f2;
		min-height:200px;
		min-width:200px; 
		width: 97%;
		height: auto;
	}

	#infosection{
		font-family: 'Roboto' sans-serif;
		padding: 5px;
		float:left;
		margin: 0 0 0 10px;
		min-width:140px;
		width: 40%;
		height: 100%;
		//background-color:#ebebe0;		
	}

	#infoTitle{
		text-transform: uppercase;
		font-size: 32px;
	}
	#infoSeller{
		
		font-size: 18px;
	}
	#seller{
		display:inline;
	}
	#price{
		display:inline;
	}
	#bidNumber{
		display:inline;
		padding-left: 20px;
		font-size:16px;
	}
	#infoTimer{
		font-size: 18px;
	}
	#timer{
		font-size: 18px;
		display:inline;
		color: green;
	}
	#error{
		color:red;
	}
	#bidInput{
		font-size: 16px;
		width: 100px;
		height:40px;
		text-align: right;
	}
	#bidButton{
		height:40px;
		background-color: #2b78e4;
		color: white;
		
		border: 0;
		font-family: 'Roboto', sans-serif;
	}
	#bidButton:disabled{
		height:40px;
		background-color: lightgrey;
		color: white;
		
		border: 0;
		font-family: 'Roboto', sans-serif;
	}
	#bidCondition{
		display:inline;
		text-transform: uppercase;
	}
	</style>	
</head>

<body>
	<div id="imagesection">
		<img id="productImage" name="IMAGE"> 
	</div>


	<div id="infosection">

		<section id="infoTitle">
			<div name="name"></div>
		</section>
		<br>

		<section id="infoSeller">
			Sold by: <a><div id = "seller" name="POSTER_EMAIL"></div></a> <br>
			Current Bid: $<div id="price" name ="POST_PRICE"></div></strong> 
			<a id="bidNumber">[Number of bids: <div style="display:inline;"name="NUMBER_OF_BIDS"></div>]</a>
		</section>

		<section id="infoTimer">
			Time left: <div id = "timer" ></div>
		</section>

		<section id="bidPrice">
			<div id="error"></div>
			<input id="bidInput">
			<button id="bidButton" onclick="makeBid();">Make a bid</button>
		</section>

		<section id="bidDesc">
			<h1>Description</h1>
			Condition: <div id="bidCondition" name="CONDITION"></div>
			<div name="DESCRIPTION"></div>
			<div id="user" style="display: none;"><?php 
				if(isset($_SESSION['username']))
				{
					echo $_SESSION['username']; 	
				}
				else
					echo 'undefined';
			?></div>
		</section>
		<div>
		</body>

<script type = "text/javascript">
	var clock = document.getElementById("timer");;
	var endtime;
	var highBid;
	var username;
	function getInfo(){
		$.get(("getBids.php"), {id:<?php echo $_GET['id']; ?>}, function(data){
			endtime = data['END_DATE'] + " " + data['END_TIME'];
			getTimeRemaining(endtime);
			displayTime();
			for( i in document.getElementsByName("NUMBER_OF_BIDS"))
				document.getElementsByName("NUMBER_OF_BIDS")[i].innerHTML = data['NUMBER_OF_BIDS'];
			for( i in document.getElementsByName("POST_PRICE"))
			{
				highBid = data['HIGHEST_BID_AMOUNT'];
				document.getElementsByName("POST_PRICE")[i].innerHTML = highBid;
			}
			for( i in document.getElementsByName("POSTER_EMAIL"))
				document.getElementsByName("POSTER_EMAIL")[i].innerHTML = data['POSTER_EMAIL'];
		}, "json");

		$.get(("getItem.php"), {id:<?php echo $_GET['id']; ?>}, function(data){
			for( i in document.getElementsByName("name"))
				document.getElementsByName("name")[i].innerHTML = data['NAME'];
			for( i in document.getElementsByName("DESCRIPTION"))
				document.getElementsByName("DESCRIPTION")[i].innerHTML = data['DESCRIPTION'];
			for( i in document.getElementsByName("POST_DATE"))
				document.getElementsByName("POST_DATE")[i].innerHTML = data['POST_DATE'];
			for( i in document.getElementsByName("POST_TIME"))
				document.getElementsByName("POST_TIME")[i].innerHTML = data['POST_TIME'];
			for( i in document.getElementsByName("CONDITION"))
				document.getElementsByName("CONDITION")[i].innerHTML = data['CONDITION'];
			for( i in document.getElementsByName("IMAGE"))
				document.getElementsByName("IMAGE")[i].src = data['IMAGE'];
			for( i in document.getElementsByName("WINNER_EMAIL"))
				document.getElementsByName("WINNER_EMAIL")[i].innerHTML = data['WINNER_EMAIL'];
		}, "json");
		
		//console.log(username);
	}
	window.onload = getInfo;
</script>

<script>
	function getTimeRemaining(end){
		//console.log(end);

		var a = end.split(/[^0-9]/);
		//for (i=0;i<a.length;i++) { alert(a[i]); }
		var d=new Date (a[0],a[1]-1,a[2],a[3],a[4],a[5] );
		//console.log(d);
		var t = d - Date.now();
		
		var seconds = Math.floor( (t/1000) % 60 );
		var minutes = Math.floor( (t/1000/60) % 60 );
		var hours = Math.floor((t/(1000*60*60)%24 ));
		var days = Math.floor( t/(1000*60*60*24) );
		//console.log(hours);
		return {
			'total': t,
			'days': days,
			'hours': hours,
			'minutes': minutes,
			'seconds': seconds
		};
	}
	function displayTime(){
		var time = setInterval(function(){
			var t = getTimeRemaining(endtime);
			clock.innerHTML = t.days + 'd '+ t.hours  + 'h ' + t.minutes + 'm ' + t.seconds + 's ';
			//console.log(t.days);
			if(t.days > 0)
				clock.innerHTML = t.days + 'd '+ t.hours  + 'h ' + t.minutes + 'm ' + t.seconds + 's ';
			else
			{

				if(t.hours > 0)
					clock.innerHTML = t.hours  + 'h ' + t.minutes + 'm ' + t.seconds + 's ';
				else
				{
					if(t.minutes > 0)
						clock.innerHTML = t.minutes + 'm ' + t.seconds + 's ';
					else{
						if(t.seconds > 0)
							clock.innerHTML = t.seconds + 's ';
						else
						{
							clock.innerHTML = 'Bidding is over.';
							document.getElementById("bidButton").disabled = true;
							clearInterval(time);
						}
					}
				}
			}
		},1000);
	}
	function makeBid()
	{
		var bid = document.getElementById("bidInput").value;

		username = document.getElementById("user").innerHTML;
		//console.log(username);
		if(isNaN(bid) || bid == '')
		{
			document.getElementById("error").innerHTML = "Please enter a number.";
		}
		else if(username == 'undefined')
		{
			window.open("login.php")
		}
		else if(bid <= highBid)
		{
			document.getElementById("error").innerHTML = "Your bid is too low.";	
		}
		else{
			document.getElementById("error").innerHTML = "";
			var theTime = new Date();
			var currentTime = theTime.getHours()+":"+theTime.getMinutes()+":"+theTime.getSeconds() ;
			
			var currentDate = theTime.getFullYear()+"-"+theTime.getDate()+"-"+(theTime.getMonth()+1);
			console.log(currentTime);
			$.get("makeBid.php", {id:<?php echo $_GET['id']; ?>, bid:bid, user:username, date:currentDate, time:currentTime}, function(data){
					console.log(data);
					if(data == "yay")
					{
						location.reload(true);
					}
					else
					{
						document.getElementById("error").innerHTML = "The highest bid has changed.";
					}

			}, "json");
		}
	}
</script>
</html>