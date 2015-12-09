
1. Unzip folder named Auctionhub
2. Move the unzipped folder into Xampp's htdocs directory
	for Example (C:\xampp\htdocs\Auctionhub)
3. open config.php 
4. Place your DataBase password in the $password field.
5. Place your user profile's username in $computerName.
6. Save the new config.php with updated variables.
7. open up DB2 Admin command window
8. Navigate to this directory.
9. Type : run cs174_Project
10. Hit enter



The script will :
1. Drop database in case there is one that exists with the name Auctionhub.
2. Creates database named Auctionhub
3. Grants the db user "db2admin" privilages 
4. Creates tables based on the script provided called create_tables.sql
5. Insert items and Users into table 
6. Launch the Chrome browser pointing to the index.php which is our homepage for this project.
7. Launch Firefox also pointing to the index.php which is our homepage for this project.
( Reason behind both browser scrips are in case you don't have one installed it will rely on the other one)
No need to have both open unless you need to test the multi-user capability.

