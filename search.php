<html>
    <head>
        <title> AuctionHub</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <style type="text/css">

 

            /* Fixes submit button height problem in Firefox */
            .tfbutton::-moz-focus-inner {
                border: 0;
            }
            .tfclear{
                clear:both;
            }
        </style>
    </head>
    <body>

        <?php
        require_once('connect.php');
        require_once('nav.php');
        //Connect to DB2
        $connection = db2_connect($database, $dbusername, $dbpassword);
        if (!$connection) {
            die('Not connected : ' . db2_conn_error());
        }

        ?>
        <!-- HTML for SEARCH BAR -->
            <table class="table  table-striped table-bordered table-hover  table-condensed">
                <tr>
                    <th>Image</th>
                    <th>Item</th>
                    <th>Current Bid</th>
                    <th>Number of Bids</th>
                </tr>
                <?php
                
                $searchedItem = $_POST['searchterm'];
                trim($searchedItem);
                $searchedItem = stripslashes($searchedItem);
                
                //****************************************************************************************
                //THIS IS THE NEW STUFF REGARDING FILTERING
                //$filterValue = $_POST['plowest'];
                //if($filterValue){
                  //  $query = "Select * from ".$computerUserName.".items ORDER BY name ASC";
                //}
                //****************************************************************************************
                $query = "Select * from ".$computerUserName.".items where name='" . $searchedItem . "'";
                $stmt = db2_prepare($connection, $query);
                $result = db2_execute($stmt);

                if ($stmt) {
                    while ($row = db2_fetch_array($stmt)) {
                       $query2 = "Select highest_bid_amount, number_of_bids from $computerUserName.bids where item_id =" . $row[0];
                       $stmt2 = db2_prepare($connection, $query2);
                       $result2 = db2_execute($stmt2);
                       
                       $row2 = db2_fetch_array($stmt2);
                        echo "<tr>";
                        echo "<td><image src='" . $row[7] . "' width = 175 height = 175 </image></a></td>";
                        echo "<td><a href=\"product.php?id=" . $row[0] . "\"class='btn btn-info' role='button'>" . $row[1] . "</a></td>";
                        echo "<td>" . $row2[0] . "</td>";
                        echo "<td>" . $row2[1] . "</td>";												
                        echo "</tr>";
                    }
                }
                ?>
            </table>
            <div class="tfclear"></div>
    </body>
</html>