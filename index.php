<?php 
include("data/db.php");

// Kullanıcı silme işlemi
if (isset($_GET['sil'])) {
    $id = intval($_GET['sil']); 
    $silSorgu = "DELETE FROM users WHERE Id = $id";
    if ($db->query($silSorgu)) {
        echo "<script>
            window.location.href='index.php';
        </script>";
        exit();
    } else {
        echo "Hata: " . $db->error; 
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kullanıcı Listesi</title>
  <link rel="stylesheet" href="./styles/karanlik.css">
  <link rel="stylesheet" href="./styles/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

  <!-- Karanlık Mod Düğmesi -->
  <svg  class="kara" id="karanlik-mod-buton" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-toggle-on" viewBox="0 0 16 16">
    <path d="M5 3a5 5 0 0 0 0 10h6a5 5 0 0 0 0-10zm6 9a4 4 0 1 1 0-8 4 4 0 0 1 0 8"/>
  </svg>

  <h2 class="h2">Kullanıcı Listesi</h2>

  <div class="table-box">
    <table class="tablo" border="2">
      <tr>
        <th>Id</th> 
        <th>Kullanıcı Adı</th>
        <th>İsim</th>
        <th></th>
        <th>Düzenle</th>
        <th></th>
        <th>Sil</th>
      </tr>

      <?php
      $sorgu = "SELECT * FROM users";
      $sonuc = $db->query($sorgu);

      while ($satir = $sonuc->fetch_assoc()) { ?>
          <tr class="tablo2">
              <td><?php echo $satir['Id']; ?></td>
              <td><?php echo $satir['UserName']; ?></td>
              <td><?php echo $satir['Name']; ?></td>
               <td></td>
              <td>
                  <a href="duzenle.php?id=<?php echo $satir['Id']; ?>"><i class="fa-solid fa-pencil"></i></a>
              </td>
               <td></td>
              <td>
                  <a class="delete-button" data-id="<?php echo $satir['Id']; ?>"><i class="fa-solid fa-trash-can"></i></a>
              </td>
          </tr>
      <?php } ?>
    </table>
  </div>

  <br>

  <nav class="navbar">
    <button onclick="location.href='ekle.php'" class="ekle">Ekle</button>
  </nav>

  <!-- SweetAlert2 ve Ajax ile Silme İşlemi -->
  <script type="text/javascript">
    $(document).on('click', '.delete-button', function(e) {
      e.preventDefault();
      var id = $(this).data('id');
      
      // SweetAlert2 onayı
      Swal.fire({
        title: "Emin misiniz?",
        text: "Bu işlemi geri alamazsınız!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Evet, sil!"
      }).then((result) => {
        if (result.isConfirmed) {
          // Ajax ile silme işlemi
          $.ajax({
            url: 'index.php',
            type: 'GET',
            data: { sil: id },
            success: function(response) {
              Swal.fire({
                title: "Silindi!",
                text: "Kullanıcı başarıyla silindi.",
                icon: "success"
              }).then(() => {
                location.reload(); // Sayfayı yenileyerek kullanıcıyı silinmiş olarak göster
              });
            },
            error: function() {
              Swal.fire({
                title: "Hata!",
                text: "Bir hata oluştu, kullanıcı silinemedi.",
                icon: "error"
              });
            }
          });
        }
      });
    });

    // Karanlık Mod Düğmesi
    $(document).on('click', '#karanlik-mod-buton', function() {
      $('body').toggleClass('karanlik-mod');
    });
  </script>
<small class="small"  > © 2025 Copyrights by Yağız Buyrukçu Tüm hakları saklıdır.</small>
</body>

</html>

