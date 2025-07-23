
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
        $message = "bilinmeyen silme hatası";
    }
}
?>
<?php include "views/_ilanlarim.php";?>
<?php include "views/_navbar.php"; ?>

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
            $result = getMyProducts($id);
            $person = mysqli_fetch_assoc(getPerson($_SESSION["kullanici_id"]));
        ?>
        
        <?php if (!empty($message)): ?>
            <p class="text-center"><strong><?php echo "$message" ?> </strong></p>
        <?php endif; ?>
        
        <div class="product-grid"> <!-- Ürün Kartları için Grid Düzeni -->
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($urun = mysqli_fetch_assoc($result)): ?>
                    <div class="product-card"> <!-- Ürün Kartı -->
                        <div class="img-container">
                            <img src="<?php echo "img/" . $urun["imageUrl"] ?>" alt="<?php echo $urun["title"] ?>">
                        </div>
                        <div class="product-details">
                            <h4><?php echo $urun["title"] ?></h4>
                            <p class="owner"><strong><?php echo $person["isim"] ?></strong></p>
                            <div class="info">
                                <span><i class="fa-solid fa-location-dot"></i> <?php echo $urun["sehir"] ?></span>
                                <span><b><?php echo $urun["price"] ?> Yaşında</b></span>
                            </div>
                        </div>
                        <div class="ilan-islemler">
                            <a class="ilan-sil" style="color: red;" href="ilanlarim.php?id=<?php echo $urun["id"] . " S"; ?>"><i class="fa-solid fa-trash-can"></i> Sil</a>
                            <a class="ilan-duzenle" href="ilanDuzenle.php?id=<?php echo $urun["id"] ?>"><i class="fa-solid fa-pen"></i> Düzenle</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p style="font-weight:bold; font-size: 1rem;">Herhangi bir ilanınız bulunamadı. İlan vermek için <a style="color:blue;" href="ilanver.php">Tıklayınız</a></p>
            <?php endif; ?> 
        </div>
    </div>
</div>

<style>
    /* Genel ayarlar */
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Helvetica Neue', sans-serif;
        background-color:rgba(255, 255, 255, 1);
        color: #333;
    }

    .container {
        display: flex;
        max-width: 100%;
        margin: 0 auto;
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .aside {
        flex: 0.4;
        padding: 25px;
        background: #f0f3f8; /*yan panel arkaplan*/
    }

    .section {
        flex: 1;
        padding: 25px;
        background: #ffffff; /* ilanların arkaplanı*/
        border-left: 2px solid #f0f3f8;
    }

    .container {
        display: flex;
        max-width: 100%;
        margin: 0 auto;
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .aside {
        flex: 0.4;
        padding: 25px;
        background: #f0f3f8;
    }

    .aside_paragraf {
        font-size: 18px;
        margin-bottom: 15px;
        color: #0056b3;
    }

    ul {
        list-style: none;
        padding: 0;
    }

    .color_link {
        text-decoration: none;
        color: #007bff;
        padding: 12px 10px;
        display: block;
        transition: background-color 0.3s, color 0.3s;
        font-size: 16px;
    }

    .color_link:hover {
        background-color: #e7f1ff;
        color: #004c99;
    }

    ul {
        list-style: none;
        padding: 0;
    }

    .color_link {
        text-decoration: none;
        color: #007bff;
        padding: 12px 10px;
        display: block;
        transition: background-color 0.3s, color 0.3s;
    }

    .color_link:hover {
        background-color: #e7f1ff;
        color: #004c99;
    }

    /* Ürün kartları */
    .product-grid {
    display: grid; /* Ürün kartları için grid düzeni kullanılıyor */
    gap: 25px; /* Kartlar arası boşluk */
    grid-template-columns: repeat(4, 1fr); /* Her satırda 4ürün kartı */
}

    .product-card {
        background-color: #ffffff;
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
    }

    .img-container {
        width: 100%;
        overflow: hidden;
    }

    .img-container img {
        width: 100%;
        height: 330px; /* Yükseklik ayarı */
        object-fit: cover; /* Fotoğraf köşelere kadar uzanır */
    }

    .product-details {
        padding: 15px;
    }

    .product-details h4 {
        margin: 0 0 5px;
        font-size: large;
        color: red;
    }

    .product-details .owner {
        color: #666;
        font-size: 1.0em;
        margin: 8px 0;
    }

    .product-details .info {
        display: flex;
        justify-content: space-between;
        font-size: 0.95em;
    }

    .product-details .info span {
        background-color: #e9ecef;
        padding: 5px 10px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease;
    }

    .product-details .info span:hover {
        background-color: #d1d1d1;
    }

    .ilan-islemler {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        background-color: #f8f9fa;
        border-top: 1px solid #e9ecef;
    }

    .ilan-islemler a {
        text-decoration: none;
        color: #333;
        font-size: 1em;
        transition: color 0.3s ease;
    }

    .ilan-islemler a:hover {
        color: #0056b3;
  }
@media (max-width: 480px) {
  body {
    background-color: white !important;
  }

  .product-grid {
    display: grid !important;
    grid-template-columns: repeat(2, 1fr) !important;
    gap: 15px !important;
  }

  .product-card {
    width: 100%;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
    transition: none;
  }

  .img-container img {
    height: 160px !important;
    border-radius: 10px 10px 0 0;
    object-fit: cover;
    width: 100%;
    display: block;
  }

  .product-details {
    padding: 12px 15px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
  }

  .product-details h4 {
    font-size: 1.1rem;
    margin-bottom: 6px;
    color: red;
  }

  .product-details .owner {
    font-size: 0.9rem;
    margin-bottom: 10px;
    color: #666;
  }

  .product-details .info {
    display: flex;
    flex-wrap: nowrap;
    gap: 10px;
    font-size: 0.85rem;
    color: #444;
    justify-content: flex-start;
  }

  .product-details .info span {
    background-color: #f5f5f5;
    padding: 5px 10px;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s ease;
    white-space: nowrap;
  }

  .product-details .info span:hover {
    background-color: #ddd;
  }

  .ilan-islemler {
    display: flex;
    justify-content: space-between; /* Sil sola, Düzenle sağa */
    padding: 10px 15px;
    background-color: transparent !important;
    border-top: none;
    border-radius: 0 0 10px 10px;
  }

  .ilan-islemler a {
    font-size: 0.95rem;
    color: #007bff;
    text-align: center;
    padding: 8px 12px;
    border-radius: 8px;
    background-color: #e7f1ff;
    text-decoration: none;
    min-width: 100px;  /* minimum genişlik */
  }

  .ilan-islemler a.delete {
    order: 1;
    align-self: flex-start;
  }

  .ilan-islemler a.edit {
    order: 2;
    align-self: flex-end;
  }

}

</style>
