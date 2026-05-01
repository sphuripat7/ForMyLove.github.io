<?php
include('config.php'); 

// ดึงวันที่เริ่มคบกันจากฐานข้อมูล
$sql = "SELECT anniversary_date FROM settings LIMIT 1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$startDate = $row['anniversary_date']; // จะได้ค่า 2025-11-05
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Counting Our Love</title>
    <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css\stylemusic.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&family=Mali:wght@400&display=swap" rel="stylesheet">
</head>

<div class="counter-container menu-item animate-in delay-2">
    <div class="lace-top"></div>
    
    <div class="counter-header">
        <span class="heart">❤️</span>
        <h1 class="title-text">We've been in love for</h1>
        <span class="heart">❤️</span>
    </div>

    <!-- กล่องแสดงเวลา 4 กล่อง ตามเรฟ หน้าเค้าดาววัน.jpg -->
    <div class="time-grid">
        <div class="time-box">
            <span id="days" class="time-num">0</span>
            <span class="time-label">DAYS</span>
        </div>
        <div class="time-box">
            <span id="hours" class="time-num">0</span>
            <span class="time-label">HOURS</span>
        </div>
        <div class="time-box">
            <span id="minutes" class="time-num">0</span>
            <span class="time-label">MINUTES</span>
        </div>
        <div class="time-box">
            <span id="seconds" class="time-num">0</span>
            <span class="time-label">SECONDS</span>
        </div>
    </div>

    <p class="counting-footer">....นี่คือช่วงเวลาที่เราผ่านมาด้วยกัน 💕</p>

    <a href="main.php" class="back-link"> < back to menu </a>
    
    <div class="lace-bottom"></div>
</div>

<script>
    // รับค่าวันที่จาก PHP
    const startDate = new Date("<?php echo $startDate; ?>T00:00:00").getTime();

    function updateCounter() {
        const now = new Date().getTime();
        const diff = now - startDate;

        // คำนวณ วัน ชม. นาที วินาที
        const d = Math.floor(diff / (1000 * 60 * 60 * 24));
        const h = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        const s = Math.floor((diff % (1000 * 60)) / 1000);

        // แสดงผลลงในหน้าเว็บ
        document.getElementById("days").innerText = d;
        document.getElementById("hours").innerText = h;
        document.getElementById("minutes").innerText = m;
        document.getElementById("seconds").innerText = s;
    }

    // อัปเดตทุกๆ 1 วินาที
    setInterval(updateCounter, 1000);
    updateCounter(); // รันทันทีที่โหลดหน้า
</script>

</body>
</html>