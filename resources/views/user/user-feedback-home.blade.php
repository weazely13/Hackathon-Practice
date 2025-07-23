<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Feedback Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
            <a href="/user-feedback-form" class="btn-feedback">Leave Feedback</a>
        </div>
    </div>

    <!-- Filter and Sort -->
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <div class="filter mb-4">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <h5>Filter & Sort Reviews</h5>
                        </div>
                        <div class="col-md-3 mb-2 mb-md-0">
                            <div class="custom-input-group">
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0">
                                        <i class="bi bi-search"></i>
                                    </span>
                                    <input type="text" class="form-control bg-light border-0"
                                        placeholder="Search reviews...">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mb-2 mb-md-0">
                            <select class="form-select bg-light">
                                <option>All Categories</option>
                                <option>Food</option>
                                <option>Service</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select bg-light">
                                <option>Most Recent</option>
                                <option>High Ratings</option>
                                <option>Low Ratings</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Review Card -->
        <div class="review-card">
            <div class="d-flex align-items-center gap-2 mb-2">
                <span class="text-warning">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                <span class="category-tag">Service</span>
                <span class="pinned-badge">📌 Pinned</span>
            </div>
            <h5>Excellent Service and Food</h5>
            <small class="text-muted">Jan 15, 2024 • Anonymous Customer</small>
            <p class="mt-2">The staff was incredibly helpful and the food was amazing. The ambiance was perfect for
                our date night. Will definitely come back!</p>

            <!-- Response from Restaurant -->
            <div class="response-box">
                <strong class="text-primary">Response from Demo Restaurant</strong>
                <p class="mb-0">Thank you so much for your wonderful review! We're thrilled you enjoyed your date
                    night with us. Looking forward to welcoming you back soon!</p>
            </div>

            <!-- Like and Report -->
            <div class="mt-3 d-flex gap-4 align-items-center">
                <button id="likeBtn" class="btn btn-sm btn-outline-primary d-flex align-items-center gap-2">
                    <i class="bi bi-hand-thumbs-up"></i>
                    <span id="likeCount">12</span>
                </button>

                <button id="flagBtn" class="btn btn-sm btn-outline-danger d-flex align-items-center gap-2">
                    <i class="bi bi-flag"></i>
                    <span>Flag</span>
                </button>
            </div>
        </div>
    </div>

</body>
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
</script>

</html>
