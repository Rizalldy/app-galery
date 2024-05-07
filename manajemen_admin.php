<?php
include 'koneksi.php';

error_reporting(0);

session_start();
 
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = ($_POST['password']);
    $cpassword = ($_POST['cpassword']);

 
    if ($password == $cpassword) {
        $sql = "SELECT * FROM petugas WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        if (!$result->num_rows > 0) {
            $sql = "INSERT INTO petugas (username, password)
                    VALUES ('$username', '$password')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>alert('Selamat, registrasi berhasil!')</script>";
                $username = "";
                $_POST['password'] = "";
                $_POST['cpassword'] = "";
            } else {
                echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
            }
        } else {
            echo "<script>alert('Woops! Username Sudah Terdaftar.')</script>";
        }
         
    } else {
        echo "<script>alert('Password Tidak Sesuai')</script>";
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

    <title>Management Admin</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/tj.png">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        
    <?php
    include 'sidebar.php'
    ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php
                include 'navbar.php';
                include 'modal.php'
                ?>    

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 font-weight-bold mb-0 text-gray-800">Management Admin</h1>
                    </div>
                    
                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Body -->
                                <div class="card-body">
                                    <a href="#" class="btn btn-primary btn-md mb-3" data-toggle="modal" data-target="#maModal">+ Admin</a> 
                                        <div class="table-responsive">
                                            <table class="table">
                                            <thead class="table-dark">
                                                <tr>
                                                    
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>

                                            <?php
                                            $q = $conn->query("SELECT * FROM petugas");
                                            $no = 1;
                                            while ($d = $q->fetch_assoc()) :
                                            ?>
                                            <tbody>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $d['username']?></td>
                                                <td>
                                                    <a href="hapus_pet.php?id=<?php echo $d['id']; ?>"class="btn btn-danger btn-md mb-3" onclick="return confirm('Yakin untuk menghapus data ini?')">
                                                <i class="fas fa-trash"></i>
                                                </a>
                                                </td>
                                                <?php endwhile;?>
                                            </tr>
                                            
                                            </tbody>
                                            </table>
                                        </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- form modal -->
    

    

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>