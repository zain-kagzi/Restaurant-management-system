<?php
include('connection.php');
if (isset($_POST['adddish'])) {
    // Directory where the image will be uploaded
    $uploadDir = "img/";

    // Check if the directory exists, if not, create it
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    $query_1="select image_path from menu_items";
$queryy=mysqli_query($con,$query_1);
$num=mysqli_num_rows($queryy);
    // Getting file details
    $fileName = basename($_FILES["image"]["name"]);
    $targetFilePath = $uploadDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    while($result=mysqli_fetch_array($queryy)){
        if($result['image_path'] == $targetFilePath){
            echo "<script>alert('image already in the database!!')</script>";
            echo '<script> window.location.href = "admindish.php";</script>';
            exit();
        }
    }

    // Allowed file types
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

    // Validate file type
    if (in_array($fileType, $allowedTypes)) {
        // Move the uploaded file to the server directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            $name=mysqli_real_escape_string($con,$_POST['name']);

                $type=mysqli_real_escape_string($con,$_POST['type']);
                $type = strtolower($type);
                $price=mysqli_real_escape_string($con,$_POST['price']);

                $query= "INSERT INTO menu_items(name, type, image_path, price) VALUES ('$name', '$type', '$targetFilePath', '$price')";
                $res=mysqli_query($con,$query);
                if($res){
                    echo '<script>alert("New Dishes Added Successfully!!")</script>';
                    echo '<script> window.location.href = "admindish.php";</script>';                }
                
        } else {
            echo "Error uploading the file.";
        }
    } else {
        echo '<script>alert("Cant upload this type of image")</script>';
            echo '<script> window.location.href = "adddsihes.php";</script>';  
    }
} else {
    echo "No file uploaded.";
}
?>

