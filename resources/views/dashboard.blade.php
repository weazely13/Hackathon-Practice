<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Feedback Tracker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 500px;
            padding: 2rem;
        }

        .btn-logout {
            border-radius: 8px;
            background-color: #dc3545;
            color: #fff;
        }

        .btn-logout:hover {
            background-color: #c82333;
        }

        .logo {
            font-weight: bold;
            font-size: 28px;
            color: #2575fc;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="card bg-white text-center">
        <div class="logo">Feedback Tracker</div>
        <h4 class="mb-3">Welcome, <span class="text-primary">{{ auth()->user()->name }}</span></h4>
        <p class="mb-4">You're now logged in and ready to manage your feedback insights.</p>
        
        <form method="GET" action="{{ route('logout') }}">
            <button type="submit" class="btn btn-logout">Logout</button>
        </form>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
