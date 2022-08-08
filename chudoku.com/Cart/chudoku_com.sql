-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2017 at 04:17 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `swap`
--

-- --------------------------------------------------------

--
-- Table structure for table `billinginfo`
--

CREATE TABLE `billinginfo` (
  `address` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `country` text NOT NULL,
  `postalCode` varchar(10) NOT NULL,
  `phone` char(15) NOT NULL,
  `creditCardID` char(19) NOT NULL,
  `CVV` char(4) NOT NULL,
  `creditCardType` text NOT NULL,
  `cardExpiryDate` date NOT NULL,
  `customerID` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billinginfo`
--

INSERT INTO `billinginfo` (`address`, `city`, `state`, `country`, `postalCode`, `phone`, `creditCardID`, `CVV`, `creditCardType`, `cardExpiryDate`, `customerID`) VALUES
('', '', '', '', '', '', '', '', '', '0000-00-00', ''),
('Tampines Avenue 7\r\nBlk 396 #02-555', 'Singapore', 'Singapore', 'Singapore', '520555', '91234567', '5500 0000 0000 0004', '456', 'MasterCard', '2017-12-03', 'C123');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerID` char(5) NOT NULL,
  `NRIC` char(9) NOT NULL,
  `firstName` text NOT NULL,
  `lastName` text NOT NULL,
  `email` varchar(64) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(10) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerID`, `NRIC`, `firstName`, `lastName`, `email`, `username`, `password`, `type`) VALUES
('C123', 's9800001a', 'Dick', 'Tan', 'dicktan13@gmail.com', 'Dicktan13', 'DickTan13', 'customer'),
('C234', 's9800002b', 'Jet', 'Lim', 'jetlim@gmail.com', 'JetLim', 'Abc12345', 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `orderID` char(4) NOT NULL,
  `productID` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`orderID`, `productID`) VALUES
('O123', 'P123');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` char(4) NOT NULL,
  `orderDate` date NOT NULL,
  `shipDate` date NOT NULL,
  `timestamp` date NOT NULL,
  `deliveryStatus` text NOT NULL,
  `customerID` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `orderDate`, `shipDate`, `timestamp`, `deliveryStatus`, `customerID`) VALUES
('O123', '2017-01-03', '2017-01-04', '2017-01-05', 'Shipping On Delivery', 'C123');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentID` char(4) NOT NULL,
  `paymentType` text NOT NULL,
  `totalPrice` decimal(3,2) NOT NULL,
  `paymentDate` date NOT NULL,
  `transactionStatus` text NOT NULL,
  `orderID` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentID`, `paymentType`, `totalPrice`, `paymentDate`, `transactionStatus`, `orderID`) VALUES
('P123', 'Nets', '9.99', '2017-01-01', 'Shipping on Delivery', 'O123');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productID` char(4) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `productDescription` text NOT NULL,
  `unitsPrice` decimal(5,2) NOT NULL,
  `unitsInStore` varchar(3) NOT NULL,
  `Picture` text NOT NULL,
  `Supplier` text NOT NULL,
  `Category` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productID`, `productName`, `productDescription`, `unitsPrice`, `unitsInStore`, `Picture`, `Supplier`, `Category`) VALUES
