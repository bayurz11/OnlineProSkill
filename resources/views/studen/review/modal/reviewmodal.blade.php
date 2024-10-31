@foreach ($orders as $order)
    <div class="modal fade" id="reviewModal{{ $order->KelasTatapMuka->id }}" tabindex="-1"
        aria-labelledby="reviewModalLabel{{ $order->KelasTatapMuka->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reviewModalLabel{{ $order->KelasTatapMuka->id }}">
                        Beri Review untuk Kelas:
                        {{ $order->KelasTatapMuka->nama_kursus ?? 'Tidak tersedia' }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('review.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="class_id" value="{{ $order->KelasTatapMuka->id }}">

                        <!-- Input Rating -->
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <select name="rating" class="form-select" required>
                                <option value="5">5 - Excellent</option>
                                <option value="4">4 - Good</option>
                                <option value="3">3 - Average</option>
                                <option value="2">2 - Poor</option>
                                <option value="1">1 - Very Poor</option>
                            </select>
                        </div>

                        <!-- Input Komentar -->
                        <div class="mb-3">
                            <label for="comment" class="form-label">Komentar</label>
                            <textarea name="comment" class="form-control" rows="3" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Kirim
                            Review</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
