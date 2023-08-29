-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2022 at 02:50 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siamad_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `siamad_absen`
--

CREATE TABLE `siamad_absen` (
  `id_absen` int(11) NOT NULL,
  `nis_siswa` varchar(12) NOT NULL,
  `pertemuan` varchar(11) NOT NULL,
  `keterangan` varchar(10) NOT NULL,
  `semester` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siamad_absen`
--

INSERT INTO `siamad_absen` (`id_absen`, `nis_siswa`, `pertemuan`, `keterangan`, `semester`) VALUES
(6, '12345', '1', 'Hadir', '1'),
(7, '19010', '1', 'Hadir', '1'),
(9, '12345', '2', 'Hadir', '1');

-- --------------------------------------------------------

--
-- Table structure for table `siamad_admin`
--

CREATE TABLE `siamad_admin` (
  `kd_admin` varchar(11) NOT NULL,
  `username_admin` varchar(15) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `alamat_admin` text NOT NULL,
  `tlp_admin` varchar(12) NOT NULL,
  `pwd_admin` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siamad_admin`
--

INSERT INTO `siamad_admin` (`kd_admin`, `username_admin`, `nama_admin`, `alamat_admin`, `tlp_admin`, `pwd_admin`) VALUES
('ADM001', 'farhan', 'Farhan A', 'Desa Kertayasa', '089765432', 'admin11'),
('ADM002', 'nugraha', 'Nugraha', 'Desa Babakan', '08976522687', 'admin02');

-- --------------------------------------------------------

--
-- Table structure for table `siamad_guru`
--

CREATE TABLE `siamad_guru` (
  `nik_guru` varchar(50) NOT NULL,
  `nama_guru` varchar(60) NOT NULL,
  `lahir_guru` date NOT NULL,
  `alamat_guru` text NOT NULL,
  `tlp_guru` varchar(12) NOT NULL,
  `pwd_guru` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siamad_guru`
--

INSERT INTO `siamad_guru` (`nik_guru`, `nama_guru`, `lahir_guru`, `alamat_guru`, `tlp_guru`, `pwd_guru`) VALUES
('198102222007102000', 'Ira Nurfajar, S.Pd.I', '1998-02-22', 'Desa Kertayasa', '0897631711', 'Guru01'),
('198312292009012007', 'Kukun Quratul\'ain S. Pd. I', '2021-03-09', 'Desa Taraju', '0896452315', 'Guru02'),
('20213288189001', 'Ahmad Fauzi,S.Pd', '1989-07-16', 'Desa Karangmangu', '0897635161', 'Guru08'),
('20213288195001', 'Maesaroh,S,Pd', '1995-08-12', 'Desa Babakanreuma', '08976553731', 'Guru09'),
('5939760662110072', 'Abdurrazak,S.Pd.I', '1985-06-07', 'Desa Muncangela', '081385552651', 'Guru07'),
('6641764666200022', 'Ana Pujana,S.Pd', '1992-01-20', 'Desa Jalaksana', '0821098678', 'Guru05'),
('6744759660300072', 'Sumiati,S.Pd.I', '1990-06-15', 'Desa Taraju', '089123678654', 'Guru03'),
('7435767668300003', 'Oom Rohmawati,S.Pd', '1995-07-24', 'Desa Sindangsari', '0897643567', 'Guru05'),
('9659761664300002', 'Aan Harlinah, S.Pd.I', '1989-06-30', 'Desa Taraju', '087734234124', 'Guru04');

-- --------------------------------------------------------

--
-- Table structure for table `siamad_kelas`
--

CREATE TABLE `siamad_kelas` (
  `kd_kelas` varchar(10) NOT NULL,
  `nama_kelas` varchar(12) NOT NULL,
  `wali_kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siamad_kelas`
--

INSERT INTO `siamad_kelas` (`kd_kelas`, `nama_kelas`, `wali_kelas`) VALUES
('KLS001', 'Satu', '198102222007102000'),
('KLS002', 'Dua', '198312292009012007'),
('KLS003', 'Tiga', '7435767668300003'),
('KLS004', 'Empat', '5939760662110072'),
('KLS005', 'Lima', '9659761664300002');

-- --------------------------------------------------------

--
-- Table structure for table `siamad_kepsek`
--

CREATE TABLE `siamad_kepsek` (
  `nip_kepsek` varchar(15) NOT NULL,
  `nama_kepsek` varchar(60) NOT NULL,
  `alamat_kepsek` text NOT NULL,
  `tlp_kepsek` varchar(12) NOT NULL,
  `status_kepsek` varchar(10) NOT NULL,
  `pawd_kepsek` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siamad_kepsek`
--

INSERT INTO `siamad_kepsek` (`nip_kepsek`, `nama_kepsek`, `alamat_kepsek`, `tlp_kepsek`, `status_kepsek`, `pawd_kepsek`) VALUES
('0009999', 'Aam Siti Aminah,S.Pd.I', 'Dukuh Dalem', '0987654321', 'Aktif', 'kepsek01');

-- --------------------------------------------------------

--
-- Table structure for table `siamad_kurikulum`
--

CREATE TABLE `siamad_kurikulum` (
  `kd_kurikulum` varchar(12) NOT NULL,
  `nama_kurikulum` varchar(15) NOT NULL,
  `status_kurukulum` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siamad_kurikulum`
--

INSERT INTO `siamad_kurikulum` (`kd_kurikulum`, `nama_kurikulum`, `status_kurukulum`) VALUES
('KUR001', 'Kurikulum 2013', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `siamad_mapel`
--

CREATE TABLE `siamad_mapel` (
  `kd_mapel` varchar(15) NOT NULL,
  `nama_mapel` varchar(25) NOT NULL,
  `kurikulum` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siamad_mapel`
--

INSERT INTO `siamad_mapel` (`kd_mapel`, `nama_mapel`, `kurikulum`) VALUES
('MP001', 'Al-Quran dan Hadist', 'KUR001'),
('MP002', 'Akidah Ahlak', 'KUR001'),
('MP003', 'Fikih', 'KUR001'),
('MP004', 'Sejarah Kebudayaan Islam', 'KUR001'),
('MP006', 'Bahasa Arab', 'KUR001'),
('MP007', 'Bahasa Indonesia', 'KUR001'),
('MP008', 'Ilmu Pengetahuan Alam', 'KUR001'),
('MP009', 'Ilmu Pengetahuan Sosial', 'KUR001'),
('MP010', 'Mulok : Bahasa Sunda', 'KUR001'),
('MP011', 'PJOK', 'KUR001'),
('MP012', 'Seni Busaya dan Prakarya', 'KUR001'),
('MP013', 'Matematika', 'KUR001');

-- --------------------------------------------------------

--
-- Table structure for table `siamad_nilai`
--

CREATE TABLE `siamad_nilai` (
  `kd_nilai` int(11) NOT NULL,
  `nis_siswa` varchar(12) NOT NULL,
  `kd_mapel` varchar(15) NOT NULL,
  `nilai_semester` varchar(10) NOT NULL,
  `ph_satu` float NOT NULL,
  `ph_dua` float NOT NULL,
  `ph_tiga` float NOT NULL,
  `ph_empat` float NOT NULL,
  `ph_lima` float NOT NULL,
  `ph_enam` float NOT NULL,
  `ph_tujuh` float NOT NULL,
  `ph_delapan` float NOT NULL,
  `rph` float NOT NULL,
  `pts_nilai` float NOT NULL,
  `pas_nilai` float NOT NULL,
  `akhir_nilai` float NOT NULL,
  `pred_nilai` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siamad_nilai`
--

INSERT INTO `siamad_nilai` (`kd_nilai`, `nis_siswa`, `kd_mapel`, `nilai_semester`, `ph_satu`, `ph_dua`, `ph_tiga`, `ph_empat`, `ph_lima`, `ph_enam`, `ph_tujuh`, `ph_delapan`, `rph`, `pts_nilai`, `pas_nilai`, `akhir_nilai`, `pred_nilai`) VALUES
(2, '12345', 'MP001', '1', 100, 100, 90, 0, 0, 0, 0, 0, 36.25, 0, 0, 14.5, 'E'),
(3, '19010', 'MP001', '1', 100, 90, 90, 0, 0, 0, 0, 0, 35, 0, 0, 14, 'E');

-- --------------------------------------------------------

--
-- Table structure for table `siamad_ortu`
--

CREATE TABLE `siamad_ortu` (
  `kd_ortu` varchar(12) NOT NULL,
  `nama_ortu` varchar(60) NOT NULL,
  `alamat_ortu` text NOT NULL,
  `telp_ortu` varchar(12) NOT NULL,
  `pekerjaan_ortu` varchar(20) NOT NULL,
  `siswa_ortu` varchar(12) NOT NULL,
  `password_ortu` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siamad_ortu`
--

INSERT INTO `siamad_ortu` (`kd_ortu`, `nama_ortu`, `alamat_ortu`, `telp_ortu`, `pekerjaan_ortu`, `siswa_ortu`, `password_ortu`) VALUES
('ORTU001', 'Reni', 'Desa Kertayasa', '08965431421', 'Ibu Rumah Tangga', '12345', 'ortu001'),
('ORTU002', 'Kuswa', 'Desa Kertayasa', '+62896543466', 'Pedagang', '19010', 'ortu002');

-- --------------------------------------------------------

--
-- Table structure for table `siamad_siswa`
--

CREATE TABLE `siamad_siswa` (
  `nis_siswa` varchar(12) NOT NULL,
  `nama_siswa` varchar(60) NOT NULL,
  `alamat_siswa` text NOT NULL,
  `lahir_siswa` date NOT NULL,
  `kelamin_siswa` varchar(15) NOT NULL,
  `kelas_siswa` varchar(10) NOT NULL,
  `pwd_siswa` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siamad_siswa`
--

INSERT INTO `siamad_siswa` (`nis_siswa`, `nama_siswa`, `alamat_siswa`, `lahir_siswa`, `kelamin_siswa`, `kelas_siswa`, `pwd_siswa`) VALUES
('12345', 'Aminah', 'Desa Kertayasa', '2022-06-10', 'Wanitia', 'KLS001', 'siswa01'),
('19010', 'Farhan Anwar', 'Desa Kertyasaa', '2022-06-14', 'Pria', 'KLS001', '11111');

--
-- Triggers `siamad_siswa`
--
DELIMITER $$
CREATE TRIGGER `insert_absen` AFTER INSERT ON `siamad_siswa` FOR EACH ROW BEGIN
	insert into siamad_absen
	SET nis_siswa = NEW.nis_siswa,
	pertemuan = '1',
	keterangan = 'Alpa',
	semester = '1';
    END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `siamad_absen`
--
ALTER TABLE `siamad_absen`
  ADD PRIMARY KEY (`id_absen`),
  ADD KEY `siamad_absen_ibfk_1` (`nis_siswa`);

--
-- Indexes for table `siamad_admin`
--
ALTER TABLE `siamad_admin`
  ADD PRIMARY KEY (`kd_admin`),
  ADD UNIQUE KEY `username_admin` (`username_admin`);

--
-- Indexes for table `siamad_guru`
--
ALTER TABLE `siamad_guru`
  ADD PRIMARY KEY (`nik_guru`);

--
-- Indexes for table `siamad_kelas`
--
ALTER TABLE `siamad_kelas`
  ADD PRIMARY KEY (`kd_kelas`),
  ADD KEY `wali_kelas` (`wali_kelas`);

--
-- Indexes for table `siamad_kepsek`
--
ALTER TABLE `siamad_kepsek`
  ADD PRIMARY KEY (`nip_kepsek`);

--
-- Indexes for table `siamad_kurikulum`
--
ALTER TABLE `siamad_kurikulum`
  ADD PRIMARY KEY (`kd_kurikulum`);

--
-- Indexes for table `siamad_mapel`
--
ALTER TABLE `siamad_mapel`
  ADD PRIMARY KEY (`kd_mapel`),
  ADD KEY `kurikulum` (`kurikulum`);

--
-- Indexes for table `siamad_nilai`
--
ALTER TABLE `siamad_nilai`
  ADD PRIMARY KEY (`kd_nilai`),
  ADD KEY `nis_siswa` (`nis_siswa`),
  ADD KEY `kd_mapel` (`kd_mapel`);

--
-- Indexes for table `siamad_ortu`
--
ALTER TABLE `siamad_ortu`
  ADD PRIMARY KEY (`kd_ortu`),
  ADD KEY `siswa_ortu` (`siswa_ortu`);

--
-- Indexes for table `siamad_siswa`
--
ALTER TABLE `siamad_siswa`
  ADD PRIMARY KEY (`nis_siswa`),
  ADD KEY `siamad_siswa_ibfk_1` (`kelas_siswa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `siamad_absen`
--
ALTER TABLE `siamad_absen`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `siamad_nilai`
--
ALTER TABLE `siamad_nilai`
  MODIFY `kd_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `siamad_absen`
--
ALTER TABLE `siamad_absen`
  ADD CONSTRAINT `siamad_absen_ibfk_1` FOREIGN KEY (`nis_siswa`) REFERENCES `siamad_siswa` (`nis_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `siamad_kelas`
--
ALTER TABLE `siamad_kelas`
  ADD CONSTRAINT `siamad_kelas_ibfk_1` FOREIGN KEY (`wali_kelas`) REFERENCES `siamad_guru` (`nik_guru`);

--
-- Constraints for table `siamad_mapel`
--
ALTER TABLE `siamad_mapel`
  ADD CONSTRAINT `siamad_mapel_ibfk_1` FOREIGN KEY (`kurikulum`) REFERENCES `siamad_kurikulum` (`kd_kurikulum`);

--
-- Constraints for table `siamad_nilai`
--
ALTER TABLE `siamad_nilai`
  ADD CONSTRAINT `siamad_nilai_ibfk_1` FOREIGN KEY (`nis_siswa`) REFERENCES `siamad_siswa` (`nis_siswa`),
  ADD CONSTRAINT `siamad_nilai_ibfk_2` FOREIGN KEY (`kd_mapel`) REFERENCES `siamad_mapel` (`kd_mapel`);

--
-- Constraints for table `siamad_ortu`
--
ALTER TABLE `siamad_ortu`
  ADD CONSTRAINT `siamad_ortu_ibfk_1` FOREIGN KEY (`siswa_ortu`) REFERENCES `siamad_siswa` (`nis_siswa`);

--
-- Constraints for table `siamad_siswa`
--
ALTER TABLE `siamad_siswa`
  ADD CONSTRAINT `siamad_siswa_ibfk_1` FOREIGN KEY (`kelas_siswa`) REFERENCES `siamad_kelas` (`kd_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
