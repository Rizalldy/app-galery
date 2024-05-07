<?php 
session_start();
 
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
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

    <title>Galeri</title>

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

                <!-- Topbar -->
                <?php
                include 'navbar.php'
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 font-weight-bold mb-0 text-gray-800">Detail Galeri</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                    <div class="col-12 col-md">
                    <div class="card shadow mb-3 col-md">
                        <div class="card-body">
                            
                            <?php 
                            include 'koneksi.php';
                            // Pastikan $_GET['id'] memiliki nilai
                            if(isset($_GET['id'])) {
                                $id = $_GET['id'];
                                $query = "SELECT galery.*, posts.judul AS nama_posts, posts.created_at AS created_at FROM galery JOIN posts ON galery.post_id = posts.id WHERE galery.id = '$id'";
                                $data = mysqli_query($conn, $query);
                                if(mysqli_num_rows($data) > 0) {
                                    $d = mysqli_fetch_array($data);
                                    $post_id = $d['post_id'];
                                    $position = $d['position'];
                                    $status = $d['status'];
                                    // Lanjutkan ke bagian tampilan
                            ?>
                        <table class="table text-sm">
                            <div>
                                <tr>
                                    <td>Judul</td>
                                    <td>:</td>
                                    <td> <?php echo $d['nama_posts']; ?></td>
                                </tr>
                               
                                <tr>
                                    <td>Posisi</td>
                                    <td>:</td>
                                    <td><?php echo $d['position']; ?></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>:</td>
                                    <td>
                                    <?php
                                    $status = $d['status'];
                                    if ($status == '1') {
                                    echo '<span class="p-2 badge bg-success text-light">Aktif</span>';
                                    } elseif ($status == '0') {
                                    echo '<span class="p-2 badge bg-primary text-light">Tidak Aktif</span>';
                                    }
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tanggal dibuat</td>
                                    <td>:</td>
                                    <td><?php echo date('l, F Y', strtotime($d['created_at'])); ?></td>
                                </tr>
                                </div>
                                <?php 
                                }
                            }
                                ?>
                           </table>
                        </div>    
                    </div>
                    <a href="galeri.php" class="btn btn-secondary mt-2">
                                        <span class="text">Kembali</span>
                                    </a>
                    </div>

                    
                    <div class="col-12 col-md" >
                        <div class="card shadow mb-3">
                            <div class="card-header bg-primary text-light d-flex justify-content-between align-item-center">
                                <h6 class="m-1 p-1"><i class="fa fa-image mr-1"></i>Foto</h6>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addImageModal">
                                + Foto
                                </button>
                            </div>
                            <div class="card-body">
                                
                            <!-- Button trigger modal -->
                                

                            <?php
                            if(isset($_GET['id'])) {
                                $id = $_GET['id'];
                                $query = "SELECT * FROM foto WHERE galery_id = '$id'";
                                $datafoto = mysqli_query($conn, $query);
                                ?>
                                <div class="row"> <!-- Mulai baris di sini -->
                                <?php
                                while ($row = mysqli_fetch_array($datafoto)){
                                    ?>
                                    <div class="col-mr-3 m-1"> <!-- Menggunakan kolom lebar md-3 (25% width) untuk setiap foto -->
                                        <div class="card "> <!-- Tambahkan margin bawah (mb-3) pada setiap card -->
                                            <img src="uploads/<?php echo $row['file'] ?>" class="img-thumbnail" style="height:100px" alt="<?php echo $row['galery_id']; ?>">
                                            <a href="hapus_foto.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-md mt-2" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                </div> <!-- Tutup baris di sini -->
                                <?php
                            }
                            ?>

                                <!-- Modal -->
                                <div class="modal fade" id="addImageModal" tabindex="-1" role="dialog" aria-labelledby="addImageModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <form action="add_foto.php" method="POST" enctype="multipart/form-data" class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addImageModalLabel">Tambah Foto</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                
                                        <div class="modal-body text-dark">
                                                <input type="hidden" name="galery_id" value="<?php echo $id ?>">

                                                <div class="mb-3">
                                                    <label for="title">Judul</label>
                                                    <input type="text" class="form-control" id="title" name="title" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="file">Foto</label>
                                                    <input type="file" class="form-control" id="file" name="file" required>
                                                </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                    </div>
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

    <script>
        // Panggil modal saat tombol ditekan
        document.getElementById('addImageButton').addEventListener('click', function() {
            $('#addImageModal').modal('show');
        });
    </script>

</body>

</html>