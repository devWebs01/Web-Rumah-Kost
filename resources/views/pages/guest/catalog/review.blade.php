<section id="review" class="my-5">
    <h2 class="section-title">Review Pengguna</h2>
    <div class="card card-body border-0 shadow-sm">
        <div class="d-flex align-items-center mb-3">
            <h3 class="fw-bold mb-0 me-3">4.8</h3>
            <div class="review-stars fs-4">
                <i class="bi bi-star-fill">

                </i>
                <i class="bi bi-star-fill">

                </i>
                <i class="bi bi-star-fill">

                </i>
                <i class="bi bi-star-fill">

                </i>
                <i class="bi bi-star-half">

                </i>
            </div>
            <span class="ms-3 text-muted">(dari 25 review)</span>
        </div>
        <hr>

        <div class="review-list">
            @foreach ($boardingHouse->comments->where("status", true) as $comment)
                <div class="d-flex mb-3">
                    <img src="{{ "https://api.dicebear.com/9.x/adventurer/svg?seed=" . ($comment->user->name ?? "Mason") }}"
                        alt="User" class="rounded-circle me-3" style="width: 50px; height: 50px;">
                    <div>
                        <h6 class="fw-bold mb-0">{{ $comment->user->name }}</h6>
                        <div class="review-stars small">
                            @for ($i = 0; $i < $comment->rating; $i++)
                                <i class="bi bi-star-fill">
                                </i>
                            @endfor

                        </div>
                        <p class="mt-1">{{ $comment->body }}</p>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="add-review mt-4">
            <h5 class="fw-bold">Tulis Review Anda</h5>
            <form wire:submit='comment'>
                @csrf
                <div class="mb-3">
                    <label class="form-label">Rating</label>
                    <select class="form-select"wire:model="rating" aria-label="Default select example">
                        <option value=" " selected>Pilih rating bintang</option>
                        <option value="5">★★★★★ (Luar Biasa)</option>
                        <option value="4">★★★★☆ (Baik)</option>
                        <option value="3">★★★☆☆ (Cukup)</option>
                        <option value="2">★★☆☆☆ (Kurang)</option>
                        <option value="1">★☆☆☆☆ (Buruk)</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="body" class="form-label">Komentar Anda</label>
                    <textarea class="form-control" id="body" wire:model='body' rows="3"
                        placeholder="Bagikan pengalaman Anda menginap di sini...">
                    </textarea>
                </div>
                <button type="submit" class="btn btn-success">Kirim Review</button>
            </form>
        </div>
    </div>
</section>
