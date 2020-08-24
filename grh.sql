-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2017 at 06:55 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grh`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(50) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `firstname`, `lastname`, `username`, `telephone`, `email`, `designation`, `password`) VALUES
(1, 'Radwane', 'Mabchour', 'radwane', '0698437090', 'radwane@example.com', 'wert uio', '4124bc0a9335c27f086f24ba207a4912'),
(2, 'zouheir', 'zaidi', 'zouheir', '0678936251', 'zouheir@example.com', 'Software Engineer', 'd41d8cd98f00b204e9800998ecf8427e'),
(6, 'AdminTest', 'Admin', 'admin', '0000000000', 'admin@example.com', 'adminDesignation', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `approve_hr`
--

CREATE TABLE `approve_hr` (
  `hr_approve` int(50) NOT NULL,
  `name_stat` varchar(120) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `approve_hr`
--

INSERT INTO `approve_hr` (`hr_approve`, `name_stat`) VALUES
(1, 'En Attendant\n'),
(2, 'PERMISSION'),
(3, 'SANS PERMISSION');

-- --------------------------------------------------------

--
-- Table structure for table `deduction`
--

CREATE TABLE `deduction` (
  `fonct_id` int(50) NOT NULL,
  `ID_ded` int(50) NOT NULL,
  `nbr_conge` int(50) NOT NULL,
  `ID_paie` int(50) NOT NULL,
  `TYPE_LEAVES` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deduction`
--

INSERT INTO `deduction` (`fonct_id`, `ID_ded`, `nbr_conge`, `ID_paie`, `TYPE_LEAVES`) VALUES
(1, 1, 2, 1, 'PERMISSION'),
(1, 2, 1, 2, 'PERMISSION'),
(1, 14, 0, 7, 'SANS PERMI'),
(1, 13, 0, 7, 'PERMISSION'),
(1, 5, 0, 3, 'SANS PERMI'),
(1, 6, 8, 4, 'SANS PERMI'),
(5, 7, 10, 5, 'PERMISSION'),
(5, 8, 2, 5, 'SANS PERMI'),
(2, 9, 15, 6, 'PERMISSION'),
(2, 10, 0, 6, 'SANS PERMI'),
(2, 11, 0, 7, 'PERMISSION'),
(2, 12, 6, 7, 'SANS PERMI');

-- --------------------------------------------------------

--
-- Table structure for table `demande_formation`
--

