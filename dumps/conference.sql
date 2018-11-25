-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 25 nov. 2018 à 20:23
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `conference`
--

-- --------------------------------------------------------

--
-- Structure de la table `accompanying`
--

DROP TABLE IF EXISTS `accompanying`;
CREATE TABLE IF NOT EXISTS `accompanying` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firtname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `Reservation_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_83AB3ACE7556EF3F` (`Reservation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `accompanying`
--

INSERT INTO `accompanying` (`id`, `lastname`, `firtname`, `type`, `Reservation_id`) VALUES
(1, 'dqdq', 'dqdq', 1, 11),
(2, 'dqdq', 'dqdq', 1, 12),
(3, 'ddd', 'ddd', 1, 12),
(4, 'dsds', 'dsd', 2, 13),
(5, 'ssd', 'dsd', 1, 13),
(6, 'test', 'test', 1, 2),
(7, 'test', 'aaa', 0, 2),
(8, 'dqd', 'dqd', 1, 14),
(9, 'dqd', 'dqd', 1, 14),
(10, 'dqdq', 'dqdq', 1, 15),
(11, 'dqdq', 'dqd', 1, 15),
(12, 'qdq', 'dqd', 0, 15),
(13, 'sdsd', 'dsds', 0, 2),
(14, 'dada', 'dad', 0, 16),
(15, 'dsds', 'dsd', 0, 17),
(16, 'dsds', 'dsd', 0, 18),
(17, 'dsds', 'dsd', 0, 19),
(18, 'dsds', 'dsd', 0, 20),
(19, 'dsds', 'dsds', 0, 3),
(20, 'dqdqdq@gmail.com', 'dqdqdq@gmail.com', 0, 23),
(21, 'dqdqdq@gmail.com', 'dqdqdq@gmail.com', 0, 23),
(22, 'test', 'test', 1, 24),
(23, 'dsds', 'dsds', 1, 24);

-- --------------------------------------------------------

--
-- Structure de la table `configuration`
--

DROP TABLE IF EXISTS `configuration`;
CREATE TABLE IF NOT EXISTS `configuration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_expediteur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_expediteur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_direction` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_direction2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_agence` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `banque` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agence` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_compte_bancaire` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_swift` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_iban` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pays_id` int(11) NOT NULL,
  `ville_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A5E2A5D7A6E44244` (`pays_id`),
  KEY `IDX_A5E2A5D7A73F0036` (`ville_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `configuration`
--

INSERT INTO `configuration` (`id`, `logo`, `adresse`, `nom_expediteur`, `email_expediteur`, `telephone`, `fax`, `email_direction`, `email_direction2`, `email_agence`, `enabled`, `created_at`, `updated_at`, `banque`, `agence`, `num_compte_bancaire`, `code_swift`, `code_iban`, `pays_id`, `ville_id`) VALUES
(1, '', 'Rue Mohamed Ali Ennabi, 1080', 'Direction', 'karim@travelportal.cz', '216 70 24 44 20', '216 70 24 44 20', 'karim.travelportal.cz@gmail.com', 'karim.sahebettabaa@riadi.rnu.tn', 'karim@travelportal.cz', 1, '2018-10-15 00:00:00', '2018-10-17 15:06:22', 'BNA', 'Cite Ennasr', '12 12 12 12 12 12 12 12 12 12 36', '123456-456', '455-5655', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `devises`
--

DROP TABLE IF EXISTS `devises`;
CREATE TABLE IF NOT EXISTS `devises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coeff` double NOT NULL,
  `main` tinyint(1) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `devises`
--

INSERT INTO `devises` (`id`, `name`, `code`, `symbol`, `coeff`, `main`, `enabled`, `created_at`, `updated_at`) VALUES
(1, 'Dinars Tunisien', 'DT', 'TND', 1, 1, 1, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(2, 'Dollars', 'USD', '$', 2.7, 0, 1, '2018-10-21 14:22:55', '2018-10-29 10:08:55'),
(3, 'Afghanis', 'AFN', '؋', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(4, 'Pesos', 'ARS', '$', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(5, 'Guilders', 'AWG', 'ƒ', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(6, 'Dollars', 'AUD', '$', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(7, 'New Manats', 'AZN', 'ман', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(8, 'Dollars', 'BSD', '$', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(9, 'Dollars', 'BBD', '$', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(10, 'Rubles', 'BYR', 'p.', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(11, 'Euro', 'EUR', 'EUR', 0.3, 0, 1, '2018-10-21 14:22:55', '2018-10-30 09:49:36'),
(12, 'Dollars', 'BZD', 'BZ$', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(13, 'Dollars', 'BMD', '$', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(14, 'Bolivianos', 'BOB', '$b', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(15, 'Convertible Marka', 'BAM', 'KM', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(16, 'Pula', 'BWP', 'P', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(17, 'Leva', 'BGN', 'лв', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(18, 'Reais', 'BRL', 'R$', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(19, 'Pounds', 'GBP', '£', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(20, 'Dollars', 'BND', '$', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(21, 'Riels', 'KHR', '៛', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(22, 'Dollars', 'CAD', '$', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(23, 'Dollars', 'KYD', '$', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(24, 'Pesos', 'CLP', '$', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(25, 'Yuan Renminbi', 'CNY', '¥', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(26, 'Pesos', 'COP', '$', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(27, 'Colón', 'CRC', '₡', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(28, 'Kuna', 'HRK', 'kn', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(29, 'Pesos', 'CUP', '₱', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(30, 'Koruny', 'CZK', 'Kč', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(31, 'Kroner', 'DKK', 'kr', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(32, 'Pesos', 'DOP ', 'RD$', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(33, 'Dollars', 'XCD', '$', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(34, 'Pounds', 'EGP', '£', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(35, 'Colones', 'SVC', '$', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(36, 'Pounds', 'FKP', '£', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(37, 'Dollars', 'FJD', '$', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(38, 'Cedis', 'GHC', '¢', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(39, 'Pounds', 'GIP', '£', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(40, 'Quetzales', 'GTQ', 'Q', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(41, 'Pounds', 'GGP', '£', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(42, 'Dollars', 'GYD', '$', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(43, 'Lempiras', 'HNL', 'L', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(44, 'Dollars', 'HKD', '$', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(45, 'Forint', 'HUF', 'Ft', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(46, 'Kronur', 'ISK', 'kr', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(47, 'Rupees', 'INR', 'Rp', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(48, 'Rupiahs', 'IDR', 'Rp', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(49, 'Rials', 'IRR', '﷼', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(50, 'Pounds', 'IMP', '£', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(51, 'New Shekels', 'ILS', '₪', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(52, 'Dollars', 'JMD', 'J$', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(53, 'Yen', 'JPY', '¥', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(54, 'Pounds', 'JEP', '£', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(55, 'Tenge', 'KZT', 'лв', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(56, 'Won', 'KPW', '₩', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(57, 'Won', 'KRW', '₩', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(58, 'Soms', 'KGS', 'лв', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(59, 'Kips', 'LAK', '₭', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(60, 'Lati', 'LVL', 'Ls', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(61, 'Pounds', 'LBP', '£', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(62, 'Dollars', 'LRD', '$', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(63, 'Switzerland Francs', 'CHF', 'CHF', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(64, 'Litai', 'LTL', 'Lt', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(65, 'Denars', 'MKD', 'ден', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(66, 'Ringgits', 'MYR', 'RM', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(67, 'Rupees', 'MUR', '₨', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(68, 'Pesos', 'MXN', '$', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(69, 'Tugriks', 'MNT', '₮', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(70, 'Meticais', 'MZN', 'MT', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(71, 'Dollars', 'NAD', '$', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(72, 'Rupees', 'NPR', '₨', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(73, 'Guilders', 'ANG', 'ƒ', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(74, 'Dollars', 'NZD', '$', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(75, 'Cordobas', 'NIO', 'C$', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(76, 'Nairas', 'NGN', '₦', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(77, 'Krone', 'NOK', 'kr', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(78, 'Rials', 'OMR', '﷼', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(79, 'Rupees', 'PKR', '₨', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(80, 'Balboa', 'PAB', 'B/.', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(81, 'Guarani', 'PYG', 'Gs', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(82, 'Nuevos Soles', 'PEN', 'S/.', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(83, 'Pesos', 'PHP', 'Php', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(84, 'Zlotych', 'PLN', 'zł', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(85, 'Rials', 'QAR', '﷼', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(86, 'New Lei', 'RON', 'lei', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(87, 'Rubles', 'RUB', 'руб', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(88, 'Pounds', 'SHP', '£', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(89, 'Riyals', 'SAR', '﷼', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(90, 'Dinars', 'RSD', 'Дин.', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(91, 'Rupees', 'SCR', '₨', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(92, 'Dollars', 'SGD', '$', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(93, 'Dollars', 'SBD', '$', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(94, 'Shillings', 'SOS', 'S', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(95, 'Rand', 'ZAR', 'R', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(96, 'Rupees', 'LKR', '₨', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(97, 'Kronor', 'SEK', 'kr', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(98, 'Dollars', 'SRD', '$', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(99, 'Pounds', 'SYP', '£', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(100, 'New Dollars', 'TWD', 'NT$', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(101, 'Baht', 'THB', '฿', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(102, 'Dollars', 'TTD', 'TT$', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(103, 'Lira', 'TRY', 'TL', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(104, 'Liras', 'TRL', '£', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(105, 'Dollars', 'TVD', '$', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(106, 'Hryvnia', 'UAH', '₴', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(107, 'Pesos', 'UYU', '$U', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(108, 'Sums', 'UZS', 'лв', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(109, 'Bolivares Fuertes', 'VEF', 'Bs', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(110, 'Dong', 'VND', '₫', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(111, 'Rials', 'YER', '﷼', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55'),
(112, 'Zimbabwe Dollars', 'ZWD', 'Z$', 1, 0, 0, '2018-10-21 14:22:55', '2018-10-21 14:22:55');

-- --------------------------------------------------------

--
-- Structure de la table `documents`
--

DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `documents`
--

INSERT INTO `documents` (`id`, `designation`, `file`, `enabled`, `created_at`, `updated_at`) VALUES
(1, 'doc1', NULL, 1, '2018-10-21 00:00:00', '2018-11-17 23:10:50'),
(2, 'doc2', NULL, 1, '2018-10-21 00:00:00', '2018-11-17 23:10:50'),
(3, 'doc3', NULL, 1, '2018-10-21 00:00:00', '2018-11-17 23:10:50');

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` tinytext COLLATE utf8mb4_unicode_ci,
  `metadescription` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tweeter_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `designation_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation2_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_en` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays_id` int(11) NOT NULL,
  `ville_id` int(11) NOT NULL,
  `logo_facture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `program_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brochure_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5387574AA6E44244` (`pays_id`),
  KEY `IDX_5387574AA73F0036` (`ville_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id`, `designation`, `designation2`, `adresse`, `longitude`, `latitude`, `description`, `keywords`, `metadescription`, `facebook_link`, `google_link`, `tweeter_link`, `instagram_link`, `enabled`, `created_at`, `updated_at`, `designation_en`, `designation2_en`, `description_en`, `date_debut`, `date_fin`, `logo`, `pays_id`, `ville_id`, `logo_facture`, `program_file`, `brochure_file`) VALUES
(1, 'FANAF 2019', '43 eme ASSEMBLEE GENERALE DE LA FANAF', 'Laico Tunis, Place droit de l\'homme, Av. Mohamed V, Tunis', '36.939868', '10.2529585,15', '<p>he rapid technological changes witnessed in the world by digital discoveries and artificial intelligence or what is expressed by &quot;the Fourth Industrial Revolution&quot; will change the relationship of the human environment and will inevitably lead to a comprehensive change in the needs and ways to respond to them by economic and financial actors. The insurance sector will not be isolated from these transformations, which will enshrine the concept of the digital global village and there will be no land, country, sector or company deprived from these changes. The Organizing Committee hopes that this conference will be an occasion to examine the mechanisms of voluntary engagement in this digital revolution to serve our clients and to ensure the sustainability of the insurance industry in our countries. On behalf of all members of the Organizing Committee, we would like to welcome you in Hammamet and wish you a very pleasant stay in your country Tunisia.</p>', 'General Arab Insurance Federation, Gaif 2019', 'meta General Arab Insurance Federation, Gaif 2019', 'https://www.facebook.com/', 'https://www.facebook.com/', 'https://www.facebook.com/', 'https://www.facebook.com/', 1, '2018-10-17 00:00:00', '2018-11-18 12:08:30', 'FANAF 2019', NULL, '<p>he rapid technological changes witnessed in the world by digital discoveries and artificial intelligence or what is expressed by &ldquo;the Fourth Industrial Revolution&rdquo; will change the relationship of the human environment and will inevitably lead to a comprehensive change in the needs and ways to respond to them by economic and financial actors. The insurance sector will not be isolated from these transformations, which will enshrine the concept of the digital global village and there will be no land, country, sector or company deprived from these changes. The Organizing Committee hopes that this conference will be an occasion to examine the mechanisms of voluntary engagement in this digital revolution to serve our clients and to ensure the sustainability of the insurance industry in our countries. On behalf of all members of the Organizing Committee, we would like to welcome you in Hammamet and wish you a very pleasant stay in your country Tunisia.</p>', '2019-02-17 00:00:00', '2019-02-21 00:00:00', '06ce8cdd0f3c9e45e02e746c22012e6b.png', 1, 1, '5eaf41bbe7c814338cc6529feb9a5805.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `events_documents`
--

DROP TABLE IF EXISTS `events_documents`;
CREATE TABLE IF NOT EXISTS `events_documents` (
  `event_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  PRIMARY KEY (`event_id`,`document_id`),
  UNIQUE KEY `UNIQ_3B4417AAC33F7837` (`document_id`),
  KEY `IDX_3B4417AA71F7E88B` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `hotels`
--

DROP TABLE IF EXISTS `hotels`;
CREATE TABLE IF NOT EXISTS `hotels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ville_id` int(11) NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `services` longtext COLLATE utf8mb4_unicode_ci,
  `adresse` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categorie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E402F625A73F0036` (`ville_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `hotels`
--

INSERT INTO `hotels` (`id`, `ville_id`, `designation`, `description`, `services`, `adresse`, `categorie`, `longitude`, `latitude`, `enabled`, `created_at`, `updated_at`) VALUES
(1, 1, 'HOTEL NOVOTEL TUNIS', 'Au coeur du quartier des affaires de la ville, Cet hôtel 4 etoiles se situe à moins de quinze minutes en voiture de la medina et ses monuments historiques, a 5 km de laeroport de Tunis Carthage . Apres une visite riche en decouvertes, detendez-vous sur le toit-terrasse, au bord de la piscine. Pour vos reunions et seminaires, 14 salles sont à votre disposition. Le soir, laissez-vous seduire par la cuisine originale et moderne du restaurant', 'Equipements de l\'etablissement : HOTEL NOVOTEL TUNIS\r\nHebergement Telephone, Douche, Bain, SAT TV, Coffre fort, Refrigerateur, Baby cot ( Extra), Connexion internet WIFI, Connexion internet cable, CH Familiale grande Chambre, Lit supplementaire banquette, Air conditionne central Restauration Petit dejeuner Buffet, Restaurant à la carte, Bar, Room service Animation Piscine exterieure, Salle de sport Divers services Reception 24h/24h, Wifi Gratuit, Change, Centre SPA , Secretariat, Parking, Facilites pour Handicapes, Salle de reunion, Blanchisserie, Assenceur', '44 Avenue Mohamed V,', '4', '10.1838987,15', '36.8113758', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 'HOTEL ACROPOLE LES BERGES DU LAC', 'L hotel Acropole a ouvert ses portes en 2002. Il est situe a seulement 10 minutes de l aeroport de Tunis Carthage. A mi-chemin entre le grand Tunis, la Medina, et les centres touristiques et de loisirs de la banlieue nord de Tunis, tels que le village de Sidi Bou Saïd et les sites archeologiques de Carthage, l hotel Acropole est idealement situe.', 'Equipements de l\'etablissement : HOTEL ACROPOLE LES BERGES DU LAC\r\nHebergement Terrasse, Bain, TV, Coffre fort, Mini bar ( inclus), Coin salon, Seche cheveux Restauration Petit dejeuner Buffet, Dejeuner Buffet, Diner Buffet, Restaurant à la carte, Bar, Room service Animation Piscine exterieure Divers services Reception 24h/24h, Wifi Gratuit, Change, Parking, Salle de reuion, Asse', 'Rue Rodrigo De Freitas, 2045 Les Berges Du Lac ', '4', '10.2376679,17', '36.8344057', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 'HOTEL LAICO TUNIS', 'Le Laico Tunis vous accueille a Tunis, dans un batiment datant de 1990, a proximitÃ© de plusieurs lieux d\'intÃ©ret, tels que l\'avenue Habib Bourguiba et le theatre municipal.', NULL, 'Ave Mohamed V, Tunis', '5', '10.187057,15', '36.8072585', 1, '0000-00-00 00:00:00', '2018-10-17 10:19:55'),
(4, 1, 'HOTEL SHERATON', 'Le Sheraton Tunis Hotel surplombe toute la ville de Tunis. Il possÃ¨de un spa de luxe et un centre d\'affaires ouvert 24h/24.\r\n\r\nChaque chambre prÃ©sente une dÃ©coration Ã©lÃ©gante et bÃ©nÃ©ficie d\'un balcon privÃ©. Certaines d\'entre elles comprennent Ã©galement un accÃ¨s aux privilÃ©ges du salon-club.\r\n\r\nL\'hÃ´tel vous propose plusieurs restaurants, dont le Walima, qui sert une cuisine tunisienne. Vous pourrez en outre dÃ©guster des plats italiens authentiques Ã  l\'Azzuro.\r\n\r\nVous profiterez par ailleurs de soins de beautÃ© et de santÃ©, prodiguÃ©s par les professionnels du spa. Vous apprÃ©cierez aussi la piscine extÃ©rieure et le centre de remise en forme.\r\n\r\nVous bÃ©nÃ©ficierez d\'un parking privÃ© et gratuit sur place. De plus, la rÃ©ception ouverte 24h/24 vous fournira des informations touristiques locales.', 'Connexion Wi-Fi gratuite,  Navette aÃ©roport, Piscine,  Parking gratuit,  Chambres familiales,  Spa et centre de bien-Ãªtre,  Bar', 'B.P. 345, Avenue de la Ligue Arabe, Tunis 1080', '4', '10.1606623,15', '36.8311401', 1, '0000-00-00 00:00:00', '2018-10-17 10:24:10'),
(5, 1, 'GOLDEN TULIP EL MECHTEL', 'ss', 'ss', 'Avenue Ouled Hafouz, Tunis 1005', '4', '10.1739551,15', '36.8135896', 1, '0000-00-00 00:00:00', '2018-10-17 10:24:45');

-- --------------------------------------------------------

--
-- Structure de la table `hotel_categories`
--

DROP TABLE IF EXISTS `hotel_categories`;
CREATE TABLE IF NOT EXISTS `hotel_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `hotel_images`
--

DROP TABLE IF EXISTS `hotel_images`;
CREATE TABLE IF NOT EXISTS `hotel_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hotel_id` int(11) DEFAULT NULL,
  `main` tinyint(1) NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7CF56C0D3243BB18` (`hotel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `hotel_images`
--

INSERT INTO `hotel_images` (`id`, `hotel_id`, `main`, `designation`, `picture`, `enabled`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Bar', 'hotel_acropole_bar.jpg', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 0, 'Chambre', 'hotel_acropole_chambre.jpg', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 2, 0, 'Chambre Suite', 'hotel_acropole_chambre2.jpg', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 2, 0, 'Réception', 'hotel_acropole_reception.jpg', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, 0, 'Chambre', 'hotel_novotel_chambre.jpg', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 1, 0, 'hotel_novotel_chambre', '6e6c13ad34d2536ee6f46e99c5ac1dd6.jpeg', 1, '0000-00-00 00:00:00', '2018-10-29 10:29:41'),
(7, 1, 0, 'Salle de Sport', 'hotel_novotel_fitness.jpg', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 1, 0, 'Restaurant', 'hotel_novotel_restaurant.jpg', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 1, 1, 'Vue extérieure', 'hotel_novotel_vue_exterieure.jpg', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 4, 1, 'Vue Piscine', '4903b9e2f3d368852df5d49a64165873.jpeg', 1, '2018-10-20 13:31:51', '2018-10-20 13:31:51'),
(11, 4, 0, 'Acceuil', 'a63aacb11f20802ca288d91ca28b9fd1.jpeg', 1, '2018-10-20 13:32:13', '2018-10-20 13:32:13'),
(12, 4, 0, 'Chambre', 'afe14e3a4155a418a99ab986745f360d.jpeg', 1, '2018-10-20 13:32:33', '2018-10-20 13:32:33'),
(13, 4, 0, 'Suite', '1642854e2e415e1340a267709ea1d9ee.jpeg', 1, '2018-10-20 13:32:58', '2018-10-20 13:32:58'),
(14, 4, 0, 'Piscine Interne', 'e84a7a62ff5f096f33970d6c467ffcc4.jpeg', 1, '2018-10-20 13:33:23', '2018-10-20 13:33:23'),
(15, 3, 1, 'Vue ExtÃ©rieure', '7cda2d268f212ec30a627d123656163c.jpeg', 1, '2018-10-29 10:03:07', '2018-10-29 10:04:12'),
(16, 3, 0, 'Chambre', '825e3cd9ae4229717c88b5bfb0ba7a44.jpeg', 1, '2018-10-29 10:04:35', '2018-10-29 10:04:35'),
(17, 3, 0, 'Suite', '4757a58645c33c582a68fb9fc6778902.jpeg', 1, '2018-10-29 10:04:58', '2018-10-29 10:04:58'),
(18, 3, 0, 'Acceuil', 'fcc8884cbf213acda881f76527153a62.jpeg', 1, '2018-10-29 10:05:52', '2018-10-29 10:05:52'),
(19, 3, 0, 'Aceuil2', '9347d0a66fc09233e442fda48dd911ee.jpeg', 1, '2018-10-29 10:06:15', '2018-10-29 10:06:15');

-- --------------------------------------------------------

--
-- Structure de la table `hotel_package`
--

DROP TABLE IF EXISTS `hotel_package`;
CREATE TABLE IF NOT EXISTS `hotel_package` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hotel_id` int(11) DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_personnes` int(11) NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D2279BC3243BB18` (`hotel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `hotel_package`
--

INSERT INTO `hotel_package` (`id`, `hotel_id`, `designation`, `nb_personnes`, `picture`, `enabled`, `created_at`, `updated_at`) VALUES
(1, 1, 'Chambre Double en petit Dejeuner', 2, 'hotel_novotel_chambre.jpg', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 'Chambre Single en petit Dejeuner', 1, 'hotel_novotel_chambre.jpg', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 2, 'Chambre Double en petit dejeuner', 2, 'hotel_acropole_chambre.jpg', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 2, 'Chambre Single en petit dejeuner', 1, 'hotel_acropole_chambre.jpg', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 4, 'Chambre Single en Petit DÃ©jeuner', 1, '95673d30cd4251816692933219001fc4.jpeg', 1, '2018-10-20 13:35:30', '2018-10-20 13:35:30');

-- --------------------------------------------------------

--
-- Structure de la table `hotel_package_periode`
--

DROP TABLE IF EXISTS `hotel_package_periode`;
CREATE TABLE IF NOT EXISTS `hotel_package_periode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` int(11) DEFAULT NULL,
  `prix_achat` double NOT NULL,
  `comission` double NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_ADD6FA12F44CABFF` (`package_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `hotel_package_periode`
--

INSERT INTO `hotel_package_periode` (`id`, `package_id`, `prix_achat`, `comission`, `date_debut`, `date_fin`, `enabled`, `created_at`, `updated_at`) VALUES
(1, 1, 120, 30, '2019-02-16 00:00:00', '2019-02-24 00:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 200, 30, '2019-02-16 00:00:00', '2019-02-24 00:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 3, 300, 30, '2019-02-16 00:00:00', '2019-02-24 00:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 4, 400, 30, '2019-02-16 00:00:00', '2019-02-24 00:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 5, 120, 20, '2019-02-01 00:00:00', '2019-02-28 00:00:00', 1, '2018-10-20 13:36:58', '2018-10-20 13:36:58');

-- --------------------------------------------------------

--
-- Structure de la table `hotel_reservation_package`
--

DROP TABLE IF EXISTS `hotel_reservation_package`;
CREATE TABLE IF NOT EXISTS `hotel_reservation_package` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reservation_hotel_id` int(11) DEFAULT NULL,
  `hotel_package_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_64F73821AFF6590C` (`reservation_hotel_id`),
  KEY `IDX_64F7382181984112` (`hotel_package_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `hotel_reservation_package`
--

INSERT INTO `hotel_reservation_package` (`id`, `reservation_hotel_id`, `hotel_package_id`, `quantity`) VALUES
(1, 1, 3, 1),
(2, 2, 3, 1),
(3, 3, 2, 1),
(4, 4, 1, 1),
(5, 5, 1, 1),
(6, 6, 1, 1),
(7, 7, 1, 1),
(8, 8, 3, 1),
(9, 8, 4, 1),
(10, 9, 1, 1),
(11, 10, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id`, `path`, `name`, `size`, `enabled`, `created_at`, `updated_at`) VALUES
(1, 'Jaloul-Ayed-01-352x352.jpg', 'Jalloul', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Mme-Lamia-352x352.jpg', 'Lamia', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `journees`
--

DROP TABLE IF EXISTS `journees`;
CREATE TABLE IF NOT EXISTS `journees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C569465471F7E88B` (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `journees`
--

INSERT INTO `journees` (`id`, `designation`, `designation_en`, `enabled`, `created_at`, `updated_at`, `event_id`, `date`) VALUES
(1, 'Journee 1', 'Day 1', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-02-17 00:00:00'),
(2, 'Journee 2', 'Day 2', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-02-18 00:00:00'),
(3, 'Journee  3', 'Day 3', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-02-19 00:00:00'),
(4, 'Journee 4', 'Day 4', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-02-20 00:00:00'),
(5, 'Journee 5', 'Day 5', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-02-21 00:00:00'),
(6, 'Journée 6', 'Day 6', 1, '2018-10-20 14:32:14', '2018-10-20 14:32:14', 1, '2018-10-23 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `journees_images`
--

DROP TABLE IF EXISTS `journees_images`;
CREATE TABLE IF NOT EXISTS `journees_images` (
  `journee_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  PRIMARY KEY (`journee_id`,`document_id`),
  UNIQUE KEY `UNIQ_C2067634C33F7837` (`document_id`),
  KEY `IDX_C2067634CF066148` (`journee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `menus`
--

INSERT INTO `menus` (`id`, `title`, `title_en`, `link`, `enabled`, `created_at`, `updated_at`, `order`) VALUES
(1, 'Présentation', 'About Us', '#csi-about', 1, '2018-10-21 10:17:54', '2018-10-26 09:10:21', 0),
(2, 'Programme', 'Program', '#csi-schedule', 1, '2018-10-21 10:18:47', '2018-10-21 13:56:13', 0),
(3, 'Intervenants', 'Speakers', '#csi-speakers', 1, '2018-10-21 10:19:14', '2018-10-21 10:19:14', 0),
(4, 'Sponsors', 'Sponsors', '#csi-sponsors', 1, '2018-10-21 10:19:48', '2018-10-21 10:19:48', 0),
(5, 'Conférence', 'Conference', '#csi-registration', 1, '2018-10-21 10:20:58', '2018-11-20 20:57:04', 0),
(6, 'Liste des participants', 'List of participants', 'participants', 1, '2018-10-21 10:22:36', '2018-11-20 21:00:09', 0),
(7, 'Informations', 'Informations', NULL, 1, '2018-10-21 13:34:38', '2018-11-21 20:43:17', 0);

-- --------------------------------------------------------

--
-- Structure de la table `motifs`
--

DROP TABLE IF EXISTS `motifs`;
CREATE TABLE IF NOT EXISTS `motifs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_path` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `motifs`
--

INSERT INTO `motifs` (`id`, `property_path`, `class_path`, `enabled`, `created_at`, `updated_at`) VALUES
(1, 'recipient_gender', '\\App\\Entity\\Participant', 1, '2018-09-29 10:38:20', '2018-09-29 10:38:20'),
(2, 'recipient_firstname', '\\App\\Entity\\Participant', 1, '2018-09-29 10:38:20', '2018-09-29 10:38:20'),
(3, 'recipient_lastname', '\\App\\Entity\\Participant', 1, '2018-09-29 10:38:20', '2018-09-29 10:38:20'),
(4, 'recipient_username', '\\App\\Entity\\Participant', 1, '2018-09-29 10:38:20', '2018-09-29 10:38:20'),
(5, 'recipient_email', '\\App\\Entity\\Participant', 1, '2018-09-29 10:38:20', '2018-09-29 10:38:20'),
(6, 'participant_gender', '\\App\\Entity\\Participant', 1, '2018-09-29 10:38:20', '2018-09-29 10:38:20'),
(7, 'participant_firstname', '\\App\\Entity\\Participant', 1, '2018-09-29 10:38:20', '2018-09-29 10:38:20'),
(8, 'participant_lastname', '\\App\\Entity\\Participant', 1, '2018-09-29 10:38:20', '2018-09-29 10:38:20'),
(9, 'participant_username', '\\App\\Entity\\Participant', 1, '2018-09-29 10:38:20', '2018-09-29 10:38:20'),
(10, 'recipient_gender', '\\App\\Entity\\Participant', 1, '2018-10-13 12:23:36', '2018-10-13 12:23:36'),
(11, 'recipient_firstname', '\\App\\Entity\\Participant', 1, '2018-10-13 12:23:36', '2018-10-13 12:23:36'),
(12, 'recipient_lastname', '\\App\\Entity\\Participant', 1, '2018-10-13 12:23:36', '2018-10-13 12:23:36'),
(13, 'recipient_username', '\\App\\Entity\\Participant', 1, '2018-10-13 12:23:36', '2018-10-13 12:23:36'),
(14, 'recipient_email', '\\App\\Entity\\Participant', 1, '2018-10-13 12:23:36', '2018-10-13 12:23:36'),
(15, 'participant_gender', '\\App\\Entity\\Participant', 1, '2018-10-13 12:23:36', '2018-10-13 12:23:36'),
(16, 'participant_firstname', '\\App\\Entity\\Participant', 1, '2018-10-13 12:23:36', '2018-10-13 12:23:36'),
(17, 'participant_lastname', '\\App\\Entity\\Participant', 1, '2018-10-13 12:23:36', '2018-10-13 12:23:36'),
(18, 'participant_username', '\\App\\Entity\\Participant', 1, '2018-10-13 12:23:36', '2018-10-13 12:23:36');

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notification_type` int(11) DEFAULT NULL,
  `subject` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id`, `notification_type`, `subject`, `description`, `enabled`, `created_at`, `updated_at`) VALUES
(1, 1, 'Inscription destinÃ© aux administrateurs', 'Bonjour,<br />Lâ€™utilisateur %participant_gender% %participant_lastname% %participant_firstname% a Ã©tÃ© crÃ©Ã©', 1, '2018-09-29 10:38:20', '2018-09-29 10:38:20'),
(2, 2, 'Bienvenue', 'Cher(e) %recipient_gender% %recipient_lastname% %recipient_firstname%,<br />Merci pour votre intÃ©rÃªt pour [MÃ©tier : CONF 2018], nous vous souhaitons la bienvenue.', 1, '2018-09-29 10:38:20', '2018-09-29 10:38:20'),
(3, 3, 'Inscription associÃ© destinÃ© aux administrateurs', 'Bonjour,<br />Lâ€™utilisateur %participant_gender% %participant_lastname% %participant_firstname% a Ã©tÃ© associÃ© Ã  lâ€™application mÃ©tier CONF 2018', 1, '2018-09-29 10:38:20', '2018-09-29 10:38:20'),
(4, 1, 'Inscription destinÃ© aux administrateurs', 'Bonjour,<br />Lâ€™utilisateur %participant_gender% %participant_lastname% %participant_firstname% a Ã©tÃ© crÃ©Ã©', 1, '2018-10-13 12:23:36', '2018-10-13 12:23:36'),
(5, 2, 'Bienvenue', 'Cher(e) %recipient_gender% %recipient_lastname% %recipient_firstname%,<br />Merci pour votre intÃ©rÃªt pour [MÃ©tier : CONF 2018], nous vous souhaitons la bienvenue.', 1, '2018-10-13 12:23:36', '2018-10-13 12:23:36'),
(6, 3, 'Inscription associÃ© destinÃ© aux administrateurs', 'Bonjour,<br />Lâ€™utilisateur %participant_gender% %participant_lastname% %participant_firstname% a Ã©tÃ© associÃ© Ã  lâ€™application mÃ©tier CONF 2018', 1, '2018-10-13 12:23:36', '2018-10-13 12:23:36');

-- --------------------------------------------------------

--
-- Structure de la table `notification_has_pattern`
--

DROP TABLE IF EXISTS `notification_has_pattern`;
CREATE TABLE IF NOT EXISTS `notification_has_pattern` (
  `notification_id` int(11) NOT NULL,
  `pattern_id` int(11) NOT NULL,
  PRIMARY KEY (`notification_id`,`pattern_id`),
  KEY `IDX_11D6A714EF1A9D84` (`notification_id`),
  KEY `IDX_11D6A714F734A20F` (`pattern_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `notification_has_pattern`
--

INSERT INTO `notification_has_pattern` (`notification_id`, `pattern_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 6),
(1, 7),
(1, 8),
(2, 1),
(2, 2),
(2, 3),
(2, 6),
(2, 7),
(2, 8),
(3, 1),
(3, 2),
(3, 3),
(3, 6),
(3, 7),
(3, 8),
(4, 1),
(4, 2),
(4, 3),
(4, 6),
(4, 7),
(4, 8),
(5, 1),
(5, 2),
(5, 3),
(5, 6),
(5, 7),
(5, 8),
(6, 1),
(6, 2),
(6, 3),
(6, 6),
(6, 7),
(6, 8);

-- --------------------------------------------------------

--
-- Structure de la table `organization`
--

DROP TABLE IF EXISTS `organization`;
CREATE TABLE IF NOT EXISTS `organization` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pays_id` int(11) DEFAULT NULL,
  `society` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C1EE637CA6E44244` (`pays_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `organization`
--

INSERT INTO `organization` (`id`, `pays_id`, `society`) VALUES
(1, 1, 'test'),
(2, 3, 'test2'),
(3, 5, 'test3');

-- --------------------------------------------------------

--
-- Structure de la table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_en` longtext COLLATE utf8mb4_unicode_ci,
  `slug` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug_en` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2074E5752B36786B` (`title`),
  UNIQUE KEY `UNIQ_2074E57546FF21AF` (`title_en`),
  UNIQUE KEY `UNIQ_2074E575989D9B62` (`slug`),
  UNIQUE KEY `UNIQ_2074E5757D79C0DC` (`slug_en`),
  KEY `IDX_2074E575CCD7E912` (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pages`
--

INSERT INTO `pages` (`id`, `title`, `summary`, `content`, `enabled`, `created_at`, `updated_at`, `title_en`, `summary_en`, `content_en`, `slug`, `slug_en`, `menu_id`) VALUES
(1, 'Bienvenue', 'On the land of Tunisia,The land of meetings and civilizations,', '<p>The Tunisian Federation of Insurance companies FTUSA, the General Arab Insurance Federation GAIF and the Tunisian Reinsurance Company Tunis RE, have the honor to invite you to attend the 32nd General Conference from 24 to 27 June 2018 in Hammamet, under the high patronage of his Excellency the President of the Republic of Tunisia. The conference is organized under the theme: Digital Transformation and the Insurance Industry in the Arab World</p>', 1, '2018-10-03 00:00:00', '2018-10-21 13:39:55', 'Welcome', 'the high patronage of his Excellency the Presid', '<p>The rapid technological changes witnessed in the world by digital discoveries and artificial intelligence or what is expressed by the Fourth Industrial Revolution will change the relationship of the human environment and will inevitably lead to a comprehensive change in the needs and ways to respond to them by economic and financial actors. The insurance sector will not be isolated from these transformations, which will enshrine the concept of the digital global village and there will be no land, country, sector or company deprived from these changes. The Organizing Committee hopes that this conference will be an occasion to examine the mechanisms of voluntary engagement in this digital revolution to serve our clients and to ensure the sustainability of the insurance industry in our countries. On behalf offfffffffffffffffff</p>', 'bienvenue', 'welcome', 7),
(2, 'Visa', 'and to facilitate the process of o', '<p>General Entry requirements for international visitors You are Kindly requested to send to the Tunisian Federation Of Insurance Companies (FTUSA) as soon as possible a copy of your passport and these information to facilitate the obtain of the entry visa to Tunisia from 24th to 27 th June 2018 to attend the 32nd General Conference of the Arab Insurance Union which will be held in Hammamet. In case of the absence of diplomatic consuls or diplomatic representation in your country, the visa could be</p>\r\n\r\n<p><img alt=\"\" src=\"https://lemag.nikonclub.fr/wp-content/uploads/2017/07/08.jpg\" style=\"height:1278px; width:1920px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>handed by the border police stations in Tunisia. This visa is granted and its fees are about 15$ US and they should be paid in Tunisian dinar. For this purpose and to facilitate the process of obtaining the entry visa to the Tunisian country, please provide the Tunisian Federation of insurance companies before the 31st May, 2018 the requested information: Download VISA document</p>\r\n\r\n<p>&nbsp;</p>', 1, '2018-10-03 00:00:00', '2018-10-21 15:10:13', 'Visa_eng', 'btain of the entry visa to Tunisia f', '<p>General Entry requirements for international visitors You are Kindly requested to send to the Tunisian Federation Of Insurance Companies (FTUSA) as soon as possible a copy of your passport and these information to facilitate the obtain of the entry visa to Tunisia from 24th to 27 th June 2018 to attend the 32nd General Conference of the Arab Insurance Union which will be held in Hammamet. In case of the absence of diplomatic consuls or diplomatic representation in your country, the visa could be handed by the border police stations in Tunisia. This visa is granted and its fees are about 15$ US and they should be paid in Tunisian dinar. For this purpose and to facilitate the process of obtaining the entry visa to the Tunisian country, please provide the Tunisian Federation of insurance companies before the 31st May, 2018 the requested information: &gt;&gt; Download VISA document</p>', 'visa', 'visa', 7),
(3, 'Information', 'her major attraction is the magnificent Bardo Museum, famous for its exceptional collection of Roman mosaics.', 'Connected to the North and South of the country by two motorways and located at the heart of a region full of archaeological sites and places of interest, Tunis is a natural starting point for a whole variety of excursions. Visitors to the capital should allow enough time to explore its medina, monuments (the Great Mosque, the Tourbet El-Bey Mausoleum), palaces and souks, which contain a plethora of temptations. Another major attraction is the magnificent Bardo Museum, famous for its exceptional collection of Roman mosaics.', 1, '2018-10-03 00:00:00', '2018-10-03 00:00:00', 'Infor_eng', 'archaeological s', 'Connected to the North and South of the country by two motorways and located at the heart of a region full of archaeological sites and places of interest, Tunis is a natural starting point for a whole variety of excursions. Visitors to the capital should allow enough time to explore its medina, monuments (the Great Mosque, the Tourbet El-Bey Mausoleum), palaces and souks, which contain a plethora of temptations. Another major attraction is the magnificent Bardo Museum, famous for its exceptional collection of Roman mosaics.', 'information', 'information', NULL),
(4, 'Espace publicitaire', 'ffdf', '<p>jjjjjjjjjjjjjjjjjjjjjjj<s><strong>jjjjjjjjjjjjjjjjjjjjjj</strong></s></p>\r\n\r\n<p>&nbsp;</p>', 1, '2018-10-20 14:54:41', '2018-10-20 14:54:41', 'Stand', 'jjjjjjjjjjjjjj', '<p>sqfdqsdqsd</p>', 'espace-publicitaire', 'stand', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `participants`
--

DROP TABLE IF EXISTS `participants`;
CREATE TABLE IF NOT EXISTS `participants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `participant_type_id` int(11) DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `societe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `poste` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `biographie` longtext COLLATE utf8mb4_unicode_ci,
  `tweeter_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_arrive` datetime DEFAULT NULL,
  `date_depart` datetime DEFAULT NULL,
  `num_vol_arrive` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_vol_depart` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationalite` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pays_id` int(11) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_postal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `heure_arrival` time DEFAULT NULL,
  `heure_departure` time DEFAULT NULL,
  `nb_accompanying` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_71697092E7927C74` (`email`),
  UNIQUE KEY `UNIQ_71697092989D9B62` (`slug`),
  KEY `IDX_716970925F41439B` (`participant_type_id`),
  KEY `IDX_71697092A6E44244` (`pays_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `participants`
--

INSERT INTO `participants` (`id`, `participant_type_id`, `firstname`, `lastname`, `username`, `password`, `email`, `societe`, `poste`, `telephone`, `biographie`, `tweeter_link`, `linkedin_link`, `telephone2`, `salt`, `enabled`, `created_at`, `updated_at`, `picture`, `slug`, `date_arrive`, `date_depart`, `num_vol_arrive`, `num_vol_depart`, `nationalite`, `gender`, `pays_id`, `address`, `code_postal`, `country`, `heure_arrival`, `heure_departure`, `nb_accompanying`) VALUES
(2, 7, 'Jalloul', 'Ayed', 'Jalloul', 'Jalloul', 'Ahmed@tt.com', 'Societe AJalloul', 'Poste JAlloul', '213 564 789', 'Biobliographie Jalloul Ayed', NULL, NULL, NULL, '', 1, '2018-10-30 00:00:00', '2018-10-30 00:00:00', 'Jaloul-Ayed-01-352x352.jpg', 'jalloul-ayed', NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 7, 'Lamia', 'Ben Mahmoud', 'Lamia', 'Lamia', 'Lamia@test.com', 'Societe Lamia', 'Poste Lamia', '123456', 'Bibliographie Lamia', NULL, NULL, NULL, '', 1, '2018-10-30 00:00:00', '2018-10-30 00:00:00', 'Mme-Lamia-352x352.jpg', 'lamia-ben-mahmoud', NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 7, 'Laurant', 'Motador', 'Laurant', 'Laurant', 'Laurant@test.com', 'Société Laurant', 'Poste Laurant', '21345989', 'Bibliographie Laurant', NULL, NULL, NULL, '', 1, '2018-10-30 00:00:00', '2018-10-30 00:00:00', 'Mondatorts-352x352-352x352.jpg', 'laurant-matador', NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 7, 'Jose', 'Castelo', 'Castelo', 'Castelo', 'Castelo@test.com', 'Societe Castelo', 'Poste Castelo', 'Tel Castelo', 'Bobliographie Castelo', NULL, NULL, NULL, '', 1, '2018-10-30 00:00:00', '2018-10-30 00:00:00', 'Jose-Castelo-352x352.jpg', 'jose-castelo', NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 7, 'Andreas', 'Pollman', 'Pollman', 'Pollman', 'Pollman@test.com', 'Societe Pollman', 'Poste Pollman', '45612233', 'Bibliographie Pollman', NULL, NULL, NULL, '', 1, '2018-10-30 00:00:00', '2018-10-30 00:00:00', 'poulman-352x352.jpg', 'andreas-pollman', NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 6, 'karim', 'Sahab Ettabaa', 'karim@travelportal.cz', '$2y$13$74nFRU3KHDhvXgBkZpQopeUBPkxIFlrWqxRgNbF2k17PlBG.TZ1r6', 'karim@travelportal.cz', 'Conf2018', 'Poste Conf2018', '+216000000', 'Bibliographie Karim', 'dqdq', 'dqdqd', '+216000000', '61448c131018ac4be617224f51cda16d', 1, '2018-10-13 12:23:36', '2018-11-20 23:15:42', '', 'karim-sahab-ettabaa', '2018-10-30 00:00:00', '2018-10-30 00:00:00', 'dfsdf', 'sdfsdf', 'Tunisienne', 'M', 20, 'dqdq', 'dqdqdq', 'dqdq', NULL, NULL, NULL),
(18, 6, 'dadad', 'dd', 'salah.bensofiene@gmail.com', '$2y$13$bi4bUewi2.l/jo9DRkNBT.Oq/p.LlyqXLD6UeZt/eoRZuGQNqhFIy', 'wessim11@gmail.com', 'zzerre', 'zerzer', 'dada', NULL, NULL, NULL, NULL, '4f356336c550a87d093ea93b1a0b7635', 1, '2018-11-18 14:38:19', '2018-11-19 17:10:14', NULL, 'dadad-dd', '2019-02-06 00:00:00', '2018-11-19 00:00:00', 'dada', 'dadada', 'rezrezrz', NULL, 25, '65465', '250', '11221', '17:14:00', '11:16:00', NULL),
(19, 6, 'cqcqcq', 'cqcq', 'aaaa@aaa.com', '$2y$13$jrFY1oMsxYVFVw.WkAXCdeDmR.WOQc4fjVzkMomzYoIdlDD9EmIIu', 'ssssssss@ssss.comm', 'test', '57575', 'dada', NULL, NULL, NULL, NULL, '343b9d3528ae3827803e8e2c452eddc4', 1, '2018-11-18 20:04:47', '2018-11-20 14:25:40', NULL, 'cqcqcq-cqcq', '2018-11-20 00:00:00', '2018-11-20 00:00:00', 'rezrzer', '12', 'rezrezrz', NULL, 30, '65465', '250', '11221', '18:17:00', '20:10:00', 1),
(20, 6, 'tests', 'test', 'ac@ac.com', '$2y$13$4.nbckOJauSCXdaNiYYx5OId6dvhu41AUJYikhrY0ItdLgM8mGWve', 'ac@ac.com', 'test', 'zerzer', '54343453', NULL, NULL, NULL, NULL, '9f8dadd960a527f586cea8be166f9de7', 1, '2018-11-18 20:24:46', '2018-11-20 19:33:43', NULL, 'tests-test', '2018-11-27 00:00:00', '2018-11-14 00:00:00', '7878', 'zerzer', 'rezrezrz', NULL, 38, '65465', '250', '11221', '01:03:00', '22:16:00', 1),
(21, 6, 'ouali', 'ouali', 'acacc@dacadc.com', '$2y$13$oovWsrxI511Lc2w4XFoO4.Hy5nmxXS2AB/GMReZzzngyShNK83CNK', 'acacc@dacadc.com', '1', 'acacc@dacadc.com', 'dcadcadc', NULL, NULL, NULL, NULL, '9b715b284e38172767e0ec6a15582963', 1, '2018-11-18 20:50:21', '2018-11-18 20:50:21', NULL, 'ouali-ouali-1', '2018-11-20 00:00:00', '2018-11-27 00:00:00', 'rezrzer', 'acacc@dacadc.com', 'acacc@dacadc.com', NULL, 17, NULL, 'acacc@dacadc.com', 'acacc@dacadc.com', '16:15:00', '17:19:00', NULL),
(22, 6, 'cdacdac', 'dacdca', 'achacdadca@ac.com', '$2y$13$FESJC.x24KmiMAKRLDqfsuDvWdNnOfUKOlu4yAajqkZzK07GJezv2', 'achacdadca@ac.com', 'test2', 'zerzer', '2546565', NULL, NULL, NULL, NULL, 'ee233d9d67859e35cd361701c69476ed', 1, '2018-11-18 20:55:21', '2018-11-18 20:55:21', NULL, 'cdacdac-dacdca', '2018-11-19 00:00:00', '2018-11-21 00:00:00', '4564', '6464', 'achacdadca@ac.com', NULL, 18, 'achacdadca@ac.com', 'achacdadca@ac.com', 'achacdadca@ac.com', '16:16:00', '16:15:00', NULL),
(23, 6, 'hmaz', 'hmaz', 'hmaz@hmaz.com', '$2y$13$cG6/SLC7j4m7R6KMkgcEsOD5a7dv1EIk/qv8aS/8Xc90BrC1SXKdG', 'hmaz@hmaz.com', 'test2', NULL, '1554125', NULL, NULL, NULL, NULL, 'ce5c85c6c2f10e20d857ad8a52c8c655', 1, '2018-11-19 11:31:04', '2018-11-19 11:31:04', NULL, 'hmaz-hmaz', '2018-12-18 00:00:00', '2018-11-14 00:00:00', 'hmaz@hmaz.com', '12', 'rezrezrz', NULL, 19, '65465', '2400', 'hmaz@hmaz.com', '17:16:00', '16:17:00', NULL),
(24, 6, 'dhimi', 'hamza', 'achrefouali@gmail.com', '$2y$13$VqCLZ7hqEIDnD4HMdRc6vuLabZ3n4xAA69HreDEOp9DcVJTM.10xK', 'hamza.dghimi@gmail.com', 'test', 'zerzer', '125455', NULL, NULL, NULL, NULL, '51c23993b5b2a29c0965c67200a63c9d', 1, '2018-11-19 11:32:55', '2018-11-19 11:32:55', NULL, 'dhimi-hamza', '2018-11-19 00:00:00', '2018-11-21 00:00:00', '7878', '12', 'dada', NULL, 20, 'dhimi', '2500', 'dhimi', '00:01:00', '03:06:00', NULL),
(25, 6, 'dadada', 'dadadad', 'ac@acacdadad.com', '$2y$13$MuvDn6W4eboci/9NjDqHC.QO1uGjWRtBmSvf139bQQZNCEQm9KYLe', 'ac@acacdadad.com', 'dadada', 'zerzer', '444', NULL, NULL, NULL, NULL, '2622895ea8f97ac345bcf6c3b3d85cbd', 1, '2018-11-19 11:42:59', '2018-11-19 11:42:59', NULL, 'dadada-dadadad', '2018-11-21 00:00:00', '2018-11-22 00:00:00', '10', '10', 'rezrezrz', NULL, 21, 'fdfdf', '2500', '11221', '01:07:00', '14:17:00', NULL),
(26, 6, 'dada', 'dadad', 'acaca@acacdada.com', '$2y$13$i79XXy9YJpDquGQNxIdR2uPq63VtBcpx8J0voi0xaMuKC8XcimGRG', 'acaca@acacdada.com', 'test2', 'sdsds', '45454', NULL, NULL, NULL, NULL, '4fbd05a37a2d9cadb6088c8d19617612', 1, '2018-11-19 17:04:16', '2018-11-19 17:04:16', NULL, 'dada-dadad', '2018-11-27 00:00:00', '2018-11-15 00:00:00', 'rezrzer', '12', 'rezrezrz', NULL, 22, 'fdfdf', '250', 'acacc@dacadc.com', '00:01:00', '02:05:00', NULL),
(27, 6, 'dada', 'aaaa', 'ak@ak.com', '$2y$13$7WVp7vfrKfbl6t3QR8lgNuI4pkdDq83PuMbxjaTwU.Jfvj23z4BwO', 'ak@ak.com', NULL, 'sdsds', '5454', NULL, NULL, NULL, NULL, 'e2dbc075e4a7e6f9f9377b4cb15e1138', 1, '2018-11-19 17:06:47', '2018-11-19 17:06:47', NULL, 'dada-aaaa', '2018-11-20 00:00:00', '2018-11-22 00:00:00', 'rezrzer', 'daada', 'rezrezrz', NULL, 23, '65465', '250', '11221', '16:16:00', '17:18:00', NULL),
(28, 6, 'adada', 'dadad', 'dadada@dada.com', '$2y$13$1COHXpkEifWUOe5LzWCzweaqkOZYkd6kzKEtYBmE/VgaC.DtFkTcK', 'dadada@dada.com', 'test', 'sdsdsd', 'dsdsds', NULL, NULL, NULL, NULL, '6b8253c503577e724e256f004636b09a', 1, '2018-11-19 17:09:27', '2018-11-19 17:09:27', NULL, 'adada-dadad', '2018-12-05 00:00:00', '2018-11-23 00:00:00', 'hmaz@hmaz.com', '475454', 'rezrezrz', NULL, 24, '65465', '250', '11221', '17:18:00', '14:17:00', 2),
(29, 6, 'ouali', 'xqxq', 'dqdq@dq.com', '$2y$13$3wP99ez5npUk2c7SfXxOieZ.VHzSj9H66GhmDXopjFdWBN2p/MCIO', 'dqdq@dq.com', 'test', 'zerzer', '54545', NULL, NULL, NULL, NULL, '39f4a200249f97f664423e25d35bac14', 1, '2018-11-20 12:06:04', '2018-11-20 14:15:28', NULL, 'ouali-xqxq', '2018-10-31 00:00:00', '2018-12-05 00:00:00', 'rezrzer', 'daada', 'rezrezrz', NULL, 28, '65465', '250', '11221', '17:14:00', '01:02:00', 1),
(30, 6, 'test', 'test', 'dada@dada.com', '$2y$13$FAZ5RI0pF8KqUZIgh4fniOl9EDrVpgM1xH6Ruqp5dK81zGCVq7Wp2', 'dada@dada.com', 'test', 'test', '24555', NULL, NULL, NULL, NULL, 'de6a3a8ab69352c5c10945b84c4485f2', 1, '2018-11-20 14:20:30', '2018-11-20 14:20:30', NULL, 'test-test', '2018-12-05 00:00:00', '2018-11-22 00:00:00', '1552', 'daada', 'rezrezrz', NULL, 29, '65465', '2500', '11221', '18:17:00', '15:12:00', 3),
(36, 6, 'fsfsfs', 'sdfsfs', 'fqfqfqf@fqfq.com', '$2y$13$9d6iB6BALuaVIo8X/o0t7ObYU2siMjK/4N06gAMVlu4UT.STugE4C', 'fqfqfqf@fqfq.com', 'test', 'fsfsf', '2546565', NULL, NULL, NULL, NULL, '19476266e3104bd4b2b0ce1e4496cc8d', 1, '2018-11-20 15:12:08', '2018-11-20 15:12:08', NULL, 'fsfsfs-sdfsfs', '2018-11-28 00:00:00', '2018-11-14 00:00:00', 'rezrzer', 'zerzer', 'rezrezrz', NULL, 36, 'dsdsd', 'achacdadca@ac.com', 'dhimi', '00:02:00', '22:17:00', NULL),
(37, 6, 'cdqcdq', 'cqdcqd', 'dqcdqdcq@dqcdqcdq.com', '$2y$13$9A/zi.xlGmkYSUfi7p3oLOlIwHf0h5dtB/BD4oPFI1GPruavjzOs.', 'dqcdqdcq@dqcdqcdq.com', 'cdqcdq', 'cdqcdq', 'dcqdqdq', NULL, NULL, NULL, NULL, '4ddaac5300cfb5db94fefb4adf370966', 1, '2018-11-20 15:13:56', '2018-11-20 15:13:56', NULL, 'cdqcdq-cqdcqd', '2018-11-25 00:00:00', '2018-11-14 00:00:00', '7878', '12', 'rezrezrz', NULL, 37, '65465', '250', '11221', '18:16:00', '21:13:00', NULL),
(38, 6, 'test', 'test', 'dqdqdq@gmail.com', '$2y$13$4n3Y/PBElDv.qcnz69H8uOqeNMOi21UACA3zxSTo0Kjcwf.4oL0Nq', 'dqdqdq@gmail.com', 'test', 'zerzer', '2546565', NULL, NULL, NULL, NULL, '49a3aea8f06dd9a96280b46e77b7b35b', 1, '2018-11-20 19:36:45', '2018-11-20 19:36:45', NULL, 'test-test-1', '2018-12-05 00:00:00', '2018-11-30 00:00:00', '10', 'zerzer', 'rezrezrz', NULL, 39, '65465', '2400', '11221', '22:16:00', '18:16:00', 2),
(43, 6, 'test', 'test', 'test test', '$2y$13$./lh/q5m1SKrFYRqU4pYDeGweTR6iYiUn80v4PNYbGRL21mWa56Xa', 'achrefouali@gmail.com', 'test', 'test', '45343453', 'aaaaaaaaaaaaa', 'aaaaaaaaaaa', 'aaaaaaaaaaa', '15151515', '4bd9249d3e04f1de9bd917eb73df2b1a', 1, '2018-11-20 20:40:32', '2018-11-23 12:52:01', NULL, 'test-test-2', '2018-11-28 00:00:00', '2018-11-29 00:00:00', '7878787', '788', 'rezrezrz', NULL, 2, 'dada', '2500', 'dhimi', '17:17:00', '16:17:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `participants_type`
--

DROP TABLE IF EXISTS `participants_type`;
CREATE TABLE IF NOT EXISTS `participants_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `tarif_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_60204BC6EA750E8` (`label`),
  KEY `IDX_60204BC6357C0A59` (`tarif_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `participants_type`
--

INSERT INTO `participants_type` (`id`, `label`, `enabled`, `created_at`, `updated_at`, `tarif_id`) VALUES
(6, 'Participant', 1, '2018-10-13 12:23:35', '2018-10-13 12:23:35', 1),
(7, 'Intervenant', 1, '2018-10-13 12:23:35', '2018-10-13 12:23:35', 2),
(8, 'Invite', 1, '2018-10-13 12:23:35', '2018-10-13 12:23:35', 2),
(9, 'VIP', 1, '2018-10-13 12:23:35', '2018-10-13 12:23:35', 2),
(10, 'Organisation', 1, '2018-10-13 12:23:35', '2018-10-13 12:23:35', 1);

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

DROP TABLE IF EXISTS `pays`;
CREATE TABLE IF NOT EXISTS `pays` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pays`
--

INSERT INTO `pays` (`id`, `name`) VALUES
(1, 'Tunisie'),
(2, 'Afrique du Sud'),
(3, 'Algérie'),
(4, 'Angola'),
(5, 'Bénin'),
(6, 'Botswana'),
(7, 'Burkina Faso'),
(8, 'Burundi'),
(9, 'Cameroun'),
(10, 'Cap-Vert'),
(11, 'République centrafricaine'),
(12, 'Comores'),
(13, 'République du Congo'),
(14, 'République démocratique du Congo'),
(15, 'Tunisie'),
(16, 'Tunisie'),
(17, 'Algérie'),
(18, 'Tunisie'),
(19, 'Burundi'),
(20, 'Algérie'),
(21, 'Afrique du Sud'),
(22, 'Algérie'),
(23, 'Tunisie'),
(24, 'Tunisie'),
(25, 'Tunisie'),
(26, 'Botswana'),
(27, 'Tunisie'),
(28, 'Tunisie'),
(29, 'Tunisie'),
(30, 'Algérie'),
(36, 'Algérie'),
(37, 'Burundi'),
(38, 'Burundi'),
(39, 'Burundi'),
(44, 'Burundi'),
(45, 'Algérie'),
(46, 'Tunisie'),
(47, 'Burundi'),
(48, 'Tunisie'),
(49, 'Algérie'),
(50, 'Algérie'),
(51, 'Afrique du Sud');

-- --------------------------------------------------------

--
-- Structure de la table `programmes`
--

DROP TABLE IF EXISTS `programmes`;
CREATE TABLE IF NOT EXISTS `programmes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_places_disponibles` int(11) NOT NULL,
  `emplacement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inscription_active` tinyint(1) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `journee_id` int(11) DEFAULT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  `designation_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_en` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_3631FC3FCF066148` (`journee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `programmes`
--

INSERT INTO `programmes` (`id`, `designation`, `nb_places_disponibles`, `emplacement`, `inscription_active`, `description`, `enabled`, `created_at`, `updated_at`, `journee_id`, `heure_debut`, `heure_fin`, `designation_en`, `description_en`) VALUES
(1, 'Program1, journee 1', 40, 'Salle1', 1, 'Programme 1 description', 1, '2018-11-06 00:00:00', '2018-11-06 00:00:00', 1, '08:30:00', '09:30:00', '', NULL),
(2, 'Programme 2, journee 1', 30, 'Salle2', 1, 'Description Programme 2, journee 1', 1, '2018-11-06 00:00:00', '2018-11-06 00:00:00', 1, '09:30:00', '10:30:00', '', NULL),
(3, 'Programme 3, journee 1', 60, 'Salle20', 1, 'Description Programme 3, journee 1', 1, '2018-11-06 00:00:00', '2018-11-06 00:00:00', 1, '10:30:00', '11:30:00', '', NULL),
(4, 'Programme 1, journee 2', 60, 'Salle20', 1, 'Description Programme 1, journee 2', 1, '2018-11-06 00:00:00', '2018-11-06 00:00:00', 2, '08:30:00', '09:30:00', '', NULL),
(5, 'Programme 2, journee 2', 60, 'Salle20', 1, 'Description Programme 2, journee 2', 1, '2018-11-06 00:00:00', '2018-11-06 00:00:00', 2, '09:30:00', '10:30:00', '', NULL),
(6, 'Programme 3, journee 2', 60, 'Salle20', 1, 'Description Programme 3, journee 2', 1, '2018-11-06 00:00:00', '2018-11-06 00:00:00', 2, '10:30:00', '11:30:00', '', NULL),
(7, 'Programme 1, journee 3', 60, 'Salle20', 1, 'Description Programme 1, journee 3', 1, '2018-11-06 00:00:00', '2018-11-06 00:00:00', 3, '08:30:00', '09:30:00', '', NULL),
(8, 'Programme 2, journee 3', 60, 'Salle20', 1, 'Description Programme 2, journee 3', 1, '2018-11-06 00:00:00', '2018-11-06 00:00:00', 3, '09:30:00', '10:30:00', '', NULL),
(9, 'Programme 3, journee 3', 60, 'Salle20', 1, 'Description Programme 3, journee 3', 1, '2018-11-06 00:00:00', '2018-11-06 00:00:00', 3, '10:30:00', '11:30:00', '', NULL),
(10, 'Pause cafe', 0, '', 0, NULL, 1, '2018-11-06 00:00:00', '2018-11-06 00:00:00', 1, '17:30:00', '19:30:00', '', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `programmes_documents`
--

DROP TABLE IF EXISTS `programmes_documents`;
CREATE TABLE IF NOT EXISTS `programmes_documents` (
  `programme_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  PRIMARY KEY (`programme_id`,`document_id`),
  UNIQUE KEY `UNIQ_84C2F925C33F7837` (`document_id`),
  KEY `IDX_84C2F92562BB7AEE` (`programme_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `programmes_images`
--

DROP TABLE IF EXISTS `programmes_images`;
CREATE TABLE IF NOT EXISTS `programmes_images` (
  `programme_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  PRIMARY KEY (`programme_id`,`image_id`),
  UNIQUE KEY `UNIQ_6C56637B3DA5256D` (`image_id`),
  KEY `IDX_6C56637B62BB7AEE` (`programme_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `programmes_intervenants`
--

DROP TABLE IF EXISTS `programmes_intervenants`;
CREATE TABLE IF NOT EXISTS `programmes_intervenants` (
  `programme_id` int(11) NOT NULL,
  `intervenant_id` int(11) NOT NULL,
  PRIMARY KEY (`programme_id`,`intervenant_id`),
  KEY `IDX_CE7C9D4562BB7AEE` (`programme_id`),
  KEY `IDX_CE7C9D45AB9A1716` (`intervenant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `programmes_intervenants`
--

INSERT INTO `programmes_intervenants` (`programme_id`, `intervenant_id`) VALUES
(1, 2),
(2, 3),
(3, 9),
(4, 8),
(5, 2),
(6, 10),
(7, 3),
(8, 8),
(9, 2),
(9, 9);

-- --------------------------------------------------------

--
-- Structure de la table `programmes_videos`
--

DROP TABLE IF EXISTS `programmes_videos`;
CREATE TABLE IF NOT EXISTS `programmes_videos` (
  `programme_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  PRIMARY KEY (`programme_id`,`video_id`),
  UNIQUE KEY `UNIQ_A5E3B92329C1004E` (`video_id`),
  KEY `IDX_A5E3B92362BB7AEE` (`programme_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Waiting',
  `totalPrice` double NOT NULL,
  `reservation_ref` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `participant_id` int(11) DEFAULT NULL,
  `nb_accompanying` int(11) DEFAULT NULL,
  `heure_arrival` time DEFAULT NULL,
  `heure_departure` time DEFAULT NULL,
  `date_arrive` datetime DEFAULT NULL,
  `date_depart` datetime DEFAULT NULL,
  `num_vol_arrive` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_vol_depart` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `devis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4DA2399D1C3019` (`participant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `state`, `totalPrice`, `reservation_ref`, `enabled`, `created_at`, `updated_at`, `participant_id`, `nb_accompanying`, `heure_arrival`, `heure_departure`, `date_arrive`, `date_depart`, `num_vol_arrive`, `num_vol_depart`, `devis`) VALUES
(1, '2', 500, 'RES5bf2ee76b09cd', 1, '2018-11-18 14:38:19', '2018-11-19 20:21:14', 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '1', 300, 'RES5bf4196443348', 1, '2018-11-18 20:04:47', '2018-11-20 14:41:10', 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '0', 200, 'RES5bf4619707de7', 1, '2018-11-18 20:24:46', '2018-11-20 19:33:43', 20, 1, '01:03:00', '22:16:00', '2018-11-27 00:00:00', '2018-11-14 00:00:00', '7878', 'zerzer', NULL),
(4, '4', 100, 'RES5bf1d08d98b03', 1, '2018-11-18 20:50:21', '2018-11-19 09:15:38', 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, '1', 100, 'RES5bf1d1b9b9ff9', 1, '2018-11-18 20:55:21', '2018-11-19 09:15:12', 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, '0', 100, 'RES5bf29ef857d92', 1, '2018-11-19 11:31:04', '2018-11-19 11:31:04', 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, '0', 100, 'RES5bf29f670d879', 1, '2018-11-19 11:32:55', '2018-11-19 11:32:55', 24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, '0', 0, 'RES5bf2a1c33d42b', 1, '2018-11-19 11:42:59', '2018-11-19 11:42:59', 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, '0', 100, 'RES5bf2ed1088269', 1, '2018-11-19 17:04:15', '2018-11-19 17:04:16', 26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, '0', 100, 'RES5bf2eda720089', 1, '2018-11-19 17:06:46', '2018-11-19 17:06:47', 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, '1', 100, 'RES5bf2ee47ad892', 1, '2018-11-19 17:09:26', '2018-11-21 20:30:19', 28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, '0', 6800, 'RES5bf41701ce569', 1, '2018-11-20 12:06:03', '2018-11-20 14:15:33', 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, '0', 100, 'RES5bf4182e09f0c', 1, '2018-11-20 14:20:28', '2018-11-20 14:20:30', 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, '0', 100, 'RES5bf4182e09f0c', 1, '2018-11-20 14:48:09', '2018-11-20 14:48:09', 29, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, '2', 100, 'RES5bf4182e09f0c', 1, '2018-11-20 14:50:04', '2018-11-21 16:38:59', 30, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, '1', 100, 'RES5bf4182e09f0c', 1, '2018-11-20 14:51:10', '2018-11-20 14:58:18', 24, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, '0', 100, 'RES5bf4182e09f0c', 1, '2018-11-20 14:56:07', '2018-11-20 14:56:07', 26, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, '0', 100, 'RES5bf42448a13ee', 1, '2018-11-20 15:06:25', '2018-11-20 15:06:25', 28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, '0', 1480, 'RES5bf42448a13ee', 1, '2018-11-20 15:12:08', '2018-11-20 15:12:09', 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, '1', 1200, 'RES5bf424b4eb98b', 1, '2018-11-20 15:13:56', '2018-11-20 19:53:48', 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, '0', 100, 'RES5bf4624d518ac', 1, '2018-11-20 19:36:44', '2018-11-20 19:36:45', 38, 2, '22:16:00', '18:16:00', '2018-12-05 00:00:00', '2018-11-30 00:00:00', '10', 'zerzer', NULL),
(24, '0', 10550, 'RES5bf7f7f1f13bb', 1, '2018-11-20 20:40:32', '2018-11-23 12:52:02', 43, 1, '17:17:00', '16:17:00', '2018-11-28 00:00:00', '2018-11-29 00:00:00', '7878787', '788', 'nX5bUrNfqc.pdf');

-- --------------------------------------------------------

--
-- Structure de la table `reservations_event`
--

DROP TABLE IF EXISTS `reservations_event`;
CREATE TABLE IF NOT EXISTS `reservations_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `total` double NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `payment_method` int(11) NOT NULL,
  `devis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F17AFC4871F7E88B` (`event_id`),
  KEY `IDX_F17AFC48B83297E7` (`reservation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reservations_event`
--

INSERT INTO `reservations_event` (`id`, `event_id`, `reservation_id`, `total`, `enabled`, `created_at`, `updated_at`, `payment_method`, `devis`, `code`) VALUES
(1, 1, 1, 100, 1, '2018-11-18 14:38:18', '2018-11-18 14:38:18', 2, NULL, NULL),
(2, 1, 1, 100, 1, '2018-11-18 14:38:22', '2018-11-18 14:38:22', 2, NULL, NULL),
(3, 1, 1, 100, 1, '2018-11-18 20:01:30', '2018-11-18 20:01:30', 2, NULL, NULL),
(4, 1, 2, 100, 1, '2018-11-18 20:04:46', '2018-11-18 20:04:46', 1, NULL, NULL),
(5, 1, 3, 100, 1, '2018-11-18 20:24:46', '2018-11-18 20:24:46', 2, NULL, NULL),
(6, 1, 1, 100, 1, '2018-11-18 20:47:50', '2018-11-18 20:47:50', 2, NULL, NULL),
(7, 1, 4, 100, 1, '2018-11-18 20:50:21', '2018-11-18 20:50:21', 2, NULL, NULL),
(8, 1, 5, 100, 1, '2018-11-18 20:55:21', '2018-11-18 20:55:21', 2, NULL, NULL),
(9, 1, 6, 100, 1, '2018-11-19 11:31:03', '2018-11-19 11:31:03', 2, NULL, NULL),
(10, 1, 7, 100, 1, '2018-11-19 11:32:54', '2018-11-19 11:32:54', 2, NULL, NULL),
(11, 1, 11, 100, 1, '2018-11-19 17:04:15', '2018-11-19 17:04:15', 2, NULL, NULL),
(12, 1, 12, 100, 1, '2018-11-19 17:06:46', '2018-11-19 17:06:46', 2, NULL, NULL),
(13, 1, 13, 100, 1, '2018-11-19 17:09:26', '2018-11-19 17:09:26', 2, NULL, NULL),
(14, 1, 1, 100, 1, '2018-11-19 17:10:14', '2018-11-19 17:10:14', 2, NULL, NULL),
(15, 1, 2, 100, 1, '2018-11-20 08:43:56', '2018-11-20 08:43:56', 2, NULL, NULL),
(16, 1, 14, 100, 1, '2018-11-20 12:06:03', '2018-11-20 12:06:03', 1, NULL, NULL),
(17, 1, 14, 100, 1, '2018-11-20 14:15:28', '2018-11-20 14:15:28', 2, NULL, NULL),
(18, 1, 15, 100, 1, '2018-11-20 14:20:28', '2018-11-20 14:20:28', 2, NULL, NULL),
(19, 1, 2, 100, 1, '2018-11-20 14:25:39', '2018-11-20 14:25:39', 2, NULL, NULL),
(20, 1, 16, 100, 1, '2018-11-20 14:48:09', '2018-11-20 14:48:09', 2, NULL, NULL),
(21, 1, 17, 100, 1, '2018-11-20 14:50:04', '2018-11-20 14:50:04', 2, NULL, NULL),
(22, 1, 18, 100, 1, '2018-11-20 14:51:10', '2018-11-20 14:51:10', 2, NULL, NULL),
(23, 1, 19, 100, 1, '2018-11-20 14:56:07', '2018-11-20 14:56:07', 2, NULL, NULL),
(24, 1, 20, 100, 1, '2018-11-20 15:06:25', '2018-11-20 15:06:25', 2, NULL, NULL),
(25, 1, 21, 100, 1, '2018-11-20 15:12:08', '2018-11-20 15:12:08', 2, NULL, NULL),
(26, 1, 3, 100, 1, '2018-11-20 19:33:42', '2018-11-20 19:33:42', 2, NULL, NULL),
(27, 1, 23, 100, 1, '2018-11-20 19:36:44', '2018-11-20 19:36:44', 2, NULL, NULL),
(28, 1, 24, 100, 1, '2018-11-20 20:40:31', '2018-11-20 20:40:31', 2, NULL, NULL),
(29, 1, 24, 100, 1, '2018-11-20 23:19:22', '2018-11-20 23:19:22', 2, NULL, NULL),
(30, 1, 24, 100, 1, '2018-11-21 19:59:13', '2018-11-21 19:59:13', 2, NULL, NULL),
(31, 1, 24, 100, 1, '2018-11-21 20:03:43', '2018-11-21 20:03:43', 2, NULL, NULL),
(32, 1, 24, 100, 1, '2018-11-22 22:16:37', '2018-11-22 22:16:37', 2, NULL, NULL),
(33, 1, 24, 100, 1, '2018-11-22 22:49:32', '2018-11-22 22:49:32', 2, '8VYAnDLcIT.pdf', NULL),
(34, 1, 24, 100, 1, '2018-11-23 12:50:45', '2018-11-23 12:50:45', 2, 'DxmMfKLpt7.pdf', 'C0034');

-- --------------------------------------------------------

--
-- Structure de la table `reservations_hotel`
--

DROP TABLE IF EXISTS `reservations_hotel`;
CREATE TABLE IF NOT EXISTS `reservations_hotel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hotel_id` int(11) DEFAULT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `total` double NOT NULL,
  `nb_jours` int(11) NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `payment_method` int(11) NOT NULL,
  `devis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C987A8363243BB18` (`hotel_id`),
  KEY `IDX_C987A836B83297E7` (`reservation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reservations_hotel`
--

INSERT INTO `reservations_hotel` (`id`, `hotel_id`, `reservation_id`, `total`, `nb_jours`, `date_debut`, `date_fin`, `enabled`, `created_at`, `updated_at`, `payment_method`, `devis`, `code`) VALUES
(1, 2, 14, 3300, 10, '2019-02-14 00:00:00', '2019-02-24 00:00:00', 1, '2018-11-20 12:06:08', '2018-11-20 12:06:08', 1, NULL, NULL),
(2, 2, 14, 3300, 10, '2019-02-14 00:00:00', '2019-02-24 00:00:00', 1, '2018-11-20 14:15:33', '2018-11-20 14:15:33', 2, NULL, NULL),
(3, 1, 21, 1380, 6, '2019-02-14 00:00:00', '2019-02-20 00:00:00', 1, '2018-11-20 15:12:09', '2018-11-20 15:12:09', 2, NULL, NULL),
(4, 1, 22, 1200, 8, '2019-02-14 00:00:00', '2019-02-22 00:00:00', 1, '2018-11-20 15:13:57', '2018-11-20 15:13:57', 2, NULL, NULL),
(5, 1, 24, 150, 1, '2019-02-20 00:00:00', '2019-02-21 00:00:00', 1, '2018-11-20 20:40:34', '2018-11-20 20:40:34', 2, NULL, NULL),
(6, 1, 24, 1500, 10, '2019-02-14 00:00:00', '2019-02-24 00:00:00', 1, '2018-11-20 20:42:30', '2018-11-20 20:42:30', 2, NULL, NULL),
(7, 1, 24, 150, 1, '2019-02-15 00:00:00', '2019-02-16 00:00:00', 1, '2018-11-21 15:52:52', '2018-11-21 15:52:52', 2, NULL, NULL),
(8, 2, 24, 7600, 10, '2019-02-14 00:00:00', '2019-02-24 00:00:00', 1, '2018-11-21 19:59:16', '2018-11-21 19:59:16', 2, NULL, NULL),
(9, 1, 24, 150, 1, '2019-02-14 00:00:00', '2019-02-15 00:00:00', 1, '2018-11-23 12:50:47', '2018-11-23 12:50:47', 2, 'DxmMfKLpt7.pdf', 'H0009'),
(10, 1, 24, 300, 1, '2019-02-14 00:00:00', '2019-02-15 00:00:00', 1, '2018-11-23 12:52:02', '2018-11-23 12:52:02', 2, 'sB8Nr2blYT.pdf', 'H0010');

-- --------------------------------------------------------

--
-- Structure de la table `reservations_supplements`
--

DROP TABLE IF EXISTS `reservations_supplements`;
CREATE TABLE IF NOT EXISTS `reservations_supplements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reservation_id` int(11) DEFAULT NULL,
  `montant` double NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `payment_method` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_ECDFDE9EB83297E7` (`reservation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reservation_supplements_supplement`
--

DROP TABLE IF EXISTS `reservation_supplements_supplement`;
CREATE TABLE IF NOT EXISTS `reservation_supplements_supplement` (
  `reservation_supplements_id` int(11) NOT NULL,
  `supplement_id` int(11) NOT NULL,
  PRIMARY KEY (`reservation_supplements_id`,`supplement_id`),
  KEY `IDX_7D021855BE5B7FB8` (`reservation_supplements_id`),
  KEY `IDX_7D0218557793FA21` (`supplement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_role` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_B63E2EC75E237E06` (`name`),
  KEY `IDX_B63E2EC7727ACA70` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `parent_id`, `name`, `order_role`, `enabled`, `created_at`, `updated_at`) VALUES
(1, NULL, 'ROLE_ADMIN', 1, 1, '2018-10-13 12:23:35', '2018-10-13 12:23:35'),
(2, NULL, 'ROLE_USER', 2, 1, '2018-10-13 12:23:35', '2018-10-13 12:23:35');

-- --------------------------------------------------------

--
-- Structure de la table `sponsors`
--

DROP TABLE IF EXISTS `sponsors`;
CREATE TABLE IF NOT EXISTS `sponsors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_web` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9A31550FC54C8C93` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sponsors`
--

INSERT INTO `sponsors` (`id`, `designation`, `logo`, `site_web`, `enabled`, `created_at`, `updated_at`, `type_id`) VALUES
(1, 'Sponsor1', 'Almourakeb.jpg', 'http://www.sponsor1.com', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(2, 'sponsor2', 'Continental-2.jpg', 'http://www.sponsor2.com', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(3, 'Sponsor3', 'logoMapfre.jpg', 'http://www.sponsor3.com', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(4, 'sponsor4', 'Standard-logo-NEXtCARE-copy.jpg', 'http://www.sponsor4.com', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(5, 'Sponsor5', '214cf474c8ad08719133529f4fadfc07.jpeg', 'http://www.sponsor5.com', 1, '0000-00-00 00:00:00', '2018-11-20 08:32:51', 4),
(6, 'sponsor6', 'ced8a8a37f77a3cf9768484b2ec57956.jpeg', 'http://www.sponsor6.com', 1, '0000-00-00 00:00:00', '2018-11-20 08:32:30', 5);

-- --------------------------------------------------------

--
-- Structure de la table `sponsors_type`
--

DROP TABLE IF EXISTS `sponsors_type`;
CREATE TABLE IF NOT EXISTS `sponsors_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sponsors_type`
--

INSERT INTO `sponsors_type` (`id`, `label`, `enabled`, `created_at`, `updated_at`) VALUES
(1, 'Platine Sponsors', 1, '0000-00-00 00:00:00', '2018-11-20 08:30:24'),
(2, 'Golden Sponsors', 1, '0000-00-00 00:00:00', '2018-11-20 08:30:38'),
(3, 'Silver Sponsors', 1, '0000-00-00 00:00:00', '2018-11-20 08:30:58'),
(4, 'Bronze Sponsors', 1, '0000-00-00 00:00:00', '2018-11-20 08:31:14'),
(5, 'Others Sponsors', 1, '2018-11-20 08:31:32', '2018-11-20 08:31:32');

-- --------------------------------------------------------

--
-- Structure de la table `supplements`
--

DROP TABLE IF EXISTS `supplements`;
CREATE TABLE IF NOT EXISTS `supplements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` double NOT NULL,
  `lieu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F9B7EF6C71F7E88B` (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `supplements`
--

INSERT INTO `supplements` (`id`, `designation`, `prix`, `lieu`, `enabled`, `created_at`, `updated_at`, `event_id`) VALUES
(1, 'Ecursion Musée du Bardo', 50, 'Bardo, Tunis', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(2, 'Le temple des eaux', 40, 'Zagouan, Tunis', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(3, 'Vestiges de l\'ancienne ville carthaginoise', 60, 'Carthage, Tunis', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(4, 'Diner Gala', 100, 'Hotel Ibis, Tunis', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `tarifs`
--

DROP TABLE IF EXISTS `tarifs`;
CREATE TABLE IF NOT EXISTS `tarifs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` double NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `event_id` int(11) NOT NULL,
  `prix_accompagnant` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F9B8C49671F7E88B` (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tarifs`
--

INSERT INTO `tarifs` (`id`, `label`, `prix`, `enabled`, `created_at`, `updated_at`, `event_id`, `prix_accompagnant`) VALUES
(1, 'Non Membre', 300, 1, '2018-10-21 00:00:00', '2018-11-19 17:17:24', 1, 250),
(2, 'Membre', 100, 1, '2018-10-21 00:00:00', '2018-11-19 18:42:13', 1, 300);

-- --------------------------------------------------------

--
-- Structure de la table `user_has_role`
--

DROP TABLE IF EXISTS `user_has_role`;
CREATE TABLE IF NOT EXISTS `user_has_role` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `IDX_EAB8B535A76ED395` (`user_id`),
  KEY `IDX_EAB8B535D60322AC` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_has_role`
--

INSERT INTO `user_has_role` (`user_id`, `role_id`) VALUES
(17, 1),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 2),
(36, 2),
(37, 2),
(38, 2),
(43, 2);

-- --------------------------------------------------------

--
-- Structure de la table `videos`
--

DROP TABLE IF EXISTS `videos`;
CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `villes`
--

DROP TABLE IF EXISTS `villes`;
CREATE TABLE IF NOT EXISTS `villes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pays_id` int(11) DEFAULT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ville_pays1_idx` (`pays_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `villes`
--

INSERT INTO `villes` (`id`, `pays_id`, `name`, `enabled`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tunis', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 3, 'Alger', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 'Hammamet', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 1, 'Nabeul', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, 'Sousse', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 1, 'Sfax', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 1, 'Tozeur', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 1, 'Djerba', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 1, 'Mahdia', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `accompanying`
--
ALTER TABLE `accompanying`
  ADD CONSTRAINT `FK_83AB3ACE7556EF3F` FOREIGN KEY (`Reservation_id`) REFERENCES `reservations` (`id`);

--
-- Contraintes pour la table `configuration`
--
ALTER TABLE `configuration`
  ADD CONSTRAINT `FK_A5E2A5D7A6E44244` FOREIGN KEY (`pays_id`) REFERENCES `pays` (`id`),
  ADD CONSTRAINT `FK_A5E2A5D7A73F0036` FOREIGN KEY (`ville_id`) REFERENCES `villes` (`id`);

--
-- Contraintes pour la table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `FK_5387574AA6E44244` FOREIGN KEY (`pays_id`) REFERENCES `pays` (`id`),
  ADD CONSTRAINT `FK_5387574AA73F0036` FOREIGN KEY (`ville_id`) REFERENCES `villes` (`id`);

--
-- Contraintes pour la table `events_documents`
--
ALTER TABLE `events_documents`
  ADD CONSTRAINT `FK_3B4417AA71F7E88B` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `FK_3B4417AAC33F7837` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`);

--
-- Contraintes pour la table `hotels`
--
ALTER TABLE `hotels`
  ADD CONSTRAINT `FK_E402F625A73F0036` FOREIGN KEY (`ville_id`) REFERENCES `villes` (`id`);

--
-- Contraintes pour la table `hotel_images`
--
ALTER TABLE `hotel_images`
  ADD CONSTRAINT `FK_7CF56C0D3243BB18` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`);

--
-- Contraintes pour la table `hotel_package`
--
ALTER TABLE `hotel_package`
  ADD CONSTRAINT `FK_D2279BC3243BB18` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`);

--
-- Contraintes pour la table `hotel_package_periode`
--
ALTER TABLE `hotel_package_periode`
  ADD CONSTRAINT `FK_ADD6FA12F44CABFF` FOREIGN KEY (`package_id`) REFERENCES `hotel_package` (`id`);

--
-- Contraintes pour la table `hotel_reservation_package`
--
ALTER TABLE `hotel_reservation_package`
  ADD CONSTRAINT `FK_64F7382181984112` FOREIGN KEY (`hotel_package_id`) REFERENCES `hotel_package` (`id`),
  ADD CONSTRAINT `FK_64F73821AFF6590C` FOREIGN KEY (`reservation_hotel_id`) REFERENCES `reservations_hotel` (`id`);

--
-- Contraintes pour la table `journees`
--
ALTER TABLE `journees`
  ADD CONSTRAINT `FK_C569465471F7E88B` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

--
-- Contraintes pour la table `journees_images`
--
ALTER TABLE `journees_images`
  ADD CONSTRAINT `FK_C2067634C33F7837` FOREIGN KEY (`document_id`) REFERENCES `images` (`id`),
  ADD CONSTRAINT `FK_C2067634CF066148` FOREIGN KEY (`journee_id`) REFERENCES `journees` (`id`);

--
-- Contraintes pour la table `notification_has_pattern`
--
ALTER TABLE `notification_has_pattern`
  ADD CONSTRAINT `FK_11D6A714EF1A9D84` FOREIGN KEY (`notification_id`) REFERENCES `notifications` (`id`),
  ADD CONSTRAINT `FK_11D6A714F734A20F` FOREIGN KEY (`pattern_id`) REFERENCES `motifs` (`id`);

--
-- Contraintes pour la table `organization`
--
ALTER TABLE `organization`
  ADD CONSTRAINT `FK_C1EE637CA6E44244` FOREIGN KEY (`pays_id`) REFERENCES `pays` (`id`);

--
-- Contraintes pour la table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `FK_2074E575CCD7E912` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`);

--
-- Contraintes pour la table `participants`
--
ALTER TABLE `participants`
  ADD CONSTRAINT `FK_716970925F41439B` FOREIGN KEY (`participant_type_id`) REFERENCES `participants_type` (`id`),
  ADD CONSTRAINT `FK_71697092A6E44244` FOREIGN KEY (`pays_id`) REFERENCES `pays` (`id`);

--
-- Contraintes pour la table `participants_type`
--
ALTER TABLE `participants_type`
  ADD CONSTRAINT `FK_60204BC6357C0A59` FOREIGN KEY (`tarif_id`) REFERENCES `tarifs` (`id`);

--
-- Contraintes pour la table `programmes`
--
ALTER TABLE `programmes`
  ADD CONSTRAINT `FK_3631FC3FCF066148` FOREIGN KEY (`journee_id`) REFERENCES `journees` (`id`);

--
-- Contraintes pour la table `programmes_documents`
--
ALTER TABLE `programmes_documents`
  ADD CONSTRAINT `FK_84C2F92562BB7AEE` FOREIGN KEY (`programme_id`) REFERENCES `programmes` (`id`),
  ADD CONSTRAINT `FK_84C2F925C33F7837` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`);

--
-- Contraintes pour la table `programmes_images`
--
ALTER TABLE `programmes_images`
  ADD CONSTRAINT `FK_6C56637B3DA5256D` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`),
  ADD CONSTRAINT `FK_6C56637B62BB7AEE` FOREIGN KEY (`programme_id`) REFERENCES `programmes` (`id`);

--
-- Contraintes pour la table `programmes_intervenants`
--
ALTER TABLE `programmes_intervenants`
  ADD CONSTRAINT `FK_CE7C9D4562BB7AEE` FOREIGN KEY (`programme_id`) REFERENCES `programmes` (`id`),
  ADD CONSTRAINT `FK_CE7C9D45AB9A1716` FOREIGN KEY (`intervenant_id`) REFERENCES `participants` (`id`);

--
-- Contraintes pour la table `programmes_videos`
--
ALTER TABLE `programmes_videos`
  ADD CONSTRAINT `FK_A5E3B92329C1004E` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`),
  ADD CONSTRAINT `FK_A5E3B92362BB7AEE` FOREIGN KEY (`programme_id`) REFERENCES `programmes` (`id`);

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `FK_4DA2399D1C3019` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`id`);

--
-- Contraintes pour la table `reservations_event`
--
ALTER TABLE `reservations_event`
  ADD CONSTRAINT `FK_F17AFC4871F7E88B` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `FK_F17AFC48B83297E7` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`);

--
-- Contraintes pour la table `reservations_hotel`
--
ALTER TABLE `reservations_hotel`
  ADD CONSTRAINT `FK_C987A8363243BB18` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`),
  ADD CONSTRAINT `FK_C987A836B83297E7` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`);

--
-- Contraintes pour la table `reservations_supplements`
--
ALTER TABLE `reservations_supplements`
  ADD CONSTRAINT `FK_ECDFDE9EB83297E7` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`);

--
-- Contraintes pour la table `reservation_supplements_supplement`
--
ALTER TABLE `reservation_supplements_supplement`
  ADD CONSTRAINT `FK_7D0218557793FA21` FOREIGN KEY (`supplement_id`) REFERENCES `supplements` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_7D021855BE5B7FB8` FOREIGN KEY (`reservation_supplements_id`) REFERENCES `reservations_supplements` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `FK_B63E2EC7727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `roles` (`id`);

--
-- Contraintes pour la table `sponsors`
--
ALTER TABLE `sponsors`
  ADD CONSTRAINT `FK_9A31550FC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `sponsors_type` (`id`);

--
-- Contraintes pour la table `supplements`
--
ALTER TABLE `supplements`
  ADD CONSTRAINT `FK_F9B7EF6C71F7E88B` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

--
-- Contraintes pour la table `tarifs`
--
ALTER TABLE `tarifs`
  ADD CONSTRAINT `FK_F9B8C49671F7E88B` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

--
-- Contraintes pour la table `user_has_role`
--
ALTER TABLE `user_has_role`
  ADD CONSTRAINT `FK_EAB8B535A76ED395` FOREIGN KEY (`user_id`) REFERENCES `participants` (`id`),
  ADD CONSTRAINT `FK_EAB8B535D60322AC` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Contraintes pour la table `villes`
--
ALTER TABLE `villes`
  ADD CONSTRAINT `FK_19209FD8A6E44244` FOREIGN KEY (`pays_id`) REFERENCES `pays` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
