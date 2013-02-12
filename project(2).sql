-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 30, 2011 at 06:44 
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_adm` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `nip_adm` varchar(25) NOT NULL,
  `nama_adm` varchar(50) NOT NULL,
  `level` varchar(11) NOT NULL DEFAULT 'admin',
  PRIMARY KEY (`id_adm`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_adm`, `username`, `password`, `nip_adm`, `nama_adm`, `level`) VALUES
(1, 'admin', 'admin', '12345', 'Administrator', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE IF NOT EXISTS `dosen` (
  `id_dsn` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(25) NOT NULL,
  `nip_dsn` varchar(25) NOT NULL,
  `nama_dsn` varchar(50) NOT NULL,
  `level` varchar(11) NOT NULL DEFAULT 'dosen',
  PRIMARY KEY (`id_dsn`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id_dsn`, `password`, `nip_dsn`, `nama_dsn`, `level`) VALUES
(1, '12345', '0234354', 'Nafiatun', 'dosen'),
(2, 'yola', '0987680', 'Yola Villa', 'dosen'),
(8, 'agus', '0786578', 'Agus Mulyanto', 'dosen');

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi`
--

CREATE TABLE IF NOT EXISTS `konsultasi` (
  `id_kons` int(11) NOT NULL AUTO_INCREMENT,
  `pengirim` varchar(50) NOT NULL,
  `penerima` varchar(50) NOT NULL,
  `pesan` text NOT NULL,
  `tgl` varchar(27) NOT NULL,
  PRIMARY KEY (`id_kons`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `konsultasi`
--

INSERT INTO `konsultasi` (`id_kons`, `pengirim`, `penerima`, `pesan`, `tgl`) VALUES
(1, '0234354', '09651002', 'halooo', '23 December 2011, 4:13 pm'),
(2, '09651002', '0234354', 'haaiii', '23 December 2011, 4:13 pm'),
(3, '0234354', '09651003', 'hfhffg', '23 December 2011, 6:48 pm'),
(5, '0234354', '09651002', 'aiiii', '23 December 2011, 6:58 pm'),
(6, '09651002', '0234354', 'akuuu', '23 December 2011, 7:04 pm'),
(7, '0234354', '09651003', 'jokjl', '27 December 2011, 10:08 pm'),
(8, '0234354', '09651003', 'mklmlk', '27 December 2011, 10:09 pm'),
(9, '0234354', '09651003', 'kl;l', '27 December 2011, 10:10 pm'),
(10, '09651003', '0234354', '', '27 December 2011, 10:13 pm'),
(11, '09651003', '0234354', '', '27 December 2011, 10:13 pm'),
(12, '09651003', '0234354', '', '27 December 2011, 10:13 pm'),
(13, '0234354', '09651003', 'kkkkkkkk', '29 December 2011, 8:51 pm'),
(14, '09651003', '0234354', 'hooooo', '29 December 2011, 8:51 pm');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `id_mhs` int(11) NOT NULL AUTO_INCREMENT,
  `bayar_mhs` varchar(6) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `nim_mhs` varchar(25) NOT NULL,
  `nama_mhs` varchar(50) NOT NULL,
  `fk_mhs` varchar(10) NOT NULL DEFAULT 'Saintek',
  `jrs_mhs` varchar(25) NOT NULL DEFAULT 'Informatika',
  `angkatan` int(4) NOT NULL,
  `email` varchar(30) NOT NULL,
  `level` varchar(11) NOT NULL DEFAULT 'mahasiswa',
  `status` enum('not_valid','valid') NOT NULL DEFAULT 'not_valid',
  `tgl_daftar` varchar(15) NOT NULL,
  `id_dos` varchar(15) NOT NULL,
  `nama_dosen` varchar(30) NOT NULL,
  PRIMARY KEY (`id_mhs`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mhs`, `bayar_mhs`, `username`, `password`, `nim_mhs`, `nama_mhs`, `fk_mhs`, `jrs_mhs`, `angkatan`, `email`, `level`, `status`, `tgl_daftar`, `id_dos`, `nama_dosen`) VALUES
(1, '1112', '09651002', '09651002', '09651002', 'Anas Azhimi Qalban', 'Saintek', 'Teknik Informatika', 2009, 'anas_sensei@yahoo.com', 'mahasiswa', 'valid', '23 Dec 2011', '0234354', 'Nafiatun'),
(2, '1111', '09651003', '09651003', '09651003', 'Sigit Nugroho', 'Saintek', 'Teknik Informatika', 2009, 'anas_sensei@yahoo.com', 'mahasiswa', 'valid', '23 Dec 2011', '0234354', 'Nafiatun'),
(7, '1113', '08651001', 'novita', '08651001', 'Novita', 'Saintek', 'Informatika', 2008, 'novita@gmail.com', 'mahasiswa', 'valid', '28 Dec 2011', '0987680', 'Yola');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE IF NOT EXISTS `nilai` (
  `id_nilai` int(2) NOT NULL AUTO_INCREMENT,
  `id_dsn` varchar(15) NOT NULL,
  `id_mhs` varchar(8) NOT NULL,
  `nilai_dsn` char(1) NOT NULL,
  `seminar` char(1) NOT NULL,
  `instansi` char(1) NOT NULL,
  PRIMARY KEY (`id_nilai`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_dsn`, `id_mhs`, `nilai_dsn`, `seminar`, `instansi`) VALUES
(1, '0234354', '09651002', 'A', 'A', 'A'),
(7, '0234354', '09651003', 'A', 'A', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `seminar`
--

CREATE TABLE IF NOT EXISTS `seminar` (
  `id_seminar` int(1) NOT NULL AUTO_INCREMENT,
  `id_mhs` varchar(8) NOT NULL,
  `id_dsn` varchar(15) NOT NULL,
  `tgl` varchar(20) NOT NULL,
  `ruang` varchar(10) NOT NULL,
  `judul_kp` varchar(40) NOT NULL,
  PRIMARY KEY (`id_seminar`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `seminar`
--

INSERT INTO `seminar` (`id_seminar`, `id_mhs`, `id_dsn`, `tgl`, `ruang`, `judul_kp`) VALUES
(3, '09651002', '', '', '', 'Belajar Aja'),
(2, '09651003', '', '', '', 'aplikasi');

-- --------------------------------------------------------

--
-- Table structure for table `un_mahasiswa`
--

CREATE TABLE IF NOT EXISTS `un_mahasiswa` (
  `id_mhs` int(11) NOT NULL AUTO_INCREMENT,
  `bayar_mhs` varchar(11) NOT NULL,
  `nim_mhs` varchar(11) NOT NULL,
  `nama_mhs` varchar(20) NOT NULL,
  `fk_mhs` varchar(20) NOT NULL DEFAULT 'Saintek',
  `jrs_mhs` varchar(25) NOT NULL,
  PRIMARY KEY (`id_mhs`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `un_mahasiswa`
--

INSERT INTO `un_mahasiswa` (`id_mhs`, `bayar_mhs`, `nim_mhs`, `nama_mhs`, `fk_mhs`, `jrs_mhs`) VALUES
(1, '1111', '09651003', 'Sigit Nugroho', 'Saintek', 'Teknik Informatika'),
(2, '1112', '09651002', 'Anas', 'Saintek', 'Teknik Informatika');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
