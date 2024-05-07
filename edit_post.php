<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: post.php");
}

include 'koneksi.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $query = "SELECT * FROM posts WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $judul = $row['judul'];
        $kategori_id = $row['kategori_id'];
        $petugas_id = $row['petugas_id'];
        $isi = $row['isi'];
        $status = $row['status'];
    } else {
        echo "Post not found!";
        exit();
    }
} else {
    echo "Invalid request!";
    exit();
}

if(isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $status = $_POST['status'];
    $kategori_id = $_POST['kategori'];
    $petugas_id = $_POST['petugas'];
    $isi = $_POST['isi'];
    
    $query = "UPDATE posts SET judul=?, status=?, kategori_id=?, petugas_id=?, isi=? WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssissi", $judul, $status, $kategori_id, $petugas_id, $isi, $id);
    
    if($stmt->execute()) {
        header("Location: post.php");
        exit();
    } else {
        echo "Failed to update post!";
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
                        <h1 class="h3 font-weight-bold mb-0 text-gray-800">Edit Post</h1>
                    </div>
                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Body -->
                                <div class="card-body">
                                    <form method="POST">
                                        <div class="form-group">
                                            <label class="m-2 font-weight-bold text-primary" for="judul">Judul</label>
                                            <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $judul; ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label class="m-2 font-weight-bold text-primary" for="kategori">Kategori</label>
                                            <select class="form-control" id="kategori" name="kategori" required>
                                                <option value="">Pilih Kategori</option>
                                                <?php 
                                                $sql = mysqli_query($conn, "SELECT * FROM kategori") or die (mysqli_error($conn));
                                                while ($data = mysqli_fetch_array($sql)) {
                                                    $selected = ($data['id'] == $kategori_id) ? "selected" : "";
                                                    echo '<option value="'.$data['id'].'" '.$selected.'>'.$data['judul'].'</option>';
                                                } 
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="m-2 font-weight-bold text-primary" for="isi">Isi</label>
                                            <textarea class="form-control" id="isi" name="isi" rows="5" required><?php echo $isi; ?></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label class="m-2 font-weight-bold text-primary" for="petugas">Petugas</label>
                                            <select class="form-control" id="petugas" name="petugas" required>
                                                <option value="">Pilih petugas</option>
                                                <?php 
                                                $sql = mysqli_query($conn, "SELECT * FROM petugas") or die (mysqli_error($conn));
                                                while ($data = mysqli_fetch_array($sql)) {
                                                    $selected = ($data['id'] == $petugas_id) ? "selected" : "";
                                                    echo '<option value="'.$data['id'].'" '.$selected.'>'.$data['username'].'</option>';
                                                } 
                                                ?>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="m-2 font-weight-bold text-primary" for="status">Status</label>
                                            <select class="form-control" id="status" name="status" required>
                                                <option value="">Pilih Status</option>
                                                <option value="publish" <?php if($status == 'publish') echo 'selected'; ?>>Publish</option>
                                                <option value="draft" <?php if($status == 'draft') echo 'selected'; ?>>Draft</option>
                                            </select>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary" name="submit">Edit Data</button>
                                        <a href="post.php" class="btn btn-secondary">Cancel</a>
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