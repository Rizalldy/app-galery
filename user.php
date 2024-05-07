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

    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/tj.png">
</head>
<body>
    <div class="body">
        <!-- navbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar static-top shadow fixed-top">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <div class="nav-link">
                        <img class="m-3" width="55px" src="img/tj.png">
                        <div>
                            <h1 class="h3 font-weight-bold mb-0 text-gray-800">SMK INDONESIA DIGITAL</h1>
                            <h6 class="text-dark">maju seiring perkembangan digital</h6>
                        </div> 
                    </div>
                </li>
            </ul>
        </nav>

        <div class="container mt-5">
            
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php
                    include 'koneksi.php';
                    // Query untuk mengambil data foto dari database
                    $sql = "SELECT * FROM foto";
                    $result = $conn->query($sql);

                    $indicator_index = 0;
                    if ($result->num_rows > 0) {
                        // Loop melalui hasil query
                        while($row = $result->fetch_assoc()) {
                            echo '<li data-target="#carouselExampleIndicators" data-slide-to="' . $indicator_index . '" ' . ($indicator_index === 0 ? 'class="active"' : '') . '></li>';
                            $indicator_index++;
                        }
                    }

                    // Tutup koneksi database
                    $conn->close();
                    ?>
                </ol>
                <div class="carousel-inner">
                    <?php
                    // Membuat koneksi kembali untuk mendapatkan foto-foto
                    include 'koneksi.php';

                    // Query untuk mengambil data foto dari database
                    $sql = "SELECT * FROM foto";
                    $result = $conn->query($sql);

                    $active = true;
                    if ($result->num_rows > 0) {
                        // Loop melalui hasil query
                        while($row = $result->fetch_assoc()) {
                            echo '<div class="carousel-item ' . ($active ? 'active' : '') . '">';
                            echo '<img class="d-block w-100" style="width: 100%; height: 400px;object-fit: cover;" src="uploads/' . $row['file'] . '" alt="' . $row['judul'] . '">';
                            echo '<div class="carousel-caption d-none d-md-block">';
                            echo '<h5>' . $row['judul'] . '</h5>';
                            echo '</div>';
                            echo '</div>';
                            $active = false;
                        }
                    }
                    // Tutup koneksi database
                    $conn->close();
                    ?>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>


    <h2 class="text-center font-weight-bold mb-2 text-light bg-primary">Galeri Sekolah</h2>
    <div class="card">
        <div class="row card-body">
            <?php
        include 'koneksi.php';

        // Query untuk mengambil data foto dari database
            $sql = "SELECT posts.*, kategori.judul AS nama_kategori, petugas.username AS nama_petugas FROM posts JOIN kategori ON posts.kategori_id = kategori.id JOIN petugas ON posts.petugas_id = petugas.id";
            $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Loop melalui hasil query
            while($row = $result->fetch_assoc()) {
                echo '<div class="col mb-4">';
                echo '<h5 class="text-center font-weight-bold mb-2 text-dark">' . $row['nama_kategori'] . '</h5>';
                echo '<h5 class="text-center font-weight-bold mb-2 text-dark">' . $row['judul'] . '</h5>';
                echo '<div class="mt-2">';
                echo '<p>' . $row['isi'] . '</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "Ada kesalahan";
        }

        // Tutup koneksi database
        $conn->close();
        ?>

        
        </div>

    </div>
    <div class="row">
        <?php
        include 'koneksi.php';

        // Query untuk mengambil data foto dari database
            $sql = "SELECT * FROM foto";
            $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Loop melalui hasil query
            while($row = $result->fetch_assoc()) {
                echo '<div class="col-md-3 mb-4">';
                echo '<h5 class="text-center font-weight-bold mb-2 text-dark">' . $row['judul'] . '</h5>';
                echo '<img class="img-thumbnail" style="width: 100%; height: 200px;object-fit: cover;" src="uploads/' . $row['file'] . '" alt="' . $row['judul'] . '">';
                echo '<div class="mt-2">';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "Tidak ada gambar yang ditemukan.";
        }

        // Tutup koneksi database
        $conn->close();
        ?>
    </div>

    <div>
        <div class="row">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.287964129743!2d106.8643313737041!3d-6.4851699634033615!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c15f22b23331%3A0x152d0f1eb6ef7c6c!2s1TRIPLE%20J%20Professional%20School!5e0!3m2!1sen!2sid!4v1714977802415!5m2!1sen!2sid" width="900" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <div class="col ml-3">
            <h1 class="h3 font-weight-bold text-gray-800">Peta Sekolah</h1>
            <p class="text-dark">SMK 1 Triple J adalah sebuah sekolah SMK swasta yang beralamat di Jl. Landbow No.01 Karang Asem Barat Citeureup, Kab. Bogor.</p>
            </div>

        </div>
        
    </div>
    <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Muhammad Rizaldi 2024</span>
                    </div>
                </div>
            </footer>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="js/sb-admin-2.min.js"></script>
</body>
</html>
