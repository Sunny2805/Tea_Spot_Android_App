-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2020 at 12:21 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tea spot`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_id` int(10) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `Emailid` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_id`, `Name`, `Password`, `Emailid`) VALUES
(3, 'sanny', '123456789', 'sp.help37@gmail.com'),
(4, 'mayur', '12345', 'mayurchaudhary.precise@gmail.c');

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `Area_id` int(10) NOT NULL,
  `Area_Name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`Area_id`, `Area_Name`) VALUES
(1, 'Iscon Crossroad'),
(2, 'Pakwan Crossroad');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `Cart_id` int(10) NOT NULL,
  `User_id` int(10) NOT NULL,
  `Item_id` int(10) NOT NULL,
  `Qty` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`Cart_id`, `User_id`, `Item_id`, `Qty`) VALUES
(6, 1, 41, '1'),
(7, 1, 43, '2'),
(9, 2, 9, '5'),
(11, 3, 18, '2'),
(12, 3, 27, '1');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Category_id` int(10) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Category_id`, `Name`, `Photo`) VALUES
(16, 'Tea', 'photo/tea-back.jpg'),
(17, 'coffee', 'photo/Coffee-back.jpg'),
(19, 'Hot Beverages', 'photo/02.jpg'),
(20, 'Fruit Juices', 'photo/fruit-juice.jpg'),
(21, 'Fresh Shake', 'photo/fresh-shake-back.jpg'),
(22, 'Snacks', 'photo/snacks.png');

-- --------------------------------------------------------

--
-- Table structure for table `contract`
--

CREATE TABLE `contract` (
  `Contract_id` int(10) NOT NULL,
  `User_id` int(10) NOT NULL,
  `Office_Name` varchar(30) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Area_id` int(10) NOT NULL,
  `Start_Date` date NOT NULL,
  `Status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contract`
--

INSERT INTO `contract` (`Contract_id`, `User_id`, `Office_Name`, `Address`, `Area_id`, `Start_Date`, `Status`) VALUES
(5, 3, 'SPCT ', 'Underbridge', 1, '2020-03-29', 'Active'),
(6, 3, 'VPAT', 'Lal banglow ', 2, '2020-05-02', 'Deactive'),
(7, 3, 'jl', 'incomtec', 1, '2020-03-03', 'Active'),
(8, 3, 'Crystal acedemy', 'Nr. Incometex', 1, '2020-02-05', 'Active'),
(9, 3, '123 it solution ', 'Iscokn Cross Road Ahemdabad ', 1, '0000-00-00', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `contract_payment`
--

CREATE TABLE `contract_payment` (
  `Contract_Payment_id` int(10) NOT NULL,
  `Contract_id` int(10) NOT NULL,
  `Month` varchar(15) NOT NULL,
  `Payment` float NOT NULL,
  `Paymentdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contract_payment`
--

INSERT INTO `contract_payment` (`Contract_Payment_id`, `Contract_id`, `Month`, `Payment`, `Paymentdate`) VALUES
(1, 8, '2020-March', 200, '2020-03-05');

-- --------------------------------------------------------

--
-- Table structure for table `contract_transaction`
--

CREATE TABLE `contract_transaction` (
  `Contract_Transaction_id` int(10) NOT NULL,
  `Contract_id` int(10) NOT NULL,
  `Transaction_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contract_transaction`
--

INSERT INTO `contract_transaction` (`Contract_Transaction_id`, `Contract_id`, `Transaction_Date`) VALUES
(5, 3, '2020-02-29'),
(6, 3, '2020-03-01'),
(7, 3, '2020-04-01'),
(8, 3, '2020-02-11'),
(10, 8, '2020-03-04'),
(11, 8, '2020-03-04');

-- --------------------------------------------------------

--
-- Table structure for table `deliveryboy`
--

CREATE TABLE `deliveryboy` (
  `Deliveryboy_id` int(10) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Area_id` int(10) NOT NULL,
  `Phone` varchar(10) NOT NULL,
  `Photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deliveryboy`
--

INSERT INTO `deliveryboy` (`Deliveryboy_id`, `Name`, `Address`, `Area_id`, `Phone`, `Photo`) VALUES
(1, 'Raju ', 'Nava Vadaj ', 1, '7458961230', 'photo/man1.jpg'),
(2, 'Ravi ', 'baapunagar , india coloni ', 1, '7435986574', 'photo/man2.jpg'),
(3, 'Raj ', 'dhuma Gam , Bopal', 2, '9865327414', 'photo/man3.jpg'),
(4, 'Pintu', 'vastrapur', 2, '7927827627', 'photo/man4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `Feedback_id` int(10) NOT NULL,
  `User_id` int(10) NOT NULL,
  `Feedback` varchar(100) NOT NULL,
  `Rate` double NOT NULL,
  `Feedback_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`Feedback_id`, `User_id`, `Feedback`, `Rate`, `Feedback_Date`) VALUES
(1, 6, 'gghh', 1, '2020-01-09'),
(2, 6, 'hferyiut', 0.5, '2020-01-09'),
(3, 6, 'good service', 4.5, '2020-01-10'),
(4, 1, 'service. is too good', 5, '2020-01-10'),
(6, 1, 'Hello this is awesome ', 3, '2020-02-22'),
(7, 3, 'Nice service ', 5, '2020-02-22');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `Item_id` int(10) NOT NULL,
  `Item_Name` varchar(30) NOT NULL,
  `Price` varchar(5) NOT NULL,
  `Category_id` int(10) NOT NULL,
  `Description` varchar(300) NOT NULL,
  `Photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`Item_id`, `Item_Name`, `Price`, `Category_id`, `Description`, `Photo`) VALUES
(9, 'Ginger tea ', '25', 16, 'ginger is special tea . strong and special for office people famous tea in india .. mostly buyers buy this tea.tea is one of the favourite drink in the india  ', 'photo/ginger-tea.jpg'),
(12, 'Treditional Tea', '20', 16, 'famous tea in india .. mostly buyers buy this tea.tea is one of the favourite drink in the india  ', 'photo/treditionaltea.jpg'),
(13, 'Elaichi Tea', '25', 16, 'famous tea in india .. mostly buyers buy this tea.tea is one of the favourite drink in the india  ', 'photo/elaichi-tea.jpg'),
(14, 'Rajwadi Tea', '25', 16, 'famous tea in india .. mostly buyers buy this tea.tea is one of the favourite drink in the india  ', 'photo/rajwadi-tea.jpg'),
(15, 'Green Tea ', '30', 16, 'famous tea in india .. mostly buyers buy this tea.tea is one of the favourite drink in the india  ', 'photo/green-tea-in-a-cup.jpg'),
(16, 'Black Tea', '25', 16, 'famous tea in india .. mostly buyers buy this tea.tea is one of the favourite drink in the india  ', 'photo/black-tea.jpg'),
(17, 'Hot Lemon Tea ', '30', 16, 'famous tea in india .. mostly buyers buy this tea.tea is one of the favourite drink in the india  ', 'photo/lemon-tea.jpg'),
(18, 'Hot Coffee ', '30', 17, 'Hot coffee is mostly buy in our shop .. this is our best product in coffee list so must try .....', 'photo/hot-coffee.png'),
(21, 'Black Coffee', '25', 17, 'Black coffee is mostly buy in our shop .. this is our best product in coffee list so must try .....', 'photo/blackcoffee.jpg'),
(22, 'Cold Coffee', '50', 17, 'Cold coffee is mostly buy in our shop .. this is our best product in coffee list so must try .....', 'photo/cold_coffee.jpg'),
(23, 'Cold Coffee With Ice Cream', '70', 17, 'Cold coffee is mostly buy in our shop .. this is our best product in coffee list so must try .....', 'photo/cold-coffee-ice-cream.jpg'),
(24, 'Keser Milk', '50', 19, 'keser milk  is mostly buy in our shop .. this is our best product in beverages list so must try .....', 'photo/keser-milk.jpeg'),
(25, 'Bournvita Milk', '50', 19, 'Bournvita milk is mostly buy in our shop .. this is our best product in beverages list so must try .....', 'photo/bournvita-milk.jpg'),
(26, 'Chocolate Milk', '50', 19, 'chocolate milk is mostly buy in our shop .. this is our best product in beverages list so must try .....', 'photo/Chocolate-Milk.jpg'),
(27, 'Orange Juice', '40', 20, 'fresh juice in our shop must try it Orange Juice.', 'photo/orange-juice.jpg'),
(28, 'Apple Juice ', '50', 20, 'fresh juice in our shop must try it Apple Juice.', 'photo/apple-juice.jpg'),
(29, 'Lime Juice', '20', 20, 'fresh juice in our shop must try it Lime Juice.', 'photo/lime-juice.jpg'),
(30, 'Mango Juice', '50', 20, 'fresh juice in our shop must try it Mango Juice.', 'photo/mango-juice.jpg'),
(31, 'Pappaya juice', '40', 20, 'fresh juice in our shop must try it Pappaya Juice.', 'photo/fermented-papaya-juice.jpg'),
(32, 'Beetroot Juice', '45', 20, 'Beetroot Juice is fresh juice in our shop must try it Beetroot Juice.', 'photo/beetroot-juice.jpg'),
(33, 'Moosambi Juice', '40', 20, 'Moosambi juice is fresh juice in our shop must try it Moosambi Juice.', 'photo/Mosambi-Juice.jpg'),
(34, 'Pineapple Shake', '50', 21, 'pineapple shake is most favourite shake . 100% fresh and energetic shake ever . must try ', 'photo/pineapple-shake-min.jpg'),
(35, 'Apple Shake ', '50', 21, 'apple shake is most favourite shake . 100% fresh and energetic shake ever . must try ', 'photo/apple-shake.jpg'),
(36, 'Cheeku Shake', '50', 21, 'cheeku shake is most favourite shake . 100% fresh and energetic shake ever . must try ', 'photo/cheeku-shake.jpg'),
(37, 'Banana Shake', '50', 21, 'banana shake is most favourite shake . 100% fresh and energetic shake ever . must try ', 'photo/banana-shake.jpg'),
(38, 'Mango Shake', '60', 21, 'mango shake is most favourite shake . 100% fresh and energetic shake ever . must try ', 'photo/mango-shake.jpg'),
(39, 'Blue Mint Shake', '70', 21, 'blue mint shake is most favourite shake . 100% fresh and energetic shake ever . must try ', 'photo/blue-mint-shake.jpg'),
(40, 'Parle G ', '10', 22, 'Parle G 150+20 g extra free', 'photo/parleg.jpg'),
(41, 'Good Day - cashnew cookies', '10', 22, 'Britannia Good Day cookies', 'photo/good-day-biscuit-250x250.png'),
(42, 'Balaji salt Wafer', '10', 22, 'Balaji Salt wafer ', 'photo/balaji-salt.jpg'),
(43, 'Balaji Masala Wafer', '10', 22, 'Balaji Masala Masti Wafer ', 'photo/balaji-masala.jpg'),
(44, 'Balaji Farali Chevdo', '10', 22, 'Balaji Farali Chevdo ', 'photo/balaji-farali-chevdo-namkeen-60-gm-pouch-2.jpg'),
(45, 'Balaji Gathiya', '10', 22, 'Balaji Namkeen Gathiya', 'photo/balaji-namkeen-gathiya-70g.jpg'),
(46, 'Balaji kela Wefer', '10', 22, 'Balaji Namkeen Kela Wefer', 'photo/kela-wefer.jpg'),
(47, 'Oreo Biscuit', '10', 22, 'cadbury oreo cram biscuit', 'photo/oreo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `item_order`
--

CREATE TABLE `item_order` (
  `Item_Order_id` int(10) NOT NULL,
  `Contract_Transaction_id` int(10) NOT NULL,
  `Item_id` int(10) NOT NULL,
  `Qty` varchar(5) NOT NULL,
  `ordertime` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_order`
--

INSERT INTO `item_order` (`Item_Order_id`, `Contract_Transaction_id`, `Item_id`, `Qty`, `ordertime`) VALUES
(9, 7, 32, '10', 'Noon'),
(11, 5, 9, '2', 'Morning'),
(12, 9, 9, '3', 'Morning'),
(13, 9, 9, '3', 'Morning'),
(14, 10, 9, '3', 'Morning'),
(15, 10, 9, '5', 'Morning');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `Order_id` int(10) NOT NULL,
  `User_id` int(10) NOT NULL,
  `Order_date` datetime(6) NOT NULL,
  `Order_Status` varchar(10) NOT NULL,
  `Delivery_address` varchar(50) NOT NULL,
  `Deliveryboy_id` int(10) NOT NULL,
  `Paymentmode` varchar(10) NOT NULL,
  `Remark` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`Order_id`, `User_id`, `Order_date`, `Order_Status`, `Delivery_address`, `Deliveryboy_id`, `Paymentmode`, `Remark`) VALUES
(13, 2, '2020-02-22 05:24:50.000000', 'Delivered', 'Shop no: 220, iscon mall ,Iscon Crossroad', 1, 'Cash', 'Less suger '),
(14, 3, '2020-02-22 05:27:53.000000', 'Delivered', 'Hightower plaza, Behind pakwan thal, pakwan crossr', 3, 'Cash', ''),
(15, 3, '2020-03-02 09:08:51.000000', 'Delivered', 'jdjd,Iscon Crossroad', 1, 'Cash', 'jsjjd'),
(16, 3, '2020-03-02 09:37:19.000000', 'New', 'incomtex,Iscon Crossroad', 0, 'Cash', ''),
(17, 3, '2020-03-02 10:26:31.000000', 'New', 'hshehhd,Pakwan Crossroad', 0, 'Cash', 'hdjj'),
(50, 3, '2020-03-02 10:26:31.000000', 'New', 'hshehhd,Pakwan Crossroad', 0, 'Cash', 'hdjj'),
(51, 3, '2020-03-07 06:43:43.000000', 'New', 'Isckon mandir,Iscon Crossroad', 0, 'Cash', ''),
(52, 3, '2020-04-28 04:38:50.000000', 'New', '302, isckon plaza ,Iscon Crossroad', 0, 'Cash', 'Isckon mandir');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `Order_details_id` int(10) NOT NULL,
  `Order_id` int(10) NOT NULL,
  `Item_id` int(10) NOT NULL,
  `Qty` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`Order_details_id`, `Order_id`, `Item_id`, `Qty`) VALUES
(1, 1, 4, '2'),
(2, 3, 9, '1'),
(3, 4, 9, '6'),
(4, 4, 10, '1'),
(5, 5, 9, '3'),
(6, 6, 11, '3'),
(7, 7, 9, '1'),
(8, 8, 10, '2'),
(9, 8, 9, '2'),
(10, 9, 9, '1'),
(11, 10, 9, '1'),
(12, 11, 9, '2'),
(13, 12, 27, '2'),
(14, 13, 12, '1'),
(15, 14, 27, '1'),
(16, 14, 25, '1'),
(17, 14, 35, '1'),
(18, 14, 43, '1'),
(19, 15, 35, '4'),
(20, 16, 9, '2'),
(21, 17, 9, '3'),
(22, 24, 9, '1'),
(23, 51, 9, '2'),
(24, 52, 12, '2');

-- --------------------------------------------------------

--
-- Table structure for table `resetpassword`
--

CREATE TABLE `resetpassword` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_id` int(10) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Area_id` int(10) NOT NULL,
  `Phone_No` varchar(10) NOT NULL,
  `Email_id` varchar(50) NOT NULL,
  `Password` varchar(10) NOT NULL,
  `Reg_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_id`, `Name`, `Address`, `Area_id`, `Phone_No`, `Email_id`, `Password`, `Reg_Date`) VALUES
(2, 'mayur', 'pakwan crossroad', 2, '9785641230', 'mayurchaudhary.precise@gmail.com', 'mayur123', '2020-02-01'),
(3, 'Sanny', 'Gali no 203, Iscokn char rasta', 1, '7894561230', 'sanny@gmail.com', 'sanny', '2019-12-30');

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `Wallet_id` int(10) NOT NULL,
  `User_id` int(10) NOT NULL,
  `Balance` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transaction`
--

CREATE TABLE `wallet_transaction` (
  `Wallet_Transaction_id` int(10) NOT NULL,
  `User_id` int(10) NOT NULL,
  `Wallet_id` int(10) NOT NULL,
  `amount` varchar(10) NOT NULL,
  `transaction_type` varchar(10) NOT NULL,
  `transaction_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_id`);

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`Area_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`Cart_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Category_id`);

--
-- Indexes for table `contract`
--
ALTER TABLE `contract`
  ADD PRIMARY KEY (`Contract_id`);

--
-- Indexes for table `contract_payment`
--
ALTER TABLE `contract_payment`
  ADD PRIMARY KEY (`Contract_Payment_id`);

--
-- Indexes for table `contract_transaction`
--
ALTER TABLE `contract_transaction`
  ADD PRIMARY KEY (`Contract_Transaction_id`);

--
-- Indexes for table `deliveryboy`
--
ALTER TABLE `deliveryboy`
  ADD PRIMARY KEY (`Deliveryboy_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`Feedback_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`Item_id`);

--
-- Indexes for table `item_order`
--
ALTER TABLE `item_order`
  ADD PRIMARY KEY (`Item_Order_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`Order_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`Order_details_id`);

--
-- Indexes for table `resetpassword`
--
ALTER TABLE `resetpassword`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`Wallet_id`);

--
-- Indexes for table `wallet_transaction`
--
ALTER TABLE `wallet_transaction`
  ADD PRIMARY KEY (`Wallet_Transaction_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `Area_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `Cart_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Category_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `contract`
--
ALTER TABLE `contract`
  MODIFY `Contract_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `contract_payment`
--
ALTER TABLE `contract_payment`
  MODIFY `Contract_Payment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contract_transaction`
--
ALTER TABLE `contract_transaction`
  MODIFY `Contract_Transaction_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `deliveryboy`
--
ALTER TABLE `deliveryboy`
  MODIFY `Deliveryboy_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `Feedback_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `Item_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `item_order`
--
ALTER TABLE `item_order`
  MODIFY `Item_Order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `Order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `Order_details_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `resetpassword`
--
ALTER TABLE `resetpassword`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `Wallet_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallet_transaction`
--
ALTER TABLE `wallet_transaction`
  MODIFY `Wallet_Transaction_id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
