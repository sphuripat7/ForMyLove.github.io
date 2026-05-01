<?php
include('config.php'); // ดึงไฟล์เชื่อมต่อฐานข้อมูลมาใช้

// ข้อมูลที่คุณต้องการใส่
$anniversary = "2025-11-05";
$pass = "051125";

// ล้างข้อมูลเก่าออกก่อน (เผื่อมีข้อมูลซ้ำ) และใส่ข้อมูลใหม่ลงไป
$sql_delete = "DELETE FROM settings";
$conn->query($sql_delete);

$sql_insert = "INSERT INTO settings (anniversary_date, passcode) VALUES ('$anniversary', '$pass')";

if ($conn->query($sql_insert) === TRUE) {
    echo "บันทึกข้อมูลเรียบร้อยแล้ว! <br>";
    echo "วันครบรอบ: " . $anniversary . "<br>";
    echo "รหัสผ่าน: " . $pass;
} else {
    echo "เกิดข้อผิดพลาด: " . $conn->error;
}

$conn->close();
?>