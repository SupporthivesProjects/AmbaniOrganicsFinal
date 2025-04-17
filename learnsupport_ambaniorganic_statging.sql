-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 17, 2025 at 08:21 AM
-- Server version: 10.6.18-MariaDB
-- PHP Version: 8.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `learnsupport_ambaniorganic_statging`
--

-- --------------------------------------------------------

--
-- Table structure for table `accelerators`
--

CREATE TABLE `accelerators` (
  `id` int(5) NOT NULL,
  `product` varchar(1000) NOT NULL,
  `activeMetal` varchar(1000) NOT NULL,
  `Properties` varchar(1000) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `accelerators`
--

INSERT INTO `accelerators` (`id`, `product`, `activeMetal`, `Properties`, `status`, `createdOn`) VALUES
(1, 'RAA PRO CO 12%', '12.0', 'COBALT ACCELERATOR', 1, '2025-04-11 08:21:05'),
(2, 'RAA PRO CO 6%', '6.0', 'COBALT ACCELERATOR', 1, '2025-04-11 08:21:05'),
(3, 'RAA PRO CO 3%', '3.0', 'COBALT ACCELERATOR', 1, '2025-04-11 08:21:05'),
(4, 'RAA PRO CO 2%', '2.0', 'COBALT ACCELERATOR', 1, '2025-04-11 08:21:05'),
(5, 'RAA PRO CO 1%', '1.0', 'COBALT ACCELERATOR', 1, '2025-04-11 08:21:05'),
(6, 'RAA PRO CN 8.6%', '8.6', 'COPPER ACCELERATOR', 1, '2025-04-11 08:21:05'),
(7, 'RAA PRO CN 8%', '8.0', 'COPPER ACCELERATOR', 1, '2025-04-11 08:21:05'),
(8, 'RAA PRO CN 6%', '6.0', 'COPPER ACCELERATOR', 1, '2025-04-11 08:21:05'),
(9, 'RAA PRO PO 15%', '15.0', 'POTASSIUM ACCELERATOR', 1, '2025-04-11 08:21:05'),
(10, 'RAA PRO PO 10%', '10.0', 'POTASSIUM ACCELERATOR', 1, '2025-04-11 08:21:05'),
(11, 'RAA PRO CO ACL 12', '12.6', 'COBALT ACCELERATOR ( Economic Grade)', 1, '2025-04-11 08:21:05'),
(12, 'RAA PRO CO ACL 10', '10.5', 'COBALT ACCELERATOR ( Economic Grade)', 1, '2025-04-11 08:21:05'),
(13, 'RAA PRO CO ACL 6', '6.8', 'COBALT ACCELERATOR ( Economic Grade)', 1, '2025-04-11 08:21:05'),
(14, 'RAA PRO CO ACL 4', '4.5', 'COBALT ACCELERATOR ( Economic Grade)', 1, '2025-04-11 08:21:05'),
(15, 'RAA PRO CO ACL 3', '3.4', 'COBALT ACCELERATOR ( Economic Grade)', 1, '2025-04-11 08:21:05'),
(16, 'RAA PRO CN ACL 2', '2.2', 'COBALT ACCELERATOR ( Economic Grade)', 1, '2025-04-11 08:21:05'),
(17, 'RAA PRO CN ACL 1', '1.1', 'COBALT ACCELERATOR ( Economic Grade)', 1, '2025-04-11 08:21:05'),
(18, 'RAA PRO CO ACC-12CC SPL', '10.5', 'CLEAR CASTE ACCELERATOR', 1, '2025-04-11 08:21:05'),
(19, 'RAA PRO CO ACC-10CC', '8.85', 'CLEAR CASTE ACCELERATOR', 1, '2025-04-11 08:21:05'),
(20, 'RAA PRO CO ACC-ACC 1', '9.7', 'CLEAR CASTE ACCELERATOR', 1, '2025-04-11 08:21:05'),
(21, 'RAA PRO CO ACC-6CC SPL', '5.2', 'CLEAR CASTE ACCELERATOR', 1, '2025-04-11 08:21:05');

-- --------------------------------------------------------

--
-- Table structure for table `acrylicEmulsion`
--

CREATE TABLE `acrylicEmulsion` (
  `id` int(5) NOT NULL,
  `product` varchar(1000) NOT NULL,
  `SOLID CONTENT` varchar(100) DEFAULT NULL,
  `pH` varchar(1000) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT current_timestamp(),
  `Viscosity @ 30°C (cPs) / (Spindle No./RPM)` varchar(100) DEFAULT NULL,
  `application` varchar(1000) NOT NULL,
  `Industry` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `acrylicEmulsion`
--

INSERT INTO `acrylicEmulsion` (`id`, `product`, `SOLID CONTENT`, `pH`, `status`, `createdOn`, `Viscosity @ 30°C (cPs) / (Spindle No./RPM)`, `application`, `Industry`) VALUES
(1, 'AOPL 504', '50 ± 1', '7-9', 1, '2025-04-15 03:51:29', '9000 - 15000 (4/10)', 'Superior quality interior paint with high sheen,Textured coatings, Construction chemical, waterbase crackle finish.', 'Paint Industry'),
(2, 'AOPL 596 T', '50 ± 1', '7-9', 1, '2025-04-15 03:51:29', '1000 - 2500 (4/10)', 'Superior quality exterior paint with high sheen,Textured coatings', 'Paint Industry'),
(3, 'AOPL 504E', '50 ± 1', '7-9', 1, '2025-04-15 03:51:29', '9000 - 15000 (4/10)', 'Superior quality Exterior paint with high sheen,Textured coatings, Construction chemical,waterbase crackle finish. APEO and formaldehyde free.', 'Paint Industry'),
(4, 'AOPL 259', '49 ± 1', '7-9', 1, '2025-04-15 03:51:29', '8000 - 14000 (4/10)', 'Economical Distemper,Low-Cost interior emulsion paint, cement primer, Putty.', 'Paint Industry'),
(5, 'AOPL 2504', '49 ± 1', '7-9', 1, '2025-04-15 03:51:29', '8000 - 14000 (4/10)', 'Economical Distemper, Low cost interior emulsion paint, cement primer,Putty.', 'Paint Industry'),
(6, 'AOPL 3045', '45 ± 1', '7-9', 1, '2025-04-15 03:51:29', '10000 - 15000 (4/10)', 'Economical low cost distemper, interior paint,cement primer.', 'Paint Industry'),
(7, 'AOPL 3055', '45 ± 1', '7-9', 1, '2025-04-15 03:51:29', '10000 - 15000 (4/10)', 'Economical low cost distemper, interior paint,cement primer.', 'Paint Industry'),
(8, 'AOPL 3040', '40 ± 1', '7-9', 1, '2025-04-15 03:51:29', '12000 - 20000 (4/10)', 'Economical Distemper, Low cost interior emulsion paint, cement primer,Putty', 'Paint Industry'),
(9, 'AOPL EL128', '50 ± 1', '7-9', 1, '2025-04-15 03:51:29', '3000 - 5000 (4/10)', 'Superior quality interior and exterior paint with high sheen.', 'Paint Industry'),
(10, 'AOPL MUR 57', '57 ± 1', '6-8', 1, '2025-04-15 03:51:29', '1000 - 3000 (4/20)', 'Suitable for Elastomeric roof coating and masonry coating.', 'Paint Industry'),
(11, 'AOPL 565', '55 ± 1', '7-9', 1, '2025-04-15 03:51:29', '50 - 200 (3/30)', 'High Gloss and Sheen Interior Premium paint with detergent resistance and washability.', 'Paint Industry'),
(12, 'AOPL 561', '50 ± 1', '7-9', 1, '2025-04-15 03:51:29', '30 - 200 (3/30)', 'High gloss,high sheen interior/ exterior paint.', 'Paint Industry'),
(13, 'AOPL 561E', '50 ± 1', '7-9', 1, '2025-04-15 03:51:29', '30 - 200 (3/300)', 'Semi-gloss interior and exterior paint. APEO and formaldehyde free. Coatings for cementitious substrates.', 'Paint Industry'),
(14, 'AOPL PVV 55', '55 ± 1', '4-6', 1, '2025-04-15 03:51:29', '1200 - 2500 (4/10)', 'Semi-gloss to matt interior and exterior paints.', 'Paint Industry'),
(15, 'AOPL PVV 50', '50 ± 1', '4-6', 1, '2025-04-15 03:51:29', '2000 - 4000 (4/10)', 'Semi-gloss interior and exterior paint. Coatings for cementitious substrates.', 'Paint Industry'),
(16, 'AOPL PVB 55', '55 ± 1', '4-6', 1, '2025-04-15 03:51:29', '800 - 1500 (4/10)', 'Interior Flat/ matt paint.', 'Paint Industry'),
(17, 'AOPL PVB 50', '50 ± 1', '8-9', 1, '2025-04-15 03:51:29', '300 - 800 (4/10)', 'Semi-gloss to matt interior and exterior paints.', 'Paint Industry'),
(18, 'AOPL VVL', '50 ± 1', '8-9', 1, '2025-04-15 03:51:29', '20 - 150 (2/10)', 'Interior Flat/ matt paint.', 'Paint Industry'),
(19, 'AOPL EM  50', '50 ± 1', '4-6', 1, '2025-04-15 03:51:29', '50000 - 90000 (7/20)', 'Low-cost semi-gloss interior paint.', 'Paint Industry'),
(20, 'AOPL MURA C55', '55 ± 1', '7-9', 1, '2025-04-15 03:51:29', '800 - 1000 (4/20)', 'Suitable for Elastomeric roof coating and masonry coating.', 'Construction Industry'),
(21, 'AOPL C 76', '47 ± 1', '8.5-9', 1, '2025-04-15 03:51:29', '20 - 30 (3/10)', 'High gloss,High sheen interior/exteriorpaint.', 'Construction Industry'),
(22, 'AOPL C 400', '57 ± 1', '8-10', 1, '2025-04-15 03:51:29', '1000 - 3000 (4/20)', 'Used as waterproofing chemical, barrier coating as well as tileadhesive.', 'Construction Industry'),
(23, 'AOPL 201', '-', '7.5 - 8.5', 1, '2025-04-15 03:51:29', '3000 - 5000 (4/20)', 'Used as soft binder for primary and secondary backing in carpet back sizing, non-woven carpets and fabrics', 'Carpet Industry'),
(24, 'AOPL 501', '-', '7.5 - 8.5', 1, '2025-04-15 03:51:29', '3000 - 4000 (4/20)', 'Used as soft binder for primary and secondary backing in carpet back sizing, non-woven carpets and fabrics.', 'Carpet Industry'),
(25, 'AOPL 3695', '-', '6-8', 1, '2025-04-15 03:51:29', '3000 - 4000 (4/20)', 'Used as soft binder for primary and secondary backing in carpet back sizing, non-woven carpets and fabrics. Used in Machine  Coating / backing.', 'Carpet Industry'),
(26, 'AOPL C 111', '-', '4-6', 1, '2025-04-15 03:51:29', '1500 - 3000 (4/20)', 'Used as soft binder for primary and secondary backing in carpet back sizing,non-woven carpets and fabrics.', 'Carpet Industry'),
(27, 'AOPL C 500', '-', '5-7', 1, '2025-04-15 03:51:29', '800 - 1500 (4/20)', 'Used for stiffening of carpet in primary and secondary backing and also applied after finishing.', 'Carpet Industry'),
(28, 'AOPL PS 305', '-', '8-10', 1, '2025-04-15 03:51:29', '600 - 900 (4/10)', 'Used hard backing and strong bond binder for non-cracking carpet and non- woven carpets and fabrics.', 'Carpet Industry'),
(29, 'AOPL 081', '-', '4-6', 1, '2025-04-15 03:51:29', '1500 - 3000 (4/20)', 'Used as soft binder for primary and secondary backing in carpet back sizing, non-woven carpets and fabrics.', 'Carpet Industry'),
(30, 'AOPL C412', '-', '7.5-8.5', 1, '2025-04-15 03:51:29', '2000 - 3000 (4/20)', 'Used as soft binder for primary and secondary backing in carpet back sizing, non-woven carpets and fabrics.', 'Carpet Industry'),
(31, 'AOPL GEP', '-', '5-7', 1, '2025-04-15 03:51:29', '800 - 1500 (4/20)', 'Used for Machine Backing / Coating. For stiffening.', 'Carpet Industry'),
(32, 'AOPL GOL', '-', '5-7', 1, '2025-04-15 03:51:29', '800 - 1500 (4/20)', 'Used for Machine Backing / Coating. For stiffening.', 'Carpet Industry'),
(33, 'AOPLDEF (Silicone Defoamer)', '-', '5.5 - 7 of 2% dilute solution', 1, '2025-04-15 03:51:29', '6000 - 8000 (4/10)', 'Used as defoamer in: Textile, Paper, Dye manufacturing, Laundries, Paint Industry, Effluent treatment plants, etc. It is recommended to add AOPL DEF to any batch before agitation.', 'Carpet Industry'),
(34, 'AOPLDIS', '-', '7.5 - 9.0', 1, '2025-04-15 03:51:29', '200 - 300 (4/20)', 'Used as pigment dispersant in aqueous systems for dispersion of inorganic pigments with improved stability.', 'Carpet Industry'),
(35, 'AOPLDIS (Dark Brown)', '-', '12+', 1, '2025-04-15 03:51:29', '200 - 600 (4/20)', 'Used as pigment dispersant in aqueous systems for dispersion of inorganic pigments with improved stability.', 'Carpet Industry'),
(36, 'AOPLT 27', '-', '2-4', 1, '2025-04-15 03:51:29', '2000 - 3000 (4/20)', 'Used as thickener in Paint and construction application.', 'Carpet Industry'),
(37, 'AOPL 4301', '-', '8.5 - 10', 1, '2025-04-15 03:51:29', '18000 - 28000 (7/20)', 'Rheological modifier in interior and exterior water-based paint.', 'Carpet Industry'),
(38, 'AOPL 2301', '-', '8.5 - 10', 1, '2025-04-15 03:51:29', '4000 - 7000 (7/20)', 'Rheological modifier in interior and exterior water-based paint.', 'Carpet Industry'),
(39, 'AOPL MUR 57 / MUR 75', '-', '7.5 - 9', 1, '2025-04-15 03:51:29', '500 - 600 (4/20)', 'Global OrganicTextile Standard (GOTS) approved product Suitable for Carpet backing.', 'Carpet Industry'),
(40, 'AOPLC 411', '-', '7.5 - 8.5', 1, '2025-04-15 03:51:29', '1000 - 3000 (4/20)', 'Global Organic Textile Standard (GOTS) Approved product . Used as soft binder for primary and  secondary backing in carpet back sizing, non woven carpets and fabrics.', 'Carpet Industry'),
(41, 'AOPL C 3111', '-', '7.5 - 8.5', 1, '2025-04-15 03:51:29', '2000 - 3000 (4/20)', 'Global Organic Textile Standard (GOTS) approved product. Used as soft binder for primary and secondary backing in carpet back sizing, non-woven carpets and fabrics.', 'Carpet Industry'),
(42, 'AOPL C 369', '-', '6 - 8', 1, '2025-04-15 03:51:29', '600 - 1200 (4/20)', 'Global Organic Textile Standard (GOTS) approved product. Used as soft binder for primary and secondary backing in carpet back sizing, non-woven carpets and fabrics.', 'Carpet Industry'),
(43, 'AOPL T 29', '-', '2 - 4', 1, '2025-04-15 03:51:29', '3000 - 4000 (4/20)', 'Global Organic Textile Standard (GOTS) Approved product Used as thickener in Paint and construction application.', 'Carpet Industry'),
(44, 'AOPL G94 SP', '44 ± 2%', '-', 1, '2025-04-15 03:51:29', '-', 'A Self-cross linking and self-thickening acrylic emulsion. It is mainly used in table printing.', 'Textile Industry'),
(45, 'AOPL GLC 40', '55 ± 2%', '-', 1, '2025-04-15 03:51:29', '-', 'This is our best all round candidate for use in formulating laminating adhesives for bonding a wide variety of substrates.', 'Textile Industry'),
(46, 'AOPL GMUR 57', '60 ± 3%', '-', 1, '2025-04-15 03:51:29', '-', 'This is a new generation Acrylic copolymer dispersion, APEO free and formaldehyde free designed for tufted carpet back coating.', 'Textile Industry'),
(47, 'AOPL GPT 60', 'N A', '-', 1, '2025-04-15 03:51:29', '-', 'This is eco-friendly polymer thickener which is suitable for Pigment Printing in textile.', 'Textile Industry'),
(48, 'AOPL GT 29', '30 ± 2%', '-', 1, '2025-04-15 03:51:29', '-', 'Rheology modifier for making khadi, pearl etc.', 'Textile Industry'),
(49, 'AOPL G SUPER 60', 'N A', '-', 1, '2025-04-15 03:51:29', '-', 'Rheology modifier for sharp prints.', 'Textile Industry'),
(50, 'AOPL GHT 30', 'N A', '-', 1, '2025-04-15 03:51:29', '-', 'Haze Thickener.', 'Textile Industry'),
(51, 'AOPL GDEF', 'N A', '-', 1, '2025-04-15 03:51:29', '-', 'Silicone based defoamer for high turbulence process. Stable and high performance even in presence of high amount of electrolytes.', 'Textile Industry'),
(52, 'AOPL GDIS', '32 ± 2%', '-', 1, '2025-04-15 03:51:29', '-', 'This is a pigment dispersant for aqueous systems. Especially useful for dispersing inorganic pigment such as titanium dioxide, zinc oxide, clay with improved stability. It is efficient in a wide range of pH in various emulsion systems.', 'Textile Industry'),
(53, 'AOPL G SNOW WHITE 9', 'N A', '-', 1, '2025-04-15 03:51:29', '-', 'Ready to use khadi paste for high speed printing machines.', 'Textile Industry'),
(54, 'AOPL G SUPER SNOW 99', 'N A', '-', 1, '2025-04-15 03:51:29', '-', 'Ready to use khadi paste for sharp print and all round fastness.', 'Textile Industry'),
(55, 'POLYSOL', 'N A', '-', 1, '2025-04-15 03:51:29', '-', 'PVA dispersions which imports a soft handle on textiles and ensures full light fastness and non yellowing properties on the treated fabrics retaining their luster. It is used for durable finishes for cotton and it\'s various blends.', 'Textile Industry'),
(56, 'AOPL GAM 45', '55 ± 2%', '-', 1, '2025-04-15 03:51:29', '-', 'Adhesive for tables for pigment printing.', 'Textile Industry'),
(57, 'AOPL G 5301', '30 ± 2%', '-', 1, '2025-04-15 03:51:29', '-', 'Textile Pigmment Printing Binder.', 'Textile Industry'),
(58, 'AOPL G 5401', '40 ± 2%', '-', 1, '2025-04-15 03:51:29', '-', 'Special Binder for all round fastness for pigment printing on high speed machines.', 'Textile Industry'),
(59, 'AOPL G 5201', '50 ± 2%', '-', 1, '2025-04-15 03:51:29', '-', 'Economical binder emulsion for pigment printing.', 'Textile Industry'),
(60, 'AOPL GFIX APO', 'N A', '-', 1, '2025-04-15 03:51:29', '-', 'Zero formaldehyde fixer for pigment printing.', 'Textile Industry'),
(61, 'AOPL APL', '32 ± 2%', '-', 1, '2025-04-15 03:51:29', '-', 'A Self cross-linking and self thickening acrylic emulsion. It is used mainly in PEARL, KHADI and ZARI.', 'Textile Industry'),
(62, 'AOPL 540', '40 ± 2%', '-', 1, '2025-04-15 03:52:42', '-', 'A Self cross-linking acrylic emulsion. It is used mainly in PEARL, KHADI and ZARI and WHITE INK.', 'Textile Industry'),
(63, 'AOPL 4000', '32 ± 2%', '-', 1, '2025-04-15 03:52:42', '-', 'A Self cross-linking acrylic emulsion It is used mainly in pigment printing on synthetic fabrics and its blends.', 'Textile Industry'),
(64, 'AOPL EV 40', '40 ± 1 %', '-', 1, '2025-04-15 03:52:42', '-', 'It is used mainly in pigment printing on synthetic fabric and its blends.', 'Textile Industry'),
(65, 'AOPL 280', '40 ± 2%', '-', 1, '2025-04-15 03:52:42', '-', 'Roller Coating, Silk Skeen, Brush-table adhesive.', 'Textile Industry'),
(66, 'AOPL 94', '28 ± 2%', '-', 1, '2025-04-15 03:52:42', '-', 'A Self cross-linking binder and self-thickening acrylic emulsion. It is mainly used in table printing.', 'Textile Industry'),
(67, 'AOPL 94 SP', '44 ± 2%', '-', 1, '2025-04-15 03:52:42', '-', 'A Self cross linking and self-thickening acrylic emulsion. It is mainly used in table printing.', 'Textile Industry'),
(68, 'AOPL SAN', '40 ± 2%', '-', 1, '2025-04-15 03:52:42', '-', 'A Self cross-linking acrylic emulsion. It is mainly used in Pigment Printing.', 'Textile Industry'),
(69, 'AOPL SSL', '32 ± 2%', '-', 1, '2025-04-15 03:52:42', '-', 'A Self cross-linking acrylic emulsion. It is mainly used in table Pigment.', 'Textile Industry'),
(70, 'AOPL GBSP', 'N A', '-', 1, '2025-04-15 03:52:42', '-', 'Acrylic binder for gold or bronze metal powder printing on fabric for sharp print and higher fastness.', 'Textile Industry'),
(71, 'AOPL GB', 'N A', '-', 1, '2025-04-15 03:52:42', '-', 'Acrylic binder for gold or bronze metal powder printing on fabric.', 'Textile Industry'),
(72, 'AOPL GB PAP', 'N A', '-', 1, '2025-04-15 03:52:42', '-', 'Acrylic binder for gold or bronze metal powder printing on paper.', 'Textile Industry'),
(73, 'AOPL GBNB', 'N A', '-', 1, '2025-04-15 03:52:42', '-', 'Acrylic binder for gold bronze metal powder printing. It avoids oxidization of metal powder on printed fabric.', 'Textile Industry'),
(74, 'AOPL T29', '30 ± 2%', '-', 1, '2025-04-15 03:52:42', '-', 'Rheology modifier for very soft and free flowing paste.', 'Textile Industry'),
(75, 'AOPL PT 60', 'N A', '-', 1, '2025-04-15 03:52:42', '-', 'An eco-friendly polymer thickener which is suitable for Pigment printing.', 'Textile Industry'),
(76, 'AOPL FIO', 'N A', '-', 1, '2025-04-15 03:52:42', '-', 'High Performance binder for printing foil on machine.', 'Textile Industry'),
(77, 'AOPL HOT FOIL BINDER', 'N A', '-', 1, '2025-04-15 03:52:42', '-', 'Binder with excellent fastness for hot process.', 'Textile Industry'),
(78, 'AOPL COLD FOIL BINDER', 'N A', '-', 1, '2025-04-15 03:52:42', '-', 'Binder for cold process application of foil.', 'Textile Industry'),
(79, 'AOPL SOL', '40 ± 2%', '-', 1, '2025-04-15 03:52:42', '-', 'Soft print emulsion for printing on knitted goods. Also used as Khadi Binder for medium stretch.', 'Textile Industry'),
(80, 'AOPL MUR 57', '60 ± 3%', '-', 1, '2025-04-15 03:52:42', '-', 'A new generation acrylic copolymer dispersion, APEO free and formaldehyde free designed for soft coating and printing.', 'Textile Industry'),
(81, 'AOPL F222', 'N A', '-', 1, '2025-04-15 03:52:42', '-', 'Flock Binder.', 'Textile Industry'),
(82, 'AOPL T192', '50 ± 2%', '-', 1, '2025-04-15 03:52:42', '-', 'Used to adhere stone on fabric.', 'Textile Industry'),
(83, 'AOPL T199', '55 ± 2%', '-', 1, '2025-04-15 03:52:42', '-', 'Used to adhere stone on fabric.', 'Textile Industry'),
(84, 'AOPL DEF', 'N A', '-', 1, '2025-04-15 03:52:42', '-', 'Silicone based defoamer for high turbulence process. Stable and high performance even presence of high number of electrolytes.', 'Textile Industry'),
(85, 'AOPL ZB', 'N A', '-', 1, '2025-04-15 03:52:42', '-', 'Zari Binder.', 'Textile Industry'),
(86, 'AOPL ADIS', '32 ± 2%', '-', 1, '2025-04-15 03:52:42', '-', 'This is a pigment dispersant for aqueous systems. Especially useful for dispersing inorganic pigments such as titanium dioxide, zinc oxide, clay with improved stability. It is efficient in a wide range of pH in various emulsion systems.', 'Textile Industry'),
(87, 'AOPL CP 54', '55 ± 2%', '-', 1, '2025-04-15 03:52:42', '-', 'Clear paste used for chest printing.', 'Textile Industry'),
(88, 'AOPL LC 40', '55 ± 2%', '-', 1, '2025-04-15 03:52:42', '-', 'This is our best all round candidate for use in formulating laminating adhesives for bonding a wide variety of substrates.', 'Textile Industry'),
(89, 'AOPL KHD 33', 'N A', '-', 1, '2025-04-15 03:52:42', '-', 'This is ready to use non-stretch khadi develop for printing on flat belt as well as table.', 'Textile Industry'),
(90, 'AOPL AM 45', '55 ± 2%', '-', 1, '2025-04-15 03:52:42', '-', 'Roller Coating, Silk Screen, Brush-table adhesive.', 'Textile Industry'),
(91, 'AOPL SUPER FIX 30', 'N A', '-', 1, '2025-04-15 03:52:42', '-', 'It is used as Finishing agent foIt is used as Finishing agent to enhance fastness of prints.', 'Textile Industry'),
(92, 'AOPL EM 50P', '50 ± 2%', '-', 1, '2025-04-15 03:52:42', '-', 'A poly vinyl acetate dispersion which imports a soft handle on textiles and ensures full light fastness and non-yellowing properties on the treated fabrics retaining their lustre.', 'Textile Industry'),
(93, 'AOPL EM 40', '40 ± 2%', '-', 1, '2025-04-15 03:52:42', '-', 'PVA dispersions which imports a soft handle on textiles and ensures full light fastness and non- yellowing properties on the treated fabrics retaining their luster.it is used for durable finishes for cotton and it\'s various blends.', 'Textile Industry'),
(94, 'AOPL EM 45', '45 ± 2%', '-', 1, '2025-04-15 03:52:42', '-', 'PVA dispersions which imports a soft handle on textiles and ensures full light fastness and non- yellowing properties on the treated fabrics retaining their luster.it is used for durable finishes for cotton and it\'s various blends.', 'Textile Industry'),
(95, 'AOPL EM 48', '48 ± 2%', '-', 1, '2025-04-15 03:52:42', '-', 'PVA dispersions which imports a soft handle on textiles and ensures full light fastness and non- yellowing properties on the treated fabrics retaining their luster.it is used for durable finishes for cotton and it\'s various blends.', 'Textile Industry'),
(96, 'AOPL EM 50', '50 ± 2%', '-', 1, '2025-04-15 03:52:42', '-', 'PVA dispersions which imports a soft handle on textile and ensures full light fastness and non- yellowing properties on the treated fabrics retaining their luster.it is used for durable finishes for cotton and it\'s various blends.', 'Textile Industry'),
(97, 'AOPL EM 50 G', '50 ± 2 %', '-', 1, '2025-04-15 03:52:42', '-', 'Used for durable finishes for cotton, linen, polyester, rayon and various blends. Used for Textile Finishing and Printing.', 'Textile Industry'),
(98, 'AOPL ABX', '55 ± 2%', '-', 1, '2025-04-15 03:52:42', '-', 'PVA dispersions which imports a soft handle on textile and ensures full light fastness and non- yellowing properties on the treated fabrics retaining their luster.it is used for durable finishes for cotton and it\'s various blends.', 'Textile Industry'),
(99, 'AOPL 5400 (APBX)', '55 ± 1 %', '-', 1, '2025-04-15 03:52:42', '-', 'Used for durable finishes for cotton, linen, polyester, rayon and various blends. Used for Textile Finishing and Printing.', 'Textile Industry'),
(100, 'AOPL HBT', '45 ± 1 %', '-', 1, '2025-04-15 03:52:42', '-', 'Primary & secondary backing in carpet back sizing, non- wovens carpets, baggage fabrics, flocking & paper coating for hard feel.', 'Textile Industry'),
(101, 'AOPL SBT', 'N A', '-', 1, '2025-04-15 03:52:42', '-', 'Coating Binder for Soft Finishes. This can be made available in Matt as well as Glossy style.', 'Textile Industry'),
(102, 'AOPL AH 40', '40 ± 2%', '-', 1, '2025-04-15 03:52:42', '-', 'It is used for durable finishes for cotton, linen, polyester, rayon and various blends.', 'Textile Industry'),
(103, 'AOPL AH 48', '48 ± 2%', '-', 1, '2025-04-15 03:52:42', '-', 'It is used for durable finishes for cotton, linen, polyester, rayon and various blends.', 'Textile Industry'),
(104, 'AOPL AH 51', '51 ± 2%', '-', 1, '2025-04-15 03:52:42', '-', 'It is used for durable finishes for cotton, linen, polyester, rayon and various blends.', 'Textile Industry'),
(105, 'AOPL F2F', 'N A', '-', 1, '2025-04-15 03:52:42', '-', 'For smooth edges and Binding different Fabrics together.', 'Textile Industry'),
(106, 'AOPL ROP06', 'N A', '-', 1, '2025-04-15 03:52:42', '-', 'For zari application on yarn.', 'Textile Industry');

-- --------------------------------------------------------

--
-- Table structure for table `adhesiveIndustry`
--

CREATE TABLE `adhesiveIndustry` (
  `id` int(5) NOT NULL,
  `product` varchar(1000) NOT NULL,
  `solidPercent` varchar(1000) NOT NULL,
  `pH` varchar(1000) NOT NULL,
  `application` varchar(1000) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `adhesiveIndustry`
--

INSERT INTO `adhesiveIndustry` (`id`, `product`, `solidPercent`, `pH`, `application`, `status`, `createdOn`) VALUES
(1, 'AOPL 308', '38', '5.5 - 6.5', 'PVC Lamination, BOPP Tape Film', 1, '2025-03-08 10:59:13'),
(2, 'AOPL 303', '33', '5.5 - 6.5', 'PVC Lamination, BOPP Tape Film', 1, '2025-03-08 10:59:13'),
(3, 'AOPL 55PA', '55', '4 – 6', 'Pressure Sensitive Sticker, Stock Label', 1, '2025-03-08 10:59:13'),
(4, 'AOPL 404', '44', '5.5 - 6.5', 'PVC Lamination, BOPP Tape Film', 1, '2025-03-08 10:59:13'),
(5, 'AOPL 408', '48', '5.5 - 6.5', 'High quality film on Bopp Tape, Film Lamination', 1, '2025-03-08 10:59:13'),
(6, 'AOPL PA 30', '30', '4 – 6', 'Repeat use of sticking application', 1, '2025-03-08 10:59:13'),
(7, 'AOPL 505', '55', '5.5 - 6.5', 'High quality PVC lamination on board and film and Bopp', 1, '2025-03-08 10:59:13'),
(8, 'AOPL A117', '54', '8 – 9', 'BOPP tapes, jumbo rolls, suit case inner lining', 1, '2025-03-08 10:59:13'),
(9, 'AOPL EM 50 A', '50', '5 - 7', 'Wood Glue', 1, '2025-03-08 10:59:13');

-- --------------------------------------------------------

--
-- Table structure for table `carpetIndustry`
--

CREATE TABLE `carpetIndustry` (
  `id` int(5) NOT NULL,
  `product` varchar(1000) NOT NULL,
  `pH` varchar(1000) NOT NULL,
  `Viscosity @ 30°C (cPs) / (Spindle No./RPM)` varchar(1000) NOT NULL,
  `MFFT (°C)` varchar(100) NOT NULL,
  `Applications` varchar(1000) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `carpetIndustry`
--

INSERT INTO `carpetIndustry` (`id`, `product`, `pH`, `Viscosity @ 30°C (cPs) / (Spindle No./RPM)`, `MFFT (°C)`, `Applications`, `status`, `createdOn`) VALUES
(1, 'AOPL 201', '7.5 - 8.5', '3000 - 5000 (4/20)', '4', 'Used as soft binder for primary and secondary backing in carpet back sizing, non-woven carpets and fabrics.', 1, '2025-04-07 06:57:04'),
(2, 'AOPL 501', '7.5 - 8.5', '3000 - 4000 (4/20)', '4', 'Used as soft binder for primary and secondary backing in carpet back sizing, non-woven carpets and fabrics.', 1, '2025-04-07 06:57:04'),
(3, 'AOPL 369', '6-8', '3000 - 4000 (4/20)', '7', 'Used as soft binder for primary and secondary backing in carpet back sizing, non-woven carpets and fabrics. Used in Machine  Coating / backing.', 1, '2025-04-07 06:57:04'),
(4, 'AOPL C111', '4-6', '1500 - 3000 (4/20)', '11', 'Used as soft binder for primary and secondary backing in carpet back sizing,non-woven carpets and fabrics.', 1, '2025-04-07 06:57:04'),
(5, 'AOPL C500', '5-7', '800 - 1500 (4/20)', '16', 'Used for stiffening of carpet in primary and secondary backing and also applied after finishing.', 1, '2025-04-07 06:57:04'),
(6, 'AOPL PS 305', '8-10', '600 - 900 (4/10)', 'NA', 'Used hard backing and strong bond binder for non-cracking carpet and non- woven carpets and fabrics.', 1, '2025-04-07 06:57:04'),
(7, 'AOPL 081', '4-6', '1500 - 3000 (4/20)', '11', 'Used as soft binder for primary and secondary backing in carpet back sizing, non-woven carpets and fabrics.', 1, '2025-04-07 06:57:04'),
(8, 'AOPL C412', '7.5-8.5', '2000 - 3000 (4/20)', '4', 'Used as soft binder for primary and secondary backing in carpet back sizing, non-woven carpets and fabrics.', 1, '2025-04-07 06:57:04'),
(9, 'AOPL GEP', '5-7', '800 - 1500 (4/20)', '18', 'Used for Machine Backing / Coating. For stiffening.', 1, '2025-04-07 06:57:04'),
(10, 'AOPL GOL', '5-7', '800 - 1500 (4/20)', '18', 'Used for Machine Backing / Coating. For stiffening.', 1, '2025-04-07 06:57:04'),
(11, 'AOPLDEF (Silicone Defoamer)', '5.5 - 7 of 2% dilute solution', '6000 - 8000 (4/10)', 'NA', 'Used as defoamer in: Textile, Paper, Dye manufacturing, Laundries, Paint Industry, Effluent treatment plants, etc. It is recommended to add AOPL DEF to any batch before agitation.', 1, '2025-04-07 06:57:04'),
(12, 'AOPLDIS', '7.5 - 9.0', '200 - 300 (4/20)', 'NA', 'Used as pigment dispersant in aqueous systems for dispersion of inorganic pigments with improved stability.', 1, '2025-04-07 06:57:04'),
(13, 'AOPLDIS (Dark Brown)', '12+', '200 - 600 (4/20)', 'NA', 'Used as pigment dispersant in aqueous systems for dispersion of inorganic pigments with improved stability.', 1, '2025-04-07 06:57:04'),
(14, 'AOPLT 27', '2-4', '2000 - 3000 (4/20)', 'NA', 'Used as thickener in Paint and construction application.', 1, '2025-04-07 06:57:04'),
(15, 'AOPL 4301', '8.5 - 10', '18000 - 28000 (7/20)', 'NA', 'Rheological modifier in interior and exterior water-based paint.', 1, '2025-04-07 06:57:04'),
(16, 'AOPL 2301', '8.5 - 10', '4000 - 7000 (7/20)', 'NA', 'Rheological modifier in interior and exterior water-based paint.', 1, '2025-04-07 06:57:04'),
(17, 'AOPL MUR57/ MUR75', '7.5 - 9', '500 - 600 (4/20)', '11 (Tg: -35)', 'Global OrganicTextile Standard (GOTS) approved product Suitable for Carpet backing.', 1, '2025-04-07 06:57:04'),
(18, 'AOPLC 411', '7.5 - 8.5', '1000 - 3000 (4/20)', '4', 'Global Organic Textile Standard (GOTS) Approved product . Used as soft binder for primary and  secondary backing in carpet back sizing, non woven carpets and fabrics.', 1, '2025-04-07 06:57:04'),
(19, 'AOPL C 3111', '7.5 - 8.5', '2000 - 3000 (4/20)', '4', 'Global Organic Textile Standard (GOTS) approved product. Used as soft binder for primary and secondary backing in carpet back sizing, non-woven carpets and fabrics.', 1, '2025-04-07 06:57:04'),
(20, 'AOPL C 369', '6 - 8', '600 - 1200 (4/20)', '4', 'Global Organic Textile Standard (GOTS) approved product. Used as soft binder for primary and secondary backing in carpet back sizing, non-woven carpets and fabrics.', 1, '2025-04-07 06:57:04'),
(21, 'AOPL T 29', '2 - 4', '3000 - 4000 (4/20)', 'NA', 'Global Organic Textile Standard (GOTS) Approved product Used as thickener in Paint and construction application.', 1, '2025-04-07 06:57:04');

-- --------------------------------------------------------

--
-- Table structure for table `combinationDriers`
--

CREATE TABLE `combinationDriers` (
  `id` int(5) NOT NULL,
  `product` varchar(1000) NOT NULL,
  `metalContent` varchar(1000) NOT NULL,
  `nonVolatile` varchar(1000) NOT NULL,
  `specificGravity` varchar(100) NOT NULL,
  `viscosity` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `createdOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `combinationDriers`
--

INSERT INTO `combinationDriers` (`id`, `product`, `metalContent`, `nonVolatile`, `specificGravity`, `viscosity`, `status`, `createdOn`) VALUES
(1, 'AOPL 1025 (Enamel Paint)', 'Co / Mn/ Pb', '52', '1.05', '18', 1, '2025-04-14 07:58:30'),
(2, 'AOPL 1028 (For Ink)', 'Co / Mn/ Pb', '39', '0.94', '13', 1, '2025-04-14 07:58:30'),
(3, 'AOPL 1068 (Primer)', 'Co / Mn/ Pb', '35', '0.94', '13', 1, '2025-04-14 07:58:30'),
(4, 'AOPL 1425 (Primer)', 'Co / Mn/ Pb', '43', '0.98', '15', 1, '2025-04-14 07:58:30'),
(5, 'AOPL 10725 (Primer)', 'Co / Mn/ Pb', '52', '1.04', '18', 1, '2025-04-14 07:58:30'),
(6, 'AOPL 1121', 'Co / Pb / Ca', '41', '0.97', '17', 1, '2025-04-14 07:58:30'),
(7, 'AOPL 1123 (White Enamel Paint)', 'Co / Ca / Zr', '23', '0.86', '12', 1, '2025-04-14 07:58:30'),
(8, 'AOPL 11 N9', 'Co / Ca / Zr', '47', '0.99', '13', 1, '2025-04-14 07:58:30'),
(9, 'AOPL 1345', 'Co/ Ba', '37', '0.91', '4', 1, '2025-04-14 07:58:30');

-- --------------------------------------------------------

--
-- Table structure for table `compositeFRPIndOne`
--

CREATE TABLE `compositeFRPIndOne` (
  `id` int(5) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT current_timestamp(),
  `product` varchar(255) DEFAULT NULL,
  `ACTIVE METAL` float DEFAULT NULL,
  `SOLID PERCENTAGE 120C` float DEFAULT NULL,
  `DENSITY 30C` float DEFAULT NULL,
  `VISCOSITY 30C` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `compositeFRPIndOne`
--

INSERT INTO `compositeFRPIndOne` (`id`, `status`, `createdOn`, `product`, `ACTIVE METAL`, `SOLID PERCENTAGE 120C`, `DENSITY 30C`, `VISCOSITY 30C`) VALUES
(1, 1, '2025-04-02 03:01:19', 'RAA PRO CO 12%', 12, 60, 1, 10),
(2, 1, '2025-04-02 03:01:19', 'RAA PRO CO 6%', 6, 27, 0.85, 12),
(3, 1, '2025-04-02 03:01:19', 'RAA PRO CO 3%', 3, 10, 0.8, 12),
(4, 1, '2025-04-02 03:01:19', 'RAA PRO CO 2%', 2, 5, 0.77, 12),
(5, 1, '2025-04-02 03:01:19', 'RAA PRO CO 1%', 1, 1, 0.75, 12),
(6, 1, '2025-04-02 03:01:19', 'RAA PRO CO 8.6%', 8.6, 50, 0.93, 14),
(7, 1, '2025-04-02 03:01:19', 'RAA PRO CO 8%', 8, 46, 0.92, 13),
(8, 1, '2025-04-02 03:01:19', 'RAA PRO CN 6%', 6, 35, 0.85, 13),
(9, 1, '2025-04-02 03:01:19', 'RAA PRO PO 15%', 15, 75, 1, 15),
(10, 1, '2025-04-02 03:01:19', 'RAA PRO PO 10%', 10, 50, 0.92, 16),
(11, 1, '2025-04-02 03:01:19', 'RAA PRO CO ACL 12', 12.6, 65, 0.95, 19);

-- --------------------------------------------------------

--
-- Table structure for table `compositeFRPIndTwo`
--

CREATE TABLE `compositeFRPIndTwo` (
  `id` int(5) NOT NULL,
  `product` varchar(1000) NOT NULL,
  `activeMetal` varchar(1000) NOT NULL,
  `PerOfSolid` varchar(1000) NOT NULL,
  `Densityat30` varchar(1000) NOT NULL,
  `Viscocityat30` varchar(1000) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `compositeFRPIndTwo`
--

INSERT INTO `compositeFRPIndTwo` (`id`, `product`, `activeMetal`, `PerOfSolid`, `Densityat30`, `Viscocityat30`, `status`, `createdOn`) VALUES
(1, 'RAA PRO ACLR CC 2', '2.2', '12', '0.88', '11', 1, '2025-03-08 15:46:04'),
(2, 'RAA PRO ACLR CC 3', '3.4', '20', '0.9', '12', 1, '2025-03-09 15:46:04'),
(3, 'RAA PRO ACLR CC 6', '6.8', '35', '0.92', '15', 1, '2025-03-10 15:46:04'),
(4, 'RAA PRO ACLR CC 10', '10.5', '55', '1.021.02', 'OPEN', 1, '2025-03-11 15:46:04'),
(5, 'RAA PRO ACLR CC', '5.26', '32', '0.92', '12', 1, '2025-03-12 15:46:04');

-- --------------------------------------------------------

--
-- Table structure for table `constructionIndustry`
--

CREATE TABLE `constructionIndustry` (
  `id` int(5) NOT NULL,
  `product` varchar(1000) NOT NULL,
  `solidPercent` varchar(1000) NOT NULL,
  `pH` varchar(1000) NOT NULL,
  `applicatoin` varchar(1000) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `constructionIndustry`
--

INSERT INTO `constructionIndustry` (`id`, `product`, `solidPercent`, `pH`, `applicatoin`, `status`, `createdOn`) VALUES
(1, 'AOPL C76', '45-47', '8.5 – 9.5', 'Waterproofing of terrace, rooftops', 1, '2025-03-13 15:46:04'),
(2, 'AOPL C400', '53 – 55', '7 – 8.5', 'Waterproofing of vertical Surfaces', 1, '2025-03-14 15:46:04'),
(3, 'AOPL PS 295', '48', '-', 'Cement primer, putty', 1, '2025-03-15 15:46:04'),
(4, 'AOPL PS 504', '50', '-', 'Texture coating, construction chemical', 1, '2025-03-16 15:46:04'),
(5, 'AOPL PS 2504', '50', '8 – 10', 'Interior Emulsion Paint, Cementitious Primer', 1, '2025-03-17 15:46:04'),
(6, 'AOPL PS 3045', '45', '8 – 10', 'Interior emulsion, cement primer', 1, '2025-03-18 15:46:04'),
(7, 'AOPL PS 30452', '45', '-', 'Interior emulsion, cement primer', 1, '2025-03-19 15:46:04'),
(8, 'AOPL SUPER BOND', '45', '5 – 7', 'cementitious substrates', 1, '2025-03-20 15:46:04');

-- --------------------------------------------------------

--
-- Table structure for table `indPersonalhomecare`
--

CREATE TABLE `indPersonalhomecare` (
  `id` int(5) NOT NULL,
  `product` varchar(1000) NOT NULL,
  `chemicalName` varchar(1000) NOT NULL,
  `purity` varchar(100) NOT NULL,
  `application` varchar(1000) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `indPersonalhomecare`
--

INSERT INTO `indPersonalhomecare` (`id`, `product`, `chemicalName`, `purity`, `application`, `status`, `createdOn`) VALUES
(1, 'AOPL MS-99', 'Methyl salicylate', '99% - 100.5%', 'Manufacturing Pain Balm, Pain relief gel, Sprays & oils, Liniments and Ointments, Flavors and Fragrance industry.', 1, '2025-03-31 02:41:40'),
(2, 'AOPL OS-99', 'Octyl salicylate', 'Min 99%', 'Augment the UVB protection in sunscreens and anti-aging creams.', 1, '2025-03-31 02:41:40'),
(3, 'AOPL BS-99', 'Benzyl Salicylate', 'Min 99%', 'Fixative and Solvent in formation of Cosmetic Fragrances, Bath Products, Haircare products, Perfumes and Colognes, UV absorbent in sunscreens.', 1, '2025-03-31 02:41:40'),
(4, 'AOPL CS-96', 'Cyclohexyl Salicylate', 'Min 96%', 'Used in Washing and Cleaning products, Personal Care products, Perfumes and Fragrances.', 1, '2025-03-31 02:41:40'),
(5, 'AOPL 2EHS-99', '2-Ethylhexyl Salicylate', 'Min 99%', 'Augment the UVB protection in sunscreens and anti-aging creams.', 1, '2025-03-31 02:41:40'),
(6, 'AOPL AMS-99', 'Amyl salicylate', 'Min 99%', 'Used as main agent for shamrock flavour, used as fragrance for detergents and formulation of soaps.', 1, '2025-03-31 02:41:40'),
(7, 'AOPL BUS-98', 'Butyl salicylate', 'Min 98%', 'Used in decorative cosmetics, Fine fragrances, shampoos, and other toiletries as well as in non-cosmetic products such as household cleaners and detergents.', 1, '2025-03-31 02:41:40'),
(8, 'AOPL HEPS-98', 'Heptyl salicylate', 'Min 98%', 'Used in high-end niche perfumery and sophisticated fragrance compositions.', 1, '2025-03-31 02:41:40'),
(9, 'AOPL HS-98', 'Hexyl salicylate', 'Min 98%', 'Used in formulation of fragrances in multiple goods including household cleaning products, detergents, aircare, and cosmetics.', 1, '2025-03-31 02:41:40'),
(10, 'AOPL ALLS-98', 'Allyl salicylate', 'Min 98%', 'Used in imparting fragrance in perfumes and personal care products. Also in household products like air fresheners.', 1, '2025-03-31 02:41:40'),
(11, 'AOPL IAMS-98', 'Isoamyl salicylate', 'Min 98%', 'Manufacturing beauty soaps, used in aromatherapy.', 1, '2025-03-31 02:41:40'),
(12, 'AOPL IBUS-98', 'Isobutyl Salicylate', 'Min 99%', 'Crafting candles, utilized in making of Fabric softeners, Potpourri, liquid detergents, and Body care.', 1, '2025-03-31 02:41:40'),
(13, 'AOPL PETS-98', 'Phenyl Ethyl Salicylate', 'Min 98%', 'Crafting candles, utilized in making of aromatherapy blends.', 1, '2025-03-31 02:41:40');

-- --------------------------------------------------------

--
-- Table structure for table `organicPeroxides`
--

CREATE TABLE `organicPeroxides` (
  `product` varchar(255) DEFAULT NULL,
  `CHEMICAL NAME` varchar(255) DEFAULT NULL,
  `PHYSICAL FORM` varchar(100) DEFAULT NULL,
  `ACTIVE OXYGEN` varchar(50) DEFAULT NULL,
  `PURITY` decimal(5,2) DEFAULT NULL,
  `APPLICATION` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `organicPeroxides`
--

INSERT INTO `organicPeroxides` (`product`, `CHEMICAL NAME`, `PHYSICAL FORM`, `ACTIVE OXYGEN`, `PURITY`, `APPLICATION`) VALUES
('RAA PRO TB 70', 'Tert-Butyl Hydroperoxide', 'Solution in water', '12.43%', 70.00, 'Emulsion polymerization, Resin manufacturing, Agro chemical, Styrene polyester Resin curing, Propylene oxide production, etc.'),
('RAA PRO TB 75', 'Tert-Butyl Hydroperoxide', 'Solution in water', '13.33%', 75.00, 'Emulsion polymerization, Resin manufacturing, Agro chemical, Styrene polyester Resin curing, Propylene oxide production, etc.'),
('RAA PRO TB 80', 'Tert-Butyl Hydroperoxide', 'Solution in water', '14.20%', 80.00, 'Emulsion polymerization, Resin manufacturing, Agro chemical, Styrene polyester Resin curing, Propylene oxide production, etc.'),
('RAA PRO DT 98', 'Di-Tert-Butyl Peroxide', 'Liquid', '10.70%', 98.00, 'Emulsion polymerization, Speciality Resin,Perfumery & Fragrances, Petrochemical, Water Purifying Chemical, LDPE, etc.'),
('RAA PRO ME 6', 'Methyl Ethyl Ketone Peroxide', 'Solution in DMP', '10%', NULL, 'Curing of UP Resin, Buttons, Windmill Blades, Boats, Marble Slabs, Speciality Paint Resin, FRP Tanks, Other Composite Products, etc.'),
('RAA PRO ME 5 LWC', 'Methyl Ethyl Ketone Peroxide', 'Solution in DMP', '9%', NULL, 'Curing of UP Resin, Buttons, Windmill Blades, Boats, Marble Slabs, Speciality Paint Resin, FRP Tanks, Other Composite Products, etc.'),
('RAA PRO ME 5.5', 'Methyl Ethyl Ketone Peroxide', 'Solution in DMP', '9.50%', NULL, 'Curing of UP Resin, Buttons, Windmill Blades, Boats, Marble Slabs, Speciality Paint Resin, FRP Tanks, Other Composite Products, etc.'),
('RAA PRO ME V338', 'Methyl Ethyl Ketone Peroxide', 'Solution in SolventMixture', '10%', NULL, 'Curing of UP Resin, Buttons, Windmill Blades, Boats, Marble Slabs, Speciality Paint Resin, FRP Tanks, Other Composite Products, etc.'),
('RAA PRO ME 6 PTFE', 'Methyl Ethyl Ketone Peroxide', 'Solution in Phthalate Free Plasticizer', '10%', NULL, 'Curing of UP Resin, Buttons, Windmill Blades, Boats, Marble Slabs, Speciality Paint Resin, FRP Tanks, Other Composite Products, etc.'),
('RAA PRO ME 4.5 LPT-IN', 'Methyl Ethyl Ketone Peroxide', 'Solution in Di-isononyl Phthalate', '8.50%', NULL, 'Curing of UP Resin, Buttons, Windmill Blades, Boats, Marble Slabs, Speciality Paint Resin, FRP Tanks, Other Composite Products, etc.'),
('RAA PRO ME V395', 'Methyl Ethyl Ketone Peroxide', 'Solution in Solvent Mixture', '9.50%', NULL, 'Curing of UP Resin, Buttons, Windmill Blades, Boats, Marble Slabs, Speciality Paint Resin, FRP Tanks, Other Composite Products, etc.'),
('RAA PRO PB 98', 'Tert-Butyl Peroxy Benzoate', 'Liquid', '8.05%', 98.00, 'CuringofUPResin, QuartzMarble, Sanitary Ware, GroutingProducts, Speciality PaintResin, OtherSpeciality Resin, etc.'),
('RAA PRO PB 93', 'Tert-Butyl Peroxy Benzoate', 'Solution in Acetyl Acetone', '6.39% - 6.67%', 79.25, 'CuringofUPResin, QuartzMarble, Sanitary Ware, GroutingProducts, Speciality PaintResin, OtherSpeciality Resin, etc.'),
('RAA PRO TMH 98', 'Tert-Butyl Peroxy-3,5,5-Trimethyl Hexanoate', 'Liquid', '6.74%', 97.00, 'CuringofUPResin, Speciality Resins, Cure in Place Pipe, etc.'),
('RAA PRO BP 75', 'Dibenzoyl Peroxide', 'Powder / Granules', '4.95%', 75.00, 'Automotive Putty, Chemical Anchor and Bolt, Curing of UP Resin, Bleaching of Flour and Sugar, API, Acne Cream, Pharmaceutical Application, etc.'),
('RAA PRO BP 50', 'Dibenzoyl Peroxide', 'Paste In DMP', '3.27%', 50.00, 'Automotive Putty, Chemical Anchor and Bolt, Curing of UP Resin, Bleaching of Flour and Sugar, API, Acne Cream, Pharmaceutical Application, etc.'),
('RAA PRO BP 50 (CH-50 X)', 'Dibenzoyl Peroxide', 'Powder in DCHP', '3.27%', 50.00, 'Automotive Putty, Chemical Anchor and Bolt, Curing of UP Resin, Bleaching of Flour and Sugar, API, Acne Cream, Pharmaceutical Application, etc.'),
('RAA PRO BP 50 (PTFE- CH-50X)', 'Dibenzoyl Peroxide', 'Powder in Phthalate Free Plasticizer', '3.27%', 50.00, 'Automotive Putty, Chemical Anchor and Bolt, Curing of UP Resin, Bleaching of Flour and Sugar, API, Acne Cream, Pharmaceutical Application, etc.'),
('RAA PRO BP 50 DIBP', 'Dibenzoyl Peroxide', 'Paste in Di-isobutyl Phthalate', '3.27%', 50.00, 'Automotive Putty, Chemical Anchor and Bolt, Curing of UP Resin, Bleaching of Flour and Sugar, API, Acne Cream, Pharmaceutical Application, etc.'),
('RAA PRO BP 50 DBP', 'Dibenzoyl Peroxide', 'Paste in Di-Butyl Phthalate', '3.27%', 50.00, 'Automotive Putty, Chemical Anchor and Bolt, Curing of UP Resin, Bleaching of Flour and Sugar, API, Acne Cream, Pharmaceutical Application, etc.'),
('RAA PRO BP50 PTFE', 'Dibenzoyl Peroxide', 'Paste in Phthalate Free Plasticizer', '3.27%', 50.00, 'Automotive Putty, Chemical Anchor and Bolt, Curing of UP Resin, Bleaching of Flour and Sugar, API, Acne Cream, Pharmaceutical Application, etc.'),
('RAA PRO TBEC 985', 'Tert-Butyl Peroxy-2-Ethylhexyl Carbonate', 'Liquid', '6.39%', 98.50, 'Polymer Production, Solar Panel Manufacturing, Polymer Crosslinking, EVA Encapsultant Resin, etc.'),
('RAA PRO TBEC 975', 'Tert-Butyl Peroxy-2-Ethylhexyl Carbonate', 'Liquid', '6.33%', 97.50, 'Polymer Production, Solar Panel Manufacturing, Polymer Crosslinking, EVA Encapsultant Resin, etc.'),
('RAA PRO CP 98', 'Tert-Butyl Cumyl Peroxide', 'Liquid', '7.22% - 7.37%', 95.50, 'Curing of Natural and Synthetic Rubber EVA Encapsultant Resin, Used in Rubber Compounding for Wire and Cable Industry, etc.'),
('RAA PRO DTA', 'Di-Tertiary Amyl Peroxide', 'Liquid', '8.82%', 96.00, 'Production of high- solid varnishes, High pressure polymerisation, Co-polymerisation styrene, Reduction of residual monomer content in polymer, Acrylic Polymerisation LDPE, Pharma Catalyst, Catalyst for fragrance industry, etc.'),
('RAA PRO TAEC', 'Tert-Amyl Peroxy 2 -Ethyl Hexyl Carbonate', 'Liquid', '5.89%', 96.00, 'EVA Encapsulation of Solar Panels Rubber Vulcanisation, manufacturing of PVC Resin, Manufacturing of Speciality Resin, For Curing of UPR, For Cross Linking of Natural and Synthetic Rubber.'),
('RAA PRO ECAC 6040', 'Mixture of Tert-Butyl Peroxy-2-Ethylhexyl Carbonate & Tert-Amyl Peroxy 2 -Ethyl Hexyl Carbonate', 'Liquid', '6.15% - 6.20%', NULL, 'EVA Encapsulation of Solar Panels Rubber Vulcanisation, manufacturing of PVC Resin, Manufacturing of Speciality Resin, For Curing of UPR, For Cross Linking of Natural and Synthetic Rubber.'),
('RAA PRO 279', 'Mixture of Acetyl Acetone Peroxide and Tert-Butyl Peroxide Benzoate in Solvent', 'Liquid', '4.3% - 4.7%', NULL, 'Extremely Low water content Resin Transfer Molding Vinyl Ester Resin, Roof Panel, Curing of UPR Resins FRP Pipe Manufacturing.'),
('RAA PRO DCP 98', 'Di Cumyl Peroxide', 'Crystals', '5.79%', 98.00, 'Rubber Vulcanisation Shoe Sole Manufacturing, Automotive Tyre Manufacturing, Eva Encapsulation, Polymer Production, Polymer Crosslinking and Thermoset Composite, etc.'),
('RAA PRO DCP 99', 'Di Cumyl Peroxide', 'Crystals', '5.85%', 99.00, 'Rubber Vulcanisation Shoe Sole Manufacturing, Automotive Tyre Manufacturing, Eva Encapsulation, Polymer Production, Polymer Crosslinking and Thermoset Composite, etc.'),
('RAA PRO AAP', 'Acetyl Acetone Peroxide', 'Liquid', '4.0% - 4.4%', 34.75, 'Extremely Low water content, Resin Transfer Molding Vinyl Ester Resin, Roof Panel, Curing of UPR Resins, FRP Pipe Manufacturing.'),
('RAA PRO F 960', '1,3-1,4 bis (tert-butylperoxyisopropyl) benzene', 'Powder/ Flakes', '9.07%', 96.00, 'Curing of UP Resin, Speciality Resins, Cure in Place Pipe, Cross Linking of Natural Rubber, Polyolefins Rubber Compounding Vulcanisation, etc.'),
('RAA PRO F 40P', '1,3-1,4 bis (tert-butylperoxyisopropyl) benzene', 'Powder', '3.50% - 3.97%', 40.00, 'Curing of UP Resin, Speciality Resins, Cure in Place Pipe, Cross Linking of Natural Rubber, Polyolefins Rubber Compounding Vulcanisation, etc.'),
('RAA PRO FMIX 3638', '1,3-1,4 bis (tert-butylperoxyisopropyl) benzene', 'Liquid', '3.40% - 3.59%', 37.00, 'Curing of UP Resin, Speciality Resins, Cure in Place Pipe, Cross Linking of Natural Rubber, Polyolefins Rubber Compounding Vulcanisation, etc.'),
('RAA PRO CH 800', 'Cumyl Hydroperoxide', 'Liquid', '8.40%', 80.00, 'Curing of Vinyl Ester Resin, Curing of Phenyl Acryl Resin Ammunition Industry, Catalyst for Polymerisation, Production of Phenol, Polystyrene Nano-capsules, Epoxidation Agent for allylic Alcohols etc.'),
('RAA PRO CH 470', 'Cumyl Hydroperoxide', 'Liquid', '4.73% - 4.94%', 46.00, 'Curing of Vinyl Ester Resin, Curing of Phenyl Acryl Resin Ammunition Industry, Catalyst for Polymerisation, Production of Phenol, Polystyrene Nano-capsules, Epoxidation Agent for allylic Alcohols etc.'),
('RAA PRO LP 98', 'Dilauroyl Peroxide', 'Powder/Flakes', '3.93%', 98.00, 'Polymer Production, Thermoset Composite Acrylic Production CrossLinking Intiator etc.'),
('RAA PRO LP 99', 'Dilauroyl Peroxide', 'Powder/Flakes', '3.97%', 99.00, 'Polymer Production, Thermoset Composite Acrylic Production CrossLinking Intiator etc.'),
('RAA PRO MIBK', 'Methyl Iso Butyl Ketone Peroxide', 'Liquid', '9.7% - 10.3%', NULL, 'Resin Transfer Molding, Vinyl Ester Resins, Roof Panels, Curing of Unsaturated Polymer Resins, etc.');

-- --------------------------------------------------------

--
-- Table structure for table `paintDriers`
--

CREATE TABLE `paintDriers` (
  `id` int(5) NOT NULL,
  `product` varchar(1000) NOT NULL,
  `metalContent` varchar(1000) NOT NULL,
  `nonVolatile` varchar(1000) NOT NULL,
  `specific Gravity` varchar(100) NOT NULL,
  `viscosity` varchar(100) NOT NULL,
  `benefitsAnduses` varchar(3000) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `paintDriers`
--

INSERT INTO `paintDriers` (`id`, `product`, `metalContent`, `nonVolatile`, `specific Gravity`, `viscosity`, `benefitsAnduses`, `status`, `createdOn`) VALUES
(1, 'AOPL COBALT OCTATE 12%', '12', '60', '1.020', '43', 'It is the most commonly used most active metal octate.Strongly promotes surface drying. It is Bluish Violet in color, but has low effect on color on the dry paint film. It produces less discoloration in wet paint and upon aging of dried paint. Used in combination with other metal driers.', 1, '2025-04-14 07:52:26'),
(2, 'AOPL COBALT OCTATE 10%', '10', '52', '0.97', '15', 'It is the most commonly used most active metal octate.Strongly promotes surface drying. It is Bluish Violet in color, but has low effect on color on the dry paint film. It produces less discoloration in wet paint and upon aging of dried paint. Used in combination with other metal driers.', 1, '2025-04-14 07:52:26'),
(3, 'AOPL COBALT OCTATE 8%', '8', '42', '0.93', '12', 'It is the most commonly used most active metal octate.Strongly promotes surface drying. It is Bluish Violet in color, but has low effect on color on the dry paint film. It produces less discoloration in wet paint and upon aging of dried paint. Used in combination with other metal driers.', 1, '2025-04-14 07:52:26'),
(4, 'AOPL COBALT OCTATE 6%', '6', '32', '0.88', '12', 'It is the most commonly used most active metal octate.Strongly promotes surface drying. It is Bluish Violet in color, but has low effect on color on the dry paint film. It produces less discoloration in wet paint and upon aging of dried paint. Used in combination with other metal driers.', 1, '2025-04-14 07:52:26'),
(5, 'AOPL COBALT OCTATE 3%', '3', '15', '0.82', '12', 'It is the most commonly used most active metal octate.Strongly promotes surface drying. It is Bluish Violet in color, but has low effect on color on the dry paint film. It produces less discoloration in wet paint and upon aging of dried paint. Used in combination with other metal driers.', 1, '2025-04-14 07:52:26'),
(6, 'AOPL MAGANESE OCTATE 10%', '10', '68', '1.000', 'OPEN', 'Lower drying catalyst than cobalt. Intermediate in activity having oxidizing property.Low risk of wrinkling.It has tendency to discolour white or light finishes.Brownish or pink-yellow colour of the paint film develops at high Mn dosages.', 1, '2025-04-14 07:52:26'),
(7, 'AOPL MAGANESE OCTATE 8%', '8', '50', '0.93', '120', 'Lower drying catalyst than cobalt. Intermediate in activity having oxidizing property.Low risk of wrinkling.It has tendency to discolour white or light finishes.Brownish or pink-yellow colour of the paint film develops at high Mn dosages.', 1, '2025-04-14 07:52:26'),
(8, 'AOPL MAGANESE OCTATE 6%', '6', '37', '0.89', '14', 'Lower drying catalyst than cobalt. Intermediate in activity having oxidizing property.Low risk of wrinkling.It has tendency to discolour white or light finishes.Brownish or pink-yellow colour of the paint film develops at high Mn dosages.', 1, '2025-04-14 07:52:26'),
(9, 'AOPL LEAD OCTATE 36%', '36', '70', '1.350', '32', 'Promotes polymerization, increased hardness, through drying.Activity as sole drier is very low and hence always used with Cobalt & / or Manganese, Calcium.Lead improves flexibility and durability of the film.', 1, '2025-04-14 07:52:26'),
(10, 'AOPL LEAD OCTATE 32%', '32', '62', '1.230', '20', 'Promotes polymerization, increased hardness, through drying.Activity as sole drier is very low and hence always used with Cobalt & / or Manganese, Calcium.Lead improves flexibility and durability of the film.', 1, '2025-04-14 07:52:26'),
(11, 'AOPL LEAD OCTATE 24%', '24', '46', '1.080', '13', 'Promotes polymerization, increased hardness, through drying.Activity as sole drier is very low and hence always used with Cobalt & / or Manganese, Calcium.Lead improves flexibility and durability of the film.', 1, '2025-04-14 07:52:26'),
(12, 'AOPL LEAD OCTATE 18%', '18', '35', '0.98', '12', 'Promotes polymerization, increased hardness, through drying.Activity as sole drier is very low and hence always used with Cobalt & / or Manganese, Calcium.Lead improves flexibility and durability of the film.', 1, '2025-04-14 07:52:26'),
(13, 'AOPL CALCIUM OCTATE 10%', '10', '52', '0.98', '18', 'It is an auxiliary drier and has low drying action but is important in combination with active drier.Stabilizes active driers and is often used to replace Lead.Promotes drying under adverse weather conditions. It promotes pigment wetting and dispersing and improves hardness, gloss and reduces the silkings.', 1, '2025-04-14 07:52:26'),
(14, 'AOPL CALCIUM OCTATE 6%', '6', '68', '0.98', '21', 'It is an auxiliary drier and has low drying action but is important in combination with active drier.Stabilizes active driers and is often used to replace Lead.Promotes drying under adverse weather conditions. It promotes pigment wetting and dispersing and improves hardness, gloss and reduces the silkings.', 1, '2025-04-14 07:52:26'),
(15, 'AOPL CALCIUM OCTATE 5%', '5', '50', '0.9', '20', 'It is an auxiliary drier and has low drying action but is important in combination with active drier.Stabilizes active driers and is often used to replace Lead.Promotes drying under adverse weather conditions. It promotes pigment wetting and dispersing and improves hardness, gloss and reduces the silkings.', 1, '2025-04-14 07:52:26'),
(16, 'AOPL CALCIUM OCTATE 3%', '3', '30', '0.84', '12', 'It is an auxiliary drier and has low drying action but is important in combination with active drier.Stabilizes active driers and is often used to replace Lead.Promotes drying under adverse weather conditions. It promotes pigment wetting and dispersing and improves hardness, gloss and reduces the silkings.', 1, '2025-04-14 07:52:26'),
(17, 'AOPL ZINC OCTATE 18%', '18', '75', '1.06', '16', 'Zinc is an auxiliary drier. It activates cobalt thus may enable reduced Cobalt levels for similar drying performance and thus lower risk of film discoloration. Zinc drier keep the film of the paint open by retarding the surface drying thus promotes the thorough drying and avoids surface wrinkling.Zinc addition maintains the color and gloss of the film.', 1, '2025-04-14 07:52:40'),
(18, 'AOPL ZINC OCTATE 12%', '12', '50', '0.93', '12', 'Zinc is an auxiliary drier. It activates cobalt thus may enable reduced Cobalt levels for similar drying performance and thus lower risk of film discoloration. Zinc drier keep the film of the paint open by retarding the surface drying thus promotes the thorough drying and avoids surface wrinkling.Zinc addition maintains the color and gloss of the film.', 1, '2025-04-14 07:52:40'),
(19, 'AOPL ZINC OCTATE 6%', '6', '25', '0.84', '12', 'Zinc is an auxiliary drier. It activates cobalt thus may enable reduced Cobalt levels for similar drying performance and thus lower risk of film discoloration. Zinc drier keep the film of the paint open by retarding the surface drying thus promotes the thorough drying and avoids surface wrinkling.Zinc addition maintains the color and gloss of the film.', 1, '2025-04-14 07:52:40'),
(20, 'AOPL ZIRCONIUM OCTATE 24%', '24', '81', '1.30', '20', 'Most widely accepted replacementsforlead. It is an efficient auxiliarydrier. It serves as through drier incombination with Cobalt, Manganese and Calcium. Shows best color, lowest yellowing tendency. It is best cross-linking agent and imparts hardness,adhesion ofstoved Films.', 1, '2025-04-14 07:52:40'),
(21, 'AOPL ZIRCONIUM OCTATE 18%', '18', '58', '1.10', '15', 'Most widely accepted replacementsforlead. It is an efficient auxiliarydrier. It serves as through drier incombination with Cobalt, Manganese and Calcium. Shows best color, lowest yellowing tendency. It is best cross-linking agent and imparts hardness,adhesion ofstoved Films.', 1, '2025-04-14 07:52:40'),
(22, 'AOPL ZIRCONIUM OCTATE 12%', '12', '40', '0.98', '12', 'Most widely accepted replacementsforlead. It is an efficient auxiliarydrier. It serves as through drier incombination with Cobalt, Manganese and Calcium. Shows best color, lowest yellowing tendency. It is best cross-linking agent and imparts hardness,adhesion ofstoved Films.', 1, '2025-04-14 07:52:40'),
(23, 'AOPL ZIRCONIUM OCTATE 6%', '6', '23', '0.88', '12', 'Most widely accepted replacementsforlead. It is an efficient auxiliarydrier. It serves as through drier incombination with Cobalt, Manganese and Calcium. Shows best color, lowest yellowing tendency. It is best cross-linking agent and imparts hardness,adhesion ofstoved Films.', 1, '2025-04-14 07:52:40'),
(24, 'AOPL COPPER NAPTHANATE 8.6%', '8.6', '55', '0.96', '15', 'It is most suitable in formulation of ship bottom paints as it acts as antifouling agent.It prevents dry rot and mil-dew growth in timber and also used as rot proofing agent in textiles. It is also effective in protection against termites, beets and ambrosia and other insect attacking timber and lumber. The recommended dosage to use 2-2.5% as metal.', 1, '2025-04-14 07:52:40'),
(25, 'AOPL COPPER NAPTHANATE 8%', '8', '51', '0.95', '14', 'It is most suitable in formulation of ship bottom paints as it acts as antifouling agent.It prevents dry rot and mil-dew growth in timber and also used as rot proofing agent in textiles. It is also effective in protection against termites, beets and ambrosia and other insect attacking timber and lumber. The recommended dosage to use 2-2.5% as metal.', 1, '2025-04-14 07:52:40'),
(26, 'AOPL COPPER NAPTHANATE 6%', '6', '40', '0.88', '13', 'It is most suitable in formulation of ship bottom paints as it acts as antifouling agent.It prevents dry rot and mil-dew growth in timber and also used as rot proofing agent in textiles. It is also effective in protection against termites, beets and ambrosia and other insect attacking timber and lumber. The recommended dosage to use 2-2.5% as metal.', 1, '2025-04-14 07:52:40'),
(27, 'AOPL IRON OCTATE 6%', '6', '43', '0.85', '20', 'Iron Octoate is dark in color. The catalytic effect are only at baking temperatures over 130 °C, used for stoving finishes.', 1, '2025-04-14 07:52:40'),
(28, 'AOPL IRON OCTATE 4%', '4', '30', '0.875', '20', 'Iron Octoate is dark in color. The catalytic effect are only at baking temperatures over 130 °C, used for stoving finishes.', 1, '2025-04-14 07:52:40'),
(29, 'AOPL BARIUM OCTATE 12%', '12', '51', '0.94', '20', 'Barium Octate can be used as Substitute for lead Octate. It improves through drying in combination with Cobalt and imparts good pigment wetting characteristics. It improves gloss and reduces loss of dry. Barium can have a negative impact on drying when used with cobalt alternatives.', 1, '2025-04-14 07:52:40'),
(30, 'AOPL CADMIUM OCTATE 15.5%', '15.5', '55', '1.02', '30', 'It is used as heat stability improver along with secondary drier. It is used in combination with Barium and Zinc.', 1, '2025-04-14 07:52:40'),
(31, 'AOPL CADMIUM OCTATE 15%', '15', '53', '1.00', '25', 'It is used as heat stability improver along with secondary drier. It is used in combination with Barium and Zinc.', 1, '2025-04-14 07:52:40'),
(32, 'AOPL POTASSIUM OCTATE 15%', '15', '80', '1.03', '30', 'It activates cobalt and thus may enable reduced Co levels for similar drying performance and thus lower risk of film discoloration.Used mainly for the curing of unsaturated polyester resins; and in water-based coatings toaid solubility.', 1, '2025-04-14 07:52:40');

-- --------------------------------------------------------

--
-- Table structure for table `paintIndustry`
--

CREATE TABLE `paintIndustry` (
  `id` int(5) NOT NULL,
  `product` varchar(1000) NOT NULL,
  `solidContent` varchar(1000) NOT NULL,
  `pH` varchar(1000) NOT NULL,
  `viscosity` varchar(1000) NOT NULL,
  `mfft` varchar(100) NOT NULL,
  `application` varchar(1000) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `paintIndustry`
--

INSERT INTO `paintIndustry` (`id`, `product`, `solidContent`, `pH`, `viscosity`, `mfft`, `application`, `status`, `createdOn`) VALUES
(1, 'AOPL 504', '50 ± 1', '7-9', '9000 - 15000 (4/10)', '18', 'Superior quality interior paint with high sheen,Textured coatings, Construction chemical, waterbase crackle finish.', 1, '2025-04-07 06:29:52'),
(2, 'AOPL 596 T', '50 ± 1', '7-9', '1000 - 2500 (4/10)', '20', 'Superior quality exterior paint with high sheen,Textured coatings', 1, '2025-04-07 06:29:52'),
(3, 'AOPL 504 E', '50 ± 1', '7-9', '9000 - 15000 (4/10)', '16', 'Superior quality Exterior paint with high sheen,Textured coatings, Construction chemical,waterbase crackle finish. APEO and formaldehyde free.', 1, '2025-04-07 06:29:52'),
(4, 'AOPL 259', '49 ± 1', '7-9', '8000 - 14000 (4/10)', '17', 'Economical Distemper,Low-Cost interior emulsion paint, cement primer, Putty.', 1, '2025-04-07 06:29:52'),
(5, 'AOPL 2504', '49 ± 1', '7-9', '8000 - 14000 (4/10)', '17', 'Economical Distemper, Low cost interior emulsion paint, cement primer,Putty.', 1, '2025-04-07 06:29:52'),
(6, 'AOPL 3045', '45 ± 1', '7-9', '10000 - 15000 (4/10)', '18', 'Economical low cost distemper, interior paint,cement primer.', 1, '2025-04-07 06:29:52'),
(7, 'AOPL 3055', '45 ± 1', '7-9', '10000 - 15000 (4/10)', '18', 'Economical low cost distemper, interior paint,cement primer.', 1, '2025-04-07 06:29:52'),
(8, 'AOPL 3040', '40 ± 1', '7-9', '12000 - 20000 (4/10)', '15', 'Economical Distemper, Low cost interior emulsion paint, cement primer,Putty', 1, '2025-04-07 06:29:52'),
(9, 'AOPL EL 128', '50 ± 1', '7-9', '3000 - 5000 (4/10)', '16', 'Superior quality interior and exterior paint with high sheen.', 1, '2025-04-07 06:29:52'),
(10, 'AOPL MUR 57', '57 ± 1', '6-8', '1000 - 3000 (4/20)', '11 (Tg=-35)', 'Suitable for Elastomeric roof coating and masonry coating.', 1, '2025-04-07 06:29:52'),
(11, 'AOPL 565', '55 ± 1', '7-9', '50 - 200 (3/30)', '16', 'High Gloss and Sheen Interior Premium paint with detergent resistance and washability.', 1, '2025-04-07 06:29:52'),
(12, 'AOPL 561', '50 ± 1', '7-9', '30 - 200 (3/30)', '15', 'High gloss,high sheen interior/ exterior paint.', 1, '2025-04-07 06:29:52'),
(13, 'AOPL 561 E', '50 ± 1', '7-9', '30 - 200 (3/300)', '15', 'Semi-gloss interior and exterior paint. APEO and formaldehyde free. Coatings for cementitious substrates.', 1, '2025-04-07 06:29:52'),
(14, 'AOPL PVV 55', '55 ± 1', '4-6', '1200 - 2500 (4/10)', '12', 'Semi-gloss to matt interior and exterior paints.', 1, '2025-04-07 06:29:52'),
(15, 'AOPL PVV 50', '50 ± 1', '4-6', '2000 - 4000 (4/10)', '12', 'Semi-gloss interior and exterior paint. Coatings for cementitious substrates.', 1, '2025-04-07 06:29:52'),
(16, 'AOPL PVB 55', '55 ± 1', '4-6', '800 - 1500 (4/10)', '7', 'Interior Flat/ matt paint.', 1, '2025-04-07 06:29:52'),
(17, 'AOPL PVB 50', '50 ± 1', '8-9', '300 - 800 (4/10)', '6', 'Semi-gloss to matt interior and exterior paints.', 1, '2025-04-07 06:29:52'),
(18, 'AOPL VVL', '50 ± 1', '8-9', '20 - 150 (2/10)', '7', 'Interior Flat/ matt paint.', 1, '2025-04-07 06:29:52'),
(19, 'AOPL EM 50', '50 ± 1', '4-6', '50000 - 90000 (7/20)', '14', 'Low-cost semi-gloss interior paint.', 1, '2025-04-07 06:29:52');

-- --------------------------------------------------------

--
-- Table structure for table `paperIndustry`
--

CREATE TABLE `paperIndustry` (
  `id` int(5) NOT NULL,
  `product` varchar(1000) NOT NULL,
  `dosage` varchar(50) DEFAULT NULL,
  `solidPercent` varchar(1000) DEFAULT NULL,
  `pH` varchar(1000) DEFAULT NULL,
  `viscocity` varchar(50) DEFAULT NULL,
  `application` varchar(1000) DEFAULT NULL,
  `dosingPeriod` varchar(50) DEFAULT NULL,
  `benefits` varchar(500) DEFAULT NULL,
  `category` varchar(1000) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `paperIndustry`
--

INSERT INTO `paperIndustry` (`id`, `product`, `dosage`, `solidPercent`, `pH`, `viscocity`, `application`, `dosingPeriod`, `benefits`, `category`, `status`, `createdOn`) VALUES
(1, 'AOPL AP546', '', '50', '7.5+', '', 'Duplex Paper Board', '', '', 'cat1', 1, '2025-03-08 13:12:45'),
(2, 'AOPL 2259', '', '48', '8-10', '', 'Duplex Paper Board', '', '', 'cat1', 1, '2025-03-08 13:12:45'),
(3, 'AOPL 2504', '', '50', '8-10', '', 'Duplex Paper Board', '', '', 'cat1', 1, '2025-03-08 13:12:45'),
(4, 'AOPL P DEF', '', '', '5.5-7', '', 'Textile Industry, Paper Industry, Dye Manufacturing', '', '', 'cat1', 1, '2025-03-08 13:12:45'),
(5, 'AOPL DIS', '', '39-41', '7.5-9', '', 'dispersing inorganic pigments in paper industry', '', '', 'cat1', 1, '2025-03-08 13:12:45'),
(6, 'AOPL P252', '', '50', '6-7', '', 'laminates, wallpapers and filters', '', '', 'cat1', 1, '2025-03-08 13:12:45'),
(7, 'AOPL P 1001', '', '30±1', '', '', 'Kraft / Writing & Printing / Duplex', '', '', 'cat2', 1, '2025-03-08 13:12:45'),
(8, 'AOPL P 1005', '', '30 ± 1', '', '', 'Kraft / Writing & Printing / Duplex', '', '', 'cat2', 1, '2025-03-08 13:12:45'),
(9, 'AOPL P 1050', '', '50 ± 2', '5±2', '', 'As Coagulant/Fixing Agent', '', '', 'cat3', 1, '2025-03-08 13:12:45'),
(10, 'Anionic- AOPL P 4048', '', '20 ± 2', '6 ± 1', '1500 ± 200', 'For Strength at wet end in all Paper Grade', '', '', 'cat4', 1, '2025-03-08 13:12:45'),
(11, 'Anionic - AOPL P 4049', '', '30 ± 2', '6 ± 1', '2800 ± 200', 'For Strength at S/Press in all Paper Grade', '', '', 'cat4', 1, '2025-03-08 13:12:45'),
(12, 'Cationic - AOPL P 4018', '', '20 ± 2', '5 ± 1', '2000 ± 200', 'For Strength at wet end in all Paper Grade', '', '', 'cat4', 1, '2025-03-08 13:12:45'),
(13, 'Amphoteric - AOPL P 4025', '', '20 ± 2', '4 ± 1', '3800 ± 200', 'For Strength at wet end in all Paper Grade', '', '', 'cat4', 1, '2025-03-08 13:12:45'),
(14, 'G Pam - AOPL P 4030', '', '7 ± 1', '3 ± 1', '35 ± 5', 'For Strength at wet end in all Paper Grade', '', '', 'cat4', 1, '2025-03-08 13:12:45'),
(15, 'AOPL P 2022', '', '15±1', '4 ± 1', '18 ± 2 cps', 'Currency / Tissue / Absorbent Kraft Paper', '', '', 'cat5', 1, '2025-03-08 13:12:45'),
(16, 'AOPL P 2032', '', '30 ± 2', '4 ± 1', '18 ± 2 cps', 'Currency / Tissue / Absorbent Kraft Paper', '', '', 'cat5', 1, '2025-03-08 13:12:45'),
(17, 'AOPL P 2020', '', '', '', '', 'Coating Adhesive (MEDIUM TO HARD)', '', '', 'cat6', 1, '2025-03-08 13:12:45'),
(18, 'AOPL P 2021', '', '', '', '', 'Coating Adhesive (SOFT)', '', '', 'cat6', 1, '2025-03-08 13:12:45'),
(19, 'AOPL P 2026', '', '', '', '', 'De Bonder', '', '', 'cat6', 1, '2025-03-08 13:12:45'),
(20, 'AOPL P 2027', '', '', '', '', 'Softener', '', '', 'cat6', 1, '2025-03-08 13:12:45'),
(21, 'AOPL P 2028', '', '', '', '', 'Release Aid', '', '', 'cat6', 1, '2025-03-08 13:12:45'),
(22, 'AOPL P 2036', '', '', '', '', 'Wire passivation', '', '', 'cat6', 1, '2025-03-08 13:12:45'),
(23, 'AOPL P 2042', '', '', '', '', 'Felt Conditioning', '', '', 'cat6', 1, '2025-03-08 13:12:45'),
(24, 'AOPL P 1021', '', '30 ± 1', '', '', 'In Pulper and Flotation Cell', '', '', 'cat7', 1, '2025-03-08 13:12:45'),
(25, 'AOPL P 2030', '150 to 300 ppm of shower flow', '', '', '', 'Shower on the return circuit below Breast Roll', 'Continuous', '', 'cat8', 1, '2025-03-08 13:12:45'),
(26, 'AOPL P 1021', '', '', '', '', 'Cooking Aid', '', 'Reduced amount of rejects and shives in pulp, improved rate of delignification of pulp, Improve Brown Stock Washing Efficiency', 'cat9', 1, '2025-03-08 13:12:45'),
(27, 'AOPL P 3060', '', '', '', '', 'Pitch & Stickies Management', '', 'Reduce dispersion of stickies at the Pulper, Enable maximum Stickies removal', 'cat 10', 1, '2025-03-08 13:12:45'),
(28, 'AOPL p 1050', '', '', '', '', 'Pitch & Stickies Management', '', 'Maintaining smaller particle size of stickies for easy removal at later stages, Reduce sheet breaks & Improve formation, Lower backwater turbidity due to better retention of stickies', 'cat 10', 1, '2025-03-08 13:12:45'),
(29, 'AOPL P 2030', '150 to 300 ppm of shower flow', '', '', '', 'Shower on the return circuit below Breast Roll', 'Continuous', '', 'cat 10', 1, '2025-03-08 13:12:45'),
(30, 'AOPL P 2042', '150 to 300 ppm of shower flow', '', '', '', 'Lubricating Shower of Felt', 'Continuous', '', 'cat 10', 1, '2025-03-08 13:12:45');

-- --------------------------------------------------------

--
-- Table structure for table `salicylates`
--

CREATE TABLE `salicylates` (
  `createdOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `salicylates`
--

INSERT INTO `salicylates` (`createdOn`) VALUES
('2025-03-08 15:46:04'),
('2025-03-09 15:46:04'),
('2025-03-10 15:46:04'),
('2025-03-11 15:46:04'),
('2025-03-12 15:46:04');

-- --------------------------------------------------------

--
-- Table structure for table `specialityChemicals`
--

CREATE TABLE `specialityChemicals` (
  `id` int(5) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT current_timestamp(),
  `product` varchar(1000) NOT NULL,
  `solids percent` varchar(50) NOT NULL,
  `ph value` varchar(50) NOT NULL,
  `viscosity` varchar(100) NOT NULL,
  `mfft` varchar(50) NOT NULL,
  `applications` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `specialityChemicals`
--

INSERT INTO `specialityChemicals` (`id`, `status`, `createdOn`, `product`, `solids percent`, `ph value`, `viscosity`, `mfft`, `applications`) VALUES
(1, 1, '2025-04-03 02:20:43', 'AOPL DEF (Silicone Defoamer)', '24 ± 1', '5.5-7 of 2% dilute solution', '6000 - 8000 (4/10)', 'NA', 'Used as defoamer in: Textile, Paper, Dye manufacturing, Laundries, Paint Industry, Effluent treatment plants, etc. It is recommended to add AOPL DEF to any batch before agitation'),
(2, 1, '2025-04-03 02:20:43', 'AOPL DIS', '40 ± 1', '7.5-9.0', '100 - 300 (4/20)', 'NA', 'Used as pigment dispersant in aqueous systems for dispersion of inorganic pigments with improved stability.'),
(3, 1, '2025-04-03 02:20:43', 'AOPL ADIS', '32 ± 1', '7.5-9.0', '100 - 300 (4/20)', 'NA', 'Used as pigment dispersant in aqueous systems for dispersion of inorganic pigments with improved stability.'),
(4, 1, '2025-04-03 02:20:43', 'AOPL ADIS AP 40', '40 ± 1', '7.5-9.0', '100 - 300 (4/20)', 'NA', 'Used as pigment dispersant in aqueous systems for dispersion of inorganic pigments with improved stability.'),
(5, 1, '2025-04-03 02:20:43', 'AOPL ADIS AP 32', '32 ± 1', '7.5-9.0', '100 - 300 (4/20)', 'NA', 'Used as pigment dispersant in aqueous systems for dispersion of inorganic pigments with improved stability.'),
(6, 1, '2025-04-03 02:20:43', 'AOPL T 29', '29 ± 1', '2-4', '10 - 30 (4/20)', 'NA', 'Used as thickener in Paint and construction application.'),
(7, 1, '2025-04-03 02:20:43', 'AOPL Super 60', '--', '2-4', '0-20 CPS', 'NA', 'Used as thickener in Paint and construction application.'),
(8, 1, '2025-04-03 02:20:43', 'AOPL 4301', '26 ± 1', '8.5-10', '18000 - 28000 (7/20)', 'NA', 'Rheological modifier in interior and exterior water-based paint.'),
(9, 1, '2025-04-03 02:20:43', 'AOPL HT 30', '30 ± 1', '2-4', '10-20 CPS', 'NA', 'Rheological Modifier in interior and exterior water-based paint.'),
(10, 1, '2025-04-03 02:20:43', 'AOPL AC 9', '53 ± 1', '2 - 4', '20 - 25 sec', '12', 'High Sheen premier quality interior / exterior Paint and wood coating.'),
(11, 1, '2025-04-03 02:20:43', 'AOPL 33', '30 ± 2', 'NA', '20 - 25 sec (ASTMD 1200)', 'NA', 'Used on wood, concrete, stucco, brick work, galvanized metal, vinyl, and Aluminium Siding, etc.');

-- --------------------------------------------------------

--
-- Table structure for table `textileIndustry`
--

CREATE TABLE `textileIndustry` (
  `id` int(5) NOT NULL,
  `product` varchar(1000) NOT NULL,
  `solidPercent` varchar(1000) NOT NULL,
  `application` varchar(1000) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `textileIndustry`
--

INSERT INTO `textileIndustry` (`id`, `product`, `solidPercent`, `application`, `status`, `createdOn`) VALUES
(64, 'AOPL G94 SP', '44 ± 2%', 'A Self-cross linking and self-thickening acrylic emulsion. It is mainly used in table printing.', 1, '2025-04-07 06:46:30'),
(65, 'AOPL GLC 40', '55 ± 2%', 'This is our best all round candidate for use in formulating laminating adhesives for bonding a wide variety of substrates.', 1, '2025-04-07 06:46:30'),
(66, 'AOPL GMUR 57', '60 ± 3%', 'This is a new generation Acrylic copolymer dispersion, APEO free and formaldehyde free designed for tufted carpet back coating.', 1, '2025-04-07 06:46:30'),
(67, 'AOPL GPT 60', 'N/A', 'This is eco-friendly polymer thickener which is suitable for Pigment Printing in textile.', 1, '2025-04-07 06:46:30'),
(68, 'AOPL GT 29', '30 ± 2%', 'Rheology modifier for making khadi, pearl etc.', 1, '2025-04-07 06:46:30'),
(69, 'AOPL G SUPER 60', 'N/A', 'Rheology modifier for sharp prints.', 1, '2025-04-07 06:46:30'),
(70, 'AOPL GHT 30', 'N/A', 'Haze Thickener.', 1, '2025-04-07 06:46:30'),
(71, 'AOPL GDEF', 'N/A', 'Silicone based defoamer for high turbulence process. Stable and high performance even in presence of high amount of electrolytes.', 1, '2025-04-07 06:46:30'),
(72, 'AOPL GDIS', '32 ± 2%', 'This is a pigment dispersant for aqueous systems. Especially useful for dispersing inorganic pigment such as titanium dioxide, zinc oxide, clay with improved stability. It is efficient in a wide range of pH in various emulsion systems.', 1, '2025-04-07 06:46:30'),
(73, 'AOPL G SNOW WHITE 9', 'N/A', 'Ready to use khadi paste for high speed printing machines.', 1, '2025-04-07 06:46:30'),
(74, 'AOPL G SUPER SNOW 99', 'N/A', 'Ready to use khadi paste for sharp print and all round fastness.', 1, '2025-04-07 06:46:30'),
(75, 'POLYSOL', 'N/A', 'PVA dispersions which imports a soft handle on textiles and ensures full light fastness and non yellowing properties on the treated fabrics retaining their luster. It is used for durable finishes for cotton and it\'s various blends.', 1, '2025-04-07 06:46:30'),
(76, 'AOPL GAM 45', '55 ± 2%', 'Adhesive for tables for pigment printing.', 1, '2025-04-07 06:46:30'),
(77, 'AOPL G 5301', '30 ± 2%', 'Textile Pigmment Printing Binder.', 1, '2025-04-07 06:46:30'),
(78, 'AOPL G 5401', '40±2%', 'Special Binder for all round fastness for pigment printing on high speed machines.', 1, '2025-04-07 06:46:30'),
(79, 'AOPL G 5201', '50 ± 2%', 'Economical binder emulsion for pigment printing.', 1, '2025-04-07 06:46:30'),
(80, 'AOPL GFIX APO', 'N/A', 'Zero formaldehyde fixer for pigment printing.', 1, '2025-04-07 06:46:30'),
(81, 'AOPL APL', '32 ± 2%', 'A Self cross-linking and self thickening acrylic emulsion. It is used mainly in PEARL, KHADI and ZARI.', 1, '2025-04-07 06:46:30'),
(82, 'AOPL 540', '40 ± 2%', 'A Self cross-linking acrylic emulsion. It is used mainly in PEARL, KHADI and ZARI and WHITE INK.', 1, '2025-04-07 06:46:30'),
(83, 'AOPL 4000', '32 ± 2%', 'A Self cross-linking acrylic emulsion It is used mainly in pigment printing on synthetic fabrics and its blends.', 1, '2025-04-07 06:46:30'),
(84, 'AOPL EV 40', '40 ± 1%', 'It is used mainly in pigment printing on synthetic fabric and its blends.', 1, '2025-04-07 06:46:30'),
(85, 'AOPL 280', '40 ± 2%', 'Roller Coating, Silk Skeen, Brush-table adhesive.', 1, '2025-04-07 06:46:30'),
(86, 'AOPL 94', '28 ± 2%', 'A Self cross-linking binder and self-thickening acrylic emulsion. It is mainly used in table printing.', 1, '2025-04-07 06:46:30'),
(87, 'AOPL 94 SP', '44 ± 2%', 'A Self cross linking and self-thickening acrylic emulsion. It is mainly used in table printing.', 1, '2025-04-07 06:46:30'),
(88, 'AOPL SAN', '40 ± 2%', 'A Self cross-linking acrylic emulsion. It is mainly used in Pigment Printing.', 1, '2025-04-07 06:46:30'),
(89, 'AOPL SSL', '32 ± 2%', 'A Self cross-linking acrylic emulsion. It is mainly used in table Pigment.', 1, '2025-04-07 06:46:30'),
(90, 'AOPL GBSP', 'N/A', 'Acrylic binder for gold or bronze metal powder printing on fabric for sharp print and higher fastness.', 1, '2025-04-07 06:46:30'),
(91, 'AOPL GB', 'N/A', 'Acrylic binder for gold or bronze metal powder printing on fabric.', 1, '2025-04-07 06:46:30'),
(92, 'AOPL GB PAP', 'N/A', 'Acrylic binder for gold or bronze metal powder printing on paper.', 1, '2025-04-07 06:46:30'),
(93, 'AOPL GBNB', 'N/A', 'Acrylic binder for gold bronze metal powder printing. It avoids oxidization of metal powder on printed fabric.', 1, '2025-04-07 06:46:30'),
(94, 'AOPL T29', '30 ± 2%', 'Rheology modifier for very soft and free flowing paste.', 1, '2025-04-07 06:46:30'),
(95, 'AOPL PT 60', 'N/A', 'An eco-friendly polymer thickener which is suitable for Pigment printing.', 1, '2025-04-07 06:46:30'),
(96, 'AOPL FIO', 'N/A', 'High Performance binder for printing foil on machine.', 1, '2025-04-07 06:46:30'),
(97, 'AOPL HOT FOIL BINDER', 'N/A', 'Binder with excellent fastness for hot process.', 1, '2025-04-07 06:46:30'),
(98, 'AOPL COLD FOIL BINDER', 'N/A', 'Binder for cold process application of foil.', 1, '2025-04-07 06:46:30'),
(99, 'AOPL SOL', '40 ± 2%', 'Soft print emulsion for printing on knitted goods. Also used as Khadi Binder for medium stretch.', 1, '2025-04-07 06:46:30'),
(100, 'AOPL MUR 57', '60 ± 3%', 'A new generation acrylic copolymer dispersion, APEO free and formaldehyde free designed for soft coating and printing.', 1, '2025-04-07 06:46:30'),
(101, 'AOPL F222', 'N/A', 'Flock Binder.', 1, '2025-04-07 06:46:30'),
(102, 'AOPL T192', '50 ± 2%', 'Used to adhere stone on fabric.', 1, '2025-04-07 06:46:30'),
(103, 'AOPL T199', '55 ± 2%', 'Used to adhere stone on fabric.', 1, '2025-04-07 06:46:30'),
(104, 'AOPL DEF', 'N/A', 'Silicone based defoamer for high turbulence process. Stable and high performance even presence of high number of electrolytes.', 1, '2025-04-07 06:46:30'),
(105, 'AOPL ZB', 'N/A', 'Zari Binder.', 1, '2025-04-07 06:46:30'),
(106, 'AOPL ADIS', '32 ± 2%', 'This is a pigment dispersant for aqueous systems. Especially useful for dispersing inorganic pigments such as titanium dioxide, zinc oxide, clay with improved stability. It is efficient in a wide range of pH in various emulsion systems.', 1, '2025-04-07 06:46:30'),
(107, 'AOPL CP 54', '55 ± 2%', 'Clear paste used for chest printing.', 1, '2025-04-07 06:46:30'),
(108, 'AOPL LC 40', '55 ± 2%', 'This is our best all round candidate for use in formulating laminating adhesives for bonding a wide variety of substrates.', 1, '2025-04-07 06:46:30'),
(109, 'AOPL KHD 33', 'N/A', 'This is ready to use non-stretch khadi develop for printing on flat belt as well as table.', 1, '2025-04-07 06:46:30'),
(110, 'AOPL AM 45', '55 ± 2%', 'Roller Coating, Silk Screen, Brush-table adhesive.', 1, '2025-04-07 06:46:30'),
(111, 'AOPL SUPER FIX 30', 'N/A', 'It is used as Finishing agent foIt is used as Finishing agent to enhance fastness of prints.', 1, '2025-04-07 06:46:30'),
(112, 'AOPL EM 50P', '50 ± 2%', 'A poly vinyl acetate dispersion which imports a soft handle on textiles and ensures full light fastness and non-yellowing properties on the treated fabrics retaining their lustre.', 1, '2025-04-07 06:46:30'),
(113, 'AOPL EM 40', '40 ± 2%', 'PVA dispersions which imports a soft handle on textiles and ensures full light fastness and non- yellowing properties on the treated fabrics retaining their luster.it is used for durable finishes for cotton and it\'s various blends.', 1, '2025-04-07 06:46:30'),
(114, 'AOPL EM 45', '45 ± 2%', 'PVA dispersions which imports a soft handle on textiles and ensures full light fastness and non- yellowing properties on the treated fabrics retaining their luster.it is used for durable finishes for cotton and it\'s various blends.', 1, '2025-04-07 06:46:30'),
(115, 'AOPL EM 48', '48 ± 2%', 'PVA dispersions which imports a soft handle on textiles and ensures full light fastness and non- yellowing properties on the treated fabrics retaining their luster.it is used for durable finishes for cotton and it\'s various blends.', 1, '2025-04-07 06:46:30'),
(116, 'AOPL EM 50', '50 ± 2%', 'PVA dispersions which imports a soft handle on textile and ensures full light fastness and non- yellowing properties on the treated fabrics retaining their luster.it is used for durable finishes for cotton and it\'s various blends.', 1, '2025-04-07 06:46:30'),
(117, 'AOPL EM 50 G', '50 ± 2%', 'Used for durable finishes for cotton, linen, polyester, rayon and various blends. Used for Textile Finishing and Printing.', 1, '2025-04-07 06:46:30'),
(118, 'AOPL ABX', '55 ± 2%', 'PVA dispersions which imports a soft handle on textile and ensures full light fastness and non- yellowing properties on the treated fabrics retaining their luster.it is used for durable finishes for cotton and it\'s various blends.', 1, '2025-04-07 06:46:30'),
(119, 'AOPL 5400 (APBX)', '55 ± 1%', 'Used for durable finishes for cotton, linen, polyester, rayon and various blends. Used for Textile Finishing and Printing.', 1, '2025-04-07 06:46:30'),
(120, 'AOPL HBT', '45 ± 1%', 'Primary & secondary backing in carpet back sizing, non- wovens carpets, baggage fabrics, flocking & paper coating for hard feel.', 1, '2025-04-07 06:46:30'),
(121, 'AOPL SBT', 'N/A', 'Coating Binder for Soft Finishes. This can be made available in Matt as well as Glossy style.', 1, '2025-04-07 06:46:30'),
(122, 'AOPL AH 40', '40 ± 2%', 'It is used for durable finishes for cotton, linen, polyester, rayon and various blends.', 1, '2025-04-07 06:46:30'),
(123, 'AOPL AH 48', '48 ± 2%', 'It is used for durable finishes for cotton, linen, polyester, rayon and various blends.', 1, '2025-04-07 06:46:30'),
(124, 'AOPL AH 51', '51 ± 2%', 'It is used for durable finishes for cotton, linen, polyester, rayon and various blends.', 1, '2025-04-07 06:46:30'),
(125, 'AOPL F2F', 'N/A', 'For smooth edges and Binding different Fabrics together.', 1, '2025-04-07 06:46:30'),
(126, 'AOPL ROP06', 'N/A', 'For zari application on yarn.', 1, '2025-04-07 06:46:30');

-- --------------------------------------------------------

--
-- Table structure for table `woodIndustry`
--

CREATE TABLE `woodIndustry` (
  `id` int(5) NOT NULL,
  `product` varchar(1000) NOT NULL,
  `solidPercent` varchar(1000) NOT NULL,
  `pH` varchar(1000) NOT NULL,
  `applicatoin` varchar(1000) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `woodIndustry`
--

INSERT INTO `woodIndustry` (`id`, `product`, `solidPercent`, `pH`, `applicatoin`, `status`, `createdOn`) VALUES
(1, 'AOPL W 65', '55', '7 – 9', 'Protective Wood Coating', 1, '2025-03-13 15:46:04'),
(2, 'AOPL EM 50 A', '50', '5 - 7', 'Wood Glue', 1, '2025-03-14 15:46:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accelerators`
--
ALTER TABLE `accelerators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acrylicEmulsion`
--
ALTER TABLE `acrylicEmulsion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adhesiveIndustry`
--
ALTER TABLE `adhesiveIndustry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carpetIndustry`
--
ALTER TABLE `carpetIndustry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `combinationDriers`
--
ALTER TABLE `combinationDriers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compositeFRPIndOne`
--
ALTER TABLE `compositeFRPIndOne`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compositeFRPIndTwo`
--
ALTER TABLE `compositeFRPIndTwo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `constructionIndustry`
--
ALTER TABLE `constructionIndustry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `indPersonalhomecare`
--
ALTER TABLE `indPersonalhomecare`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paintDriers`
--
ALTER TABLE `paintDriers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paintIndustry`
--
ALTER TABLE `paintIndustry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paperIndustry`
--
ALTER TABLE `paperIndustry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specialityChemicals`
--
ALTER TABLE `specialityChemicals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `textileIndustry`
--
ALTER TABLE `textileIndustry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `woodIndustry`
--
ALTER TABLE `woodIndustry`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accelerators`
--
ALTER TABLE `accelerators`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `acrylicEmulsion`
--
ALTER TABLE `acrylicEmulsion`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `adhesiveIndustry`
--
ALTER TABLE `adhesiveIndustry`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `carpetIndustry`
--
ALTER TABLE `carpetIndustry`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `combinationDriers`
--
ALTER TABLE `combinationDriers`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `compositeFRPIndOne`
--
ALTER TABLE `compositeFRPIndOne`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `compositeFRPIndTwo`
--
ALTER TABLE `compositeFRPIndTwo`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `constructionIndustry`
--
ALTER TABLE `constructionIndustry`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `indPersonalhomecare`
--
ALTER TABLE `indPersonalhomecare`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `paintDriers`
--
ALTER TABLE `paintDriers`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `paintIndustry`
--
ALTER TABLE `paintIndustry`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `paperIndustry`
--
ALTER TABLE `paperIndustry`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `specialityChemicals`
--
ALTER TABLE `specialityChemicals`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `textileIndustry`
--
ALTER TABLE `textileIndustry`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `woodIndustry`
--
ALTER TABLE `woodIndustry`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
