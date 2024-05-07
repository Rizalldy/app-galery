<?php
// Sertakan file koneksi
include 'koneksi.php';

// Pastikan tombol submit ditekan
if(isset($_POST['submit'])) {
    // Ambil data dari form
    $galery_id = $_POST['galery_id'];
    $judul = $_POST['title'];

    // Proses unggah gambar
    $file = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];

    // Tentukan folder penyimpanan
    $upload_dir = "uploads/";

    // Pindahkan file yang diunggah ke folder tujuan
    move_uploaded_file($file_tmp, $upload_dir.$file);

    // Simpan data ke database
    $query = "INSERT INTO foto (galery_id, file, judul) VALUES ('$galery_id', '$file', '$judul')";
    if(mysqli_query($conn, $query)) {
        echo "<script>alert('Foto Berhasil di Tambahkan')</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }

    // Tutup koneksi
    mysqli_close($conn);
    header("location: detail_galeri.php?id=$galery_id");  
}
?>