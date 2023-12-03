
<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Manage Photo</title>
</head>
<body>
    <div class="Box">
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>

        
        <?php include("picture_adder.php"); ?>

  
        <?php include("display_photos.php"); ?>
    </div>
</body>
</html>
