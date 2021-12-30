-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2020 at 06:50 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearning`
--

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `ID_KELAS` varchar(6) NOT NULL,
  `NIP` varchar(9) DEFAULT NULL,
  `NAMA_KELAS` varchar(30) DEFAULT NULL,
  `DESKRIPSI_KELAS` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`ID_KELAS`, `NIP`, `NAMA_KELAS`, `DESKRIPSI_KELAS`) VALUES
('AP07', '025021997', 'Algoritma Pemrograman', 'Dasar-dasar algoritma untuk tahap yang lebih lanjut'),
('IMK20', '025021997', 'Interaksi Manusia Komputer', 'Disiplin ilmu yang meliputi perancangan, evaluasi, dan implementasi antarmuka pengguna komputer.'),
('KDA07', '025021997', 'Keamanan Data Aplikasi', 'Mempelajari tentang prosedur dengan dukungan dari regulasi dan teknologi untuk melindungi data.'),
('MP09', '026091999', 'Metodologi Penelitian', 'Mempelajari literature untuk persiapan Program Skripsi'),
('PCD20', '026091999', 'Pengolahan Citra Digital', 'Bidang ilmu bagaimana suatu citra dibentuk, diolah, dan dianalisis untuk menghasilkan informasi yang dapat dipahami oleh manusia.');

-- --------------------------------------------------------

--
-- Table structure for table `masuk`
--

CREATE TABLE `masuk` (
  `NIM` varchar(12) NOT NULL,
  `ID_KELAS` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `masuk`
--

INSERT INTO `masuk` (`NIM`, `ID_KELAS`) VALUES
('170411100052', 'AP07'),
('170411100052', 'IMK20'),
('170411100052', 'KDA07'),
('170411100052', 'MP09'),
('180411100008', 'AP07'),
('180411100008', 'PCD20');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `ID_MATERI` varchar(6) NOT NULL,
  `ID_KELAS` varchar(6) DEFAULT NULL,
  `TITLE` varchar(256) NOT NULL,
  `CONTENT` varchar(256) DEFAULT NULL,
  `KETERANGAN` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`ID_MATERI`, `ID_KELAS`, `TITLE`, `CONTENT`, `KETERANGAN`) VALUES
('ADA07', 'AP07', 'Dasar Algoritma', 'ADA07file_logo.png', 'None'),
('IMK201', 'IMK20', 'Interaksi Manusia dan Komputer', 'file_logo.png', 'none'),
('IMK202', 'IMK20', 'Desain Interface', 'file_logo.png', 'none'),
('KDA201', 'KDA07', 'Data Security', 'file_logo.png', 'none'),
('KDA202', 'KDA07', 'Ethical Hackers', 'file_logo.png', 'none'),
('PCD201', 'PCD20', 'Digital Image Processing', 'PDIP09file_logo.png', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `NIM` varchar(12) NOT NULL,
  `NAMA_STUDENT` varchar(30) DEFAULT NULL,
  `FOTO` varchar(256) DEFAULT NULL,
  `PASSWORD_STUDENT` varchar(64) DEFAULT NULL,
  `EMAIL` varchar(25) DEFAULT NULL,
  `ALAMAT` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`NIM`, `NAMA_STUDENT`, `FOTO`, `PASSWORD_STUDENT`, `EMAIL`, `ALAMAT`) VALUES
('170411100052', 'Sandi Indika Saputra', '170411100052profil.jpg', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'sandidika521@gmail.com', 'Surabaya'),
('180411100008', 'Triandani Umiyati', '170411100052profil.jpg', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'triandaniumiyati@gmail.co', 'Bangkalan');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `NIP` varchar(12) NOT NULL,
  `NAMA_TEACHERS` varchar(30) DEFAULT NULL,
  `EMAIL` varchar(25) DEFAULT NULL,
  `ALAMAT` varchar(50) DEFAULT NULL,
  `FOTO` varchar(256) DEFAULT NULL,
  `PASSWORD_TEACHER` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`NIP`, `NAMA_TEACHERS`, `EMAIL`, `ALAMAT`, `FOTO`, `PASSWORD_TEACHER`) VALUES
('025021997', 'Sandi Mendes', 'sandidika521@outlook.com', 'Sidoarjo', '025021997profil.jpg', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92'),
('026091999', 'Tri Cilong', 'triandani2609@gmail.com', 'Bangkalan', '025021997profil.jpg', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`ID_KELAS`),
  ADD KEY `FK_MENGAMPU` (`NIP`);

--
-- Indexes for table `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`NIM`,`ID_KELAS`),
  ADD KEY `FK_MASUK2` (`ID_KELAS`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`ID_MATERI`),
  ADD KEY `FK_MEMILIKI` (`ID_KELAS`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`NIM`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`NIP`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `FK_MENGAMPU` FOREIGN KEY (`NIP`) REFERENCES `teacher` (`NIP`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `masuk`
--
ALTER TABLE `masuk`
  ADD CONSTRAINT `FK_MASUK` FOREIGN KEY (`NIM`) REFERENCES `student` (`NIM`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MASUK2` FOREIGN KEY (`ID_KELAS`) REFERENCES `kelas` (`ID_KELAS`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `materi`
--
ALTER TABLE `materi`
  ADD CONSTRAINT `FK_MEMILIKI` FOREIGN KEY (`ID_KELAS`) REFERENCES `kelas` (`ID_KELAS`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
