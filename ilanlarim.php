<?php
require "libs/vars.php"; // Gerekli değişkenler dosyası
require "libs/functions.php"; // Gerekli fonksiyonlar dosyası

if (!isLoggedin()) { 
    header("Location: login.php"); 
    die();
}  

if (isset($_GET["id"])) { 
    $id = $_GET["id"];
    $result = getProductbyId($id);
    $selecteProduct = mysqli_fetch_assoc($result);   
    $dizi = explode(" ", $id); // cümlemiz boşluklardan bölünecek
    $urunID = $dizi[0];
    $dizislem = $dizi[1];
    $message = "";
     
    if ($dizislem == "S") {
        productDelete($urunID);
        $message = $urunID . " nolu ilan silindi";
    } else {
        $message = "Bilinmeyen silme hatası";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>İlanlarım</title>
    <!-- FontAwesome CDN (ikonlar için) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
    <?php include "views/_navbar.php"; ?>
    <?php include "views/ilanlarim.php"; ?>
    <div class="container">
        <div class="aside"> <!-- Soldaki Menü Kısmı -->
            <p class="aside_paragraf">Hesap Ayarları</p>
            <ul>
                <li><a class="color_link" href="bilgilerim.php">Bilgilerim</a></li>
                <li><a class="color_link" href="hesapsifre.php">Şifre Değiştir</a></li>
                <li><a class="color_link" href="hesapmail.php">E-Posta Değiştir</a></li>
                <li><a class="color_link" href="hesaptelefon.php">Telefon Ekle/Değiştir</a></li>
                <li><a class="color_link" href="ilanlarim.php">İlan İşlemleri</a></li>
            </ul>
        </div>

        <div class="section"> <!-- İlan Kısmı -->
            <?php  
                $result = getMyProducts($_SESSION["kullanici_id"]);
                $person = mysqli_fetch_assoc(getPerson($_SESSION["kullanici_id"]));
            ?>

            <?php if (!empty($message)): ?>
                <p class="text-center" style="margin-bottom: 20px; font-weight: bold; color: green;">
                    <?php echo htmlspecialchars($message); ?>
                </p>
            <?php endif; ?>

            <div class="product-grid"> <!-- Ürün Kartları için Grid Düzeni -->
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($urun = mysqli_fetch_assoc($result)): ?>
                        <div class="product-card"> <!-- Ürün Kartı -->
                            <div class="img-container">
                                <img src="<?php echo "img/" . htmlspecialchars($urun["imageUrl"]); ?>" alt="<?php echo htmlspecialchars($urun["title"]); ?>">
                            </div>
                            <div class="product-details">
                                <h4><?php echo htmlspecialchars($urun["title"]); ?></h4>
                                <p class="owner"><strong><?php echo htmlspecialchars($person["isim"]); ?></strong></p>
                                <div class="info">
                                    <span><i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($urun["sehir"]); ?></span>
                                    <span><b><?php echo htmlspecialchars($urun["price"]); ?> Yaşında</b></span>
                                </div>
                            </div>
                            <div class="ilan-islemler">
                                <a class="ilan-sil delete" href="ilanlarim.php?id=<?php echo urlencode($urun["id"] . " S"); ?>"><i class="fa-solid fa-trash-can"></i> Sil</a>
                                <a class="ilan-duzenle edit" href="ilanDuzenle.php?id=<?php echo urlencode($urun["id"]); ?>"><i class="fa-solid fa-pen"></i> Düzenle</a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p style="font-weight:bold; font-size: 1rem;">Herhangi bir ilanınız bulunamadı. İlan vermek için <a style="color:blue;" href="ilanver.php">Tıklayınız</a></p>
                <?php endif; ?> 
            </div>
        </div>
    </div>
</body>
</html>
