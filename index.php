<?php
require_once('connect.php');
require_once('nav.php');
require_once('config.php');
$connection = db2_connect($database, $dbusername, $dbpassword);
if(!$connection){
    die('Not connected : '.db2_conn_error());
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
               $numRows = "Select Count(*) from ".$computerName.".items";
               $stmt3 = db2_prepare($connection,$numRows);
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
               }
               else {
                    // default page num
                    $currentpage = 1;
                }

                // if current page is greater than total pages...
                if($currentpage > $totalpages){
                    //set current page to the last page
                    $currentpage = $totalpages;
                }
                //if current page is less less than the first page
                if($currentpage < 1){
                    //set current page to the first page
                    $currentpage = 1;
                }
                
                // the offset of the list, based on current page 
                $offset = ($currentpage - 1) * $rowsperpage;

                //get the info from the database
                
               $query = "Select * from(Select * ROW_NUMBER() OVER(ORDER BY NAME DESC) AS row_number "
                       . "from $computerUserName.items) AS emp where emp.row_number>10"
                       . " AND emp.row_number<=20";
     

               $stmt = db2_prepare($connection,$query);
                $result = db2_execute($stmt);
               
               if($stmt){
                   
                   while($row = db2_fetch_array($stmt)){
                       echo "<tr>";
		       echo "<td><image src='" . $row[7] . "' width = 175 height = 175 </image></a></td>"; 
                       echo "<td><a href=\"product.php?id=".$row[0]."\">".$row[1]."</a></td>";
                       echo "<td> Hello</td>";
                       echo "<td> Hello</td>";												
		       echo "</tr>";
                    }      
               }
               /******  build the pagination links ******/
               // range of num links to show
                $range = 3;
                
                //if not on page 1, dont show back links
                if($currentpage > 1){
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
/****** end build pagination links ******/
               ?>
            </table>
            <div class="tfclear"></div>
        </div>
    </body>
</html>

