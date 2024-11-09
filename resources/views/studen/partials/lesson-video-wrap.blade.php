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
<button id="completeSectionBtn" class="btn btn-primary" style="display: none;" data-section-id="">
    Tandai Selesai
</button>
<div class="d-flex align-items-center">

    <button id="reviewButton" class="btn btn-primary me-2"
        {{ $hasReviewed ? 'disabled title="Anda sudah memberikan review"' : '' }}>
        Review Course
    </button>


    @if ($allSectionsCompleted && $hasReviewed)
        <form action="{{ route('print_certificate', ['id' => $sertifikat->id]) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">Cetak Sertifikat</button>
        </form>
    @endif
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const reviewButton = document.getElementById('reviewButton');

        // Ambil nilai hasReviewed dari server
        const hasReviewed = @json($hasReviewed);

        // Menonaktifkan tombol jika pengguna sudah memberi review
        if (hasReviewed) {
            reviewButton.setAttribute('disabled', true);
            reviewButton.setAttribute('title', 'Anda sudah memberikan review');
        }
    });
</script>
