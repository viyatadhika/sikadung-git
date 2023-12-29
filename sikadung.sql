/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.3.28-MariaDB : Database - sikadung
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sikadung` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `sikadung`;

/*Table structure for table `gedung` */

DROP TABLE IF EXISTS `gedung`;

CREATE TABLE `gedung` (
  `id_gedung` int(11) NOT NULL AUTO_INCREMENT,
  `nama_gedung` varchar(30) DEFAULT NULL,
  `aktif` enum('Ya','Tidak') NOT NULL DEFAULT 'Ya',
  PRIMARY KEY (`id_gedung`),
  KEY `id_gedung` (`id_gedung`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

/*Data for the table `gedung` */

insert  into `gedung`(`id_gedung`,`nama_gedung`,`aktif`) values 
(1,'Candra 1','Ya'),
(2,'Candra 2','Ya'),
(3,'Sari','Ya'),
(4,'Cakra 1','Ya'),
(5,'Cakra 2','Ya'),
(6,'Cakra 3','Ya'),
(7,'Cakra 4','Ya'),
(8,'Cakra 5','Ya'),
(14,'Kartika','Ya'),
(15,'Tirta','Ya'),
(16,'Kantor','Ya'),
(17,'Auditorium','Ya'),
(18,'Serba Guna','Ya'),
(19,'Transit','Ya'),
(20,'Rumah Dinas Eselon I','Ya'),
(21,'Rumah Dinas Eselon II','Ya'),
(22,'Rumah Dinas Eselon III','Ya'),
(23,'Trotoar','Ya'),
(24,'Masjid','Ya'),
(25,'Balai Pertemuan','Ya'),
(26,'Genset','Ya'),
(27,'Pos Komando','Ya'),
(28,'Pos Jaga','Ya'),
(29,'Perpustakaan','Ya'),
(30,'Laboratorium','Ya'),
(31,'Poliklinik','Ya'),
(32,'Gedung Olah Raga','Ya'),
(33,'Gedung Fitness','Ya'),
(34,'Ruang Pompa','Ya'),
(35,'Taman Hatta Ali','Ya'),
(36,'Menara Pengawas','Ya'),
(37,'Rumah Pimpinan','Ya');

/*Table structure for table `identitas` */

DROP TABLE IF EXISTS `identitas`;

CREATE TABLE `identitas` (
  `id_identitas` int(11) NOT NULL AUTO_INCREMENT,
  `kementerian` varchar(100) DEFAULT NULL,
  `satker` varchar(100) DEFAULT NULL,
  `instansi` varchar(250) DEFAULT NULL,
  `alamat_instansi` varchar(250) DEFAULT NULL,
  `sumber_dana` varchar(250) DEFAULT NULL,
  `nomor_dipa` varchar(50) DEFAULT NULL,
  `tanggal_dipa` date DEFAULT NULL,
  `id_tahun` year(4) DEFAULT NULL,
  `id_pejabat` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_identitas`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `identitas` */

insert  into `identitas`(`id_identitas`,`kementerian`,`satker`,`instansi`,`alamat_instansi`,`sumber_dana`,`nomor_dipa`,`tanggal_dipa`,`id_tahun`,`id_pejabat`) values 
(1,'MAHKAMAH AGUNG RI','BADAN LITBANG DIKLAT HUKUM DAN PERADILAN','Sekretariat Badan Litbang Diklat Kumdil MA RI','Jl. Cikopo Selatan, Desa Suka Maju, Kec. Megamendung Bogor - Jabar, 18570','DIPA Badan Litbang Diklat Kumdil','SP DIPA-005.06.1.610378/2020','2019-11-12',2020,2);

/*Table structure for table `jenis_kerusakan` */

DROP TABLE IF EXISTS `jenis_kerusakan`;

