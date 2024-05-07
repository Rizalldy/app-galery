<?php 
 
session_start();
 
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}
 
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Berhasil Login</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm fixed-top">
        <div class="nav">
            <form method="POST" >
                <?php echo "<h1>Selamat Datang " . $_SESSION['username'] ."!". "</h1>"; ?>
                <div class="input-group">
                    <button><a href="logout.php">Logout</a></button>
                
                </div>
            </form>
        </div>
    </nav>
</body>
</html>