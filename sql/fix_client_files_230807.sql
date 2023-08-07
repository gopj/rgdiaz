DROP TABLE IF EXISTS `files`;

CREATE TABLE `files` (
    `file_id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(250) NOT NULL,
    `type` varchar(100) NOT NULL,
    `parent_id` int(11) NOT NULL,
    `size` varchar(250) NOT NULL,
    `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21887 DEFAULT CHARSET=latin1;
LOCK TABLES `files` WRITE;
UNLOCK TABLES;