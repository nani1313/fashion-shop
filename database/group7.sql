-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2024 at 09:40 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `group7`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `customer` varchar(255) NOT NULL,
  `order_date` date NOT NULL,
  `total_order_amount` decimal(10,2) NOT NULL,
  `order_status` enum('Preparing','Shipping','Done','Cancel') NOT NULL,
  `payment_date` date NOT NULL,
  `payment_amount` decimal(10,3) NOT NULL,
  `payment_method` enum('Cash','Debit/Credit Card') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_order`, `customer`, `order_date`, `total_order_amount`, `order_status`, `payment_date`, `payment_amount`, `payment_method`) VALUES
(1, 'Minh', '2024-06-03', 3.00, 'Preparing', '2024-06-03', 2000.000, 'Debit/Credit Card'),
(3, 'Minh', '2024-06-05', 1.00, 'Preparing', '2024-06-05', 999.000, 'Cash'),
(4, 'Linh', '2024-06-05', 2.00, 'Preparing', '2024-06-05', 729.000, 'Cash'),
(5, 'Thao', '2024-06-05', 1.00, 'Preparing', '2024-06-05', 999.000, 'Debit/Credit Card'),
(6, 'Thao', '2024-06-05', 1.00, 'Preparing', '2024-06-05', 949.000, 'Debit/Credit Card'),
(7, 'Thao', '2024-06-05', 1.00, 'Preparing', '2024-06-05', 649.000, 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id_product` int(11) NOT NULL,
  `product_name` text NOT NULL,
  `product_description` text NOT NULL,
  `product_price` text NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_category` enum('Woman','Man','Kid','Accessories') NOT NULL,
  `stock_quantity` int(11) NOT NULL,
  `product_status` enum('Available','Unavailable') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_product`, `product_name`, `product_description`, `product_price`, `product_image`, `product_category`, `stock_quantity`, `product_status`) VALUES
(1, 'CONTRAST SATIN BLAZER', 'Blazer with a matching satin lapel collar and long sleeves with shoulder pads. Fitted waist. Front flap pockets. Front button fastening.', '999.000', '../img/02291595800-015-p.jpg', 'Woman', 55, 'Unavailable'),
(2, 'CONTRAST SATIN BUSTIER', 'Bustier with a straight neckline and exposed shoulders. Front satin flaps. Front fastening with covered satin buttons.', '1.599.000', '../img/product1.jpg', 'Woman', 30, 'Available'),
(6, 'TAILORED DOUBLE-BREASTED BLAZER', 'Blazer with a lapel collar and long sleeves with pronounced shoulders. Front flap pockets. Double-breasted golden button fastening.', '1.999.000', '../img/product2.jpg', 'Woman', 20, 'Available'),
(7, 'FADED KNIT T-SHIRT', 'Cropped fit sleeveless knit T-shirt made of spun cotton. Featuring a round neck. Contrast slogan print on the front. Faded effect.', '999.000', '../img/product3.jpg', 'Man', 20, 'Unavailable'),
(8, 'TEXTURED POLO SHIRT', 'Regular fit collared polo shirt with front opening. Short sleeves.', '799.000', '../img/product4.jpg', 'Man', 10, 'Available'),
(9, 'ZIP-UP POLO DRESS', 'Sleeveless dress with a polo collar. Featuring a zip fastening on the chest and a raised slogan print on the front.', '729.000', '../img/product5.jpg', 'Kid', 60, 'Available'),
(10, 'TEXTURED WRAP DRESS', 'Sleeveless V-neck dress featuring a crossover detail on the chest and a buttoned teardrop opening at the back.', '999.000', '../img/product6.jpg', 'Kid', 35, 'Unavailable'),
(11, 'PRINTED CANVAS BAG', 'Shopper bag made of 100% spun cotton. Contrast print detail. Shoulder straps and handles in the same fabric. Inside pocket', '999.000', '../img/product7.jpg', 'Accessories', 15, 'Available'),
(12, 'TWILL CAP WITH SLOGAN', 'Peak cap made of 100% cotton. Contrast embroidery slogan on the front. Adjustable at the back.', '649.000', '../img/product8.jpg', 'Accessories', 45, 'Unavailable');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` text DEFAULT 'not null',
  `username` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','member') NOT NULL DEFAULT 'member',
  `phone_number` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `username`, `password`, `role`, `phone_number`, `email`) VALUES
(1, 'admin', 'admin', 'admin123', 'admin', '012345678', 'admin@gmail.com'),
(4, 'Tuan Minh', 'Minh', 'Minh123', 'member', '02147483647', 'Minh@gmail.com'),
(6, 'Phuong Thao', 'Thao', 'Thao123', 'member', '0982711631', 'thao@gmail.com'),
(7, 'Dieu Linh', 'Linh', '1234', 'member', '0123345677', 'Dieulinh@gmail.com'),
(10, 'Duc Hung', 'Hung', '1234', 'member', '0987654432', 'hung@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
