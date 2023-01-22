Database name: w1715148_0

Table Code:

CREATE TABLE `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb3_bin NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb3_bin NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb3_bin NOT NULL,
  `email` varchar(50) COLLATE utf8mb3_bin NOT NULL,
  `password` varchar(30) COLLATE utf8mb3_bin NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin
