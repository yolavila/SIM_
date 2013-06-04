-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 03, 2013 at 10:37 PM
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
  `id_adm` int(3) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nip_adm` int(5) NOT NULL,
  `nama_adm` varchar(50) NOT NULL,
  `level` varchar(5) NOT NULL,
  PRIMARY KEY (`id_adm`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_adm`, `username`, `password`, `nip_adm`, `nama_adm`, `level`) VALUES
(1, 'admin', 'admin', 8651005, 'Vila Yustira', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `applicant`
--

CREATE TABLE IF NOT EXISTS `applicant` (
  `no_applicant` int(5) NOT NULL AUTO_INCREMENT,
  `no_identitas` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `kota` varchar(20) NOT NULL,
  `no_tlp` bigint(12) NOT NULL,
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
  `image` varchar(55) NOT NULL,
  `tanggal` date NOT NULL,
  `status` int(1) NOT NULL COMMENT '1 = buffer (belum terjadwal), 2=terjadwal, 3=hadir, 4=tidak hadir, 5=qualified, 6=not qualified, 7=hired,8=terminate',
  PRIMARY KEY (`no_applicant`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `applicant`
--

INSERT INTO `applicant` (`no_applicant`, `no_identitas`, `nama_lengkap`, `alamat`, `kota`, `no_tlp`, `email`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `status_pernikahan`, `agama`, `gol_darah`, `pendidikan`, `penempatan`, `posisi`, `image`, `tanggal`, `status`) VALUES
(1, 0, 'Alviyan Taufiq Maulana', 'PCI Blok c 48 no 12 Cilegon, Banten', 'banten', 6287739502170, 'alviyantaufiq@gmail.com', 'purworejo', '1990-05-26', 'pria', 'belum menikah', 'Islam', '', 'S1', 'DIY', 'field', '1_Untitled.jpg', '2013-05-14', 8),
(2, 0, 'DENI FERDIAN', 'Jl. Raya Timur Klampok RT 02 RW 13 Purwareja Klampok Banjarnegara', 'banjarnegara', 6281578850681, 'denisoeganjiel@gmail.com', 'metro', '1984-02-03', 'pria', 'menikah', 'Islam', '', 'S1', 'DIY', 'field', '', '2013-05-14', 4),
(3, 0, 'Adityo Sutradha', 'Glagahsari UH.4/601C Warung Boto Umbulharjo Yogyakarta 55167', 'yogyakarta', 6285291048670, 'sutradhaadhityo@yahoo.com', 'purbalingga', '1986-07-02', 'pria', 'belum menikah', 'Islam', '', 'S1', 'DIY', 'field', '', '2013-05-14', 8),
(4, 0, 'Rahmatul Arif Ramdhan', 'Jalan Pahlawan II No A 14 Lemah Mekar, Indramayu, Jawa Barat', 'indramayu', 83840149348, 'Ardhan87@gmail.com', 'indramayu', '1987-05-18', 'pria', 'belum menikah', 'Islam', '', 'S1', 'DIY', 'field', '4_Untitled.jpg', '2013-05-14', 7),
(5, 0, 'Rahmat Riyanto', 'Jemur RT 2 / RW 2, Pejagoan, Kebumen, Jawa Tengah', 'kebumen', 85878474722, 'rahmat_riyanto.250386@yahoo.com', 'kebumen', '1986-03-25', 'pria', 'belum menikah', 'Islam', '', 'S1', 'DIY', 'field', '', '2013-05-14', 7),
(6, 0, 'Wahyu Ependi', 'Jl. Bido V No.8 Gumunggung, Gilingan, Solo Jawa Tengah', 'solo', 8170993699, 'dh.wahyu@gmail.com', 'solo', '1979-01-12', 'pria', 'menikah', 'Islam', '', 'S1', 'Solo', 'field', '6_Untitled.jpg', '2013-05-14', 8),
(7, 0, 'Tri Riyanti', 'Jalan Gunung Lawu No.24. Bancar Kembar - Purwokerto', 'purwokerto', 85726412151, 'r3a_fafa@yahoo.com ', 'cilacap', '1990-04-26', 'wanita', 'belum menikah', 'Islam', '', 'S1', 'purwokerto', 'Admin', '', '2013-05-14', 1),
(8, 0, 'Nurrita Ratna Juwita Nasution', 'Perumahan Griya Taman Asri blok H 241 Pendowoharjo\r\nSleman Yogyakarta', 'yogyakarta', 8179421914, 'tita.nrjn@yahoo.com', 'yogyakarta', '1985-11-28', 'wanita', 'belum menikah', 'Islam', '', 'S1', 'DIY', 'Admin', '', '2013-05-14', 6),
(9, 0, 'Bagus Ibnu Soewondo', 'Perum UMS no 61 RT 03/V Makamhaji, Sukoharjo Solo', 'solo', 87822367936, 'bluezone_energy@yahoo.com', 'ciamis', '1986-12-22', 'pria', 'belum menikah', '', '', 'S1', 'Solo', 'field', '', '2013-05-14', 4),
(10, 0, 'Insani Trinisa Yuwono', 'Gang Mawar Lingkungan Ngemplak Bawen RT: 03 RW: 01 Bawen Kab. Semarang', 'semarang', 85640246821, 'trinisa_insani3005@yahoo.com', 'semarang', '1987-05-30', 'wanita', 'belum menikah', 'Islam', '', 'S1', 'DIY', 'Admin', '', '2013-05-14', 1),
(11, 0, 'Janu Wibowo', 'Randubelang Rt. 01 Rw.08 Bangun Harjo Sewon\r\nBantul, Yogyakarta', 'yogyakarta', 85643795876, 'janoewibowo@gmail.com', 'yogyakarta', '1988-01-31', 'pria', 'belum menikah', 'Islam', '', 'D3', 'DIY', 'field', '11_Untitled.jpg', '2013-05-14', 6),
(12, 0, 'Afrilia Chrisnawati', 'Nyemengan Rt 05 Tirtonirmolo, Kasihan, Bantul,\r\nYogyakarta 55181', 'yogyakarta', 85729430581, 'liya.april99@gmail.com', 'yogyakarta', '1985-04-23', 'wanita', 'belum menikah', 'Islam', '', 'S1', 'DIY', 'Admin', '12_Untitled.jpg', '2013-05-14', 5),
(13, 0, 'Anggun Adani', 'Jalan Menco XXII No 10 Gonilan Kartasura Sukoharjo', 'sukoharjo', 85728323550, '', 'pemalang', '1989-12-10', 'wanita', 'belum menikah', 'Islam', '', 'S1', 'Solo', 'Admin', '', '2013-05-14', 1),
(14, 0, 'Asri Purwaningsih', 'Jl. Sakura no 93, Mantung RT 01 RW V, Sanggrahan, Grogol, Sukoharjo, Solo Baru', 'solo', 83865922342, 'ipunk_achi@yahoo. co.id ', 'sragen', '1986-08-13', 'wanita', 'belum menikah', '', '', 'S1', 'Solo', 'Admin', '', '2013-05-15', 1),
(15, 0, 'Bunga Asteriani Gunawan', 'Dukuh MJ 1/ 1605 A, RT 81/ RW 17, kelurahan Gedongkiwo,  \r\nKecamatan Mantrijeron, Yogyakarta\r\n', 'yogyakarta', 6285691444961, 'bunga.aster@rocketmail.com', 'karawang', '1988-04-10', 'wanita', 'belum menikah', '', '', 'D3', 'DIY', 'Admin', '', '2013-05-15', 1),
(16, 0, 'Eko Sutanti', 'Semarangan No.31 RT 004 RW 009 Sidokarto Godean \r\nSleman Yogyakarta 55564\r\n', 'yogyakarta', 83867893048, '', 'yogyakarta', '1988-06-01', 'wanita', 'belum menikah', 'Islam', '', 'S1', 'DIY', 'Admin', '', '2013-05-15', 1),
(17, 0, 'Delfiandrie', 'Dusun Kanggotan RT.02, Desa Pleret, Kecamatan\r\nPleret, Kabupaten Bantul', 'bantul', 85640177147, 'delfithea@live.com', 'cianjur', '1987-03-03', 'pria', 'belum menikah', 'Islam', '', 'S1', 'DIY', 'field', '', '2013-05-15', 1),
(18, 0, 'Fajar Agus Nugroho', 'Gejagan, Rt.05/Rw.12, Sumberarum, Moyudan\r\nSleman, DIY 55563', 'yogyakarta', 85878654032, 'fajaragusn@yahoo.co.id', 'sleman', '1986-01-01', 'pria', 'belum menikah', 'Islam', '', 'S1', 'DIY', 'field', '', '2013-05-15', 5),
(19, 0, 'Ihsan Darmadi', 'Sanan RT 02 RW 02 Waru,\r\nSlogohimo, Wonogiri, Jawa Tengah', 'wonogiri', 85658074259, 'Ikhsan_11@ymail.com', 'wonogiri', '1982-12-03', 'pria', 'belum menikah', 'Islam', '', 'S1', 'Solo', 'field', '19_Untitled.jpg', '2013-05-15', 5),
(20, 0, 'Hidha Permana Gusti', 'Jl. Wahid Hasyim, Gg.Menur, Condong Catur, Sleman, Yogyakarta', '', 85647686866, 'permana.hidha@yahoo.com', 'cilacap', '1987-08-05', 'pria', 'belum menikah', 'Islam', '', 'S1', 'cilacap', 'field', '', '2013-05-15', 4),
(21, 2147483647, 'Ilham Mahmudi', 'Jl. Putra II No. 21 Sidanegara', 'cilacap', 87, '', 'cilacap', '1989-11-24', 'pria', 'belum menikah', 'Islam', 'O', 'S1', 'cilacap', 'field', '', '2013-05-16', 6),
(22, 0, 'asmil denpal', 'Jl. Sugiyopranoto No.3\r\nKampung Baru RT 4 RW 3\r\nSolo', 'solo', 85, '', 'solo', '1989-07-07', 'wanita', 'belum menikah', 'Islam', '', 'S1', 'Solo', 'Admin', '', '2013-05-16', 8),
(23, 0, 'asmil d', 'Jl. Sugiyopranoto No.3\r\nKampung Baru RT 4 RW 3\r\nSolo, 57111', 'solo', 85, 'ekapuspitasari07@yahoo.com', 'solo', '1989-07-07', 'wanita', 'belum menikah', 'Islam', '', 'S1', 'Solo', 'Admin', '', '2013-05-16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hired`
--

CREATE TABLE IF NOT EXISTS `hired` (
  `no_applicant` int(11) NOT NULL,
  `kantor` varchar(12) NOT NULL,
  `cabang` varchar(10) NOT NULL,
  `posisi` varchar(20) NOT NULL,
  `tgl_hired` date NOT NULL,
  PRIMARY KEY (`no_applicant`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hired`
--

INSERT INTO `hired` (`no_applicant`, `kantor`, `cabang`, `posisi`, `tgl_hired`) VALUES
(1, 'FIF', 'DIY', 'SURVEYOR', '2013-06-03'),
(3, 'FIF', 'DIY', 'CMO', '2013-05-31'),
(6, 'FIF', 'SOLO', 'COL', '2013-06-18'),
(4, 'FIF', 'DIY', 'ADMIN', '2013-05-30'),
(5, 'FIF', 'Bantul', 'Admin', '2013-05-30');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_user`
--

CREATE TABLE IF NOT EXISTS `jadwal_user` (
  `no_applicant` int(5) NOT NULL,
  `kantor` varchar(5) NOT NULL,
  `cabang` varchar(10) NOT NULL,
  `posisi` varchar(10) NOT NULL,
  `tanggal_pengiriman` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal_user`
--

INSERT INTO `jadwal_user` (`no_applicant`, `kantor`, `cabang`, `posisi`, `tanggal_pengiriman`) VALUES
(1, 'FIF', 'DIY', 'SURVEYOR', '2013-05-17'),
(1, 'HSO', 'DIY', 'ADMIN', '2013-05-17'),
(3, 'FIAL', 'DIY', 'CMO', '2013-05-20'),
(6, 'FIF', 'SOLO', 'COL', '2013-05-20'),
(19, 'FIF', 'SOLO', 'COL', '2013-05-20');

-- --------------------------------------------------------

--
-- Table structure for table `penjadwalan`
--

CREATE TABLE IF NOT EXISTS `penjadwalan` (
  `no_applicant` int(11) NOT NULL,
  `jadwal` date NOT NULL,
  `konfirmasi` int(2) NOT NULL COMMENT '1=HADIR, 0=TIDAK HADIR',
  PRIMARY KEY (`no_applicant`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjadwalan`
--

INSERT INTO `penjadwalan` (`no_applicant`, `jadwal`, `konfirmasi`) VALUES
(1, '2013-05-16', 1),
(2, '2013-05-16', 0),
(3, '2013-05-17', 1),
(4, '2013-05-17', 1),
(5, '2013-05-17', 1),
(6, '2013-05-17', 1),
(7, '0000-00-00', 0),
(8, '2013-05-16', 1),
(9, '2013-05-16', 0),
(10, '0000-00-00', 0),
(11, '2013-05-17', 1),
(12, '2013-05-17', 1),
(13, '0000-00-00', 0),
(14, '0000-00-00', 0),
(15, '0000-00-00', 0),
(16, '0000-00-00', 0),
(17, '0000-00-00', 0),
(18, '2013-05-17', 1),
(19, '2013-05-17', 1),
(20, '2013-05-17', 0),
(21, '2013-05-17', 1),
(22, '0000-00-00', 0),
(23, '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE IF NOT EXISTS `result` (
  `no_applicant` int(11) NOT NULL,
  `hasil` varchar(13) NOT NULL COMMENT '1=qualified,0=not qualified',
  `tanggal` date NOT NULL,
  PRIMARY KEY (`no_applicant`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`no_applicant`, `hasil`, `tanggal`) VALUES
(1, '1', '0000-00-00'),
(2, '', '0000-00-00'),
(3, '1', '0000-00-00'),
(4, '1', '0000-00-00'),
(5, '1', '0000-00-00'),
(6, '1', '0000-00-00'),
(7, '', '0000-00-00'),
(8, '0', '0000-00-00'),
(9, '', '0000-00-00'),
(10, '', '0000-00-00'),
(11, '0', '0000-00-00'),
(12, '1', '0000-00-00'),
(13, '', '0000-00-00'),
(14, '', '0000-00-00'),
(15, '', '0000-00-00'),
(16, '', '0000-00-00'),
(17, '', '0000-00-00'),
(18, '1', '0000-00-00'),
(19, '1', '0000-00-00'),
(20, '', '0000-00-00'),
(21, '0', '0000-00-00'),
(22, '', '0000-00-00'),
(23, '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id_status` int(1) NOT NULL AUTO_INCREMENT,
  `status` varchar(15) NOT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id_status`, `status`) VALUES
(1, 'Buffer'),
(2, 'Terjadwal'),
(3, 'Hadir'),
(4, 'Tidak Hadir'),
(5, 'Qualified'),
(6, 'Not Qualified'),
(7, 'Hired'),
(8, 'Terminate');

-- --------------------------------------------------------

--
-- Table structure for table `terminate`
--

CREATE TABLE IF NOT EXISTS `terminate` (
  `no_applicant` int(11) NOT NULL,
  `tgl_terminate` date NOT NULL,
  PRIMARY KEY (`no_applicant`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terminate`
--

INSERT INTO `terminate` (`no_applicant`, `tgl_terminate`) VALUES
(1, '2013-06-24'),
(3, '2013-06-30'),
(22, '2013-05-16'),
(6, '2013-06-01');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
