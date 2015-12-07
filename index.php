<?php
require_once('connect.php');
require_once('nav.php');
require_once('config.php');
$connection = db2_connect($database, $dbusername, $dbpassword);
if (!$connection) {
    die('Not connected : ' . db2_conn_error());
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>AuctionHub</title>
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

        <!-- HTML for SEARCH BAR -->
        <div id="banner">
            <font color="white" size="20">Banner</font>
        </div>
        <nav>
            <ul class="pagination">
                <li>
                    <a href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li>
                    <a href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
        <div id="tfheader">
            <table id="tabledata">
                <tr>
                    <th>Image</th>
                    <th>Item</th>
                    <th>Current Bid</th>
                    <th>Number of Bids</th>
                </tr>
                <?php
                //find out how many rows are in the table
                $numRows = "Select Count(*) from " . $computerUserName . ".items";
                $stmt3 = db2_prepare($connection, $numRows);
                $result3 = db2_execute($stmt3);
                $r = db2_fetch_array($stmt3);
                $numrows = $r[0];

                //number of rows to show per page
                $rowsperpage = 10;
                //find out total pages:
                $totalpages = ceil($numrows / $rowsperpage);

                //get the current page or set a default
                if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
                    //cast var as int
                    $currentpage = (int) $_GET['currentpage'];
                } else {
                    // default page num
                    $currentpage = 1;
                }

                // if current page is greater than total pages...
                if ($currentpage > $totalpages) {
                    //set current page to the last page
                    $currentpage = $totalpages;
                }
                //if current page is less less than the first page
                if ($currentpage < 1) {
                    //set current page to the first page
                    $currentpage = 1;
                }

                // the offset of the list, based on current page 
                $offset = ($currentpage - 1) * $rowsperpage;
                $variable = ($offset + $rowsperpage) - 1;

                //get the info from the database

                $query = "select * from(Select ROW_NUMBER() OVER() as rn, $computerUserName.items.* FROM $computerUserName.items) where rn between $offset and $variable";
                //$query = "Select * from $computerName.items limit".$rowsperpage."offset$offset";
                $stmt = db2_prepare($connection, $query);
                //$stmt2 = db2_prepare($connection, $query2);
                $result = db2_execute($stmt);
                //$result2 = db2_execute($stmt2);
                if ($stmt) {
                    while ($row = db2_fetch_array($stmt)) {
                        //$query2 = "select * from(Select ROW_NUMBER() OVER() as rn, $computerUserName.bids.* FROM $computerUserName.bids) where rn between $offset and $variable";
                        $query2 = "Select highest_bid_amount, number_of_bids from $computerUserName.bids where item_id =".$row[1];
                        $stmt2 = db2_prepare($connection, $query2);
                        $result2 = db2_execute($stmt2);

                        $row2 = db2_fetch_array($stmt2);
                        echo "<tr>";
                        echo "<td><image src='" . $row[8] . "' width = 175 height = 175 </image></a></td>";
                        echo "<td><a href=\"product.php?id=" . $row[1] . "\">" . $row[2] . "</a></td>";
                        echo "<td>".$row2[0]."</td>";
                        echo "<td>".$row2[1]."</td>";
                        echo "</tr>";
                      
                    }
                }
                

                /*                 * ****  build the pagination links ***** */
                // range of num links to show
                $range = 3;

                //if not on page 1, dont show back links

                if ($currentpage > 1) {
                    //show << to go back pages
                    echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=1'><<</a> ";
                    // get previous page num
                    $prevpage = $currentpage - 1;
                    // show < link to go back to 1 page
                    echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'><</a> ";
                }//end if
                // loop to show links to range of pages around current page
                for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
                    // if it's a valid page number...
                    if (($x > 0) && ($x <= $totalpages)) {
                        // if we're on current page...
                        if ($x == $currentpage) {
                            // 'highlight' it but don't make a link
                            echo " [<b>$x</b>] ";
                            // if not current page...
                        } else {
                            // make it a link
                            echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a> ";
                        } // end else
                    } // end if 
                }//end for 
                // if not on last page, show forward and last page links        
                if ($currentpage != $totalpages) {
                    // get next page
                    $nextpage = $currentpage + 1;
                    // echo forward link for next page 
                    echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>></a> ";
                    // echo forward link for lastpage
                    echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>>></a> ";
                } // end if
                /*                 * **** end build pagination links ***** */
                ?>
            </table>
            <script>$('#tabledata').dynatable();
</script>
            <div class="tfclear"></div>
        </div>
    </body>
</html>

