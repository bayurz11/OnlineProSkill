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

    <!-- Ganti video dengan iframe untuk YouTube dan PDF -->
    <div id="video-container">
        <iframe id="player" width="560" height="315" src="" frameborder="0"
            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>

    <div class="lesson__next-prev-button">
        <button class="prev-button" title="Previous Lesson"><i class="flaticon-arrow-right"></i></button>
        <button class="next-button" title="Next Lesson"><i class="flaticon-arrow-right"></i></button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const courseItems = document.querySelectorAll('.course-item');
        let currentIndex = 0;

        // Fungsi untuk memperbarui video atau PDF berdasarkan indeks
        function updateContent(index) {
            if (index >= 0 && index < courseItems.length) {
                const item = courseItems[index];
                const filePath = item.getAttribute('data-file-path');
                const videoTitle = item.querySelector('.item-name').innerText;
                const contentType = item.getAttribute('data-content-type'); // video atau pdf

                // Perbarui judul
                document.getElementById('video-title').innerText = videoTitle;

                const player = document.getElementById('player');
                const videoContainer = document.getElementById('video-container');

                if (contentType === 'video') {
                    // Untuk video (YouTube)
                    player.src = `https://www.youtube.com/embed/${filePath}`;
                    videoContainer.style.display = 'block'; // Tampilkan iframe untuk video
                    player.style.display = 'block';
                    player.width = '560';
                    player.height = '315';
                } else if (contentType === 'pdf') {
                    // Untuk PDF
                    player.src = filePath; // filePath adalah URL PDF
                    videoContainer.style.display = 'block'; // Tampilkan iframe untuk PDF
                    player.style.display = 'block';
                    player.width = '100%';
                    player.height = '600px';
                }
            }
        }

        // Event listener untuk setiap item kursus
        courseItems.forEach((item, index) => {
            item.addEventListener('click', function() {
                currentIndex = index;
                updateContent(currentIndex);
            });
        });

        // Menampilkan konten pertama saat halaman dimuat
        updateContent(currentIndex);

        // Tombol Previous Lesson
        document.querySelector('.prev-button').addEventListener('click', function() {
            if (currentIndex > 0) {
                currentIndex--;
                updateContent(currentIndex);
            }
        });

        // Tombol Next Lesson
        document.querySelector('.next-button').addEventListener('click', function() {
            if (currentIndex < courseItems.length - 1) {
                currentIndex++;
                updateContent(currentIndex);
            }
        });
    });
</script>
