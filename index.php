<?php  
    require "libs/vars.php"; // Gerekli değişkenleri tanımlayan dosyayı dahil ediyor
    require "libs/functions.php"; // Gerekli fonksiyonları içeren dosyayı dahil ediyor
?>

<?php include "views/_header.php" ?> <!-- Sayfa başlığı ve meta etiketlerini içeren başlık dosyasını dahil ediyor -->
<?php include "views/_navbar.php" ?> <!-- Navigasyon çubuğunu içeren dosyayı dahil ediyor -->




<div class="container">
    <aside class="sidebar">
<section class="filter-summary">
    <h3>Seçilen Filtreler</h3>
    <ul>
        <?php
        // Aktif filtreleri almak için URL kontrol et
        $filters = [
            'category' => isset($_GET['category']) ? $_GET['category'] : null,
            'breed' => isset($_GET['breed']) ? $_GET['breed'] : null,
            'city' => isset($_GET['city']) ? $_GET['city'] : null,
            'fiyat' => isset($_GET['fiyat']) ? $_GET['fiyat'] : null,
            'cinsiyet' => isset($_GET['cinsiyet']) ? $_GET['cinsiyet'] : null,
        ];

        // Kategoriyi filtrele
        foreach ($filters as $key => $value) {
            if ($value) {
                // Her filtre için bir liste öğesi göster
                switch ($key) {
                    case 'category':
                        $label = 'Kategori';
                        break;
                    case 'breed':
                        $label = 'Irk';
                        break;
                    case 'city':
                        $label = 'Şehir';
                        break;
                    case 'fiyat':
                        $label = 'Yaş';
                        break;
                    case 'cinsiyet':
                        $label = 'Cinsiyet';
                        break;
                    default:
                        $label = ucfirst($key); // Varsayılan olarak anahtar adını kullan
                }

                echo "<li>" . $label . ": " . htmlspecialchars($value);
                echo "<form method='get' style='display:inline;'>";

                // Diğer filtre parametrelerini koruyarak sadece o filtreyi silmek için gizli input 
                foreach ($filters as $filterKey => $filterValue) {
                    if ($filterKey != $key && $filterValue) {
                        echo "<input type='hidden' name='" . htmlspecialchars($filterKey) . "' value='" . htmlspecialchars($filterValue) . "'>";
                    }
                }

                // Seçilen filtreyi silme butonu
                echo "<input type='hidden' name='" . htmlspecialchars($key) . "' value=''>";
                echo "<button type='submit' class='remove-filter'>X</button>";
                echo "</form></li>";
            }
        }
        ?>
    </ul>
</section>
<br>
<br>

