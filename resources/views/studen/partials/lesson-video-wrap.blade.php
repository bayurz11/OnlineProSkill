<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Ambil semua item kursus
        const courseItems = document.querySelectorAll('.course-item');

        let currentIndex = 0; // Variabel untuk menyimpan indeks kursus yang sedang diputar

        // Fungsi untuk memperbarui iframe berdasarkan indeks
        function updateVideo(index) {
            if (index >= 0 && index < courseItems.length) {
                const item = courseItems[index];
                const videoId = item.getAttribute('data-video-id'); // ID video
                const filePath = item.getAttribute('data-file-path'); // Path file video atau PDF
                const videoTitle = item.querySelector('.item-name').innerText; // Judul video

                // Perbarui judul
                document.getElementById('video-title').innerText = videoTitle;

                const player = document.getElementById('player');
                if (filePath.endsWith('.pdf')) {
                    // Jika file adalah PDF, tampilkan di iframe
                    player.src = '/public/uploads/' + filePath; // Sesuaikan dengan path yang benar
                } else if (filePath.includes('youtube.com')) {
                    // Jika file adalah video YouTube, tampilkan menggunakan embed
                    player.src = filePath; // URL YouTube
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
