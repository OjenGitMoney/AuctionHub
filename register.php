<?php

include 'nav.php';
?>
<html>
<head>
<title>Register</title>

   
<link rel=\"stylesheet\" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

<style type="text/css">
    
    #registerForm {
        margin-top: 10%;
        margin-left: 25%;
    }

    input{
        margin-top:15px;
    }

    span {
        padding-left: 5px;
        width: 100px;
    }

    .effect
        {
            width: 700px;
            height: 300px;
            position: relative;
            box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
            border-radius: 10px;
            left:25%;
        
            
        }
        .effect:before, .effect:after
        {
            content:"";
            position:relative; 
            z-index:-1;
            box-shadow:0 0 20px rgba(0,0,0,0.8);
            top:0;
            bottom:0;
            left:1px;
            right:1px;
            border-radius: 10px;
        } 
        .effect:after
        {
            right:10px; 
            left:auto; 
            transform:skew(8deg) rotate(3deg);
            border-radius: 10px;
        }

</style>
</head>
<body>
    
    <div class ="effect">
    <form id="registerForm"action="registerSubmit.php" method="POST">
    
    <table>
        <tr>
            <td>
                <input type="text" name="fname" placeholder="First name" class="form-control" autofocus required>
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" name="lname" placeholder="Last name" class="form-control" required>
            </td>  
        </tr>
        <tr>
            <td>
                <input type="email" name="username" id="user_email" placeholder="Username(email)"  class="form-control"onkeypress="EmailCheck();" required >
            </td>
            <td>
                <span id = "email_status"> </span>
            </td> 
        </tr>
        <tr>
            <td>
                <input type="password" name="password" placeholder="Password" class="form-control" required><br>
            </td>
        </tr>
        <tr>
            <td>
                <input class='btn btn-primary' type="submit" value="Submit">
                <input class='btn btn-default' type="button" value="Clear" onclick="clearForm()" style="margin-left:10px;">
            </td>
        </tr>
    </table>
    </form>
    </div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">

function EmailCheck(){

    $('#user_email').keyup(function() {
    var username = $(this).val();

    $('#email_status').text('Checking database...');

    if(username != ''){
        $.post('checkemail.php',{ username: username }, function(data) {
            $('#email_status').text(data);
        });
    } else {
        $('#email_status').text('');
    }

    });
}

function clearForm(){
    document.getElementById('registerForm').reset();

}
</script>

</body>

</html>


