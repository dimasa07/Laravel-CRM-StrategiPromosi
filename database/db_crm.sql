/*
SQLyog Community v13.2.0 (64 bit)
MySQL - 10.4.27-MariaDB : Database - db_crm
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_crm` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `db_crm`;

/*Table structure for table `alternatif` */

DROP TABLE IF EXISTS `alternatif`;

CREATE TABLE `alternatif` (
  `id_alternatif` int(10) NOT NULL AUTO_INCREMENT,
  `kode_alternatif` varchar(5) DEFAULT NULL,
  `bauran_promosi` varchar(255) DEFAULT NULL,
  `jenis` varchar(255) DEFAULT NULL,
  `waktu_promosi` varchar(255) DEFAULT NULL,
  `skala_promosi` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_alternatif`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `alternatif` */

insert  into `alternatif`(`id_alternatif`,`kode_alternatif`,`bauran_promosi`,`jenis`,`waktu_promosi`,`skala_promosi`) values 
(2,'A1','Advertising','Brosur','Setahun sekali','3-4 jam'),
(8,'A2','Advertising','Baliho','3-4 jam','Hanya dilakukan sekali dalam promosi'),
(9,'A3','Personal Selling','Interaksi langsung dengan calon pendaftar','Kurang lebih 1 jam','Dilakukan sekali perminggu dalam sekali promosi'),
(10,'A4','Direct Marketing','Promosi melalui sosial media','Online selama jam kerja','Online dihari jam kerja');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `gambar` */

DROP TABLE IF EXISTS `gambar`;

CREATE TABLE `gambar` (
  `id_gambar` int(10) NOT NULL AUTO_INCREMENT,
  `nama_gambar` text DEFAULT NULL,
  `urutan` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_gambar`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `gambar` */

insert  into `gambar`(`id_gambar`,`nama_gambar`,`urutan`) values 
(28,'img/FEcgTstgItyuVeiZdKl0zO0qaQFXbgwHMgix2rlB.jpg',1),
(29,'img/brTomXWd5APwyIT7PYuyTg8dNHRghPeDTwOjFbtK.jpg',2),
(30,'img/73U2tIPIRqaJapQ0UocnqKRQoLM92gasZm4ChfyM.jpg',3),
(31,'img/LkBY9tiGRm47J2UlBo8MaPbM57PFZtFzYme0HCbg.jpg',4),
(32,'img/jPlGtcolaURZZx7b0YOFs8P5emBukVQYLIRERxIs.jpg',5),
(34,'img/xMJkEITdwZZxTX6VWSbEAvviL7EpIH7ZlruzMoAi.jpg',6);

/*Table structure for table `hasil` */

DROP TABLE IF EXISTS `hasil`;

CREATE TABLE `hasil` (
  `id_hasil` int(10) NOT NULL AUTO_INCREMENT,
  `id_alternatif` int(10) DEFAULT NULL,
  `nilai` double DEFAULT NULL,
  `urutan` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_hasil`),
  KEY `id_alternatif` (`id_alternatif`),
  CONSTRAINT `hasil_ibfk_1` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id_alternatif`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `hasil` */

insert  into `hasil`(`id_hasil`,`id_alternatif`,`nilai`,`urutan`) values 
(23,2,4.6481481481481,1),
(24,8,3.0017361111111,2),
(25,9,3.0005787037037,4),
(26,10,3.0011574074074,3);

/*Table structure for table `kriteria` */

DROP TABLE IF EXISTS `kriteria`;

CREATE TABLE `kriteria` (
  `id_kriteria` int(10) NOT NULL AUTO_INCREMENT,
  `kode_kriteria` varchar(5) DEFAULT NULL,
  `nama_kriteria` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `bobot` int(10) DEFAULT NULL,
  `jenis` enum('Benefit','Cost') DEFAULT NULL,
  PRIMARY KEY (`id_kriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `kriteria` */

insert  into `kriteria`(`id_kriteria`,`kode_kriteria`,`nama_kriteria`,`keterangan`,`bobot`,`jenis`) values 
(6,'C1','Skala Promosi','-',3,'Benefit'),
(7,'C2','Biaya promosi yang diperlukan','-',4,'Cost'),
(8,'C3','Waktu dalam menentukan promosi','-',3,'Benefit');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2014_10_12_200000_add_two_factor_columns_to_users_table',1),
(4,'2019_08_19_000000_create_failed_jobs_table',1),
(5,'2019_12_14_000001_create_personal_access_tokens_table',1),
(6,'2023_07_17_075718_create_sessions_table',1);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `pendaftar` */

DROP TABLE IF EXISTS `pendaftar`;

CREATE TABLE `pendaftar` (
  `id_pendaftar` int(10) NOT NULL AUTO_INCREMENT,
  `nama_siswa` varchar(255) DEFAULT NULL,
  `asal_sekolah` varchar(255) DEFAULT NULL,
  `tahun_ajaran` varchar(255) DEFAULT NULL,
  `nama_ortu` varchar(255) DEFAULT NULL,
  `kontak` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_pendaftar`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pendaftar` */

insert  into `pendaftar`(`id_pendaftar`,`nama_siswa`,`asal_sekolah`,`tahun_ajaran`,`nama_ortu`,`kontak`) values 
(1,'Andre','SMA N 19 Bandung','2023','Nila','08989898');

/*Table structure for table `penilaian` */

DROP TABLE IF EXISTS `penilaian`;

CREATE TABLE `penilaian` (
  `id_penilaian` int(10) NOT NULL AUTO_INCREMENT,
  `id_alternatif` int(10) DEFAULT NULL,
  `id_kriteria` int(10) DEFAULT NULL,
  `bobot` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_penilaian`),
  KEY `id_alternatif` (`id_alternatif`),
  KEY `id_kriteria` (`id_kriteria`),
  CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id_alternatif`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `penilaian` */

insert  into `penilaian`(`id_penilaian`,`id_alternatif`,`id_kriteria`,`bobot`) values 
(5,2,7,4),
(6,2,8,3),
(7,8,6,1),
(9,8,8,2),
(10,9,6,2),
(11,9,7,1),
(12,9,8,3),
(13,10,6,3),
(14,10,7,2),
(19,10,8,1),
(23,2,6,2),
(24,8,7,3);

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `rincian_biaya` */

DROP TABLE IF EXISTS `rincian_biaya`;

CREATE TABLE `rincian_biaya` (
  `id_rincian_biaya` int(10) NOT NULL AUTO_INCREMENT,
  `id_alternatif` int(10) DEFAULT NULL,
  `nama_rincian` varchar(255) DEFAULT NULL,
  `harga` int(10) DEFAULT NULL,
  `jumlah` int(10) DEFAULT NULL,
  `total` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_rincian_biaya`),
  KEY `id_alternatif` (`id_alternatif`),
  CONSTRAINT `rincian_biaya_ibfk_1` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id_alternatif`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `rincian_biaya` */

insert  into `rincian_biaya`(`id_rincian_biaya`,`id_alternatif`,`nama_rincian`,`harga`,`jumlah`,`total`) values 
(1,2,'Desain Brosur',100,500,50000),
(3,2,'Cetak',2300,2,4600);

/*Table structure for table `sessions` */

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sessions` */

insert  into `sessions`(`id`,`user_id`,`ip_address`,`user_agent`,`payload`,`last_activity`) values 
('vn4azE8PCjV6RhPiVaFnm0IiCcOHKnHxRS6t8Qix',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWnlVMVFHOWhsaWZOT2w4VVhCVjdyWmsxZGNtZURpR3lnd0NDbUpHTCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fX0=',1690971933);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` int(10) NOT NULL AUTO_INCREMENT,
  `nama_pengguna` varchar(255) DEFAULT NULL,
  `hak_akses` enum('Admin','PPSB') DEFAULT NULL,
  `no_telepon` varchar(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user` */

insert  into `user`(`id_user`,`nama_pengguna`,`hak_akses`,`no_telepon`,`email`,`username`,`password`) values 
(26,'Admin','Admin',NULL,NULL,'admin','$2y$10$0N.QFJ8Z9bKyC8lOunu0me7S5it582PqJWJECKCszCw3ceHd7Szmm'),
(28,'PPSB','PPSB',NULL,NULL,'ppsb','$2y$10$8icjCU.oOc7A2DDVG2USzuZzsDCiFZprwyoHitr7kRy31Aj0PinQO');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) unsigned DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`two_factor_secret`,`two_factor_recovery_codes`,`two_factor_confirmed_at`,`remember_token`,`current_team_id`,`profile_photo_path`,`created_at`,`updated_at`) values 
(2,'Dimas Agung','dimasagung35bdg76@gmail.com',NULL,'$2y$10$L5.WuuKEbu2o00yQU1bULOxhxe63iHuf6h9OO/tDX9W17.UN0FT9u',NULL,NULL,NULL,'jbsWC2LOjwTRWLMmPctopEiyxrDW0ce666Y7gfDTfRBYYmu37FHC4lJY8uQ5',NULL,NULL,'2023-07-23 11:20:02','2023-07-23 12:03:50');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
