CREATE TABLE `states` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `country_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `states` (`id`, `name`, `country_id`) VALUES
(1, 'Madhya Pradesh', 1),
(2, 'Maharashtra', 1),
(3, 'Rajasthan', 1),
(4, 'Central', 2),
(5, 'Central Province', 2),
(6, 'Eastern Province', 2),
(7, 'Auckland', 3),
(8, 'Canterbury', 3),
(9, 'Gisborne', 3),
(10, 'Andalucia', 4),
(11, 'Canary Islands', 4),
(12, 'Madrid', 4),
(13, 'Bangkok', 5),
(14, 'Kanchanaburi', 5);