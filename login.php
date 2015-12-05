

<html>
	<head>
		<title>Login</title>

		<link rel="stylesheet" href="resources/bootstrap-3.3.5/css/bootstrap.min.css"/>
    	<!-- Optional theme -->
    	<link rel="stylesheet" href="resources/bootstrap-3.3.5/css/bootstrap-theme.min.css"/>

		<style type="text/css">
		
		#registerTable{
			margin-left: 10%;
		}
		#loginForm{
			padding-top: 20%;
		}
		table td {
			padding: 5px;
		}
		.effect
		{
    		width: 450px;
    		height: 300px;
    		position: relative;
    		box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
    		border-radius: 10px;
    		left:30%;
    		top:15%;
    		
		}
		.effect:before, .effect:after
		{
			content:"";
    		position:absolute; 
    		z-index:-1;
    		box-shadow:0 0 20px rgba(0,0,0,0.8);
    		top:0;
    		bottom:0;
    		left:1px;
    		right:1px;
    		border-radius: 10px;
		} 
		.effect:after
		{
    		right:10px; 
    		left:auto; 
    		transform:skew(8deg) rotate(3deg);
    		border-radius: 10px;
		}
		</style>

	</head>


<body>

<nav>
<?php include ('nav.php'); ?>	
</nav>

<div class="effect">
<form id="loginForm" method='post' action="log-in.php">
	<table id='registerTable'>
	<tr>
		<td>
			Username (email):
		</td>
		<td>
			<input type="email" name="userName" class="form-control" autofocus required/>
		</td>
	</tr>

	<tr>
		<td>
			Password:
		</td>
		<td>
			<input type='password' name='password' class="form-control" required/>
		</td>
	</tr>

	<tr>
		<td></td>
		<td style="padding-top: 20px">
			<input type='Submit' name='Submit' value='Login' class='btn btn-primary'/>
			<input type='button' value='Register' class='btn btn-default' onclick="location.href='register.php' " style="margin-left:20px" />
		</td>
	</tr>

	</table>
</form>
</div>


	<script src="resources/jquery-1.11.3.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="resources/bootstrap-3.3.5/js/bootstrap.min.js"></script>
</body>

</html>