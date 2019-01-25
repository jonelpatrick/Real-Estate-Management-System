-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2019 at 06:19 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rems`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutdetails`
--

CREATE TABLE IF NOT EXISTS `aboutdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(50) NOT NULL,
  `cell_number` varchar(20) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `fb_link` varchar(40) NOT NULL,
  `twitter_link` varchar(40) NOT NULL,
  `in_link` varchar(40) NOT NULL,
  `gplus_link` varchar(40) NOT NULL,
  `email_address` varchar(40) NOT NULL,
  `short_article` varchar(2000) NOT NULL,
  `full_article` varchar(5000) NOT NULL,
  `services` varchar(2000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `aboutdetails`
--

INSERT INTO `aboutdetails` (`id`, `address`, `cell_number`, `phone_number`, `fb_link`, `twitter_link`, `in_link`, `gplus_link`, `email_address`, `short_article`, `full_article`, `services`) VALUES
(1, 'San Pedro, Davao City', '09120158355', '(082) 271-65-96', 'fb.com/', 'twitter.com/', 'in.com/a', 'google.com', 'dfmpvsinc@gmail.com', 'SERVICE. INTEGRITY. EXCELLENCE. dfmpvsinc.org aims to streamline business involving upscale land projects in Davao and provide top notch service to clients local and overseas who wants to invest in the growing landscape. Clients can expect efficient service, candor, straight-forward solutions to problemsand excellence in every real estate deal. You can now buy, sell and rent any landsunit within Davao on a daily and ongoing basis.', 'SERVICE. INTEGRITY. EXCELLENCE.\r\n\r\ndfmpvsinc.org aims to streamline business involving upscale condominium projects in Davao and provide top notch service to clients local and overseas who wants to invest in the growing condominium landscape. Clients can expect efficient service, candor, straight-forward solutions to problems and excellence in every real estate deal. You can now buy, sell and rent any condominium unit within Davao on a daily and ongoing basis.\r\n\r\nIt is founded by Jetro Carlo Pinili, an International Realtor with ID No. #061242167, Licensed Real Estate Broker with ID No. 0024867, Licensed Registered Nurse with ID No. #0491978, real estate investor, and entrepreneur. Awarded as a Top Performing Broker 2016 of Matina Enclaves by ESDEVCO Realty Corp. and included in Top 10 Performing Brokers 2016 of Verdon Parc by DMCI HOMES.', 'Our services includes providing clients with a true value proposition in their land investment. Also, after sales support like documentation, finding of bank financing and potential solutions to problems in the real estate landscape. In line with this, integrity above expedience is our core value in doing business.');

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`username`, `password`, `id`, `deleted`) VALUES
('admin', 'admin', 20, 0),
('kevin', 'kevin', 41, 0),
('joana', 'joana', 42, 0),
('clerk', 'clerk', 43, 0),
('manager', 'manager', 44, 0),
('juda', 'juda', 45, 0),
('aw', 'aw', 46, 0),
('aw', 'milla', 47, 0),
('kendra', 'kendra', 48, 0),
('richard', 'richard', 49, 0),
('jenny', 'jenny', 50, 0),
('menard', 'menard', 51, 0),
('nicole', 'nicole', 52, 0),
('lenan', 'lenan', 53, 0),
('christopher', 'christopher', 54, 0),
('ogie', 'ogie', 55, 0),
('aw', 'aw', 56, 0),
('aw', 'aw', 57, 0),
('jano', 'jano', 58, 0),
('jonathan', 'jonathan', 59, 0);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` tinyint(2) NOT NULL DEFAULT '0',
  `position` varchar(150) NOT NULL DEFAULT 'Client',
  `physical_address` varchar(255) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `contact_number` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `account_id` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `firstname`, `middlename`, `lastname`, `age`, `gender`, `position`, `physical_address`, `email_address`, `contact_number`, `image_path`, `account_id`, `status`, `deleted`) VALUES
