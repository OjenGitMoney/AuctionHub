
<?php
session_start();

    include 'config.php';

    if( isset($_POST["submit"]) ) {

        $conn = db2_connect( $dbname, $username, $password);

        if($conn){
            
            $itemName = $_POST['itemName'];
            $itemDescription = $_POST['itemDescription'];
            $itemPrice = $_POST['itemPrice'];
            $condition = $_POST['condition'];
           
            $poster_email = $_SESSION['username'];
            
    $imageStore = './imageStore';
    $stat = @stat($imageStore);
    if (!$stat) {
        if (!mkdir($imageStore, 0777, true)) {
            die('not make '.$imageStore);
        }
    }
    
    // unique filename
    // Check file is image
    $uploadOk = 1;
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["img_upload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "Not image file.";
            return;
        }
    }
    
    $imageFileType = pathinfo(basename($_FILES["img_upload"]["name"]))['extension'];
    $filename = uniqid('IMG_');
    $storedImage = $imageStore . '/' . $filename . '.' . $imageFileType;
    
    if ($uploadOk == 0) {
        echo "File was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["img_upload"]["tmp_name"], $storedImage) == 0) {
            echo "Error uploading file.";
        }
    }   

        if($_POST['time'] == 1){
            $endDate = date('m/d/Y' , strtotime('+0 day'));
            }
        if($_POST['time'] == 2){
            $endDate = date('m/d/Y' , strtotime('+1 days'));
            }
        if($_POST['time'] == 5){
            $endDate = date('m/d/Y' , strtotime('+4 day'));
            }
        if($_POST['time'] == 7){
            $endDate = date('m/d/Y' , strtotime('+6 days'));
            }

            $insertsql = "INSERT INTO ahmed.items 
            (name, description, post_price, end_date, image, condition, poster_email) 
            VALUES 
            ('$itemName','$itemDescription', '$itemPrice', '$endDate', clob('$storedImage'), '$condition', '$poster_email')";
     
            
            $stmt = db2_prepare($conn, $insertsql);

            if($stmt){
                $result = db2_execute($stmt);

                if($result){
                    echo "__Your Item Has Been Posted__";
                    db2_close($conn);
                }
                else {
                    db2_stmt_errormsg($stmt);
                    db2_close($conn);
                }
            }
        }
    }
?>