('A001', 'Eren Jaeger Costume (Attack on Titan) ', '-Jacket, shirt, cape, scarf: 100% polyester; pants, sash: 83% polyester, 17% spandex; harness, belt: 100% PVC\r\n-Pullover shirt has laced V-placket\r\n-Slim-fit stretch pants have elastic waistband\r\n-Cropped twill jacket has gold-tone buttons, embroidered patches on back, sleeves & left breast pocket\r\n-Hooded cape has embroidered patch on back, button fastener at neck\r\n-Harness is PVC faux leather with metal buckles\r\n-Sash has elastic waistband, ruching at each side seam', '99.99', '5', 'C://xampp/htdocs/chudoku.com/store/apparel/Products/eren/eren.php"', 'Anime Apparels Pte Ltd', 'Apparel'),
('A002', 'Mikasa Ackerman Costume (Attack on Titan)', '-Jacket, shirt, cape, scarf: 100% polyester; pants, sash: 83% polyester, 17% spandex; harness, belt: 100% PVC\r\n-Basic white shirt has wing collar, buttons at front & sleeve cuffs\r\n-Slim-fit stretch pants have smooth waistband\r\n-Cropped twill jacket has gold-tone buttons, embroidered patches on back, sleeves & left breast pocket\r\n-Hooded cape has embroidered patch on back, button fastener at neck\r\n-Harness is PVC faux leather with metal buckles\r\n-Sash has elastic waistband, ruching at each side seam\r\n-Fleece scarf has fringed ends', '99.99', '10', 'C://xampp/htdocs/chudoku.com/store/apparel/Products/mikasa/mikasa.php"', 'Anime Apparel Pte Ltd', 'Apparel'),
('A003', 'Survey Corp Hoodie (Attack on Titan)', ' Official Attack On Titan Hoodie\r\n\r\n-100% Cotton\r\n-Officially Licensed\r\n-50% Cotton/50% Polyester\r\n-Machine washable', '40.99', '5', 'C://xampp/htdocs/chudoku.com/store/apparel/Products/hoodie/hoodie.php"', 'Anime Apparel Pte Ltd', 'Apparel'),
('C001', 'Mewtwo Mayhem Theme Deck (Pokemon)', '\r\n\r\nThe Mewtwo Mayhem Theme Deck from the Evolutions expansion of the Pokémon Trading Card Game focuses on Psychic and Fighting type Pokémon.\r\n\r\nLike other Theme Decks, Mewtwo Mayhem includes damage counters, a custom coin, one two-player mat, a Mewtwo deckbox and a TCGO deck access code.\r\n\r\nLet It Rip! Mewtwo is ready to dish out the chaos! With Hitmonchan and Onix delivering quick hits, this deck clobbers both body and mind. You''ll be right in the thick of the action!\r\n', '12.99', '10', 'C://xampp/htdocs/chudoku.com/store/cards/Products/mewtwo/mewtwo.php"', 'Pokemon', 'Cards'),
('C002', 'Pikachu Power Theme Deck (Pokemon)', '\r\n\r\nThe Pikachu Power Theme Deck from the Evolutions expansion of the Pokémon Trading Card Game predominantly focuses on Lightning and Grass type Pokémon.\r\n\r\nLike other Theme Decks, Pikachu Power includes damage counters, a custom coin, one two-player mat, a Pikachu deckbox and a TCGO deck access code.\r\n\r\nEveryone''s Favorite Dynamo! Charge up your game with the little thunderbolt that never gives up: Pikachu! Add the electrifying power of Raichu and the supercharged voltage of Electabuzz, and you''ll have a potent team against any foe!\r\n', '12.99', '10', 'C://xampp/htdocs/chudoku.com/store/cards/Products/pikachu/pikachu.php"', 'Pokemon', 'Cards'),
('C003', 'Yu-Gi-Oh Starter Deck Yuya (Yu-Gi-Oh)', 'Starter Deck: Yuya is a Starter Deck in the Yu-Gi-Oh! Trading Card Game (TCG). It is the eleventh Deck in the TCG''s annual Starter Deck series (twenty-first overall), following Saber Force Starter Deck and Dark Legion Starter Deck. This Deck is the TCG equivalent of Starter Deck 2016 in the OCG.\r\n\r\nYuya is a pre-constructed Deck right out of the box, making it the perfect way for new Duelists to be introduced to the Yu-Gi-Oh! TRADING CARD GAME. With 10 brand-new cards like Performapal Sleight Hand Magician and a new Performapal themed Deck, Starter Deck – Yuya is an exciting Deck to own for all Duelists!\r\n\r\nEach Starter Deck – Yuya contains:\r\n35 Commons\r\n3 Super Rares\r\n2 Ultra Rares\r\n3 Token Cards', '9.99', '10', 'C://xampp/htdocs/chudoku.com/store/cards/Products/yugioh/yugioh.php"', 'Yu-Gi-Oh', 'Cards'),
('C004', 'G Trial Deck 1: Awakening of\r\nthe Interdimensional Dragon (Cardfight Vanguard)', '\r\n\r\nIntroducing a brand new clan Gear Chronicle which features powerful units with abilities that will overwhelm your opponent!\r\n\r\nThis pre-constructed Trial Deck can be used out of the box and comes with exclusive Trial Deck only cards which will delight new and veteran players alike!\r\n\r\n1 pre-constructed trial deck contains 52 pre-set cards:\r\n1 display contains 6 decks\r\n19 types of cards (All Trial deck exclusives, inclusive of 4 holo cards)\r\nStarter’s Guide and Playmat are included.\r\nThe following PR cards are allocated to VGE-G-TD01 Trial Decks: PR/0163EN True Ultimate Dimensional Robo, Great Daikaiser PR/0164EN Amon’s Leader, Astaroth\r\n', '19.99', '10', 'C://xampp/htdocs/chudoku.com/store/cards/Products/vanguard/vanguard.php"', 'Cardfight Vanguard', 'Cards'),
('F001', 'Figurine Saitama (One Punch Man)', 'I`m just a guy who enjoys being a hero as a hobby\r\n\r\nFrom the anime series `One Punch Man` comes a figma of the average guy whose hobby is being a hero - Saitama!\r\nUsing the smooth yet posable joints of figma, you can act out a variety of different scenes.\r\nHe comes with two expressions including his standard face as well as a serious expression for battle scenes.\r\n\r\n\r\nSculptor: monolith\r\nPaintwork: monolith\r\nCooperation: Masaki Apsy', '43.99', '5', 'C://xampp/htdocs/chudoku.com/store/figurine/Products/onepunchman/onepunchman.php', 'Banpresto Co., Ltd.', 'Figurines'),
('F002', 'Figure Edward Newgate (One Piece)', 'Copyright Eiichiro Oda Shueisha Fuji TV Toei Animation\r\nHeight: approx 240mm.\r\n- The Variable Action Heroes `White Beard` Edward Newgate is to the appearance.\r\n- Three-dimensional large-force size of Height about 240mm in the best part of the volume.\r\n', '154.99', '10', 'C://xampp/htdocs/chudoku.com/store/figurine/Products/whitebeard/whitebeard.php', 'Megahouse', 'Figurines'),
('F003', 'Shanks (One Piece)', 'Copyright Eiichiro Oda Shueisha Fuji TV Toei Animation\r\nHeight: approx 250mm.\r\n\r\n- `Committed straw hat, which he inherited from the Pirate King` Russia jar to Luffy, a large presence of invited to the sea.\r\n- The appearance of Shanks became a presence that greatly moved the story, such as to terminate the top war of Marine Ford, and three-dimensional reproduced image as in the color and high-quality modeling.\r\n', '104.99', '10', 'C://xampp/htdocs/chudoku.com/store/figurine/Products/shanks/shanks.php', 'Megahouse', 'Figurines');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
