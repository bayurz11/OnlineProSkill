<div class="lesson__video-wrap">
    <div class="lesson__video-wrap-top">
        <div class="lesson__video-wrap-top-left">
            <a href="#"><i class="flaticon-arrow-right"></i></a>
            <span id="video-title">Choose a lesson</span>
        </div>
        <div class="lesson__video-wrap-top-right">
            <a href="#"><i class="fas fa-times"></i></a>
        </div>
    </div>

    <div id="video-container">
        <video id="player" playsinline controls data-poster="assets/img/bg/video_bg.webp">
            <source id="video-source" src="" type="video/mp4" />
            <source src="/path/to/video.webm" type="video/webm" />
        </video>
        <iframe id="video-iframe" style="display:none" width="560" height="315" frameborder="0"
            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>

    <div class="lesson__next-prev-button">
        <button class="prev-button" title="Previous Lesson"><i class="flaticon-arrow-right"></i></button>
        <button class="next-button" title="Next Lesson"><i class="flaticon-arrow-right"></i></button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Ambil semua item kursus
        const courseItems = document.querySelectorAll('.course-item');

        let currentIndex = 0; // Variabel untuk menyimpan indeks kursus yang sedang diputar

        // Fungsi untuk memperbarui video berdasarkan indeks
        function updateVideo(index) {
            if (index >= 0 && index < courseItems.length) {
                const item = courseItems[index];
                const filePath = item.getAttribute('data-file-path');
                const videoTitle = item.querySelector('.item-name').innerText;

                // Perbarui judul video
                document.getElementById('video-title').innerText = videoTitle;

                // Cek tipe file (YouTube atau Google Drive atau lainnya)
                let fileSrc = '';
                const youtubeRegex =
                    /(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/;
                const driveRegex =
                    /(?:drive\.google\.com\/file\/d\/|drive\.google\.com\/open\?id=|docs.google\.com\/(?:presentation|document|spreadsheets)\/d\/)([^"&?\/\s]+)/;

                const youtubeMatch = filePath.match(youtubeRegex);
                const driveMatch = filePath.match(driveRegex);

                if (youtubeMatch) {
                    const youtubeId = youtubeMatch[1];
                    fileSrc = 'https://www.youtube.com/embed/' + youtubeId;
                    // Menyembunyikan video biasa dan menampilkan iframe YouTube
                    document.getElementById('player').style.display = 'none';
                    document.getElementById('video-iframe').style.display = 'block';
                    document.getElementById('video-iframe').src = fileSrc;
                } else if (driveMatch) {
                    const driveId = driveMatch[1];
                    fileSrc = 'https://drive.google.com/file/d/' + driveId + '/preview';
                    // Menyembunyikan video biasa dan menampilkan iframe Google Drive
                    document.getElementById('player').style.display = 'none';
                    document.getElementById('video-iframe').style.display = 'block';
                    document.getElementById('video-iframe').src = fileSrc;
                } else {
                    // Perbarui sumber video biasa jika bukan YouTube atau Google Drive
                    document.getElementById('player').style.display = 'block';
                    document.getElementById('video-iframe').style.display = 'none';
                    const videoSource = document.getElementById('video-source');
                    videoSource.src = filePath;

                    // Muat dan mainkan video
                    const player = document.getElementById('player');
                    player.load(); // Memuat video baru
                    player.play(); // Memulai pemutaran video
                }
            }
        }

        // Event listener untuk setiap item kursus
        courseItems.forEach((item, index) => {
            item.addEventListener('click', function() {
                currentIndex = index; // Simpan indeks item yang diklik
                updateVideo(currentIndex);
            });
        });

        // Menampilkan video pertama saat halaman dimuat
        updateVideo(currentIndex);

        // Tombol Previous Lesson
        document.querySelector('.prev-button').addEventListener('click', function() {
            if (currentIndex > 0) {
                currentIndex--; // Pindah ke indeks sebelumnya
                updateVideo(currentIndex);
            }
        });

        // Tombol Next Lesson
        document.querySelector('.next-button').addEventListener('click', function() {
            if (currentIndex < courseItems.length - 1) {
                currentIndex++; // Pindah ke indeks berikutnya
                updateVideo(currentIndex);
            }
        });
    });
</script>
