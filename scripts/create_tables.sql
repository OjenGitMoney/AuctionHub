-- db2 -td"^" -f create.sql

DROP TABLE items^
DROP TABLE users^
DROP TABLE bids^

CREATE TABLE items	(	
				id	INT NOT NULL GENERATED ALWAYS AS IDENTITY (START WITH 100, INCREMENT BY 1, NO CACHE), 
				name	VARCHAR(20) NOT NULL,
                description	VARCHAR(256) NOT NULL,	
				post_price INT,
				post_date DATE NOT NULL WITH DEFAULT CURRENT DATE,
				post_time TIME NOT NULL WITH DEFAULT CURRENT TIME,
				end_date DATE,
				image VARCHAR(256),
				condition CHAR(10),
				poster_email VARCHAR(50),
				winner_email VARCHAR(25),
				PRIMARY KEY (id) 
                    
					)^
			 
CREATE TABLE users	(
				first_name VARCHAR(30),
				last_name VARCHAR(30),
				email VARCHAR(50) NOT NULL UNIQUE,
				password VARCHAR(20) NOT NULL,
				is_seller CHAR(1) CHECK ( is_seller IN ( 'T' , 'F' ) )
				
					)^

CREATE TABLE bids	(

						item_id INT ,
						number_of_bids INT,
						highest_bid_amount INT,
						highest_bidder VARCHAR (50),
						end_date DATE,
						end_time TIME,
						poster_email VARCHAR (50),
						FOREIGN KEY (item_id) REFERENCES items (id) ON DELETE CASCADE
						)^

CREATE TRIGGER sync 
AFTER INSERT ON items

REFERENCING NEW AS newrow
FOR EACH ROW
MODE DB2SQL

BEGIN ATOMIC
	INSERT INTO bids (item_id, number_of_bids, highest_bid_amount, end_date, end_time, poster_email) VALUES (newrow.id, 0, newrow.post_price, newrow.end_date, newrow.post_time, newrow.poster_email);
END^						