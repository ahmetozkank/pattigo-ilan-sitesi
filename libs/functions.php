<?php
include "ayar.php";
// Anasayfa için aktif ürünleri tarihe göre getir
function getHomePageProducts() {
    include "ayar.php";

    $query = "SELECT * from products WHERE isActive=1 ORDER BY dateAdded";
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
    return $result;
} 
// Verilen id'ye göre ürünü getir
function getProducts($id){
    include "ayar.php";
    $query = "SELECT * FROM products WHERE id='$id'";// Belirtilen ID'ye sahip ürünü almak için SQL sorgusu
    $result = mysqli_query($connection, $query); // Sorguyu veritabanında çalıştır ve sonucu al.
    mysqli_close($connection);// Veritabanı bağlantısını kapat.
    return $result;// Sorgu sonucunu döndür.
}
// Verilen kullanıcı id'sine göre kullanıcının ürünlerini getir
function getMyProducts($id){
    include "ayar.php";

    $query = "SELECT * FROM products WHERE owner_id=$id";
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
    return $result;
}
// Verilen ürün id'sini aktif hale getir
function productActive($id){
    include "ayar.php";

    $query = "UPDATE products SET isActive='1' WHERE id=$id";
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
    return $result;
}
// Verilen ürün id'sine göre ürünü siler
function productDelete($id){
    include "ayar.php";
     
    $query = "DELETE FROM products WHERE id=$id";
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
     
}
// Tüm ürünleri getirir (Yönetici için)
function getAdminProducts(){
    include "ayar.php";

    $query = "SELECT * FROM products";
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
    return $result;

}
// Belirli bir kullanıcı id'sine göre kullanıcı bilgilerini getirir
function getPerson($id) {
    include "ayar.php";

    $query = "SELECT * FROM users WHERE kullanici_id=$id";
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
    return $result;
}
// Verilen e-posta adresine göre kullanıcı bilgilerini getirir
function getMail($bmail) {
    include "ayar.php";

    $query = "SELECT * FROM users WHERE email='$bmail'";
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
    return $result;
}
// Verilen telefon numarasına göre kullanıcı bilgilerini getirir
function getPhone($tel) {
    include "ayar.php";

    $query = "SELECT * FROM users WHERE tel='$tel'";
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
    return $result;
}
// Belirli bir anahtar kelimeye göre ürünleri arar
function getProductsByKeyword($q) {
    include "ayar.php";

    $query = "SELECT * FROM products WHERE title LIKE '%$q%'";
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
    return $result;
}
// Belirli bir kullanıcı id'sine göre kullanıcı telefon numarasını günceller
function setPhone($kİd,$tel) {
    include "ayar.php";
    $query = "UPDATE users SET tel='$tel' WHERE kullanici_id='$kİd'";
    $result = mysqli_query($connection, $query);
    echo mysqli_error($connection);
    mysqli_close($connection);
}
// Yeni bir ürün kaydı oluşturur
    function setProducts($kategori, $urun, $urunetiketi, $urunbaslik, $sehir, $fiyat, $yeni_dosyaAdi, $kId, $descriptions, $cinsiyet) {
        include "ayar.php";
        $query = "INSERT INTO products (title, sehir, price, ikategori, ubilgisi, uetiketi, owner_id, imageUrl, isActive, dateAdded, descriptions, Cinsiyeti) 
                  VALUES ('$urunbaslik', '$sehir', '$fiyat', '$kategori', '$urun', '$urunetiketi', '$kId', '$yeni_dosyaAdi', '0', current_timestamp(), '$descriptions', '$cinsiyet')";
    
        $result = mysqli_query($connection, $query);
        echo mysqli_error($connection);
        mysqli_close($connection);
    }
    
// Ürün güncelleme işlemi yapar (mevcut ürünü silip yeni veri ekler)
function updateProducts($kategori, $urun, $urunetiketi, $urunbaslik, $sehir , $fiyat, $yeni_dosyaAdi, $kİd, $silId, $aciklama, $cinsiyet) {
    include "ayar.php";
    $query = "DELETE FROM products WHERE id=$silId";
    $result = mysqli_query($connection, $query);
    $query = "INSERT INTO products (id, title, sehir, price, ikategori, ubilgisi, uetiketi, owner_id, imageUrl, isActive, dateAdded, descriptions, Cinsiyeti) VALUES (NULL, '$urunbaslik', '$sehir', '$fiyat', '$kategori', '$urun', '$urunetiketi', '$kİd', '$yeni_dosyaAdi','0', current_timestamp(), '$aciklama', '$cinsiyet')";
    $result = mysqli_query($connection, $query);
    echo mysqli_error($connection);
    mysqli_close($connection);
}

// Kullanıcı şifresini günceller
function SetPassword($kİd,$newpassword) {
    include "ayar.php";
    $query = "UPDATE users SET password='$newpassword' WHERE kullanici_id='$kİd'";
    $result = mysqli_query($connection, $query);
    echo mysqli_error($connection);
    mysqli_close($connection);
}
// Kullanıcı e-posta adresini günceller
function setMail($kİd,$eposta) {
    include "ayar.php";
    $query = "UPDATE users SET email='$eposta' WHERE kullanici_id='$kİd'";
    $result = mysqli_query($connection, $query);
    echo mysqli_error($connection);
    mysqli_close($connection);
}


