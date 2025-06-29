<!-- Review Display Section -->
<div id="testimonial" class="container-fluid has-bg-overlay text-center text-light has-height-lg middle-items">
    <h2 class="section-title my-5">REVIEWS</h2>
    <div class="row mt-3 mb-5">
        @foreach($reviews as $review)
            <div class="col-md-4 my-3">
                <div class="testimonial-card p-3 rounded bg-dark shadow">
                    <h3 class="testimonial-title">{{ $review->user->name ?? 'Anonymous' }}</h3>
                    <h6 class="testimonial-subtitle">{{ $review->user->role ?? 'Customer' }}</h6>
                    <div class="testimonial-body" style="font-size: 18px">
                        <p><b>“{{ Str::limit($review->title ?? 'Review', 30) }}”</b><br>
                            {{ $review->review }}
                        </p>
                        <span style="color: gold; font-size: 32px">
                            {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Review Submission Form -->
<div class="container mt-5 text-start">
    <h3 class="text-light">Leave a Review</h3>

    @if(session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif

    <form action="{{ route('submit.review') }}" method="POST" class="bg-dark p-4 rounded shadow">
        @csrf

        <div class="mb-3">
            <label class="form-label text-light">Select Food Item</label>
            <select name="food_id" class="form-select" required>
                <option value="">-- Select Food --</option>
                @foreach($data as $food)
                    <option value="{{ $food->id }}">{{ $food->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label text-light">Your Review</label>
            <textarea name="review" class="form-control" rows="4" placeholder="Write your review..." required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label text-light">Rating</label>
            <select name="rating" class="form-select" required>
                <option value="">-- Select Rating --</option>
                @for ($i = 5; $i >= 1; $i--)
                    <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                @endfor
            </select>
        </div>

        <button type="submit" class="btn btn-warning">Submit Review</button>
    </form>
</div>
