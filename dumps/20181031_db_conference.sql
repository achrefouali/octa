-- phpMyAdmin SQL Dump
-- version 4.7.8
-- https://www.phpmyadmin.net/
--
-- Host: 10.123.0.61:3306
-- Generation Time: Oct 31, 2018 at 10:53 AM
-- Server version: 5.7.23
-- PHP Version: 5.6.36-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `karimettabaa_arb`
--

-- --------------------------------------------------------

--
-- Table structure for table `configuration`
--

CREATE TABLE `configuration` (
  `id` int(11) NOT NULL,
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
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `banque` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agence` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_compte_bancaire` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_swift` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_iban` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pays_id` int(11) NOT NULL,
  `ville_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `configuration`
--

INSERT INTO `configuration` (`id`, `logo`, `adresse`, `nom_expediteur`, `email_expediteur`, `telephone`, `fax`, `email_direction`, `email_direction2`, `email_agence`, `enabled`, `created_at`, `updated_at`, `banque`, `agence`, `num_compte_bancaire`, `code_swift`, `code_iban`, `pays_id`, `ville_id`) VALUES
(1, 'logo1.png', 'Rue Mohamed Ali Ennabi, 1080', 'Direction', 'karim@travelportal.cz', '216 70 24 44 20', '216 70 24 44 20', 'karim.travelportal.cz@gmail.com', 'karim.sahebettabaa@riadi.rnu.tn', 'karim@travelportal.cz', 1, '2018-10-15 00:00:00', '2018-10-17 15:06:22', 'BNA', 'Cite Ennasr', '12 12 12 12 12 12 12 12 12 12 36', '123456-456', '455-5655', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `devises`
--

CREATE TABLE `devises` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coeff` double NOT NULL,
  `main` tinyint(1) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `devises`
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
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `designation`, `file`, `enabled`, `created_at`, `updated_at`) VALUES
(1, 'doc1', 'doc1.pdf', 1, '2018-10-21 00:00:00', '2018-10-21 00:00:00'),
(2, 'doc2', 'doc2.pdf', 1, '2018-10-21 00:00:00', '2018-10-21 00:00:00'),
(3, 'doc3', 'doc3.pdf', 1, '2018-10-21 00:00:00', '2018-10-21 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` tinytext COLLATE utf8mb4_unicode_ci,
  `metadescription` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prix` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tweeter_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `designation_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation2_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_en` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays_id` int(11) NOT NULL,
  `ville_id` int(11) NOT NULL,
  `logo_facture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `designation`, `designation2`, `adresse`, `longitude`, `latitude`, `description`, `keywords`, `metadescription`, `prix`, `facebook_link`, `google_link`, `tweeter_link`, `instagram_link`, `enabled`, `created_at`, `updated_at`, `designation_en`, `designation2_en`, `description_en`, `date_debut`, `date_fin`, `logo`, `pays_id`, `ville_id`, `logo_facture`) VALUES
(1, 'FANAF 2019', '43eme ASSEMBLEE GENERALE DE LA FANAF', 'Laico Tunis, Place droit de l\'homme, Av. Mohamed V, Tunis', '36.939868', '10.2529585,15', '<p>he rapid technological changes witnessed in the world by digital discoveries and artificial intelligence or what is expressed by &quot;the Fourth Industrial Revolution&quot; will change the relationship of the human environment and will inevitably lead to a comprehensive change in the needs and ways to respond to them by economic and financial actors. The insurance sector will not be isolated from these transformations, which will enshrine the concept of the digital global village and there will be no land, country, sector or company deprived from these changes. The Organizing Committee hopes that this conference will be an occasion to examine the mechanisms of voluntary engagement in this digital revolution to serve our clients and to ensure the sustainability of the insurance industry in our countries. On behalf of all members of the Organizing Committee, we would like to welcome you in Hammamet and wish you a very pleasant stay in your country Tunisia.</p>', 'General Arab Insurance Federation, Gaif 2019', 'meta General Arab Insurance Federation, Gaif 2019', '300', 'https://www.facebook.com/', NULL, NULL, NULL, 1, '2018-10-17 00:00:00', '2018-10-17 14:33:00', 'FANAF 2019', NULL, 'he rapid technological changes witnessed in the world by digital discoveries and artificial intelligence or what is expressed by “the Fourth Industrial Revolution” will change the relationship of the human environment and will inevitably lead to a comprehensive change in the needs and ways to respond to them by economic and financial actors.\r\n\r\nThe insurance sector will not be isolated from these transformations, which will enshrine the concept of the digital global village and there will be no land, country, sector or company deprived from these changes.\r\n\r\nThe Organizing Committee hopes that this conference will be an occasion to examine the mechanisms of voluntary engagement in this digital revolution to serve our clients and to ensure the sustainability of the insurance industry in our countries.\r\n\r\nOn behalf of all members of the Organizing Committee, we would like to welcome you in Hammamet and wish you a very pleasant stay in your country Tunisia.', '2019-02-17 00:00:00', '2019-02-21 00:00:00', 'logo.png', 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `events_documents`
--

CREATE TABLE `events_documents` (
  `event_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events_documents`
--

INSERT INTO `events_documents` (`event_id`, `document_id`) VALUES
(1, 1),
(1, 2),
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` int(11) NOT NULL,
  `ville_id` int(11) NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `services` longtext COLLATE utf8mb4_unicode_ci,
  `adresse` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categorie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `ville_id`, `designation`, `description`, `services`, `adresse`, `categorie`, `longitude`, `latitude`, `enabled`, `created_at`, `updated_at`) VALUES
(1, 1, 'HOTEL NOVOTEL TUNIS', 'Au coeur du quartier des affaires de la ville, Cet hôtel 4 etoiles se situe à moins de quinze minutes en voiture de la medina et ses monuments historiques, a 5 km de laeroport de Tunis Carthage . Apres une visite riche en decouvertes, detendez-vous sur le toit-terrasse, au bord de la piscine. Pour vos reunions et seminaires, 14 salles sont à votre disposition. Le soir, laissez-vous seduire par la cuisine originale et moderne du restaurant', 'Equipements de l\'etablissement : HOTEL NOVOTEL TUNIS\r\nHebergement Telephone, Douche, Bain, SAT TV, Coffre fort, Refrigerateur, Baby cot ( Extra), Connexion internet WIFI, Connexion internet cable, CH Familiale grande Chambre, Lit supplementaire banquette, Air conditionne central Restauration Petit dejeuner Buffet, Restaurant à la carte, Bar, Room service Animation Piscine exterieure, Salle de sport Divers services Reception 24h/24h, Wifi Gratuit, Change, Centre SPA , Secretariat, Parking, Facilites pour Handicapes, Salle de reunion, Blanchisserie, Assenceur', '44 Avenue Mohamed V,', '4', '10.1838987,15', '36.8113758', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 'HOTEL ACROPOLE LES BERGES DU LAC', 'L hotel Acropole a ouvert ses portes en 2002. Il est situe a seulement 10 minutes de l aeroport de Tunis Carthage. A mi-chemin entre le grand Tunis, la Medina, et les centres touristiques et de loisirs de la banlieue nord de Tunis, tels que le village de Sidi Bou Saïd et les sites archeologiques de Carthage, l hotel Acropole est idealement situe.', 'Equipements de l\'etablissement : HOTEL ACROPOLE LES BERGES DU LAC\r\nHebergement Terrasse, Bain, TV, Coffre fort, Mini bar ( inclus), Coin salon, Seche cheveux Restauration Petit dejeuner Buffet, Dejeuner Buffet, Diner Buffet, Restaurant à la carte, Bar, Room service Animation Piscine exterieure Divers services Reception 24h/24h, Wifi Gratuit, Change, Parking, Salle de reuion, Asse', 'Rue Rodrigo De Freitas, 2045 Les Berges Du Lac ', '4', '10.2376679,17', '36.8344057', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 'HOTEL LAICO TUNIS', 'Le Laico Tunis vous accueille a Tunis, dans un batiment datant de 1990, a proximitÃ© de plusieurs lieux d\'intÃ©ret, tels que l\'avenue Habib Bourguiba et le theatre municipal.', NULL, 'Ave Mohamed V, Tunis', '5', '10.187057,15', '36.8072585', 1, '0000-00-00 00:00:00', '2018-10-17 10:19:55'),
(4, 1, 'HOTEL SHERATON', 'Le Sheraton Tunis Hotel surplombe toute la ville de Tunis. Il possÃ¨de un spa de luxe et un centre d\'affaires ouvert 24h/24.\r\n\r\nChaque chambre prÃ©sente une dÃ©coration Ã©lÃ©gante et bÃ©nÃ©ficie d\'un balcon privÃ©. Certaines d\'entre elles comprennent Ã©galement un accÃ¨s aux privilÃ©ges du salon-club.\r\n\r\nL\'hÃ´tel vous propose plusieurs restaurants, dont le Walima, qui sert une cuisine tunisienne. Vous pourrez en outre dÃ©guster des plats italiens authentiques Ã  l\'Azzuro.\r\n\r\nVous profiterez par ailleurs de soins de beautÃ© et de santÃ©, prodiguÃ©s par les professionnels du spa. Vous apprÃ©cierez aussi la piscine extÃ©rieure et le centre de remise en forme.\r\n\r\nVous bÃ©nÃ©ficierez d\'un parking privÃ© et gratuit sur place. De plus, la rÃ©ception ouverte 24h/24 vous fournira des informations touristiques locales.', 'Connexion Wi-Fi gratuite,  Navette aÃ©roport, Piscine,  Parking gratuit,  Chambres familiales,  Spa et centre de bien-Ãªtre,  Bar', 'B.P. 345, Avenue de la Ligue Arabe, Tunis 1080', '4', '10.1606623,15', '36.8311401', 1, '0000-00-00 00:00:00', '2018-10-17 10:24:10'),
(5, 1, 'GOLDEN TULIP EL MECHTEL', 'ss', 'ss', 'Avenue Ouled Hafouz, Tunis 1005', '4', '10.1739551,15', '36.8135896', 1, '0000-00-00 00:00:00', '2018-10-17 10:24:45');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_categories`
--

CREATE TABLE `hotel_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_images`
--

CREATE TABLE `hotel_images` (
  `id` int(11) NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `main` tinyint(1) NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotel_images`
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
-- Table structure for table `hotel_package`
--

CREATE TABLE `hotel_package` (
  `id` int(11) NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_personnes` int(11) NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotel_package`
--

INSERT INTO `hotel_package` (`id`, `hotel_id`, `designation`, `nb_personnes`, `picture`, `enabled`, `created_at`, `updated_at`) VALUES
(1, 1, 'Chambre Double en petit Dejeuner', 2, 'hotel_novotel_chambre.jpg', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 'Chambre Single en petit Dejeuner', 1, 'hotel_novotel_chambre.jpg', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 2, 'Chambre Double en petit dejeuner', 2, 'hotel_acropole_chambre.jpg', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 2, 'Chambre Single en petit dejeuner', 1, 'hotel_acropole_chambre.jpg', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 4, 'Chambre Single en Petit DÃ©jeuner', 1, '95673d30cd4251816692933219001fc4.jpeg', 1, '2018-10-20 13:35:30', '2018-10-20 13:35:30');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_package_periode`
--

CREATE TABLE `hotel_package_periode` (
  `id` int(11) NOT NULL,
  `package_id` int(11) DEFAULT NULL,
  `prix_achat` double NOT NULL,
  `comission` double NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotel_package_periode`
--

INSERT INTO `hotel_package_periode` (`id`, `package_id`, `prix_achat`, `comission`, `date_debut`, `date_fin`, `enabled`, `created_at`, `updated_at`) VALUES
(1, 1, 120, 30, '2019-02-16 00:00:00', '2019-02-24 00:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 200, 30, '2019-02-16 00:00:00', '2019-02-24 00:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 3, 300, 30, '2019-02-16 00:00:00', '2019-02-24 00:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 4, 400, 30, '2019-02-16 00:00:00', '2019-02-24 00:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 5, 120, 20, '2019-02-01 00:00:00', '2019-02-28 00:00:00', 1, '2018-10-20 13:36:58', '2018-10-20 13:36:58');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_reservation_package`
--

CREATE TABLE `hotel_reservation_package` (
  `id` int(11) NOT NULL,
  `reservation_hotel_id` int(11) DEFAULT NULL,
  `hotel_package_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `path`, `name`, `size`, `enabled`, `created_at`, `updated_at`) VALUES
(1, 'Jaloul-Ayed-01-352x352.jpg', 'Jalloul', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Mme-Lamia-352x352.jpg', 'Lamia', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `journees`
--

CREATE TABLE `journees` (
  `id` int(11) NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `journees`
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
-- Table structure for table `journees_images`
--

CREATE TABLE `journees_images` (
  `journee_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `title`, `title_en`, `link`, `enabled`, `created_at`, `updated_at`) VALUES
(1, 'Présentation', 'About Us', '#csi-about', 1, '2018-10-21 10:17:54', '2018-10-26 09:10:21'),
(2, 'Programme', 'Program', '#csi-schedule', 1, '2018-10-21 10:18:47', '2018-10-21 13:56:13'),
(3, 'Intervenants', 'Speakers', '#csi-speakers', 1, '2018-10-21 10:19:14', '2018-10-21 10:19:14'),
(4, 'Sponsors', 'Sponsors', '#csi-sponsors', 1, '2018-10-21 10:19:48', '2018-10-21 10:19:48'),
(5, 'Conférence', 'Conference', '#csi-registration', 0, '2018-10-21 10:20:58', '2018-10-26 09:10:38'),
(6, 'Liste des participants', 'List of participants', '/fr/participants', 0, '2018-10-21 10:22:36', '2018-10-21 11:17:54'),
(7, 'Informations', 'Informations', NULL, 1, '2018-10-21 13:34:38', '2018-10-21 13:34:38');

-- --------------------------------------------------------

--
-- Table structure for table `motifs`
--

CREATE TABLE `motifs` (
  `id` int(11) NOT NULL,
  `property_path` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `motifs`
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
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `notification_type` int(11) DEFAULT NULL,
  `subject` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
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
-- Table structure for table `notification_has_pattern`
--

CREATE TABLE `notification_has_pattern` (
  `notification_id` int(11) NOT NULL,
  `pattern_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_has_pattern`
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
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_en` longtext COLLATE utf8mb4_unicode_ci,
  `slug` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug_en` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `summary`, `content`, `enabled`, `created_at`, `updated_at`, `title_en`, `summary_en`, `content_en`, `slug`, `slug_en`, `menu_id`) VALUES
(1, 'Bienvenue', 'On the land of Tunisia,The land of meetings and civilizations,', '<p>The Tunisian Federation of Insurance companies FTUSA, the General Arab Insurance Federation GAIF and the Tunisian Reinsurance Company Tunis RE, have the honor to invite you to attend the 32nd General Conference from 24 to 27 June 2018 in Hammamet, under the high patronage of his Excellency the President of the Republic of Tunisia. The conference is organized under the theme: Digital Transformation and the Insurance Industry in the Arab World</p>', 1, '2018-10-03 00:00:00', '2018-10-21 13:39:55', 'Welcome', 'the high patronage of his Excellency the Presid', '<p>The rapid technological changes witnessed in the world by digital discoveries and artificial intelligence or what is expressed by the Fourth Industrial Revolution will change the relationship of the human environment and will inevitably lead to a comprehensive change in the needs and ways to respond to them by economic and financial actors. The insurance sector will not be isolated from these transformations, which will enshrine the concept of the digital global village and there will be no land, country, sector or company deprived from these changes. The Organizing Committee hopes that this conference will be an occasion to examine the mechanisms of voluntary engagement in this digital revolution to serve our clients and to ensure the sustainability of the insurance industry in our countries. On behalf offfffffffffffffffff</p>', 'bienvenue', 'welcome', 7),
(2, 'Visa', 'and to facilitate the process of o', '<p>General Entry requirements for international visitors You are Kindly requested to send to the Tunisian Federation Of Insurance Companies (FTUSA) as soon as possible a copy of your passport and these information to facilitate the obtain of the entry visa to Tunisia from 24th to 27 th June 2018 to attend the 32nd General Conference of the Arab Insurance Union which will be held in Hammamet. In case of the absence of diplomatic consuls or diplomatic representation in your country, the visa could be</p>\r\n\r\n<p><img alt=\"\" src=\"https://lemag.nikonclub.fr/wp-content/uploads/2017/07/08.jpg\" style=\"height:1278px; width:1920px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>handed by the border police stations in Tunisia. This visa is granted and its fees are about 15$ US and they should be paid in Tunisian dinar. For this purpose and to facilitate the process of obtaining the entry visa to the Tunisian country, please provide the Tunisian Federation of insurance companies before the 31st May, 2018 the requested information: Download VISA document</p>\r\n\r\n<p>&nbsp;</p>', 1, '2018-10-03 00:00:00', '2018-10-21 15:10:13', 'Visa_eng', 'btain of the entry visa to Tunisia f', '<p>General Entry requirements for international visitors You are Kindly requested to send to the Tunisian Federation Of Insurance Companies (FTUSA) as soon as possible a copy of your passport and these information to facilitate the obtain of the entry visa to Tunisia from 24th to 27 th June 2018 to attend the 32nd General Conference of the Arab Insurance Union which will be held in Hammamet. In case of the absence of diplomatic consuls or diplomatic representation in your country, the visa could be handed by the border police stations in Tunisia. This visa is granted and its fees are about 15$ US and they should be paid in Tunisian dinar. For this purpose and to facilitate the process of obtaining the entry visa to the Tunisian country, please provide the Tunisian Federation of insurance companies before the 31st May, 2018 the requested information: &gt;&gt; Download VISA document</p>', 'visa', 'visa', 7),
(3, 'Information', 'her major attraction is the magnificent Bardo Museum, famous for its exceptional collection of Roman mosaics.', 'Connected to the North and South of the country by two motorways and located at the heart of a region full of archaeological sites and places of interest, Tunis is a natural starting point for a whole variety of excursions. Visitors to the capital should allow enough time to explore its medina, monuments (the Great Mosque, the Tourbet El-Bey Mausoleum), palaces and souks, which contain a plethora of temptations. Another major attraction is the magnificent Bardo Museum, famous for its exceptional collection of Roman mosaics.', 1, '2018-10-03 00:00:00', '2018-10-03 00:00:00', 'Infor_eng', 'archaeological s', 'Connected to the North and South of the country by two motorways and located at the heart of a region full of archaeological sites and places of interest, Tunis is a natural starting point for a whole variety of excursions. Visitors to the capital should allow enough time to explore its medina, monuments (the Great Mosque, the Tourbet El-Bey Mausoleum), palaces and souks, which contain a plethora of temptations. Another major attraction is the magnificent Bardo Museum, famous for its exceptional collection of Roman mosaics.', 'information', 'information', NULL),
(4, 'Espace publicitaire', 'ffdf', '<p>jjjjjjjjjjjjjjjjjjjjjjj<s><strong>jjjjjjjjjjjjjjjjjjjjjj</strong></s></p>\r\n\r\n<p>&nbsp;</p>', 1, '2018-10-20 14:54:41', '2018-10-20 14:54:41', 'Stand', 'jjjjjjjjjjjjjj', '<p>sqfdqsdqsd</p>', 'espace-publicitaire', 'stand', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` int(11) NOT NULL,
  `participant_type_id` int(11) DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `societe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `poste` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `biographie` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tweeter_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_arrive` datetime DEFAULT NULL,
  `date_depart` datetime DEFAULT NULL,
  `num_vol_arrive` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_vol_depart` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationalite` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`id`, `participant_type_id`, `firstname`, `lastname`, `username`, `password`, `email`, `societe`, `poste`, `telephone`, `biographie`, `tweeter_link`, `linkedin_link`, `telephone2`, `salt`, `enabled`, `created_at`, `updated_at`, `picture`, `slug`, `date_arrive`, `date_depart`, `num_vol_arrive`, `num_vol_depart`, `nationalite`, `gender`) VALUES
(2, 7, 'Jalloul', 'Ayed', 'Jalloul', 'Jalloul', 'Ahmed@tt.com', 'Societe AJalloul', 'Poste JAlloul', '213 564 789', 'Biobliographie Jalloul Ayed', NULL, NULL, NULL, '', 1, '2018-10-30 00:00:00', '2018-10-30 00:00:00', 'Jaloul-Ayed-01-352x352.jpg', 'jalloul-ayed', NULL, NULL, '', '', NULL, NULL),
(3, 7, 'Lamia', 'Ben Mahmoud', 'Lamia', 'Lamia', 'Lamia@test.com', 'Societe Lamia', 'Poste Lamia', '123456', 'Bibliographie Lamia', NULL, NULL, NULL, '', 1, '2018-10-30 00:00:00', '2018-10-30 00:00:00', 'Mme-Lamia-352x352.jpg', 'lamia-ben-mahmoud', NULL, NULL, '', '', NULL, NULL),
(8, 7, 'Laurant', 'Motador', 'Laurant', 'Laurant', 'Laurant@test.com', 'Société Laurant', 'Poste Laurant', '21345989', 'Bibliographie Laurant', NULL, NULL, NULL, '', 1, '2018-10-30 00:00:00', '2018-10-30 00:00:00', 'Mondatorts-352x352-352x352.jpg', 'laurant-matador', NULL, NULL, '', '', NULL, NULL),
(9, 7, 'Jose', 'Castelo', 'Castelo', 'Castelo', 'Castelo@test.com', 'Societe Castelo', 'Poste Castelo', 'Tel Castelo', 'Bobliographie Castelo', NULL, NULL, NULL, '', 1, '2018-10-30 00:00:00', '2018-10-30 00:00:00', 'Jose-Castelo-352x352.jpg', 'jose-castelo', NULL, NULL, '', '', NULL, NULL),
(10, 7, 'Andreas', 'Pollman', 'Pollman', 'Pollman', 'Pollman@test.com', 'Societe Pollman', 'Poste Pollman', '45612233', 'Bibliographie Pollman', NULL, NULL, NULL, '', 1, '2018-10-30 00:00:00', '2018-10-30 00:00:00', 'poulman-352x352.jpg', 'andreas-pollman', NULL, NULL, '', '', NULL, NULL),
(17, 6, 'karim', 'Sahab Ettabaa', 'karim@travelportal.cz', '$2y$13$YSJJ40fvnaS9ytne4lXs5O4hmzlbRKOh05m9JQz.hmP/0chGzEU5i', 'karim@travelportal.cz', 'Conf2018', 'Poste Conf2018', '+216000000', 'Bibliographie Karim', NULL, NULL, '+216000000', '2744c440213968a39bb0bc20adfe1228', 1, '2018-10-13 12:23:36', '2018-10-30 18:12:36', '', 'karim-sahab-ettabaa', '2018-10-30 00:00:00', '2018-10-30 00:00:00', 'dfsdf', 'sdfsdf', 'Tunisienne', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `participants_type`
--

CREATE TABLE `participants_type` (
  `id` int(11) NOT NULL,
  `label` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `tarif_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `participants_type`
--

INSERT INTO `participants_type` (`id`, `label`, `enabled`, `created_at`, `updated_at`, `tarif_id`) VALUES
(6, 'Participant', 1, '2018-10-13 12:23:35', '2018-10-13 12:23:35', 1),
(7, 'Intervenant', 1, '2018-10-13 12:23:35', '2018-10-13 12:23:35', 2),
(8, 'Invite', 1, '2018-10-13 12:23:35', '2018-10-13 12:23:35', 2),
(9, 'VIP', 1, '2018-10-13 12:23:35', '2018-10-13 12:23:35', 2),
(10, 'Organisation', 1, '2018-10-13 12:23:35', '2018-10-13 12:23:35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pays`
--

CREATE TABLE `pays` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pays`
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
(14, 'République démocratique du Congo');

-- --------------------------------------------------------

--
-- Table structure for table `programmes`
--

CREATE TABLE `programmes` (
  `id` int(11) NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_places_disponibles` int(11) NOT NULL,
  `emplacement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inscription_active` tinyint(1) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `journee_id` int(11) DEFAULT NULL,
  `heure_debut` datetime NOT NULL,
  `heure_fin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programmes`
--

INSERT INTO `programmes` (`id`, `designation`, `nb_places_disponibles`, `emplacement`, `inscription_active`, `description`, `enabled`, `created_at`, `updated_at`, `journee_id`, `heure_debut`, `heure_fin`) VALUES
(1, 'Program1, journee 1', 40, 'Salle1', 1, 'Programme 1 description', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-06-24 08:30:00', '2019-06-24 09:30:00'),
(2, 'Programme 2, journee 1', 30, 'Salle2', 1, 'Description Programme 2, journee 1', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-06-24 09:30:00', '2019-06-24 10:30:00'),
(3, 'Programme 3, journee 1', 60, 'Salle20', 1, 'Description Programme 3, journee 1', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-06-24 10:30:00', '2019-06-24 11:30:00'),
(4, 'Programme 1, journee 2', 60, 'Salle20', 1, 'Description Programme 1, journee 2', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, '2019-06-25 08:30:00', '2019-06-25 09:30:00'),
(5, 'Programme 2, journee 2', 60, 'Salle20', 1, 'Description Programme 2, journee 2', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, '2019-06-25 09:30:00', '2019-06-25 10:30:00'),
(6, 'Programme 3, journee 2', 60, 'Salle20', 1, 'Description Programme 3, journee 2', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, '2019-06-25 10:30:00', '2019-06-25 11:30:00'),
(7, 'Programme 1, journee 3', 60, 'Salle20', 1, 'Description Programme 1, journee 3', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, '2019-06-26 08:30:00', '2019-06-26 09:30:00'),
(8, 'Programme 2, journee 3', 60, 'Salle20', 1, 'Description Programme 2, journee 3', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, '2019-06-26 09:30:00', '2019-06-26 10:30:00'),
(9, 'Programme 3, journee 3', 60, 'Salle20', 1, 'Description Programme 3, journee 3', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, '2019-06-26 10:30:00', '2019-06-26 11:30:00'),
(10, 'Pause cafe', 0, '', 0, NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-02-17 17:30:00', '2019-02-17 19:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `programmes_documents`
--

CREATE TABLE `programmes_documents` (
  `programme_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programmes_images`
--

CREATE TABLE `programmes_images` (
  `programme_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programmes_intervenants`
--

CREATE TABLE `programmes_intervenants` (
  `programme_id` int(11) NOT NULL,
  `intervenant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programmes_intervenants`
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
-- Table structure for table `programmes_videos`
--

CREATE TABLE `programmes_videos` (
  `programme_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `state` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Waiting',
  `totalPrice` double NOT NULL,
  `payment_method` int(11) NOT NULL,
  `reservation_ref` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `participant_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations_event`
--

CREATE TABLE `reservations_event` (
  `id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `total` double NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations_hotel`
--

CREATE TABLE `reservations_hotel` (
  `id` int(11) NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `total` double NOT NULL,
  `nb_jours` int(11) NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations_supplements`
--

CREATE TABLE `reservations_supplements` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `montant` double NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation_supplements_supplement`
--

CREATE TABLE `reservation_supplements_supplement` (
  `reservation_supplements_id` int(11) NOT NULL,
  `supplement_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_role` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `parent_id`, `name`, `order_role`, `enabled`, `created_at`, `updated_at`) VALUES
(1, NULL, 'ROLE_ADMIN', 1, 1, '2018-10-13 12:23:35', '2018-10-13 12:23:35'),
(2, NULL, 'ROLE_USER', 2, 1, '2018-10-13 12:23:35', '2018-10-13 12:23:35');

-- --------------------------------------------------------

--
-- Table structure for table `sponsors`
--

CREATE TABLE `sponsors` (
  `id` int(11) NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_web` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sponsors`
--

INSERT INTO `sponsors` (`id`, `designation`, `logo`, `site_web`, `enabled`, `created_at`, `updated_at`, `type_id`) VALUES
(1, 'Sponsor1', 'Almourakeb.jpg', 'http://www.sponsor1.com', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(2, 'sponsor2', 'Continental-2.jpg', 'http://www.sponsor2.com', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(3, 'Sponsor3', 'logoMapfre.jpg', 'http://www.sponsor3.com', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(4, 'sponsor4', 'Standard-logo-NEXtCARE-copy.jpg', 'http://www.sponsor4.com', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(5, 'Sponsor5', 'Standard-logo-Tunisre-copy-201x110.jpg', 'http://www.sponsor5.com', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(6, 'sponsor6', 'Takafulia.jpg', 'http://www.sponsor6.com', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `sponsors_type`
--

CREATE TABLE `sponsors_type` (
  `id` int(11) NOT NULL,
  `label` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sponsors_type`
--

INSERT INTO `sponsors_type` (`id`, `label`, `enabled`, `created_at`, `updated_at`) VALUES
(1, 'Dinner Sponsors', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Golden Sponsors', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Media Sponsors', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Other Sponsors', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `supplements`
--

CREATE TABLE `supplements` (
  `id` int(11) NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` double NOT NULL,
  `lieu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `event_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplements`
--

INSERT INTO `supplements` (`id`, `designation`, `prix`, `lieu`, `enabled`, `created_at`, `updated_at`, `event_id`) VALUES
(1, 'Ecursion Musée du Bardo', 50, 'Bardo, Tunis', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(2, 'Le temple des eaux', 40, 'Zagouan, Tunis', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(3, 'Vestiges de l\'ancienne ville carthaginoise', 60, 'Carthage, Tunis', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(4, 'Diner Gala', 100, 'Hotel Ibis, Tunis', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tarifs`
--

CREATE TABLE `tarifs` (
  `id` int(11) NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` double NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `event_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tarifs`
--

INSERT INTO `tarifs` (`id`, `label`, `prix`, `enabled`, `created_at`, `updated_at`, `event_id`) VALUES
(1, 'Non Membre', 300, 1, '2018-10-21 00:00:00', '2018-10-21 00:00:00', 1),
(2, 'Membre', 100, 1, '2018-10-21 00:00:00', '2018-10-21 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_has_role`
--

CREATE TABLE `user_has_role` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_has_role`
--

INSERT INTO `user_has_role` (`user_id`, `role_id`) VALUES
(17, 1),
(17, 2);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `villes`
--

CREATE TABLE `villes` (
  `id` int(11) NOT NULL,
  `pays_id` int(11) DEFAULT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `villes`
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
-- Indexes for dumped tables
--

--
-- Indexes for table `configuration`
--
ALTER TABLE `configuration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A5E2A5D7A6E44244` (`pays_id`),
  ADD KEY `IDX_A5E2A5D7A73F0036` (`ville_id`);

--
-- Indexes for table `devises`
--
ALTER TABLE `devises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5387574AA6E44244` (`pays_id`),
  ADD KEY `IDX_5387574AA73F0036` (`ville_id`);

--
-- Indexes for table `events_documents`
--
ALTER TABLE `events_documents`
  ADD PRIMARY KEY (`event_id`,`document_id`),
  ADD UNIQUE KEY `UNIQ_3B4417AAC33F7837` (`document_id`),
  ADD KEY `IDX_3B4417AA71F7E88B` (`event_id`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E402F625A73F0036` (`ville_id`);

--
-- Indexes for table `hotel_categories`
--
ALTER TABLE `hotel_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_images`
--
ALTER TABLE `hotel_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7CF56C0D3243BB18` (`hotel_id`);

--
-- Indexes for table `hotel_package`
--
ALTER TABLE `hotel_package`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D2279BC3243BB18` (`hotel_id`);

--
-- Indexes for table `hotel_package_periode`
--
ALTER TABLE `hotel_package_periode`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_ADD6FA12F44CABFF` (`package_id`);

--
-- Indexes for table `hotel_reservation_package`
--
ALTER TABLE `hotel_reservation_package`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_64F73821AFF6590C` (`reservation_hotel_id`),
  ADD KEY `IDX_64F7382181984112` (`hotel_package_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `journees`
--
ALTER TABLE `journees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C569465471F7E88B` (`event_id`);

--
-- Indexes for table `journees_images`
--
ALTER TABLE `journees_images`
  ADD PRIMARY KEY (`journee_id`,`document_id`),
  ADD UNIQUE KEY `UNIQ_C2067634C33F7837` (`document_id`),
  ADD KEY `IDX_C2067634CF066148` (`journee_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `motifs`
--
ALTER TABLE `motifs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_has_pattern`
--
ALTER TABLE `notification_has_pattern`
  ADD PRIMARY KEY (`notification_id`,`pattern_id`),
  ADD KEY `IDX_11D6A714EF1A9D84` (`notification_id`),
  ADD KEY `IDX_11D6A714F734A20F` (`pattern_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_2074E5752B36786B` (`title`),
  ADD UNIQUE KEY `UNIQ_2074E57546FF21AF` (`title_en`),
  ADD UNIQUE KEY `UNIQ_2074E575989D9B62` (`slug`),
  ADD UNIQUE KEY `UNIQ_2074E5757D79C0DC` (`slug_en`),
  ADD KEY `IDX_2074E575CCD7E912` (`menu_id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_71697092F85E0677` (`username`),
  ADD UNIQUE KEY `UNIQ_71697092E7927C74` (`email`),
  ADD UNIQUE KEY `UNIQ_71697092989D9B62` (`slug`),
  ADD KEY `IDX_716970925F41439B` (`participant_type_id`);

--
-- Indexes for table `participants_type`
--
ALTER TABLE `participants_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_60204BC6EA750E8` (`label`),
  ADD KEY `IDX_60204BC6357C0A59` (`tarif_id`);

--
-- Indexes for table `pays`
--
ALTER TABLE `pays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programmes`
--
ALTER TABLE `programmes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3631FC3FCF066148` (`journee_id`);

--
-- Indexes for table `programmes_documents`
--
ALTER TABLE `programmes_documents`
  ADD PRIMARY KEY (`programme_id`,`document_id`),
  ADD UNIQUE KEY `UNIQ_84C2F925C33F7837` (`document_id`),
  ADD KEY `IDX_84C2F92562BB7AEE` (`programme_id`);

--
-- Indexes for table `programmes_images`
--
ALTER TABLE `programmes_images`
  ADD PRIMARY KEY (`programme_id`,`image_id`),
  ADD UNIQUE KEY `UNIQ_6C56637B3DA5256D` (`image_id`),
  ADD KEY `IDX_6C56637B62BB7AEE` (`programme_id`);

--
-- Indexes for table `programmes_intervenants`
--
ALTER TABLE `programmes_intervenants`
  ADD PRIMARY KEY (`programme_id`,`intervenant_id`),
  ADD KEY `IDX_CE7C9D4562BB7AEE` (`programme_id`),
  ADD KEY `IDX_CE7C9D45AB9A1716` (`intervenant_id`);

--
-- Indexes for table `programmes_videos`
--
ALTER TABLE `programmes_videos`
  ADD PRIMARY KEY (`programme_id`,`video_id`),
  ADD UNIQUE KEY `UNIQ_A5E3B92329C1004E` (`video_id`),
  ADD KEY `IDX_A5E3B92362BB7AEE` (`programme_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4DA2399D1C3019` (`participant_id`);

--
-- Indexes for table `reservations_event`
--
ALTER TABLE `reservations_event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F17AFC4871F7E88B` (`event_id`),
  ADD KEY `IDX_F17AFC48B83297E7` (`reservation_id`);

--
-- Indexes for table `reservations_hotel`
--
ALTER TABLE `reservations_hotel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C987A8363243BB18` (`hotel_id`),
  ADD KEY `IDX_C987A836B83297E7` (`reservation_id`);

--
-- Indexes for table `reservations_supplements`
--
ALTER TABLE `reservations_supplements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_ECDFDE9EB83297E7` (`reservation_id`);

--
-- Indexes for table `reservation_supplements_supplement`
--
ALTER TABLE `reservation_supplements_supplement`
  ADD PRIMARY KEY (`reservation_supplements_id`,`supplement_id`),
  ADD KEY `IDX_7D021855BE5B7FB8` (`reservation_supplements_id`),
  ADD KEY `IDX_7D0218557793FA21` (`supplement_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_B63E2EC75E237E06` (`name`),
  ADD KEY `IDX_B63E2EC7727ACA70` (`parent_id`);

--
-- Indexes for table `sponsors`
--
ALTER TABLE `sponsors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9A31550FC54C8C93` (`type_id`);

--
-- Indexes for table `sponsors_type`
--
ALTER TABLE `sponsors_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplements`
--
ALTER TABLE `supplements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F9B7EF6C71F7E88B` (`event_id`);

--
-- Indexes for table `tarifs`
--
ALTER TABLE `tarifs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F9B8C49671F7E88B` (`event_id`);

--
-- Indexes for table `user_has_role`
--
ALTER TABLE `user_has_role`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `IDX_EAB8B535A76ED395` (`user_id`),
  ADD KEY `IDX_EAB8B535D60322AC` (`role_id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `villes`
--
ALTER TABLE `villes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ville_pays1_idx` (`pays_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `configuration`
--
ALTER TABLE `configuration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `devises`
--
ALTER TABLE `devises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hotel_categories`
--
ALTER TABLE `hotel_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotel_images`
--
ALTER TABLE `hotel_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `hotel_package`
--
ALTER TABLE `hotel_package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hotel_package_periode`
--
ALTER TABLE `hotel_package_periode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hotel_reservation_package`
--
ALTER TABLE `hotel_reservation_package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `journees`
--
ALTER TABLE `journees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `motifs`
--
ALTER TABLE `motifs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `participants_type`
--
ALTER TABLE `participants_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pays`
--
ALTER TABLE `pays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `programmes`
--
ALTER TABLE `programmes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations_event`
--
ALTER TABLE `reservations_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations_hotel`
--
ALTER TABLE `reservations_hotel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations_supplements`
--
ALTER TABLE `reservations_supplements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sponsors`
--
ALTER TABLE `sponsors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sponsors_type`
--
ALTER TABLE `sponsors_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `supplements`
--
ALTER TABLE `supplements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tarifs`
--
ALTER TABLE `tarifs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `villes`
--
ALTER TABLE `villes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `configuration`
--
ALTER TABLE `configuration`
  ADD CONSTRAINT `FK_A5E2A5D7A6E44244` FOREIGN KEY (`pays_id`) REFERENCES `pays` (`id`),
  ADD CONSTRAINT `FK_A5E2A5D7A73F0036` FOREIGN KEY (`ville_id`) REFERENCES `villes` (`id`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `FK_5387574AA6E44244` FOREIGN KEY (`pays_id`) REFERENCES `pays` (`id`),
  ADD CONSTRAINT `FK_5387574AA73F0036` FOREIGN KEY (`ville_id`) REFERENCES `villes` (`id`);

--
-- Constraints for table `events_documents`
--
ALTER TABLE `events_documents`
  ADD CONSTRAINT `FK_3B4417AA71F7E88B` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `FK_3B4417AAC33F7837` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`);

--
-- Constraints for table `hotels`
--
ALTER TABLE `hotels`
  ADD CONSTRAINT `FK_E402F625A73F0036` FOREIGN KEY (`ville_id`) REFERENCES `villes` (`id`);

--
-- Constraints for table `hotel_images`
--
ALTER TABLE `hotel_images`
  ADD CONSTRAINT `FK_7CF56C0D3243BB18` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`);

--
-- Constraints for table `hotel_package`
--
ALTER TABLE `hotel_package`
  ADD CONSTRAINT `FK_D2279BC3243BB18` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`);

--
-- Constraints for table `hotel_package_periode`
--
ALTER TABLE `hotel_package_periode`
  ADD CONSTRAINT `FK_ADD6FA12F44CABFF` FOREIGN KEY (`package_id`) REFERENCES `hotel_package` (`id`);

--
-- Constraints for table `hotel_reservation_package`
--
ALTER TABLE `hotel_reservation_package`
  ADD CONSTRAINT `FK_64F7382181984112` FOREIGN KEY (`hotel_package_id`) REFERENCES `hotel_package` (`id`),
  ADD CONSTRAINT `FK_64F73821AFF6590C` FOREIGN KEY (`reservation_hotel_id`) REFERENCES `reservations_hotel` (`id`);

--
-- Constraints for table `journees`
--
ALTER TABLE `journees`
  ADD CONSTRAINT `FK_C569465471F7E88B` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

--
-- Constraints for table `journees_images`
--
ALTER TABLE `journees_images`
  ADD CONSTRAINT `FK_C2067634C33F7837` FOREIGN KEY (`document_id`) REFERENCES `images` (`id`),
  ADD CONSTRAINT `FK_C2067634CF066148` FOREIGN KEY (`journee_id`) REFERENCES `journees` (`id`);

--
-- Constraints for table `notification_has_pattern`
--
ALTER TABLE `notification_has_pattern`
  ADD CONSTRAINT `FK_11D6A714EF1A9D84` FOREIGN KEY (`notification_id`) REFERENCES `notifications` (`id`),
  ADD CONSTRAINT `FK_11D6A714F734A20F` FOREIGN KEY (`pattern_id`) REFERENCES `motifs` (`id`);

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `FK_2074E575CCD7E912` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`);

--
-- Constraints for table `participants`
--
ALTER TABLE `participants`
  ADD CONSTRAINT `FK_716970925F41439B` FOREIGN KEY (`participant_type_id`) REFERENCES `participants_type` (`id`);

--
-- Constraints for table `participants_type`
--
ALTER TABLE `participants_type`
  ADD CONSTRAINT `FK_60204BC6357C0A59` FOREIGN KEY (`tarif_id`) REFERENCES `tarifs` (`id`);

--
-- Constraints for table `programmes`
--
ALTER TABLE `programmes`
  ADD CONSTRAINT `FK_3631FC3FCF066148` FOREIGN KEY (`journee_id`) REFERENCES `journees` (`id`);

--
-- Constraints for table `programmes_documents`
--
ALTER TABLE `programmes_documents`
  ADD CONSTRAINT `FK_84C2F92562BB7AEE` FOREIGN KEY (`programme_id`) REFERENCES `programmes` (`id`),
  ADD CONSTRAINT `FK_84C2F925C33F7837` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`);

--
-- Constraints for table `programmes_images`
--
ALTER TABLE `programmes_images`
  ADD CONSTRAINT `FK_6C56637B3DA5256D` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`),
  ADD CONSTRAINT `FK_6C56637B62BB7AEE` FOREIGN KEY (`programme_id`) REFERENCES `programmes` (`id`);

--
-- Constraints for table `programmes_intervenants`
--
ALTER TABLE `programmes_intervenants`
  ADD CONSTRAINT `FK_CE7C9D4562BB7AEE` FOREIGN KEY (`programme_id`) REFERENCES `programmes` (`id`),
  ADD CONSTRAINT `FK_CE7C9D45AB9A1716` FOREIGN KEY (`intervenant_id`) REFERENCES `participants` (`id`);

--
-- Constraints for table `programmes_videos`
--
ALTER TABLE `programmes_videos`
  ADD CONSTRAINT `FK_A5E3B92329C1004E` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`),
  ADD CONSTRAINT `FK_A5E3B92362BB7AEE` FOREIGN KEY (`programme_id`) REFERENCES `programmes` (`id`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `FK_4DA2399D1C3019` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`id`);

--
-- Constraints for table `reservations_event`
--
ALTER TABLE `reservations_event`
  ADD CONSTRAINT `FK_F17AFC4871F7E88B` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `FK_F17AFC48B83297E7` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`);

--
-- Constraints for table `reservations_hotel`
--
ALTER TABLE `reservations_hotel`
  ADD CONSTRAINT `FK_C987A8363243BB18` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`),
  ADD CONSTRAINT `FK_C987A836B83297E7` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`);

--
-- Constraints for table `reservations_supplements`
--
ALTER TABLE `reservations_supplements`
  ADD CONSTRAINT `FK_ECDFDE9EB83297E7` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`);

--
-- Constraints for table `reservation_supplements_supplement`
--
ALTER TABLE `reservation_supplements_supplement`
  ADD CONSTRAINT `FK_7D0218557793FA21` FOREIGN KEY (`supplement_id`) REFERENCES `supplements` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_7D021855BE5B7FB8` FOREIGN KEY (`reservation_supplements_id`) REFERENCES `reservations_supplements` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `FK_B63E2EC7727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `sponsors`
--
ALTER TABLE `sponsors`
  ADD CONSTRAINT `FK_9A31550FC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `sponsors_type` (`id`);

--
-- Constraints for table `supplements`
--
ALTER TABLE `supplements`
  ADD CONSTRAINT `FK_F9B7EF6C71F7E88B` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

--
-- Constraints for table `tarifs`
--
ALTER TABLE `tarifs`
  ADD CONSTRAINT `FK_F9B8C49671F7E88B` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

--
-- Constraints for table `user_has_role`
--
ALTER TABLE `user_has_role`
  ADD CONSTRAINT `FK_EAB8B535A76ED395` FOREIGN KEY (`user_id`) REFERENCES `participants` (`id`),
  ADD CONSTRAINT `FK_EAB8B535D60322AC` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `villes`
--
ALTER TABLE `villes`
  ADD CONSTRAINT `FK_19209FD8A6E44244` FOREIGN KEY (`pays_id`) REFERENCES `pays` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
