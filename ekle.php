<?php
// Veritabanı bağlantısı
include("data/db.php");

// Form gönderildiyse işle
// Form gönderildiyse işle
if (isset($_POST['ekle'])) {
    $username = $db->real_escape_string($_POST['username']);
    $name = $db->real_escape_string($_POST['name']);

    // Kullanıcı adı zaten var mı kontrol et
    $kontrolSorgu = "SELECT * FROM users WHERE UserName = '$username'";
    $kontrolSonuc = $db->query($kontrolSorgu);

    if ($kontrolSonuc && $kontrolSonuc->num_rows > 0) {
        // Kullanıcı adı zaten varsa kullanici.php'ye yönlendir
        echo "<script>window.location.href='kullanıci.php';</script>";
        exit();
    } else {
        // Yeni kullanıcıyı ekle
        $ekleSorgu = "INSERT INTO users (UserName, Name) VALUES ('$username', '$name')";

        if ($db->query($ekleSorgu)) {
            echo "<script>window.location.href='index.php';</script>";
            exit();
        } else {
            echo "Hata: " . $db->error;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Ekle</title>
    <link rel="stylesheet" href="./styles/ekle.css">
</head>
<body>



    <nav class="card">
    <h2 class="h2">Kullanıcı Ekle</h2>
    <form method="POST" action="" class="eklet">

        <label for="username" class="h1e" >Kullanıcı Adı:</label><br>
        <input type="text" name="username" required><br><br>

        <label for="name" class="h1e">Ad Soyad:</label><br>
        <input type="text" name="name" required><br><br>

        <button type="submit" class="bnt" name="ekle">Ekle</button>
        <button onclick="location.href='index.php'" class="bnt">← Geri Dön</button>
    </form>
</nav>
    
</body>
</html>
