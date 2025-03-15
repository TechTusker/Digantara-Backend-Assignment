-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2025 at 09:49 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `db_algo`
--

CREATE TABLE `db_algo` (
  `algorithm` varchar(100) NOT NULL,
  `input` varchar(100) NOT NULL,
  `output` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `db_algo`
--

INSERT INTO `db_algo` (`algorithm`, `input`, `output`) VALUES
('Binary Search', '[9,8,7,6,5,4,3]', '5 Exists at index 4'),
('Binary Search', '[9,8,7,6,5,4,3]', '7 Exists at index 2'),
('Binary Search', '[9,8,7,6,5,4,3]', '2 Does not Exist'),
('Binary Search', '[9,8,7,6,5,4,3]', '3 Exists at index 6'),
('Binary Search', '[4,7,2,6,8,3,5]', '3 Exists at index 5'),
('Binary Search', '[4,7,2,6,8,3,5]', '7 Exists at index 1'),
('Quick Sort', '[9,8,7,6,5,4,3,2]', '[2,3,4,5,6,7,8,9]'),
('Quick Sort', '[1,2,3,4,5,6,7]', '[1,2,3,4,5,6,7]'),
('Quick Sort', '[5,4,6,8,2,1]', '[1,2,4,5,6,8]'),
('Quick Sort', '[5,4,5,8,5,5]', '[4,5,5,5,5,8]'),
('Quick Sort', '[5,7,4,6,9,8,3,4]', '[3,4,4,5,6,7,8,9]'),
('BFS', '[[1,2,3],[0],[0,4],[0],[2]]', '{\"bfs_result\":[0,1,2,3,4]}'),
('BFS', '[[1],[0],[3],[2]]', '{\"bfs_result\":[0,1]}'),
('BFS', '[[1],[0],[3],[2]]', '{\"bfs_result\":[[0,1],[2,3]]}'),
('BFS', '[[1,0],[0,2],[1,3],[2,3]]', '{\"bfs_result\":[[0,1,2,3]]}'),
('BFS', '{\"A\":[\"B\",\"C\",\"A\"],\"B\":[\"A\",\"D\"],\"C\":[\"A\",\"E\",\"C\"],\"D\":[\"B\"],\"E\":[\"C\"]}', '{\"bfs_result\":[[\"A\",\"B\",\"C\",\"D\",\"E\"]],\"self_loops\":[\"A\",\"C\"]}'),
('BFS', '{\"X\":[\"X\"],\"Y\":[\"Y\"]}', '{\"bfs_result\":[[\"X\"],[\"Y\"]],\"self_loops\":[\"X\",\"Y\"]}'),
('BFS', '[[1,0],[0,2],[1,3],[2,3]]', '{\"bfs_result\":[[0,1,2,3]],\"self_loops\":[0,3]}'),
('BFS', '[[1,2,3],[0],[0,4],[0],[2]]', '{\"bfs_result\":[[0,1,2,3,4]],\"self_loops\":[]}'),
('BFS', '[[1],[0],[3],[2]]', '{\"bfs_result\":[[0,1],[2,3]],\"self_loops\":[]}'),
('BFS', '[[1,0],[0,2],[1,3],[2,3]]', '{\"bfs_result\":[[0,1,2,3]],\"self_loops\":[0,3]}'),
('Binary Search', '[8,3,7,1,5]', '3 Exists at index 1'),
('Binary Search', '[8,3,7,1,5]', '9 Does not Exist'),
('Binary Search', '[8,3,7,1,5]', '5 Exists at index 4'),
('Binary Search', '[]', '5 Does not Exist');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
