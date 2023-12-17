-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jul 2023 pada 13.13
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si-dokter`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` varchar(2) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `id_token` varchar(50) NOT NULL,
  `level` varchar(15) NOT NULL DEFAULT 'Administrator'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama`, `no_hp`, `email`, `password`, `id_token`, `level`) VALUES
('A1', 'Erik Wahyudi', '082225634392', 'erik@gmail.com', '202cb962ac59075b964b07152d234b70', '', 'Superadmin'),
('A2', 'Dwi Lina', '123456789', 'dwilina@gmail.com', '202cb962ac59075b964b07152d234b70', '', 'Administrator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_dokter`
--

CREATE TABLE `tb_dokter` (
  `id_dokter` varchar(2) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `id_token` varchar(50) NOT NULL,
  `level` varchar(6) NOT NULL DEFAULT 'Dokter'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_dokter`
--

INSERT INTO `tb_dokter` (`id_dokter`, `nama`, `no_hp`, `email`, `password`, `id_token`, `level`) VALUES
('D1', 'Dr. Bambang, SpOG', '123', 'bambang@gmail.com', '202cb962ac59075b964b07152d234b70', '', 'Dokter');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_informasi`
--

CREATE TABLE `tb_informasi` (
  `id_informasi` varchar(2) NOT NULL,
  `title` varchar(50) NOT NULL,
  `informasi` text NOT NULL,
  `file_informasi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_informasi`
--

INSERT INTO `tb_informasi` (`id_informasi`, `title`, `informasi`, `file_informasi`) VALUES
('i1', 'Informasi Si-Antri Pe-Dok', '<p><strong>Apa yang harus saya lakukan jika belum punya akun di Aplikasi Si-Antri Pe-Dok (Sistem Antrian Periksa Dokter) ?</strong></p>\r\n\r\n<p>1. Silahkan mendaftar terlebih dahulu dengan mengisikan nama, no hp, alamat serta data lainnya yang diperlukan.</p>\r\n\r\n<p>2. Jika sudah silahkan login dengan memasukan nama atau no hp atau email dan password yang kamu buat tadi.</p>\r\n\r\n<p>3. Selanjutnya pada tampilan menu utama ada tombol <u><em>Daftar Periksa Sekarang</em></u>, Klik tombol tersebut maka kamu akan diarahkan ke halaman menu&nbsp;<em><u>Buat Jadwal Periksa</u></em><em><u>&nbsp;</u></em>selanjutnya kamu akan disuruh mengiisi data yang diperlukan seperti memilih tanggal periksa yang diinginkan dan klik tombol <u><em>submit</em></u></p>\r\n\r\n<p>5. Jika sudah maka jadwal periksa kamu akan muncul dihalaman utama sesuai urutan antrian mendaftar.</p>\r\n\r\n<p><strong>Jika sudah punya akun, apa yang akan saya lakukan ?</strong></p>\r\n\r\n<ul>\r\n	<li>Cukup melakukan perintah dari urutan no 2 - 4 saja ya, tidak perlu membuat akun baru lagi, karena data akun kamu sudah tersimpan di database..</li>\r\n</ul>\r\n\r\n<p><strong>Jika sudah punya akun tetapi lupa password ?</strong></p>\r\n\r\n<ul>\r\n	<li>Kamu bisa melakukan reset password pada menu reset password yang ada di halaman login bagian bawah ( klik lupa password) atau klik link berikut</li>\r\n	<li>Kemudian masukkan akun email yang kamu gunakan mendaftar diawal dan pastikan akun email masih aktif di perangkat kamu jika tidak bisa menghubungi admin dengan mengklik <em><u>hubungi admin</u></em></li>\r\n</ul>\r\n', 'informasi_645ae61fa903f.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pasien`
--

CREATE TABLE `tb_pasien` (
  `id_pasien` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `tgl_lahir` date NOT NULL,
  `nama_suami` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `no_pasien` varchar(20) NOT NULL,
  `id_token` varchar(50) NOT NULL,
  `level` varchar(6) NOT NULL DEFAULT 'Pasien'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pasien`
--

INSERT INTO `tb_pasien` (`id_pasien`, `nama`, `no_hp`, `alamat`, `tgl_lahir`, `nama_suami`, `email`, `password`, `no_pasien`, `id_token`, `level`) VALUES
('P001CGk4mc', 'Bumil', '123456789', 'Ponorogo', '2000-07-06', 'Pakmil', 'bumil@gmail.com', '202cb962ac59075b964b07152d234b70', 'P001-010223', '', 'Pasien'),
('P002dBPSbJ', 'Ani Handayani', '085877711122', 'Ds. Balong Kec. Balong Kab. Ponorogo', '1998-03-05', 'Budi Doremi', 'ani@gmail.com', '202cb962ac59075b964b07152d234b70', 'P002-210223', '', 'Pasien'),
('P003Nx9QKZ', 'fannisa', '1234', 'Balong Ponorogo', '2001-02-07', 'bpk fan', 'fannisa@gmail.com', '202cb962ac59075b964b07152d234b70', 'P003-220223', '', 'Pasien'),
('P004Aoz0J8', 'rani dwi kartikasari', '12345', 'ponorogo kota', '2000-07-06', 'bpk ran', 'rani@gmail.com', '202cb962ac59075b964b07152d234b70', 'P004-290223', '', 'Pasien'),
('P005DV4Tpr', 'rika', '1111', 'jenangan', '1999-02-01', 'bpk rika', 'rika@gmail.com', '202cb962ac59075b964b07152d234b70', 'P005-010323', '', 'Pasien'),
('P006x7EQbK', 'maftika', '19122', 'Madiun Kota', '2001-03-05', 'bpk tika', 'maftika@gmail.com', '202cb962ac59075b964b07152d234b70', 'P006-020323', '', 'Pasien'),
('P007FBpi18', 'Dika Rizka Fadhila', '128271', 'Balong Ponorogo', '2000-05-08', 'bpk dika', 'dila@gmail.com', '202cb962ac59075b964b07152d234b70', 'P007-030323', '', 'Pasien'),
('P008bYtAC3', 'shinta indriana', '01816765', 'Ngasinan Jetis', '2001-01-01', 'bp sinta', 'sinta@gmail.com', '202cb962ac59075b964b07152d234b70', 'P008-150323', '', 'Pasien'),
('P009IDF7Ma', 'Arfiana', '115225', 'Babadan Ponorogo', '1998-11-11', 'bp arfi', 'arfi@gmail.com', '202cb962ac59075b964b07152d234b70', 'P009-010423', '', 'Pasien'),
('P010HIE3cs', 'Mahalini', '7332911', 'Ponorogo Kota', '1992-03-09', 'bp riski', 'lini@gmail.com', '202cb962ac59075b964b07152d234b70', 'P010-010523', '', 'Pasien'),
('P011lYuvYQ', 'ais', '6181616', 'Jl. Agus Salim Rt. 007 Rw. 003 Medelan, Jalen Kec. Balong Kabupaten Ponorogo, Jawa Timur 63461, Indonesia', '1996-05-11', 'budi', 'ais@gmai.com', '202cb962ac59075b964b07152d234b70', 'P011-010623', '', 'Pasien'),
('P012eXZ0Yb', 'Lola Maharani', '089999871515', 'Jl. Agus salim jalen balong ponorogo', '2000-01-01', 'Wakhid', 'lola@gmail.com', '202cb962ac59075b964b07152d234b70', 'P012-010723', '', 'Pasien'),
('P013Vz', 'GAZQU NGZ', '1234554321', 'TL. SYUF VRLSM BSLRQ SAVOFY PBQFRYGG', '2023-07-03', 'NWA', 'NWA@YMNLC.CYM', '202cb962ac59075b964b07152d234b70', '', '', 'Pasien');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengaturan`
--

CREATE TABLE `tb_pengaturan` (
  `id_pengaturan` varchar(7) NOT NULL,
  `nama_judul` varchar(50) NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `lokasi_praktik` text NOT NULL,
  `jdwl_praktek` varchar(15) NOT NULL,
  `jam_praktek` time NOT NULL,
  `jdwl_pendaftaran` varchar(50) NOT NULL,
  `akses_pendaftaran` enum('Buka','Tutup') NOT NULL,
  `logo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pengaturan`
--

INSERT INTO `tb_pengaturan` (`id_pengaturan`, `nama_judul`, `meta_keywords`, `meta_description`, `lokasi_praktik`, `jdwl_praktek`, `jam_praktek`, `jdwl_pendaftaran`, `akses_pendaftaran`, `logo`) VALUES
('P1xhDwL', 'Si-Antri Pe-Dok', 'Sistem Antrian Periksa Dokter', 'Klinik Praktik Dr. Bambang SpOG', 'https://goo.gl/maps/PrfTMuVWgqoS4faz8', 'Senin ~ Jum\'at', '05:00:00', 'Setiap hari Minggu', 'Buka', 'header_64a0e411d8034.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_periksa`
--

CREATE TABLE `tb_periksa` (
  `id_antrian` varchar(50) NOT NULL,
  `id_pasien` varchar(50) NOT NULL,
  `mens_terakhir` date NOT NULL,
  `keluhan` text NOT NULL,
  `tgl_periksa` date NOT NULL,
  `catatan` text NOT NULL,
  `waktu_keluar` time NOT NULL,
  `status` enum('PV','BTL','ANTRI','DIPERIKSA','S') NOT NULL,
  `uuid` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_periksa`
--

INSERT INTO `tb_periksa` (`id_antrian`, `id_pasien`, `mens_terakhir`, `keluhan`, `tgl_periksa`, `catatan`, `waktu_keluar`, `status`, `uuid`) VALUES
('A001pYlhK', 'P011lYuvYQ', '2023-04-24', 'mencoba mengeluh', '2023-07-01', 'isitirahat yang cukup', '10:02:09', 'S', 'lipjPKw8rmQwgT5i'),
('A002xnoB3', 'P010HIE3cs', '2023-04-24', 'mengapa harus ada keluhan', '2023-07-01', 'qwert', '10:54:38', 'S', 'wmmxrGw46cFJSEPD'),
('A003W8c1V', 'P009IDF7Ma', '2023-04-24', 'ingin ku berkata apa saja', '2023-07-01', '', '00:00:00', 'ANTRI', 'kxRVz4RzoJvHhkcG'),
('A004WZG05', 'P008bYtAC3', '2023-05-01', 'Sebenrnya saya ingin mengeluh', '2023-07-01', '', '00:00:00', 'PV', 'kqLgDrmdR6O9iceb'),
('A005kdtmJ', 'P006x7EQbK', '2023-05-01', 'pengin check aja', '2023-07-01', '', '00:00:00', 'PV', 'QmxUuAkcIbA0w4Aj'),
('A006ccaSF', 'P005DV4Tpr', '2023-05-01', 'perut kembung', '2023-07-01', '', '00:00:00', 'PV', 'LBZUs7znhInd2xVr'),
('A007LyRlL', 'P004Aoz0J8', '2023-04-18', 'rindu seseorang', '2023-07-01', '', '00:00:00', 'PV', '6xt47UaDXauTkYgm'),
('A008lSCvR', 'P003Nx9QKZ', '2023-05-01', 'ingin bahagia bersamanya', '2023-07-01', '', '00:00:00', 'PV', 'qicFwFn249p0rMYr'),
('A009PiG2q', 'P002dBPSbJ', '2023-05-03', 'hmmm aku tak tahu', '2023-07-01', '', '00:00:00', 'PV', 'ckhzKJH5f5OBhdq3'),
('A010ayyb2', 'P001CGk4mc', '2023-04-30', 'orang hamil biasanya keluhan apa gitu', '2023-07-01', '', '00:00:00', 'BTL', '2jchyMpWkTvzoNba'),
('A011UCTM1', 'P007FBpi18', '2023-04-30', 'hatiku rapuh', '2023-07-01', '', '00:00:00', 'PV', 'k9MqGsbBBdjEGX8i'),
('A012NVadl', 'P012eXZ0Yb', '2023-01-01', 'sedand kuran baik', '2023-07-01', '', '00:00:00', 'PV', 'ryi2cyEjfYOkP3wR');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_token`
--

CREATE TABLE `tb_token` (
  `id_token` varchar(50) NOT NULL,
  `token` text NOT NULL,
  `expired` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tb_dokter`
--
ALTER TABLE `tb_dokter`
  ADD PRIMARY KEY (`id_dokter`);

--
-- Indeks untuk tabel `tb_informasi`
--
ALTER TABLE `tb_informasi`
  ADD PRIMARY KEY (`id_informasi`);

--
-- Indeks untuk tabel `tb_pasien`
--
ALTER TABLE `tb_pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indeks untuk tabel `tb_pengaturan`
--
ALTER TABLE `tb_pengaturan`
  ADD PRIMARY KEY (`id_pengaturan`);

--
-- Indeks untuk tabel `tb_periksa`
--
ALTER TABLE `tb_periksa`
  ADD PRIMARY KEY (`id_antrian`),
  ADD KEY `id_pasien` (`id_pasien`);

--
-- Indeks untuk tabel `tb_token`
--
ALTER TABLE `tb_token`
  ADD PRIMARY KEY (`id_token`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_periksa`
--
ALTER TABLE `tb_periksa`
  ADD CONSTRAINT `tb_periksa_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `tb_pasien` (`id_pasien`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
