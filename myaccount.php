<header>
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">

</header>
<html>
<body>

    <?php
    session_start();
    if (isset($_SESSION['username']))
    {   
    ?>
    
    <nav role="navigation" class="navbar navbar-default navbar-static-top navbar-inverse">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
          <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
      </div>
    <!-- Collection of nav links and other content for toggling //   class="active"  -->
      <div id="navbarCollapse" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
                <li><a href="index.php">Home</a></li>
            </ul>
            <ul class="nav navbar-nav">
              <li><a href="postitem.html/">Sell an Item</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
              <li><a href="myaccount.php"><?php echo $_SESSION['username'] ?></a></li>
          </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php">Log-Out</a></li>
            </ul>
       </div>
    </div>
  </nav><br><br>

  <?php
  $conn = db2_connect('auction','db2admin','cs174');
  if ($conn) {
  
     $userName = $_SESSION['username'];
     
     $sql = "SELECT ID, IMAGE, DESCRIPTION, CONDITION FROM ".$computerUserName.".ITEMS WHERE WINNER_EMAIL = '$userName'";
  
     $stmt = db2_prepare($conn, $sql);
     if ($stmt) {
        $result = db2_execute($stmt);
        if (!$result) {
           echo "exec errormsg: " .db2_stmt_errormsg($stmt);
           die("Failed Query");
        }
		
		print ('<h1  style="font-weight: bold;  text-align: center;">Account View</h1><br>');

        while ($row = db2_fetch_array($stmt)) {
          $image = file_get_contents($row[1]);
          $itemID = $row[0];
		  $condition = $row[3];
          $desc = $row[2].'<br><br>	Condition: '.$row[3].'<br>Item #'.$itemID;
          $sql2 = "SELECT HIGHEST_BID_AMOUNT, END_DATE, END_TIME FROM OWNER.BIDS WHERE ITEM_ID = $itemID";
          $stmt2 = db2_prepare($conn, $sql2);
          $result2 = db2_execute($stmt2);
          if (!$result2) {
             echo "exec errormsg: " .db2_stmt_errormsg($stmt2);
             die("Failed Query");
          }
          $row = db2_fetch_array($stmt2);
          $endTime = $row[1] . ' ' . $row[2];
          $highestBid = $row[0];
          print ('<style type="text/css">');
          print ('#a1 {');
          print ('  text-indent: 10px;');
          print ('}');
          print ('</style>');
		  //print ('<h1  style="font-weight: bold;  text-align: center;">Account View</h1><br>');
          print ('<table  style="cellpadding: 10; width: 969px; text-align: left; margin-left: auto; margin-right: auto;" border="1">');
          print ('  <tbody  id="b3">');
          print ('  <tr  align="left">');
          print ('    <td  style="width: 100%; height: 38.4333px;"  colspan="4"  rowspan="1"> <h3  style="text-align: center;">&nbsp;<span  style="font-weight: bold;">Item Won</spa></h3> </td>');
          print ('  </tr>');
          print ('  <tr>');
          print ('    <td  style="font-weight: bold; width: 20%; text-align: center;">Picture</td>');
          print ('    <td  style="font-weight: bold; text-align: center; vertical-align: middle; width: 50%; height: 18px;">Product Description</td>');
          print ('    <td  style="font-weight: bold; text-align: center; width: 10%; vertical-align: middle;">End Time</td>');
          print ('    <td  style="font-weight: bold; text-align: center; width: 20%; vertical-align: middle;">&nbsp;Win Bid Price</td>');
          print ('  </tr>');
          print ('  <tr>');
          print ('    <td  style="width: 20%; text-align: center;">');
          print ('    <img src="data:image/jpeg;base64,' . base64_encode($image) . '" width="140" height="140">');
          print ('    </td>');
          print ('    <td  id="a1" style="width: 50%;">');
          print ($desc);
          print ('</td>');
          print ('    <td  style="width: 10%; text-align: center;">');
          print ($endTime);
          print ('</td>');
          print ('    <td  style="width: 20%; text-align: center;">');
          print ('$'.$highestBid);
          print ('</td>');
          print ('  </tr>');
          print ('  </tbody>');
          print ('</table>');
        }
      }
  }
  else
  {
      die("Not connect Database");
  }
  ?>
</body>
</html>

<?php
}
else
{
	header('location: login.php');
}
?>