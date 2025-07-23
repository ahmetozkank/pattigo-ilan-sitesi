<!--Hayvan Navbar -->
<header class="navbar-pet-muhteşem">
    <div class="navbar-container">
        <!-- Logo Bölümü -->
        <div class="navbar-logo">
            <a href="index.php" class="navbar-brand">🐾 Patti<b>Go</b></a>
        </div>

        <!-- Ana Menü -->
        <div class="navbar-search">
            <form action="index.php" method="GET" style="display: flex; align-items: center; margin: 0;">
                <input type="text" placeholder="Ara..." name="q" class="search-input">
                <button type="submit" class="search-button">🔎</button>
            </form>
        </div>

        <!-- Menü Bağlantıları -->
        <ul class="navbar-links">
            <li>
                <?php if (isLoggedin()): ?>
                    <a href="ilanver.php" class="navbar-link">İlan Ver 📷</a>
                <?php else: ?>
                    <a href="login.php" class="navbar-link">İlan Ver 📷</a>
                <?php endif; ?>
            </li>

            <?php if (isLoggedin() && isAdmin()): ?>
            <?php endif; ?>

            <?php if (isLoggedin()): ?>
                <li class="navbar-account">
                    <a class="navbar-profile" href="#" style="background: rgba(255, 214, 71, 0.3); color: #e39b00; padding: 10px 15px; border-radius: 15px;">
                        <span>👤 <?php
                            $id = $_SESSION["kullanici_id"];
                            $resultt = getPerson($id);
                            $person = mysqli_fetch_assoc($resultt);
                            echo $person["isim"];
                        ?></span>
                    </a>
                    <div class="dropdown-content">
                        <?php if (isAdmin()): ?>
                            <a href="admin-product.php" class="dropdown-link">Admin 👑</a>
                        <?php endif; ?>
                        <a href="hesapsifre.php" class="dropdown-link">Ayarlar ⚙️</a>
                        <a href="logout.php" class="dropdown-link">Çıkış Yap🚪</a>
                    </div>
                </li>
            <?php else: ?>
                <li><a href="login.php" class="navbar-link">Giriş Yap / Kaydol 🐾</a></li>
            <?php endif; ?>
        </ul>
    </div>
</header>

