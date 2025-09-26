<?php
// Chỉ khai báo Connect 1 lần
if (!function_exists('Connect')) {
    function Connect() {
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $dbname = "huyfood";

        $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }
}
?>
