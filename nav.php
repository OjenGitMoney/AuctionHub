<?php
session_start();
?>

<header>
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">

<style>

  input[name="searchterm"] { 
  width: 450px;
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
      <div id="navbarCollapse" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
                <li><a href="index.php">Home</a></li>
            </ul>
            <ul class="nav navbar-nav">
              <li><a href="postitem.html/">Sell an Item</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
              <li><a href="myaccount.html/php"><?php echo $_SESSION['username'] ?></a></li>
          </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php">Log-Out</a></li>
            </ul>
       </div>
    </div>
  </nav>
    <ul class="search_bar">
    <form method="post" action="search.php">
    <input type="text" name="searchterm" placeholder="search for item..." required><input type="Submit" value="search" name="Search">
    </form>
    </ul>

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
    <!-- Collection of nav links and other content for toggling //   class="active"  -->
      <div id="navbarCollapse" class="collapse navbar-collapse">
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
    <form method="post" action="search.php">
    <input type="text" name="searchterm" placeholder="search for item..." required><input type="Submit" value="search" name="Search">
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