CREATE TABLE `demande_formation` (
  `form_id` int(11) NOT NULL,
  `fonct_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `demande_formation`
--

INSERT INTO `demande_formation` (`form_id`, `fonct_id`, `date`) VALUES
(5, 2, '2017-05-29 12:27:47');

-- --------------------------------------------------------

--
-- Table structure for table `fonctionnaire`
--

CREATE TABLE `fonctionnaire` (
  `designation` varchar(100) NOT NULL,
  `bureau` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fonct_id` int(50) NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `grade` int(50) NOT NULL,
  `date_entre` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fonctionnaire`
--

INSERT INTO `fonctionnaire` (`designation`, `bureau`, `email`, `firstname`, `lastname`, `password`, `fonct_id`, `telephone`, `username`, `grade`, `date_entre`) VALUES
('Professeur', 'Desktop', 'ali@gmail.com', 'ALI', 'EL MEZOUARY', '86318e52f5ed4801abe1d13d509443de', 1, '0623254589', 'ali', 1, '2017-05-23'),
('Designer', 'Sans Bureau', 'said@example', 'Said', 'Orafi', 'b7b791e873f143d5318310e59022175d', 2, '0687956473', 'said', 3, '2017-05-28'),
('TestPost', 'TestDesktop', 'test@example.com', 'userTest', 'User', '098f6bcd4621d373cade4e832627b4f6', 3, '0000000000', 'test', 8, '2017-05-29'),
('userDesignation', 'userDesktop', 'user@example.com', 'user', 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 5, '0876564839', 'user', 6, '2017-05-08'),
('Hardware Engineer', 'Bureau 23', 'zouheir@example.com', 'zouheir', 'zaidi', 'fbade9e36a3f36d3d676c1b808451dd7', 6, '0274826472', 'zouheir', 4, '2007-07-01');

-- --------------------------------------------------------

--
-- Table structure for table `formation`
--

CREATE TABLE `formation` (
  `form_id` int(50) NOT NULL,
  `fonct_id` int(50) NOT NULL,
  `formateur` varchar(100) NOT NULL,
  `date_deb` date NOT NULL,
  `date_fin` date NOT NULL,
  `description` varchar(100) NOT NULL,
  `duree` int(100) NOT NULL,
  `formation` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `formation`
--

INSERT INTO `formation` (`form_id`, `fonct_id`, `formateur`, `date_deb`, `date_fin`, `description`, `duree`, `formation`) VALUES
(1, 1, 'qsq', '2017-05-07', '2017-05-31', 'wahgvvchdbs', 25, 'sssss'),
(2, 1, 'dsf', '2017-05-01', '2017-05-31', 'formation3', 30, 'fd'),
(3, 1, 'fsq', '2017-05-04', '2017-05-03', 'fdsq', 1, 'er'),
(4, 2, 'dqsd', '2017-05-01', '2017-05-06', 'formation4', 5, 'dsq'),
(5, 0, 're', '2017-04-03', '2017-05-24', 'qwerty', 52, 'f'),
(6, 2, 'yyy', '2017-05-01', '2017-05-30', 'yyyyyyyy', 30, 'yyy'),
(7, 1, 'etr', '2017-05-01', '2017-06-30', 'formation7', 60, 'rt');

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `basic_salary` float NOT NULL,
  `ID_gr` int(50) NOT NULL,
  `grade` int(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`basic_salary`, `ID_gr`, `grade`) VALUES
(10000, 1, 1),
(9000, 2, 2),
(8000, 3, 3),
(7000, 4, 4),
(6000, 5, 5),
(5000, 6, 6),
(4000, 7, 7),
(3500, 8, 8),
(3000, 9, 9),
(2500, 10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `indemnite`
--

CREATE TABLE `indemnite` (
  `fonct_id` int(50) NOT NULL,
  `ID_ind` int(50) NOT NULL,
  `indm_hr` float NOT NULL,
  `indm_long` float NOT NULL,
  `indm_trn` float NOT NULL,
  `ID_paie` int(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `indemnite`
--

INSERT INTO `indemnite` (`fonct_id`, `ID_ind`, `indm_hr`, `indm_long`, `indm_trn`, `ID_paie`) VALUES
(2000, 1, 2000, 1000, 0, 1),
(1, 2, 1, 1, 1, 3),
(1, 3, 3, 1, 2, 4),
(5, 4, 200, 1000, 500, 5),
(2, 5, 0, 1000, 0, 6),
(200, 6, 0, 200, 300, 7),
(1, 7, 0, 0, 0, 7);

-- --------------------------------------------------------

--
-- Table structure for table `location_details`
--

CREATE TABLE `location_details` (
  `date_deployment` date NOT NULL,
  `ld_id` int(50) NOT NULL,
  `stdev_id` int(50) NOT NULL,
  `fonct_id` int(50) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location_details`
--

INSERT INTO `location_details` (`date_deployment`, `ld_id`, `stdev_id`, `fonct_id`, `id`) VALUES
('2017-05-31', 1, 4, 1, 0),
('2017-05-29', 4, 3, 3, 0),
('2017-06-01', 3, 2, 2, 0),
('2017-05-29', 5, 1, 4, 0),
('2017-05-29', 6, 1, 5, 0),
('2017-06-01', 7, 1, 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `fonct_id` int(11) NOT NULL,
  `sender` varchar(10) NOT NULL,
  `receiver` varchar(10) NOT NULL,
  `del_from_admin` tinyint(1) NOT NULL DEFAULT '0',
  `del_from_fonct` tinyint(1) NOT NULL DEFAULT '0',
  `message` varchar(1000) NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `seen` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `admin_id`, `fonct_id`, `sender`, `receiver`, `del_from_admin`, `del_from_fonct`, `message`, `time`, `seen`) VALUES
(12, 1, 1, 'admin', 'fonct', 0, 0, 'hello Ali', '2017-05-24 20:59:04', 1),
(13, 1, 1, 'fonct', 'admin', 0, 0, 'Hello Mr. Radwane', '2017-05-24 20:59:43', 1),
(14, 1, 2, 'fonct', 'admin', 0, 0, 'hello', '2017-05-28 12:05:10', 1),
(15, 1, 2, 'fonct', 'admin', 0, 0, 'qwertyu iop[ dfghjk fgbn rfghj dfghjk fghjkj rerghtjhk,k. dgfhgnhmn fghtgjh retrytyjkuji fdghgjh fdgfhgjhkj fdgfghmj,k trhtgjhkj trytuyiku', '2017-05-28 12:45:08', 1),
(16, 1, 2, 'admin', 'fonct', 0, 0, 'Hello said', '2017-05-28 17:40:56', 1),
(17, 1, 2, 'admin', 'fonct', 0, 0, 'How are U', '2017-05-28 17:42:06', 1),
(18, 1, 2, 'admin', 'fonct', 0, 0, 'sawd', '2017-05-28 17:53:33', 1),
(19, 1, 2, 'fonct', 'admin', 0, 0, 'hey ', '2017-05-28 17:54:56', 1),
(20, 1, 2, 'fonct', 'admin', 0, 0, 'where  r U', '2017-05-28 17:55:46', 1),
(21, 1, 2, 'admin', 'fonct', 0, 0, 'I m Fine', '2017-05-28 18:29:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notif_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `type_person` varchar(25) NOT NULL,
  `link` varchar(25) NOT NULL,
  `content` varchar(200) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `seen` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notif_id`, `person_id`, `type_person`, `link`, `content`, `date`, `seen`) VALUES
(1, 1, 'fonct', 'conge', 'votre conge pour le ...', '2017-05-23 15:28:26', 1),
(2, 1, 'fonct', 'formation', 'demande de formation accepte', '2017-05-23 13:29:21', 1),
(3, 1, 'fonct', 'payslip', 'fiche de paie pour janvier 2017 est genere', '2017-05-23 16:08:00', 1),
(4, 1, 'fonct', 'payslip', 'Payslip for march 2017 is generated', '2017-05-24 16:25:46', 1),
(5, 2, 'fonct', 'formation', 'Vous avez une formation pour qwerty', '2017-05-28 15:38:50', 1),
(6, 2, 'fonct', 'formation', 'Votre demande pour la formation formation7 est acceptee', '2017-05-28 16:13:42', 1),
(7, 2, 'fonct', 'formation', 'Votre demande pour la formation  est refusee', '2017-05-28 16:37:52', 1),
(8, 2, 'fonct', 'formation', 'Votre demande pour la formation yyyyyyyy est refusee', '2017-05-28 16:41:11', 1),
(9, 1, 'fonct', 'formation', 'Votre demande pour la formation yyyyyyyy est refusee', '2017-05-28 16:43:36', 1),
(10, 2, 'fonct', 'formation', 'Votre demande pour la formation yyyyyyyy est acceptee', '2017-05-28 16:44:27', 1),
(11, 1, 'fonct', 'formation', 'Votre demande pour la formation formation7 est acceptee', '2017-05-29 12:28:53', 1),
(12, 2, 'fonct', 'formation', 'Votre demande pour la formation formation7 est refusee', '2017-05-29 12:29:08', 1),
(13, 2, 'fonct', 'formation', 'Votre demande de formation yyyyyyyy est acceptee', '2017-05-29 12:40:17', 1),
(14, 2, 'fonct', 'conge', 'Votre demande de conge de 2017-06-01 a 2017-06-15 est refusee', '2017-05-29 14:23:15', 1),
(15, 2, 'fonct', 'conge', 'Votre demande de conge de 2017-06-01 a 2017-06-15 est acceptee', '2017-05-29 14:25:29', 1),
(16, 2, 'fonct', 'payslip', 'Votre fiche de paie pour february 2010 est generee', '2017-05-29 17:36:29', 1),
(17, 1, 'fonct', 'payslip', 'Votre fiche de paie pour january 2017 est generee', '2017-05-29 19:04:07', 1),
(18, 1, 'fonct', 'formation', 'Votre demande de formation qwerty est refusee', '2017-06-01 14:48:45', 0),
(19, 2, 'fonct', 'formation', 'Vous etes transfere au Departement DB', '2017-06-01 15:09:47', 1),
(20, 0, 'admin', 'conge', 'Said Orafi a demandÃ© un congÃ©', '2017-06-01 15:43:38', 1),
(21, 0, 'admin', 'formation', 'user user a demandÃ© une formation', '2017-06-01 15:46:28', 1),
(22, 5, 'fonct', 'formation', 'Votre demande de formation qwerty est refusee', '2017-06-01 15:50:54', 0);

-- --------------------------------------------------------

--
-- Table structure for table `paie`
--

CREATE TABLE `paie` (
  `basic_salary` int(11) NOT NULL,
  `date` date NOT NULL,
  `deduction` float NOT NULL,
  `fonct_id` int(50) NOT NULL,
  `indemnite` float NOT NULL,
  `mois` varchar(10) NOT NULL,
  `net_salary` float NOT NULL,
  `nbr_conge` int(20) NOT NULL,
  `nbr_sans_per` int(11) NOT NULL DEFAULT '0',
  `ID_paie` int(50) NOT NULL,
  `salaire_jour` float NOT NULL,
  `annee` varchar(4) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paie`
--

INSERT INTO `paie` (`basic_salary`, `date`, `deduction`, `fonct_id`, `indemnite`, `mois`, `net_salary`, `nbr_conge`, `nbr_sans_per`, `ID_paie`, `salaire_jour`, `annee`, `deleted`) VALUES
(10000, '2017-05-01', 0, 1, 3000, 'january', 13000, 2, 0, 1, 333.333, '2008', 0),
(10000, '0000-00-00', 0, 1, 259, 'Janvier', 10259, 1, 0, 2, 322.581, '2017', 0),
(10000, '2017-05-06', 0, 1, 3, 'january', 10003, 1, 0, 3, 333.333, '2017', 0),
(10000, '2017-05-08', 2580.65, 1, 6, 'Janvier', 7425.35, 8, 0, 4, 322.581, '2017', 1),
(5000, '2017-05-29', 333.333, 5, 1700, 'january', 6366.67, 10, 2, 5, 166.667, '2016', 0),
(8000, '2017-05-29', 0, 2, 1000, 'january', 9000, 15, 0, 6, 266.667, '2010', 0),
(8000, '2017-05-29', 1600, 2, 700, 'february', 7100, 0, 6, 7, 266.667, '2010', 0);

-- --------------------------------------------------------

--
-- Table structure for table `stlocation`
--

CREATE TABLE `stlocation` (
  `stdev_id` int(50) NOT NULL,
  `stdev_location_name` varchar(1000) NOT NULL,
  `thumbnails` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stlocation`
--

INSERT INTO `stlocation` (`stdev_id`, `stdev_location_name`, `thumbnails`) VALUES
(1, 'DAAG', 'images/thumbnails.jpg'),
(2, 'DB', 'images/thumbnails.jpg'),
(3, 'DEPP', 'images/thumbnails.jpg'),
(4, 'IGF', 'images/thumbnails.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `vacation_log`
--

CREATE TABLE `vacation_log` (
  `eddate` date NOT NULL,
  `fonct_id` int(50) NOT NULL,
  `v_id` int(50) NOT NULL,
  `vp_operation` int(11) NOT NULL,
  `vl_stat` int(2) NOT NULL,
  `sdate` date NOT NULL,
  `prog_head` int(11) NOT NULL,
  `nodays` int(10) NOT NULL,
  `leavetype` varchar(128) NOT NULL,
  `hr_approve` int(50) NOT NULL,
  `vdate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vacation_log`
--

INSERT INTO `vacation_log` (`eddate`, `fonct_id`, `v_id`, `vp_operation`, `vl_stat`, `sdate`, `prog_head`, `nodays`, `leavetype`, `hr_approve`, `vdate`) VALUES
('2017-05-10', 1, 9, 1, 0, '2017-05-01', 1, 9, 'Deplacement', 3, '2017-05-18'),
('2017-05-25', 1, 13, 1, 0, '2017-05-09', 1, 17, 'Vacance', 1, '2017-05-21'),
('2017-05-09', 1, 6, 1, 0, '2017-05-01', 1, 8, 'Deplacement', 2, '2017-05-08'),
('2017-05-09', 2, 7, 1, 0, '2017-05-01', 1, 9, 'Deplacement', 2, '2017-05-08'),
('2017-05-30', 1, 10, 1, 0, '2017-05-25', 1, 6, 'Maladie', 2, '2017-05-18'),
('2017-05-12', 1, 12, 1, 0, '2017-05-02', 1, 11, 'Maladie', 1, '2017-05-21'),
('2017-06-15', 2, 14, 1, 0, '2017-06-01', 1, 15, 'Vacance', 2, '2017-05-29'),
('2017-06-20', 2, 16, 1, 0, '2017-06-15', 1, 6, 'Vacance', 1, '2017-06-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `approve_hr`
--
ALTER TABLE `approve_hr`
  ADD PRIMARY KEY (`hr_approve`);

--
-- Indexes for table `deduction`
--
ALTER TABLE `deduction`
  ADD PRIMARY KEY (`ID_ded`);

--
-- Indexes for table `demande_formation`
--
ALTER TABLE `demande_formation`
  ADD PRIMARY KEY (`form_id`,`fonct_id`);

--
-- Indexes for table `fonctionnaire`
--
ALTER TABLE `fonctionnaire`
  ADD PRIMARY KEY (`fonct_id`);

--
-- Indexes for table `formation`
--
ALTER TABLE `formation`
  ADD PRIMARY KEY (`form_id`);

--
-- Indexes for table `indemnite`
--
ALTER TABLE `indemnite`
  ADD PRIMARY KEY (`ID_ind`);

--
-- Indexes for table `location_details`
--
ALTER TABLE `location_details`
  ADD PRIMARY KEY (`ld_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notif_id`);

--
-- Indexes for table `paie`
--
ALTER TABLE `paie`
  ADD PRIMARY KEY (`ID_paie`);

--
-- Indexes for table `stlocation`
--
ALTER TABLE `stlocation`
  ADD PRIMARY KEY (`stdev_id`);

--
-- Indexes for table `vacation_log`
--
ALTER TABLE `vacation_log`
  ADD PRIMARY KEY (`v_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `approve_hr`
--
ALTER TABLE `approve_hr`
  MODIFY `hr_approve` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `deduction`
--
ALTER TABLE `deduction`
  MODIFY `ID_ded` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `fonctionnaire`
--
ALTER TABLE `fonctionnaire`
  MODIFY `fonct_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `formation`
--
ALTER TABLE `formation`
  MODIFY `form_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `indemnite`
--
ALTER TABLE `indemnite`
  MODIFY `ID_ind` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `location_details`
--
ALTER TABLE `location_details`
  MODIFY `ld_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notif_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `paie`
--
ALTER TABLE `paie`
  MODIFY `ID_paie` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `stlocation`
--
ALTER TABLE `stlocation`
  MODIFY `stdev_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `vacation_log`
--
ALTER TABLE `vacation_log`
  MODIFY `v_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
