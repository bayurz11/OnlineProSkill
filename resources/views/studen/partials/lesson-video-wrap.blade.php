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
        <!-- Video YouTube atau PDF akan ditampilkan di sini -->
    </div>

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
            const filePath = firstCourseItem.getAttribute('data-file-path');
            const videoTitle = firstCourseItem.querySelector('.item-name').innerText;
            const isYoutubeLink = filePath.includes('youtube.com') || filePath.includes('youtu.be');
            const isPdfFile = filePath.endsWith('.pdf');

            // Perbarui video title
            document.getElementById('video-title').innerText = videoTitle;

            const videoContainer = document.getElementById('video-container');
            videoContainer.innerHTML = ''; // Kosongkan kontainer sebelum menambah elemen baru

            if (isYoutubeLink) {
                // Jika video adalah YouTube
                const youtubeEmbed = document.createElement('iframe');
                youtubeEmbed.src = filePath.replace('watch?v=', 'embed/');
                youtubeEmbed.width = '100%';
                youtubeEmbed.height = '500px';
                youtubeEmbed.frameBorder = '0';
                youtubeEmbed.allow =
                    'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
                youtubeEmbed.allowFullscreen = true;
                videoContainer.appendChild(youtubeEmbed);
            } else if (isPdfFile) {
                // Jika file adalah PDF
                const pdfIframe = document.createElement('iframe');
                pdfIframe.src = filePath;
                pdfIframe.width = '100%';
                pdfIframe.height = '500px';
                pdfIframe.type = 'application/pdf';
                videoContainer.appendChild(pdfIframe);
            } else {
                // Jika video adalah file video lokal
                const videoElement = document.createElement('video');
                videoElement.id = 'player';
                videoElement.playsInline = true;
                videoElement.controls = true;
                const sourceElement = document.createElement('source');
                sourceElement.src = filePath;
                sourceElement.type = 'video/mp4';
                videoElement.appendChild(sourceElement);
                videoContainer.appendChild(videoElement);
            }
        }
    });

    // Event listener untuk setiap item kursus
    const courseItems = document.querySelectorAll('.course-item');
    courseItems.forEach(item => {
        item.addEventListener('click', function() {
            const filePath = item.getAttribute('data-file-path');
            const videoTitle = item.querySelector('.item-name').innerText;
            const isYoutubeLink = filePath.includes('youtube.com') || filePath.includes('youtu.be');
            const isPdfFile = filePath.endsWith('.pdf');

            document.getElementById('video-title').innerText = videoTitle;

            const videoContainer = document.getElementById('video-container');
            videoContainer.innerHTML = ''; // Kosongkan kontainer sebelum menambah elemen baru

            if (isYoutubeLink) {
                const youtubeEmbed = document.createElement('iframe');
                youtubeEmbed.src = filePath.replace('watch?v=', 'embed/');
                youtubeEmbed.width = '100%';
                youtubeEmbed.height = '500px';
                youtubeEmbed.frameBorder = '0';
                youtubeEmbed.allow =
                    'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
                youtubeEmbed.allowFullscreen = true;
                videoContainer.appendChild(youtubeEmbed);
            } else if (isPdfFile) {
                const pdfIframe = document.createElement('iframe');
                pdfIframe.src = filePath;
                pdfIframe.width = '100%';
                pdfIframe.height = '500px';
                pdfIframe.type = 'application/pdf';
                videoContainer.appendChild(pdfIframe);
            } else {
                const videoElement = document.createElement('video');
                videoElement.id = 'player';
                videoElement.playsInline = true;
                videoElement.controls = true;
                const sourceElement = document.createElement('source');
                sourceElement.src = filePath;
                sourceElement.type = 'video/mp4';
                videoElement.appendChild(sourceElement);
                videoContainer.appendChild(videoElement);
            }
        });
    });
</script>
