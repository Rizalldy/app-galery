<?php 
 
include 'koneksi.php';
 
error_reporting(0);
 
session_start();
 
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
}
 
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = ($_POST['password']);
 
    $sql = "SELECT * FROM petugas WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        header("Location: dashboard.php");
    } else {
        echo "<script>alert('Username atau password Anda salah. Silahkan coba lagi!')</script>";
    }
}
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/tj.png">
    <title>Login</title>
</head>

<body class="bg-gradient-primary">

<div class="m-3 d-flex justify-content-center">
<div class="col-lg-5">
    <div class="card shadow mt-3"> 
        <div class="card-body p-5">
        <div class="text-center mb-5">
        <h1><b>Login</b></h1>
        </div>
        <form class="user" method="POST">
            <input type="text" class="form-control form-control-user" placeholder="Masukan Username" name="username" value="<?php echo $username; ?>" required><br>
            <input type="password" class="form-control form-control-user" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required><br>
            <button class="col-lg btn btn-user btn-primary" name="submit">Log in</button>
        </form>

        </div>
    </div>  
</div>
</div>
</body>
</html>