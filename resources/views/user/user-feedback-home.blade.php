<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Feedback Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .body {}

        .btn {
            background: linear-gradient(to right, #1993d0, #58d2f1);
            border: none;
        }

        .btn-feedback {
            text-decoration: none;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 1rem;
            margin-bottom: 1rem;
            background: linear-gradient(to right, #1993d0, #58d2f1);
            color: white;
            border: none;
            padding: 0.7rem 1.5rem;
            font-weight: 500;
            border-radius: 0.5rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease-in-out;
        }

        .btn-feedback:hover {
            color: white;
            transform: scale(1.02);
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.15);
        }

        .header-bg {
            background: linear-gradient(to right, #2196f3, #64b5f6);
            color: white;
            padding: 2rem 0;
            text-align: center;
        }

        .review-card {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
            border-radius: 10px;
            padding: 1.5rem;
            border: .7px solid #e9e9e9;
        }

        .review-card:hover {
            box-shadow: 0 0.8rem 1.5rem rgba(0, 0, 0, 0.07);
            transform: translateY(-2px);
            border: 1px solid #2196f3;
            transition: all 0.2s ease-in-out;
        }


        .response-box {
            background-color: #f8f9fa;
            border-left: 4px solid #0d6efd;
            padding: 1rem;
            margin-top: 1rem;
            border-radius: 8px;
        }

        .pinned-badge {
            background-color: #e7f1ff;
            color: #0d6efd;
            font-weight: 500;
            border-radius: 12px;
            padding: 0.25rem 0.75rem;
            font-size: 0.8rem;
        }

        .category-tag {
            background-color: #e9ecef;
            font-size: 0.8rem;
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
        }

        .info {
            font-size: 1.3rem;
        }

        .filter {
            border: .7px solid #e9e9e9;
            padding: 2rem;
            border-radius: .8rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
        }

        .filter:hover{
            box-shadow: 0 0.8rem 1.5rem rgba(0, 0, 0, 0.07);
            transform: translateY(-2px);
            border: 1px solid #2196f3;
            transition: all 0.2s ease-in-out;
        }

        .custom-input-group:focus-within .input-group {
            border: 1px solid #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
            border-radius: 0.375rem;
        }

        .custom-input-group .input-group {
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            overflow: hidden;
        }


        .input-group-text,
        .form-control {
            height: 100%;
        }
    </style>
</head>

<body>

    <!-- Header -->
    <div class="header-bg">
        <h1 class="mt-3 mb-2" style="font-size: 3rem; font-weight: 700;">Demo Restaurant</h1>
        <div class="info d-flex justify-content-center align-items-center gap-2">
            <span class="text-warning">&#9733;&#9733;&#9733;&#9733;&#189;</span>
            <strong>4.4</strong>
            <span class="text-white">| 127 reviews</span>
        </div>
        <div class="d-flex justify-content-center">
            <a href="{{ route('feedback.form') }}" class="btn-feedback">Leave Feedback</a>
        </div>
    </div>

    <!-- Filter and Sort -->
    <div class="container my-5">
        <div class="mx-auto" style="max-width: 800px">
            <div class="filterContainer row">
                <div class="col-md-12">
                    <div class="filter mb-4">
                        <form method="GET" action="{{ route('feedback.home') }}" id="filterForm">
                            <div class="row align-items-end g-2">
                                <div class="col-md-3">
                                    <h5>Filter Reviews</h5>
                                </div>
                                <div class="col-md-3">
                                    <select name="category" class="form-select bg-light">
                                        <option value="">All Categories</option>
                                        <option value="Food" {{ request('category') == 'Food' ? 'selected' : '' }}>
                                            Food</option>
                                        <option value="Service"
                                            {{ request('category') == 'Service' ? 'selected' : '' }}>Service</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="sort" class="form-select bg-light">
                                        <option value="">Most Recent</option>
                                        <option value="high" {{ request('sort') == 'high' ? 'selected' : '' }}>High
                                            Ratings</option>
                                        <option value="low" {{ request('sort') == 'low' ? 'selected' : '' }}>Low
                                            Ratings</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary w-100">Apply Filter</button>
                                </div>
                            </div>



                        </form>

                    </div>
                </div>
            </div>


            <!-- Review Card -->
            @isset($reviews)
                @foreach ($reviews as $review)
                    <div class="review-card mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="mb-0">{{ $review->title }}</h5>
                            <div class="d-flex align-items-center gap-2">
                                <span class="text-warning" style="font-size: 1.2rem">
                                    @for ($i = 0; $i < $review->rating; $i++)
                                        &#9733;
                                    @endfor
                                </span>
                                <span class="category-tag">{{ $review->category }}</span>
                                @if ($review->is_pinned)
                                    <span class="pinned-badge">📌 Pinned</span>
                                @endif
                            </div>
                        </div>

                        <small class="text-muted">
                            {{ $review->created_at->format('M d, Y') }} • {{ $review->author ?? 'Anonymous' }}
                        </small>

                        <p class="mt-2">{{ $review->feedback }}</p>

                        @if ($review->response)
                            <div class="response-box mt-2 p-2 border rounded bg-light">
                                <strong class="text-primary">Response from {{ config('app.name') }}</strong>
                                <p class="mb-0">{{ $review->response }}</p>
                            </div>
                        @endif
                    </div>
                @endforeach
            @else
                <p>No Reviews Available.</p>
            @endisset
        </div>
    </div>

    <script>
        let liked = false;
        let flagged = false;

        document.getElementById('likeBtn').addEventListener('click', function() {
            if (!liked) {
                const countSpan = document.getElementById('likeCount');
                countSpan.textContent = parseInt(countSpan.textContent) + 1;
                this.classList.replace('btn-outline-primary', 'btn-primary');
                liked = true;
            }
        });

        document.getElementById('flagBtn').addEventListener('click', function() {
            if (!flagged) {
                this.innerHTML = '🚩 <span>Flagged</span>';
                this.classList.replace('btn-outline-danger', 'btn-danger');
                flagged = true;
            }
        });

        document.querySelectorAll('#filterForm select').forEach(function(select) {
            select.addEventListener('change', function() {
                const form = document.getElementById('filterForm');
                const url = new URL(window.location.href);
                const formData = new FormData(form);

                // Reset query string to match current form state
                url.search = '';
                formData.forEach((value, key) => {
                    url.searchParams.set(key, value);

                });

                window.location.href = url.toString();
            });
        });
    </script>

</body>


</html>
