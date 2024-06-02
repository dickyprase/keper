-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2020 at 15:31 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `netbill`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_login`
--

CREATE TABLE IF NOT EXISTS `t_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `level` enum('admin','operator') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `t_paket`
--

CREATE TABLE IF NOT EXISTS `t_paket` (
  `id_paket` varchar(3) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `harga` varchar(7) NOT NULL,
  PRIMARY KEY (`id_paket`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_pelanggan`
--

CREATE TABLE IF NOT EXISTS `t_pelanggan` (
  `id_pelanggan` varchar(25) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `email` varchar(25) NOT NULL,
  `id_paket` varchar(3) NOT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_setting`
--

CREATE TABLE IF NOT EXISTS `t_setting` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `pemilik` varchar(50) NOT NULL,
  `logo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `t_transaksi`
--

CREATE TABLE IF NOT EXISTS `t_transaksi` (
  `id_transaksi` varchar(30) NOT NULL,
  `id_pelanggan` varchar(50) NOT NULL,
  `nominal` int(7) NOT NULL,
  `bukti` varchar(50) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `tgl_validasi` date NOT NULL,
  `status` enum('pending','lunas') NOT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE IF NOT EXISTS `t_user` (
  `id_pelanggan` varchar(25) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `level` enum('admin','pelanggan') NOT NULL,
  UNIQUE KEY `id_pelanggan` (`id_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for table `t_user`
--
ALTER TABLE `t_user`
  ADD CONSTRAINT `t_user_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `t_pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