<!-- CSS Tarzı -->
<style>
    /* Navbar Temel Stil */
    .navbar-pet-muhteşem {
        position: relative;
        background: linear-gradient(135deg, #ffdf85, #ffd447);
        padding: 20px 0;
        font-family: 'Roboto', sans-serif;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.25);
        animation: gradientBG 10s ease infinite;
    }

    .navbar-pet-muhteşem::after {
        content: ""; /* Pseudo-element oluşturmak için boş bir içerik */
        display: block; /* Elemanı blok seviyesinde bir kutu yapar */
        position: absolute; /* Elemanı konumlandırmak için akıştan çıkarır */
        bottom: -10px; /* Elemanı bulunduğu kutunun altından 10 piksel aşağı yerleştirir */
        left: 0; /* Elemanı bulunduğu kutunun soluna hizalar */
        width: 100%; /* Elemanın genişliğini bulunduğu kutunun tamamı kadar yapar */
        height: 20px; /* Elemanın yüksekliğini 20 piksel yapar */
        background: linear-gradient(to right, #ffd447, rgb(227, 155, 0)); /* Sağ tarafa doğru sarıdan turuncuya geçişli bir arka plan rengi uygular */
        clip-path: ellipse(60% 90% at 50% 100%); /* Elemanın görüntüsünü bir elips şekline kırpar */

    }

    @keyframes gradientBG {
        0% { background: #ffe599; }
        50% { background: #ffd447; }
        100% { background: #ffe599; }
    }

    .navbar-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Logo */
    .navbar-logo a {
        font-size: 2.5rem;
        color: #ffffff;
        font-weight: bold;
        text-decoration: none;
        transition: transform 0.4s ease, text-shadow 0.3s ease;
    }

    .navbar-logo a:hover {
        transform: scale(1.1);
        text-shadow: 0 0 10px rgba(255, 255, 255, 0.8);
    }

    /* Arama Kutusu */
    .navbar-search {
        display: flex;
        align-items: center;
        width: 350px;
        background-color: #fff7e6;
        border-radius: 30px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease;
    }

    .navbar-search:hover {
        transform: scale(1.05);
    }

    .search-input {
        width: 100%;
        border: none;
        padding: 10px 50px;
        border-radius: 20px 0 0 20px;
        background: #fff3cc;
        color: #333;
        font-size: 1.1rem;
        font-family: '', sans-serif;
        outline: none;
        transition: background 0.3s ease;
    }

    .search-input:focus {
        padding: 13.4px 50px;
        background: #ffe6a1;
    }

    .search-button {
        background: #e39b00;
        border: none;
        color: white;
        padding: 12px 15px;
        border-radius: 0 20px 20px 0;
        cursor: pointer;
        font-size: 1.1rem;
        transition: background 0.3s ease, transform 0.3s ease;
    }

    .search-button:hover {
        background: #d68f00;
        transform: scale(1.1);
    }

    /* Menü Bağlantıları */
    .navbar-links {
        list-style: none;
        display: flex;
        gap: 25px;
        align-items: center;
    }

    .navbar-link {
        color: #ffffff;
        text-decoration: none;
        font-size: 1.2rem;
        font-weight: 500;
        padding: 10px 15px;
        border-radius: 15px;
        transition: background 0.4s ease, transform 0.3s ease;
    }

    .navbar-link:hover {
        background: rgba(255, 214, 71, 0.3);
        color: #e39b00;
        transform: translateY(-3px);
    }

    /* Hesap ve Dropdown Menüsü */
    .navbar-account {
        position: relative;
        cursor: pointer;
    }

    .navbar-profile {
        color: #ffd447;
        border-bottom: none;
        font-weight: bold;
        font-size: 1.1rem;
        margin-left: 10px;
    }

    /* Dropdown Menü */
    .dropdown-content {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background-color: #fff7e6;
        min-width: 150px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        z-index: 1;
        padding: 10px;
    }

    .navbar-account:hover .dropdown-content {
        display: block;
    }

    .dropdown-link {
        color: #e39b00;
        padding: 10px 15px;
        display: block;
        text-decoration: none;
        transition: background 0.3s ease;
        border-radius: 8px;
    }

    .dropdown-link:hover {
        background-color: #ffd447;
        color: #e39b00;
    }

 @media (max-width: 768px) {

  /* Navbar tüm elemanları dikey hizala */
  .navbar-container {
    flex-direction: column;
    align-items: center;
    padding: 10px 15px;
  }

  /* Logo ortala */
  .navbar-logo {
    margin-bottom: 20px;
  }

  .navbar-logo a {
  font-size: 2rem;
  text-align: center;
  margin-left: -15px; /* Çok az sola kaydırır */
  }

  /* Arama kutusu tam genişlik */
  .navbar-search {
    width: 100% !important;
    padding: 0;
     margin-bottom: 15px;
  }

  .search-input {
    padding: 10px 15px !important;
    border-radius: 20px 0 0 20px;
  }

  .search-button {
    padding: 10px 15px !important;
    border-radius: 0 20px 20px 0;
    flex-shrink: 0;
  }

  /* Arama çubuğu içindeki formun flex yapısını koru */
  .navbar-search form {
    display: flex;
    width: 100%;
  }
  /* Menü bağlantılarını yatay hizala */
  .navbar-links {
    flex-direction: row;
    justify-content: space-between;
    width: 100%;
    margin-top: 10px;
    gap: 0;
  }

  .navbar-links li {
    flex: 1;
    text-align: center;
  }

  .navbar-link {
    font-size: 1rem;
    padding: 8px;
  }

  /* Kullanıcı ve ilan ver hizalaması */
  .navbar-account {
    position: relative;
    z-index: 11/* Üste al */
  }

  /* Dropdown içeriği ekranın sağ üstüne */
  .dropdown-content {
    top: 40px;
    right: 0;
    left: auto;
    position: absolute;
    z-index: 9999;
    width: max-content;
    min-width: 160px;
    background: #fff7e6;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
  }

 .navbar-account {
    position: relative; /* Dropdown’un referans noktası */
  }

  .dropdown-content {
    position: absolute;
    top: 40px;      /* İsim altı */
    right: 10px;    /* Sağdan biraz içeride */
    left: auto;
    z-index: 9999;
    background-color: #fff7e6;
    min-width: 160px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    padding: 10px 0;
    display: none;  /* Hover veya tıklama ile görünür olmalı */
  }

  .navbar-account:hover .dropdown-content {
    display: block;
  }

  .dropdown-link {
    color: #e39b00;
    font-size: 1rem;
    padding: 10px 20px;
    text-align: center;
    display: block;
    border-radius: 6px;
    transition: background 0.3s ease;
  }

  .dropdown-link:hover {
    background-color: #ffd447;
    color: #e39b00;
  }
    }
    
</style>
