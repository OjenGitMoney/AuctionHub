<?php

require_once('nav.php');
require_once('config.php');
$connection = db2_connect($dbname, $username, $password);
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

        <link rel="stylesheet" type="text/css" href="resources/bootstrap-select/dist/css/bootstrap-select.min.css">
        
        <style type="text/css">
            /* Fixes submit button height problem in Firefox */
            .tfbutton::-moz-focus-inner {
                border: 0;
            }
            .tfclear{
                clear:both;
            }

            #container{
                padding-left: 15px;
                padding-right: 15px;
            }
            
            .form-control{
                width : 15em;
            }
            #datatable{
                background-color: #FFFFFF;
            }


        </style>

        <script type="text/javascript" src="resources/jquery-1.11.3.js"></script>
        <script type="text/javascript" src="resources/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

    </head>
    <body>

        <!-- HTML for SEARCH BAR -->


        <div id="container">



            <table class="table table-striped table-bordered table-hover  table-condensed" id="datatable">
                
                <nav>
                    <ul class="pagination">

                        <tr>
                            <th>Image</th>
                            <th>Item</th>
                            <th>Current Bid</th>
                            <th>Number of Bids</th>
                        </tr>
                        <?php
                        //find out how many rows are in the table
                        $numRows = "Select Count(*) from  $computerName.items";
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




                        //FILTERATION
                        if(isset($_POST['select_name'])) {
                            if($_POST['select_name'] == 'plowest'){
                                 $query = "select * from(Select ROW_NUMBER() OVER(ORDER BY POST_PRICE ASC) as rn, $computerName.items.* FROM $computerName.items) where rn between $offset and $variable";
                            }
                            else if($_POST['select_name'] == 'phighest'){
                               $query = "select * from(Select ROW_NUMBER() OVER(ORDER BY POST_PRICE DESC) as rn, $computerName.items.* FROM $computerName.items) where rn between $offset and $variable";
                            }
                            else if($_POST['select_name'] == 'endingsoon'){
                               $query = "select * from(Select ROW_NUMBER() OVER(ORDER BY END_DATE ASC) as rn, $computerName.items.* FROM $computerName.items) where rn between $offset and $variable";
                            }
                            else if($_POST['select_name'] == 'newlylisted'){
                               $query = "select * from(Select ROW_NUMBER() OVER(ORDER BY END_DATE DESC) as rn, $computerName.items.* FROM $computerName.items) where rn between $offset and $variable";
                            }
                            else{
                             $query = "select * from(Select ROW_NUMBER() OVER() as rn, $computerName.items.* FROM $computerName.items) where rn between $offset and $variable";

                            }
                        }
                        //IF NOT FILTER IS SELECTED
                        else{
                        $query = "select * from(Select ROW_NUMBER() OVER() as rn, $computerName.items.* FROM $computerName.items) where rn between $offset and $variable";
                        }                        
                        $stmt = db2_prepare($connection, $query);
                        $result = db2_execute($stmt);
                        if ($stmt) {
                            while ($row = db2_fetch_array($stmt)) {
                                //$query2 = "select * from(Select ROW_NUMBER() OVER() as rn, $computerName.bids.* FROM $computerName.bids) where rn between $offset and $variable";
                                $query2 = "Select highest_bid_amount, number_of_bids from $computerName.bids where item_id =" . $row[1];
                                $stmt2 = db2_prepare($connection, $query2);
                                $result2 = db2_execute($stmt2);

                                $row2 = db2_fetch_array($stmt2);
                                echo "<tr>";
                                echo "<td><center><a href=\"product.php?id=" . $row[1] . "\"><image src='" . $row[8] . "' width = 175 height = 175 </image></a></center></td>";
                                echo "<td><center><a href=\"product.php?id=" . $row[1] . "\">" . $row[2] . "</a></center></td>";
                                echo "<td>" . $row2[0] . "</td>";
                                echo "<td>" . $row2[1] . "</td>";
                                echo "</tr>";
                            }
                        }


                        /*                         * ****  build the pagination links ***** */
                        // range of num links to show
                        $range = 2;

                        //if not on page 1, dont show back links
                        ?>
                        
                        <!--drop down menu-->
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method='post' name='form_filter' >
                                    Filter By:
                                    <select name ="select_name" class="form-control">
                                        <option value = "default">...</option>
                                        <option value = "plowest">Price Lowest</option>
                                        <option value = "phighest">Price Highest</option>
                                        <option value ="endingsoon">Ending Soon</option>
                                        <option value = "newlylisted">Newly Listed</option>
                                    </select>
                                    <input type='submit' value = 'Filter'>
                            </form>

                        <nav>
                            <ul class="pagination">
                                <?php
                                if ($currentpage > 1) {
                                    //show << to go back pages
                                    // echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=1'><<</a> ";
                                    echo"<li class='enabled'><a href='{$_SERVER['PHP_SELF']}?currentpage=1' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>";


                                    // get previous page num
                                    $prevpage = $currentpage - 1;
                                    // show < link to go back to 1 page
                                    //echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage' ><</a> ";
                                }//end if
                                // loop to show links to range of pages around current page
                                for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
                                    // if it's a valid page number...
                                    if (($x > 0) && ($x <= $totalpages)) {
                                        // if we're on current page...
                                        if ($x == $currentpage) {
                                            // 'highlight' it but don't make a link
                                            //echo " [<b>$x</b>] ";

                                            echo"<li class='active'><a href='$x'>$x <span class='sr-only'>(current)</span></a></li>";

                                            // if not current page...
                                        } else {
                                            // make it a link
                                            //echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a> ";
                                            echo"<li><a href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a></li>";
                                        } // end else
                                    } // end if 
                                }//end for 
                                // if not on last page, show forward and last page links        
                                if ($currentpage != $totalpages) {
                                    // get next page
                                    $nextpage = $currentpage + 1;
                                    // echo forward link for next page 
                                    // echo forward link for lastpage
                                    //echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>>></a> ";
                                    echo"<li> <a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages' aria-label='Next'><span aria-hidden='true'>&raquo;</span> </a>";
                                } // end if
                                /*                                 * **** end build pagination links ***** */
                                ?>
                                </table>

                                
                            </ul>

                        </nav>
                        
                        </div>
                        
                        <script type="text/javascript">
                            
                            $(function() {
                                //$('.selectpicker').selectpicker();
                            });

                        </script>
    </body>
</html>
