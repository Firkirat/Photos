
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("database.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$userID = $_SESSION['user_id'];


$sql = "SELECT * FROM photos WHERE user_id = '$userID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $photoPath = $row['photo_path'];
       

        echo '<img src="' . $photoPath . '" alt="User Photo" style="max-width: 400px; margin: 10px;">';
    }
} else {
    echo "No photos found.";
}

$conn->close();
?>


