<?php
include 'config.php';
if( isset($_POST['username'])){
	$conn = db2_connect( $dbname , $username , $password );
	
	if ($conn){
		$userName = $_POST['username'];
		$userNameQuery = "SELECT COUNT(*) FROM ".$computerName.".USERS WHERE email = '$userName' ";
		
		$stmt = db2_prepare($conn, $userNameQuery);
            
            if ($stmt) {
                        
                        $result = db2_execute($stmt);
                        
                        if ($result){
                            $username_result = db2_fetch_array($stmt);
                            if($username_result[0] == '0'){
                                echo 'Username is available';
                            }
                            else{
                                echo 'Sorry, the Username '.$userName.' already exists!';
                            }
                        }
                        else{
                        	db2_stmt_errormsg($stmt);
                        	db2_close($conn);
                        }
        	}
        		
	}
	
}
?>