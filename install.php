<?php
mysql_query('CREATE TABLE `users` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`login` TEXT NOT NULL,
`password` TEXT NOT NULL ,
`mail` TEXT NOT NULL ,
`mode` INT NOT NULL ,
`hash` TEXT NOT NULL ,
`created` INT NOT NULL 
)');
?>