CREATE TABLE `jenis_kerusakan` (
  `id_jenis_kerusakan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kerusakan` varchar(500) DEFAULT NULL,
  `aktif` enum('Ya','Tidak') DEFAULT NULL,
  PRIMARY KEY (`id_jenis_kerusakan`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

/*Data for the table `jenis_kerusakan` */

insert  into `jenis_kerusakan`(`id_jenis_kerusakan`,`nama_kerusakan`,`aktif`) values 
(1,'Lantai Keramik','Ya'),
(2,'Dinding','Ya'),
(3,'Jendela','Ya'),
(4,'Gorden','Ya'),
(5,'Pintu','Ya'),
(6,'Lemari','Ya'),
(7,'Plafon','Ya'),
(8,'Meja','Ya'),
(9,'Kursi','Ya'),
(10,'Papan Flipchart','Ya'),
(11,'Stop Kontak','Ya'),
(12,'Saklar','Ya'),
(13,'Lampu','Ya'),
(14,'Panel Listrik','Ya'),
(15,'AC','Ya'),
(16,'Dispenser','Ya'),
(17,'TV','Ya'),
(18,'Telepon','Ya'),
(19,'Soundsystem','Ya'),
(20,'Infocus','Ya'),
(21,'Wastafel','Ya'),
(22,'Jet Washer','Ya'),
(23,'Shower','Ya'),
(24,'Kloset','Ya'),
(25,'Kran Air','Ya'),
(26,'Urinoir','Ya'),
(27,'Hand Blower','Ya'),
(28,'Exhaust','Ya'),
(29,'Water Heater','Ya'),
(30,'Gantungan Handuk','Ya'),
(31,'Pompa Air','Ya'),
(32,'Auning','Ya'),
(33,'Pagar Panel','Ya'),
(34,'Septic Tank','Ya'),
(35,'Ruang Trafo','Ya'),
(36,'Saluran Air','Ya'),
(37,'Railing','Ya'),
(38,'Backdrop','Ya'),
(39,'Panel MCB','Ya'),
(40,'Lainnya','Ya'),
(41,'Kusen','Ya');

/*Table structure for table `kerusakan` */

DROP TABLE IF EXISTS `kerusakan`;

CREATE TABLE `kerusakan` (
  `id_kerusakan` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_kerusakan` varchar(500) DEFAULT NULL,
  `tgl_kerusakan` date DEFAULT NULL,
  `pelapor` varchar(500) DEFAULT NULL,
  `id_gedung` int(11) DEFAULT NULL,
  `id_jenis_kerusakan` int(11) DEFAULT NULL,
  `lokasi_kerusakan` varchar(500) DEFAULT NULL,
  `keterangan_kerusakan` varchar(500) DEFAULT NULL,
  `nama_file` varchar(100) DEFAULT NULL,
  `nama_teknisi` varchar(100) DEFAULT NULL,
  `tgl_perbaikan` date DEFAULT NULL,
  `id_status_perbaikan` int(11) DEFAULT 3,
  `volume` varchar(100) DEFAULT NULL,
  `nama_file_perbaikan` varchar(500) DEFAULT NULL,
  `nama_file_data_dukung` varchar(500) DEFAULT NULL,
  `keterangan_perbaikan` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id_kerusakan`)
) ENGINE=InnoDB AUTO_INCREMENT=270 DEFAULT CHARSET=latin1;

/*Data for the table `kerusakan` */

insert  into `kerusakan`(`id_kerusakan`,`nomor_kerusakan`,`tgl_kerusakan`,`pelapor`,`id_gedung`,`id_jenis_kerusakan`,`lokasi_kerusakan`,`keterangan_kerusakan`,`nama_file`,`nama_teknisi`,`tgl_perbaikan`,`id_status_perbaikan`,`volume`,`nama_file_perbaikan`,`nama_file_data_dukung`,`keterangan_perbaikan`) values 
(192,'001/Bld.1/S.Umum/LK/12/2023','2023-12-05','sumantri ',2,12,'Lantai 3 no.20','Saklar ruang tamu tidak ada','17017497698491158894851597197555.jpg','Suherman','2023-12-06',2,'1','1701833241975796691659570198580.jpg','',''),
(193,'002/Bld.1/S.Umum/LK/12/2023','2023-12-05','sumantri ',2,12,'Lantai 3 no.22','Tutup saklar depan kamar mandi lepas','17017499178514698421945956542367.jpg','Wahyu','2023-12-05',2,'1','cakra 25.jpg','',''),
(194,'003/Bld.1/S.Umum/LK/12/2023','2023-12-05','sumantri ',2,7,'Lantai 3 no.24','Plafon kamar tidur bocor kondisi sedang hujan','17017500075648818035110204092413.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(195,'004/Bld.1/S.Umum/LK/12/2023','2023-12-05','Sumantri ',2,12,'Lantai 3 no.25','Saklar ruang tidur rusak','17017501001061647757010279485338.jpg','Wahyu','2023-12-05',2,'1','cakra 25.jpg','',''),
(196,'005/Bld.1/S.Umum/LK/12/2023','2023-12-05','Sumantri ',2,1,'Lantai 3 no.25','Keramik depan kamar mandi retak/ngangkat','17017501741828255928413403570192.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(197,'006/Bld.1/S.Umum/LK/12/2023','2023-12-05','Sumantri ',2,1,'Lantai 3 no.25','Keramik balkon sebagian tidak ada','17017502415683353715473211457228.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(198,'007/Bld.1/S.Umum/LK/12/2023','2023-12-05','Sumantri ',2,12,'Lantai 3 no.18','Saklar kamar mandi rusak 2','17017503451491588648231854577201.jpg','Umar','2023-12-06',6,'1',NULL,NULL,'Stok saklar ganda habis. '),
(199,'008/Bld.1/S.Umum/LK/12/2023','2023-12-05','Sumantri ',2,1,'Lantai 3 no.16','Lantai keramik ruang tamu ngangkat ','17017504857744649695744888682405.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(200,'009/Bld.1/S.Umum/LK/12/2023','2023-12-05','Sumantri ',2,1,'Lantai 3 no.16','Lantai keramik ruang tidur ngangkat dan retak','17017505632063526798085124430547.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(201,'010/Bld.1/S.Umum/LK/12/2023','2023-12-05','Sumantri ',2,1,'Lantai 3 ruang laundry sebelah kanan','Keramik dinding ambrol','17017507363395201810794057601806.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(202,'011/Bld.1/S.Umum/LK/12/2023','2023-12-05','Sumantri ',2,11,'Lantai 3 no.12','Stop kontak kamar tidur rusak ',NULL,'Umar','2023-12-06',6,'1',NULL,NULL,'Diperlukan  sekrup panjang 10 cm dan spiser'),
(203,'012/Bld.1/S.Umum/LK/12/2023','2023-12-05','Sumantri ',2,2,'Lantai 3 no.10','Dinding bawah wastafel berjamur','17017509066073027069462823481240.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(204,'013/Bld.1/S.Umum/LK/12/2023','2023-12-05','Sumantri ',2,12,'Lantai 3 no.8','Saklar wastafel rusak','17017509986994643460741596474975.jpg','Suherman','2023-12-06',2,'1','17018348912487572233159980571009.jpg','',''),
(205,'014/Bld.1/S.Umum/LK/12/2023','2023-12-05','Sumantri ',2,2,'Lantai 3 no.6','Dinding bawah wastafel berjamur','17017511207047342336607532941367.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(206,'015/Bld.1/S.Umum/LK/12/2023','2023-12-05','Sumantri ',2,1,'Lantai 3 no.4','Lantai keramik ruang tamu ngangkat dan retak ','17017511889675820653528104233044.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(207,'016/Bld.1/S.Umum/LK/12/2023','2023-12-05','Sumantri ',2,5,'Lantai 3 no.4','Pintu balkon seret','17017512613265619972847270704982.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(208,'017/Bld.1/S.Umum/LK/12/2023','2023-12-05','Sumantri ',2,21,'Lantai 3 no.2','Pembuangan air wastafel bocor','17017513396223674640080132835518.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(209,'018/Bld.1/S.Umum/LK/12/2023','2023-12-05','Rukmana',30,7,'Toilet pria lantai 1','Plapon jebol netes dari toilet lantai 2','IMG-20231205-WA0050.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(210,'019/Bld.1/S.Umum/LK/12/2023','2023-12-05','Rukmana',30,7,'Kelas lab lantai 1 ','Plapon bocor dari toilet lantai 2','IMG-20231205-WA0051.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(211,'020/Bld.1/S.Umum/LK/12/2023','2023-12-05','Rukmana',17,7,'Kelas 16','Plapon belum terpasang','IMG-20231205-WA0053.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(212,'021/Bld.1/S.Umum/LK/12/2023','2023-12-05','Rukmana',17,40,'Kelas 16','Wallpaper lem nya terkelupas','IMG-20231205-WA0054.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(213,'022/Bld.1/S.Umum/LK/12/2023','2023-12-05','Saiful',19,7,'Musolah','Pelapon berjamur','IMG-20231205-WA0014.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(214,'023/Bld.1/S.Umum/LK/12/2023','2023-12-05','Saiful',1,41,'Lantai 1 no.22','Kusen di makan rayap','IMG-20231205-WA0007.jpeg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(215,'024/Bld.1/S.Umum/LK/12/2023','2023-12-07','Engkos',14,23,'Kamar nmr 3 lantai  2 ','Air shower panas terus,lampu toilet kamar pembantu mati,jam dinding rusak',NULL,NULL,NULL,3,NULL,NULL,NULL,NULL),
(216,'025/Bld.1/S.Umum/LK/12/2023','2023-12-06','Engkos',14,13,'Kartika kamar nmr 1 lantai 2 ','Lampu balkon rusak',NULL,NULL,NULL,3,NULL,NULL,NULL,NULL),
(217,'026/Bld.1/S.Umum/LK/12/2023','2023-12-06','Engkos',14,25,'Kartika lantai 2 nmr 6','Air wastafel tidak ngalir,',NULL,NULL,NULL,3,NULL,NULL,NULL,NULL),
(218,'027/Bld.1/S.Umum/LK/12/2023','2023-12-06','Engkos',14,13,'Kartika lantai 3 nmr 5 ','Lampu ruang tamu,toilet ,kamar tidur utama mati minta di ganti,batre romot AC dan tv tidak ada,dispenser air belum ada',NULL,NULL,NULL,3,NULL,NULL,NULL,NULL),
(219,'028/Bld.1/S.Umum/LK/12/2023','2023-12-06','Sumantri ',2,41,'Lantai 3 no.23','Kusen pintu depan lis tidak ada','17018264050456678360522316163061.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(220,'028/Bld.1/S.Umum/LK/12/2023','2023-12-06','Engkos',14,13,'Kolidor lantai 3 ','Lampu ruang jemur mati 1 buah,lampu kolidor mati 2 buah',NULL,NULL,NULL,3,NULL,NULL,NULL,NULL),
(221,'028/Bld.1/S.Umum/LK/12/2023','2023-12-06','Engkos',14,13,'Kolidor lantai 3 ','Lampu ruang jemur mati 1 buah,lampu kolidor mati 2 buah',NULL,NULL,NULL,3,NULL,NULL,NULL,NULL),
(222,'029/Bld.1/S.Umum/LK/12/2023','2023-12-06','Sumantri ',2,13,'Lantai 3 no.19','Lampu ruang tidur mati 1','17018266983458281016835391910052.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(223,'030/Bld.1/S.Umum/LK/12/2023','2023-12-06','Sumantri ',2,12,'Lantai 2 no.4','Saklar ruang tidur depan lemari rusak','1701827543940965214531493149762.jpg','Suherman','2023-12-06',2,'1','17018352606753458412973577420529.jpg','',''),
(224,'031/Bld.1/S.Umum/LK/12/2023','2023-12-06','Sumantri ',2,15,'Lantai 2 no.6','AC ruang tamu tidak ada ','17018277666993452520155537019054.jpg','Administrator','2023-12-06',6,'1','awp.php','',''),
(225,'032/Bld.1/S.Umum/LK/12/2023','2023-12-06','Sumantri ',2,15,'Lantai 2 no.8','AC ruang tamu tidak ada ','17018279052127992031588032138867.jpg','Administrator','2023-12-06',6,'1','ay.jpg','alpa.php',''),
(226,'033/Bld.1/S.Umum/LK/12/2023','2023-12-06','Sumantri ',2,12,'Lantai 2 no.10','Saklar ruang tamu rusak ringan','17018279994087880855583403275609.jpg','Suherman','2023-12-06',2,'','17018355940205067042268340781405.jpg','',''),
(227,'034/Bld.1/S.Umum/LK/12/2023','2023-12-06','Sumantri ',2,7,'Lantai 2 no.10','Plafon kamar mandi berjamur','17018281137116689473048980353266.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(228,'035/Bld.1/S.Umum/LK/12/2023','2023-12-13','Saiful',1,7,'Lantai.3 depan lif','Pelapon bocor depan lif','IMG20231206091343.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(229,'036/Bld.1/S.Umum/LK/12/2023','2023-12-06','Sumantri ',2,15,'Lantai 2 no.16','AC Ruang tamu tidak ada ','17018289194986903940054670988627.jpg','Umar','2023-12-06',6,'',NULL,NULL,''),
(230,'037/Bld.1/S.Umum/LK/12/2023','2023-12-06','Sumantri ',2,12,'Lantai 2 no.18','Saklar ruang tamu rusak ringan 2 pcs','17018291947306465642100453408464.jpg','Suherman','2023-12-06',2,'',NULL,NULL,''),
(231,'038/Bld.1/S.Umum/LK/12/2023','2023-12-06','Sumantri ',2,1,'Lantai 2 no.18','Keramik balkon ngangkat ','17018292861736776618910537824314.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(232,'039/Bld.1/S.Umum/LK/12/2023','2023-12-06','Saiful',1,7,'Lantai 3 no.13','Pelapon kamar mandi bocor','IMG20231206092145.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(233,'039/Bld.1/S.Umum/LK/12/2023','2023-12-06','Sumantri ',2,1,'Lantai 2 no.20','Keramik balkon ngangkat ','17018294091234299412838644763129.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(234,'040/Bld.1/S.Umum/LK/12/2023','2023-12-06','Saiful',1,7,'Kolidor lantai.2','Pelapon kolidor rusak depan kamar no.15 lantai.2','IMG20231206093105.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(235,'041/Bld.1/S.Umum/LK/12/2023','2023-12-06','Sumantri ',2,40,'Lift candra 2','Tombol lift lepas / tidak ada','20231206_100143.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(236,'042/Bld.1/S.Umum/LK/12/2023','2023-12-06','Rukmana',30,40,'Kelas lantai 2','Wallpaper lepas dan berjamur','IMG_20231206_150254_638.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(238,'043/Bld.1/S.Umum/LK/12/2023','2023-12-07','Saiful',1,7,'Kolidor lantai1','Kolidor lantai.1 samping kamar no.21','IMG20231207110923.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(239,'044/Bld.1/S.Umum/LK/12/2023','2023-12-07','Saiful',1,7,'Lantai.3 no.22','Pelapon bocor di atas lemari','IMG20231207111631.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(240,'045/Bld.1/S.Umum/LK/12/2023','2023-12-07','Saiful',1,7,'Lantai.3 no.12','Pelapon di ruang tidur bocor','IMG20231207111908.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(241,'046/Bld.1/S.Umum/LK/12/2023','2023-12-07','Saiful',1,21,'Lantai.3 no.12','Westapel bocor','IMG20231207111958.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(242,'047/Bld.1/S.Umum/LK/12/2023','2023-12-07','Saiful',1,41,'Lantai.no.6','Kusen keropos','IMG20231207112533.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(243,'048/Bld.1/S.Umum/LK/12/2023','2023-12-07','Saiful',1,40,'Lantai.1 no.2','Kayu los pintu keropos','IMG20231207112832.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(244,'049/Bld.1/S.Umum/LK/12/2023','2023-12-07','Saiful',1,41,'Lantai.1 no.4','Kusen sama Lis pintu keropos di makan rayap','IMG20231207113259.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(245,'050/Bld.1/S.Umum/LK/12/2023','2023-12-07','Saiful',16,7,'Kantor lantai 2 kolidor ','Pelapon bocor ','IMG20231207113947.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(246,'051/Bld.1/S.Umum/LK/12/2023','2023-12-07','Saiful',16,0,'Kolidor lantai.2','Lampu kolidor mati','IMG20231207114311.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(247,'052/Bld.1/S.Umum/LK/12/2023','2023-12-07','Engkos',33,40,'Gedung fitnes ','Treadmill rusak 1 buah',NULL,NULL,NULL,3,NULL,NULL,NULL,NULL),
(248,'053/Bld.1/S.Umum/LK/12/2023','2023-12-07','Engkos',33,40,'Fitnes','Treadmill rusak satu buah',NULL,NULL,NULL,3,NULL,NULL,NULL,NULL),
(249,'054/Bld.1/S.Umum/LK/12/2023','2023-12-07','Saiful',1,24,'Lantai.2 no.14','Closet goyang','IMG-20231207-WA0014.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(250,'055/Bld.1/S.Umum/LK/12/2023','2023-12-07','Saiful',1,7,'Lantai.2 no.12','Pelapon kamar mandi bocor','IMG-20231207-WA0015.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(251,'056/Bld.1/S.Umum/LK/12/2023','2023-12-07','Saiful',1,7,'Lantai 2 no.14','Pelapon kamar mandi bocor','IMG-20231207-WA0016.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(252,'057/Bld.1/S.Umum/LK/12/2023','2023-12-07','Saiful',1,40,'Lantai.2 no 18','Keramik ruang tamu','IMG-20231207-WA0017.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(253,'058/Bld.1/S.Umum/LK/12/2023','2023-12-07','Saiful',1,24,'Lantai 2 no 11','Closet ngocor terus','IMG-20231207-WA0019.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(254,'059/Bld.1/S.Umum/LK/12/2023','2023-12-07','Saiful',1,2,'Lantai.2 no.17','Dingding rembes ruang tidur','IMG-20231207-WA0020.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(255,'060/Bld.1/S.Umum/LK/12/2023','2023-12-07','Saiful',1,2,'Lantai 2 no.21','Dingding rembes','IMG-20231207-WA0022.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(257,'061/Bld.1/S.Umum/LK/12/2023','2023-12-09','Engkos',37,2,'Pagar panel','Pagar atas panel lepas',NULL,NULL,NULL,3,NULL,NULL,NULL,NULL),
(258,'062/Bld.1/S.Umum/LK/12/2023','2023-12-13','Saiful',1,11,'Lantai no.2','Stop kontak rusak','IMG20231213081748.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(259,'063/Bld.1/S.Umum/LK/12/2023','2023-12-15','Rukmana',17,5,'Kelas basemen 1 dan 3','Kunci pintu  kelas patah','IMG-20231215-WA0061.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(261,'064/Bld.1/S.Umum/LK/12/2023','2023-12-11','Saiful',16,1,'Kolidor lantai.2','Keramik ngangkat kolidor ','IMG20231218085527.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(263,'065/Bld.1/S.Umum/LK/12/2023','2023-12-18','Saiful',1,7,'Lantai.1 no.8','Pelapon kamar mandi/SOP kontak rusak','IMG20231218092341.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(264,'066/Bld.1/S.Umum/LK/12/2023','2023-12-20','Saiful',19,40,'Musolah ','Welpeper lembab','IMG20231220093905.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(265,'067/Bld.1/S.Umum/LK/12/2023','2023-12-20','Saiful',19,7,'Transit samping','Pelapon berjamur','',NULL,NULL,3,NULL,NULL,NULL,NULL),
(266,'068/Bld.1/S.Umum/LK/12/2023','2023-12-22','Rukmana',18,15,'Serbaguna lantai 1','Ac standing 3 unit tidak berfungsi','IMG_20231222_083527_359.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(267,'069/Bld.1/S.Umum/LK/12/2023','2023-12-22','Rukmana',18,40,'Serbaguna lantai 1','Kipas angin gak berfungsi','IMG_20231222_083817_396.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(268,'070/Bld.1/S.Umum/LK/12/2023','2023-12-22','Rukmana',18,15,'Gedung serbaguna lantai 2','4 unit ac standing tidak berpungsi','IMG_20231222_083527_359.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(269,'071/Bld.1/S.Umum/LK/12/2023','2023-12-22','Rukmana',18,11,'Serbaguna lantai 1','Stop kontak kipas angin rusak tidak berpungsi','IMG_20231222_083828_319.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL);

/*Table structure for table `lantai` */

DROP TABLE IF EXISTS `lantai`;

CREATE TABLE `lantai` (
  `id_lantai` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lantai` varchar(50) DEFAULT NULL,
  `aktif` enum('Ya','Tidak') DEFAULT 'Ya',
  PRIMARY KEY (`id_lantai`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `lantai` */

insert  into `lantai`(`id_lantai`,`nama_lantai`,`aktif`) values 
(1,'Lantai 1','Ya'),
(2,'Lantai 2','Ya'),
(5,'Lantai 3','Ya'),
(7,'Lantai 4','Tidak');

/*Table structure for table `ruangan` */

DROP TABLE IF EXISTS `ruangan`;

CREATE TABLE `ruangan` (
  `id_ruangan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_ruangan` varchar(50) DEFAULT NULL,
  `id_gedung` int(11) DEFAULT NULL,
  `id_lantai` int(11) DEFAULT NULL,
  `aktif` enum('Ya','Tidak') DEFAULT 'Ya',
  PRIMARY KEY (`id_ruangan`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `ruangan` */

insert  into `ruangan`(`id_ruangan`,`nama_ruangan`,`id_gedung`,`id_lantai`,`aktif`) values 
(2,'Kamar No. 1',1,1,'Ya'),
(5,'Kamar No. 2',1,1,'Ya'),
(6,'Kamar No. 3',1,1,'Ya'),
(7,'Kamar No. 4',1,1,'Ya'),
(8,'Kamar No. 5',1,1,'Ya'),
(9,'Kamar No. 6',1,1,'Ya'),
(10,'Kamar No. 8',1,1,'Ya'),
(11,'Kamar No. 7',1,1,'Ya'),
(12,'Kamar No. 9',1,1,'Ya'),
(13,'Kamar No. 10',1,1,'Ya'),
(14,'Kamar No. 11',1,1,'Ya');

/*Table structure for table `status_perbaikan` */

DROP TABLE IF EXISTS `status_perbaikan`;

CREATE TABLE `status_perbaikan` (
  `id_status_perbaikan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_status_perbaikan` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id_status_perbaikan`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `status_perbaikan` */

insert  into `status_perbaikan`(`id_status_perbaikan`,`nama_status_perbaikan`) values 
(1,'Dalam Pengerjaan'),
(2,'Selesai Perbaikan'),
(3,'Belum Diperbaiki'),
(4,'Dalam Pengecekan'),
(5,'Usulan ke Pihak Ketiga'),
(6,'Usulan Pengadaan Baru');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'user',
  `blokir` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `id_session` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `users` */

insert  into `users`(`username`,`password`,`nama_lengkap`,`email`,`no_telp`,`level`,`blokir`,`id_session`) values 
('admin','21232f297a57a5a743894a0e4a801fc3','Administrator','admin@gmail.com','','admin','N','fsiohvk8h1sispbvqbcg5ncik6'),
('teknisi','e21394aaeee10f917f581054d24b031f','Teknisi','teknisi@gmail.com','','teknisi','N','t00fs1mcdsddboteq91bm8o814'),
('supervisor','09348c20a019be0318387c08df7a783d','Supervisor','supervisor@gmail.com','','supervisor','N','kdsmhd1300p85l0n0ebup51el5'),
('faruq','8e9f4806d6cdc02e0a064110e8070571','Faruq','','','admin','N','lt9aqtos35o0vbbh37r22jc6j6'),
('umar','92deb3f274aaee236194c05729bfa443','Umar','','','teknisi','N','hvrj08ibquh5gm2g8nuproefc6'),
('supri','d79444495ba8886c397b418227564d3f','Supri','','','teknisi','N','ebn42loh94aet5uqqohfp82or0'),
('suherman','32b092f86e6995e1607ae9122b79b032','Suherman','','','teknisi','N','qo4mvvd6rgrgqg2d990pckpj93'),
('halim','1d75dcced380911afbad64d9be84472b','Halim','','','teknisi','N','rpfgp5dkll494rjmhkob4c4o41'),
('wawan','0a000f688d85de79e3761dec6816b2a5','Wawan','','','teknisi','N','q4387pd795f21ae4jjd9ilqpo7'),
('sangwar','37772695500a673b912944e74c2df4c4','Sangwar','','','teknisi','N','nro8b8ct628k4fc4nin48jejv2'),
('cecep','aff738ac6681f847310d38af54327734','Cecep','','','supervisor','N','u655mfibdge86amhltngv0bd64'),
('saipul','0df98fedfb246b51562ba130fc39b376','Saiful','','','supervisor','N','p1uo64bhkoc79qii8f4pmls1b5'),
('rukmana','2f3a02afa53bcd8ee4ae9e2652f68fda','Rukmana','','','supervisor','N','2h392baf4ofcdhuvv9ie8e2q90'),
('engkos','e90d201a853c919812d5c9c7f83d8e2b','Engkos','','','supervisor','N','kbsjbsk4r2mhd9ohh003145bo1'),
('sumantri','59dfe5f23397bbe534d99490cb578918','Sumantri','','','supervisor','N','cnr02q8bltg0cpjcs47mqla3q2'),
('maulana','aff4b352312d5569903d88e0e68d3fbb','Maulana','','','pimpinan','N','b8vlbq7pl7heq8e09rdgig30h1'),
('sugondo','e1ac6f5e8028cbb0ceb47f21efabbbc0','Sugondo','','','pimpinan','N','n1ut0hn5l3255r0kcgnpcdok87'),
('hendaryani','a5588ed284dcbd295deb330227a81189','Hendaryani','','','admin','N','a5588ed284dcbd295deb330227a81189'),
('wahyu','32c9e71e866ecdbc93e497482aa6779f','Wahyu','','','admin','N','hjj11s0nmltr9dr00rn754rli5');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
