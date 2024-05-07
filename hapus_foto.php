<?php
// Panggil file koneksi.php untuk melakukan koneksi ke database
include 'koneksi.php';

// Cek apakah parameter ID tersedia dalam POST
if(isset($_GET['id'])) {
    // Ambil ID yang dikirimkan melalui parameter POST
    $id = $_GET['id'];
    
    // Ambil ID galeri foto yang akan dihapus
    $query = "SELECT galery_id FROM foto WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $galery_id = $row['galery_id'];
    
    // Query untuk menghapus data dari tabel "foto"
    $sql = "DELETE FROM foto WHERE id = $id";
    
    // Eksekusi query
    if ($conn->query($sql) === TRUE) {
        // Redirect kembali ke halaman utama dengan memunculkan ID galeri
        header("Location: detail_galeri.php?id=$galery_id&deleted_id=$id");
        exit(); // Hentikan eksekusi skrip setelah melakukan redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "ID tidak ditemukan";
}

// Tutup koneksi
$conn->close();
?>