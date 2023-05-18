-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 18, 2023 lúc 07:12 AM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `btth02`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attendance`
--

CREATE TABLE `attendance` (
  `id_attendance` int(11) NOT NULL,
  `day` date NOT NULL DEFAULT current_timestamp(),
  `id_class` int(11) NOT NULL,
  `id_sv` int(11) NOT NULL,
  `status` enum('attend','absent','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `attendance`
--

INSERT INTO `attendance` (`id_attendance`, `day`, `id_class`, `id_sv`, `status`) VALUES
(1, '0000-00-00', 1, 1, 'attend');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `classes`
--

CREATE TABLE `classes` (
  `id_class` int(11) NOT NULL,
  `class code` int(11) NOT NULL,
  `class name` varchar(100) NOT NULL,
  `id_instructor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `classes`
--

INSERT INTO `classes` (`id_class`, `class code`, `class name`, `id_instructor`) VALUES
(1, 0, 'Công nghệ Web', 1),
(2, 0, '', 1),
(3, 0, '', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `instructors`
--

CREATE TABLE `instructors` (
  `id_instructor` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact info` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `instructors`
--

INSERT INTO `instructors` (`id_instructor`, `name`, `email`, `contact info`) VALUES
(1, 'Kiều Tuấn Dũng', 'kieutuandung@gmail.com', 'Thuy Loi');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `students`
--

CREATE TABLE `students` (
  `id_sv` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `birth` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact info` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `students`
--

INSERT INTO `students` (`id_sv`,`id_user`, `name`, `birth`, `email`, `contact info`) VALUES
(1,2, 'Bùi Tiến Đạt', '2023-05-10', 'buitiendat@gmail.com', 'Thuy Loi 2'),
(2,3, 'Bùi Mạnh Cường', '2023-05-16', 'buimanhcuong@gmail.com', 'Thuy Loi'),
(3,4, 'Nguyễn Duy Anh', '2023-05-03', 'nguyenduyanh@gmail.com', 'Thuy Loi 1'),
(4,5, 'Nguyễn Như Vinh', '2023-05-04', 'nguyennhuvinh@gmail.com', 'Thuy Loi');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` enum('Admin','Instructor','Student','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `role`) VALUES
(1, 'admin', '123', 'Admin'),
(2, 'buitiendat', '123', 'Student'),
(3, 'buimanhcuong', '123', 'Student'),
(4, 'nguyenduyanh', '123', 'Student'),
(5, 'nguyennhuvinh', '123', 'Student'),
(6, 'kieutuandung', '123', 'Instructor');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id_attendance`),
  ADD KEY `id_class` (`id_class`),
  ADD KEY `id_sv` (`id_sv`);

--
-- Chỉ mục cho bảng `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id_class`),
  ADD KEY `id_instructor` (`id_instructor`);

--
-- Chỉ mục cho bảng `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`id_instructor`);

--
-- Chỉ mục cho bảng `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id_sv`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Các ràng buộc cho bảng `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`id_class`) REFERENCES `classes` (`id_class`),
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`id_sv`) REFERENCES `students` (`id_sv`);

--
-- Các ràng buộc cho bảng `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`id_instructor`) REFERENCES `instructors` (`id_instructor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
