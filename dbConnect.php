<?php
$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$db = "MODCOD";
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_errno);
}
