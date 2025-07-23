<?php
require "libs/vars.php";
require "libs/functions.php";  

if (!isLoggedin()){ 
    header("Location: login.php"); 
    die();
}

if (isset($_POST["sifredegis"])) {
    $password = $newpassword = $currentpassword = "";
    $password_err = $newpassword_err = $currentpassword_err = "";        
    
    $kİd = $_SESSION["kullanici_id"];
    $password = $_POST['password'];
    $newpassword = $_POST['newpassword'];
    $currentpassword = $_POST['currentpassword'];       

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Mevcut şifre girmelisiniz.";
    } else {
        $result = getPerson($kİd);
        if (mysqli_num_rows($result) > 0){
            while ($person = mysqli_fetch_assoc($result)){
                if ($person["password"] != $password){
                    $password_err = "Mevcut şifre yanlış.";
                } 
            }
        } 
    }

    // Validate newpassword
    if (empty(trim($_POST["newpassword"]))) {
        $newpassword_err = "Yeni şifre girmelisiniz.";
    } elseif (strlen($_POST["newpassword"]) < 6) {
        $newpassword_err = "Yeni şifre min. 6 karakter olmalıdır.";
    } else {
        $newpassword = $_POST["newpassword"];
    }

    // Validate currentpassword 
    if (empty(trim($_POST["currentpassword"]))) {
        $currentpassword_err = "Yeni şifre tekrarını girmelisiniz.";
    } else {
        if (empty($password_err) && ($newpassword != $currentpassword)) {
            $currentpassword_err = "Şifreler eşleşmiyor.";
        }
    }

    if (empty($password_err) && empty($newpassword_err) && empty($currentpassword_err)) {
        SetPassword($kİd, $newpassword);
        header("Location: logout.php"); 
        die();
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
            <li><a class="color_link" href="Bilgilerim.php">Bilgilerim</a></li>
            <li><a class="color_link" href="hesapsifre.php">Şifre Değiştir</a></li>
            <li><a class="color_link" href="hesapmail.php">E-Posta Değiştir</a></li>
            <li><a class="color_link" href="hesaptelefon.php">Telefon Ekle/Değiştir</a></li>
            <li><a class="color_link" href="ilanlarim.php">İlan İşlemleri</a></li>
        </ul>
    </div>

    <div class="sifre-degis">
        <h3>Şifre Değiştir</h3>
        <?php if (!empty($password_err) || !empty($newpassword_err) || !empty($currentpassword_err)) {
            echo "<div class='error-message'>Hata: $password_err $newpassword_err $currentpassword_err</div>";
        } ?>
        <form action="hesapsifre.php" method="post">
            <label for="password">Mevcut Şifre</label>
            <input type="password" name="password" id="password" placeholder="Mevcut şifreyi girin" />

            <label for="newpassword">Yeni Şifre</label>
            <input type="password" name="newpassword" id="newpassword" placeholder="Yeni şifreyi girin" />

            <label for="currentpassword">Yeni Şifre (Tekrar)</label>
            <input type="password" name="currentpassword" id="currentpassword" placeholder="Yeni şifreyi tekrar girin" />

            <button class="degistir" name="sifredegis" id="sifredegis">Kaydet</button>
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

    input[type="password"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #d1d9e0;
        border-radius: 6px;
        margin-bottom: 15px;
        font-size: 14px;
        transition: border-color 0.3s;
    }

    input[type="password"]:focus {
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
        justify-content: center;  /* "Kaydet" yazısını ortalar */
        align-items: center;  /* Dikey ortalama */
        transition: background-color 0.3s;
        width: 100%;
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
