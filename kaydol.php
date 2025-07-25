<?php

//ayar kodları
require "libs/vars.php";
require "libs/functions.php";
require "libs/ayar.php";

$isim  = $email = $password = $confirm_password = "";
$isim_err  = $email_err =$password_err= $confirm_password_err = "";
$errors = [];

//register php kodlarını buraya yazıyoruz.
if (isset($_POST["kaydol"])) {

    // validate isim
    if (empty(trim($_POST["isim"]))) {
        $isim_err = "İsim girmelisiniz.";
        $errors[] = $isim_err;
    } elseif (strlen(trim($_POST["isim"])) < 3 or strlen(trim($_POST["isim"])) > 24) {
        $isim_err = "İsim 3-24 karakter arasında olmalıdır.";
        $errors[] = $isim_err;
    } elseif (!preg_match('/^[a-zA-Z\s]*$/', $_POST["isim"])) {
        $isim_err = "İsim harf ve boşluk karakterinden oluşmalıdır.";
        $errors[] = $isim_err;
    } else {
        $isim = $_POST["isim"];
    }

    // validate email
    if(empty(trim($_POST["email"]))) {
        $email_err = "Eposta girmelisiniz.";
        $errors[] = $email_err;
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email_err = "Hatalı email girdiniz.";
        $errors[] = $email_err;
    } else {
        $bmail = $_POST['email'];
        $sql = "SELECT * FROM users WHERE email='$bmail'";
        $res = mysqli_query($connection, $sql);

        if(mysqli_num_rows($res) > 0){
            $email_err="Üzgünüz... email Zaten alınmış";  
            $errors[] = $email_err;
        } else {
            $email = $_POST['email'];
        }
    }

    // validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Şifre girmelisiniz.";
        $errors[] = $password_err;
    } elseif (strlen($_POST["password"]) < 6) {
        $password_err = "Şifre min. 6 karakter olmalıdır.";
        $errors[] = $password_err;
    } else {
        $password = $_POST["password"];
    }

    // validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Şifreyi tekrar girmelisiniz.";
        $errors[] = $confirm_password_err;
    } else {
        $confirm_password = $_POST["confirm_password"];
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Şifreler eşleşmiyor.";
            $errors[] = $confirm_password_err;
        }
    }

    if (empty($errors)) {
        $sql = "INSERT INTO users (isim, email, password) VALUES (?,?,?)";

        if ($stmt = mysqli_prepare($connection, $sql)) {
            $param_isim = $isim;
            $param_email = $email;
            $param_password = $password;

            mysqli_stmt_bind_param($stmt, "sss", $param_isim, $param_email, $param_password);

            if (mysqli_stmt_execute($stmt)) {
                header("location: login.php");
            } else {
                echo mysqli_error($connection);
                echo "Hata oluştu";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol</title>
    <link rel="stylesheet" href="views/css/login-sign.css">
</head>
<body>
    <div class="container_login">
        <div class="center">
            <div class="icon text-center"><b>Patti</b>Go-Kaydol</div>

            <!-- Hata mesajlarını burada göster -->
            <?php if (!empty($errors)): ?>
                <div class="error-message">
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo $error; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form action="kaydol.php" method="post">
                <div class="txt_field">
                    <input type="text" name="isim" id="isim" class="form-control <?php echo (!empty($isim_err)) ? 'is-invalid': ''?>" value="<?php echo $isim; ?>">
                    <span></span>
                    <label for="isim">İsim</label>
                </div>

                <div class="txt_field">
                    <input type="email" name="email" id="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid': ''?>" value="<?php echo $email; ?>">
                    <span></span>
                    <label for="email">Eposta</label>
                </div>

                <div class="txt_field">
                    <input type="password" name="password" id="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid': ''?>">
                    <span></span>
                    <label for="password">Şifre</label>
                </div>

                <div class="txt_field">
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid': ''?>">
                    <span></span>
                    <label for="confirm_password">Şifre Tekrar</label>
                </div>

                <input type="submit" name="kaydol" value="Kaydol">
                <div class="signup_link">
                    Üye misiniz? <a href="login.php">Giriş Yap</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
