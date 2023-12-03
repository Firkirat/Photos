<?php
include("database.php");

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$userID = $_SESSION['user_id'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $targetDir = "Photos/";
    $targetFile = $targetDir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

   
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if ($check === false) {
        echo "File should be an image.";
        $uploadOk = 0;
    }

  
    if (file_exists($targetFile)) {
        echo "File Already Exists.";
        $uploadOk = 0;
    }


    if ($_FILES["photo"]["size"] > 500000) {
        echo "File Too Large.";
        $uploadOk = 0;
    }

    if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
        echo "Only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }


    if ($uploadOk == 0) {
        echo "File was not uploaded.";
    } else {
      
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
         
            $photoPath = $targetFile;
            $insertPhoto = "INSERT INTO photos (user_id, photo_path) VALUES ('$userID', '$photoPath')";
            
            if ($conn->query($insertPhoto) === TRUE) {
                echo "The file " . htmlspecialchars(basename($_FILES["photo"]["name"])) . " has been uploaded.";
            } else {
                echo "Error: " . $insertPhoto . "<br>" . $conn->error;
            }
            
        } else {
            echo "Error uploading your file.";
        }
        if (file_exists($targetFile)) {
            echo "File successfully moved to: " . $targetFile;
        } else {
            echo "File move failed. Destination path: " . $targetFile;
        }
        
    }
}

$conn->close();
header("Location: dashb.php"); 
?>

