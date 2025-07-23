<?php
require "libs/vars.php";
require "libs/ayar.php";
require "libs/functions.php";

if (isLoggedin()) { // Giriş yapıldıysa direk yönlendirme
    header("location: index.php");
    exit;   
}

$email = $password = "";
$email_err = $password_err = $login_err = "";

if (isset($_POST["login"])) {
    // E-posta kontrolü
    if (empty(trim($_POST["email"]))) {
        $email_err = "E-posta girmelisiniz.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Şifre kontrolü
    if (empty(trim($_POST["password"]))) {
        $password_err = "Şifre girmelisiniz.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Hatalar yoksa veritabanında kontrol et
    if (empty($email_err) && empty($password_err)) {
        $sql = "SELECT kullanici_id, email, password, user_type FROM users WHERE email = ?";

        if ($stmt = mysqli_prepare($connection, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $email);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $kullanici_id, $email, $db_password, $user_type);
                    
                    if (mysqli_stmt_fetch($stmt)) {
                        // Doğrulama işlemi (Düz metin şifre kontrolü)
                        if ($password === $db_password) { // Burada hash yerine doğrudan kontrol yapıoz !== tam tersi
                            $_SESSION["loggedin"] = true;
                            $_SESSION["kullanici_id"] = $kullanici_id;
                            $_SESSION["email"] = $email;
                            $_SESSION["user_type"] = $user_type;

                            header("location: index.php");/*giriş yaptan sonra anasayfa*/
                            exit;
                        } else {
                            $login_err = "Yanlış şifre girdiniz.";
                        }
                    } 
                } else {
                    $login_err = "Yanlış e-posta girdiniz.";
                }
            } else {
                $login_err = "Bilinmeyen bir hata oluştu.";
            }
            mysqli_stmt_close($stmt);
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
  <title>Giriş Yap</title>
  <link rel="stylesheet" href="views/css/login-sign.css">
</head>
<body>
  <div class="container_login">
    <div class="center">
      <div class="icon text-center"> <b>Patti</b>Go-Giriş</div>
      
      <?php
        // E-posta ve şifre hatası varsa, alert içinde gösterilecek
        if (!empty($email_err) || !empty($password_err)) {
            echo '<div class="alert alert-danger">';
            if (!empty($email_err)) echo '<p>' . $email_err . '</p>';
            if (!empty($password_err)) echo '<p>' . $password_err . '</p>';
            echo '</div>';
        }

        // Genel login hatası varsa
        if (!empty($login_err)) {
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }
      ?>

      <form action="login.php" method="POST">
        <div class="txt_field">
          <input type="email" name="email" id="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid': ''?>" value="<?php echo $email; ?>">
          <span></span>
          <label for="email">Eposta</label>
        </div>

        <div class="txt_field">
          <input type="password" name="password" id="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid': ''?>" >
          <span></span>
          <label for="password">Şifre</label>
        </div>
        
        <div class="pass"><a href="reset_password.php">Şifremi Unuttum?</a></div>
        <input type="submit" name="login" value="Giriş Yap">
        <div class="signup_link">
          Üye Değil misiniz? <a href="kaydol.php">Kaydol</a>
        </div>
      </form>
    </div>
  </div>
  
</body>
</html>
