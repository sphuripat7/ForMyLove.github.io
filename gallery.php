<?php
include('config.php'); 

// 1. ดึงข้อมูลรูปภาพทั้งหมด เรียงจากใหม่ไปเก่า
$sql = "SELECT * FROM gallery ORDER BY created_at DESC";
$result = $conn->query($sql);

// 2. จัดกลุ่มรูปภาพตาม Caption (หัวข้อทริป)
$memory_groups = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $memory_groups[$row['caption']][] = $row['image_path'];
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Memories - Gallery</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css\stylemusic.css">
    <!-- ใช้ Font Mali เพื่อความน่ารัก -->
    <link href="https://fonts.googleapis.com/css2?family=Mali:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>

<div class="gallery-page menu-item animate-in delay-1">
    <!-- ส่วนหัวหน้าเว็บ -->
    <div class="nav-header">
        <a href="main.php" class="back-btn">← Back</a>
        <h1 class="page-title ">Gallery</h1>
    </div>

    <div class="memory-container ">
        <?php if (!empty($memory_groups)): ?>
            <?php foreach($memory_groups as $caption => $images): ?>
                <div class="memory-set ">
                    <!-- หัวข้อ (Caption) อยู่ด้านบน -->
                    <h3 class="memory-caption"><?php echo htmlspecialchars($caption); ?></h3>
                    
                    <!-- ส่วนเลื่อนรูปแนวนอน -->
                    <div class="horizontal-scroll">
                        <?php foreach($images as $img_path): ?>
                            <?php 
                                // เช็คว่ามีไฟล์รูปอยู่จริงไหมก่อนแสดงผลเพื่อกันรูปแตก
                                if (file_exists($img_path)): 
                            ?>
                                <div class="image-card">
                                    <img src="<?php echo $img_path; ?>" alt="Memory" loading="lazy">
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-data">
                <p>ยังไม่มีรูปภาพในความทรงจำเลย ❤️</p>
                <p style="font-size: 0.8rem; color: #aaa;">(ลองรัน SQL Insert ข้อมูลดูนะ)</p>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>