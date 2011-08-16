<?php

require("config.php");
mysql_connect($db_host,$db_login,$db_pass);
mysql_select_db($db_name);

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