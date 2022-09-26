-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2022 at 11:32 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tienda`
--

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

CREATE TABLE `pedidos` (
  `ID` int(11) NOT NULL,
  `DIRECCION` varchar(255) NOT NULL,
  `DESTINATARIO` varchar(255) NOT NULL,
  `FECHA_PEDIDO` datetime NOT NULL,
  `FECHA_ENTREGA` date NOT NULL,
  `CARGO` float NOT NULL,
  `COD_POSTAL` int(11) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `FK_PRODUCTO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pedidos`
--

INSERT INTO `pedidos` (`ID`, `DIRECCION`, `DESTINATARIO`, `FECHA_PEDIDO`, `FECHA_ENTREGA`, `CARGO`, `COD_POSTAL`, `EMAIL`, `FK_PRODUCTO`) VALUES
(1, 'direccion', 'yo1', '2022-09-26 16:01:51', '2022-09-29', 2000, 2311, 'jooge1998@gmail.com', 3),
(5, 'dire', 'yo', '2022-09-26 16:01:51', '2022-09-29', 2000, 2311, 'jooge1998@gmail.com', 3);

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `ID` int(11) NOT NULL,
  `PRODUCTO` varchar(255) NOT NULL,
  `DESCRIPCION` varchar(255) NOT NULL,
  `PRECIO` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`ID`, `PRODUCTO`, `DESCRIPCION`, `PRECIO`) VALUES
(3, 'shamppo', 'cabello', 1000),
(4, 'p1', 'nina', 4000),
(5, 'p1', 'nina', 4000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_PRODUCTO` (`FK_PRODUCTO`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`FK_PRODUCTO`) REFERENCES `productos` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
