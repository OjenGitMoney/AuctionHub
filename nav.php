<?php
session_start();
?>

<header>

<link rel="stylesheet" href="resources/bootstrap-3.3.5/css/bootstrap.min.css"/>
<!-- Optional theme -->
<link rel="stylesheet" href="resources/bootstrap-3.3.5/css/bootstrap-theme.min.css"/>


        <link rel="stylesheet" type="text/css" href="resources/styleSheet.css">
<style>

#navbarCollapse{
	margin-bottom: 25px;
	font-size: 150%;
}

</style>
</header>



    <?php
    if (isset($_SESSION['username']))
    {   
    ?>
    <html>
    
    <body>
        
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
    	
    	
    <a href="index.php"><img src="resources/logo.png" alt=" logo" width="100" height="100" style="float:left"> </a>
	
      <div id="navbarCollapse" class="collapse navbar-collapse" style="float:right">
      <!-- 
      		<ul class="nav navbar-nav navbar-left">
                <a href="index.php"><img src="resources/logo.png" alt=" logo " width="100" height="100"> </a>
            </ul>
		-->
          <ul class="nav navbar-nav">
                <li><a href="index.php">Home</a></li>
            </ul>
            <ul class="nav navbar-nav">
              <li><a href="postItem.php">Sell an Item</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
              <li><a href="myaccount.php"><?php echo $_SESSION['username'] ?></a></li>
          </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php">Log-Out</a></li>
            </ul>
       </div>
    </div>
  </nav>
    <center>
      <ul class="search_bar">
        <form class="form-inline" method="post" action="search.php">
    
          <input type="text" name="searchterm"  class="form-control"  placeholder="search for item..." required style="width: 40%">
          <input type="Submit" value="Search" name="Search" class="btn btn-info">
        </form>
      </ul>
    </center>

    <script src="resources/jquery-1.11.3.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="resources/bootstrap-3.3.5/js/bootstrap.min.js"></script>

  </body>
</html>
<?php
}
else
{
?>
    <html>
    <body>
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

      <a href="index.php"><img src="resources/logo.png" alt=" logo" width="100" height="100" style="float:left"> </a>

    <!-- Collection of nav links and other content for toggling //   class="active"  -->

      <div id="navbarCollapse" class="collapse navbar-collapse"  style="float:right">
          <ul class="nav navbar-nav">
                <li><a href="index.php">Home</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="login.php">Log-In</a></li>
            </ul>
       </div>
    </div>
  </nav>
    <center>
      <ul class="search_bar">
      <form class="form-inline" method="post" action="search.php">
     
        <input type="text" name="searchterm" class="form-control" placeholder="search for item..." required style="width: 40%">
        <input type="Submit" value="Search" name="Search" class="btn btn-info">
     
      </form>
      </ul>
    </center>

    <script src="resources/jquery-1.11.3.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="resources/bootstrap-3.3.5/js/bootstrap.min.js"></script>
  </body>
</html>
<?php
}
?>