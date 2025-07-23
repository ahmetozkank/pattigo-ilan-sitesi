<?php

require "libs/vars.php";
require "libs/functions.php";  
?>

<?php include "views/_header.php" ?>
<?php include "views/_navbar.php" ?>
<?php include "views/_ilanlarim.php" ?>
<?php  
if (isset($_GET["id"])) { 
    $id = $_GET["id"];
    $result = getProductbyId($id);
    $selecteProduct = mysqli_fetch_assoc($result);   

    $kisi = getPerson($selecteProduct["owner_id"]);
    $person = mysqli_fetch_assoc($kisi);    
 
    $urun = mysqli_fetch_assoc(getProductbyId($_GET["id"]));
} else {
    $result = getHomePageProducts();
}
?>

<div class="container">
    <div class="section">
        <?php if (!empty($urun)): ?>
            <div class="product-card">
                <div class="imgcontainer" onclick="openModal()">
                    <img src="img/<?php echo $urun["imageUrl"] ?>" alt="<?php echo $urun["title"] ?>">
                </div>
                <div class="details">
                    <h2 class="product-title"><?php echo $urun["title"] ?></h2>
                    <div class="info">
                        <span class="location"><i class="fa-solid fa-location-dot"></i> <?php echo $urun["sehir"] ?></span>
                        <span class="age"><b><?php echo $urun["price"] ?> Yaşında</b></span>
                    </div>
                </div>
            </div>
            <div class="description-container">
                <h3 class="aside-title">Açıklama</h3>
                <p><?php echo nl2br(htmlspecialchars($urun["descriptions"])); ?></p>
                
            </div>
        <?php else: ?>
            <div class="alert alert-warning">
                <p>Bu aramaya uygun ürün bulunamadı.</p>
            </div>
        <?php endif; ?> 
    </div>

    <aside class="aside beyaz_fon">
        <div class="info-section">
            <h3 class="aside-title">Sahip Bilgileri</h3>
            <ul>
                <li><strong>İsim:</strong> <?php echo $person["isim"]; ?></li>
                <li><strong>Email:</strong> <?php echo $person["email"]; ?></li>
                <li><strong>Tel:</strong> <?php echo $person["tel"]; ?></li>
                <li><strong>Tarih:</strong> <?php echo " " . $urun["dateAdded"]; ?></li>
            </ul>
        </div>
        <div class="info-section">
            <h3 class="aside-title">Hayvan Bilgileri</h3>
            <ul>
                <li><strong>Kimden:</strong> <?php echo $urun["uetiketi"]; ?></li>
                <li><strong>Irk:</strong> <?php echo $urun["ubilgisi"]; ?></li>
                <li><strong>Tür:</strong> <?php echo $urun["ikategori"]; ?></li>
                <li><strong>Cins:</strong> <?php echo $urun["Cinsiyeti"]; ?></li>
                
            </ul>
        </div>
    </aside>
</div>

<!-- Modal -->
<div id="imageModal" class="modal" onclick="closeModal()">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="modalImage">
</div>



<script>
    // Modal'ı açan fonksiyon
    function openModal() {
        document.getElementById("imageModal").style.display = "block"; // Modal'ı görünür hale getirir
        document.getElementById("modalImage").src = "img/<?php echo $urun["imageUrl"] ?>"; // Resmi modal içerisine yerleştirir
    }

    // Modal'ı kapatan fonksiyon
    function closeModal() {
        document.getElementById("imageModal").style.display = "none"; // Modal'ı gizler
    }

    // Resmi büyütme ve küçültme işlemi
    let zoomLevel = 1; // Başlangıç zoom seviyesi

    // Fare kaydırma ile zoom yapmak için event listener ekle
    document.getElementById('modalImage').addEventListener('wheel', function(e) {
        if (e.deltaY < 0) {
            // Yukarı kaydırma (zoom in)
            zoomLevel += 0.1;
        } else {
            // Aşağı kaydırma (zoom out)
            zoomLevel = Math.max(0.1, zoomLevel - 0.1); // Minimum zoom seviyesi 0.5 olara
        }

        // Resmi büyütme veya küçültme işlemi
        this.style.transform = 'translate(-50%, -50%) scale(' + zoomLevel + ')'; // Resmi tam ortalayarak büyütme/küçültme
        e.preventDefault(); // Sayfa kaydırılmasını engeller
    });
</script>
