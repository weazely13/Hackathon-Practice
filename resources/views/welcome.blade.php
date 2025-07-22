<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Welcome | Feedback Tracker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: #333;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .btn-business {
            padding: 12px 30px;
            font-weight: 500;
            font-size: 16px;
        }
        .btn-outline-primary:hover {
            color: #2575fc;
            background-color: #fff;
        }
        /* Responsive image */
        .welcome-image {
            width: 100%;
            height: auto;
            border-radius: 16px 0 0 16px;
            object-fit: cover;
        }
        @media (max-width: 767.98px) {
            .welcome-image {
                border-radius: 16px 16px 0 0;
                max-height: 200px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card bg-light text-dark">
            <div class="row g-0 align-items-center">
                <!-- Image column -->
                <div class="col-md-6 d-none d-md-block">
                    <img 
                      src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=600&q=80" 
                      alt="Business meeting illustration" 
                      class="welcome-image" />
                </div>
                <!-- Content column -->
                <div class="col-md-6 p-5 text-center text-md-start">
                    <h1 class="mb-4">Welcome to <span class="text-primary">Feedback Tracker</span></h1>
                    <p class="mb-4 lead">
                        Analyze and respond to feedback smarter. Empower your business with real insights.
                    </p>
                    <div class="d-flex justify-content-center justify-content-md-start gap-3 flex-wrap">
                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-business flex-grow-1 flex-md-grow-0">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-primary btn-business flex-grow-1 flex-md-grow-0">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
