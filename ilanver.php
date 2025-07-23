<?php 
// Gerekli dosyaları ekleyin
require "libs/vars.php";
require "libs/ayar.php";
require "libs/functions.php";
?>

<?php 
if (isset($_POST["ilanver"]) && isset($_SESSION["kullanici_id"])) {
    $kategori = $urun = $urunetiketi = $urunbaslik = $sehir = $fiyat = $foto = $aciklama = "";
    $kategori_err = $urun_err = $urunetiketi_err = $urunbaslik_err = $sehir_err = $fiyat_err = $foto_err = $aciklama_err = "";
    $kullanici_id = $_SESSION["kullanici_id"];
    
    // İlan kategorisi
    if (!empty($_POST['kategori'])) {
        $kategori = $_POST['kategori'];
    } else {
        $kategori_err = "Tür hatası";
    }
    
    // Ürün bilgisi
    if (!empty($_POST['urun'])) {
        $urun = $_POST['urun'];
    } else {
        $urun_err = "Irk hatası";
    }
    
    // Ürün etiketi
    if (!empty($_POST['radio'])) {
        $urunetiketi = $_POST['radio'];
    } else {
        $urunetiketi_err = "Kimden hatası";
    }
    
    // Cinsiyet
    if (!empty($_POST['cinsiyet'])) {
        $cinsiyet = $_POST['cinsiyet'];
    } else {
        $cinsiyet_err = "Cinsiyet hatası";
    }
    
    // Ürün başlığı
    if (empty(trim($_POST["urunbaslik"]))) {
        $urunbaslik_err = "İlan başlığı girmelisiniz.";
    } elseif (strlen(trim($_POST["urunbaslik"])) < 8 || strlen(trim($_POST["urunbaslik"])) > 79) {
        $urunbaslik_err = "İlan başlığı 10-80 karakter arasında olmalıdır.";
    } else {
        $urunbaslik = $_POST["urunbaslik"];
    }
    
    // Şehir
    if (!empty($_POST['Sehir'])) {
        $sehir = $_POST['Sehir'];
    } else {
        $sehir_err = "Şehir hatası";
    }
    
    // Fiyat
    if (empty(trim($_POST["fiyat"]))) {
        $fiyat_err = "Yaş girmelisiniz.";
    } elseif ($_POST["fiyat"] < 0 || $_POST["fiyat"] > 10000000) {
        $fiyat_err = "Fiyat 0-10.000.000 aralığında olmalıdır.";
    } elseif (!is_numeric($_POST["fiyat"])) {
        $fiyat_err = "Yaş yalnızca sayılardan oluşmalıdır.";
    } else {
        $fiyat = $_POST["fiyat"];
    }
    
    // Açıklama
    $descriptions = isset($_POST['aciklama']) ? $_POST['aciklama'] : '';
    if (empty($descriptions)) {
        $descriptions_err = "Açıklama alanı boş bırakılamaz.";
    }

    // Fotoğraf yükleme
    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] == 0) {
        $uploadOk = 1;
        $fileTmpPath = $_FILES["foto"]["tmp_name"];
        $fileName = $_FILES["foto"]["name"];
        $dosya_uzantilari = array('jpg', 'jpeg', 'png');
        
        $fileSize = $_FILES["foto"]["size"];
        if ($fileSize > 5000000) { // 5MB
            $foto_err = "Dosya boyutu fazla.";
            $uploadOk = 0;
        }
        
        $dosyaAdi_Arr = explode(".", $fileName);
        $dosyaAdi_uzantisiz = $dosyaAdi_Arr[0];
        $dosya_uzantisi = $dosyaAdi_Arr[1];
        if (!in_array($dosya_uzantisi, $dosya_uzantilari)) {
            $foto_err = "Geçersiz dosya uzantısı. Kabul edilen uzantılar: " . implode(', ', $dosya_uzantilari);
            $uploadOk = 0;
        }
        
        $yeni_dosyaAdi = md5(time() . $dosyaAdi_uzantisiz) . '.' . $dosya_uzantisi;
        $uploadFolder = './img/';
        $dest_path = $uploadFolder . $yeni_dosyaAdi;
        
        if ($uploadOk && move_uploaded_file($fileTmpPath, $dest_path)) {
            $foto = $yeni_dosyaAdi;
        } else {
            $foto_err = "Fotoğraf yüklenemedi.";
        }
    } else {
        $foto_err = "Fotoğraf yükleme hatası.";
    }
    
    // Hata yoksa veritabanına ekleme işlemi
    if (empty($kategori_err) && empty($urun_err) && empty($urunetiketi_err) && empty($urunbaslik_err) && empty($sehir_err) && empty($fiyat_err) && empty($foto_err) && empty($aciklama_err)&& empty($cinsiyet_err)) {
        // setProducts fonksiyonuna aciklama ve foto parametreleri de eklenir
        setProducts($kategori, $urun, $urunetiketi, $urunbaslik, $sehir, $fiyat, $yeni_dosyaAdi, $kullanici_id, $descriptions, $cinsiyet);
        
        // İlan oluşturuldu mesajı
        echo "<script>alert('İlan başarıyla oluşturuldu!'); window.location.href = 'index.php';</script>";
        exit();
    } else {
        echo "Bazı hatalar mevcut";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İlanver</title>
    <meta name="keyword" content="ilanver,sahiplendir">
    <meta name="description" content="Evcil hayvanlar için güvenli ve kolay sahiplendirme platformu. İlanlarınızı ücretsiz ekleyin.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/css/global.css">
    <link rel="stylesheet" href="views/css/main.css">
 

    <style>

</style>

</head>
<body class="gri_fon">

<?php include "views/_navbar.php" ?>
        
    <!--ilan ver form-->
   
     <!--giriş yapılmadıysa -->
  <?php if (!isLoggedin()): ?>
            <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
           Giriş yapmadan ilan veremessiniz. <a href="login.php">Giriş Yap</a>
      </div>
        
  <?php else: ?>
      <div class="ilan-ver-container">
           <form action="ilanver.php" method="post" enctype="multipart/form-data"> 
                    <div class="ilan-ver-item">
                    <h1>Hayvan Türü</h1>
                <div class="ilan-item-content">
                    <?php if(!empty($kategori_err)){
                        echo $kategori_err;
                    }?>
                    <select name="kategori" id="kategori" onchange="this.form.submit()">
                        <option value="0" hidden disabled <?= (!isset($_POST['kategori'])) ? 'selected' : '' ?>>Tür Seçiniz</option>
                        <option value="Kedi" <?= (isset($_POST['kategori']) && $_POST['kategori'] == 'Kedi') ? 'selected' : '' ?>>Kedi</option>
                        <option value="Köpek" <?= (isset($_POST['kategori']) && $_POST['kategori'] == 'Köpek') ? 'selected' : '' ?>>Köpek</option>
                        <option value="Kuş" <?= (isset($_POST['kategori']) && $_POST['kategori'] == 'Kuş') ? 'selected' : '' ?>>Kuş</option>
                    </select>
                </div>
            </div>
            <div class="ilan-ver-item">
                <h1>Cinsiyet</h1>
                <div class="ilan-item-content">
                    <input type="radio" id="Erkek" name="cinsiyet" value="Erkek" required>
                    <label for="Erkek">Erkek</label><br>
                    <input type="radio" id="Dişi" name="cinsiyet" value="Dişi" required>
                    <label for="Dişi">Dişi</label>
                </div>
            </div>
            <div class="ilan-ver-item">
                <h1>Hayvan Irkı</h1>
                <div class="ilan-item-content">
                    <?php if(!empty($urun_err)){
                        echo $urun_err;
                    } ?>
                    <select name="urun" id="urun_ad">
                        <option value="0" hidden disabled selected>Irk Seçiniz</option>
                        <?php
                        // Seçilen hayvan türüne göre ırkları getir.
                        if (isset($_POST['kategori'])) {
                            $kategori = $_POST['kategori'];
                            $irks = [];

                            if ($kategori == "Kedi") {
                                $irks = [
                                    "American Shorthair" => "Amerikan Shorthair",
                                    "Ankara" => "Ankara Kedisi",
                                    "Balinese" => "Balinese ",
                                    "Bengal" => "Bengal ",
                                    "Birman" => "Birman ",
                                    "Bombay" => "Bombay ",
                                    "British Shorthair" => "British Shorthair ",
                                    "Chartreux" => "Chartreux ",
                                    "Devon Rex" => "Devon Rex ",
                                    "Habeş" => "Habeş Kedisi ",
                                    "Himalayan" => "Himalayan ",
                                    "Japon Bobtail" => "Japon Bobtail ",
                                    "Korat" => "Korat ",
                                    "Maine Coon" => "Maine Coon ",
                                    "Manx" => "Manx ",
                                    "Oriental" => "Oriental ",
                                    "Persian" => "Persian ",
                                    "Ragdoll" => "Ragdoll ",
                                    "Russian Blue" => "Russian Blue ",
                                    "Savannah" => "Savannah ",
                                    "Scottish Fold" => "Scottish Fold ",
                                    "Siyam" => "Siyam Kedisi ",
                                    "Sibirya" => "Sibirya Kedisi ",
                                    "Singapura" => "Singapura ",
                                    "Somali" => "Somali ",
                                    "Tekir" => "Tekir ",
                                    "Van" => "Van Kedisi",
                                    "Diger" => "Diğer (Listede Yok)"
                                ];
                            } elseif ($kategori == "Köpek") {
                                $irks = [
                                    "Akbaş" => "Akbaş",
                                    "Alman Kurdu" => "Alman Kurdu",
                                    "American Akita" => "Amerikan Akita ",
                                    "Bulldog" => "Bulldog ",
                                    "Çoban" => "Çoban Köpeği ",
                                    "Basset Hound" => "Basset Hound ",
                                    "Beagle" => "Beagle ",
                                    "Belçika Malinois" => "Belçika Malinois ",
                                    "Bern dag" => "Bern Dağ Köpeği ",
                                    "Bichon Frise" => "Bichon Frise ",
                                    "Border Collie" => "Border Collie ",
                                    "Boxer" => "Boxer ",
                                    "Cane Corso" => "Cane Corso ",
                                    "Charles" => "Charles ",
                                    "Chihuahua" => "Chihuahua ",
                                    "Chow chow" => "Chow Chow ",
                                    "Cocker Spaniel" => "Cocker Spaniel ",
                                    "Çoban" => "Çoban Köpeği ",
                                    "Dalmaçyalı" => "Dalmaçyalı ",
                                    "Doberman" => "Doberman ",
                                    "Golden" => "Golden ",
                                    "Husky" => "Husky ",
                                    "Japon Spitz" => "Japon Spitz ",
                                    "Kangal" => "Kangal ",
                                    "Labrador" => "Labrador ",
                                    "Maltese" => "Maltese ",
                                    "Mastiff" => "Mastiff ",
                                    "Pointer" => "Pointer ",
                                    "Poddle" => "Poodle ",
                                    "Rottweiler" => "Rottweiler ",
                                    "Setter" => "Setter ",
                                    "Terrier" => "Terrier ",
                                    "Diger" => "Diğer (Listede Yok)"
                                ];
                            } elseif ($kategori == "Kuş") {
                                $irks = [
                                    "Agra" => "Agra ",
                                    "Afrikalı" => "Afrikali ",
                                    "Amazon" => "Amazon ",
                                    "Bülbül" => "Bülbül ",
                                    "Tüy Bitti" => "Cockatiel ",
                                    "Cennet kuşu" => "Cennet Kuşu ",
                                    "Dalgıç" => "Dalgıç ",
                                    "Dodo" => "Dodo ",
                                    "Ejderha" => "Ejderha Kuşu ",
                                    "Jako" => "Jako ",
                                    "Kanarya" => "Kanarya ",
                                    "Kakadu" => "Kakadu ",
                                    "Muhabbet Kuşu" => "Muhabbet Kuşu ",
                                    "Papağan" => "Papağan ",
                                    "Saka" => "Saka ",
                                    "Yuvarlak" => "Yuvarlak ",
                                    "Zebra" => "Zebra ",
                                    "Diger" => "Diğer (Listede Yok)"
                                ];
                            }

                            foreach ($irks as $key => $value) {
                                echo "<option value='$key'>$value</option>";
                            }
                        }
                        ?>
                            </select>
                        </div>
                    </div>

                    <div class="ilan-ver-item">
                        <h1>Yaş</h1>
                        <div class="ilan-item-content">
                        <?php if(!empty($fiyat_err)){
                               echo $fiyat_err;
                            }?>
                            <input id="fiyat" name="fiyat" placeholder="Yaş giriniz" type="number" min="0" max="10000000" >
                            <label for="fiyat">Yıl</label>
                        </div>
                    </div>
                    

                    <div class="ilan-ver-item">
                        <h1>Kimden</h1>
                        <div class="ilan-item-content">
                        <?php if(!empty($urunetiketi_err)){
                               echo $urunetiketi_err;
                            }?>
                            <input type="radio" id="Sahibinden" name="radio" value="Sahibinden">
                            <label for="Sahibinden">Sahibinden</label><br>
                            <input type="radio" id="Barınakdan" name="radio" value="Barınakdan">
                            <label for="Barınakdan">Barınaktan</label>
                        </div>
                    </div>
                    <div class="ilan-ver-item">
                        <h1>Başlık</h1>
                        <div class="ilan-item-content">
                        <?php if(!empty($urunbaslik_err)){
                               echo $urunbaslik_err;
                            }?>
                            <input required placeholder="İlan başlığı(max80 karakter)" name="urunbaslik" type="text" minlength="8" maxlength="80" id="baslik">
                            
                            
                        </div>
                    </div>
                    <div class="ilan-ver-item">
    <h1>Açıklama</h1>
    <div class="ilan-item-content">
        <?php if(!empty($aciklama_err)){
            echo $aciklama_err;
        }?>
        <textarea name="aciklama" placeholder="İlan açıklamasını buraya girin" rows="" cols=""></textarea>
    </div>
</div>
                    <div class="ilan-ver-item">
                        <h1>Bulunduğunuz Şehir</h1>
                        <div class="ilan-item-content">
                        <?php if(!empty($sehir_err)){
                               echo $sehir_err;
                            }?>
                            <select name="Sehir" required>
                                <option  hidden disabled selected value value="0">Lütfen Şehir Seçiniz</option>
                                <option value="İstanbul">İstanbul</option>
                                <option value="Ankara">Ankara</option>
                                <option value="İzmir">İzmir</option>
                                <option value="Adana">Adana</option>
                                <option value="Adıyaman">Adıyaman</option>
                                <option value="Afyonkarahisar">Afyonkarahisar</option>
                                <option value="Ağrı">Ağrı</option>
                                <option value="Aksaray">Aksaray</option>
                                <option value="Amasya">Amasya</option>
                                <option value="Antalya">Antalya</option>
                                <option value="Ardahan">Ardahan</option>
                                <option value="Artvin">Artvin</option>
                                <option value="Aydın">Aydın</option>
                                <option value="Balıkesir">Balıkesir</option>
                                <option value="Bartın">Bartın</option>
                                <option value="Batman">Batman</option>
                                <option value="Bayburt">Bayburt</option>
                                <option value="Bilecik">Bilecik</option>
                                <option value="Bingöl">Bingöl</option>
                                <option value="Bitlis">Bitlis</option>
                                <option value="Bolu">Bolu</option>
                                <option value="Burdur">Burdur</option>
                                <option value="Bursa">Bursa</option>
                                <option value="Çanakkale">Çanakkale</option>
                                <option value="Çankırı">Çankırı</option>
                                <option value="Çorum">Çorum</option>
                                <option value="Denizli">Denizli</option>
                                <option value="Diyarbakır">Diyarbakır</option>
                                <option value="Düzce">Düzce</option>
                                <option value="Edirne">Edirne</option>
                                <option value="Elazığ">Elazığ</option>
                                <option value="Erzincan">Erzincan</option>
                                <option value="Erzurum">Erzurum</option>
                                <option value="Eskişehir">Eskişehir</option>
                                <option value="Gaziantep">Gaziantep</option>
                                <option value="Giresun">Giresun</option>
                                <option value="Gümüşhane">Gümüşhane</option>
                                <option value="Hakkâri">Hakkâri</option>
                                <option value="Hatay">Hatay</option>
                                <option value="Iğdır">Iğdır</option>
                                <option value="Isparta">Isparta</option>
                                <option value="Kahramanmaraş">Kahramanmaraş</option>
                                <option value="Karabük">Karabük</option>
                                <option value="Karaman">Karaman</option>
                                <option value="Kars">Kars</option>
                                <option value="Kastamonu">Kastamonu</option>
                                <option value="Kayseri">Kayseri</option>
                                <option value="Kırıkkale">Kırıkkale</option>
                                <option value="Kırklareli">Kırklareli</option>
                                <option value="Kırşehir">Kırşehir</option>
                                <option value="Kilis">Kilis</option>
                                <option value="Kocaeli">Kocaeli</option>
                                <option value="Konya">Konya</option>
                                <option value="Kütahya">Kütahya</option>
                                <option value="Malatya">Malatya</option>
                                <option value="Manisa">Manisa</option>
                                <option value="Mardin">Mardin</option>
                                <option value="Mersin">Mersin</option>
                                <option value="Muğla">Muğla</option>
                                <option value="Muş">Muş</option>
                                <option value="Nevşehir">Nevşehir</option>
                                <option value="Niğde">Niğde</option>
                                <option value="Ordu">Ordu</option>
                                <option value="Osmaniye">Osmaniye</option>
                                <option value="Rize">Rize</option>
                                <option value="Sakarya">Sakarya</option>
                                <option value="Samsun">Samsun</option>
                                <option value="Siirt">Siirt</option>
                                <option value="Sinop">Sinop</option>
                                <option value="Sivas">Sivas</option>
                                <option value="Şırnak">Şırnak</option>
                                <option value="Tekirdağ">Tekirdağ</option>
                                <option value="Tokat">Tokat</option>
                                <option value="Trabzon">Trabzon</option>
                                <option value="Tunceli">Tunceli</option>
                                <option value="Şanlıurfa">Şanlıurfa</option>
                                <option value="Uşak">Uşak</option>
                                <option value="Van">Van</option>
                                <option value="Yalova">Yalova</option>
                                <option value="Yozgat">Yozgat</option>
                                <option value="Zonguldak">Zonguldak</option>
                            </select>
                        </div>
                    </div>

                    <div class="ilan-ver-item">
    <div style="display: flex; align-items: center; gap: 10px;">
        <h1 style="margin: 0;">Fotoğraf Yükle</h1>
        <h3 style="margin: 0; font-size: 20px;">(maximum 4.9MB)</h3>
    </div>
    <div class="ilan-item-content foto-diza">
        <?php 
        if (!empty($foto_err)) {
            echo $foto_err;
        } 
        ?>
        <input type="file" name="foto">
    </div>
</div>


                    <input id="ilan-upload" type="submit" name="ilanver" value="İlan Ver">
                    
           </form>

          
      </div>
  <?php endif; ?> 
     <!--giriş yapıldıysa-->



     

</body>

</html>