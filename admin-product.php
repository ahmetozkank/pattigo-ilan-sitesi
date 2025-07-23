<?php
require "libs/vars.php";
require "libs/functions.php";  
if(!isAdmin()) {
    header("location: unauthorize.php");
    exit;
}
?>

<?php 
if(isset($_GET["id"])){ 
    $id = $_GET["id"];
    $dizi = explode(" ", $id); 
    $dizId = $dizi[0];
    $dizislem = $dizi[1];

    $result = getProductbyId($dizId);
    $selecteProduct = mysqli_fetch_assoc($result);   

    $message = "";

    if($dizislem == "O"){
        productActive($dizId);
        $message = $dizId . " nolu ilan onaylandı";
    } elseif($dizislem == "S"){
        productDelete($dizId);
        $message = $dizId . " nolu ilan silindi";
    } else {
        echo "bilinmeyen ilan hatası";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Kontrol</title>

    <style>
/* Genel Ayarlar */
:root {
    --primary-color: #007bff; /* Genel birincil renk tanımı */
    --danger-color: #dc3545; /* Genel tehlike renk tanımı */
    --success-color: #155724; /* Başarılı işlemler için renk tanımı */
    --background-color: #f4f7fa; /* Sayfanın genel arka plan rengi */
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
    background-color:rgb(237, 212, 212); /* Başarılı uyarı kutusunun arka plan rengini ayarlar */
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
    padding: 15px; /* Hücrelerin iç boşluklarını ayarlar */
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
.btn-danger:hover {
    background-color: #c82333; /* Sil butonuna fareyle gelindiğinde arka plan rengini değiştirir */
}

/* Resim Ayarları */
.img-fluid {
    max-width: 120px; /* Resmin maksimum genişliğini ayarlar */
    height: auto; /* Resim yüksekliğini genişliğe göre otomatik ayarlar */
    border-radius: 4px; /* Resmin kenarlarını hafif yuvarlar */
}
  /* Responsive ayarlar */
@media (max-width: 480px) {
  .admin-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 8px 10px;
    position: relative;
  }

  .admin-title {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    font-size: 18px;
    font-weight: bold;
    white-space: nowrap;
    margin: 0;
  }

  /* Butonlar flex sırasıyla */
  .btn-left {
    order: 1;
    flex-shrink: 0; /* küçülmeyi engelle */
  }

  .btn-right {
    order: 3;
    flex-shrink: 0; /* küçülmeyi engelle */
  }

  /* Ortadaki boşluk flex grow ile kapansın */
  .btn-center {
    order: 2;
    flex-grow: 1;
  }

  /* Butonların temel stili */
  .btn {
    padding: 6px 10px;
    font-size: 14px;
    border-radius: 5px;
    white-space: nowrap;
    cursor: pointer;
    text-decoration: none;
    color: white;
    border: none;
    transition: background-color 0.3s ease;
  }

}

</style>
<?php
    // Veritabanından ürün ve kullanıcı bilgilerini alıyoruz
    $result = getAdminProductsWithUserInfo(); 
    if ($result === false) {
        echo "Veritabanı hatası.";
        exit; // Hata durumunda işlemi sonlandırmak için
    }
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Kontrol Paneli</title>
</head>
<body>

<div class="container">
    <h1 style="display: inline-block;">Admin Kontrol Paneli</h1>
    <a href="index.php" class="btn btn-primary" style="margin-left: 15px;">Anasayfaya Dön</a> <!-- Anasayfa butonu -->
    <a href="admin-users.php" class="btn btn-primary" style="margin-left: 15px;">Kullanıcılar</a> <!-- Kullanıcılar butonu -->


    <?php if (!empty($message)): ?>
        <div class="alert alert-success" style="display: block;">
            <strong>Başarılı!</strong> <?php echo $message ?>
        </div>
    <?php endif; ?>
    
    <table class="table">
        <thead>
            <tr>
                <th>Fotoğraf</th>
                <th>Sahip</th>
                <th>ID</th>
                <th>Başlık</th>
                <th>Şehir</th>
                <th>Tür</th>
                <th>Açıklama</th>
                <th>Durum</th>
                <th>Karar</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($urunler = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td>
                        <img src="img/<?php echo htmlspecialchars($urunler['imageUrl']); ?>" alt="" class="img-fluid">
                    </td>
                    <td><?php echo htmlspecialchars($urunler['isim']); ?></td>
                    <td><?php echo htmlspecialchars($urunler['kullanici_id']); ?></td>
                    <td><?php echo htmlspecialchars($urunler['title']); ?></td>
                    <td><?php echo htmlspecialchars($urunler['sehir']); ?></td>
                    <td><?php echo htmlspecialchars($urunler['ikategori']); ?></td>
                    <td><?php echo htmlspecialchars($urunler['descriptions']); ?></td>
                    <td>
                        <?php echo $urunler["isActive"] ? "&#10003;" : "&#10008;"; ?>
                    </td>
                    <td>
                        <div style="display: flex; align-items: center;">
                            <a class="btn btn-primary" href="admin-product.php?id=<?php echo $urunler["id"] . ' O'; ?>">Onayla</a>
                            <a class="btn btn-danger" href="admin-product.php?id=<?php echo $urunler["id"] . ' S'; ?>">Sil</a>
                        </div>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
