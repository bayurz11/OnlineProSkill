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

    <video id="player" playsinline controls data-poster="assets/img/bg/video_bg.webp">
        <source id="video-source" src="" type="video/mp4" />
        <source src="/path/to/video.webm" type="video/webm" />
    </video>

    <div class="lesson__next-prev-button">
        <button class="prev-button" title="Previous Lesson"><i class="flaticon-arrow-right"></i></button>
        <button class="next-button" title="Next Lesson"><i class="flaticon-arrow-right"></i></button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Ambil item kursus pertama
        const firstCourseItem = document.querySelector('.course-item');

        if (firstCourseItem) {
            // Ambil file path dari data-attribute
            const filePath = firstCourseItem.getAttribute('data-file-path');
            const videoTitle = firstCourseItem.querySelector('.item-name').innerText;

            // Perbarui video title
            document.getElementById('video-title').innerText = videoTitle;

            // Perbarui sumber video
            const videoSource = document.getElementById('video-source');
            videoSource.src = filePath;

            // Memuat dan memutar video pertama
            const player = document.getElementById('player');
            player.load(); // Memuat video baru
            player.play(); // Memulai pemutaran video
        }
    });

    // Event listener untuk setiap item kursus
    const courseItems = document.querySelectorAll('.course-item');
    courseItems.forEach(item => {
        item.addEventListener('click', function() {
            const filePath = item.getAttribute('data-file-path');
            const videoTitle = item.querySelector('.item-name').innerText;

            document.getElementById('video-title').innerText = videoTitle;

            const videoSource = document.getElementById('video-source');
            videoSource.src = filePath;

            const player = document.getElementById('player');
            player.load();
            player.play();
        });
    });
</script>
