

<?php
    include 'config.php';

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image

    if( isset($_POST["submit"]) ) {

        $conn = db2_connect( $dbname, $username, $password);

        if($conn){
            
            $itemName = $_POST['itemName'];
            $itemDescription = $_POST['itemDescription'];
            $itemPrice = $_POST['itemPrice'];
            $quality = $_POST['quality'];
            $img = $_POST['img_upload'];
            
            $insertsql = "INSERT INTO ".$computerName.".USERS (item, description, price, quality, time) VALUES ('$item',
                '$description', '$price', '$quality', '$img')";
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