CREATE TABLE `countries` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `countries` (`id`, `name`) VALUES
(1, 'India'),
(2, 'Sri Lanka'),
(3, 'New Zealand'),
(4, 'Spain'),
(5, 'Thailand');