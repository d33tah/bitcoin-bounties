<?php

require("config.php");
mysql_connect($db_host,$db_login,$db_pass);
mysql_select_db($db_name);

mysql_query('CREATE TABLE `users` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`login` VARCHAR(30) NOT NULL UNIQUE,
`password` TEXT NOT NULL ,
`mail` VARCHAR(1000) NOT NULL UNIQUE ,
`mode` INT NOT NULL ,
`hash` VARCHAR(512) NOT NULL UNIQUE,
`created` INT NOT NULL 
)');

mysql_query('CREATE TABLE `bounties` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`title` TEXT NOT NULL ,
`user_id` INT NOT NULL ,
`description` TEXT NOT NULL ,
`bitcoins` INT NOT NULL,
`satoshi` INT NOT NULL,
`address` TEXT,
`state` INT NOT NULL
)');

mysql_query('CREATE TABLE `submissions` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`bounty_id` INT NOT NULL ,
`user_id` INT NOT NULL ,
`description` TEXT NOT NULL ,
`filename` TEXT NOT NULL
)');

mysql_query('CREATE TABLE `accounts` (
`bounty_id` INT NOT NULL ,
`user_id` INT NOT NULL ,
`address` TEXT 
)');

mysql_query('CREATE TABLE `votes` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
`commit_id` INT NOT NULL ,
`user_id` INT NOT NULL ,
`vote_time` INT NOT NULL
) ');

