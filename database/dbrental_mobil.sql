/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.28-MariaDB : Database - dbrental_mobil
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`dbrental_mobil` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `dbrental_mobil`;

/*Table structure for table `datamobil` */

DROP TABLE IF EXISTS `datamobil`;

CREATE TABLE `datamobil` (
  `idmobil` char(7) NOT NULL,
  `merek` varchar(30) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `noplat` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `hrgsewa` double DEFAULT NULL,
  PRIMARY KEY (`idmobil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `datamobil` */

insert  into `datamobil`(`idmobil`,`merek`,`tahun`,`noplat`,`status`,`hrgsewa`) values ('M-0001','Bus Midium',2019,'BA9087BP','Tersedia',2000000),('M-0002','Bus Big',2020,'BA2351PB','Sedang Perbaiki',3500000),('M-003','Bus Standar',2020,'Ba9087Bp','Tersedia',2500000);

/*Table structure for table `karyawan` */

DROP TABLE IF EXISTS `karyawan`;

CREATE TABLE `karyawan` (
  `idkaryawan` char(7) NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `nohp` varchar(16) DEFAULT NULL,
  `nointitas` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idkaryawan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `karyawan` */

insert  into `karyawan`(`idkaryawan`,`nama`,`nohp`,`nointitas`) values ('K-001','Ahmad','087654321234','KTP,SIM,STNK'),('K-002','Halim','082138433568','SIM,KTP,SNTK');

/*Table structure for table `pelanggan` */

DROP TABLE IF EXISTS `pelanggan`;

CREATE TABLE `pelanggan` (
  `idpel` char(7) NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `nohp` varchar(16) DEFAULT NULL,
  `alamat` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idpel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pelanggan` */

insert  into `pelanggan`(`idpel`,`nama`,`nohp`,`alamat`) values ('P-001','Romi','087612345678','Olo Rimbo'),('P-002','adha','086712543245','Sunua');

/*Table structure for table `peminjaman` */

DROP TABLE IF EXISTS `peminjaman`;

CREATE TABLE `peminjaman` (
  `idpeminjam` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `idpel` char(7) DEFAULT NULL,
  `idmobil` char(7) DEFAULT NULL,
  `lama` int(11) DEFAULT NULL,
  `total` double DEFAULT NULL,
  PRIMARY KEY (`idpeminjam`),
  KEY `idpel` (`tanggal`),
  KEY `idmobil_2` (`idmobil`),
  KEY `idpel_2` (`idpel`),
  CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`idmobil`) REFERENCES `datamobil` (`idmobil`),
  CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`idpel`) REFERENCES `pelanggan` (`idpel`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `peminjaman` */

insert  into `peminjaman`(`idpeminjam`,`tanggal`,`idpel`,`idmobil`,`lama`,`total`) values (1,'2024-12-17','P-001','M-003',2,5000000);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` char(7) NOT NULL,
  `nama_user` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user` */

insert  into `user`(`id_user`,`nama_user`,`email`,`password`,`level`) values ('U-001','Nana','nana@gmail.com','$2y$10$lMeqn2rtO9J1UWbLo0R2Q.uGjJM641XkEyh4NeVS0oBsQtPcAF5jS',1),('U-002','Nur','Anur@gmail.com','$2y$10$a4ghtkLWx59ktJc/Hz6CL.Wr5jRTG32AwfhEAi8qwXLomwxoETSHW',2),('U-003','Alahan','Anur@gmail.com','$2y$10$O/BRWOWpGfMyh8QqjfjaKOCGQkASnWO5xjyzYgwZv1N/mNGJ0Yy4q',3);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
