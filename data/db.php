<?php
$baglanti = "localhost";
$kullanici = "root";
$sifre = "";
$veritabani = "test";
$port = 3307; // Buraya kendi MySQL portunu yazabilirsin

$db = mysqli_connect($baglanti, $kullanici, $sifre, $veritabani, $port);

/*if(!$db) {
    die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
} else {
    echo "Bağlantı başarılı";
}*/
?>
