<?php

$host = 'localhost';
$user = 'root';
$password = '12345';
$db_name = 'publishing_house';

session_start();

$link = mysqli_connect($host, $user, $password, $db_name);
mysqli_query($link, "SET NAMES 'utf8'");
