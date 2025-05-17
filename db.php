<?php
$host = "db"; // Service name from docker-compose
$username = "user";
$password = "pass";
$dbname = "student_db";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>