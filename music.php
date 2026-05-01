<?php
include('config.php'); 

// ดึงข้อมูลเพลงทั้งหมดจากตาราง music
$sql = "SELECT * FROM music ORDER BY id ASC"; 
$result = $conn->query($sql);

$songs = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $songs[] = $row;
    }
}

// ถ้าไม่มีเพลงใน DB ให้แสดงข้อความเตือน
if (empty($songs)) {
    die("กรุณาเพิ่มข้อมูลเพลงในฐานข้อมูลก่อนนะครับ");
}

$firstSong = $songs[0];
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>For Our Memories - Music</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css\stylemusic.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&family=Mali:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
     <div class="nav-header">
        <a href="main.php" class="back-btn">← Back</a>
        <h1 class="page-title ">Music</h1>
    </div>

<div class="music-page">
    <!-- 1. ปุ่มย้อนกลับ (ขึ้นลำดับแรก) -->
        <h1 class="page-title ">เพลงที่จี้กับภูชอบฟังไง</h1>
    <!-- 2. การ์ดเพลงหลัก (ขึ้นลำดับสอง) -->
    <div class="music-card-wrapper animate-in delay-2">
        <div class="music-cover">
            <img src="<?php echo $firstSong['cover_image']; ?>" id="mainCover" class="cover-img">
            <div class="song-details">
                <h2 id="mainTitle"><?php echo $firstSong['title']; ?></h2>
                <p id="mainArtist" class="dedication"><?php echo $firstSong['artist']; ?></p>
            </div>
        </div>

        <div class="player-controls">
            <div class="progress-area">
                <div class="progress-bar-inner" id="progressBar"></div>
            </div>
            <div class="buttons">
                <button class="play-pause" id="ctrlBtn">▶</button>
            </div>
            <audio id="loveSong">
                <source src="<?php echo $firstSong['file_path']; ?>" id="audioSource" type="audio/mpeg">
            </audio>
        </div>
    </div>

    <!-- 3. ส่วนเนื้อเพลง (ขึ้นลำดับสาม) -->
    <div class="lyrics-box animate-in delay-3">
        <div id="mainLyrics" class="lyrics-content">
            <?php echo nl2br($firstSong['lyrics']); ?>
        </div>
    </div>

    <!-- 4. รายการเพลง Playlist (ขึ้นลำดับสุดท้าย) -->
    <div class="playlist-container animate-in delay-4">
        <h3 class="playlist-title">Our Playlist 🎵</h3>
        <div class="playlist-items">
            <?php foreach($songs as $song): ?>
                <div class="playlist-item" onclick="changeSong(<?php echo htmlspecialchars(json_encode($song)); ?>)">
                    <img src="<?php echo $song['cover_image']; ?>" class="mini-cover">
                    <div class="mini-info">
                        <p class="mini-title"><?php echo $song['title']; ?></p>
                        <p class="mini-artist"><?php echo $song['artist']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
    const song = document.getElementById("loveSong");
    const ctrlBtn = document.getElementById("ctrlBtn");
    const progressBar = document.getElementById("progressBar");

    // เล่น/หยุดเพลง
    ctrlBtn.addEventListener("click", function() {
        if (song.paused) {
            song.play();
            ctrlBtn.innerText = "⏸";
        } else {
            song.pause();
            ctrlBtn.innerText = "▶";
        }
    });

    // อัปเดต Progress Bar
    song.addEventListener("timeupdate", function() {
        const progress = (song.currentTime / song.duration) * 100;
        progressBar.style.width = progress + "%";
    });

    // ฟังก์ชันเปลี่ยนเพลง
    function changeSong(songData) {
        const audioSource = document.getElementById("audioSource");
        const mainCover = document.getElementById("mainCover");
        const mainTitle = document.getElementById("mainTitle");
        const mainArtist = document.getElementById("mainArtist");
        const mainLyrics = document.getElementById("mainLyrics");

        audioSource.src = songData.file_path;
        mainCover.src = songData.cover_image;
        mainTitle.innerText = songData.title;
        mainArtist.innerText = songData.artist;
        mainLyrics.innerHTML = songData.lyrics.replace(/\n/g, "<br>");

        song.load();
        song.play();
        ctrlBtn.innerText = "⏸";
        
        // เลื่อนจอกลับไปข้างบนสุดเพื่อดูเนื้อเพลง
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
</script>

</body>
</html>