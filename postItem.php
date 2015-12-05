
<html>
  <head>
    <title>Post Item to sell</title>
    
    <link rel="stylesheet" href="resources/bootstrap-3.3.5/css/bootstrap.min.css"/>
    <!-- Optional theme -->
    <link rel="stylesheet" href="resources/bootstrap-3.3.5/css/bootstrap-theme.min.css"/>


    <style type ='text/css'>
    input[name=itemDescription]{
       
      text-align: top;
    }
    #itemPrice{
       
      width: 100px;
    }
    
    table td {
      padding: 10px;
    }
    #clear{
      margin-left: 2px;
    }
    </style>

  
  </head>
  <body>
    
  <nav>
  <?php include ('nav.php'); ?>
  </nav>

    <DIV align="center">
      <FORM id="postItemForm" name="postItemForm" method="POST" action="post-item.php" enctype="multipart/form-data">
        <TABLE>
          <tr>
            <TD>
              Item Name : 
            </TD>
            <TD>
                <input class="form-control" type='text' name='itemName' autofocus required></input>
            </TD>
          </tr>

          <TR  >
            <TD valign="top">
              Product Description : 
            </TD>
            <TD>
                <TEXTAREA ROWS="8" class="form-control" name='itemDescription' required></TEXTAREA>  
            </TD>
          </TR>

          <TR>
            <TD>
              Starting Price :
            </TD>
            <TD>
              <div class="form-group">
                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                  <div class="input-group">
                    <div class="input-group-addon">$</div>
                      <input type="text" class="form-control" id="itemPrice" name='itemPrice'>
                      <div class="input-group-addon">.00</div>
                    </div>
              </div>
            </TD>
          </TR>

          <TR>
            <TD>
              Condition of Item :
            </TD>
            <TD>
              <label class="radio-inline"><input type="radio" name="condition" value="Excellent">Excellent</label>
                <label class="radio-inline"><input type="radio" name="condition" value="Good">Good</label>
                <label class="radio-inline"><input type="radio" name="condition" value="Average">Average</label>
                <label class="radio-inline"><input type="radio" name="condition" value="Poor">Poor</label>
            </TD>
          </TR>

          <TR>
            <TD>
              Days to put for Auction :
            </TD>
            <TD>
              <select class="form-control">
                <option name='time' value='1'>1</option>
                <option name='time' value='2'>2</option>
                <option name='time' value='5'>5</option>
                <option name='time' value='7'>7</option>
              </select>
            </TD>
          </TR>

          <TR>
            <TD>
              Upload Image :
            </TD>
            <TD>
                <input type="file" name="fileToUpload" id="fileToUpload" multiple>
              
            </TD>
          </TR>
          </TABLE>

          <DIV style="margin-top:30px">
            <input class='btn btn-primary' id='submit' type='submit' name='submit' value='Post Item'/>
            <input class='btn btn-default' type="button" id='clear' value="Clear" onclick="clearForm()">
          </DIV> 
      </FORM>
     </DIV> 

    <script type="text/javascript">
    
    function clearForm(){
    document.getElementById('postItemForm').reset();
    }
    </script>
    <script src="resources/jquery-1.11.3.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="resources/bootstrap-3.3.5/js/bootstrap.min.js"></script>
  </body>
</html>