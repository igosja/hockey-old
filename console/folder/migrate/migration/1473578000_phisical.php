<?php

$q = array();

$q[] = 'CREATE TABLE `phisical`
        (
            `phisical_id` INT(2) PRIMARY KEY AUTO_INCREMENT,
            `phisical_name` VARCHAR(255),
            `phisical_opposite` INT(2) DEFAULT 0,
            `phisical_value` INT(3) DEFAULT 0
        );';
$q[] = "INSERT INTO `phisical` (`phisical_name`, `phisical_opposite`, `phisical_value`)
        VALUES ('125%, падает', 1, 125),
               ('120%, падает', 20, 120),
               ('115%, падает', 19, 115),
               ('110%, падает', 18, 110),
               ('105%, падает', 17, 105),
               ('100%, падает', 16, 100),
               ('95%, падает', 15, 95),
               ('90%, падает', 14, 90),
               ('85%, падает', 13, 85),
               ('80%, падает', 12, 80),
               ('75%, растет', 11, 75),
               ('80%, растет', 10, 80),
               ('85%, растет', 9, 85),
               ('90%, растет', 8, 90),
               ('95%, растет', 7, 95),
               ('100%, растет', 6, 100),
               ('105%, растет', 5, 105),
               ('110%, растет', 4, 110),
               ('115%, растет', 3, 115),
               ('120%, растет', 2, 120);";