<section class="category">
    <h3>Evcil Hayvanlar</h3>
    <br>
    <div class="category-list">
        <!-- Kedi Kategorisi -->
        <div class="category-item">
            <a href="index.php?category=kedi<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>" class="category-link">
                Kedi (<?php echo getCategoryCount('kedi'); ?>)
            </a>
            <?php if (isset($_GET['category']) && $_GET['category'] == 'kedi'): ?>
                <ul class="breed-list">
    <li><a href="index.php?category=kedi&breed=American Shorthair<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">American Shorthair (<?php echo getBreedCount('American Shorthair'); ?>)</a></li>
    <li><a href="index.php?category=kedi&breed=Ankara<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Ankara Kedisi (<?php echo getBreedCount('Ankara'); ?>)</a></li>
    <li><a href="index.php?category=kedi&breed=Balinese<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Balinese (<?php echo getBreedCount('Balinese'); ?>)</a></li>
    <li><a href="index.php?category=kedi&breed=Bengal<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Bengal (<?php echo getBreedCount('Bengal'); ?>)</a></li>
    <li><a href="index.php?category=kedi&breed=Birman<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Birman (<?php echo getBreedCount('Birman'); ?>)</a></li>
    <li><a href="index.php?category=kedi&breed=Bombay<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Bombay (<?php echo getBreedCount('Bombay'); ?>)</a></li>
    <li><a href="index.php?category=kedi&breed=British Shorthair<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">British Shorthair (<?php echo getBreedCount('British Shorthair'); ?>)</a></li>
    <li><a href="index.php?category=kedi&breed=Chartreux<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Chartreux (<?php echo getBreedCount('Chartreux'); ?>)</a></li>
    <li><a href="index.php?category=kedi&breed=Devon Rex<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Devon Rex (<?php echo getBreedCount('Devon Rex'); ?>)</a></li>
    <li><a href="index.php?category=kedi&breed=Habeş<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Habeş Kedisi (<?php echo getBreedCount('Habeş'); ?>)</a></li>
    <li><a href="index.php?category=kedi&breed=Himalayan<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Himalayan (<?php echo getBreedCount('Himalayan'); ?>)</a></li>
    <li><a href="index.php?category=kedi&breed=Japon Bobtail<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Japon Bobtail (<?php echo getBreedCount('Japon Bobtail'); ?>)</a></li>
    <li><a href="index.php?category=kedi&breed=Korat<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Korat (<?php echo getBreedCount('Korat'); ?>)</a></li>
    <li><a href="index.php?category=kedi&breed=Maine Coon<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Maine Coon (<?php echo getBreedCount('Maine Coon'); ?>)</a></li>
    <li><a href="index.php?category=kedi&breed=Manx<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Manx (<?php echo getBreedCount('Manx'); ?>)</a></li>
    <li><a href="index.php?category=kedi&breed=Oriental<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Oriental (<?php echo getBreedCount('Oriental'); ?>)</a></li>
    <li><a href="index.php?category=kedi&breed=Persian<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Persian (<?php echo getBreedCount('Persian'); ?>)</a></li>
    <li><a href="index.php?category=kedi&breed=Ragdoll<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Ragdoll (<?php echo getBreedCount('Ragdoll'); ?>)</a></li>
    <li><a href="index.php?category=kedi&breed=Russian Blue<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Russian Blue (<?php echo getBreedCount('Russian Blue'); ?>)</a></li>
    <li><a href="index.php?category=kedi&breed=Savannah<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Savannah (<?php echo getBreedCount('Savannah'); ?>)</a></li>
    <li><a href="index.php?category=kedi&breed=Scottish Fold<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Scottish Fold (<?php echo getBreedCount('Scottish Fold'); ?>)</a></li>
    <li><a href="index.php?category=kedi&breed=Siyam<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Siyam Kedisi (<?php echo getBreedCount('Siyam'); ?>)</a></li>
    <li><a href="index.php?category=kedi&breed=Sibirya<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Sibirya Kedisi (<?php echo getBreedCount('Sibirya'); ?>)</a></li>
    <li><a href="index.php?category=kedi&breed=Singapura<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Singapura (<?php echo getBreedCount('Singapura'); ?>)</a></li>
    <li><a href="index.php?category=kedi&breed=Somali<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Somali (<?php echo getBreedCount('Somali'); ?>)</a></li>
    <li><a href="index.php?category=kedi&breed=Tekir<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Tekir (<?php echo getBreedCount('Tekir'); ?>)</a></li>
    <li><a href="index.php?category=kedi&breed=Van<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Van Kedisi (<?php echo getBreedCount('Van'); ?>)</a></li>
    <li><a href="index.php?category=kedi&breed=Diger<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Diğer (<?php echo getBreedCount('Diger'); ?>)</a></li>
