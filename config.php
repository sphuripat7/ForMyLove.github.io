<?php
$host = "localhost";
$user = "root"; // ตามค่าเริ่มต้นของ XAMPP/WAMP
$pass = "";     // ตามค่าเริ่มต้น
$dbname = "For_My_Love";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ตั้งค่าภาษาไทยให้แสดงผลถูกต้อง
$conn->set_charset("utf8mb4");
?>