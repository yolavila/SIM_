-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 12, 2013 at 03:08 PM
-- Server version: 5.1.37
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sim`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_adm` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nip_adm` int(5) NOT NULL,
  `nama_adm` varchar(50) NOT NULL,
  `level` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_adm`, `username`, `password`, `nip_adm`, `nama_adm`, `level`) VALUES
(1, 'admin', 'admin', 12345, 'Vila Yustira', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `applicant`
--

CREATE TABLE IF NOT EXISTS `applicant` (
  `no_applicant` int(11) NOT NULL,
  `no_identitas` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `kota` varchar(20) NOT NULL,
  `no_tlp` int(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` varchar(6) NOT NULL,
  `status_pernikahan` varchar(13) NOT NULL,
  `agama` varchar(8) NOT NULL,
  `gol_darah` varchar(2) NOT NULL,
  `pendidikan` varchar(3) NOT NULL,
  `penempatan` varchar(12) NOT NULL,
  `posisi` varchar(20) NOT NULL,
  `image` varchar(50) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`no_applicant`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applicant`
--

INSERT INTO `applicant` (`no_applicant`, `no_identitas`, `nama_lengkap`, `alamat`, `kota`, `no_tlp`, `email`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `status_pernikahan`, `agama`, `gol_darah`, `pendidikan`, `penempatan`, `posisi`, `image`, `status`) VALUES
(123456, 6787899, 'gvvvbn', 'vbv b b ', 'vgvgvg', 687899, 'hbhbb', 'bbbbbbbbbbbbbbbbbbb', '1971-02-02', 'wanita', 'belum menikah', 'Islam', 'B', 'SMA', 'Solo', 'frontliner', '', 0),
(2, 76777, 'Nana', 'kota', 'yogyakarta', 687899, 'yosiamalia@yahoo.com', 'bbbbbbbbbbbbbbbbbbb', '1970-01-01', 'wanita', 'belum menikah', 'Islam', 'A', 'SMP', 'DIY', 'AO', '', 0),
(4, 76777, 'vila yustira', '', 'yogyakarta', 687899, 'yosiamalia@yahoo.com', 'bbbbbbbbbbbbbbbbbbb', '1970-01-02', 'wanita', 'belum menikah', 'Islam', 'A', 'SMP', 'DIY', 'AO', '', 4),
(3, 6787899, 'ebie', 'balikpapan', 'balikpapan', 687899, 'emoncutle@yahoo.co.id', 'bbbbbbbbbbbbbbbbbbb', '1970-01-01', 'wanita', 'belum menikah', 'Islam', 'A', 'SMP', 'DIY', 'AO', '', 0),
(1, 0, 'ardi', 'gejayan', 'yogyakarta', 2147483647, 'ardiirwanto@yahoo.com', 'klaten', '1988-09-21', 'pria', 'belum menikah', 'Islam', 'AB', 'S1', 'DIY', 'frontliner', '', 1),
(5, 0, 'ayank', 'gejayan', 'yogyakarta', 2147483647, 'ardiirwanto@yahoo.com', 'klaten', '1988-09-21', 'pria', 'belum menikah', 'Islam', 'AB', 'S1', 'DIY', 'frontliner', '', 1),
(6, 98, 'cumi', 'jsadj', 'diy', 89, 'cumicumi.com', 'hdowqh', '1970-01-01', 'wanita', 'menikah', 'Islam', 'B', 'SMA', 'magelang', 'Admin', '', 1),
(7, 1234, 'hoho', 'kota', 'baru', 98, 'yosiamalia@yahoo.com', 'klaten', '1974-01-01', 'wanita', 'menikah', 'Islam', 'A', 'SMA', 'magelang', 'frontliner', '', 1),
(8, 0, 'yola vila', '', 'yogyakarta', 687899, 'yosiamalia@yahoo.com', 'bbbbbbbbbbbbbbbbbbb', '1970-01-01', 'wanita', 'belum menikah', 'Islam', 'A', 'SMP', 'DIY', 'AO', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hired`
--

CREATE TABLE IF NOT EXISTS `hired` (
  `no_applicant` int(11) NOT NULL,
  `nama_applicant` varchar(100) NOT NULL,
  `kantor` varchar(12) NOT NULL,
  `cabang` varchar(10) NOT NULL,
  `posisi` varchar(20) NOT NULL,
  `tgl_hired` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hired`
--


-- --------------------------------------------------------

--
-- Table structure for table `konfirmasi`
--

CREATE TABLE IF NOT EXISTS `konfirmasi` (
  `no_applicant` int(11) NOT NULL,
  `nama_applicant` varchar(100) NOT NULL,
  `konfirmasi` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konfirmasi`
--


-- --------------------------------------------------------

--
-- Table structure for table `penjadwalan`
--

CREATE TABLE IF NOT EXISTS `penjadwalan` (
  `no_applicant` int(11) NOT NULL,
  `jadwal` date NOT NULL,
  `konfirmasi` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjadwalan`
--

INSERT INTO `penjadwalan` (`no_applicant`, `jadwal`, `konfirmasi`) VALUES
(4, '1977-02-02', 'Hadir'),
(3, '1973-04-03', 'hadir'),
(123, '2013-02-01', 'hadir'),
(0, '0000-00-00', ''),
(1, '2013-02-02', 'hadir'),
(5, '1972-01-01', 'hadir'),
(6, '2012-02-10', 'Hadir'),
(7, '2012-02-04', 'Hadir'),
(8, '2012-02-13', 'Hadir');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE IF NOT EXISTS `result` (
  `no_applicant` int(11) NOT NULL,
  `nama_applicant` varchar(100) NOT NULL,
  `result` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `result`
--


-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id_status` int(1) NOT NULL AUTO_INCREMENT,
  `status` varchar(15) NOT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id_status`, `status`) VALUES
(1, 'Buffer'),
(2, 'Candidate'),
(3, 'Hired'),
(4, 'Terminate'),
(5, 'Qualified'),
(6, 'Not Qualified');

-- --------------------------------------------------------

--
-- Table structure for table `terminate`
--

CREATE TABLE IF NOT EXISTS `terminate` (
  `no_applicant` int(11) NOT NULL,
  `nama_applicant` varchar(100) NOT NULL,
  `kantor` varchar(12) NOT NULL,
  `cabang` varchar(10) NOT NULL,
  `posisi` varchar(20) NOT NULL,
  `tgl_terminate` date NOT NULL,
  `alasan` text NOT NULL,
  `surat_resign` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terminate`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