</ul>

                    <?php endif; ?>
                    </div>


      <!-- Köpek Kategorisi -->
      <div class="category-item">
            <a href="index.php?category=köpek<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>" class="category-link">
                Köpek (<?php echo getCategoryCount('köpek'); ?>)
            </a>
            <?php if (isset($_GET['category']) && $_GET['category'] == 'köpek'): ?>
                <ul class="breed-list">
    <li><a href="index.php?category=köpek&breed=Akbaş<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Akbaş (<?php echo getBreedCount('Akbaş'); ?>)</a></li>
    <li><a href="index.php?category=köpek&breed=Alman Kurdu<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Alman Kurdu (<?php echo getBreedCount('Alman Kurdu'); ?>)</a></li>
    <li><a href="index.php?category=köpek&breed=American Akita<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">American Akita (<?php echo getBreedCount('American Akita'); ?>)</a></li>
    <li><a href="index.php?category=köpek&breed=Bulldog<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Bulldog (<?php echo getBreedCount('Bulldog'); ?>)</a></li>
    <li><a href="index.php?category=köpek&breed=Çoban<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Çoban Köpeği (<?php echo getBreedCount('Çoban'); ?>)</a></li>
    <li><a href="index.php?category=köpek&breed=Basset Hound<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Basset Hound (<?php echo getBreedCount('Basset Hound'); ?>)</a></li>
    <li><a href="index.php?category=köpek&breed=Beagle<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Beagle (<?php echo getBreedCount('Beagle'); ?>)</a></li>
    <li><a href="index.php?category=köpek&breed=Belçika Malinois<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Belçika Malinois (<?php echo getBreedCount('Belçika Malinois'); ?>)</a></li>
    <li><a href="index.php?category=köpek&breed=Bern Dağ<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Bern Dağ Köpeği (<?php echo getBreedCount('Bern Dağ'); ?>)</a></li>
    <li><a href="index.php?category=köpek&breed=Bichon Frise<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Bichon Frise (<?php echo getBreedCount('Bichon Frise'); ?>)</a></li>
    <li><a href="index.php?category=köpek&breed=Border Collie<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Border Collie (<?php echo getBreedCount('Border Collie'); ?>)</a></li>
    <li><a href="index.php?category=köpek&breed=Boxer<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Boxer (<?php echo getBreedCount('Boxer'); ?>)</a></li>
    <li><a href="index.php?category=köpek&breed=Cane Corso<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Cane Corso (<?php echo getBreedCount('Cane Corso'); ?>)</a></li>
    <li><a href="index.php?category=köpek&breed=Charles<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Charles (<?php echo getBreedCount('Charles'); ?>)</a></li>
    <li><a href="index.php?category=köpek&breed=Chihuahua<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Chihuahua (<?php echo getBreedCount('Chihuahua'); ?>)</a></li>
    <li><a href="index.php?category=köpek&breed=Chow Chow<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Chow Chow (<?php echo getBreedCount('Chow Chow'); ?>)</a></li>
    <li><a href="index.php?category=köpek&breed=Cocker Spaniel<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Cocker Spaniel (<?php echo getBreedCount('Cocker Spaniel'); ?>)</a></li>
    <li><a href="index.php?category=köpek&breed=Dalmaçyalı<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Dalmaçyalı (<?php echo getBreedCount('Dalmaçyalı'); ?>)</a></li>
    <li><a href="index.php?category=köpek&breed=Doberman<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Doberman (<?php echo getBreedCount('Doberman'); ?>)</a></li>
    <li><a href="index.php?category=köpek&breed=Golden<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Golden (<?php echo getBreedCount('Golden'); ?>)</a></li>
    <li><a href="index.php?category=köpek&breed=Husky<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Husky (<?php echo getBreedCount('Husky'); ?>)</a></li>
    <li><a href="index.php?category=köpek&breed=Japon Spitz<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Japon Spitz (<?php echo getBreedCount('Japon Spitz'); ?>)</a></li>
    <li><a href="index.php?category=köpek&breed=Kangal<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Kangal (<?php echo getBreedCount('Kangal'); ?>)</a></li>
    <li><a href="index.php?category=köpek&breed=Labrador<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Labrador (<?php echo getBreedCount('Labrador'); ?>)</a></li>
    <li><a href="index.php?category=köpek&breed=Maltese<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Maltese (<?php echo getBreedCount('Maltese'); ?>)</a></li>
    <li><a href="index.php?category=köpek&breed=Mastiff<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Mastiff (<?php echo getBreedCount('Mastiff'); ?>)</a></li>
    <li><a href="index.php?category=köpek&breed=Pointer<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Pointer (<?php echo getBreedCount('Pointer'); ?>)</a></li>
    <li><a href="index.php?category=köpek&breed=Poodle<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Poodle (<?php echo getBreedCount('Poodle'); ?>)</a></li>
    <li><a href="index.php?category=köpek&breed=Rottweiler<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Rottweiler (<?php echo getBreedCount('Rottweiler'); ?>)</a></li>
    <li><a href="index.php?category=köpek&breed=Setter<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Setter (<?php echo getBreedCount('Setter'); ?>)</a></li>
    <li><a href="index.php?category=köpek&breed=Terrier<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Terrier (<?php echo getBreedCount('Terrier'); ?>)</a></li>
    <li><a href="index.php?category=köpek&breed=Diğer<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Diğer (<?php echo getBreedCount('Diğer'); ?>)</a></li>
</ul>

                    <?php endif; ?>
                    </div>

