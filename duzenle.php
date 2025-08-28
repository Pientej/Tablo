<?php
include("data/db.php");

// ID kontrolü
if (!isset($_GET['id'])) {
    die("ID bulunamadı!");
}
$id = intval($_GET['id']);

// Kullanıcıyı çek
$sorgu = $db->query("SELECT * FROM users WHERE Id = $id");
$kullanici = $sorgu->fetch_assoc();

if (!$kullanici) {
    die("Kullanıcı bulunamadı!");
}

// Güncelleme işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['UserName'];
    $name     = $_POST['Name'];

    $update = $db->query("UPDATE users SET UserName='$username', Name='$name' WHERE Id=$id");

    if ($update) {
        echo "<script>; window.location.href='index.php';</script>";
    } else {
        echo "Hata: " . $db->error;
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kullanıcı Düzenle</title>
    <link rel="stylesheet" href="./styles/duzenle.css">
    
</head>
<body>


<!-- 🔹 Form -->
<nav class="card">
    <h2>Kullanıcı Düzenle</h2>
    <form method="post">
        <label class="k-ad">Kullanıcı Adı:</label><br>
        <input type="text" name="UserName" value="<?php echo $kullanici['UserName']; ?>"><br><br>

        <label class="k-ad">Ad Soyad:</label><br>
        <input type="text" name="Name" value="<?php  echo $kullanici['Name']; ?>"><br><br>

        <button type="submit" class="bnt">Kaydet</button>

    </form>
    <nav >
        <br>
    <button onclick="location.href='index.php'" class="bnt">← Geri Dön</button>
</nav>
</div>

</body>
</html>
