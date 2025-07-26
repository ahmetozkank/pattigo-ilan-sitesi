<?php
    // PHP tarafı için saat dilimini Türkiye olarak ayarla
    date_default_timezone_set('Europe/Istanbul');

    // Veritabanı bağlantı bilgileri
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "ureticiden";

    // MySQL bağlantısı oluştur
    $connection = mysqli_connect($server, $username, $password, $database);

    // Karakter setini UTF-8 yap
    mysqli_set_charset($connection, "UTF8");

    // MySQL tarafında da saat dilimini Türkiye olarak ayarla
    mysqli_query($connection, "SET time_zone = '+03:00'");

    // Bağlantı hatasını kontrol et
    if(mysqli_connect_errno() > 0) {
        die("error: " . mysqli_connect_errno());
    }
?>
