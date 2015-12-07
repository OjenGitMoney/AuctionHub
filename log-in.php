<?php
session_unset();
error_reporting(0);
session_start();
include 'config.php';
	if( isset($_POST['userName']) && isset($_POST['password']) ){
			
			$usernameEntered = $_POST['userName'];
			$passwordEntered = $_POST['password'];
				$conn = db2_connect( $dbname , $username , $password );
								
				$sqlquery = "SELECT password FROM ".$computerName.".USERS WHERE email = '$usernameEntered' ";
				$stmt = db2_prepare($conn, $sqlquery);
            	
            	if ($stmt) {       
                        $result = db2_execute($stmt);
                  		
                  		if (!$result){
                  			db2_stmt_errormsg($stmt);
                  		}
      
       					while ($row = db2_fetch_array($stmt)) {
		
						$passwordFromDb = $row[0];
						}
						db2_close($conn);
						
						echo $passwordFromDb;
						if($passwordEntered == $passwordFromDb){
							$_SESSION['username'] = $usernameEntered;
							
							header('Location: index.php');
							
							}
						else{
							header('Location: login.php');
						} 
						
							
						
				}
		
	}
	else{
    http_response_code(400);
  }
?>