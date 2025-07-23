<?php
    require "libs/vars.php"; // Gerekli değişkenleri içeren dosya
    require "libs/functions.php"; // Gerekli fonksiyonları içeren dosya
?>

<?php include "views/_header.php"; ?> <!-- Sayfa üst kısmını ekler -->
<?php include "views/_navbar.php"; ?> <!-- Navigasyon çubuğunu ekler -->

<?php  
    if (isset($_SESSION["kullanici_id"])) { 
        $id = $_SESSION["kullanici_id"]; // Oturumdaki kullanıcı ID'sini alır
        $kisi = getPerson($id); // Kullanıcı bilgilerini getirir
        $person = mysqli_fetch_assoc($kisi); // Kullanıcı verilerini diziye dönüştürür
    }
?>

<!-- Ana Bölüm -->
<div class="container">
    <div class="aside"> <!-- Soldaki Menü Kısmı -->
    <p class="aside_paragraf">Hesap Ayarları</p>
        <ul>
            <li><a class="color_link" href="hesapsifre.php">Şifre Değiştir</a></li>
            <li><a class="color_link" href="hesapmail.php">E-Posta Değiştir</a></li>
            <li><a class="color_link" href="hesaptelefon.php">Telefon Ekle/Değiştir</a></li>
            <li><a class="color_link" href="ilanlarim.php">İlan İşlemleri</a></li>
        </ul>
    </div>

    <div class="bilgilerim"> <!-- Sağdaki Bilgilerim Kısmı -->
        <p class="aside_paragraf">Bilgilerim</p> <!-- Başlık kısmı -->
        <ul class="bilgi-listesi">
            <!-- Kullanıcı bilgileri liste halinde gösterilir -->
            <li><strong>İsim:</strong> <?php echo $person["isim"]; ?> </li>
            <li><strong>Email:</strong> <?php echo $person["email"]; ?> </li>
            <li><strong>Telefon:</strong> <?php echo $person["tel"] == "NULL" ? "Telefon yok" : $person["tel"]; ?> </li>
            <li><strong>Kullanıcı ID:</strong> <?php echo $person["kullanici_id"]; ?> </li>
        </ul>
    </div>
</div>

<!-- CSS -->
<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Helvetica Neue', sans-serif;
        background-color:rgb(0, 102, 255);
        color:red;
    }

    .container {
        display: flex;
        max-width: 100%;
        margin: 0 auto; /* Kenar boşluklarını kaldırır */
        background: #ffffffff;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
/*soldaki başlıklar*/

    .bilgilerim { /* Sağdaki bilgilerim kısmı */
        flex: 1;
        padding: 25px;
        background: #ffffff;
        border-left: 0px solid #f0f3f8; /* Ayrım için sol tarafa ince bir çizgi ekler */
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

    .bilgi-listesi li {
        margin: 12px 0;
        font-size: 16px;
        line-height: 1.6;
        color: #333;
    }

    .bilgi-listesi li strong {
        color: black;
    }
/*soldaki hesap ayar*/

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
</style>
