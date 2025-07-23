-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 02 Oca 2025, 14:22:28
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `ureticiden`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `sehir` varchar(30) NOT NULL,
  `price` int(11) NOT NULL,
  `ikategori` varchar(20) NOT NULL,
  `ubilgisi` varchar(40) NOT NULL,
  `uetiketi` varchar(30) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `imageUrl` varchar(100) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 0,
  `dateAdded` timestamp NOT NULL DEFAULT current_timestamp(),
  `Cinsiyeti` enum('Erkek','Dişi') DEFAULT NULL,
  `descriptions` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `owner_id` (`owner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=254 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `products`
--

INSERT INTO `products` (`id`, `title`, `sehir`, `price`, `ikategori`, `ubilgisi`, `uetiketi`, `owner_id`, `imageUrl`, `isActive`, `dateAdded`, `Cinsiyeti`, `descriptions`) VALUES
(22, 'Scottish Kedi', 'Ordu', 2, 'Kedi', 'Scottish Fold ', 'Sahibinden', 5, '7e1f8dc4bd844744782467eb4671db55.jpg', 1, '2024-12-06 11:39:13', 'Dişi', '2 yaşında dişi Scottish Fold, tuvalet eğitimi vardır ve oldukça uysaldır. Sağlık durumu iyi, aşıları tamdır. Sahiplendirmek istiyoruz.'),
(24, 'Barınakdan kedi', 'Konya', 8, 'Kedi', 'Russian Blue', 'Barınaktan', 4, '4d69346dd345adfd6200311418aacea3.jpg', 1, '2024-12-06 11:44:26', 'Dişi', 'Russsian Blue cinsi kedi, oldukça oyuncu ve insana alışkındır. Sağlık kontrolleri yapılmış, mama ve kum eğitimine sahiptir. Sahiplenmek isteyenler iletişime geçebilir.'),
(26, 'Sahibinden kedi', 'İzmir', 3, 'Kedi', 'birman', 'Sahibinden', 3, '74d24606cd0ec528923ecf62f09bab50.jpg', 1, '2024-12-06 11:51:25', 'Erkek', 'Kedimiz,sevecen ve oyun oynamayı çok seven bir kedi. Mama ve tuvalet alışkanlığı vardır. Sahiplendirmek istiyoruz.'),
(34, 'yuva arıyoruz', 'Tokat', 1, 'Kuş', 'Muhabbet Kuşu', 'Sahibinden', 1, 'c4fc32b4e9b5a504c6576727da0d3427.jpg', 1, '2024-12-06 12:25:33', 'Erkek', 'Bu sevimli muhabbet kuşu, enerjik ve sosyal yapısıyla her zaman çevresine neşe saçar. Tüylerinin parlak renkleri ve canlı duruşuyla göz alıcı bir dost arıyorsanız, bu kuş tam size göre! Onunla birlikte keyifli zamanlar geçirebilirsiniz'),
(43, 'Sadık Pointer', 'Artvin', 5, 'Köpek', 'Pointer', 'Sahibinden', 6, 'c4218e8641841747944bdab0ac06c6ae.jpg', 1, '2024-12-07 20:00:06', 'Erkek', 'Pointer cinsi köpeğimiz, harika bir avcı ve aynı zamanda sevgi dolu bir aile dostudur. Sadık karakteri, enerjik yapısı ve kolay eğitilebilir özellikleriyle hayatınıza uyum sağlayacak bu köpek, sevgi dolu bir yuva için hazırdır.'),
(47, 'Doğanın Melodisi', 'Şanlıurfa', 6, 'Kuş', 'Yuvarlak', 'Barınakdan', 6, '54e3fb7b4c117fd4c509e1b7c36b6be6.jpg', 1, '2024-12-08 18:19:54', 'Erkek', 'Kuşumuz, doğanın en zarif şarkıcılarından biridir. Renkli tüyleri ve melodik ötüşüyle evinize huzur getirecek. Bakımı kolay ve insana alışkın olan bu kuş, her ortamda mutluluk kaynağı olacaktır. Yeni yuvasını sabırsızlıkla bekliyor.'),
(53, 'Yuva Arıyoruz', 'Bayburt', 12, 'Köpek', 'Beagle', 'Sahibinden', 1, '31fc231bac65f190d441f2fa0510f03e.jpg', 1, '2024-12-09 14:28:52', 'Dişi', '12 yaşında erkek Golden, temel eğitimli, oyuncu ve çocuklarla iyi anlaşır. Düzenli olarak aşıları yapılmıştır. Sahiplenmek isteyenler iletişime geçebilir.'),
(57, 'Has Golden', 'İzmir', 6, 'Köpek', 'Golden', 'Sahibinden', 1, 'd1c0d52377b8b38a1b2304af19084b1f.jpg', 1, '2024-12-09 17:43:16', 'Erkek', 'Golden Retriever yavrumuz, oyuncu ve enerjik yapısıyla evinize neşe katacak. Hem yeni şeyler öğrenmeye açık hem de sevgi dolu bir doğaya sahip olan bu cins, yeni ailesini mutlu etmek için hazır bekliyor. Düzenli olarak veteriner kontrolünden geçirilmiştir.'),
(58, 'Barınakdan Golden', 'İzmir', 13, 'Köpek', 'Golden', 'Barınakdan', 8, '22a2efffbfbc64b3d461162caab90b8a.jpg', 1, '2024-12-09 18:46:20', 'Erkek', 'Golden Retriever cinsi köpeğimiz, hem sadık hem de oldukça akıllıdır. Eğitimlere yatkın yapısı ve sevecen tavırlarıyla aile hayatınıza kolayca uyum sağlayacak. Sağlıklı ve enerjik bu köpek, oyun oynamayı ve dışarıda vakit geçirmeyi çok sever'),
(59, 'Dostluğa Hazır', 'İzmir', 9, 'Köpek', 'Golden', 'Sahibinden', 1, 'c4e45746eccd81c895c3e04b133c0c0f.jpg', 1, '2024-12-09 19:28:30', 'Dişi', 'Golden Retriever cinsi köpeğimiz, arkadaş canlısı doğası ve harika karakteriyle mükemmel bir ev arkadaşıdır. Aile ortamında mutlu bir yaşam sürecek bu sevimli dostumuz, sadık ve sevgi dolu bir yuva arıyor. Sağlık durumu kusursuz ve temel eğitimleri tamamlanmıştır'),
(60, 'Saka Kuşu', 'Manisa', 1, 'Kuş', 'Saka', 'Sahibinden', 1, '87f743eba81f4b987868286037ef94e7.jpg', 1, '2024-12-10 15:23:50', 'Dişi', 'Doğanın en özel seslerinden birine sahip olan saka kuşu, evinize neşe katmaya geliyor. Renkli ve parlak tüyleriyle dikkat çeken, melodik ötüşleriyle huzur veren bu kuş, size harika bir arkadaş olacaktı'),
(67, 'Korumacı Golden', 'Kars', 8, 'Köpek', 'Golden', 'Sahibinden', 4, 'bb91b80894ad61031e6a3389e6c729f5.jpg', 1, '2024-12-10 20:58:43', 'Dişi', 'köpeğimiz, zeki ve sadık bir arkadaştır. Bahçenizde özgürce vakit geçirmeyi seven bu köpek, aynı zamanda aile ortamına kolayca uyum sağlayabilir.'),
(68, 'Akbaş Köpeği', 'İstanbul', 6, 'Köpek', 'Akbaş', 'Barınakdan', 11, '7982e2d812285f4d3a60841dd3f57758.jpg', 1, '2024-12-10 21:12:16', 'Erkek', 'Akbaş cinsi köpeğimiz, Anadolu’nun doğal koruma köpeği olarak bilinir. Sadık, sakin ve ailesine bağlıdır. Sürüyü veya aileyi koruma içgüdüsü oldukça güçlüdür. Tamamen sağlıklı ve bakımlıdır. Yeni yuvasına alışmaya hazır.'),
(69, 'Zeki Bengal', 'Ordu', 4, 'Kedi', 'Bengal', 'Barınakdan', 5, '960ad3c8bb4f2d69620cdc4b9b8a8094.jpg', 1, '2024-12-10 21:18:06', 'Erkek', 'Benzersiz tüy desenleri ve enerjik yapısıyla Bengal kedimiz, oyun oynamayı ve etrafını keşfetmeyi çok seven bir dosttur. Tamamen sağlıklı olup, çocuklarla ve diğer evcil hayvanlarla uyumludur. Yeni yuvasına heyecanla alışmaya hazır.'),
(70, ' Bengal Kedisi', 'Ordu', 6, 'Kedi', 'Bengal', 'Barınakdan', 11, 'e30ea39a9ca67dfecf9978366c8ec6f7.jpg', 1, '2024-12-10 21:20:41', 'Dişi', 'Bengal kedimiz, doğal güzelliği ve sıcakkanlı yapısıyla dikkat çeker. Çok zeki ve oyuncu bir karaktere sahiptir. Aktif bir yaşam alanında mutlu olacak, sevgi dolu bir yuva arıyor. Aşıları tamamlanmıştır'),
(71, 'Persian Kedisi', 'Kastamonu', 2, 'Kedi', 'Persian', 'Sahibinden', 11, '2e9fc57e838947427c2a2521c3e481ab.jpg', 1, '2024-12-10 21:34:02', 'Erkek', 'Persian kedimiz, sakin ve dost canlısı yapısıyla ev ortamına mükemmel bir şekilde uyum sağlar. Tüy bakımı düzenli yapılmıştır ve sağlıklı bir kedi olarak, sevgi dolu bir yuvada huzurlu bir yaşam sürmeye hazırdır'),
(72, 'Göz Alıcı Persian', 'Kastamonu', 5, 'Kedi', 'Persian', 'Barınakdan', 6, 'e2f7b88bce413825f9f175d67fc6eaee.jpg', 1, '2024-12-10 21:37:46', 'Erkek', 'Persian kedimiz, yumuşacık tüyleri ve uysal doğasıyla eşsiz bir dosttur. Dingin bir karaktere sahip bu kedi, hem yalnız yaşayan bireyler hem de aile ortamları için mükemmel bir ev arkadaşıdır. Sağlık kontrolleri eksiksiz yapılmıştır'),
(74, 'Eşsiz Desenleriyle', 'İstanbul', 4, 'Kedi', 'Bengal', 'Sahibinden', 8, '959dc178513df209a2ec53ca1a6f1257.jpg', 1, '2024-12-10 21:49:29', 'Dişi', 'Parlak tüyleri ve çarpıcı benekli deseniyle Bengal kedimiz, evinizin neşe kaynağı olacak. Hem uysal hem de enerjik bir yapıya sahip bu kedi, evde keyifli vakit geçirmenizi sağlar. Ona sıcak bir yuva vermek ister misiniz?'),
(76, 'Renkli ve Sosyal', 'Tokat', 2, 'Kuş', 'Muhabbet Kuşu', 'Sahibinden', 11, 'ef9afa34bf388712f196bdc46e8258ce.jpg', 1, '2024-12-10 22:01:19', 'Dişi', 'Şirin mi şirin muhabbet kuşumuz, sevgi dolu bir yuva arıyor. İnsana alışkın, sosyal ve oyuncu bir karaktere sahip olan bu kuş, hayatınıza renk katmaya hazır. Onunla birlikte şarkılar dinleyebilir ve harika anılar biriktirebilirsiniz'),
(78, ' Konuşkan Muhabbet Kuşu', 'İstanbul', 5, 'Kuş', 'Muhabbet Kuşu', 'Sahibinden', 4, 'cc4ae0f9448e091d86a61e16a30ddfb8.jpg', 1, '2024-12-10 22:16:07', 'Erkek', 'Bu sevimli muhabbet kuşu, enerjik ve sosyal yapısıyla her zaman çevresine neşe saçar. Tüylerinin parlak renkleri ve canlı duruşuyla göz alıcı bir dost arıyorsanız, bu kuş tam size göre! Onunla birlikte keyifli zamanlar geçirebilirsiniz'),
(80, ' Amazon Papağanı', 'İstanbul', 3, 'Kuş', 'Amazon', 'Sahibinden', 5, 'ee6b804c0ef31059f465f0e91082ed60.jpg', 1, '2024-12-10 22:24:07', 'Erkek', 'Doğanın en renkli üyelerinden biri olan papağanımız, eğlenceli karakteri ve sosyal yapısıyla sizi büyüleyecek. Konuşmayı öğrenme yeteneğiyle hayranlık uyandıran bu kuş, sizinle güçlü bir bağ kurmaya hazır.'),
(82, 'Neşeli Kuş', 'İstanbul', 2, 'Kuş', 'Muhabbet Kuşu', 'Sahibinden', 11, '526686509fc286b48214a1fd68383beb.jpg', 1, '2024-12-11 20:28:23', 'Dişi', 'Muhabbet kuşumuz, neşeli yapısı ve konuşma yeteneğiyle evinize renk katacak harika bir dosttur. Sevgi dolu bir ortamda büyümüş, insanlarla iletişimi güçlü ve oldukça sosyal olan bu kuş, yeni yuvasını arıyor. Hem size hem de ailenize mutluluk getirecek'),
(223, 'afsasaöasbgfja', 'Aydın', 3, 'Köpek', 'Beagle', 'Sahibinden', 11, '251d557880e44d51c25be28734554b99.jpg', 1, '2024-12-26 08:57:56', 'Erkek', 'asfbaksfalsjgfs'),
(234, 'Dost Arayan Golden', 'İzmir', 7, 'Köpek', 'Dalmaçyalı', 'Barınaktan', 11, 'd4799d96a156a16677e8ec34584cdabc.jpg', 1, '2024-12-27 12:28:33', 'Dişi', 'Golden Retriever cinsi köpeğimiz, tam bir aile dostudur. Çocuklarla harika vakit geçirir, sosyal ve eğitilmeye oldukça yatkındır. Tuvalet eğitimi tamdır ve yeni ailesiyle bağ kurmaya hazırdır.'),
(236, 'safsafasfasfsf', 'Bilecik', 2, 'Köpek', 'Poddle', 'Sahibinden', 11, 'f22740911c25db9c342b904dce67b1ce.jpg', 1, '2024-12-27 13:04:04', 'Erkek', 'asfsafasfasffsa'),
(251, 'knşşkkşnşknkn', 'Bilecik', 2, 'Köpek', 'Doberman', 'Sahibinden', 11, '241c7ffbbce6d070e74a6be48356e33b.jpg', 1, '2024-12-28 07:56:52', 'Erkek', 'jlkblkgglyvhkjuvuokv'),
(253, 'Ailenizin Yeni Üyesi', 'İstanbul', 6, 'Köpek', 'Golden', 'Sahibinden', 11, '54140114e78f217f85139435a15daf18.jpg', 1, '2024-12-28 08:03:36', 'Erkek', 'Barınaktan kurtardığımız bu köpeğimiz, sevgi dolu bakışlarıyla sizi hemen kendine bağlayacak. Hem oyuncu hem de sakin bir yapısı var. Ona sıcak bir yuva arıyoruz.');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `kullanici_id` int(11) NOT NULL AUTO_INCREMENT,
  `isim` varchar(24) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(24) NOT NULL,
  `onceki_sifre` varchar(24) DEFAULT NULL,
  `user_type` varchar(10) NOT NULL DEFAULT 'user',
  `tel` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`kullanici_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`kullanici_id`, `isim`, `email`, `password`, `onceki_sifre`, `user_type`, `tel`) VALUES
(1, 'Kadir', 'kadirr@gmail.com', '123123', '123', 'admin', '5522232556'),
(3, 'Hasan', 'hasan@gmail.com', '1234566', NULL, 'user', '5423984542'),
(4, 'Ayse', 'ayse@gmail.com', '123456', '444444', 'user', '5336548574'),
(5, 'Veli', 'veli@hotmail.com', '123456', NULL, 'user', '5522293254'),
(6, 'Semiha', 'semiha@hotmail.com', '123456', NULL, 'user', '5522293252'),
(8, 'Cagri', 'cagir1@gmail.com', '123456', NULL, 'user', '5552283259'),
(10, 'deneme deneme ', 'deneme@gmail.com', 'deneme123', NULL, 'user', '5360606577'),
(11, 'Ahmet ', 'ozknklkz@gmail.com', '1234566', NULL, 'admin', '5522270155');

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `users` (`kullanici_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
