-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 22. Januari 2013 jam 17:55
-- Versi Server: 5.1.30
-- Versi PHP: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `koperasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE IF NOT EXISTS `anggota` (
  `npa` varchar(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `instansi` varchar(50) NOT NULL,
  `kota` varchar(10) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `jk` varchar(20) NOT NULL,
  `ttl` varchar(50) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `level` int(10) NOT NULL,
  `tipe` set('a','p','m') NOT NULL COMMENT 'a = aktif; p=pasif; m=master',
  PRIMARY KEY (`npa`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`npa`, `nama`, `alamat`, `instansi`, `kota`, `tgl_masuk`, `jk`, `ttl`, `telp`, `password`, `level`, `tipe`) VALUES
('00001', 'admin', '', '', '', '0000-00-00', '', '0', '0', '21232f297a57a5a743894a0e4a801fc3', 0, 'm'),
('00003', 'usp', '', '', '', '0000-00-00', '', '0', '0', '75581170ffc0cc5ae2d7c2823fe21d6a', 2, 'm'),
('00004', 'toko', '', '', '', '0000-00-00', '', '0', '0', 'bbb48314e5e6ee68d2d8bc1364b8599b', 3, 'm'),
('00002', 'ketua', '', '', '', '0000-00-00', '', '0', '0', '00719910bb805741e4b7f28527ecb3ad', 1, 'm'),
('00009', 'Winih Suwinarti', 'Ds.Milangasri, Panekan', 'SDN Tapak 1', 'Magetan', '2013-01-05', 'perempuan', 'Bandung, 15 Januari 1970', '085647366551', 'ff5df3fc5578f0ebf893269c16fe691a', 4, 'p'),
('00008', 'Surati', 'Ds.Wates Rt.09 / RW.08', 'SDN Sidowayah 3', 'Magetan', '2013-01-07', 'perempuan', 'Magetan, 15 Juni 1967', '081335675434', 'd4ee60f0f9279cfa4185653c57744d7f', 4, 'a'),
('00006', 'Giyanti', 'Jl.Kawi No.12 Panekan', 'SDN Panekan 1', 'Magetan', '2013-01-10', 'perempuan', 'Magetan, 16 Maret 1967', '(0351)894356', '7a77584182a904bb75558a6bc911dd6e', 4, 'a'),
('00007', 'Muhammad Anwarudin ', 'Desa Cepoko Rt.05 / RW/08', 'SDN Ngiliran 1', 'Magetan', '2013-01-11', 'laki-laki', 'Pacita, 12 Agustus 1975', '08143678599', '3354cbe0f7e1dbc43916af419085f9c4', 4, 'a'),
('00010', 'Marsini', 'Ds.Widorokandang Rt.02/ Rw.02', 'SDN Banjarejo 1', 'Magetan', '2013-01-01', 'perempuan', 'Madiun, 12 Januari 1966', '085627677453', '0079cb8b7e61e2269f1ccc8d2ba3f953', 4, 'a'),
('00011', 'Muhajir', 'Ds.Manjung Rt.09 / Rw.05, Panekan', 'SDN Bedagung 1', 'magetan', '2013-01-01', 'laki-laki', 'Solo, 23 Juli 1980', '081336478900', '85cf77b36c41e3f038dd4883f71bca2f', 4, 'p'),
('00012', 'Susilo Hartadi', 'Ds.Turi Rt.06/ Rw.03, Panekan', 'SDN Sidokerto 1', 'Magetan', '2013-01-01', 'laki-laki', 'Ngawi, 22 Mei 1965', '08783647580', 'c11e93d2f88e9e393d5008f1e313a974', 4, 'p'),
('00013', 'Muhajir', 'Jl.Pakis no.88, Turi', 'SDN Bedagung 1', 'Magetan', '2013-01-02', 'laki-laki', 'Madiun, 24 Juni 1977', '085627489589', '643cae30898fb2d50ba01ba83485a3b4', 4, 'p'),
('00014', 'Samirah', 'Ds.Milangasri Rt.01 / Rw. 03', 'SDN Milangasri 1', 'Magetan', '2013-01-01', 'perempuan', 'Magetan, 20 Februari 1978', '081335767899', '7dc0c34f98d798e2bab2baa3043d4aff', 4, 'p'),
('00015', 'Ahmad Wahyudi', 'Jl.Kenari No 20', 'SDN Ngiliran 1', 'Magetan', '2013-01-17', 'laki-laki', 'Ponorogo, 12 Januari 1980', '08567878789', '5a30ca3979bc92620c5c706062009ee3', 4, 'p'),
('00016', 'Haris Wahyudi', 'Desa Banjarejo Rt.12 / Rw.23', 'SDN Bedagung 1', 'Magetan', '2013-01-17', 'laki-laki', 'Surabaya, 11 April 1983', '081223495959', 'c51af7220431c796de1944bf56876e9b', 4, 'p');

-- --------------------------------------------------------

--
-- Struktur dari tabel `angsuran_barang`
--

CREATE TABLE IF NOT EXISTS `angsuran_barang` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `npa` varchar(20) NOT NULL,
  `no_pinjam` varchar(20) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `angsuran` int(20) NOT NULL,
  `bayar` set('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data untuk tabel `angsuran_barang`
--

INSERT INTO `angsuran_barang` (`id`, `npa`, `no_pinjam`, `tgl_pinjam`, `angsuran`, `bayar`) VALUES
(34, '00007', 'PB-1', '2013-02-14', 540000, '1'),
(35, '00007', 'PB-1', '2013-03-14', 540000, '0'),
(36, '00007', 'PB-1', '2013-04-14', 540000, '0'),
(37, '00007', 'PB-1', '2013-05-14', 540000, '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `angsuran_uang`
--

CREATE TABLE IF NOT EXISTS `angsuran_uang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `npa` varchar(11) NOT NULL,
  `no_pinjam` varchar(20) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `angsuran` int(11) NOT NULL,
  `bayar` set('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=133 ;

--
-- Dumping data untuk tabel `angsuran_uang`
--

INSERT INTO `angsuran_uang` (`id`, `npa`, `no_pinjam`, `tgl_pinjam`, `angsuran`, `bayar`) VALUES
(124, '00006', 'PU-1', '2013-05-11', 5400000, '1'),
(123, '00006', 'PU-1', '2013-04-11', 5400000, '1'),
(122, '00006', 'PU-1', '2013-03-11', 5400000, '1'),
(121, '00006', 'PU-1', '2013-02-11', 5400000, '0'),
(125, '00009', 'PU-2', '2013-02-14', 13500, '0'),
(126, '00009', 'PU-2', '2013-03-14', 13500, '0'),
(127, '00009', 'PU-2', '2013-04-14', 13500, '0'),
(128, '00009', 'PU-2', '2013-05-14', 13500, '0'),
(129, '00007', 'PU-3', '2013-02-20', 810000, '0'),
(130, '00007', 'PU-3', '2013-03-20', 810000, '0'),
(131, '00007', 'PU-3', '2013-04-20', 810000, '0'),
(132, '00007', 'PU-3', '2013-05-20', 810000, '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_barang`
--

CREATE TABLE IF NOT EXISTS `master_barang` (
  `id_barang` varchar(20) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `harga_beli` int(20) NOT NULL,
  `harga_jual` int(20) NOT NULL,
  `kategori` varchar(30) NOT NULL,
  `kode_suplier` varchar(40) NOT NULL,
  `jumlah` int(20) NOT NULL,
  `satuan` varchar(30) NOT NULL,
  `diskon` int(11) NOT NULL,
  `titip` varchar(20) NOT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_barang`
--

INSERT INTO `master_barang` (`id_barang`, `nama`, `harga_beli`, `harga_jual`, `kategori`, `kode_suplier`, `jumlah`, `satuan`, `diskon`, `titip`) VALUES
('BK-3', 'Hansaplastik', 500, 500, 'Barang Lain', 'SB-3', 124, 'Kg', 0, ''),
('BK-1', 'Pepsodent', 2000, 2300, 'Barang Lain', 'SB-1', 58, 'Pcs', 0, ''),
('BK-2', 'Royco', 1000, 1100, 'Barang Lain', 'SB-2', 49, 'Pcs', 0, ''),
('BK-4', 'Sunsilk', 1000, 1200, 'Brg Konsumsi', 'SB-1', 41, 'Pcs', 0, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE IF NOT EXISTS `pembelian` (
  `id_beli` int(20) NOT NULL AUTO_INCREMENT,
  `id_barang` varchar(20) NOT NULL,
  `npb` varchar(20) NOT NULL,
  `kode_suplier` varchar(20) NOT NULL,
  `tgl` date NOT NULL,
  `ket` text NOT NULL,
  `quatity` int(10) NOT NULL,
  `jumlah` int(20) NOT NULL,
  PRIMARY KEY (`id_beli`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id_beli`, `id_barang`, `npb`, `kode_suplier`, `tgl`, `ket`, `quatity`, `jumlah`) VALUES
(58, 'BK-3', 'B-1', 'Sari', '2013-01-20', 'cash', 2, 1000),
(59, 'BK-1', 'B-1', 'Sari', '2013-01-20', 'cash', 3, 6900),
(60, 'BK-2', 'B-2', 'Bangsa', '2013-01-20', 'cash', 23, 25300);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengurus`
--

CREATE TABLE IF NOT EXISTS `pengurus` (
  `npa` varchar(11) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  PRIMARY KEY (`npa`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengurus`
--

INSERT INTO `pengurus` (`npa`, `jabatan`) VALUES
('00007', 'ketua'),
('00006', 'bendahara'),
('00008', 'toko');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE IF NOT EXISTS `penjualan` (
  `id_jual` int(20) NOT NULL AUTO_INCREMENT,
  `id_barang` varchar(20) NOT NULL,
  `njb` varchar(20) NOT NULL,
  `npa` varchar(11) NOT NULL,
  `tgl_jual` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `quatity` int(20) NOT NULL,
  `jumlah` int(20) NOT NULL,
  PRIMARY KEY (`id_jual`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=80 ;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id_jual`, `id_barang`, `njb`, `npa`, `tgl_jual`, `status`, `quatity`, `jumlah`) VALUES
(76, 'BK-3', 'J-2', '00008', '2013-01-20', 'cash', 3, 1500),
(74, 'BK-2', 'J-1', '00007', '2013-01-18', 'cash', 2, 2000),
(73, 'BK-1', 'J-1', '00007', '2013-01-18', 'cash', 4, 9200),
(72, 'BK-3', 'J-1', '00007', '2013-01-18', 'cash', 4, 2000),
(77, 'BK-3', 'J-2', '00008', '2013-01-20', 'cash', 2, 1000),
(78, 'BK-2', 'J-3', '00009', '2013-01-21', 'cash', 2, 2200),
(79, 'BK-4', 'J-3', '00009', '2013-01-21', 'cash', 3, 3600);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjaman_barang`
--

CREATE TABLE IF NOT EXISTS `pinjaman_barang` (
  `no_pinjam` varchar(20) NOT NULL,
  `npa` varchar(11) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `jenis_bayar` varchar(20) NOT NULL,
  `jenis_pinjaman` varchar(20) NOT NULL,
  `pinjaman_pokok` int(20) NOT NULL,
  `jasa` float NOT NULL,
  `xangsuran` int(20) NOT NULL,
  `angsuran` int(20) NOT NULL,
  `tot_jasa` int(20) NOT NULL,
  `tot_angsuran` int(20) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `periode` int(20) NOT NULL,
  PRIMARY KEY (`no_pinjam`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pinjaman_barang`
--

INSERT INTO `pinjaman_barang` (`no_pinjam`, `npa`, `tgl_pinjam`, `jenis_bayar`, `jenis_pinjaman`, `pinjaman_pokok`, `jasa`, `xangsuran`, `angsuran`, `tot_jasa`, `tot_angsuran`, `tgl_mulai`, `tgl_selesai`, `periode`) VALUES
('PB-1', '00007', '2013-01-14', 'potong_gaji', 'upb', 2000000, 2, 4, 540000, 160000, 2160000, '2013-01-14', '2013-05-14', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjaman_uang`
--

CREATE TABLE IF NOT EXISTS `pinjaman_uang` (
  `no_pinjam` varchar(20) NOT NULL,
  `npa` varchar(11) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `jenis_bayar` varchar(20) NOT NULL,
  `jenis_pinjaman` varchar(20) NOT NULL,
  `pinjaman_pokok` int(20) NOT NULL,
  `jasa` float NOT NULL,
  `xangsuran` int(11) NOT NULL,
  `angsuran` int(20) NOT NULL,
  `tot_jasa` int(20) NOT NULL,
  `tot_angsuran` int(20) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `periode` int(20) NOT NULL,
  PRIMARY KEY (`no_pinjam`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pinjaman_uang`
--

INSERT INTO `pinjaman_uang` (`no_pinjam`, `npa`, `tgl_pinjam`, `jenis_bayar`, `jenis_pinjaman`, `pinjaman_pokok`, `jasa`, `xangsuran`, `angsuran`, `tot_jasa`, `tot_angsuran`, `tgl_mulai`, `tgl_selesai`, `periode`) VALUES
('PU-2', '00009', '2013-01-07', 'potong_gaji', 'usp', 50000, 2, 4, 13500, 4000, 54000, '2013-01-14', '2013-05-14', 0),
('PU-1', '00006', '2013-01-11', 'potong_gaji', 'upk', 20000000, 2, 4, 5400000, 1600000, 21600000, '2013-01-11', '2013-05-11', 2013),
('PU-3', '00007', '2013-01-20', 'potong_gaji', 'usp', 3000000, 2, 4, 810000, 240000, 3240000, '2013-01-20', '2013-05-20', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `return_pembelian`
--

CREATE TABLE IF NOT EXISTS `return_pembelian` (
  `id_return` int(20) NOT NULL AUTO_INCREMENT,
  `id_beli` int(20) NOT NULL,
  `id_barang` varchar(20) NOT NULL,
  `npb` varchar(20) NOT NULL,
  `kode_suplier` varchar(50) NOT NULL,
  `tgl` date NOT NULL,
  `quatity` int(10) NOT NULL,
  `jumlah` int(20) NOT NULL,
  PRIMARY KEY (`id_return`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data untuk tabel `return_pembelian`
--

INSERT INTO `return_pembelian` (`id_return`, `id_beli`, `id_barang`, `npb`, `kode_suplier`, `tgl`, `quatity`, `jumlah`) VALUES
(32, 0, 'BK-1', 'b-1', 'SB-1', '0000-00-00', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `return_penjualan`
--

CREATE TABLE IF NOT EXISTS `return_penjualan` (
  `id_return` int(20) NOT NULL AUTO_INCREMENT,
  `id_jual` int(20) NOT NULL,
  `id_barang` varchar(20) NOT NULL,
  `njb` varchar(20) NOT NULL,
  `npa` varchar(20) NOT NULL,
  `tgl` date NOT NULL,
  `quatity` int(20) NOT NULL,
  `jumlah` int(20) NOT NULL,
  PRIMARY KEY (`id_return`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data untuk tabel `return_penjualan`
--

INSERT INTO `return_penjualan` (`id_return`, `id_jual`, `id_barang`, `njb`, `npa`, `tgl`, `quatity`, `jumlah`) VALUES
(39, 0, 'BK-4', 'J-1', '00007', '2013-01-18', 2, 2000),
(40, 0, 'BK-4', 'J-1', '00007', '2013-01-18', 2, 2000),
(27, 0, 'BK-2', 'J-1', '00007', '0000-00-00', 2, 2000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `simpanan`
--

CREATE TABLE IF NOT EXISTS `simpanan` (
  `no_simpanan` varchar(20) NOT NULL,
  `npa` varchar(11) NOT NULL,
  `tgl` date NOT NULL,
  `simp_wajib` int(20) NOT NULL,
  `simp_pokok` int(20) NOT NULL,
  `simp_sukarela` int(20) NOT NULL,
  `jumlah` int(20) NOT NULL,
  `ket` text NOT NULL,
  `tipe` set('s','a') NOT NULL COMMENT 's = simpan; a=ambil',
  PRIMARY KEY (`no_simpanan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `simpanan`
--

INSERT INTO `simpanan` (`no_simpanan`, `npa`, `tgl`, `simp_wajib`, `simp_pokok`, `simp_sukarela`, `jumlah`, `ket`, `tipe`) VALUES
('SU-1', '00006', '2013-01-04', 200000, 200000, 200000, 600000, 'Simpanan Januari 2013', 's'),
('SU-2', '00009', '2013-01-14', 20000, 30000, 20000, 70000, 'simpanan Februari', 's'),
('', '00006', '0000-00-00', 0, 0, 0, 0, '', 'a'),
('SU-3 ', '00006', '0000-00-00', 10000, 0, 0, 0, 'n', 'a'),
('SU-4', '00006', '0000-00-00', 0, 0, 0, 0, 'Keluar dari Keanggotaan', 'a'),
('SU-5', '00006', '0000-00-00', 190000, 200000, 200000, 0, 'Keluar dari Keanggotaan', 'a'),
('SU-6', '00009', '2013-01-16', 10000, 10000, 10000, 30000, '', 's'),
('SU-7', '00009', '0000-00-00', 30000, 40000, 30000, 0, 'Keluar dari Keanggotaan', 'a'),
('SU-8', '00008', '2013-01-17', 20000, 10000, 20000, 50000, 'Simpanan', 's'),
('SU-9', '00014', '2013-01-17', 100000, 300000, 120000, 520000, 'Simpanan Rutin', 's');

-- --------------------------------------------------------

--
-- Struktur dari tabel `suplier`
--

CREATE TABLE IF NOT EXISTS `suplier` (
  `kode_suplier` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `kota` varchar(20) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  PRIMARY KEY (`kode_suplier`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `suplier`
--

INSERT INTO `suplier` (`kode_suplier`, `nama`, `alamat`, `kota`, `telepon`) VALUES
('SB-2', 'PT.Mekar Sari', 'Jalan.Salak No.23', 'Madiun', '08567467567'),
('SB-1', 'PT.Jaya Karya Sentosa', 'Madiun', 'Madiun', '081898989'),
('SB-3', 'PT.Karya Bangsa', 'jalan.Kebangsaan', 'Ponorogo', '0812949758');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(30) NOT NULL,
  `admin` int(10) NOT NULL,
  `ketua` int(10) NOT NULL,
  `usp` int(10) NOT NULL,
  `toko` int(10) NOT NULL,
  `anggota` int(10) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`username`, `admin`, `ketua`, `usp`, `toko`, `anggota`) VALUES
('00010', 0, 0, 0, 0, 1),
('00009', 0, 0, 0, 0, 1),
('ketua', 0, 1, 0, 0, 0),
('admin', 1, 0, 0, 0, 0),
('toko', 0, 0, 0, 1, 0),
('usp', 0, 0, 1, 0, 0),
('00008', 0, 0, 0, 0, 1),
('00007', 0, 0, 0, 0, 1),
('00006', 0, 0, 0, 0, 1),
('00357', 0, 0, 0, 0, 1),
('00011', 0, 0, 0, 0, 1),
('00012', 0, 0, 0, 0, 1),
('00013', 0, 0, 0, 0, 1),
('00014', 0, 0, 0, 0, 1),
('00015', 0, 0, 0, 0, 1),
('00016', 0, 0, 0, 0, 1),
('00017', 0, 0, 0, 0, 1),
('00018', 0, 0, 0, 0, 1),
('00019', 0, 0, 0, 0, 1),
('00020', 0, 0, 0, 0, 1);
