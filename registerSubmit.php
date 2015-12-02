<?php

include 'connect.php';

if( isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['username']) && isset($_POST['password']) ){

	$conn = db2_connect( $database , $dbusername , $dbpassword );
	
	if ($conn){

		$firstName = $_POST['fname'];
		$lastName = $_POST['lname'];
		$userName = $_POST['username'];
		$password = $_POST['password'];

		$insertsql = "INSERT INTO USERS (first_name, last_name, email, password) VALUES ('$firstName', '$lastName', '$userName', '$password') ";
		
		$stmt = db2_prepare($conn, $insertsql);
            
            if ($stmt) {
                        
                        $result = db2_execute($stmt);
                        
                        if ($result){

                        	echo "success!";
                        	db2_close($conn);
                        }
                        else{
                        	db2_stmt_errormsg($stmt);
                        	db2_close($conn);
                        }

        }	
	}
	
}

?>