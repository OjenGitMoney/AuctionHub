DB2 DROP DATABASE Auction
DB2 CREATE DATABASE Auction

DB2 CONNECT TO Auction
DB2 GRANT SECADM ON DATABASE TO USER DB2ADMIN

DB2 -td"^" -f scripts/create_tables.sql

DB2 -td"^" -f scripts/insert_all_items.sql
DB2 -td"^" -f scripts/insert_all_users.sql

start index.php



