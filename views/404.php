<?php
ob_end_clean();//TODO: I heard there might be some issues with gzip compression
header("HTTP/1.0 404 Not Found"); //TODO: always 1.0?
die("Sorry, the address you requested was not found.");