// Ürün id'sine göre ürün detaylarını getirir
function getProductbyId($urunid) {
    include "ayar.php"; 

    $query = "SELECT * from products WHERE id='$urunid'";
    $result = mysqli_query($connection,$query);
    mysqli_close($connection);
    return $result;
}

// Kullanıcının oturum açıp açmadığını ktrol eder.
function isLoggedin() {
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        return true;
    } else {
        return false;
    }
}

// Kullanıcının yönetici (admin) olup olmadığını kontrol eder
function isAdmin() {
    if (isLoggedin() && isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "admin") {
        return true;
    } else {
        return false;
    }
}

// Veritabanı bağlantısı
global $connection; 

// Veritabanında bir kategoride kaç ürün olduğunu sayar
function getCategoryCount($category) {
    global $connection;
    $sql = "SELECT COUNT(*) as count FROM products WHERE ikategori = '$category'";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['count'];
    }
    return 0; // Eğer sorgu başarısız olursa 0 döndür
}

// Belirli bir kategorideki ürünleri getirir
function getProductsByCategory($category) {
    global $connection;
    $sql = "SELECT * FROM products WHERE ikategori = '$category'";
    return mysqli_query($connection, $sql);
}

// Tür ve ırka göre ürünleri filtreler
function getProductsByTypeAndBreed($category, $breed) {
    global $connection;
    if ($breed == '') {
        $sql = "SELECT * FROM products WHERE ikategori = '$category'";
    } else {
        $sql = "SELECT * FROM products WHERE ikategori = '$category' AND ubilgisi = '$breed'";
    }
    return mysqli_query($connection, $sql);
}

// Belirli bir ırkta kaç ürün olduğunu sayar
function getBreedCount($breed) {
    global $connection;
    $sql = "SELECT COUNT(*) as count FROM products WHERE ubilgisi = '$breed'";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['count'];
    }
    return 0; // Eğer sorgu başarısız olursa 0 döndür
}

// Belirli bir şehirdeki ürünleri getirir
function getProductsByCity($city) {
    global $connection;
    $sql = "SELECT * FROM products WHERE sehir = '$city'";
    return mysqli_query($connection, $sql);
}

// Şehir ve kategoriye göre filtreleme yapar
function getProductsByCityAndCategory($city, $category) {
    global $connection;
    $sql = "SELECT * FROM products WHERE sehir = '$city' AND ikategori = '$category'";
    return mysqli_query($connection, $sql);
}


// Fiyat aralığına göre ürünleri getirir
function getProductsByPriceRange($min_price, $max_price) {
    global $connection;
    $query = "SELECT * FROM products WHERE price BETWEEN ? AND ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("dd", $min_price, $max_price); // Fiyat aralığını bağla
    $stmt->execute();
    return $stmt->get_result();
}

// Filtrelerle ürünleri getirir
function getProductsWithFilters($filters) {
    global $connection;

    // WHERE koşulları dizisini başlat
    $whereClauses = [];

    // Yalnızca aktif ürünleri seç
    $whereClauses[] = "isActive = 1"; // isActive koşulu ekleniyor

    // Kategoriyi kontrol et
    if (!empty($filters['category'])) {
        $category = mysqli_real_escape_string($connection, $filters['category']);
        $whereClauses[] = "ikategori = '$category'"; // Kategori filtresi
    }

    // Türü kontrol et
    if (!empty($filters['type'])) {
        $type = mysqli_real_escape_string($connection, $filters['type']);
        $whereClauses[] = "ikategori = '$type'"; // Type filtresi
    }

    // Irkı kontrol et
    if (!empty($filters['breed'])) {
        $breed = mysqli_real_escape_string($connection, $filters['breed']);
        $whereClauses[] = "ubilgisi = '$breed'"; // Breed filtresi
    }

    // Şehri kontrol et
    if (!empty($filters['city'])) {
        $city = mysqli_real_escape_string($connection, $filters['city']);
        $whereClauses[] = "sehir = '$city'"; // City filtresi
    }

    // Fiyat filtresi
    if (!empty($filters['fiyat'])) {
        $fiyat = floatval($filters['fiyat']);  // Fiyatı sayıya dönüştür
        $whereClauses[] = "price <= $fiyat";  // Fiyat filtresi
    }

    // Cinsiyet filtresi
    if (!empty($filters['cinsiyet'])) {
        $cinsiyet = mysqli_real_escape_string($connection, $filters['cinsiyet']);
        $whereClauses[] = "Cinsiyeti = '$cinsiyet'"; // Cinsiyet filtresi
    }

    // Filtrelerin birleşimini kontrol et
    $whereSql = implode(' AND ', $whereClauses);

    // Eğer filtre varsa WHERE ekle
    if (!empty($whereSql)) {
        $whereSql = 'WHERE ' . $whereSql;
    }

    // SQL sorgusunu oluşturun
    $sql = "SELECT * FROM products $whereSql";

    return mysqli_query($connection, $sql);
}

function getAdminProductsWithUserInfo() {
    global $connection;

    $sql = "SELECT p.*, u.isim, u.kullanici_id 
            FROM products p
            LEFT JOIN users u ON p.owner_id = u.kullanici_id";
    $stmt = mysqli_prepare($connection, $sql);

    if ($stmt === false) {
        return []; // Veritabanı sorgusu hatalıysa boş döndür
    }

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    return $result;
}


?>
