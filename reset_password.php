<?php
require "libs/vars.php";
require "libs/ayar.php";
require "libs/functions.php";

$email = "";
$email_err = $new_password_err = "";
$errors = [];

if (isset($_POST["reset_password"])) {
    // E-posta kontrolü
    if (empty(trim($_POST["email"]))) {
        $email_err = "E-posta girmelisiniz.";
        $errors[] = $email_err;
    } else {
        $email = trim($_POST["email"]);
    }

    if (empty(trim($_POST["new_password"]))) {
        $new_password_err = "Yeni şifre girmelisiniz.";
        $errors[] = $new_password_err;
    } else {
        $new_password = trim($_POST["new_password"]);
    }

    // Hatalar yoksa şifreyi güncelle
    if (empty($errors)) {
        // Kullanıcının mevcut şifresini alın
        $sql = "SELECT password FROM users WHERE email = ?";
        if ($stmt = mysqli_prepare($connection, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_bind_result($stmt, $current_password);
                if (mysqli_stmt_fetch($stmt)) {
                    mysqli_stmt_close($stmt); // İlk sorgu tamamlandıktan sonra kapatılıyor

                    // Eski şifreyi onceki_sifre alanına kaydetme
                    $sql_update = "UPDATE users SET onceki_sifre = ?, password = ? WHERE email = ?";
                    if ($stmt_update = mysqli_prepare($connection, $sql_update)) {
                        mysqli_stmt_bind_param($stmt_update, "sss", $current_password, $new_password, $email);
                        if (mysqli_stmt_execute($stmt_update)) {
                            // Şifre güncelleme başarılı
                            header("Location: login.php"); // Giriş ekranına yönlendirme
                            exit();
                        } else {
                            echo "Bir hata oluştu.";
                        }
                        mysqli_stmt_close($stmt_update);
                    }
                }
            }
        }
    }

    mysqli_close($connection);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Şifre Sıfırla</title>
  <link rel="stylesheet" href="views/css/login-sign.css">
</head>
<body>
  <div class="container_login">
    <div class="center">
      <div class="icon text-center"> <b>Pet</b>Pal - Şifre Sıfırla</div>
      
      <!-- Hata mesajlarını burada göster -->
      <?php if (!empty($errors)): ?>
        <div class="error-message">
          <?php foreach ($errors as $error): ?>
            <p><?php echo $error; ?></p>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
      
      <form action="reset_password.php" method="POST">
        <div class="txt_field">
          <input type="email" name="email" id="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid': ''?>" value="<?php echo $email; ?>">
          <span></span>
          <label for="email">Eposta</label>
        </div>

        <div class="txt_field">
          <input type="password" name="new_password" id="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid': ''?>">
          <span></span>
          <label for="new_password">Yeni Şifre</label>
        </div>

        <input type="submit" name="reset_password" value="Şifreyi Sıfırla">

        <div class="signup_link">
          Şifreni hatırladın mı?<a href="login.php">Giriş Yap</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
