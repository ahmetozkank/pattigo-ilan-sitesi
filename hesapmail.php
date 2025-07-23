<?php
require "libs/vars.php"; // Gerekli değişkenler dosyası
require "libs/functions.php"; // Gerekli fonksiyonlar dosyası

// Giriş kontrolü
if (!isLoggedin()) { 
    header("Location: login.php"); 
    die();
}  

// E-posta değişiklik işlemleri
if (isset($_POST["maildegis"])) {
    $password = $eposta = "";
    $password_err = $eposta_err = "";     
    $kİd = $_SESSION["kullanici_id"];

    // Şifre doğrulama
    if (empty(trim($_POST["password"]))) {
        $password_err = "Şifre girmelisiniz.";
    } else {
        $password = $_POST["password"];
        $result = getPerson($kİd);

        if (mysqli_num_rows($result) > 0) {
            while ($person = mysqli_fetch_assoc($result)) {
                if ($person["password"] != $password) {
                    $password_err = "Mevcut şifre yanlış.";
                }
            }
        }
    }

    // E-posta doğrulama
    if (empty(trim($_POST["eposta"]))) {
        $eposta_err = "E-posta girmelisiniz.";
    } elseif (!filter_var($_POST["eposta"], FILTER_VALIDATE_EMAIL)) {
        $eposta_err = "Hatalı e-posta girdiniz.";
    } else {
        $bmail = $_POST['eposta'];
        $res = getMail($bmail);

        if (mysqli_num_rows($res) > 0) {
            $eposta_err = "E-posta başkası tarafından kullanılıyor.";  
        } else {
            $eposta = $_POST['eposta'];
        }
    }

    if (empty($password_err) && empty($eposta_err)) {
        setMail($kİd, $eposta);
        header("Location: logout.php"); 
        die();
    }
}
?>

<?php include "views/_header.php"; ?> <!-- Sayfa üst kısmını ekler -->
<?php include "views/_navbar.php"; ?> <!-- Navigasyon çubuğunu ekler -->

<!-- Ana Bölüm -->
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

    <div class="sifre-degis">
        <h3>E-Posta Değiştir</h3>
        <?php if (!empty($password_err) || !empty($eposta_err)) {
            echo "<div class='error-message'>Hata: $password_err $eposta_err</div>";
        } ?>
        <form action="hesapmail.php" method="post">
            <label for="eposta">Yeni E-Posta</label>
            <input type="email" name="eposta" id="eposta" placeholder="Yeni e-posta adresini girin" />

            <label for="password">Mevcut Şifre</label>
            <input type="password" name="password" id="password" placeholder="Mevcut şifreyi girin" />

            <button class="degistir" name="maildegis" id="maildegis">Kaydet</button>
        </form>
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
        background-color: #f3f5f8;
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

    .sifre-degis {
        flex: 1;
        padding: 30px 40px;
    }

    h3 {
        color: #333;
        font-size: 24px;
        margin-bottom: 20px;
    }

    label {
        display: block;
        font-size: 15px;
        margin-bottom: 8px;
        font-weight: 600;
    }

    input[type="password"],
    input[type="email"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #d1d9e0;
        border-radius: 6px;
        margin-bottom: 15px;
        font-size: 14px;
        transition: border-color 0.3s;
    }

    input[type="password"]:focus,
    input[type="email"]:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
    }

    button.degistir {
      background-color: #007bff;
    color: #fff;
    padding: 15px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
    width: 100%;
    text-align: center; /* Yazıyı ortalar */
    display: flex;
    justify-content: center; /* Flex ile ortalama */
    align-items: center; /* Dikey ortalama */
      
    }

    button.degistir:hover {
        background-color: #0056b3;
    }

    .error-message {
        color: #dc3545;
        margin-bottom: 15px;
        font-weight: bold;
        font-size: 14px;
    }
</style>
