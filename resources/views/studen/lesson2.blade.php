@extends('layout.mainlayout')

@section('content')
    <section class="lesson__area section-pb-120">
        <div class="container-fluid p-0">
            <div class="row gx-0">
                <div class="col-xl-3 col-lg-4">
                    <div class="lesson__content">
                        <h2 class="title">Course Content</h2>
                        @include('studen.kurikulum')
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    @include('studen.partials.lesson-video-wrap')
                </div>


            </div>
        </div>


    </section>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const courseItems = document.querySelectorAll('.course-item');
            const completeSectionBtn = document.getElementById('completeSectionBtn');
            const reviewButton = document.getElementById('reviewButton'); // Tombol Review
            let currentIndex = 0;

            // Ambil ID dari URL
            const pathArray = window.location.pathname.split('/');
            const lessonId = pathArray[pathArray.length - 1]; // ID terletak di akhir URL

            // Setel ID ke input tersembunyi di dalam form review
            const idKurikulumInput = document.getElementById('idKurikulum');
            if (idKurikulumInput) {
                idKurikulumInput.value = lessonId;
            }

            // Fungsi untuk memperbarui konten iframe dan kelas aktif berdasarkan indeks
            function updateVideo(index) {
                if (index >= 0 && index < courseItems.length) {
                    const item = courseItems[index];
                    const filePath = item.getAttribute('data-file-path');
                    const videoId = item.getAttribute('data-video-id');
                    const videoTitle = item.querySelector('.item-name').innerText;

                    // Perbarui judul video
                    document.getElementById('video-title').innerText = videoTitle;

                    const player = document.getElementById('player');

                    // Menghapus kelas 'active' dari semua item dan menambahkannya pada item yang dipilih
                    courseItems.forEach((el) => el.classList.remove('active'));
                    item.classList.add('active');

                    // Memperbarui tombol "Tandai Selesai"
                    updateCompleteButton(item);

                    // Menangani file PDF
                    if (filePath.endsWith('.pdf')) {
                        const correctFilePath = '/public/' + filePath;
                        player.src = correctFilePath;
                    }
                    // Menangani video YouTube
                    else if (videoId.includes('youtube.com')) {
                        const videoIdMatch = videoId.match(/(?:v=|\/)([a-zA-Z0-9_-]{11})/);
                        if (videoIdMatch) {
                            const videoEmbedUrl = `https://www.youtube.com/embed/${videoIdMatch[1]}`;
                            if (videoId.includes('t=')) {
                                const timeParam = videoId.split('t=')[1].split('&')[0];
                                player.src = `${videoEmbedUrl}?start=${timeParam}`;
                            } else {
                                player.src = videoEmbedUrl;
                            }
                        }
                    }
                    // Menangani file video biasa
                    else {
                        player.src = filePath;
                    }
                }
            }

            // Fungsi untuk memperbarui tampilan tombol "Tandai Selesai"
            function updateCompleteButton(item) {
                const sectionId = item.getAttribute('data-id');
                const isCompleted = item.querySelector('.bg-success'); // Mengecek apakah section sudah selesai
                completeSectionBtn.setAttribute('data-section-id', sectionId);

                // Tampilkan tombol jika section belum selesai, sembunyikan jika sudah selesai
                completeSectionBtn.style.display = isCompleted ? 'none' : 'block';

                // Cek jika semua section selesai
                checkAllSectionsCompleted();
            }

            // Fungsi untuk memeriksa apakah semua section sudah selesai
            function checkAllSectionsCompleted() {
                const allCompleted = Array.from(courseItems).every(item => item.querySelector('.bg-success'));
                if (allCompleted) {
                    reviewButton.style.display = 'block'; // Tampilkan tombol Review jika semua section selesai
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

            // Event klik untuk tombol "Tandai Selesai"
            completeSectionBtn.addEventListener('click', function() {
                const sectionId = this.getAttribute('data-section-id');

                fetch(`/sectionupdatestatus/${sectionId}`, {
                        method: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            sectionId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update UI untuk menunjukkan section sudah selesai
                            const activeItem = document.querySelector(
                                `.course-item[data-id="${sectionId}"]`);
                            activeItem.querySelector('.course-item-link').insertAdjacentHTML(
                                'beforeend',
                                '<div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 24px; height: 24px;"><i class="fas fa-check"></i></div>'
                            );
                            completeSectionBtn.style.display = 'none';

                            // Pindah ke lesson berikutnya setelah sukses
                            if (currentIndex < courseItems.length - 1) {
                                currentIndex++;
                                updateVideo(currentIndex);
                            }

                            // Mengambil konten kurikulum terbaru setelah update status
                            document.addEventListener('DOMContentLoaded', () => {
                                const kurikulumContainer = document.getElementById(
                                    'kurikulum-content');
                                const courseId = document.getElementById('course-id')
                                    .value; // Pastikan memiliki ID kursus di halaman

                                // Mengambil konten kurikulum terbaru
                                fetch(`/course-content/${courseId}`)
                                    .then(response => response.text())
                                    .then(html => {
                                        kurikulumContainer.innerHTML =
                                            html; // Mengganti konten kurikulum
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                    });
                            });
                        } else {
                            console.error('Gagal memperbarui status.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });

            // Event klik untuk tombol "Review Course"
            reviewButton.addEventListener('click', () => {
                // Menampilkan modal review ketika tombol di klik
                const myModal = new bootstrap.Modal(document.getElementById('reviewModal'));
                myModal.show();
            });

            // Event submit untuk form review
            document.getElementById('reviewForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const rating = document.getElementById('rating').value;
                const comment = document.getElementById('comment').value;

                // Ambil ID kelas dari URL
                const classId = window.location.pathname.split('/').pop(); // Mengambil ID dari URL

                // Mengirim review ke server
                fetch('/review/store', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            rating: rating,
                            comment: comment,
                            class_id: classId // Mengirimkan classId yang benar
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Review submitted successfully!');
                            // Menutup modal
                            const myModal = bootstrap.Modal.getInstance(document.getElementById(
                                'reviewModal'));
                            myModal.hide();
                        } else {
                            alert('Failed to submit review.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });

        });
    </script>

    <style>
        .course-item.active {
            background-color: #f0f0f0;
            border-left: 5px solid #007bff;
        }
    </style>

    <!-- Modal untuk memberikan review -->
    <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reviewModalLabel">Give Your Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="reviewForm">
                        <input type="hidden" id="idKurikulum" name="class_id" />

                        <!-- Rating -->
                        <div></div>
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <select id="rating" class="form-select" required>
                                <option value="">Select Rating</option>
                                <option value="1">1 - Very Bad</option>
                                <option value="2">2 - Bad</option>
                                <option value="3">3 - Average</option>
                                <option value="4">4 - Good</option>
                                <option value="5">5 - Excellent</option>
                            </select>
                        </div>
                        <!-- Comment -->
                        <div class="mb-3">
                            <label for="comment" class="form-label">Your Comment</label>
                            <textarea id="comment" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Review</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
