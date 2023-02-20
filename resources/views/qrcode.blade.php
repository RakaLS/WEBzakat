<?php
require 'vendor/autoload.php'; // import library QR Code Generator

// koneksi ke database MySQL
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "per_zakat";
$conn = new mysqli($servername, $username, $password, $dbname);

// mendapatkan data dari database
$sql = "SELECT * FROM data_pembayaran";
$result = $conn->query($sql);

// membuat folder untuk menyimpan QR code jika belum ada
if (!file_exists("C:\xampp\htdocs\landingPage\qr-code")) {
  mkdir("C:\xampp\htdocs\landingPage\qr-code", 0777, true);
}

// loop untuk membuat QR code untuk setiap baris data
while ($row = $result->fetch_assoc()) {
  $id = $row["id"];
  $resi = $row["resi"];
  $nama = $row["nama"];
  $alamat = $row["alamat"];
  $notelp = $row["noTelp"];
  $gender = $row["jenisKelamin"];
  $jumlah = $row["jumlah"];

  // menggabungkan id, nama, dan alamat ke dalam satu string
  $data = $id . "," . $resi . "," . $nama . "," . $alamat . "," . $notelp . "," . $gender . "," . $jumlah;

  // membuat gambar QR code dari data
  $qrCode = new \QR_Code\QR_Code($data);
  $image = $qrCode->get_image(10);

  // menentukan nama file gambar dan lokasi untuk menyimpan
  $fileName = $nama . ".jpg";
  $filePath = "C:\xampp\htdocs\landingPage\qr-code" . $fileName;

  // menyimpan gambar QR code
  imagejpeg($image, $filePath);
}

$conn->close();
?>

