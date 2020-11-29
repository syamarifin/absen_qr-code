-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Jul 2020 pada 03.09
-- Versi server: 10.1.36-MariaDB
-- Versi PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siujar`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbabsensi`
--

CREATE TABLE `tbabsensi` (
  `idAbsen` int(10) NOT NULL,
  `idAslab` varchar(10) NOT NULL,
  `tgl` date NOT NULL,
  `a_in` time NOT NULL,
  `a_out` time NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbabsensi`
--

INSERT INTO `tbabsensi` (`idAbsen`, `idAslab`, `tgl`, `a_in`, `a_out`, `keterangan`) VALUES
(3, 'IK0003', '2020-06-01', '11:18:23', '10:06:10', ''),
(4, 'IK0004', '2020-06-29', '08:10:55', '08:28:10', ''),
(5, 'IK0003', '2020-07-09', '11:32:05', '00:00:00', ''),
(6, 'IK0004', '2020-07-09', '12:15:04', '00:00:00', ''),
(12, 'IK0004', '2020-07-12', '13:39:56', '13:43:27', ''),
(13, 'IK0003', '2020-07-12', '13:43:45', '00:00:00', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbanggota`
--

CREATE TABLE `tbanggota` (
  `IdDaftar_a` varchar(10) NOT NULL,
  `NIM` varchar(10) NOT NULL,
  `Nama` varchar(15) NOT NULL,
  `Semester` varchar(10) NOT NULL,
  `tmptlahir` varchar(25) NOT NULL,
  `tgllahir` date NOT NULL,
  `Jk` varchar(10) NOT NULL,
  `Alamat` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `img` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbanggota`
--

INSERT INTO `tbanggota` (`IdDaftar_a`, `NIM`, `Nama`, `Semester`, `tmptlahir`, `tgllahir`, `Jk`, `Alamat`, `email`, `img`) VALUES
('1', '15201237', 'Syamsul', '4', 'Situbondo', '1999-06-15', 'Laki-Laki', 'asd', 's_arifin98@yahoo.co.id', 'Tulips.jpg'),
('2', '15201236', 'Saiful', '4', 'Malang', '2020-05-11', 'Laki-Laki', 'Malang', 'putri@gmail.com', 'Chrysanthemum.jpg'),
('3', '15201238', 'Farah', '3', 'Jember', '2020-05-19', 'Perempuan', 'Malang', 'Sellyzoya5@gmail.com', 'noimage.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbaslab`
--

CREATE TABLE `tbaslab` (
  `idAslab` varchar(10) NOT NULL,
  `NIM` varchar(25) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tempatLahir` varchar(25) NOT NULL,
  `tglLahir` date NOT NULL,
  `jk` varchar(10) NOT NULL,
  `noTelp` varchar(15) NOT NULL,
  `jabatan` varchar(25) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pass` varchar(25) NOT NULL,
  `profileImg` varchar(50) NOT NULL,
  `QrCode` varchar(50) NOT NULL,
  `isActive` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbaslab`
--

INSERT INTO `tbaslab` (`idAslab`, `NIM`, `nama`, `tempatLahir`, `tglLahir`, `jk`, `noTelp`, `jabatan`, `username`, `pass`, `profileImg`, `QrCode`, `isActive`) VALUES
('IK0001', '11111111', 'Admin Kabid', 'malang', '1989-05-10', 'Perempuan', '0854368629', 'KABID', 'admin@asia.ac.id', 'adminasia', 'noimage.jpg', '', 'Y'),
('IK0002', '12345678', 'Ahmad', 'malang', '2015-01-22', 'Laki-Laki', '085', 'ASLAB', 'ahmad@gmail.com', '12345678', 'Tulips.jpg', '', 'Y'),
('IK0003', '15201237', 'Syamsul', 'malang', '2020-05-06', 'Laki-Laki', '0854368629', 'ASLAB', 'asyamsul96@gmail.com', '1234', '15201237Hydrangeas.jpg', 'IK0003.png', 'Y'),
('IK0004', '15201238', 'Farah', 'Jember', '2020-05-19', 'Perempuan', '085123456789', 'ASLAB', 'farah@gmail.com', '15201238', '15201238Penguins.jpg', 'IK0004.png', 'Y'),
('IK0005', '15201236', 'Putri', 'Malang', '2020-05-11', 'Laki-Laki', '', 'ASLAB', 'putri@gmail.com', '15201236', 'Chrysanthemum.jpg', 'IK0005.png', 'Y'),
('IK0006', '15201238', 'Selly', 'Toili', '1998-05-13', 'Perempuan', '085123456788', 'ASLAB', 'Sellyzoya5@gmail.com', '15201238', '15201238Koala.jpg', 'IK0006.png', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbhotspot`
--

CREATE TABLE `tbhotspot` (
  `idDaftar_h` varchar(10) NOT NULL,
  `NIM` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(15) NOT NULL,
  `tglldftr` date NOT NULL,
  `status` varchar(15) NOT NULL,
  `isActive` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbhotspot`
--

INSERT INTO `tbhotspot` (`idDaftar_h`, `NIM`, `nama`, `password`, `tglldftr`, `status`, `isActive`) VALUES
('1', '15201238', 'Syamsul Arifin', 'syamsularifin29', '2020-05-16', 'New', 'active');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbinventaris`
--

CREATE TABLE `tbinventaris` (
  `idbarang` varchar(10) NOT NULL,
  `Namabrg` varchar(10) NOT NULL,
  `Jumlhbrg` varchar(100) NOT NULL,
  `Stok` varchar(10) NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `Deskripsi` text NOT NULL,
  `Qr_Code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbinventaris`
--

INSERT INTO `tbinventaris` (`idbarang`, `Namabrg`, `Jumlhbrg`, `Stok`, `lokasi`, `Deskripsi`, `Qr_Code`) VALUES
('BRG0001', 'Router', '10', '5', 'Kampus 1', 'asdb', 'BRG0001.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbjadwal`
--

CREATE TABLE `tbjadwal` (
  `idjadwal` varchar(10) NOT NULL,
  `idAslab` varchar(10) NOT NULL,
  `Jadwal` varchar(25) NOT NULL,
  `shift` varchar(50) NOT NULL,
  `lokasi` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbjadwal`
--

INSERT INTO `tbjadwal` (`idjadwal`, `idAslab`, `Jadwal`, `shift`, `lokasi`) VALUES
('JDW0001', 'IK0003', 'Thursday, 2020-05-14', 'Sore (15:00 s/d 21:00)', 'Kampus 2'),
('JDW0002', 'IK0004', 'Monday, 2020-06-22', 'Pagi (07:00 s/d 13:00)', 'Kampus 1'),
('JDW0003', 'IK0005', 'Friday, 2020-06-26', 'Sore (15:00 s/d 21:00)', 'Kampus 2'),
('JDW0004', 'IK0003', '08-2020', 'Pagi (07:00 s/d 13:00)', 'Kampus 1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbpeminjaman`
--

CREATE TABLE `tbpeminjaman` (
  `idPinjam` varchar(10) NOT NULL,
  `Nama_peminjam` varchar(10) NOT NULL,
  `NIM` varchar(10) NOT NULL,
  `tglPinjam` date NOT NULL,
  `keperluan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbpeminjaman`
--

INSERT INTO `tbpeminjaman` (`idPinjam`, `Nama_peminjam`, `NIM`, `tglPinjam`, `keperluan`) VALUES
('PIB0001', 'Adit', '17201202', '2020-07-13', 'Kegiatan OSPRo'),
('PIB0002', 'Bayu', '17201203', '2020-07-13', 'Kegiatan OSPRo'),
('PIB0003', 'Roni', '17201203', '2020-07-14', 'Kegiatan OSPRo');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbpeminjamandtl`
--

CREATE TABLE `tbpeminjamandtl` (
  `idDtl` int(8) NOT NULL,
  `idPinjam` varchar(10) NOT NULL,
  `idbarang` varchar(10) NOT NULL,
  `JumlhBrg` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbpeminjamandtl`
--

INSERT INTO `tbpeminjamandtl` (`idDtl`, `idPinjam`, `idbarang`, `JumlhBrg`) VALUES
(1, 'PIB0001', 'BRG0001', '1'),
(3, 'PIB0002', 'BRG0001', '1'),
(8, 'PIB0003', 'BRG0001', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbpengembalian`
--

CREATE TABLE `tbpengembalian` (
  `idDtl` int(11) NOT NULL,
  `idPinjam` varchar(10) NOT NULL,
  `idbarang` varchar(10) NOT NULL,
  `JumlhBrg` varchar(5) NOT NULL,
  `tglKembali` date NOT NULL,
  `penerima` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbpengembalian`
--

INSERT INTO `tbpengembalian` (`idDtl`, `idPinjam`, `idbarang`, `JumlhBrg`, `tglKembali`, `penerima`) VALUES
(1, 'PIB0001', 'BRG0001', '1', '2020-07-14', 'Syamsul'),
(4, 'PIB0002', 'BRG0001', '1', '2020-07-15', 'Syamsul'),
(6, 'PIB0003', 'BRG0001', '1', '2020-07-16', 'Syamsul');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbtroubleshooting`
--

CREATE TABLE `tbtroubleshooting` (
  `idPenanganan` int(10) NOT NULL,
  `Jenismslh` varchar(10) NOT NULL,
  `Pelapor` varchar(15) NOT NULL,
  `tgllapor` date NOT NULL,
  `tgperbaikan` date NOT NULL,
  `Teknisi` varchar(10) NOT NULL,
  `Deskripsi` text NOT NULL,
  `solusi` text NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbtroubleshooting`
--

INSERT INTO `tbtroubleshooting` (`idPenanganan`, `Jenismslh`, `Pelapor`, `tgllapor`, `tgperbaikan`, `Teknisi`, `Deskripsi`, `solusi`, `status`) VALUES
(1, 'Komputer', 'Imas', '2020-04-01', '2020-04-01', 'Aditya', 'Komputer tidak bisa menyala', '', 'Done'),
(2, 'Komputer', 'Adit', '2020-07-06', '2020-07-05', 'Farah', 'Komputer 12 di Lab A macet', '', 'Done'),
(3, 'Proyektor', 'Roni', '2020-07-02', '2020-07-05', 'Farah', 'Proyektor ruang harvard mati', '', 'Done'),
(4, 'Komputer', 'Adit', '2020-07-03', '0000-00-00', '', 'komputer tidak nyala', '', 'New');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbabsensi`
--
ALTER TABLE `tbabsensi`
  ADD PRIMARY KEY (`idAbsen`),
  ADD KEY `idAslab` (`idAslab`);

--
-- Indeks untuk tabel `tbanggota`
--
ALTER TABLE `tbanggota`
  ADD PRIMARY KEY (`IdDaftar_a`);

--
-- Indeks untuk tabel `tbaslab`
--
ALTER TABLE `tbaslab`
  ADD PRIMARY KEY (`idAslab`);

--
-- Indeks untuk tabel `tbhotspot`
--
ALTER TABLE `tbhotspot`
  ADD PRIMARY KEY (`idDaftar_h`);

--
-- Indeks untuk tabel `tbinventaris`
--
ALTER TABLE `tbinventaris`
  ADD PRIMARY KEY (`idbarang`);

--
-- Indeks untuk tabel `tbjadwal`
--
ALTER TABLE `tbjadwal`
  ADD PRIMARY KEY (`idjadwal`),
  ADD KEY `idAslab` (`idAslab`);

--
-- Indeks untuk tabel `tbpeminjaman`
--
ALTER TABLE `tbpeminjaman`
  ADD PRIMARY KEY (`idPinjam`);

--
-- Indeks untuk tabel `tbpeminjamandtl`
--
ALTER TABLE `tbpeminjamandtl`
  ADD PRIMARY KEY (`idDtl`),
  ADD KEY `idPinjam` (`idPinjam`),
  ADD KEY `idbarang` (`idbarang`);

--
-- Indeks untuk tabel `tbpengembalian`
--
ALTER TABLE `tbpengembalian`
  ADD PRIMARY KEY (`idDtl`),
  ADD KEY `idPinjam` (`idPinjam`),
  ADD KEY `idbarang` (`idbarang`),
  ADD KEY `penerima` (`penerima`),
  ADD KEY `penerima_2` (`penerima`);

--
-- Indeks untuk tabel `tbtroubleshooting`
--
ALTER TABLE `tbtroubleshooting`
  ADD PRIMARY KEY (`idPenanganan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbabsensi`
--
ALTER TABLE `tbabsensi`
  MODIFY `idAbsen` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tbpeminjamandtl`
--
ALTER TABLE `tbpeminjamandtl`
  MODIFY `idDtl` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbpengembalian`
--
ALTER TABLE `tbpengembalian`
  MODIFY `idDtl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
