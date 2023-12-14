/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.1.30-MariaDB : Database - sikadung
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
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

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
(36,'Menara Pengawas','Ya');

/*Table structure for table `identitas` */

DROP TABLE IF EXISTS `identitas`;

CREATE TABLE `identitas` (
  `id_identitas` int(5) NOT NULL AUTO_INCREMENT,
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
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

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
  `id_status_perbaikan` int(11) DEFAULT '3',
  `volume` varchar(100) DEFAULT NULL,
  `nama_file_perbaikan` varchar(500) DEFAULT NULL,
  `nama_file_data_dukung` varchar(500) DEFAULT NULL,
  `keterangan_perbaikan` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id_kerusakan`)
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;

/*Data for the table `kerusakan` */

insert  into `kerusakan`(`id_kerusakan`,`nomor_kerusakan`,`tgl_kerusakan`,`pelapor`,`id_gedung`,`id_jenis_kerusakan`,`lokasi_kerusakan`,`keterangan_kerusakan`,`nama_file`,`nama_teknisi`,`tgl_perbaikan`,`id_status_perbaikan`,`volume`,`nama_file_perbaikan`,`nama_file_data_dukung`,`keterangan_perbaikan`) values 
(24,'001/Bld.1/S.Umum/LK/2/2021','2021-02-13','Engkos',17,2,'Aula Ruang Utama','Dinding peredam lepas','16131816996127825110259052527615.jpg','Sangwar','2021-03-14',2,'1 Lembar',NULL,NULL,'Sudah diperbaiki'),
(25,'002/Bld.1/S.Umum/LK/2/2021','2021-02-13','Rukmana',24,13,'Lantai 1','Lampu koridor ruang tempat wudhu','IMG-20210215-WA0033.jpg','Supri','2021-02-16',2,'15 lampu essensial dan 6 lampu TL 36 watt','1613442913210.jpg',NULL,'Untuk pengadaan alat listrik tahun 2021 harap dipercepat dan lengkap. Tks'),
(26,'003/Bld.1/S.Umum/LK/2/2021','2021-02-15','Engkos',17,5,'Kelas 15 Lantai 2','Engsel pintu lepas','IMG-20210214-WA0000.jpg','Sangwar','2021-02-24',2,'1',NULL,NULL,'scrup baut pada lepas'),
(27,'004/Bld.1/S.Umum/LK/2/2021','2021-02-15','Engkos',19,2,'Kamar Ketua dan Staf','Sedang di kerjakan pak rahmat','IMG_20210215_094322.jpg','Sangwar','2021-03-14',5,'',NULL,NULL,'Perbaikan dinding retak, Cat Nodrop, Pasang walpaper kembali.'),
(28,'005/Bld.1/S.Umum/LK/2/2021','2021-02-15','Engkos',19,13,'Kamar Staf','Lampu TL long di wastafel kamar staf mati ','IMG_20210215_095156.jpg','Suherman','2021-02-26',2,'','IMG20210226094044.jpg','',''),
(29,'006/Bld.1/S.Umum/LK/2/2021','2021-02-15','Rukmana',25,7,'Luar Gedung','Plafon luar berjamur','IMG_20210215_100723.jpg','Sangwar','2021-03-18',5,'',NULL,NULL,'Plafon Overstag Harus Dicat termasuk Dindingnya'),
(32,'008/Bld.1/S.Umum/LK/2/2021','2021-02-15','Rukmana',24,7,'Selasar Basement Dekat Ruang Marbot','Plafon selasar basement depan ruang marbot bocor','IMG_20210215_100149.jpg','Sangwar','2021-03-18',5,'',NULL,NULL,'Masih dalam perawatan pak rahmat'),
(34,'010/Bld.1/S.Umum/LK/2/2021','2021-02-15','Rukmana',30,38,'Kelas Besar Lantai 1','Backdrop white board depan podium keropos','IMG_20210215_085320.jpg','Sangwar','2021-03-18',5,'0.90*2.40',NULL,NULL,'Harus diganti mebler karena keropos'),
(35,'011/Bld.1/S.Umum/LK/2/2021','2021-02-15','Saipul',3,12,'Lantai 1 No. 14','Otomatis kartu listrik tidak berfungsi','20210215_111737.jpg','Suherman','2021-02-26',2,'',NULL,NULL,''),
(36,'012/Bld.1/S.Umum/LK/2/2021','2021-02-15','Saipul',3,37,'Lantai 2 No. 3','Railing balkon copot','20210215_111520.jpg','Sangwar','2021-03-18',5,'0.80 M1',NULL,NULL,'Las kembali, Dinabol, Finish Cat'),
(37,'013/Bld.1/S.Umum/LK/2/2021','2021-02-15','Saipul',3,37,'Lantai 2 No. 7','Railing balkon copot','20210215_111459.jpg','Sangwar','2021-03-18',5,'0.80 M1',NULL,NULL,'Las kembali, Dinabol, Finish Cat'),
(38,'014/Bld.1/S.Umum/LK/2/2021','2021-02-16','Rukmana',25,7,'Toilet Depan','Plafon depan toilet balai pertemuan jebol','IMG_20210216_093816.jpg','Sangwar','2021-03-18',5,'0.35*2.50',NULL,NULL,'Pergantian Plafon Finish Pengecatan'),
(39,'015/Bld.1/S.Umum/LK/2/2021','2021-02-16','Sumantri',1,7,'Lantai 1 No. 5','List plafon keropos','IMG-20210216-WA0004.jpg','Sangwar','2021-03-18',5,'5 M1',NULL,NULL,'Harus diganti Karena keropos'),
(43,'017/Bld.1/S.Umum/LK/2/2021','2021-02-22','Saipul',2,14,'VIP No. 6','Bunyi terus','16139643913796350730865994882025.jpg','Suherman','2021-03-01',2,'',NULL,NULL,'Kabel dikontaktor kendor'),
(44,'018/Bld.1/S.Umum/LK/2/2021','2021-02-22','Engkos',17,6,'Pantry Kelas Lantai 2','Lemari kitchen set pantry kelas lantai 2 rusak','16139648416072793470090545778553.jpg','Sangwar','2021-03-18',5,'1 Lembar',NULL,NULL,'Harus Diganti Pintunya karena keropos'),
(45,'019/Bld.1/S.Umum/LK/2/2021','2021-02-22','Engkos',17,13,'Koridor Kelas Lantai 2','Lampu PLS mati 6 buah','16139650397568163521032401379219.jpg','Suherman','2021-02-24',2,'',NULL,NULL,'Banyak fitting lampu yg rusak'),
(46,'020/Bld.1/S.Umum/LK/2/2021','2021-02-22','Engkos',17,7,'Kelas 14','Bocor dari AC','16139652065381614535965770818121.jpg','Sangwar','2021-03-18',5,'',NULL,NULL,'Perbaiki Instalasi Air AC'),
(47,'021/Bld.1/S.Umum/LK/2/2021','2021-02-22','Engkos',17,13,'Koridor Kelas Lantai 2','Lampu kolidor TL long mati 17 buah','16139654282338698095175673739626.jpg','Suherman','2021-02-24',2,'','16141568381851217753370.jpg','',''),
(48,'022/Bld.1/S.Umum/LK/2/2021','2021-02-22','Rukmana',29,2,'Ruang Server  IT','Dinding bekas ac  ruang server lt 2 perpus rusak bekas ac','IMG_20210222_144326.jpg','Sangwar','2021-03-18',5,'0.40*1.20',NULL,NULL,'Plester Ulang, Cat, Pasang Walpaper'),
(49,'023/Bld.1/S.Umum/LK/2/2021','2021-02-23','Rukmana',29,26,'Toilet Pria Lantai 2','Sudah di perbaiki','IMG_20210222_143609.jpg','Sangwar','2021-02-24',2,'1',NULL,NULL,'Sudah Diperbaiki'),
(50,'024/Bld.1/S.Umum/LK/2/2021','2021-02-23','Saipul',3,5,'Lantai 3 No. 19','Sudah d perbaiki','IMG-20210218-WA0005.jpg','Sangwar','2021-03-18',2,'1 Unit',NULL,NULL,'Sudah Diperbaiki'),
(51,'025/Bld.1/S.Umum/LK/2/2021','2021-02-23','Saipul',3,5,'Lantai 3 No. 31','Kunci pintu gerendel rusak','IMG-20210218-WA0005.jpg','Teknisi','2021-03-03',2,'',NULL,NULL,'Ganti kunci ,dikerjakan sendiri'),
(52,'026/Bld.1/S.Umum/LK/2/2021','2021-02-23','Saipul',3,7,'Lobby Utama','Plafon lobby utama bocor','20210223_091340.jpg','Sangwar','2021-03-18',5,'7*7',NULL,NULL,'Pengecatan Kembali'),
(53,'027/Bld.1/S.Umum/LK/2/2021','2021-02-24','Saipul',3,15,'Lantai 1 No. 20','Outdoor AC rusak ','20210224_084707.jpg','Sangwar','2021-03-02',6,'',NULL,NULL,'kompresor  sudah rusak rusak'),
(54,'028/Bld.1/S.Umum/LK/2/2021','2021-02-25','Saipul',3,5,'Pantry Lantai 1','Pintu kitchen set copot/keropos','16142211609507741947248755939726.jpg','Sangwar','2021-03-18',5,'1 Lembar',NULL,NULL,'Harus diganti pintunya karena keropos'),
(55,'029/Bld.1/S.Umum/LK/2/2021','2021-02-26','Rukmana',29,32,'Auning Samping','Auning samping perpustakaan besinya kropos','IMG-20210225-WA0015.jpg','Sangwar','2021-03-03',5,'',NULL,NULL,'Harus diganti karena besi sudah kropos'),
(56,'030/Bld.1/S.Umum/LK/2/2021','2021-02-26','Cecep',14,7,'Koridor Lantai 4','Bocor dari dak ','IMG20210226085748.jpg','Sangwar','2021-03-18',5,'',NULL,NULL,'Harus dimembran, Discreet miring'),
(57,'031/Bld.1/S.Umum/LK/2/2021','2021-02-26','Cecep',14,7,'Glonteng Torrent ','Dari torrent netes','IMG20210226085737.jpg','Sangwar','2021-03-18',5,'',NULL,NULL,'Bocor bukan pada toren tapi Dak, Harus Dimembran, Screet miring'),
(58,'032/Bld.1/S.Umum/LK/2/2021','2021-02-26','Saipul',3,21,'Lantai 1 No. 32','Leher angsa bawah wastafel rusak copot','IMG-20210224-WA0000.jpg','Halim','2021-03-03',2,'1 unit',NULL,NULL,'Silen tambah piser'),
(59,'033/Bld.1/S.Umum/LK/2/2021','2021-02-28','Rukmana',31,4,'Ruang Periksa','Sudah di perbaiki','IMG-20210303-WA0007.jpg','Sangwar','2021-03-03',2,'',NULL,NULL,'Sudah selesai diperbaiki'),
(60,'001/Bld.1/S.Umum/LK/3/2021','2021-03-01','Cecep',15,7,'Lantai 1 No. 3','Tetesan air atau rembesan dari kamar mandi lantai 2 no 3','IMG20210301082820.jpg','Sangwar','2021-03-10',5,'0.90*1.20+1.35*1.45',NULL,NULL,'Bobok kamar mandi, waterproving, perbaikan instalasi air kotor, pasang kembali keramik'),
(61,'002/Bld.1/S.Umum/LK/3/2021','2021-03-01','Cecep',14,29,'Lantai 4 No. 3','Flexible WTH bocor ','IMG-20210301-WA0014.jpg','Sangwar','2021-03-10',2,'1','IMG-20210310-WA0011.jpg','','Diganti plexiblenya'),
(62,'003/Bld.1/S.Umum/LK/3/2021','2021-03-01','Saipul',2,7,'Lantai 2 No. 10','Plafon depan cermin bocor','IMG-20210301-WA0009.jpg','Sangwar','2021-03-15',2,'1','20210315_100411.jpg','','Water hiter sudah selesai diperbaiki, tinggal pengecatan plafon kamar mandi Uk 1*1 dan pengecatan plafon Ruang Tamu Ukuran 1*0.50'),
(63,'004/Bld.1/S.Umum/LK/3/2021','2021-03-03','Rukmana',30,2,'Lantai 1 Ruang WI Utama','Ruang wi utama lab lt 1 dinding walfafer rusak','IMG_20210303_091303.jpg','Sangwar','2021-03-03',5,'',NULL,NULL,'Perbaikan dinding retak, plester finish aci, cat no dropp, pasang walpaper kembali'),
(64,'005/Bld.1/S.Umum/LK/3/2021','2021-03-04','Sangwar',17,10,'Aula','Papan nama petunjuk upacara rusak sudah karatan perlu dicat ulang, jumlah ada 14 unit','16148250344071507543506.jpg','Sangwar','2021-03-04',5,'14 unit',NULL,NULL,'Usulan cat ulang (Duco) '),
(65,'006/Bld.1/S.Umum/LK/3/2021','2021-03-05','Saipul',3,24,'Lantai 1 No. 23','Kloset ngocor terus tidak bisa mati','IMG-20210305-WA0006.jpg','Sangwar','2021-03-18',2,'1',NULL,NULL,'Sudah diperbaiki'),
(66,'007/Bld.1/S.Umum/LK/3/2021','2021-03-05','Faruq',1,2,'Lantai 3','Dinding bekas instalasi ac berlubang,dan ac rusak msh diatap. Lokasi candra 1 dan candra 2','16149266089935116112425749012467.jpg','Sangwar','2021-03-18',5,'0.60*0.60*24',NULL,NULL,'Termasuk Candra 2 Ukurannya sama dan jumlahnya sama, 0.60*0.60*24'),
(67,'008/Bld.1/S.Umum/LK/3/2021','2021-03-08','Saipul',2,13,'Lantai 3 No. 25','Lampu kamar mandi rusak mati','16151683610744018592647145657133.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(68,'009/Bld.1/S.Umum/LK/3/2021','2021-03-07','Saipul',2,11,'Lantai 3 No. 17','Stop kontak rusak','1615168513605693228077706985995.jpg','Umar','2021-03-16',6,'2 pcs',NULL,NULL,'pengadaan barang kurang cepat\r\n'),
(69,'010/Bld.1/S.Umum/LK/3/2021','2021-03-08','Cecep',14,21,'Lantai 3 No. 1','Fleksibel pecah di bawah wastafel','IMG20210308084313.jpg','Sangwar','2021-03-09',2,'1','IMG-20210309-WA0005.jpg','','Sudah Diperbaiki / Diganti plexiblenya'),
(70,'011/Bld.1/S.Umum/LK/3/2021','2021-03-09','Halim',31,24,'Kloset','Airnya tidak keluar','IMG-20210309-WA0004.jpg','Sangwar','2021-03-09',2,'1',NULL,NULL,'Sudah Diperbaiki'),
(71,'012/Bld.1/S.Umum/LK/3/2021','2021-03-09','Halim',14,13,'Atas Wastafel Kamar Mandi','Lampu atas wastafel lepas / mau jatuh','IMG-20210309-WA0006.jpg','Umar','2021-03-16',2,'1 pcs',NULL,NULL,''),
(72,'013/Bld.1/S.Umum/LK/3/2021','2021-03-08','Cecep ',14,21,'Wastapel Dapur','Flexible bocor','IMG-20210309-WA0005.jpg','Sangwar','2021-03-09',2,'1','IMG-20210309-WA0005.jpg','','Sudah diperbaiki'),
(73,'014/Bld.1/S.Umum/LK/3/2021','2021-03-10','Saipul',2,40,'Lantai 3 Koridor','Lis kayu koridor keropos depan kamar no 13','1615345571982450365651364452635.jpg','Sangwar','2021-03-15',5,'3 M1',NULL,NULL,'Harus diganti lisnya karena keropos'),
(74,'015/Bld.1/S.Umum/LK/3/2021','2021-03-10','Saipul',2,24,'Lantai 2 No. 5','Kloset ngocor terus ga bisa berhenti','16153459694778321746549274742592.jpg','Sangwar','2021-03-15',2,'1','1615777030473553322289.jpg','','Sudah diperbaiki'),
(75,'016/Bld.1/S.Umum/LK/3/2021','2021-03-09','Wawan',14,29,'Kamar Mandi','Flexible bocor','IMG-20210310-WA0009.jpg','Sangwar','2021-03-10',2,'1','IMG-20210310-WA0011.jpg','','Sudah dipeebaiki / Ganti plexible'),
(76,'017/Bld.1/S.Umum/LK/3/2021','2021-03-12','Saipul',3,1,'Koridor Lantai 3 Depan Kamar No. 4','Keramik koridor depan kamar no. 4 ngangkat lantai 3','IMG-20210312-WA0001.jpg','Sangwar','2021-03-15',5,'1x1',NULL,NULL,'Harus diganti karena pecah'),
(77,'018/Bld.1/S.Umum/LK/3/2021','2021-03-12','Saipul',2,29,'Lantai 3 No. 20','Waeter heater air panas tidak keluar','16155151744062400456846653194014.jpg','Sangwar','2021-03-15',2,'1','1615775205907801384225.jpg','','Sudah diperbaiki, pergantian plexible 2 unit'),
(78,'019/Bld.1/S.Umum/LK/3/2021','2021-03-12','Saipul',2,29,'Lantai 3 No. 14','Water heater tidak panas','16155155032364867455902949151888.jpg','Sangwar','2021-03-15',2,'1','IMG-20210315-WA0001.jpg','','Sudah diperbaiki, listriknya yg bermasalah'),
(79,'020/Bld.1/S.Umum/LK/3/2021','2021-03-12','Saipul',2,29,'Lantai 3 No. 12','Water heater tidak panas','16155155662976483603705012566134.jpg','Sangwar','2021-03-15',2,'1','1615775556325-87096867.jpg','','Colokan listrik kebakar'),
(80,'021/Bld.1/S.Umum/LK/3/2021','2021-03-12','Saipul',2,29,'Lantai 3 No. 4','Water heater tidak panas','16155156104097300906331602719149.jpg','Sangwar','2021-03-15',2,'1','16157759388781667884586.jpg','','Colokan listrik yg bermasalah'),
(81,'022/Bld.1/S.Umum/LK/3/2021','2021-03-15','sumantri',1,13,'Tangga','lampu neon ( ring ) mati 4 buah','1615815202731452361575.jpg','Umar','2021-03-16',2,'4 pcs',NULL,NULL,''),
(82,'023/Bld.1/S.Umum/LK/3/2021','2021-03-17','Cecep',14,7,'Plapon bocor dari lantai 4 no 3','Bocor dari kamar mandi di lantai 4 no 3 dan airnya kena lampu ','Screenshot_2021-03-16-10-54-05-68.png','Sangwar','2021-03-26',5,'',NULL,NULL,'Membran ulang tetap, pembuatan pintu menhol Uk 1.20×0.60, Bongkar pasang plafon finishing pengecatan'),
(83,'024/Bld.1/S.Umum/LK/3/2021','2021-03-17','sumantri',1,7,'Lantai 2 No. 3','bocor dari lantai 3 (atas wastafel )','IMG-20210317-WA0000.jpg','Sangwar','2021-03-31',5,'',NULL,NULL,'Bocor dari lantai 3, perbaikan instalasi air kotor 1 lot, penggantian plafon 1x1.'),
(84,'025/Bld.1/S.Umum/LK/3/2021','2021-03-21','Saipul',2,16,'Lantai 1 No. 11','Dispenser tidak panas','16162915280136050970354660532407.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(85,'026/Bld.1/S.Umum/LK/3/2021','2021-03-22','Rukmana',24,31,'Mesin pompa','Pompa air stop kran bocor','Screenshot_2021-03-22-08-41-12-547_com.whatsapp.jpg','Umar','2021-03-22',6,'2 pcs',NULL,NULL,''),
(86,'027/Bld.1/S.Umum/LK/3/2021','2021-03-26','Engkos',18,1,'Serbaguna lantai 1','Keramik lantai ngangkat','IMG-20210326-WA0008.jpg','Sangwar','2021-03-26',5,'12 M2','20210326_091955.jpg','','Perbaikan dan penggantian keramik baru 4 lembar'),
(87,'028/Bld.1/S.Umum/LK/3/2021','2021-03-29','Sumantri',1,2,'Lantai 1 No. 1','dinding kamar tidur retak bagian pojok','1616982587206472276009.jpg','Sangwar','2021-03-31',5,'0.50x1','20210331_083231.jpg','','Perbaikan dinding kamar retak + pengecatan '),
(88,'029/Bld.1/S.Umum/LK/3/2021','2021-03-30','Rukamna',30,1,'Ruang sidang semu  lt 2','Keramik pecah  belum ada  perbaikan','IMG_20210330_084014.jpg','Sangwar','2021-03-30',5,'10 M2',NULL,NULL,'Kerusakan itu ada 2 ruangan'),
(89,'030/Bld.1/S.Umum/LK/3/2021','2021-03-30','Saipul',3,4,'Lantai 3 No. 10','Gorden copot','IMG-20210330-WA0001.jpeg','Sangwar','2021-03-30',2,'1','IMG-20210330-WA0005.jpg','','Sudah diperbaiki '),
(90,'031/Bld.1/S.Umum/LK/3/2021','2021-03-30','Rukmana',25,24,'Toilet belakang','Kloset toilet belakang rusak','IMG_20210330_091309.jpg','Sangwar','2021-03-31',5,'1 unit',NULL,NULL,'Pergantian closed'),
(91,'032/Bld.1/S.Umum/LK/3/2021','2021-03-31','Saipul',2,17,'Lantai 2 No. 11','Tv tidak bisa nyala atau mati total tidak ada arus listrik','16171756660262933954020636331112.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(92,'001/Bld.1/S.Umum/LK/4/2021','2021-04-06','Saipul',3,2,'Lantai 2 No. 1','Dinding di samping lemari yang baru terkelupas belum di pelester','20210406_154641.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(93,'002/Bld.1/S.Umum/LK/4/2021','2021-04-07','Saipul',3,24,'Lantai 3 No. 14','Kloset ngocor terus tidak bisa mati air nya','20210407_114548.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(94,'003/Bld.1/S.Umum/LK/4/2021','2021-04-09','Saipul',2,5,'VIP 4','Kusen pintu kamar ruang tidur di makan rayap','20210409_092505.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(95,'004/Bld.1/S.Umum/LK/4/2021','2021-04-09','Saipul',2,6,'Pantry','Lemari pintu rusak copot','20210409_093323.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(96,'005/Bld.1/S.Umum/LK/4/2021','2021-04-14','Saipul',3,24,'Lantai 3 No. 15','Kloset ngocor terus ga bisa mati','20210414_090457.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(97,'006/Bld.1/S.Umum/LK/4/2021','2021-04-16','Saipul',2,2,'Koridor ','Dinding bekas apar di setiap lantai 1,2, dan 3 belum di cat','20210416_084639.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(98,'007/Bld.1/S.Umum/LK/4/2021','2021-04-17','Saipul',3,5,'Lantai 2 Pantry','Pintu kitchen set copot','20210416_085911.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(99,'008/Bld.1/S.Umum/LK/4/2021','2021-04-16','sumantri',1,2,'Dak kanopi lobby depan','Dinding dak ab kanopi depan banyak yang retak','IMG-20210416-WA0007.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL),
(100,'009/Bld.1/S.Umum/LK/4/2021','2021-04-18','Saipul',2,41,'Lantai 1 No. 11','Kusen di makan rayap','16187112009491019669026779642048.jpg',NULL,NULL,3,NULL,NULL,NULL,NULL);

/*Table structure for table `lantai` */

DROP TABLE IF EXISTS `lantai`;

CREATE TABLE `lantai` (
  `id_lantai` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lantai` varchar(50) DEFAULT NULL,
  `aktif` enum('Ya','Tidak') DEFAULT 'Ya',
  PRIMARY KEY (`id_lantai`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

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
('admin','21232f297a57a5a743894a0e4a801fc3','Administrator','admin@gmail.com','','admin','N','97fa7u3p34t7mg9k6hh9q6cre1'),
('teknisi','e21394aaeee10f917f581054d24b031f','Teknisi','teknisi@gmail.com','','teknisi','N','fk30ao85s2fsgqgasgmk1lvpk1'),
('supervisor','09348c20a019be0318387c08df7a783d','Supervisor','supervisor@gmail.com','','supervisor','N','tqup7qeefuvr9nuchpcb8o1t20'),
('pimpinan','90973652b88fe07d05a4304f0a945de8','Faruq Indrakusumah','','','pimpinan','N','6cfn9lj2sqd9nig6nbnjh01so5'),
('umar','92deb3f274aaee236194c05729bfa443','Umar','','','teknisi','N','6jfivv71kc2svlrbie4sop23i2'),
('supri','d79444495ba8886c397b418227564d3f','Supri','','','teknisi','N','3l1v7tqm6pivajtl8ttckrvk12'),
('suherman','32b092f86e6995e1607ae9122b79b032','Suherman','','','teknisi','N','611rji69afed10im964d8nlm02'),
('halim','1d75dcced380911afbad64d9be84472b','Halim','','','teknisi','N','5a1ovcb81670ptck4c4mglqqv1'),
('wawan','0a000f688d85de79e3761dec6816b2a5','Wawan','','','teknisi','N','gciqdjtfk5uq6egpgd9uk4i4s1'),
('sangwar','37772695500a673b912944e74c2df4c4','Sangwar','','','teknisi','N','tbcsv0phbeia3fm319ljhpgr73'),
('cecep','aff738ac6681f847310d38af54327734','Cecep','','','supervisor','N','2nch5i7mf617q99vh12si5hfo6'),
('saipul','0df98fedfb246b51562ba130fc39b376','Saipul','','','supervisor','N','hvnqu1po07ldrnu6h28hktmmp3'),
('rukmana','2f3a02afa53bcd8ee4ae9e2652f68fda','Rukmana','','','supervisor','N','mf8937ghe4q52li48o7ofqfna3'),
('engkos','e90d201a853c919812d5c9c7f83d8e2b','Engkos','','','supervisor','N','fcsal20nbhvug1q7oadrdhp767'),
('sumantri','59dfe5f23397bbe534d99490cb578918','Sumantri','','','supervisor','N','l19tn7ogiakgkr9vnq4pui3h92');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
