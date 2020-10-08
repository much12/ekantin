/*
Navicat MySQL Data Transfer

Source Server         : MySQL
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : ekantin

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-10-08 14:38:24
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ms_barang
-- ----------------------------
DROP TABLE IF EXISTS `ms_barang`;
CREATE TABLE `ms_barang` (
  `idBarang` int(11) NOT NULL AUTO_INCREMENT,
  `namaBarang` varchar(100) NOT NULL,
  `kategori` enum('makanan','minuman') NOT NULL,
  `harga` double(8,2) NOT NULL,
  `userId` int(11) NOT NULL,
  `stock` int(4) NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`idBarang`),
  KEY `userId` (`userId`),
  CONSTRAINT `ms_barang_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ms_barang
-- ----------------------------

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `roleId` int(2) NOT NULL AUTO_INCREMENT,
  `roleName` varchar(10) NOT NULL,
  PRIMARY KEY (`roleId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'Admin');
INSERT INTO `roles` VALUES ('2', 'Penjual');
INSERT INTO `roles` VALUES ('3', 'Siswa');
INSERT INTO `roles` VALUES ('4', 'Guru');

-- ----------------------------
-- Table structure for topuphistory
-- ----------------------------
DROP TABLE IF EXISTS `topuphistory`;
CREATE TABLE `topuphistory` (
  `idTopupHist` int(11) NOT NULL AUTO_INCREMENT,
  `idTopup` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `tanggalHistory` date NOT NULL,
  PRIMARY KEY (`idTopupHist`),
  KEY `idTopup` (`idTopup`),
  KEY `userId` (`userId`),
  CONSTRAINT `topupHistory_ibfk_1` FOREIGN KEY (`idTopup`) REFERENCES `topupredeem` (`idTopup`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `topupHistory_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of topuphistory
-- ----------------------------

-- ----------------------------
-- Table structure for topupredeem
-- ----------------------------
DROP TABLE IF EXISTS `topupredeem`;
CREATE TABLE `topupredeem` (
  `idTopup` int(11) NOT NULL AUTO_INCREMENT,
  `kodeRedeem` varchar(50) NOT NULL,
  `isActive` int(1) NOT NULL,
  `nominal` double(8,2) NOT NULL,
  PRIMARY KEY (`idTopup`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of topupredeem
-- ----------------------------

-- ----------------------------
-- Table structure for transaksidetail
-- ----------------------------
DROP TABLE IF EXISTS `transaksidetail`;
CREATE TABLE `transaksidetail` (
  `idTransDetail` int(11) NOT NULL AUTO_INCREMENT,
  `idTransHead` int(11) NOT NULL,
  `idBarang` int(11) NOT NULL,
  `jumlah` int(3) NOT NULL,
  `hargaSatuan` double(8,2) NOT NULL,
  PRIMARY KEY (`idTransDetail`),
  KEY `idTransHead` (`idTransHead`),
  KEY `idBarang` (`idBarang`),
  CONSTRAINT `transaksiDetail_ibfk_1` FOREIGN KEY (`idTransHead`) REFERENCES `transaksiheader` (`idTransaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transaksiDetail_ibfk_2` FOREIGN KEY (`idBarang`) REFERENCES `ms_barang` (`idBarang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of transaksidetail
-- ----------------------------

-- ----------------------------
-- Table structure for transaksiheader
-- ----------------------------
DROP TABLE IF EXISTS `transaksiheader`;
CREATE TABLE `transaksiheader` (
  `idTransaksi` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `tanggalTrans` date NOT NULL,
  `totalHarga` double(8,2) NOT NULL,
  `idBarang` int(11) NOT NULL,
  PRIMARY KEY (`idTransaksi`),
  KEY `userId` (`userId`),
  KEY `idBarang` (`idBarang`),
  CONSTRAINT `transaksiHeader_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transaksiHeader_ibfk_2` FOREIGN KEY (`idBarang`) REFERENCES `ms_barang` (`idBarang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of transaksiheader
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `roleId` int(2) NOT NULL,
  `balance` double(8,2) NOT NULL,
  PRIMARY KEY (`userId`),
  KEY `roleId` (`roleId`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roleId`) REFERENCES `roles` (`roleId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('2', 'admin', 'admin', 'Moch Arizal Fauzi', '1', '0.00');
INSERT INTO `users` VALUES ('3', 'siswa', 'siswa', 'Robby Prawira Eka Pasha', '3', '0.00');
INSERT INTO `users` VALUES ('4', 'penjual', 'penjual', 'Muhammad Andika Dayu Anglita Putra', '2', '0.00');
INSERT INTO `users` VALUES ('5', 'guru', 'guru', 'Rahmad Nakula Zanuar', '4', '0.00');

-- ----------------------------
-- Table structure for withdraw
-- ----------------------------
DROP TABLE IF EXISTS `withdraw`;
CREATE TABLE `withdraw` (
  `idWithdraw` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `nominal` double(8,2) NOT NULL,
  `tanggalWithd` date NOT NULL,
  PRIMARY KEY (`idWithdraw`),
  KEY `userId` (`userId`),
  CONSTRAINT `withdraw_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of withdraw
-- ----------------------------
