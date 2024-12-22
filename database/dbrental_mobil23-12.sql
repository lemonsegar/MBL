/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 8.0.30 : Database - dbrental_mobil
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`dbrental_mobil` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `dbrental_mobil`;

/*Table structure for table `datamobil` */

DROP TABLE IF EXISTS `datamobil`;

CREATE TABLE `datamobil` (
  `idmobil` char(7) COLLATE utf8mb4_general_ci NOT NULL,
  `merek` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tahun` int DEFAULT NULL,
  `noplat` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `hrgsewa` double DEFAULT NULL,
  PRIMARY KEY (`idmobil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `datamobil` */

insert  into `datamobil`(`idmobil`,`merek`,`tahun`,`noplat`,`status`,`hrgsewa`) values 
('M-0001','Alphard',2020,'BA 999 CC','Tersedia',500000),
('M-0002','Bus Big',2021,'BA2351PB','Tersedia',350000);

/*Table structure for table `karyawan` */

DROP TABLE IF EXISTS `karyawan`;

CREATE TABLE `karyawan` (
  `idkaryawan` char(7) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nohp` varchar(16) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nointitas` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idkaryawan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `karyawan` */

insert  into `karyawan`(`idkaryawan`,`nama`,`nohp`,`nointitas`) values 
('K-001','Ahmad','087654321234','KTP,SIM,STNK'),
('K-002','Halim','082138433568','SIM,KTP,SNTK');

/*Table structure for table `pelanggan` */

DROP TABLE IF EXISTS `pelanggan`;

CREATE TABLE `pelanggan` (
  `idpel` char(7) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nohp` varchar(16) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idpel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pelanggan` */

insert  into `pelanggan`(`idpel`,`nama`,`nohp`,`alamat`) values 
('P-001','Romi','087612345678','Olo Rimbo'),
('P-002','adha','086712543245','Sunua'),
('P-003','Jamaludin','087757557','Padang');

/*Table structure for table `peminjaman` */

DROP TABLE IF EXISTS `peminjaman`;

CREATE TABLE `peminjaman` (
  `idpeminjam` int NOT NULL AUTO_INCREMENT,
  `faktur` char(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `idpel` char(7) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idmobil` char(7) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lama` int DEFAULT NULL,
  `total` double DEFAULT NULL,
  `tanggalkembali` date DEFAULT NULL,
  PRIMARY KEY (`idpeminjam`),
  KEY `idpel` (`tanggal`),
  KEY `idmobil_2` (`idmobil`),
  KEY `idpel_2` (`idpel`),
  CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`idmobil`) REFERENCES `datamobil` (`idmobil`),
  CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`idpel`) REFERENCES `pelanggan` (`idpel`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `peminjaman` */

insert  into `peminjaman`(`idpeminjam`,`faktur`,`tanggal`,`idpel`,`idmobil`,`lama`,`total`,`tanggalkembali`) values 
(10,'TRX-202412220001','2024-12-23','P-001','M-0002',2,1000000,'2024-12-25'),
(11,'TRX-202412220002','2025-01-11','P-003','M-0002',3,1050000,'2025-01-14');

/*Table structure for table `pengembalian` */

DROP TABLE IF EXISTS `pengembalian`;

CREATE TABLE `pengembalian` (
  `idkembali` int NOT NULL AUTO_INCREMENT,
  `faktur` char(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgldikembalikan` date DEFAULT NULL,
  `denda` double DEFAULT NULL,
  PRIMARY KEY (`idkembali`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pengembalian` */

insert  into `pengembalian`(`idkembali`,`faktur`,`tgldikembalikan`,`denda`) values 
(4,'TRX-202412220001','2024-12-27',100000),
(5,'TRX-202412220002','2025-01-14',0);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` char(7) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_user` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `level` int DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user` */

insert  into `user`(`id_user`,`nama_user`,`email`,`password`,`level`) values 
('U-001','Nana','nana@gmail.com','$2y$10$itN9Ze966yimUn.gvTMoI.UhDqqlVYkuIzqclyw4PDxME6aqTCfOK',1),
('U-002','Nur','Anur@gmail.com','$2y$10$a4ghtkLWx59ktJc/Hz6CL.Wr5jRTG32AwfhEAi8qwXLomwxoETSHW',2),
('U-003','Alahan','Anur@gmail.com','$2y$10$O/BRWOWpGfMyh8QqjfjaKOCGQkASnWO5xjyzYgwZv1N/mNGJ0Yy4q',3);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
