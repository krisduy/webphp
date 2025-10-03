<?php

$sever = "sql103.infinityfree.com";
$username = "if0_40080644 ";
$password = "huyfood123";
$dbname = "if0_40080644_huyfood";

$conn =  mysqli_connect($sever, $username, $password, $dbname);

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}