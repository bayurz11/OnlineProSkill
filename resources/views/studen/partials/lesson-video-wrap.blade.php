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

    <iframe id="player" width="100%" height="500px" src="" frameborder="0"></iframe>

    <div class="lesson__next-prev-button">
        <button class="prev-button" title="Previous Lesson"><i class="flaticon-arrow-right"></i></button>
        <button class="next-button" title="Next Lesson"><i class="flaticon-arrow-right"></i></button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const courseItems = document.querySelectorAll('.course-item');
        let currentIndex = 0;

        // Fungsi untuk memperbarui konten iframe berdasarkan indeks
        function updateVideo(index) {
            if (index >= 0 && index < courseItems.length) {
                const item = courseItems[index];
                const filePath = item.getAttribute('data-file-path'); // File PDF atau video
                const videoId = item.getAttribute('data-video-id'); // URL video YouTube
                const videoTitle = item.querySelector('.item-name').innerText;

                // Perbarui judul video
                document.getElementById('video-title').innerText = videoTitle;

                const player = document.getElementById('player');

                if (filePath.endsWith('.pdf')) {
                    // Jika file adalah PDF, tampilkan PDF di dalam iframe
                    player.src = filePath; // Menggunakan file PDF langsung
                } else if (videoId.includes('youtube.com')) {
                    // Jika URL adalah YouTube, tampilkan video di dalam iframe
                    const videoUrl = videoId.replace('watch?v=', 'embed/') + (videoId.includes('&') ? '' :
                        videoId.split('?')[1] || '');

                    player.src = videoUrl;
                } else {
                    // Untuk jenis file video lainnya, Anda dapat menambahkan logika untuk menampilkan video
                    player.src = filePath; // Asumsikan file path mengarah ke file video
                }
            }
        }

        // Event listener untuk setiap item kursus
        courseItems.forEach((item, index) => {
            item.addEventListener('click', function() {
                currentIndex = index;
                updateVideo(currentIndex);
            });
        });

        // Menampilkan video pertama saat halaman dimuat
        updateVideo(currentIndex);

        // Tombol Previous Lesson
        document.querySelector('.prev-button').addEventListener('click', function() {
            if (currentIndex > 0) {
                currentIndex--;
                updateVideo(currentIndex);
            }
        });

        // Tombol Next Lesson
        document.querySelector('.next-button').addEventListener('click', function() {
            if (currentIndex < courseItems.length - 1) {
                currentIndex++;
                updateVideo(currentIndex);
            }
        });
    });
</script>