<!-- Kuş Kategorisi -->
<div class="category-item">
    <a href="index.php?category=kuş<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>" class="category-link">
        Kuş (<?php echo getCategoryCount('kuş'); ?>)
    </a>
    <?php if (isset($_GET['category']) && $_GET['category'] == 'kuş'): ?>
        <ul class="breed-list">
    <li><a href="index.php?category=kuş&breed=Agra<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Agra (<?php echo getBreedCount('Agra'); ?>)</a></li>
    <li><a href="index.php?category=kuş&breed=Afrikalı<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Afrikalı (<?php echo getBreedCount('Afrikalı'); ?>)</a></li>
    <li><a href="index.php?category=kuş&breed=Amazon<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Amazon (<?php echo getBreedCount('Amazon'); ?>)</a></li>
    <li><a href="index.php?category=kuş&breed=Bülbül<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Bülbül (<?php echo getBreedCount('Bülbül'); ?>)</a></li>
    <li><a href="index.php?category=kuş&breed=Cockatiel<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Tüy Bitti (<?php echo getBreedCount('Cockatiel'); ?>)</a></li>
    <li><a href="index.php?category=kuş&breed=Cennet kuşu<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Cennet Kuşu (<?php echo getBreedCount('Cennet kuşu'); ?>)</a></li>
    <li><a href="index.php?category=kuş&breed=Dalgıç<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Dalgıç (<?php echo getBreedCount('Dalgıç'); ?>)</a></li>
    <li><a href="index.php?category=kuş&breed=Dodo<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Dodo (<?php echo getBreedCount('Dodo'); ?>)</a></li>
    <li><a href="index.php?category=kuş&breed=Ejderha<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Ejderha Kuşu (<?php echo getBreedCount('Ejderha'); ?>)</a></li>
    <li><a href="index.php?category=kuş&breed=Jako<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Jako (<?php echo getBreedCount('Jako'); ?>)</a></li>
    <li><a href="index.php?category=kuş&breed=Kanarya<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Kanarya (<?php echo getBreedCount('Kanarya'); ?>)</a></li>
    <li><a href="index.php?category=kuş&breed=Kakadu<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Kakadu (<?php echo getBreedCount('Kakadu'); ?>)</a></li>
    <li><a href="index.php?category=kuş&breed=Muhabbet Kuşu<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Muhabbet Kuşu (<?php echo getBreedCount('Muhabbet Kuşu'); ?>)</a></li>
    <li><a href="index.php?category=kuş&breed=Papağan<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Papağan (<?php echo getBreedCount('Papağan'); ?>)</a></li>
    <li><a href="index.php?category=kuş&breed=Saka<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Saka (<?php echo getBreedCount('Saka'); ?>)</a></li>
    <li><a href="index.php?category=kuş&breed=Yuvarlak<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Yuvarlak (<?php echo getBreedCount('Yuvarlak'); ?>)</a></li>
    <li><a href="index.php?category=kuş&breed=Zebra<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Zebra (<?php echo getBreedCount('Zebra'); ?>)</a></li>
    <li><a href="index.php?category=kuş&breed=Diğer<?php echo isset($_GET['city']) ? '&city=' . $_GET['city'] : ''; ?>">Diğer (Listede Yok) (<?php echo getBreedCount('Diğer'); ?>)</a></li>
</ul>

                    <?php endif; ?>
                </li>
            </ul>
        </section>
<br>
<br>
        <section class="location">
            <h3>Şehir Seç</h3>
            <form method="GET" action="index.php">
                <select name="city" onchange="this.form.submit()" class="city-select">
                    <option value="0" hidden disabled selected>Şehir Seçin</option>
                    <option value="İstanbul" <?php echo (isset($_GET['city']) && $_GET['city'] == 'İstanbul') ? 'selected' : ''; ?>>İstanbul</option>
