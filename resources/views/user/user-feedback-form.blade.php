<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Feedback Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .card {
            border-radius: .6rem;
        }

        .star-rating {
            font-size: 3rem;
            direction: rtl;
            display: inline-flex;
            gap: .5rem;
        }

        .star-rating input[type="radio"] {
            display: none;
        }

        .star-rating label {
            cursor: pointer;
            color: #ddd;
        }

        .star-rating input[type="radio"]:checked~label,
        .star-rating label:hover,
        .star-rating label:hover~label {
            color: #f5b301;
            transform: scale(1.08);
        }

        .btn {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            margin-top: 3rem;
            background: linear-gradient(to right, #1993d0, #58bef1);
            color: white;
            border: none;
            padding: 0.75rem;
            font-weight: 500;
            border-radius: 0.5rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease-in-out;
        }

        .btn:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.15);
        }

        .public-btn {
            margin-top: 1rem;
            background-color: #ffffff;
            color: rgb(61, 61, 61);
            border: 1px solid #8b8b8b;
            padding: 0.5rem 0.8rem;
            font-weight: 500;
            border-radius: 0.5rem;
            text-align: center;
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.15);
        }

        .public-btn:hover {
            background-color: #f0f0f0;
            color: #333;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body class="bg-light py-5">
    <div class="container">
        <div class="card mx-auto shadow p-4" style="max-width: 600px;">
            <h3 class="text-center mt-3 mb-2">Rate Your Experience</h3>
            <p class="text-center text-muted mb-4">Your feedback helps Demo Restaurant provide better service</p>

            <h6 class="text-center mt-3" style="margin-bottom: -.5rem">How would you rate your experience?</h6>
            <div class="text-center mb-3">
                <div class="star-rating">
                    <input type="radio" name="rating" id="star5" value="5" /><label
                        for="star5">&#9733;</label>
                    <input type="radio" name="rating" id="star4" value="4" /><label
                        for="star4">&#9733;</label>
                    <input type="radio" name="rating" id="star3" value="3" /><label
                        for="star3">&#9733;</label>
                    <input type="radio" name="rating" id="star2" value="2" /><label
                        for="star2">&#9733;</label>
                    <input type="radio" name="rating" id="star1" value="1" /><label
                        for="star1">&#9733;</label>
                </div>
                <p id="ratingValue" class="mt-2 text-muted">No rating selected</p>
            </div>

            <form id="feedbackForm">
                <input type="hidden" id="business_owner_id" value="1"> <!-- Replace 1 with dynamic owner ID -->
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-select bg-light" id="category">
                        <option selected disabled>What aspect would you like to rate?</option>
                        <option value="food">Food</option>
                        <option value="service">Service</option>
                        <option value="ambience">Ambience</option>
                        <option value="cleanliness">Cleanliness</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Title (Optional)</label>
                    <input type="text" class="form-control bg-light" id="title" placeholder="Give your review a title...">
                </div>

                <div class="mb-3">
                    <label for="feedback" class="form-label">Your Feedback (Optional)</label>
                    <textarea class="form-control bg-light" id="feedback" rows="4" maxlength="500" placeholder="Tell us about your experience. What went well? What could be improved?"></textarea>
                    <small id="charCount" class="text-muted float-end">0/500 characters</small>
                </div>

                <button type="submit" class="btn btn-primary">Submit Feedback</button>
            </form>


            <p class="text-muted mt-4 text-center small">Your feedback is anonymous and helps improve the quality of
                service.</p>
        </div>

        <div class="d-flex justify-content-center mt-3">
            <a href="/user-feedback-home" class="public-btn text-decoration-none">View Public Feedback</a>
        </div>

    </div>

    <script>
        const stars = document.querySelectorAll('.star-rating input');
        const ratingValue = document.getElementById('ratingValue');
        const feedback = document.getElementById('feedback');
        const charCount = document.getElementById('charCount');

        stars.forEach(star => {
            star.addEventListener('change', () => {
                ratingValue.textContent = `${star.value} star${star.value > 1 ? 's' : ''}`;
            });
        });

        feedback.addEventListener('input', () => {
            charCount.textContent = `${feedback.value.length}/500 characters`;
        });

        document.getElementById('feedbackForm').addEventListener('submit', async function (e) {
            e.preventDefault();

            const rating = document.querySelector('.star-rating input:checked')?.value;
            const category = document.getElementById('category').value;
            const title = document.getElementById('title').value;
            const comment = document.getElementById('feedback').value;
            const business_owner_id = document.getElementById('business_owner_id').value;

            const formData = {
                rating,
                category,
                title,
                comment,
                business_owner_id,
            };

            const response = await fetch('/feedback/store', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(formData)
            });

            const data = await response.json();

            fetch('/feedback/store', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify(formData),
            })
            .then(async response => {
                const contentType = response.headers.get('content-type');
                const text = await response.text();

                if (!response.ok) {
                    throw new Error(text);
                }

                if (contentType && contentType.includes('application/json')) {
                    return JSON.parse(text);
                } else {
                    throw new Error('Expected JSON but got HTML:\n' + text.slice(0, 200));
                }
            })
            .then(data => {
                alert(data.message);
            })
            .catch(err => {
                console.error('Error:', err.message);
                alert('Something went wrong:\n' + err.message);
            });


        });

    </script>
</body>

</html>
