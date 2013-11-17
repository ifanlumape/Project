-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 17, 2013 at 07:02 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bootcamp`
--
CREATE DATABASE `bootcamp` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bootcamp`;

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE IF NOT EXISTS `agenda` (
  `id_agenda` int(5) NOT NULL AUTO_INCREMENT,
  `tema` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `isi_agenda` text COLLATE latin1_general_ci NOT NULL,
  `tempat` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `pengirim` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `tgl_posting` date NOT NULL,
  `tgl_update` date NOT NULL,
  `waktu` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_agenda`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=53 ;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`id_agenda`, `tema`, `isi_agenda`, `tempat`, `pengirim`, `tgl_mulai`, `tgl_selesai`, `tgl_posting`, `tgl_update`, `waktu`, `username`) VALUES
(44, '1ultrices commodo', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Duis ligula lorem, consequat eget, tristique nec, auctor quis, purus. Vivamus ut sem. Fusce aliquam nunc vitae purus. Aenean viverra malesuada libero. Fusce ac quam. Donec neque. Nunc venenatis enim nec quam. Cras faucibus, justo vel accumsan aliquam, tellus dui fringilla quam, in condimentum augue lorem non tellus. Pellentesque id arcu non sem placerat iaculis. Curabitur posuere, pede vitae lacinia accumsan, enim nibh elementum orci, ut volutpat eros sapien nec sapien. Suspendisse neque arcu, ultrices commodo, pellentesque sit amet, ultricies ut, ipsum. Mauris et eros eget erat dapibus mollis. Mauris laoreet posuere odio. Nam ipsum ligula, ullamcorper eu, fringilla at, lacinia ut, augue. Nullam nunc.', 'Swiss Bell Hotel', 'Andre', '2011-04-14', '2011-04-14', '2011-04-13', '2011-04-13', '10.00 s/d selesai', 'admin'),
(43, '2Suspendisse neque arc', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Duis ligula lorem, consequat eget, tristique nec, auctor quis, purus. Vivamus ut sem. Fusce aliquam nunc vitae purus. Aenean viverra malesuada libero. Fusce ac quam. Donec neque. Nunc venenatis enim nec quam. Cras faucibus, justo vel accumsan aliquam, tellus dui fringilla quam, in condimentum augue lorem non tellus. Pellentesque id arcu non sem placerat iaculis. Curabitur posuere, pede vitae lacinia accumsan, enim nibh elementum orci, ut volutpat eros sapien nec sapien. Suspendisse neque arcu, ultrices commodo, pellentesque sit amet, ultricies ut, ipsum. Mauris et eros eget erat dapibus mollis. Mauris laoreet posuere odio. Nam ipsum ligula, ullamcorper eu, fringilla at, lacinia ut, augue. Nullam nunc.', 'Ritzy Hotel', 'Andre', '2011-04-13', '2011-04-13', '2011-04-13', '2011-04-13', '10.00 s/d selesai', 'admin'),
(45, '3Mauris laoreet posuere odio', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Duis ligula lorem, consequat eget, tristique nec, auctor quis, purus. Vivamus ut sem. Fusce aliquam nunc vitae purus. Aenean viverra malesuada libero. Fusce ac quam. Donec neque. Nunc venenatis enim nec quam. Cras faucibus, justo vel accumsan aliquam, tellus dui fringilla quam, in condimentum augue lorem non tellus. Pellentesque id arcu non sem placerat iaculis. Curabitur posuere, pede vitae lacinia accumsan, enim nibh elementum orci, ut volutpat eros sapien nec sapien. Suspendisse neque arcu, ultrices commodo, pellentesque sit amet, ultricies ut, ipsum. Mauris et eros eget erat dapibus mollis. Mauris laoreet posuere odio. Nam ipsum ligula, ullamcorper eu, fringilla at, lacinia ut, augue. Nullam nunc.', 'Aston Hotel', 'Andre', '2011-04-15', '2011-04-15', '2011-04-13', '2011-04-13', '10.00 s/d selesai', 'admin'),
(46, '4Mauris et eros eget erat dapibus mollis', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Duis ligula lorem, consequat eget, tristique nec, auctor quis, purus. Vivamus ut sem. Fusce aliquam nunc vitae purus. Aenean viverra malesuada libero. Fusce ac quam. Donec neque. Nunc venenatis enim nec quam. Cras faucibus, justo vel accumsan aliquam, tellus dui fringilla quam, in condimentum augue lorem non tellus. Pellentesque id arcu non sem placerat iaculis. Curabitur posuere, pede vitae lacinia accumsan, enim nibh elementum orci, ut volutpat eros sapien nec sapien. Suspendisse neque arcu, ultrices commodo, pellentesque sit amet, ultricies ut, ipsum. Mauris et eros eget erat dapibus mollis. Mauris laoreet posuere odio. Nam ipsum ligula, ullamcorper eu, fringilla at, lacinia ut, augue. Nullam nunc.', 'Hotel Sedona', 'Andre', '2011-04-16', '2011-04-16', '2011-04-13', '2011-04-13', '10.00 s/d selesai', 'admin'),
(47, '5Fusce aliquam nunc vitae purus', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Duis ligula lorem, consequat eget, tristique nec, auctor quis, purus. Vivamus ut sem. Fusce aliquam nunc vitae purus. Aenean viverra malesuada libero. Fusce ac quam. Donec neque. Nunc venenatis enim nec quam. Cras faucibus, justo vel accumsan aliquam, tellus dui fringilla quam, in condimentum augue lorem non tellus. Pellentesque id arcu non sem placerat iaculis. Curabitur posuere, pede vitae lacinia accumsan, enim nibh elementum orci, ut volutpat eros sapien nec sapien. Suspendisse neque arcu, ultrices commodo, pellentesque sit amet, ultricies ut, ipsum. Mauris et eros eget erat dapibus mollis. Mauris laoreet posuere odio. Nam ipsum ligula, ullamcorper eu, fringilla at, lacinia ut, augue. Nullam nunc.', 'Ritzy Hotel', 'Andre', '2011-04-13', '2011-04-13', '2011-04-13', '2011-04-13', '10.00 s/d selesai', 'admin'),
(48, '6auctor quis', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Duis ligula lorem, consequat eget, tristique nec, auctor quis, purus. Vivamus ut sem. Fusce aliquam nunc vitae purus. Aenean viverra malesuada libero. Fusce ac quam. Donec neque. Nunc venenatis enim nec quam. Cras faucibus, justo vel accumsan aliquam, tellus dui fringilla quam, in condimentum augue lorem non tellus. Pellentesque id arcu non sem placerat iaculis. Curabitur posuere, pede vitae lacinia accumsan, enim nibh elementum orci, ut volutpat eros sapien nec sapien. Suspendisse neque arcu, ultrices commodo, pellentesque sit amet, ultricies ut, ipsum. Mauris et eros eget erat dapibus mollis. Mauris laoreet posuere odio. Nam ipsum ligula, ullamcorper eu, fringilla at, lacinia ut, augue. Nullam nunc.', 'Ritzy Hotel', 'Andre', '2011-04-13', '2011-04-13', '2011-04-13', '2011-04-13', '10.00 s/d selesai', 'admin'),
(49, '7fringilla at', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Duis ligula lorem, consequat eget, tristique nec, auctor quis, purus. Vivamus ut sem. Fusce aliquam nunc vitae purus. Aenean viverra malesuada libero. Fusce ac quam. Donec neque. Nunc venenatis enim nec quam. Cras faucibus, justo vel accumsan aliquam, tellus dui fringilla quam, in condimentum augue lorem non tellus. Pellentesque id arcu non sem placerat iaculis. Curabitur posuere, pede vitae lacinia accumsan, enim nibh elementum orci, ut volutpat eros sapien nec sapien. Suspendisse neque arcu, ultrices commodo, pellentesque sit amet, ultricies ut, ipsum. Mauris et eros eget erat dapibus mollis. Mauris laoreet posuere odio. Nam ipsum ligula, ullamcorper eu, fringilla at, lacinia ut, augue. Nullam nunc.', 'Aston Hotel', 'Andre', '2011-04-19', '2011-04-19', '2011-04-13', '2011-04-13', '10.00 s/d selesai', 'admin'),
(50, '8Sed et lectus in massa imperdiet tincidunt', 'Sed et lectus in massa imperdiet tincidunt. Praesent neque tortor, sollicitudin non, euismod a, adipiscing a, est. Mauris diam metus, varius nec, faucibus at, faucibus sollicitudin, lectus. Nam posuere felis ac urna. Vestibulum tempor vestibulum urna. Nullam metus. Vivamus ac purus. Nullam interdum ullamcorper libero. Morbi vehicula imperdiet justo. Etiam mollis fringilla ante. Donec et dui. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Etiam mi libero, luctus nec, blandit ac, rutrum ac, lectus.', 'Swiss Bell Hotel', 'Andre', '2011-04-20', '2011-04-20', '2011-04-13', '2011-04-13', '10.00 s/d selesai', 'admin'),
(51, '9sociosqu ad litora torquent per conubia nostra', 'Morbi consequat felis vitae enim. Nunc nec lacus. Vestibulum odio. Morbi egestas, urna et mollis bibendum, enim tellus posuere justo, eget elementum purus urna nec lacus. Nullam in nulla. Praesent ac lorem. Donec metus risus, accumsan ut, mollis non, porttitor eget, mi. Aliquam aliquet, tortor a elementum aliquam, erat odio sodales eros, suscipit blandit lectus dolor sit amet elit. In eros wisi, mollis vitae, tincidunt in, suscipit id, nibh. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Phasellus ornare. Suspendisse potenti. Mauris convallis. Vestibulum nec mauris in augue porta mollis. Proin ut nunc. Mauris aliquam dui eget purus.', 'Swiss Bell Hotel', 'Andre', '2011-04-21', '2011-04-21', '2011-04-13', '2011-04-13', '10.00 s/d selesai', 'admin'),
(52, '10per inceptos hymenaeos', 'Morbi consequat felis vitae enim. Nunc nec lacus. Vestibulum odio. Morbi egestas, urna et mollis bibendum, enim tellus posuere justo, eget elementum purus urna nec lacus. Nullam in nulla. Praesent ac lorem. Donec metus risus, accumsan ut, mollis non, porttitor eget, mi. Aliquam aliquet, tortor a elementum aliquam, erat odio sodales eros, suscipit blandit lectus dolor sit amet elit. In eros wisi, mollis vitae, tincidunt in, suscipit id, nibh. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Phasellus ornare. Suspendisse potenti. Mauris convallis. Vestibulum nec mauris in augue porta mollis. Proin ut nunc. Mauris aliquam dui eget purus.', 'Hotel Sedona', 'Andre', '2011-04-22', '0000-00-00', '2011-04-13', '2012-11-25', '10.00 s/d selesai', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `id_album` int(5) NOT NULL AUTO_INCREMENT,
  `jdl_album` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `album_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gbr_album` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_album`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=25 ;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id_album`, `jdl_album`, `album_seo`, `gbr_album`, `aktif`) VALUES
(21, 'Kawasaki 250 F1', 'kawasaki-250-f1', '91f811558f3db364e0a14cf3487c24ec.jpg', 'Y'),
(20, 'Decal Stiker', 'decal-stiker', '569c8900e80f17c1f3ee0425fecca195.jpeg', 'Y'),
(18, 'Kawasaki', 'kawasaki', 'd3623b2b7799196ebc3a9e9374e93715.jpg', 'Y'),
(12, 'Aksesoris', 'aksesoris', 'ce6ba33c78ac7f401d2a952fcb6392d7.jpg', 'Y'),
(19, 'Rumah Modifikasi', 'rumah-modifikasi', '832bf84514fa40fd8179c64154536c32.jpg', 'Y'),
(17, 'Modifikasi', 'modifikasi', '118ec7578779e024fc58079de374c0fa.jpg', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE IF NOT EXISTS `banner` (
  `id_banner` int(5) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `url` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_posting` date NOT NULL,
  `tgl_update` date NOT NULL,
  PRIMARY KEY (`id_banner`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id_banner`, `judul`, `url`, `gambar`, `tgl_posting`, `tgl_update`) VALUES
(21, 'Univesitas Nusantara', 'http://www.nusantara.ac.id', '1d8e79270c7b5eea29abbd3764bcb015.jpg', '0000-00-00', '2013-07-20');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE IF NOT EXISTS `berita` (
  `id_berita` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `kutipan` varchar(250) COLLATE latin1_general_ci NOT NULL,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `isi_berita` text COLLATE latin1_general_ci NOT NULL,
  `jam` time NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_posting` date NOT NULL,
  `tgl_update` date NOT NULL,
  `dibaca` int(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_berita`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=132 ;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id_berita`, `username`, `kutipan`, `judul`, `isi_berita`, `jam`, `gambar`, `tgl_posting`, `tgl_update`, `dibaca`) VALUES
(124, 'admin', 'Undangan Rapat Pembentukan Pengurus APTIKOM Wilayah III', 'Undangan Rapat Pembentukan Pengurus APTIKOM Wilayah III', 'Undangan Rapat Pembentukan Pengurus APTIKOM Wilayah III', '02:22:09', 'd5ba2c12e5fdf51d2bf5ea8326ecb063.jpg', '2011-04-12', '2013-07-20', 104),
(125, 'admin', 'Info lebih lengkap, buka: http://www.aptikom2012.potensiutama.ac.id/', 'Rapat Koordinasi Nasional APTIKOM 2012', 'Info lebih lengkap, buka: http://www.aptikom2012.potensiutama.ac.id/', '02:20:55', '2c8c88323e77a093eb8e8cb61b65d38c.png', '2011-04-12', '2013-07-20', 102),
(126, 'admin', 'Seminar Nasional Multidisiplin Ilmu Universitas Budi Luhur 2012 yang akan diselenggarakan pada 8 Desember 2012 dengan tema Inovasi Ramah Lingkungan dalam Memperkuat Karakter Bangsa yang Mandiri, Cerdas Berbudi Luhur.', 'Seminar Nasional Multidisiplin Ilmu Universitas Budi Luhur 2012', 'Seminar Nasional Multidisiplin Ilmu Universitas Budi Luhur 2012 yang akan diselenggarakan pada 8 Desember 2012 dengan tema Inovasi Ramah Lingkungan dalam Memperkuat Karakter Bangsa yang Mandiri, Cerdas Berbudi Luhur.', '02:19:40', '41e9ab51503a43c0867c72fe74c1ca27.jpg', '2011-04-12', '2013-07-20', 103),
(127, 'admin', 'Puji dan syukur kehadirat Tuhan Yang Maha Esa, karena atas rahmat-Nya jurnal ilmiah “TICOM” ini dapat diterbitkan. Penerbitan jurnal ilmiah ini diharapkan dapat menjadi wadah bagi akademisi dan praktisi untuk menuangkan ide-ide dan pembahasan seputar', 'Jurnal TICOM Volume 1 Nomor 2 (Bulan Januari 2013)', 'Puji dan syukur kehadirat Tuhan Yang Maha Esa, karena atas rahmat-Nya jurnal ilmiah “TICOM” ini dapat diterbitkan. Penerbitan jurnal ilmiah ini diharapkan dapat menjadi wadah bagi akademisi dan praktisi untuk menuangkan ide-ide dan pembahasan seputar isu-isu di bidang Teknologi Informasi dan Komunikasi (TIK).\r\n\n\r\n\nPenerbitan jurnal TICOM edisi ini adalah merupakan penerbitan perdana, Vol. 1 No. 2 Januari 2013, yang memuat 7 paper dari berbagai perguruan tinggi yang merupakan hasil penelitian dan kajian ilmiah. Topik jurnal edisi perdana ini memuat:\r\n\n\r\n\nPerbandingan Segmentasi Luas Nucleus Sel Normal dan Abnormal Pap Smear Menggunakan Operasi Kanal Warna dengan Deteksi Tepi Canny dan Rekonstruksi Morfologi\r\n\n\r\n\nModel Deteksi Tepi untuk Penentuan Batas Wilayah dengan Metode Sobel dan Cartesian\r\n\n\r\n\nPenerapan Data Warehouse pada PT XYZ dengan Menggunakan Metode Kriptografi\r\n\n\r\n\nImplementasi Protokol S/MIME pada Layanan E-Mail Sebagai Upaya Peningkatan Keamanan dalam Transaksi Informasi Secara Online: Studi Kasus PT. XYZ\r\n\n\r\n\n    Kerangka Keamanan Transaksi Elektronik Perbankan Berbasis Analisa Pola Belanja Nasaba\r\n\n\r\n\n    Kendali Jarak Jauh Melalui Wireless Application Protocol (WAP) untuk Mengendalikan Alat Penerangan dalam Ruangan\r\n\n\r\n\n    Identifikasi Pola Knowledge Sharing pada Situs Facebook dengan Menggunakan Teknik Analisis Jaringan Sosial\r\n\n\r\n\nSebagai penutup, kami selaku tim redaksi ingin mengucapkan terima kasih kepada berbagai pihak yang banyak membantu sehingga terbitnya jurnal TICOM Vol.1 No.2 ini. Tak lupa pula kami mengucapkan terima kasih kepada para penulis yang telah bersedia menyumbangkan karya tulisnya dari mulai tahapan reviewer, editing sehingga “camera ready paper” sesuai dengan aturan yang telah ditetapkan jurnal TICOM.\r\n\nLihat Jurnal lengkap di http://jurnal.aptikom3.or.id', '02:16:59', 'f03b8794c4840dcb510d102185e049c0.png', '2011-04-12', '2013-07-20', 113),
(128, 'admin', 'Dalam rangka membantu pemerintah untuk meningkatkan pendidikan berkualitas di Indonesia melalui peningkatan jumlah Doktor dan menghadapi tantangan di bidang informatika dan ilmu komputer. Untuk itu Asosiasi Perguruan Tinggi Informatika dan Komputer W', 'Aptikom-3 Doctoral Bootcamp 2013 (ADB-2013)', 'Dalam rangka membantu pemerintah untuk meningkatkan pendidikan berkualitas di Indonesia melalui peningkatan jumlah Doktor dan menghadapi tantangan di bidang informatika dan ilmu komputer. Untuk itu Asosiasi Perguruan Tinggi Informatika dan Komputer Wilayah 3 (APTIKOM-3) mengajak Bapak/Ibu Pimpinan Perguruan Tinggi untuk mengirimkan dosennya untuk mengikuti program dari APTIKOM 3, yaitu “Aptikom-3 Doctoral Bootcamp 2013 (ADB-2013)”, yang pelaksanaannya pada: Tanggal : 5 – 7 Juli 2013, Tempat : Wisma Makara Universitas Indonesia, Alamat : Komplek Universitas Indonesia – Depok Jl. Lingkar Kampus Utara, Jakarta 12640\r\n\n\r\n\nBerikut ini informasi selengkapnya:\r\n\n\r\n\n1. Surat Undangan Aptikom 3 Doctoral Bootcamp\r\n\n2. Lampiran 1 (Penjelasan Kegiatan)\r\n\n3. Lampiran 2 – Jadwal kegiatan\r\n\n4. Lampiran 3 – Kepanitiaan\r\n\n5. FORM PENDAFTARAN ADB-2013', '02:14:36', '93f308ddbcc1e5f95b124f0740c134aa.jpg', '2011-04-12', '2013-07-20', 104),
(129, 'admin', 'Magister Ilmu Komputer Universitas Budi Luhur bekerjasa sama dengan Health IT Security Forum menyelenggarakan “International Workshop on IT Security in Healthcare” dengan tema “Aspek Keamanan Informasi dalam bidang Pelayanan Kesehatan GNU Health Secu', 'International Workshop on IT Security in Healthcare', 'Magister Ilmu Komputer Universitas Budi Luhur bekerjasa sama dengan Health IT Security Forum menyelenggarakan “International Workshop on IT Security in Healthcare” dengan tema “Aspek Keamanan Informasi dalam bidang Pelayanan Kesehatan GNU Health Security”. Pembicara adalah praktisi di bidangnya antara lain Assoc Prof. Dr. Zuraini Ismail (UTM), Dr. Nurhizam Safie (UNI-IIGH), Seyed Mohamad Motahar (UKM), Yahaya Abdul Rahim (UTEM) dan Riza Kurniawan (R-Tech Softmedia).\r\n\n\r\n\n\r\n\n\r\n\nInfo lengkapnya di browsur berikut ini.', '02:10:45', '303657733cf94df9d252bd26e94258ab.png', '2011-04-12', '2013-07-20', 112),
(130, 'admin', 'Berikut ini Revisi Rundown Acara APTIKOM Doctoral Bootcamp 2013 (Update 28 Juni 2013).\r\n\n\r\n\nhttp://www.aptikom3.or.id/wp-content/uploads/2013/06/REVISI-RUNDOWN-ADB-1-28-juni-13.docx', 'Revisi Rundown Acara APTIKOM Doctoral Bootcamp 2013', 'Berikut ini Revisi Rundown Acara APTIKOM Doctoral Bootcamp 2013 (Update 28 Juni 2013).\r\n\n\r\n\nhttp://www.aptikom3.or.id/wp-content/uploads/2013/06/REVISI-RUNDOWN-ADB-1-28-juni-13.docx', '02:08:03', '7c8493eb7318d77be5a45d3424531bf2.png', '2011-04-12', '2013-07-20', 128),
(131, 'admin', 'Jurnal TICOM Volume 1 Nomor 3 (Bulan Juni 2013) dapat dilihat di alamat http://jurnal.aptikom3.or.id', 'Jurnal TICOM Volume 1 Nomor 3 (Bulan Juni 2013)', 'Jurnal TICOM Volume 1 Nomor 3 (Bulan Juni 2013) dapat dilihat di alamat http://jurnal.aptikom3.or.id', '23:27:46', '7d0218d6a32721bf729c922afe7c360c.png', '2011-05-06', '2013-07-20', 9);

-- --------------------------------------------------------

--
-- Table structure for table `download`
--

CREATE TABLE IF NOT EXISTS `download` (
  `id_download` int(5) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `nama_file` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_posting` date NOT NULL,
  `hits` int(3) NOT NULL,
  PRIMARY KEY (`id_download`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `download`
--

INSERT INTO `download` (`id_download`, `judul`, `nama_file`, `tgl_posting`, `hits`) VALUES
(1, 'Formulir Pendaftaran', '3cb28d7272de2b23ef1b80821a94baec.zip', '2013-07-21', 1),
(2, 'Berkas 1', '824ba531259500c7d72e4714ba070095.zip', '2013-07-21', 1),
(3, 'Berkas 2', '124d10c46d20498619f0b6d5d0e03adf.zip', '2013-07-21', 1),
(4, 'berkas penerimaan', 'd549f9c768ce89466be340bcc1de2ec4.zip', '2013-07-21', 1),
(5, 'Test upload', 'b34f7ef82dacb3f54d5991440f196811.zip', '2013-07-21', 1),
(6, 'File Upload', '422b97e2c342d35338f4ea2a3f3ba179.zip', '2013-07-21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `id_gallery` int(5) NOT NULL AUTO_INCREMENT,
  `id_album` int(5) NOT NULL,
  `jdl_gallery` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gallery_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `keterangan` text COLLATE latin1_general_ci NOT NULL,
  `gbr_gallery` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_gallery`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id_gallery`, `id_album`, `jdl_gallery`, `gallery_seo`, `keterangan`, `gbr_gallery`) VALUES
(1, 12, 'Cover Minyak Rem', 'cover-minyak-rem', 'Tutup minyak rem', 'ed2e05f672a533456d96a7921f9ec8a7.jpg'),
(2, 12, 'Tutup Rangka', 'tutup-rangka', 'tutup rangka', '2596e91f3c65e75f96db7fb280198dc2.jpg'),
(3, 12, 'Tutup oli belakang', 'tutup-oli-belakang', 'tutup oli belakang', '85d32f26ef0a9159edd6a132de8ace6a.jpg'),
(4, 12, 'Cover Kaliper', 'cover kaliper', 'cover kalipr', 'c42c388c12df7c4689bdf643a2b1b6b7.jpg'),
(5, 12, 'Cover As Roda', 'cover-as-roda', 'cover as roda belakang', '539e64999a37ca25c0da9d3d2a8da52a.jpg'),
(6, 12, 'Setelan Rantai', 'setelan-rantai', 'setelan rantai', '37c38316e61adc79d099016c587a5c20.jpg'),
(7, 12, 'As Roda Depan', 'as-roda-depan', 'as roda depan', 'f7e590672902bd4599b2b13b5d54e2f3.jpg'),
(8, 12, 'As roda belakang', 'as-roda-belakang', 'as roda belakang', '281c9a4af2669a18468188791e70a628.jpg'),
(9, 12, 'Frame Slider', 'frame-slider', 'frame slider', '9375023d1f4e4fded980ca5028dbf4e2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `halaman`
--

CREATE TABLE IF NOT EXISTS `halaman` (
  `id_halaman` int(5) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) NOT NULL,
  `isi_halaman` text NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `tgl_posting` date NOT NULL,
  `tgl_update` date NOT NULL,
  PRIMARY KEY (`id_halaman`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `halaman`
--

INSERT INTO `halaman` (`id_halaman`, `judul`, `isi_halaman`, `gambar`, `tgl_posting`, `tgl_update`) VALUES
(18, 'Kaitan 3', 'Kaitan 3', '', '2011-05-05', '2013-07-21'),
(14, 'Kaitan 5', 'Kaitan 5', '', '2011-04-15', '2013-07-21'),
(17, 'Kaitan 4', 'Kaitan 4', '', '2011-04-16', '2013-07-21'),
(19, 'Kaitan 2', 'Kaitan 2', '', '2011-05-05', '2013-07-21'),
(20, 'Kaitan 1', 'kaitan 1', '', '2011-05-05', '2013-07-21'),
(21, 'Profil', 'Profil bootcam', '', '2011-05-05', '2013-07-21');

-- --------------------------------------------------------

--
-- Table structure for table `hubungi`
--

CREATE TABLE IF NOT EXISTS `hubungi` (
  `id_hubungi` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `subjek` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `pesan` text COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `dibalas` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id_hubungi`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `hubungi`
--

INSERT INTO `hubungi` (`id_hubungi`, `nama`, `email`, `subjek`, `pesan`, `tanggal`, `dibalas`) VALUES
(14, 'richi kapoh', 'member@localhost', 'test menghubungi anda', 'safa saf asf asdf', '2011-04-15', 'N'),
(15, 'richi kapoh', 'member@localhost', 'test menghubungi anda', 'tes sfa sfa asf asf', '2011-04-15', 'Y'),
(13, 'richi kapoh', 'member@localhost', 'test menghubungi anda', 'test test tssta', '2011-04-15', 'N'),
(16, 'richi kapoh', 'member@localhost', 'sldfasl slkd asldkf aslkfj', 'lksdfasl fasldkf aslf kasflks alskdfjaslkf alsdkfasl fasdfasdf asfd', '2011-05-03', 'N'),
(17, 'fasd sadf asdfa sdf', 'member@localhost', 'sadf sadf asfas dfasfd', 'a sdfasfsadfas dfasdf asdfasd f', '2011-05-03', 'N'),
(18, 'richi kapoh', 'member@localhost', 'test kirim kontak', 'sldfkas lsldkfasflk salkdfalsk aslkfasl fas;fasdlfk aslfaslfasjflksfjaskaslkfasdlfk lksdf sa fsdf asd fas', '2011-05-03', 'N'),
(19, 'Ifan', 'fnnight@gmail.com', 'test kontak', 'test kontak', '2013-07-21', 'N'),
(20, 'freisy', 'freisy@gmail.com', 'test kontak', 'testkontak', '2013-07-21', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `identitas`
--

CREATE TABLE IF NOT EXISTS `identitas` (
  `id_identitas` int(5) NOT NULL AUTO_INCREMENT,
  `nama_website` varchar(100) NOT NULL,
  `alamat_website` varchar(100) NOT NULL,
  `meta_deskripsi` varchar(250) NOT NULL,
  `meta_keyword` varchar(250) NOT NULL,
  `favicon` varchar(50) NOT NULL,
  PRIMARY KEY (`id_identitas`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `identitas`
--

INSERT INTO `identitas` (`id_identitas`, `nama_website`, `alamat_website`, `meta_deskripsi`, `meta_keyword`, `favicon`) VALUES
(1, 'bukulokomedia.com - penerbit lokomedia yogyakartas', 'http://localhost/lokomedia', 'lokomedia adalah penerbit buku-buku komputer khususnya di bidang pemrograman web dan internet.', 'lokomedia, bukulokomedia, toko online, buku komputer, trik, tutorial, konsultasi, distro kaos, php', 'favicon.ico');

-- --------------------------------------------------------

--
-- Table structure for table `mainmenu`
--

CREATE TABLE IF NOT EXISTS `mainmenu` (
  `id_main` int(5) NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `link` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y',
  `adminmenu` enum('Y','N') NOT NULL,
  PRIMARY KEY (`id_main`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `mainmenu`
--

INSERT INTO `mainmenu` (`id_main`, `nama_menu`, `link`, `aktif`, `adminmenu`) VALUES
(2, 'Beranda', 'http://localhost/lokomedia', 'Y', 'N'),
(3, 'Profil', 'statis-1-profil.html', 'Y', 'N'),
(4, 'Agenda', 'semua-agenda.html', 'Y', 'N'),
(5, 'Berita', 'semua-berita.html', 'Y', 'N'),
(6, 'Download', 'semua-download.html', 'Y', 'N'),
(7, 'Galeri Foto', 'semua-album.html', 'Y', 'N'),
(8, 'Hubungi Kami', 'hubungi-kami.html', 'Y', 'N'),
(14, 'Setting Web', '', 'N', 'Y'),
(15, 'Setting Menu', '', 'N', 'Y'),
(16, 'Manajemen Berita', '', 'N', 'Y'),
(54, 'Hubungi Kami', '?module=hubungi', 'N', 'Y'),
(53, 'Interaksi', '', 'N', 'Y'),
(52, 'Media', '', 'N', 'Y'),
(59, 'Banner', '?module=banner', 'N', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `submenu`
--

CREATE TABLE IF NOT EXISTS `submenu` (
  `id_sub` int(5) NOT NULL AUTO_INCREMENT,
  `nama_sub` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `link_sub` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `id_main` int(5) NOT NULL,
  `id_submain` int(11) NOT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y',
  `adminsubmenu` enum('Y','N') NOT NULL,
  PRIMARY KEY (`id_sub`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `submenu`
--

INSERT INTO `submenu` (`id_sub`, `nama_sub`, `link_sub`, `id_main`, `id_submain`, `aktif`, `adminsubmenu`) VALUES
(2, 'Visi dan Misi', 'statis-2-visidanmisi.html', 3, 0, 'Y', 'N'),
(3, 'Struktur Organisasi', 'statis-3-strukturorganisasi.html', 3, 0, 'Y', 'N'),
(4, 'Ekonomi', 'kategori-21-ekonomi.html', 5, 0, 'N', 'N'),
(5, 'Hiburan', 'kategori-23-hiburan.html', 5, 0, 'Y', 'N'),
(6, 'Olahraga', 'kategori-2-olahraga.html', 5, 0, 'Y', 'N'),
(7, 'Politik', 'kategori-22-politik.html', 5, 0, 'Y', 'N'),
(8, 'Teknologi', 'kategori-19-teknologi.html', 5, 0, 'Y', 'N'),
(11, 'Manajemen Modul', '?module=modul', 14, 0, 'N', 'Y'),
(10, 'Identitas Web', '?module=identitas', 14, 0, 'N', 'Y'),
(12, 'Manajemen User', '?module=user', 14, 0, 'N', 'Y'),
(13, 'Manajemen Template', '?module=templates', 14, 0, 'N', 'Y'),
(14, 'Menu Utama', '?module=menuutama', 15, 0, 'N', 'Y'),
(15, 'Sub Menu', '?module=submenu', 15, 0, 'N', 'Y'),
(16, 'Kategori Berita', '?module=kategori', 16, 0, 'N', 'Y'),
(17, 'Berita', '?module=berita', 16, 0, 'N', 'Y'),
(18, 'Komentar', '?module=komentar', 16, 0, 'N', 'Y'),
(19, 'Halaman Statis', '?module=halamanstatis', 16, 0, 'N', 'Y'),
(20, 'Tag / Label', '?module=tag', 16, 0, 'N', 'Y'),
(21, 'Sensor Kata', '?module=katajelek', 16, 0, 'N', 'Y'),
(22, 'Album', '?module=album', 52, 0, 'N', 'Y'),
(23, 'Galeri Foto', '?module=galerifoto', 52, 0, 'N', 'Y'),
(24, 'Download', '?module=download', 52, 0, 'N', 'Y'),
(25, 'Agenda', '?module=agenda', 53, 0, 'N', 'Y'),
(26, 'Poling', '?module=poling', 53, 0, 'N', 'Y'),
(27, 'Sekilas Info', '?module=sekilasinfo', 53, 0, 'N', 'Y'),
(30, 'ShoutBox', '?module=shoutbox', 53, 0, 'N', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'user',
  `blokir` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `tgl_regis` date NOT NULL,
  `tgl_update` date NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `nama_lengkap`, `email`, `no_telp`, `level`, `blokir`, `tgl_regis`, `tgl_update`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'administrator', 'fnnight@gmail.com', '085341777241', 'admin', 'N', '2011-04-11', '2011-04-11'),
('users', '9bc65c2abec141778ffaa729489f3e87', '', '', '', 'user', 'N', '2011-05-07', '2011-05-07');
