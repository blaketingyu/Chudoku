-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2017 at 05:38 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chudoku.com`
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
  `creditCardID` varchar(255) NOT NULL,
  `CVV` varchar(255) NOT NULL,
  `creditCardType` text NOT NULL,
  `cardExpiryDate` char(7) NOT NULL,
  `customerID` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billinginfo`
--

INSERT INTO `billinginfo` (`address`, `city`, `state`, `country`, `postalCode`, `phone`, `creditCardID`, `CVV`, `creditCardType`, `cardExpiryDate`, `customerID`) VALUES
('Tampines Avenue 7 Blk 396 #02-556', 'Singapore', 'Singapore', 'Singapore', '520396', '91234567', '5500000000000005', '512', 'Mastercard', '2017-12', '6123');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerID` char(5) NOT NULL,
  `NRIC` varchar(255) NOT NULL,
  `firstName` varchar(35) NOT NULL,
  `lastName` varchar(35) NOT NULL,
  `email` varchar(64) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerID`, `NRIC`, `firstName`, `lastName`, `email`, `username`, `password`, `type`) VALUES
('6123', 's9800001a', 'Dick', 'Tan', 'Dicktan13@gmail.com', 'Dick13', 'Dicktan13', 'customer'),
('9000', 'S910000A', 'Peng', 'Win', 'penguin@gmail.com', 'adminpengwin', 'likeTT91', 'admin');

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
('5123', '1003');

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
('5123', '2017-01-03', '2017-01-04', '2017-01-05', 'Shipping On Delivery', '6123');

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
('4123', 'Nets', '9.99', '2017-01-01', 'Shipping on Delivery', '5123');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productID` int(4) NOT NULL,
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
(1001, 'Eren Jaeger Costume (Attack on Titan) ', '-Jacket, shirt, cape, scarf: 100% polyester; pants, sash: 83% polyester, 17% spandex; harness, belt: 100% PVC\r\n-Pullover shirt has laced V-placket\r\n-Slim-fit stretch pants have elastic waistband\r\n-Cropped twill jacket has gold-tone buttons, embroidered patches on back, sleeves & left breast pocket\r\n-Hooded cape has embroidered patch on back, button fastener at neck\r\n-Harness is PVC faux leather with metal buckles\r\n-Sash has elastic waistband, ruching at each side seam', '99.99', '5', '/chudoku.com/store/apparel/erenjaeger.jpg', 'Anime Apparels Pte Ltd', 'Apparel'),
(1002, 'Mikasa Ackerman Costume (Attack on Titan)', '-Jacket, shirt, cape, scarf: 100% polyester; pants, sash: 83% polyester, 17% spandex; harness, belt: 100% PVC\r\n-Basic white shirt has wing collar, buttons at front & sleeve cuffs\r\n-Slim-fit stretch pants have smooth waistband\r\n-Cropped twill jacket has gold-tone buttons, embroidered patches on back, sleeves & left breast pocket\r\n-Hooded cape has embroidered patch on back, button fastener at neck\r\n-Harness is PVC faux leather with metal buckles\r\n-Sash has elastic waistband, ruching at each side seam\r\n-Fleece scarf has fringed ends', '99.99', '10', '/chudoku.com/store/apparel/mikasa.jpg', 'Anime Apparel Pte Ltd', 'Apparel'),
(1003, 'Survey Corp Hoodie (Attack on Titan)', ' Official Attack On Titan Hoodie\r\n\r\n-100% Cotton\r\n-Officially Licensed\r\n-50% Cotton/50% Polyester\r\n-Machine washable', '40.99', '5', '/chudoku.com/store/apparel/hoodie.jpg', 'Anime Apparel Pte Ltd', 'Apparel'),
(2001, 'Mewtwo Mayhem Theme Deck (Pokemon)', '\r\n\r\nThe Mewtwo Mayhem Theme Deck from the Evolutions expansion of the Pokémon Trading Card Game focuses on Psychic and Fighting type Pokémon.\r\n\r\nLike other Theme Decks, Mewtwo Mayhem includes damage counters, a custom coin, one two-player mat, a Mewtwo deckbox and a TCGO deck access code.\r\n\r\nLet It Rip! Mewtwo is ready to dish out the chaos! With Hitmonchan and Onix delivering quick hits, this deck clobbers both body and mind. You''ll be right in the thick of the action!\r\n', '12.99', '10', '/chudoku.com/store/cards/mewtwo.jpg', 'Pokemon', 'Cards'),
(2002, 'Pikachu Power Theme Deck (Pokemon)', '\r\n\r\nThe Pikachu Power Theme Deck from the Evolutions expansion of the Pokémon Trading Card Game predominantly focuses on Lightning and Grass type Pokémon.\r\n\r\nLike other Theme Decks, Pikachu Power includes damage counters, a custom coin, one two-player mat, a Pikachu deckbox and a TCGO deck access code.\r\n\r\nEveryone''s Favorite Dynamo! Charge up your game with the little thunderbolt that never gives up: Pikachu! Add the electrifying power of Raichu and the supercharged voltage of Electabuzz, and you''ll have a potent team against any foe!\r\n', '12.99', '10', '/chudoku.com/store/cards/pikachu.jpg', 'Pokemon', 'Cards'),
(2003, 'Starter Deck Yuya (Yu-Gi-Oh)', 'Starter Deck: Yuya is a Starter Deck in the Yu-Gi-Oh! Trading Card Game (TCG). It is the eleventh Deck in the TCG''s annual Starter Deck series (twenty-first overall), following Saber Force Starter Deck and Dark Legion Starter Deck. This Deck is the TCG equivalent of Starter Deck 2016 in the OCG.\r\n\r\nYuya is a pre-constructed Deck right out of the box, making it the perfect way for new Duelists to be introduced to the Yu-Gi-Oh! TRADING CARD GAME. With 10 brand-new cards like Performapal Sleight Hand Magician and a new Performapal themed Deck, Starter Deck – Yuya is an exciting Deck to own for all Duelists!\r\n\r\nEach Starter Deck – Yuya contains:\r\n35 Commons\r\n3 Super Rares\r\n2 Ultra Rares\r\n3 Token Cards', '9.99', '10', '/chudoku.com/store/cards/yu-gi-oh.png', 'Yu-Gi-Oh', 'Cards'),
(2004, 'G-Trial Deck 1 (Cardfight Vanguard)', '\r\n\r\nIntroducing a brand new clan Gear Chronicle which features powerful units with abilities that will overwhelm your opponent!\r\n\r\nThis pre-constructed Trial Deck can be used out of the box and comes with exclusive Trial Deck only cards which will delight new and veteran players alike!\r\n\r\n1 pre-constructed trial deck contains 52 pre-set cards:\r\n1 display contains 6 decks\r\n19 types of cards (All Trial deck exclusives, inclusive of 4 holo cards)\r\nStarter’s Guide and Playmat are included.\r\nThe following PR cards are allocated to VGE-G-TD01 Trial Decks: PR/0163EN True Ultimate Dimensional Robo, Great Daikaiser PR/0164EN Amon’s Leader, Astaroth\r\n', '19.99', '10', '/chudoku.com/store/cards/vanguard.png', 'Cardfight Vanguard', 'Cards'),
(3001, 'Saitama (One Punch Man)', 'I`m just a guy who enjoys being a hero as a hobby\r\n\r\nFrom the anime series `One Punch Man` comes a figma of the average guy whose hobby is being a hero - Saitama!\r\nUsing the smooth yet posable joints of figma, you can act out a variety of different scenes.\r\nHe comes with two expressions including his standard face as well as a serious expression for battle scenes.\r\n\r\n\r\nSculptor: monolith\r\nPaintwork: monolith\r\nCooperation: Masaki Apsy', '43.99', '5', '/chudoku.com/Store/figurines/onepunch.jpg', 'Banpresto Co., Ltd.', 'Figurines'),
(3002, 'Whitebeard (One Piece)', 'Copyright Eiichiro Oda Shueisha Fuji TV Toei Animation\r\nHeight: approx 240mm.\r\n- The Variable Action Heroes `White Beard` Edward Newgate is to the appearance.\r\n- Three-dimensional large-force size of Height about 240mm in the best part of the volume.\r\n', '154.99', '10', '/chudoku.com/store/figurines/whitebeard.jpg', 'Megahouse', 'Figurines'),
(3003, 'Shanks (One Piece)', 'Copyright Eiichiro Oda Shueisha Fuji TV Toei Animation\r\nHeight: approx 250mm.\r\n\r\n- `Committed straw hat, which he inherited from the Pirate King` Russia jar to Luffy, a large presence of invited to the sea.\r\n- The appearance of Shanks became a presence that greatly moved the story, such as to terminate the top war of Marine Ford, and three-dimensional reproduced image as in the color and high-quality modeling.\r\n', '104.99', '10', '/chudoku.com/store/figurines/shanks.jpg', 'Megahouse', 'Figurines');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billinginfo`
--
ALTER TABLE `billinginfo`
  ADD KEY `customerID` (`customerID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD KEY `productID` (`productID`),
  ADD KEY `orderID` (`orderID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `customerID` (`customerID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentID`),
  ADD KEY `orderID` (`orderID`),
  ADD KEY `orderID_2` (`orderID`),
  ADD KEY `orderID_3` (`orderID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3004;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