<option value="Ankara" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Ankara') ? 'selected' : ''; ?>>Ankara</option>
<option value="İzmir" <?php echo (isset($_GET['city']) && $_GET['city'] == 'İzmir') ? 'selected' : ''; ?>>İzmir</option>
<option value="Adana" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Adana') ? 'selected' : ''; ?>>Adana</option>
<option value="Adıyaman" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Adıyaman') ? 'selected' : ''; ?>>Adıyaman</option>
<option value="Afyonkarahisar" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Afyonkarahisar') ? 'selected' : ''; ?>>Afyonkarahisar</option>
<option value="Ağrı" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Ağrı') ? 'selected' : ''; ?>>Ağrı</option>
<option value="Aksaray" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Aksaray') ? 'selected' : ''; ?>>Aksaray</option>
<option value="Amasya" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Amasya') ? 'selected' : ''; ?>>Amasya</option>
<option value="Antalya" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Antalya') ? 'selected' : ''; ?>>Antalya</option>
<option value="Ardahan" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Ardahan') ? 'selected' : ''; ?>>Ardahan</option>
<option value="Artvin" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Artvin') ? 'selected' : ''; ?>>Artvin</option>
<option value="Aydın" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Aydın') ? 'selected' : ''; ?>>Aydın</option>
<option value="Balıkesir" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Balıkesir') ? 'selected' : ''; ?>>Balıkesir</option>
<option value="Bartın" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Bartın') ? 'selected' : ''; ?>>Bartın</option>
<option value="Batman" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Batman') ? 'selected' : ''; ?>>Batman</option>
<option value="Bayburt" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Bayburt') ? 'selected' : ''; ?>>Bayburt</option>
<option value="Bilecik" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Bilecik') ? 'selected' : ''; ?>>Bilecik</option>
<option value="Bingöl" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Bingöl') ? 'selected' : ''; ?>>Bingöl</option>
<option value="Bitlis" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Bitlis') ? 'selected' : ''; ?>>Bitlis</option>
<option value="Bolu" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Bolu') ? 'selected' : ''; ?>>Bolu</option>
<option value="Burdur" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Burdur') ? 'selected' : ''; ?>>Burdur</option>
<option value="Bursa" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Bursa') ? 'selected' : ''; ?>>Bursa</option>
<option value="Çanakkale" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Çanakkale') ? 'selected' : ''; ?>>Çanakkale</option>
<option value="Çankırı" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Çankırı') ? 'selected' : ''; ?>>Çankırı</option>
<option value="Çorum" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Çorum') ? 'selected' : ''; ?>>Çorum</option>
<option value="Denizli" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Denizli') ? 'selected' : ''; ?>>Denizli</option>
<option value="Diyarbakır" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Diyarbakır') ? 'selected' : ''; ?>>Diyarbakır</option>
<option value="Düzce" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Düzce') ? 'selected' : ''; ?>>Düzce</option>
<option value="Edirne" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Edirne') ? 'selected' : ''; ?>>Edirne</option>
<option value="Elazığ" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Elazığ') ? 'selected' : ''; ?>>Elazığ</option>
<option value="Erzincan" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Erzincan') ? 'selected' : ''; ?>>Erzincan</option>
<option value="Erzurum" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Erzurum') ? 'selected' : ''; ?>>Erzurum</option>
<option value="Eskişehir" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Eskişehir') ? 'selected' : ''; ?>>Eskişehir</option>
<option value="Gaziantep" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Gaziantep') ? 'selected' : ''; ?>>Gaziantep</option>
<option value="Giresun" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Giresun') ? 'selected' : ''; ?>>Giresun</option>
<option value="Gümüşhane" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Gümüşhane') ? 'selected' : ''; ?>>Gümüşhane</option>
<option value="Hakkâri" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Hakkâri') ? 'selected' : ''; ?>>Hakkâri</option>
<option value="Hatay" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Hatay') ? 'selected' : ''; ?>>Hatay</option>
<option value="Iğdır" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Iğdır') ? 'selected' : ''; ?>>Iğdır</option>
<option value="Isparta" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Isparta') ? 'selected' : ''; ?>>Isparta</option>
<option value="Kahramanmaraş" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Kahramanmaraş') ? 'selected' : ''; ?>>Kahramanmaraş</option>
<option value="Karabük" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Karabük') ? 'selected' : ''; ?>>Karabük</option>
<option value="Karaman" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Karaman') ? 'selected' : ''; ?>>Karaman</option>
<option value="Kars" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Kars') ? 'selected' : ''; ?>>Kars</option>
<option value="Kastamonu" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Kastamonu') ? 'selected' : ''; ?>>Kastamonu</option>
<option value="Kayseri" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Kayseri') ? 'selected' : ''; ?>>Kayseri</option>
<option value="Kırıkkale" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Kırıkkale') ? 'selected' : ''; ?>>Kırıkkale</option>
<option value="Kırklareli" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Kırklareli') ? 'selected' : ''; ?>>Kırklareli</option>
<option value="Kırşehir" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Kırşehir') ? 'selected' : ''; ?>>Kırşehir</option>
<option value="Kilis" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Kilis') ? 'selected' : ''; ?>>Kilis</option>
<option value="Kocaeli" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Kocaeli') ? 'selected' : ''; ?>>Kocaeli</option>
<option value="Konya" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Konya') ? 'selected' : ''; ?>>Konya</option>
<option value="Kütahya" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Kütahya') ? 'selected' : ''; ?>>Kütahya</option>
<option value="Malatya" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Malatya') ? 'selected' : ''; ?>>Malatya</option>
<option value="Manisa" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Manisa') ? 'selected' : ''; ?>>Manisa</option>
<option value="Mardin" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Mardin') ? 'selected' : ''; ?>>Mardin</option>
<option value="Mersin" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Mersin') ? 'selected' : ''; ?>>Mersin</option>
<option value="Muğla" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Muğla') ? 'selected' : ''; ?>>Muğla</option>
<option value="Muş" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Muş') ? 'selected' : ''; ?>>Muş</option>
<option value="Nevşehir" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Nevşehir') ? 'selected' : ''; ?>>Nevşehir</option>
<option value="Niğde" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Niğde') ? 'selected' : ''; ?>>Niğde</option>
<option value="Ordu" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Ordu') ? 'selected' : ''; ?>>Ordu</option>
<option value="Osmaniye" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Osmaniye') ? 'selected' : ''; ?>>Osmaniye</option>
<option value="Rize" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Rize') ? 'selected' : ''; ?>>Rize</option>
<option value="Sakarya" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Sakarya') ? 'selected' : ''; ?>>Sakarya</option>
<option value="Samsun" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Samsun') ? 'selected' : ''; ?>>Samsun</option>
<option value="Şanlıurfa" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Şanlıurfa') ? 'selected' : ''; ?>>Şanlıurfa</option>
<option value="Siirt" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Siirt') ? 'selected' : ''; ?>>Siirt</option>
<option value="Sinop" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Sinop') ? 'selected' : ''; ?>>Sinop</option>
<option value="Sivas" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Sivas') ? 'selected' : ''; ?>>Sivas</option>
<option value="Tekirdağ" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Tekirdağ') ? 'selected' : ''; ?>>Tekirdağ</option>
<option value="Tokat" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Tokat') ? 'selected' : ''; ?>>Tokat</option>
<option value="Trabzon" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Trabzon') ? 'selected' : ''; ?>>Trabzon</option>
<option value="Tunceli" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Tunceli') ? 'selected' : ''; ?>>Tunceli</option>
<option value="Uşak" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Uşak') ? 'selected' : ''; ?>>Uşak</option>
<option value="Van" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Van') ? 'selected' : ''; ?>>Van</option>
<option value="Yalova" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Yalova') ? 'selected' : ''; ?>>Yalova</option>
<option value="Yozgat" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Yozgat') ? 'selected' : ''; ?>>Yozgat</option>
<option value="Zonguldak" <?php echo (isset($_GET['city']) && $_GET['city'] == 'Zonguldak') ? 'selected' : ''; ?>>Zonguldak</option>

                </select>
                <?php if (isset($_GET['category'])): ?>
                    <input type="hidden" name="category" value="<?php echo htmlspecialchars($_GET['category']); ?>">
                <?php endif; ?>
                <?php if (isset($_GET['breed'])): ?>
                    <input type="hidden" name="breed" value="<?php echo htmlspecialchars($_GET['breed']); ?>">
                <?php endif; ?>
                <?php if (isset($_GET['fiyat'])): ?>
                    <input type="hidden" name="fiyat" value="<?php echo htmlspecialchars($_GET['fiyat']); ?>">
                <?php endif; ?>
            </form>
        </section>
        <br>
        <br>
        <section class="price-filter">
            <h3>Yaş Aralığı</h3>
            <form method="GET" action="index.php">
                <input type="number" name="fiyat" placeholder="Yaş ve altı" value="<?php echo isset($_GET['fiyat']) ? htmlspecialchars($_GET['fiyat']) : ''; ?>" oninput="this.form.submit();">
                <?php if (isset($_GET['city'])): ?>
                    <input type="hidden" name="city" value="<?php echo htmlspecialchars($_GET['city']); ?>">
                <?php endif; ?>
                <?php if (isset($_GET['category'])): ?>
                    <input type="hidden" name="category" value="<?php echo htmlspecialchars($_GET['category']); ?>">
                <?php endif; ?>
                <?php if (isset($_GET['breed'])): ?>
                    <input type="hidden" name="breed" value="<?php echo htmlspecialchars($_GET['breed']); ?>">
                <?php endif; ?>
            </form>
        </section>
        <br>
        <section class="gender-filter">
            <h3>Cinsiyet</h3>
            <form method="GET" action="index.php">
                <select name="cinsiyet" onchange="this.form.submit()" class="gender-select">
                    <option value="" hidden disabled selected>Cinsiyet Seçin</option>
                    <option value="Erkek" <?php echo (isset($_GET['cinsiyet']) && $_GET['cinsiyet'] == 'Erkek') ? 'selected' : ''; ?>>Erkek</option>
                    <option value="Dişi" <?php echo (isset($_GET['cinsiyet']) && $_GET['cinsiyet'] == 'Dişi') ? 'selected' : ''; ?>>Dişi</option>
                </select>
                <?php if (isset($_GET['city'])): ?>
                    <input type="hidden" name="city" value="<?php echo htmlspecialchars($_GET['city']); ?>">
                <?php endif; ?>
                <?php if (isset($_GET['category'])): ?>
                    <input type="hidden" name="category" value="<?php echo htmlspecialchars($_GET['category']); ?>">
                <?php endif; ?>
                <?php if (isset($_GET['breed'])): ?>
                    <input type="hidden" name="breed" value="<?php echo htmlspecialchars($_GET['breed']); ?>">
                <?php endif; ?>
                <?php if (isset($_GET['fiyat'])): ?>
                    <input type="hidden" name="fiyat" value="<?php echo htmlspecialchars($_GET['fiyat']); ?>">
                <?php endif; ?>
            </form>
        </section>
    </aside>

    <main class="product-grid">
    <?php
    // Filtreleri kontrol et
    $filters = [];

    // Arama parametresi varsa, filtrelere ekle
    if (isset($_GET['q']) && !empty($_GET['q'])) {
        $filters['q'] = $_GET['q']; // Arama terimi
    }

    // Diğer filtreler (örneğin fiyat, şehir vb.)
    if (isset($_GET['fiyat']) && is_numeric($_GET['fiyat'])) {
        $filters['fiyat'] = $_GET['fiyat'];
    }

    if (isset($_GET['city'])) {
        $filters['city'] = $_GET['city'];
    }

    if (isset($_GET['category'])) {
        $filters['category'] = $_GET['category'];
        $filters['breed'] = isset($_GET['breed']) ? $_GET['breed'] : '';
    }

    if (isset($_GET['cinsiyet'])) {
        $filters['cinsiyet'] = $_GET['cinsiyet'];
    }

    // Eğer arama terimi varsa, getProductsByKeyword fonksiyonunu kullan
    if (isset($filters['q'])) {
        $result = getProductsByKeyword($filters['q']);
    } else {
        // Filtrelere göre ürünleri al
        $result = getProductsWithFilters($filters);
    }
    ?>


<?php if (mysqli_num_rows($result) > 0): ?>
    <?php while ($urun = mysqli_fetch_assoc($result)): ?>
        <div class="product-card">
            <a href="<?php echo "product-details.php?id=" . $urun["id"]; ?>">
                <div class="img-container">
                    <img src="img/<?php echo $urun["imageUrl"]; ?>" alt="<?php echo $urun["title"]; ?>">
                </div>
                <div class="product-details">
                    <h4><?php echo $urun["title"]; ?></h4>
                    <p class="owner"><?php echo mysqli_fetch_assoc(getPerson($urun["owner_id"]))["isim"]; ?></p>
                    <div class="info">
                        <span class="location"><i class="fa-solid fa-location-dot"></i> <?php echo $urun["sehir"]; ?></span>
                        <span class="Cinsiyeti"><?php echo $urun["Cinsiyeti"]; ?></span>
                        <span class="price"><?php echo $urun["price"]; ?> Yaş</span>
                    </div>

                    </div>
                </a>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Aradığınız kriterlere uygun ilan bulunamadı.</p>
    <?php endif; ?>
</main>
s
</div>
