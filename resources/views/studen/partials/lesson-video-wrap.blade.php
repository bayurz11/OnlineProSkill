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
            const videoId = firstCourseItem.getAttribute('data-video-id');
            const videoTitle = firstCourseItem.querySelector('.item-name').innerText;

            // Perbarui video title
            document.getElementById('video-title').innerText = videoTitle;

            // Perbarui tampilan video
            const player = document.getElementById('player');
            const videoSource = document.getElementById('video-source');

            if (filePath.endsWith('.pdf')) {
                // Menampilkan PDF
                document.querySelector('.lesson__video-wrap').innerHTML = `
                <object data="${filePath}" type="application/pdf" width="100%" height="600px">
                    <p>Sorry, your browser does not support PDF view.</p>
                </object>
            `;
            } else if (videoId) {
                // Menampilkan Video YouTube
                document.querySelector('.lesson__video-wrap').innerHTML = `
                <iframe width="100%" height="600px" src="https://www.youtube.com/embed/${videoId}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            `;
            } else {
                // Menampilkan video normal
                videoSource.src = filePath;
                player.load(); // Memuat video baru
                player.play(); // Memulai pemutaran video
            }
        }
    });

    // Event listener untuk setiap item kursus
    const courseItems = document.querySelectorAll('.course-item');
    courseItems.forEach(item => {
        item.addEventListener('click', function() {
            const filePath = item.getAttribute('data-file-path');
            const videoId = item.getAttribute('data-video-id');
            const videoTitle = item.querySelector('.item-name').innerText;

            document.getElementById('video-title').innerText = videoTitle;

            const player = document.getElementById('player');
            const videoSource = document.getElementById('video-source');

            if (filePath.endsWith('.pdf')) {
                // Menampilkan PDF
                document.querySelector('.lesson__video-wrap').innerHTML = `
                <object data="${filePath}" type="application/pdf" width="100%" height="600px">
                    <p>Sorry, your browser does not support PDF view.</p>
                </object>
            `;
            } else if (videoId) {
                // Menampilkan Video YouTube
                document.querySelector('.lesson__video-wrap').innerHTML = `
                <iframe width="100%" height="600px" src="https://www.youtube.com/embed/${videoId}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            `;
            } else {
                // Menampilkan video normal
                videoSource.src = filePath;
                player.load();
                player.play();
            }
        });
    });
</script>
