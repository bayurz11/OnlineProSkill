<div class="lesson__video-wrap">
    <div class="lesson__video-wrap-top">
        <div class="lesson__video-wrap-top-left">
            <a href="{{ route('akses_pembelian') }}"><i class="flaticon-arrow-right"></i></a>
            <span id="video-title">Choose a lesson</span>
        </div>
        <div class="lesson__video-wrap-top-right">
            <a href="{{ route('/') }}"><i class="fas fa-times"></i></a>
        </div>
    </div>

    <iframe id="player" width="100%" height="500px" src="" frameborder="0"></iframe>

    <div class="lesson__next-prev-button">
        <button class="prev-button" title="Previous Lesson"><i class="flaticon-arrow-right"></i></button>
        <button class="next-button" title="Next Lesson"><i class="flaticon-arrow-right"></i></button>
    </div>
</div>
<div class="d-flex justify-content-end mt-3">
    <div class="d-flex align-items-center">
        <form id="statusForm" action="{{ route('sectionstatus', $kurikulum[0]->sections->first()->id) }}" method="POST"
            onsubmit="submitStatusForm(event)">
            @csrf
            @method('PUT')
            <input type="hidden" id="sectionId" name="sectionId" value="{{ $kurikulum[0]->sections->first()->id }}">
            <input type="hidden" name="status" value="true">
            <button type="submit" class="btn btn-primary">Menyelesaikan</button>
        </form>

        @if ($allSectionsCompleted)
            <form id="printForm" action="{{ route('print_certificate', ['id' => $user->id]) }}" method="POST"
                class="ms-3" target="_blank" onsubmit="openInNewTab(event)">
                @csrf
                <button type="submit" class="btn btn-secondary">Sertifikat
                    Penyelesaian</button>
            </form>
            <script>
                function openInNewTab(event) {
                    event.preventDefault();
                    const form = event.target;
                    const formData = new FormData(form);
                    const actionUrl = form.action;

                    fetch(actionUrl, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                            }
                        })
                        .then(response => response.blob())
                        .then(blob => {
                            const url = window.URL.createObjectURL(blob);
                            const a = document.createElement('a');
                            a.href = url;
                            a.target = '_blank';
                            a.click();
                            window.URL.revokeObjectURL(url);
                        })
                        .catch(error => console.error('Error:', error));
                }
            </script>
        @endif
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
    });
</script>
