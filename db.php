<?php
$host = "db"; // Docker service name
$username = "user";
$password = "pass";
$dbname = "student_db";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>


