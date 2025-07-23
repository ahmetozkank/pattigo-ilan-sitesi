<?php
require "libs/vars.php";
require "libs/functions.php";  

if (!isLoggedin()){ 
    header("Location: login.php"); 
    die();
}

$success_message = "";  // Başarı mesajı değişkeni

if (isset($_POST["telekle"])) {
    $password  = $telefon = "";
    $password_err  = $telefon_err = "";   
    $kİd = $_SESSION["kullanici_id"];

    // Şifre kontrol
    if (empty(trim($_POST["password"]))) {
        $password_err = "Mevcut şifre girmelisiniz.";
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

    // Telefon kontrol
    if (empty(trim($_POST["telefon"]))) {
        $telefon_err = "Telefon girmelisiniz.";
    } elseif (!preg_match('/^[0-9]{10}+$/', $_POST["telefon"])) {
        $telefon_err = "Hatalı telefon girdiniz.";
    } elseif (strlen(trim($_POST["telefon"])) <= 9 || strlen(trim($_POST["telefon"])) >= 11) {
        $telefon_err = "Eksik veya yanlış telefon girdiniz.";
    } else {
        $tel = $_POST['telefon'];
        $res = getPhone($tel);
        if (mysqli_num_rows($res) > 0) {
            $telefon_err = "Telefon başkası tarafından kullanılıyor.";
        } else {
            $telefon = $_POST['telefon'];
        }
    }

    // Eğer hata yoksa telefon numarasını kaydet
    if (empty($password_err) && empty($telefon_err)) {
        setPhone($kİd, $tel);
        $success_message = "Telefon başarıyla kaydedildi.";  // Başarı mesajını ayarla
    }
}
?>

<?php include "views/_header.php"; ?>
<?php include "views/_navbar.php"; ?>

<!-- Section Başlangıç -->
<div class="container">
    <div class="aside">
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
        <h3>Telefon Ekle/Değiştir</h3>
        <?php if (!empty($password_err) || !empty($telefon_err)) {
            echo "<div class='error-message'>Hata: $password_err $telefon_err</div>";
        } elseif (!empty($success_message)) {
            echo "<div class='success-message'>$success_message</div>";  // Başarı mesajını göster
        } ?>
        <form action="hesaptelefon.php" method="post">
            <label for="telefon">Yeni Telefon No</label>
            <input id="telefon" name="telefon" maxlength="10" required type="tel" placeholder="(Sıfır olmadan giriniz)" />

            <label for="password">Mevcut Şifre</label>
            <input type="password" name="password" id="password" placeholder="Mevcut şifreyi girin" />

            <button class="degistir" name="telekle">Kaydet</button>
        </form>
    </div>
</div>

<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Helvetica Neue', sans-serif;
        background-color: #f3f5f8;
        color: #333;/*mevcut şifre küçük başlık rengi*/
    }

    .container {
        display: flex;
        max-width: 100%;
        margin: 0 auto;  
        background: #ffffff;/*sağ tarafın arkaplanı*/
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .aside {
        flex: 0.4;
        padding: 25px;
        background: #f0f3f8;/*sol tarafın arkaplanı*/
    }

    .aside_paragraf {
        font-size: 18px;
        margin-bottom: 15px;
        color: #0056b3;/*hesap ayarları*/
    }

    ul {
        list-style: none;
        padding: 0;
    }

    .color_link {
        text-decoration: none;
        color: #007bff;/*alt başlıklar bilgi şifrevs*/
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

    input[type="tel"], input[type="password"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #d1d9e0;
        border-radius: 6px;
        margin-bottom: 15px;
        font-size: 14px;
        transition: border-color 0.3s;
    }

    input[type="tel"]:focus, input[type="password"]:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
    }

    button.degistir {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 12px 0;
        font-size: 16px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
        text-align: center;
        display: flex;
        justify-content: center;  
        align-items: center;  
        transition: background-color 0.3s;
        width: 100%;
    }

    button.degistir:hover {
        background-color: #0056b3;
    }

    .error-message {
        background-color: red;  /* Yeşil arka plan */
    color: white;                /* Beyaz yazı rengi */
    padding: 10px;               /* Mesajın etrafında biraz boşluk */
    border-radius: 5px;          /* Yuvarlatılmış köşeler */
    font-weight: bold;           /* Kalın yazı */
    text-align: center;          /* Ortalanmış yazı */
    margin-top: 15px;            /* Üstten biraz boşluk */
    font-size: 16px;             /* Yazı büyüklüğünü biraz arttır */
    }
    /* Başarı mesajı için stil */
.success-message {
    background-color: #28a745;  /* Yeşil arka plan */
    color: white;                /* Beyaz yazı rengi */
    padding: 10px;               /* Mesajın etrafında biraz boşluk */
    border-radius: 5px;          /* Yuvarlatılmış köşeler */
    font-weight: bold;           /* Kalın yazı */
    text-align: center;          /* Ortalanmış yazı */
    margin-top: 15px;            /* Üstten biraz boşluk */
    font-size: 16px;             /* Yazı büyüklüğünü biraz arttır */
}

</style>
