<?php

define ("DB_HOST", "localhost"); // set database host

define ("DB_USER", "root"); // set MySQL database user

define ("DB_PASS",""); // set MySQL database password

define ("DB_NAME","useraccountdb"); // set database name


// Connect to server
$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Couldn't make connection.");
// Select database
$db = mysql_select_db(DB_NAME, $link) or die("Couldn't select database");

?>
