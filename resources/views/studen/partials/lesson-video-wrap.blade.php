<div class="lesson__video-wrap">
    <div class="lesson__video-wrap-top">
        <div class="lesson__video-wrap-top-left">
            <a href="#" class="prev-button"><i class="flaticon-arrow-left"></i></a>
            <span id="video-title">Choose a lesson</span>
        </div>
        <div class="lesson__video-wrap-top-right">
            <a href="#" class="close-button"><i class="fas fa-times"></i></a>
        </div>
    </div>

    <!-- Tempatkan PDF atau Video berdasarkan tipe -->
    <div id="media-container"></div> <!-- Div ini untuk menampung PDF atau video -->

    <div class="lesson__next-prev-button">
        <button class="prev-button" title="Previous Lesson"><i class="flaticon-arrow-left"></i></button>
        <button class="next-button" title="Next Lesson"><i class="flaticon-arrow-right"></i></button>
    </div>
</div>

<!-- Daftar Kursus -->
<ul id="course-list">
    <li class="course-item" data-file-path="/path/to/video.mp4" data-video-id="dQw4w9WgXcQ">
        <span class="item-name">Lesson 1 - Video</span>
    </li>
    <li class="course-item" data-file-path="/path/to/file.pdf" data-video-id="">
        <span class="item-name">Lesson 2 - PDF</span>
    </li>
    <li class="course-item" data-file-path="/path/to/another-video.mp4" data-video-id="">
        <span class="item-name">Lesson 3 - Another Video</span>
    </li>
</ul>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const courseItems = document.querySelectorAll('.course-item');
        let currentIndex = 0;

        function updateContent(item) {
            const filePath = item.getAttribute('data-file-path');
            const videoId = item.getAttribute('data-video-id');
            const videoTitle = item.querySelector('.item-name').innerText;

            // Update judul
            document.getElementById('video-title').innerText = videoTitle;

            const mediaContainer = document.getElementById('media-container');

            if (filePath.endsWith('.pdf')) {
                // Menampilkan PDF dengan iframe
                mediaContainer.innerHTML = `
                    <iframe src="${filePath}" width="100%" height="600px" frameborder="0">
                        <p>Your browser does not support PDF viewing. You can <a href="${filePath}">download the PDF</a> instead.</p>
                    </iframe>
                `;
            } else if (videoId) {
                // Menampilkan video YouTube
                mediaContainer.innerHTML = `
                    <iframe width="100%" height="600px" src="https://www.youtube.com/embed/${videoId}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                `;
            } else {
                // Menampilkan video biasa
                const videoPlayer = document.createElement('video');
                videoPlayer.setAttribute('controls', '');
                videoPlayer.setAttribute('width', '100%');
                videoPlayer.setAttribute('height', '600');

                const videoSource = document.createElement('source');
                videoSource.setAttribute('src', filePath);
                videoSource.setAttribute('type', 'video/mp4');

                videoPlayer.appendChild(videoSource);
                mediaContainer.appendChild(videoPlayer);
                videoPlayer.load();
                videoPlayer.play();
            }
        }

        function goToNextLesson() {
            if (currentIndex < courseItems.length - 1) {
                currentIndex++;
                updateContent(courseItems[currentIndex]);
            }
        }

        function goToPreviousLesson() {
            if (currentIndex > 0) {
                currentIndex--;
                updateContent(courseItems[currentIndex]);
            }
        }

        // Event listener untuk setiap item kursus
        courseItems.forEach((item, index) => {
            item.addEventListener('click', function() {
                currentIndex = index;
                updateContent(item);
            });
        });

        // Inisialisasi dengan item pertama
        if (courseItems.length > 0) {
            updateContent(courseItems[0]);
        }

        // Tombol Next dan Previous
        document.querySelector('.next-button').addEventListener('click', goToNextLesson);
        document.querySelector('.prev-button').addEventListener('click', goToPreviousLesson);

        // Tombol Close
        document.querySelector('.close-button').addEventListener('click', () => {
            document.getElementById('media-container').innerHTML = ''; // Menutup media
            document.getElementById('video-title').innerText = 'Choose a lesson'; // Reset judul
        });
    });
</script>
