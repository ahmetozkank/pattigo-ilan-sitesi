<?php

require "libs/vars.php";
require "libs/functions.php";  
if(!isAdmin()) {
    header("location: unauthorize.php");
    exit;
}


// Kullanıcıları veritabanından çekmek
$sql = "SELECT kullanici_id, isim, email, tel FROM users";
$result = mysqli_query($connection, $sql);

if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];

    // Kullanıcıyı silme işlemi
    $deleteSql = "DELETE FROM users WHERE kullanici_id = ?";
    $stmt = mysqli_prepare($connection, $deleteSql);
    mysqli_stmt_bind_param($stmt, "i", $deleteId);
    mysqli_stmt_execute($stmt);

    // Başarı mesajı
    echo "<script>alert('Kullanıcı başarıyla yasaklandı!');</script>";
}

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcılar</title>
</head>
<body>
<style>
/* Genel Ayarlar */
:root {
    --primary-color: #007bff; /* Genel birincil renk tanımı */
    --danger-color: #dc3545; /* Genel tehlike renk tanımı */
    --success-color: #155724; /* Başarılı işlemler için renk tanımı */
    --background-color:rgb(250, 248, 244); /* Sayfanın genel arka plan rengi */
}

body {
    background-color: var(--background-color); /* Sayfanın arka plan rengini ayarlar */
    font-family: Arial, sans-serif; /* Sayfanın yazı tipini belirler */
    font-size: 16px; /* Genel yazı boyutunu ayarlar */
}
a {
    text-decoration: none; /* Bağlantılardaki alt çizgiyi kaldırır */
}
.container {
    max-width: 1300px; /* Konteynerin maksimum genişliğini belirler */
    margin: auto; /* Konteynerin ortalanmasını sağlar */
    padding: 20px; /* Konteynerin etrafında iç boşluk ekler */
}
.alert {
    padding: 15px; /* Uyarı kutusunun iç boşluğunu ayarlar */
    margin-bottom: 20px; /* Uyarı kutusunun altında boşluk bırakır */
    border-radius: 0.25rem; /* Uyarı kutusunun kenarlarını yuvarlar */
    display: none; /* Uyarı kutusunu gizler, gerektiğinde gösterilir */
}
.alert-success {
    color: var(--success-color); /* Başarılı uyarı metin rengini belirler */
    background-color: #d4edda; /* Başarılı uyarı kutusunun arka plan rengini ayarlar */
    border-color: #c3e6cb; /* Başarılı uyarı kutusunun kenar rengini belirler */
}

/* Tablo Ayarları */
.table {
    width: 100%; /* Tablonun sayfa genişliğini tamamen kaplamasını sağlar */
    border-collapse: collapse; /* Tablodaki kenar çizgilerini birleştirir */
    margin-top: 20px; /* Tablonun üst kısmında boşluk bırakır */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Tabloda gölge efekti ekler */
}
.table th, .table td {
    padding: 12px; /* Hücrelerin iç boşluklarını ayarlar */
    border: 1px solid #ddd; /* Hücrelerin etrafına kenar çizgisi ekler */
    font-size: 14px; /* Hücrelerdeki yazı boyutunu ayarlar */
    text-align: left; /* Hücrelerin içindeki metinleri sola hizalar */
}
.table th {
    background-color: var(--primary-color); /* Başlık hücrelerinin arka plan rengini belirler */
    color: white; /* Başlık hücrelerindeki metin rengini beyaz yapar */
}
.table tbody tr:hover {
    background-color: #f1f1f1; /* Satırların üzerine gelindiğinde arka plan rengini değiştirir */
}

/* Buton Ayarları */
.btn {
    padding: 10px 15px; /* Butonun iç boşluğunu ayarlar */
    border: none; /* Butonun kenar çizgisini kaldırır */
    border-radius: 10px; /* Butonun kenarlarını yuvarlar */
    cursor: pointer; /* Butonun üzerine gelindiğinde fare imlecini değiştirir */
    transition: background-color 0.3s; /* Arka plan renginde geçiş efekti ekler */
    margin-right: 10px; /* Butonlar arasındaki boşluğu ayarlar */
    font-size: 14px; /* Buton yazı boyutunu ayarlar */
}
.btn-primary {
    background-color: var(--primary-color); /* Onay butonu arka plan rengini ayarlar */
    color: white; /* Onay butonu metin rengini beyaz yapar */
}
.btn-danger {
    background-color: var(--danger-color); /* Sil butonu arka plan rengini belirler */
    color: white; /* Sil butonu metin rengini beyaz yapar */
}
.btn-primary:hover {
    background-color: #0056b3; /* Onay butonuna fareyle gelindiğinde arka plan rengini değiştirir */
}
@media (max-width: 480px) {
  body {
    font-size: 14px;
  }

  .container {
    padding: 5px 8px;  /* Yan padding daha az */
    max-width: 100%;
    box-sizing: border-box;
  }

  .table {
    display: block;
    width: 100%;
    max-width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    font-size: 11px;    /* Biraz daha küçük font */
    box-sizing: border-box;
    margin: 0 auto;
  }

  .table th,
  .table td {
    padding: 10px 6px;  /* Daha dar padding */
    white-space: normal;
    box-sizing: border-box;
  }

  .btn {
    font-size: 12px;
    padding: 6px 10px;  /* Buton padding biraz azaldı */
    width: 100%;
    margin-bottom: 8px;
  }
}




</style>

<div class="container">
    <h1 style="display: inline-block;">Kullanıcılar</h1>
    <a href="admin-product.php" class="btn btn-primary" style="margin-left: 15px;">Admin Paneline Dön</a> <!-- Admin Paneline Dön Butonu -->

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>İsim</th>
                <th>Email</th>
                <th>Telefon</th>
                <th>Karar</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($user = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['kullanici_id']); ?></td>
                    <td><?php echo htmlspecialchars($user['isim']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo htmlspecialchars($user['tel']); ?></td>
                    <td>
                        <a href="admin-users.php?delete_id=<?php echo $user['kullanici_id']; ?>" class="btn btn-danger">Yasakla</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
