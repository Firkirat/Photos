<!-- register.php -->
<?php
include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newUsername = $_POST["new_username"];
    $newPassword = $_POST["new_password"];

 
    $checkUsername = "SELECT * FROM users WHERE username = '$newUsername'";
    $result = $conn->query($checkUsername);

    if ($result->num_rows > 0) {
        echo "Username already taken. Try again.";
    } else {

        $insertUser = "INSERT INTO users (username, password) VALUES ('$newUsername', '$newPassword')";
        if ($conn->query($insertUser) === TRUE) {
            echo "Registration successful. Now try to log in.";
        } else {
            echo "Error: " . $insertUser . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
