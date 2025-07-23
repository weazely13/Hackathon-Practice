<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Analytics | Feedback Tracker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Custom Dashboard CSS -->
    <link href="@vite(['resources/css/dashboard.css'])" rel="stylesheet">
    <!-- Additional Analytics CSS -->
    <style>
        .analytics-content {
            padding: 2rem;
        }
        
        .chart-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .chart-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-primary);
            margin: 0;
        }
        
        .chart-wrapper {
            position: relative;
            height: 400px;
            width: 100%;
        }
        
        .chart-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        @media (max-width: 768px) {
            .chart-row {
                grid-template-columns: 1fr;
            }
            
            .chart-wrapper {
                height: 300px;
            }
            
            .analytics-content {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar (same as dashboard) -->
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <i class="bi bi-chat-square-text"></i> FeedbackTracker
            </div>
            <div class="logo-subtitle">Professional Analytics</div>
        </div>

        <div class="sidebar-nav">
            <div class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('feedbacks') }}" class="nav-link">
                    <i class="bi bi-chat-left-text"></i>
                    Feedbacks
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('analytics') }}" class="nav-link active">
                    <i class="bi bi-graph-up-arrow"></i> 
                    Analytics
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('profile') }}" class="nav-link">
                    <i class="bi bi-person-circle"></i>
                    Profile
                </a>
            </div>
        </div>

        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">
                    {{ auth()->user()->name ? strtoupper(substr(auth()->user()->name, 0, 1)) : 'U' }}
                </div>
                <div class="user-details">
                    <h6>{{ auth()->user()->name ?? 'User' }}</h6>
                    <small>Business Owner</small>
                </div>
            </div>
            <form method="GET" action="{{ route('logout') }}">
                <button type="submit" class="btn-logout">
                    <i class="bi bi-box-arrow-right"></i>
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <!-- Overlay for mobile -->
    <div class="overlay" id="overlay"></div>

    <!-- Main Content -->
    <main class="main-content" id="mainContent">
        <!-- Top Navigation -->
        <div class="top-navbar">
            <button class="mobile-toggle" id="mobileToggle">
                <i class="bi bi-list"></i>
            </button>
            <h1 class="page-title">Analytics</h1>
        </div>

        <!-- Analytics Content -->
        <div class="analytics-content">
            <div class="chart-row">
                <div class="chart-container">
                    <div class="chart-header">
                        <h3 class="chart-title">Feedback by Category</h3>
                        <div class="chart-actions">
                            <select class="form-select form-select-sm" style="width: 120px;">
                                <option>Last 7 days</option>
                                <option>Last 30 days</option>
                                <option selected>All Time</option>
                            </select>
                        </div>
                    </div>
                    <div class="chart-wrapper">
                        <canvas id="categoryChart"></canvas>
                    </div>
                </div>

                <div class="chart-container">
                    <div class="chart-header">
                        <h3 class="chart-title">Feedback Sentiment</h3>
                        <div class="chart-actions">
                            <select class="form-select form-select-sm" style="width: 120px;">
                                <option>Last 7 days</option>
                                <option>Last 30 days</option>
                                <option selected>All Time</option>
                            </select>
                        </div>
                    </div>
                    <div class="chart-wrapper">
                        <canvas id="sentimentChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="chart-container">
                <div class="chart-header">
                    <h3 class="chart-title">Feedback Volume Over Time</h3>
                    <div class="chart-actions">
                        <select class="form-select form-select-sm" style="width: 120px;">
                            <option>Daily</option>
                            <option selected>Weekly</option>
                            <option>Monthly</option>
                        </select>
                    </div>
                </div>
                <div class="chart-wrapper">
                    <canvas id="timelineChart"></canvas>
                </div>
            </div>

            <div class="chart-row">
                <div class="chart-container">
                    <div class="chart-header">
                        <h3 class="chart-title">Response Times</h3>
                        <div class="chart-actions">
                            <select class="form-select form-select-sm" style="width: 120px;">
                                <option>Last 7 days</option>
                                <option>Last 30 days</option>
                                <option selected>All Time</option>
                            </select>
                        </div>
                    </div>
                    <div class="chart-wrapper">
                        <canvas id="responseChart"></canvas>
                    </div>
                </div>

                <div class="chart-container">
                    <div class="chart-header">
                        <h3 class="chart-title">Rating Distribution</h3>
                        <div class="chart-actions">
                            <select class="form-select form-select-sm" style="width: 120px;">
                                <option>Last 7 days</option>
                                <option>Last 30 days</option>
                                <option selected>All Time</option>
                            </select>
                        </div>
                    </div>
                    <div class="chart-wrapper">
                        <canvas id="ratingChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Mobile menu toggle (same as dashboard)
        const mobileToggle = document.getElementById('mobileToggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const mainContent = document.getElementById('mainContent');

        mobileToggle.addEventListener('click', function() {
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        });

        overlay.addEventListener('click', function() {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });

        // Navigation link active state
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Auto-hide sidebar on mobile when clicking nav links
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                }
            });
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            }
        });

        // Chart.js Implementation
        document.addEventListener('DOMContentLoaded', function() {
            // Category Pie Chart
            const categoryCtx = document.getElementById('categoryChart').getContext('2d');
            const categoryChart = new Chart(categoryCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Product', 'Service', 'Support', 'Complaint', 'Suggestion'],
                    datasets: [{
                        data: [35, 25, 20, 15, 5],
                        backgroundColor: [
                            'rgba(59, 130, 246, 0.8)',
                            'rgba(16, 185, 129, 0.8)',
                            'rgba(245, 158, 11, 0.8)',
                            'rgba(239, 68, 68, 0.8)',
                            'rgba(139, 92, 246, 0.8)'
                        ],
                        borderColor: [
                            'rgba(59, 130, 246, 1)',
                            'rgba(16, 185, 129, 1)',
                            'rgba(245, 158, 11, 1)',
                            'rgba(239, 68, 68, 1)',
                            'rgba(139, 92, 246, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = Math.round((value / total) * 100);
                                    return `${label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    },
                    cutout: '70%'
                }
            });

            // Sentiment Pie Chart
            const sentimentCtx = document.getElementById('sentimentChart').getContext('2d');
            const sentimentChart = new Chart(sentimentCtx, {
                type: 'pie',
                data: {
                    labels: ['Positive', 'Neutral', 'Negative'],
                    datasets: [{
                        data: [65, 20, 15],
                        backgroundColor: [
                            'rgba(16, 185, 129, 0.8)',
                            'rgba(156, 163, 175, 0.8)',
                            'rgba(239, 68, 68, 0.8)'
                        ],
                        borderColor: [
                            'rgba(16, 185, 129, 1)',
                            'rgba(156, 163, 175, 1)',
                            'rgba(239, 68, 68, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                        }
                    }
                }
            });

            // Timeline Line Chart
            const timelineCtx = document.getElementById('timelineChart').getContext('2d');
            const timelineChart = new Chart(timelineCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    datasets: [{
                        label: 'Feedback Volume',
                        data: [65, 59, 80, 81, 56, 55, 40],
                        fill: true,
                        backgroundColor: 'rgba(79, 70, 229, 0.1)',
                        borderColor: 'rgba(79, 70, 229, 1)',
                        tension: 0.3,
                        borderWidth: 2,
                        pointBackgroundColor: 'rgba(79, 70, 229, 1)',
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

            // Response Time Bar Chart
            const responseCtx = document.getElementById('responseChart').getContext('2d');
            const responseChart = new Chart(responseCtx, {
                type: 'bar',
                data: {
                    labels: ['<1 hour', '1-4 hours', '4-12 hours', '12-24 hours', '>24 hours'],
                    datasets: [{
                        label: 'Response Times',
                        data: [12, 19, 15, 8, 3],
                        backgroundColor: 'rgba(59, 130, 246, 0.8)',
                        borderColor: 'rgba(59, 130, 246, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

            // Rating Distribution Bar Chart
            const ratingCtx = document.getElementById('ratingChart').getContext('2d');
            const ratingChart = new Chart(ratingCtx, {
                type: 'bar',
                data: {
                    labels: ['1 Star', '2 Stars', '3 Stars', '4 Stars', '5 Stars'],
                    datasets: [{
                        label: 'Ratings',
                        data: [5, 10, 25, 40, 20],
                        backgroundColor: [
                            'rgba(239, 68, 68, 0.8)',
                            'rgba(245, 158, 11, 0.8)',
                            'rgba(234, 179, 8, 0.8)',
                            'rgba(59, 130, 246, 0.8)',
                            'rgba(16, 185, 129, 0.8)'
                        ],
                        borderColor: [
                            'rgba(239, 68, 68, 1)',
                            'rgba(245, 158, 11, 1)',
                            'rgba(234, 179, 8, 1)',
                            'rgba(59, 130, 246, 1)',
                            'rgba(16, 185, 129, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

            // Make charts responsive on window resize
            window.addEventListener('resize', function() {
                categoryChart.resize();
                sentimentChart.resize();
                timelineChart.resize();
                responseChart.resize();
                ratingChart.resize();
            });
        });
    </script>
</body>
</html>