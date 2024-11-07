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
        // Data kursus yang berisi URL file PDF atau video
        const courseItems = [{
                title: 'Full Stack Developer Resume',
                filePath: '/public/uploads/1730969979_nur%20azani%20bayu%20rezki_Full%20Stack%20Developer_Resume.pdf'
            },
            {
                title: 'YouTube Video',
                filePath: 'https://www.youtube.com/embed/dQw4w9WgXcQ'
            },
            // Tambahkan item kursus lainnya di sini...
        ];

        let currentIndex = 0;

        // Fungsi untuk memperbarui iframe berdasarkan indeks
        function updateVideo(index) {
            if (index >= 0 && index < courseItems.length) {
                const item = courseItems[index];
                const videoTitle = item.title;

                // Perbarui judul
                document.getElementById('video-title').innerText = videoTitle;

                const player = document.getElementById('player');
                player.src = item.filePath; // Perbarui src iframe dengan file yang dipilih
            }
        }

        // Event listener untuk setiap item kursus
        // Misalnya, Anda bisa mengubah data dinamis ini sesuai dengan kursus yang dipilih
        document.querySelectorAll('.course-item').forEach((item, index) => {
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
