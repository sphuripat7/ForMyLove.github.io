<?php include('config.php');
$sql = "SELECT passcode FROM settings LIMIT 1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$correct_pass = $row['passcode']; // รหัสจะถูกดึงมาจากที่เรา INSERT ไว้ (051125)
 ?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unlock Our Memories</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css\stylemusic.css">
</head>
<body>

<div class="login-container menu-item animate-in delay-1">
    <div class="lock-photo-frame">
        <img src="img/lock_screen_photo.jpg" alt="Us" class="lock-photo"> <!-- อ้างอิงจากรูป กดเข้าไปใส่รหัส.jpg -->
    </div>

    <h2 class="login-title">Enter Password</h2>
    <p class="hint-text">hint : our anniversary (DDMMYY)</p>

    <!-- ช่องแสดงตัวเลขที่กด -->
    <div class="pass-display" id="display">_ _ _ _ _ _</div>

    <!-- แป้นพิมพ์ตัวเลข (Keypad) -->
    <div class="keypad menu-item animate-in delay-2">
        <button onclick="press('1')">1</button>
        <button onclick="press('2')">2</button>
        <button onclick="press('3')">3</button>
        <button onclick="press('4')">4</button>
        <button onclick="press('5')">5</button>
        <button onclick="press('6')">6</button>
        <button onclick="press('7')">7</button>
        <button onclick="press('8')">8</button>
        <button onclick="press('9')">9</button>
        <button class="btn-clear" onclick="clearPass()">Clear</button>
        <button onclick="press('0')">0</button>
        <button class="btn-enter" onclick="checkPass()">Enter</button>
    </div>
</div>

<script>
    let input = "";
    const correctPass = "<?php echo $correct_pass; ?>";

    function press(num) {
        if (input.length < 6) {
            input += num;
            document.getElementById('display').innerText = input;
        }
    }

    function clearPass() {
        input = "";
        document.getElementById('display').innerText = "_ _ _ _ _ _";
    }

    function checkPass() {
        if (input === correctPass) {
            window.location.href = "main.php"; // ถ้าถูกให้ไปหน้าเมนูหลัก
        } else {
            alert("รหัสไม่ถูกต้องนะ ลองใหม่อีกครั้งครับ ❤️");
            clearPass();
        }
    }
</script>

</body>
</html>