(15, 'Joana', 'M', 'Sarbosa', 45, 1, 'Client', 'Philippines', 'raybar1703@gmail.com', 2147483647, 'Tulips.jpg', 42, 0, 0),
(16, 'Juda', 'M ', 'Dela Cruz', 28, 1, 'Client', 'Philippines', 'raybar1703@gmail.com', 2147483647, 'Jellyfish.jpg', 45, 0, 0),
(17, 'Jenny', 'M', 'Masiga', 28, 1, 'Client', 'davao', 'davao@gmail.com', 123, 'cross-line-laser.png', 46, 0, 0),
(18, 'Kendra', 'M ', 'Kendro', 45, 1, 'Client', 'Philippines', 'raybar1703@gmail.com', 2147483647, 'Penguins-1.jpg', 48, 0, 0),
(19, 'Richard', 'M ', 'Santiago', 0, 0, 'Client', 'Philippines', 'raybar1703@gmail.com', 2147483647, 'Chrysanthemum.jpg', 49, 0, 0),
(20, 'Jenny', 'M ', 'Mercado', 25, 1, 'Client', 'Philippines', 'raybar1703@gmail.com', 2147483647, 'Jellyfish-1.jpg', 50, 0, 0),
(21, 'Jano', 'K', 'Gibs', 23, 0, 'Client', 'Philippines', 'jano@gmail.com', 2147483647, 'mqdefault.jpg', 58, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `client_payment_transaction`
--

CREATE TABLE IF NOT EXISTS `client_payment_transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `date_paid` date NOT NULL,
  `due_date` date NOT NULL,
  `amount_paid` int(11) NOT NULL,
  `method_of_payment` tinyint(2) NOT NULL DEFAULT '0',
  `transacted_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `client_payment_transaction`
--

INSERT INTO `client_payment_transaction` (`id`, `property_id`, `client_id`, `date_paid`, `due_date`, `amount_paid`, `method_of_payment`, `transacted_by`) VALUES
(9, 16, 16, '2018-09-19', '2018-10-19', 5000, 1, 5),
(10, 16, 16, '2018-09-19', '2018-11-18', 1000, 0, 5),
(11, 16, 16, '2018-09-20', '2018-12-18', 417, 0, 5),
(13, 21, 16, '2018-10-05', '1970-01-31', 7000, 0, 5),
(14, 21, 16, '2018-10-05', '1970-03-02', 7000, 1, 5),
(15, 17, 15, '2018-10-05', '2018-10-22', 5000, 0, 5),
(16, 21, 16, '2018-10-05', '1970-04-01', 7000, 0, 5),
(17, 0, 0, '2018-10-06', '0000-00-00', 0, 0, 5),
(18, 0, 0, '2018-10-06', '1970-01-31', 0, 0, 5),
(19, 0, 0, '2018-10-06', '1970-03-02', 0, 0, 5),
(20, 0, 0, '2018-10-06', '1970-04-01', 0, 0, 5),
(21, 0, 0, '2018-10-06', '1970-05-01', 0, 0, 5),
(22, 0, 0, '2018-10-06', '1970-05-31', 0, 0, 5),
(23, 0, 0, '2018-10-06', '1970-06-30', 0, 0, 5),
(24, 0, 0, '2018-10-06', '1970-07-30', 0, 0, 5),
(25, 0, 0, '2018-10-06', '1970-08-29', 0, 0, 5),
(26, 0, 0, '2018-10-06', '1970-09-28', 0, 0, 5),
(27, 0, 0, '2018-10-06', '1970-10-28', 0, 0, 5),
(28, 0, 0, '2018-10-06', '1970-11-27', 0, 0, 5),
(29, 0, 0, '2018-10-06', '1970-12-27', 0, 0, 5),
(30, 0, 0, '2018-10-06', '1971-01-26', 0, 0, 5),
(31, 0, 0, '2018-10-06', '1971-02-25', 0, 0, 5),
(32, 0, 0, '2018-10-06', '1971-03-27', 0, 0, 5),
(33, 16, 16, '2018-10-06', '2019-01-17', 500, 0, 5),
(34, 18, 20, '2018-10-07', '2018-11-05', 4200, 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `comments` varchar(5000) NOT NULL,
  `datecreated` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `fullname`, `email`, `comments`, `datecreated`) VALUES
(4, 'asdasdasd', 'raybar1703@gmail.com', 'asdasd', '2018-10-07'),
(5, 'asd', 'kennjaysantos@gmail.com', 'asda ljkasnglknasdgklnsdf ndsf,mn sd,fb s,df sdf nmsfn.s,mdf,msgnmasda ljkasnglknasdgklnsdf ndsf,mn sd,fb s,df sdf nmsfn.s,mdf,msgnmasda ljkasnglknasdgklnsdf ndsf,mn sd,fb s,df sdf nmsfn.s,mdf,msgnmasda ljkasnglknasdgklnsdf ndsf,mn sd,fb s,df sdf nmsfn.s,mdf,msgnmasda ljkasnglknasdgklnsdf ndsf,mn sd,fb s,df sdf nmsfn.s,mdf,msgnmasda ljkasnglknasdgklnsdf ndsf,mn sd,fb s,df sdf nmsfn.s,mdf,msgnm\r\n', '2018-10-07'),
(6, 'Kennjay', 'raybar1703@gmail.com', 'asasnfnsadkjgnskjgnksdfngklsajhnesrjhwklehkcwergkljegojslkjdslkgjsojoirjoperiwjohjlkdmhlkdfmhlkdfhoemohimtoihmeohmrogmhkmhortmhortmhortmhortmhortmhomrtohmrtkhmktrmhj;wjpe;gojsroihlsrhsrjhsrhsrhjrostroy', '2018-10-07');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` tinyint(2) NOT NULL DEFAULT '0',
  `position` varchar(255) NOT NULL DEFAULT 'Customer',
  `physical_address` varchar(255) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `contact_number` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `account_id` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `firstname`, `middlename`, `lastname`, `age`, `gender`, `position`, `physical_address`, `email_address`, `contact_number`, `image_path`, `account_id`, `status`, `deleted`) VALUES
(13, 'Kevin', 'M', 'Santos', 56, 0, 'Customer', 'Philippines', 'raybar1703@gmail.com', 2147483647, 'Penguins.jpg', 41, 0, 0),
(14, 'Milla', 'K', 'Kanto', 75, 0, 'Customer', 'davao', 'davao@gmail.com', 123123, 'survey-instruments.png', 47, 0, 0),
(15, 'Menard', 'K', 'Lucas', 28, 0, 'Customer', 'Philippines', 'raybar1703@gmail.com', 2147483647, 'Hydrangeas.jpg', 51, 0, 0),
(16, 'Nicole', 'P', 'Matos', 56, 1, 'Customer', 'Philippines', 'raybar1703@gmail.com', 2147483647, 'Desert.jpg', 52, 0, 0),
(17, 'Lenan', 'K', 'Lenan', 18, 0, 'Customer', 'Philippines', 'raybar1703@gmail.com', 2147483647, 'Lighthouse-1.jpg', 53, 0, 0),
(18, 'Christopher', 'J', 'Ramos', 29, 0, 'Customer', 'Philippines', 'raybar1703@gmail.com', 2147483647, 'Chrysanthemum-1.jpg', 54, 0, 0),
(19, 'Ogie', 'K', 'Alcasid', 56, 0, 'Customer', 'Philippines', 'ogie@gmail.com', 2147483647, '1463541096_Ogie-5.jpg', 55, 0, 0),
(20, 'as', 's', 'd', 223, 0, 'Customer', 'Philippines', 'raybar1703@gmail.com', 2147483647, 'final_score_769333.png', 56, 0, 1),
(21, 'as', 's', 'd', 223, 0, 'Customer', 'Philippines', 'raybar1703@gmail.com', 2147483647, 'final_score_769333-1.png', 57, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_document_on_hand`
--

CREATE TABLE IF NOT EXISTS `customer_document_on_hand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uploads_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date_transferred` date NOT NULL,
  `transferred_by` int(11) NOT NULL,
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `customer_document_on_hand`
--

INSERT INTO `customer_document_on_hand` (`id`, `uploads_id`, `customer_id`, `date_transferred`, `transferred_by`, `deleted`) VALUES
(7, 19, 13, '2018-10-07', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `devided_property`
--

CREATE TABLE IF NOT EXISTS `devided_property` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `orig_property_current_size` int(11) NOT NULL,
  `property_size` int(11) NOT NULL,
  `size_unit` int(11) NOT NULL,
  `property_price` int(11) NOT NULL,
  `devided_by` int(11) NOT NULL,
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `devided_property`
--

INSERT INTO `devided_property` (`id`, `property_id`, `orig_property_current_size`, `property_size`, `size_unit`, `property_price`, `devided_by`, `deleted`) VALUES
(1, 17, 200, 50, 0, 10000, 5, 1),
(2, 17, 200, 50, 0, 5000, 5, 1),
(3, 17, 200, 50, 0, 5000, 5, 1),
(4, 17, 200, 50, 0, 10000, 5, 1),
(5, 17, 150, 50, 0, 5000, 5, 1),
(6, 17, 200, 50, 0, 5000, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` tinyint(2) NOT NULL DEFAULT '0',
  `position` varchar(100) NOT NULL,
  `physical_address` varchar(255) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `contact_number` int(15) NOT NULL,
  `image_path` varchar(150) NOT NULL,
  `account_id` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `firstname`, `middlename`, `lastname`, `age`, `gender`, `position`, `physical_address`, `email_address`, `contact_number`, `image_path`, `account_id`, `status`, `deleted`) VALUES
(5, 'Jonel', 'L', 'Opsimar', 27, 0, 'Administrator', 'Davao1', 'info@rems.com', 2147483647, 'Koala.jpg', 20, 0, 0),
(6, 'Jessa', 'K', 'Saragosa', 26, 1, 'Clerk', 'Philippines', 'raybar1703@gmail.com', 2147483647, 'Lighthouse.jpg', 43, 0, 0),
(7, 'Michael', 'M', 'Mora', 47, 0, 'Clerk', 'Philippines', 'raybar1703@gmail.com', 2147483647, 'Tulips-1.jpg', 44, 0, 0),
(8, 'Jonathan', 'O', 'Andro', 56, 0, 'Clerk', 'Philippines', 'jonathan@gmail.com', 2147483647, 'mqdefault-1.jpg', 59, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `img` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `img`, `title`, `description`) VALUES
(1, 'ex-miner-striking-fashion-gold.jpg', 'TEST', 'TEST'),
(2, 'ex-miner-striking-fashion-gold.jpg', 'TEST', 'TEST'),
(3, 'logo_web5.png', 'Logo Update', 'Update');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_request`
--

CREATE TABLE IF NOT EXISTS `maintenance_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `contact_number` int(11) NOT NULL,
  `request_date` date NOT NULL,
  `property_access_by` tinyint(2) NOT NULL DEFAULT '0',
  `repair_request` varchar(1000) NOT NULL,
  `scheduled` tinyint(2) NOT NULL DEFAULT '0',
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `maintenance_request`
--

INSERT INTO `maintenance_request` (`id`, `customer_id`, `property_id`, `contact_number`, `request_date`, `property_access_by`, `repair_request`, `scheduled`, `deleted`) VALUES
(9, 13, 16, 2147483647, '2018-09-19', 1, 'This is a test', 1, 0),
(10, 13, 16, 2147483647, '2018-09-19', 0, 'tetst', 1, 0),
(12, 13, 16, 2147483647, '2018-10-05', 0, 'This is a test', 1, 0),
(13, 13, 16, 2147483647, '2018-10-05', 1, 'asdasdasd', 1, 0),
(14, 13, 16, 2147483647, '2018-10-05', 0, 'this is a test', 0, 0),
(15, 16, 22, 2147483647, '2018-10-06', 0, 'this is a test from nicole matso', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_scheduled`
--

CREATE TABLE IF NOT EXISTS `maintenance_scheduled` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `maintenance_request_id` int(11) NOT NULL,
  `scheduled_date` date NOT NULL,
  `person_in_charge` varchar(255) NOT NULL,
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `maintenance_scheduled`
--

INSERT INTO `maintenance_scheduled` (`id`, `maintenance_request_id`, `scheduled_date`, `person_in_charge`, `deleted`) VALUES
(2, 9, '2018-09-19', 'Lee Santiago', 0),
(3, 10, '2018-09-19', 'sdd', 0),
(4, 12, '2018-10-05', 'Lee Santiago', 0),
(5, 13, '2018-10-18', 'Lee Santiago', 0);

-- --------------------------------------------------------

--
-- Table structure for table `news_updates`
--

CREATE TABLE IF NOT EXISTS `news_updates` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `news_title` varchar(255) NOT NULL,
  `news_description` varchar(1000) NOT NULL,
  `news_created` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `news_updates`
--

INSERT INTO `news_updates` (`id`, `news_title`, `news_description`, `news_created`) VALUES
(1, 'Discount 10% all land.', 'SERVICE. INTEGRITY. EXCELLENCE. dfmpvsinc.org aims to streamline business involving upscale land projects in Davao and provide top notch service to clients local and overseas who wants to invest in the growing landscape. Clients can expect efficient service, candor, straight-forward solutions to problemsand excellence in every real estate deal. You can now buy, sell and rent any landsunit within Davao on a daily and ongoing basis.', '2018-10-07'),
(5, 'Meeting!s', 'There will be a meeting regarding our land this coming October 20, 2018.', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `payment_transaction`
--

CREATE TABLE IF NOT EXISTS `payment_transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `property_sold_id` int(11) NOT NULL,
  `date_paid` date NOT NULL,
  `due_date` date NOT NULL,
  `method_of_payment` tinyint(2) NOT NULL DEFAULT '0',
  `amount_paid` int(11) NOT NULL,
  `transacted_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `payment_transaction`
--

INSERT INTO `payment_transaction` (`id`, `customer_id`, `property_sold_id`, `date_paid`, `due_date`, `method_of_payment`, `amount_paid`, `transacted_by`) VALUES
(37, 13, 16, '2018-09-19', '2018-10-19', 0, 15000, 5),
(38, 16, 19, '2018-10-05', '2018-11-04', 0, 13000, 5),
(39, 14, 20, '2018-10-07', '2018-11-06', 0, 6300, 5);

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE IF NOT EXISTS `property` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `property_relation` tinyint(2) NOT NULL DEFAULT '0',
  `date_management_commence` date NOT NULL,
  `property_name` varchar(150) NOT NULL,
  `block` int(11) NOT NULL DEFAULT '0',
  `lot` int(11) NOT NULL DEFAULT '0',
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `property_size` varchar(100) NOT NULL,
  `subject_to` tinyint(2) NOT NULL DEFAULT '0',
  `price_per_sqm` int(11) NOT NULL,
  `price_bought` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `size_unit` tinyint(2) NOT NULL DEFAULT '0',
  `payment_mode` tinyint(2) NOT NULL DEFAULT '0',
  `monthly_payment` int(11) NOT NULL,
  `property_type` tinyint(2) NOT NULL DEFAULT '0',
  `caretaker` tinyint(2) NOT NULL DEFAULT '0',
  `additional_info` varchar(500) NOT NULL,
  `property_condition` tinyint(2) NOT NULL DEFAULT '0',
  `availability` tinyint(2) NOT NULL DEFAULT '0',
  `image_path` varchar(150) NOT NULL DEFAULT 'no-image-land.png',
  `isdevided` int(11) NOT NULL DEFAULT '0',
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`id`, `client_id`, `property_relation`, `date_management_commence`, `property_name`, `block`, `lot`, `address`, `city`, `postal_code`, `property_size`, `subject_to`, `price_per_sqm`, `price_bought`, `price`, `size_unit`, `payment_mode`, `monthly_payment`, `property_type`, `caretaker`, `additional_info`, `property_condition`, `availability`, `image_path`, `isdevided`, `deleted`) VALUES
(16, 16, 0, '2018-10-07', 'HOLIDAY OCEANVIEW VILLAGE', 0, 0, 'Lot 1, Block 10, Purok 6 Brgy Gulf view', 'Davao City', 8000, '100', 0, 0, 50000, 70000, 0, 10, 417, 1, 0, 'This is a test', 0, 1, 'image-0-480x320.jpg', 0, 0),
(17, 15, 0, '2018-10-07', 'Avida Land REAL 102', 0, 0, 'Lot 1, Block 8 Brgy Agdao', 'Davao City', 8000, '250', 0, 0, 100000, 150000, 0, 2, 4167, 0, 0, '', 0, 1, 'images__2_.jpg', 0, 0),
(18, 20, 0, '2018-10-04', 'Jenny Residence', 0, 0, 'Philippines, Ph', 'Davao City', 8000, '500', 0, 0, 50000, 150000, 0, 1, 4167, 0, 0, 'This is a test', 0, 1, 'prop5-1.jpg', 0, 0),
(19, 18, 0, '2018-10-04', 'Kendra Residence', 0, 0, 'Philippines, Ph', 'Davao City', 8000, '1000', 0, 0, 100000, 150000, 0, 1, 8333, 0, 0, 'This is a test', 0, 0, 'prop4-3.jpg', 0, 0),
(20, 19, 0, '2018-10-04', 'Richard Residence', 0, 0, 'Philippines, Ph', 'Davao City', 8000, '800', 0, 0, 500000, 1000000, 0, 10, 4167, 0, 0, '', 0, 0, 'prop2.jpg', 0, 0),
(21, 16, 1, '2018-10-05', 'Juda 2 Residencial Land', 0, 0, 'Philippines, Ph', 'Davao City', 8000, '500', 0, 0, 150000, 200000, 0, 2, 6250, 0, 0, 'This is a test', 0, 0, 'prop2-1.jpg', 0, 0),
(22, 17, 2, '2018-10-05', 'Masiga Subdivision', 0, 0, 'Philippines, Ph', 'Davao City', 8000, '450', 0, 0, 50000, 150000, 0, 5, 833, 0, 0, 'a test', 0, 1, 'prop3.jpg', 0, 0),
(23, 19, 0, '2018-10-06', 'Richard Residence 2', 1, 2, 'Philippines, Ph', 'Davao City', 8000, '200', 0, 0, 40000, 60000, 0, 2, 5130, 0, 0, '', 0, 0, 'Chrysanthemum-2.jpg', 0, 0),
(24, 20, 0, '2018-10-07', 'Mercado Compound', 1, 20, 'Philippines, Ph', 'Davao City', 8000, '500', 0, 0, 20000, 40000, 0, 1, 1667, 0, 0, '', 0, 0, '5b855e33dda4c86e688b4610.jpg', 0, 0),
(25, 15, 1, '2018-10-11', 'Sarsaba Compound', 5, 6, 'Philippines, Ph', 'Davao City', 8000, '350', 0, 2000, 700000, 2000000, 0, 2, 4167, 2, 0, 'This is a sarsaba compound', 0, 0, 'sarsaba-compound-1.jpg', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `property-image`
--

CREATE TABLE IF NOT EXISTS `property-image` (
  `id` int(40) NOT NULL AUTO_INCREMENT,
  `pid` int(40) NOT NULL,
  `img` varchar(255) NOT NULL,
  `date-created` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `property_gallery`
--

CREATE TABLE IF NOT EXISTS `property_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_path` varchar(255) NOT NULL,
  `property_id` int(11) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `property_gallery`
--

INSERT INTO `property_gallery` (`id`, `image_path`, `property_id`, `deleted`) VALUES
(1, 'prop1.jpg', 16, 0),
(2, 'prop2.jpg', 16, 0),
(4, 'prop3.jpg', 16, 0),
(5, 'prop5.jpg', 16, 0),
(6, '1463541096_Ogie-5.jpg', 0, 0),
(7, 'land-expropriation-1.jpg', 16, 0),
(8, 'images.jpg', 16, 0),
(9, 'sunlight-sunny-land-scenic-weather_1127-2333.jpg', 16, 0),
(11, 'image-0-480x320.jpg', 16, 0),
(12, 'images (2).jpg', 16, 0),
(13, 'images.jpg', 16, 0),
(14, 'images (1).jpg', 16, 0),
(16, 'land-expropriation-1.jpg', 16, 0),
(17, 'sunlight-sunny-land-scenic-weather_1127-2333.jpg', 16, 0),
(18, 'images (1).jpg', 17, 0),
(19, 'images (2).jpg', 17, 0),
(20, 'images.jpg', 17, 0),
(21, 'land-expropriation-1.jpg', 17, 0);

-- --------------------------------------------------------

--
-- Table structure for table `property_sold`
--

CREATE TABLE IF NOT EXISTS `property_sold` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `terms_of_payment` int(6) NOT NULL,
  `monthly_payment` int(11) NOT NULL,
  `transacted_by` int(11) NOT NULL,
  `date_added` date NOT NULL,
  `first_due_date` date NOT NULL,
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `property_sold`
--

INSERT INTO `property_sold` (`id`, `customer_id`, `property_id`, `total_amount`, `terms_of_payment`, `monthly_payment`, `transacted_by`, `date_added`, `first_due_date`, `deleted`) VALUES
(16, 13, 16, 70000, 15, 389, 5, '2018-09-19', '2018-10-19', 0),
(18, 15, 18, 150000, 12, 1042, 5, '2018-10-05', '2018-11-04', 0),
(19, 16, 22, 150000, 1, 12500, 5, '2018-10-05', '2018-11-04', 0),
(20, 14, 17, 150000, 2, 6250, 5, '2018-10-07', '2018-11-06', 0),
(21, 21, 0, 0, 1, 0, 5, '2018-10-08', '2018-11-07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reference_number`
--

CREATE TABLE IF NOT EXISTS `reference_number` (
  `id` int(40) NOT NULL AUTO_INCREMENT,
  `p_id` int(40) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_created` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `reference_number`
--

INSERT INTO `reference_number` (`id`, `p_id`, `firstname`, `surname`, `contact`, `email`, `date_created`) VALUES
(1, 19, 'Kevin1', 'Santos', '09325785734', 'raybar1703@gmail.com', '2018-10-07');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE IF NOT EXISTS `uploads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) NOT NULL,
  `upload_time` varchar(255) NOT NULL,
  `property_id` int(11) NOT NULL,
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `file_name`, `upload_time`, `property_id`, `deleted`) VALUES
(19, 'lazada air bed.png', '2018-09-19 16:12:17', 16, 0),
(20, 'P_20180731_144230_p.jpg', '2018-09-19 16:13:19', 17, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
