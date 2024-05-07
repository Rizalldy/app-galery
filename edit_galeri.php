<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: post.php");
}

include 'koneksi.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $query = "SELECT * FROM galery WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $post_id = $row['post_id'];
        $position = $row['position'];
        $status = $row['status'];
       
    } else {
        echo "Galeri tidak di Temukan";
        exit();
    }
} else {
    echo "Gagal";
    exit();
}

if(isset($_POST['submit'])) {
    $position = $_POST['position'];
    $status = $_POST['status'];
    $post_id = $_POST['posts'];
    
    $query = "UPDATE galery SET post_id=?, status=?, position=? WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("issi", $post_id, $status, $position, $id);
    
    if($stmt->execute()) {
        header("Location: galeri.php");
        exit();
    } else {
        echo "Gagal untuk Mengedit Galeri";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SMK 1 TRIPLE J</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/tj.png">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include 'sidebar.php'; ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php include 'navbar.php'; ?>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 font-weight-bold mb-0 text-gray-800">Edit Galeri</h1>
                    </div>
                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Body -->
                                <div class="card-body">
                                    <form method="POST">
                                    <div class="form-group">
                                            <label class="m-2 font-weight-bold text-primary" for="posts">Post</label>
                                            <select class="form-control" id="posts" name="posts" required>
                                                <option value="">Pilih Post</option>
                                                <?php 
                                                $sql = mysqli_query($conn, "SELECT * FROM posts") or die (mysqli_error($conn));
                                                while ($data = mysqli_fetch_array($sql)) {
                                                    $selected = ($data['id'] == $post_id) ? "selected" : "";
                                                    echo '<option value="'.$data['id'].'" '.$selected.'>'.$data['judul'].'</option>';
                                                } 
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="m-2 font-weight-bold text-primary" for="position">Position</label>
                                            <input type="text" class="form-control" id="position" name="position" value="<?php echo $position; ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label class="m-2 font-weight-bold text-primary" for="status">Status</label>
                                            <select class="form-control" id="status" name="status" required>
                                                <option value="">Pilih Status</option>
                                                <option value="1" <?php if($status == '1') echo 'selected'; ?>>Aktif</option>
                                                <option value="0" <?php if($status == '0') echo 'selected'; ?>>Tidak Aktif</option>
                                            </select>
                                        </div>


                                        <button type="submit" class="btn btn-primary" name="submit">Edit Data</button>
                                        <a href="galeri.php" class="btn btn-secondary">Cancel</a>
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>