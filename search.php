<html>
    <head>
        <title> AuctionHub</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <style type="text/css">

            #banner{
                background-color:black;
                padding: 20px;
                text-align:center;
            }

            #tfheader{
                background-color:#c3dfef;
            }
            #tfnewsearch{
                position:relative;
                left:0px;
                padding:10px;
            }
            #tabledata{
                //border:1px solid black;
                border-collapse: separate;
                border-spacing: 150px 5px;
            }

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
        //get the query and clean it up(delete leading and trailing
        //white space and remove backslashes from magic_quotes_gpc)
        ?>
        <!-- HTML for SEARCH BAR -->
        <div id="banner">
            <font color="white" size="20">Banner</font>
        </div>
        <div id="tfheader">
            <table id="tabledata">
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
                $query = "Select * from ".$computerUserName.".items where name='" . $searchedItem . "'";
                $stmt = db2_prepare($connection, $query);
                $result = db2_execute($stmt);

                if ($stmt) {
                    while ($row = db2_fetch_array($stmt)) {
                        echo "<tr>";
                        echo "<td><image src='" . $row[7] . "' width = 175 height = 175 </image></a></td>";
                        echo "<td>" . $row[1] . "</td>";
                        echo "<td> Hello</td>";
                        echo "<td> Hello</td>";														
                        echo "</tr>";
                    }
                }
                ?>
            </table>
            <div class="tfclear"></div>
        </div>
    </body>
</html>