-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jun 2025 pada 10.02
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_botany`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `short_description` text NOT NULL,
  `details` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `thumbnail_image` varchar(255) DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `courses`
--

INSERT INTO `courses` (`id`, `title`, `short_description`, `details`, `price`, `thumbnail_image`) VALUES
(1, 'Hidroponik untuk Pemula', 'Belajar dasar-dasar menanam tanpa menggunakan tanah. Cocok untuk Anda yang ingin memulai hobi berkebun modern di rumah.', 'Dalam kelas ini, Anda akan dibimbing dari nol untuk membangun sistem hidroponik fungsional di rumah. Materi mencakup pengenalan berbagai sistem, cara meracik nutrisi, teknik penyemaian, hingga tips perawatan harian.', 149000.00, 'hidroponik_pemula.svg'),
(2, 'Seni Merawat Bonsai', 'Kuasai seni kuno dalam membentuk dan merawat bonsai. Pelajari teknik-teknik penting seperti pruning, wiring, dan pemupukan.', 'Bonsai adalah perpaduan antara seni dan hortikultura. Kelas ini akan membawa Anda menyelami dunia bonsai, mulai dari filosofi di baliknya, memilih bakalan prospektif, teknik pengawatan, hingga metode pemupukan dan pemangkasan.', 175000.00, 'merawat_bonsai.svg'),
(3, 'Berkebun di Lahan Sempit', 'Maksimalkan ruang terbatas Anda menjadi oase hijau yang produktif dengan taman vertikal dan kebun pot.', 'Tidak punya halaman luas bukan berarti tidak bisa berkebun. Kelas ini didedikasikan untuk Anda yang tinggal di lingkungan urban. Pelajari cara cerdas memanfaatkan ruang vertikal, trik memilih pot dan media tanam yang tepat, serta daftar tanaman yang cocok.', 0.00, 'lahan_sempit.svg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `materi`
--

CREATE TABLE `materi` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` enum('video','article') NOT NULL,
  `content` text NOT NULL,
  `order_number` int(11) NOT NULL,
  `duration_minutes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `materi`
--

INSERT INTO `materi` (`id`, `course_id`, `title`, `type`, `content`, `order_number`, `duration_minutes`) VALUES
(1, 1, 'Pengenalan Hidroponik', 'video', '[Link Video YouTube]', 1, 10),
(2, 1, 'Memilih Sistem Hidroponik', 'article', 'Ada beberapa sistem hidroponik yang populer...', 2, 12),
(3, 1, 'Meracik Nutrisi AB Mix', 'article', 'Nutrisi AB Mix adalah kunci keberhasilan...', 3, 13),
(4, 1, 'Langkah-langkah Penyemaian', 'video', '[Link Video YouTube]', 4, 10),
(5, 2, 'Memilih Bakalan Bonsai', 'video', '[Link Video YouTube]', 1, 15),
(6, 2, 'Teknik Wiring (Pengawatan) Dasar', 'article', 'Wiring adalah seni melilitkan kawat...', 2, 10),
(7, 2, 'Prinsip Dasar Pemupukan', 'article', 'Bonsai hidup di pot yang terbatas...', 3, 10),
(8, 2, 'Pruning (Pemangkasan) untuk Estetika', 'video', '[Link Video YouTube]', 4, 15),
(9, 3, 'Konsep Taman Vertikal', 'article', 'Taman vertikal adalah solusi cerdas...', 1, 10),
(10, 3, 'Membuat Instalasi Taman Vertikal', 'video', '[Link Video YouTube]', 2, 12),
(11, 3, 'Memilih Tanaman untuk Pot', 'article', 'Tidak semua tanaman bahagia hidup di dalam pot...', 3, 8),
(12, 3, 'Tips Drainase dan Media Tanam', 'video', '[Link Video YouTube]', 4, 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftar`
--

CREATE TABLE `pendaftar` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `enrollment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pendaftar`
--

INSERT INTO `pendaftar` (`id`, `user_id`, `course_id`, `enrollment_date`) VALUES
(1, 1, 1, '2025-06-18 04:34:18'),
(2, 1, 2, '2025-06-18 04:34:18'),
(3, 2, 1, '2025-06-18 04:34:18'),
(4, 2, 3, '2025-06-18 04:34:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `progress`
--

CREATE TABLE `progress` (
  `id` int(11) NOT NULL,
  `enrollment_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `completed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `progress`
--

INSERT INTO `progress` (`id`, `enrollment_id`, `material_id`, `completed_at`) VALUES
(1, 1, 1, '2025-06-18 04:34:18'),
(2, 1, 2, '2025-06-18 04:34:18'),
(3, 1, 3, '2025-06-18 04:34:18'),
(4, 1, 4, '2025-06-18 04:34:18'),
(5, 2, 5, '2025-06-18 04:34:18'),
(6, 2, 6, '2025-06-18 04:34:18'),
(7, 3, 1, '2025-06-18 04:34:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'Budi Sanjaya', 'budi.sanjaya@example.com', '$2y$10$Eiz0DSi4b5d2Y.p1bC0sC.HAbXzC3XJc1l0g1dE9x8mB.vK4jJ3kG', '2025-06-18 04:34:17'),
(2, 'Siti Lestari', 'siti.lestari@example.com', '$2y$10$Eiz0DSi4b5d2Y.p1bC0sC.HAbXzC3XJc1l0g1dE9x8mB.vK4jJ3kG', '2025-06-18 04:34:17'),
(3, 'Indra Pradnya', 'indrapradnya2005@gmail.com', '$2y$10$7yFVU.hVKnFUgOHFaw5evucHpdrHo995KRXXSXcZDUEk48BRTK/LK', '2025-06-18 17:53:11');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indeks untuk tabel `pendaftar`
--
ALTER TABLE `pendaftar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indeks untuk tabel `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enrollment_id` (`enrollment_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `materi`
--
ALTER TABLE `materi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `pendaftar`
--
ALTER TABLE `pendaftar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `progress`
--
ALTER TABLE `progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `materi`
--
ALTER TABLE `materi`
  ADD CONSTRAINT `materi_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pendaftar`
--
ALTER TABLE `pendaftar`
  ADD CONSTRAINT `pendaftar_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pendaftar_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `progress`
--
ALTER TABLE `progress`
  ADD CONSTRAINT `progress_ibfk_1` FOREIGN KEY (`enrollment_id`) REFERENCES `pendaftar` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
