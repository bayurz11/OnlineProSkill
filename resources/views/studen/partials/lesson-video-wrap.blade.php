<div class="d-flex justify-content-end mt-3 ms-3 me-3">
    <!-- Form untuk mengirimkan status completion -->
    <form action="{{ route('sectionstatus', ['id' => $section->id]) }}" method="POST" id="completion-form">
        @csrf
        @method('PUT')
        <!-- Kirimkan sectionId dalam form -->
        <input type="hidden" name="sectionId" value="{{ $section->id }}">
        <button type="submit" class="btn btn-primary">Menyelesaikan</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const courseItems = document.querySelectorAll('.course-item');
        let currentIndex = 0;

        // Fungsi untuk memperbarui konten iframe berdasarkan indeks
        function updateVideo(index) {
            if (index >= 0 && index < courseItems.length) {
                const item = courseItems[index];
                const filePath = item.getAttribute('data-file-path');
                const videoId = item.getAttribute('data-video-id');
                const videoTitle = item.querySelector('.item-name').innerText;

                // Perbarui judul video
                document.getElementById('video-title').innerText = videoTitle;

                const player = document.getElementById('player');

                // Menangani file PDF
                if (filePath.endsWith('.pdf')) {
                    const correctFilePath = '/public/' + filePath;
                    player.src = correctFilePath; // Atur URL yang benar untuk PDF
                }
                // Menangani video YouTube
                else if (videoId.includes('youtube.com')) {
                    // Mengambil ID video dari URL YouTube
                    const videoIdMatch = videoId.match(/(?:v=|\/)([a-zA-Z0-9_-]{11})/);
                    if (videoIdMatch) {
                        const videoEmbedUrl =
                            `https://www.youtube.com/embed/${videoIdMatch[1]}`; // Membuat URL embed

                        // Jika ada parameter waktu untuk memulai video, tambahkan ke URL
                        if (videoId.includes('t=')) {
                            const timeParam = videoId.split('t=')[1].split('&')[0]; // Menangkap waktu t=xxx
                            player.src =
                                `${videoEmbedUrl}?start=${timeParam}`; // Menambahkan parameter start ke URL embed
                        } else {
                            player.src =
                                videoEmbedUrl; // Jika tidak ada parameter waktu, gunakan URL embed standar
                        }
                    }
                }
                // Menangani file video biasa
                else {
                    player.src = filePath; // Untuk file video lainnya
                }

                console.log('Player URL:', player.src); // Debugging untuk memeriksa URL
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

        // Menangani tombol "Menyelesaikan" untuk pindah ke pelajaran berikutnya
        document.getElementById('completion-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah form dari reload halaman
            // Kirim form dengan AJAX atau reload halaman sesuai kebutuhan
            // Setelah selesai, pindah ke video berikutnya
            if (currentIndex < courseItems.length - 1) {
                currentIndex++;
                updateVideo(currentIndex);
            }
        });
    });
</script>
