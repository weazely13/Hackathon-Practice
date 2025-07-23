<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedbacks | Feedback Tracker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom Dashboard CSS -->
    <link href="@vite(['resources/css/feedbacks.css'])" rel="stylesheet">
</head>
<body>
    <!-- Sidebar -->
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
                <a href="feedbacks.html" class="nav-link active">
                    <i class="bi bi-chat-left-text"></i>
                    Feedbacks
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('analytics') }}" class="nav-link">
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
                    <h6>{{ auth()->user()->name }}</h6>
                    <small>Business Owner</small>
                </div>
            </div>
            <button class="btn-logout">
                <i class="bi bi-box-arrow-right"></i>
                Logout
            </button>
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
            <h1 class="page-title">Customer Feedbacks</h1>
            <div class="page-actions">
                <button class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-funnel"></i> Filter
                </button>
                <button class="btn btn-primary btn-sm">
                    <i class="bi bi-download"></i> Export
                </button>
            </div>
        </div>

        <!-- Feedbacks Content -->
        <div class="feedbacks-content">
            <!-- Filter Bar -->
            <div class="filter-bar">
                <div class="filter-group">
                    <select class="form-select filter-select">
                        <option value="">All Categories</option>
                        <option value="general">General</option>
                        <option value="product">Product</option>
                        <option value="service">Service</option>
                        <option value="support">Support</option>
                        <option value="complaint">Complaint</option>
                        <option value="suggestion">Suggestion</option>
                    </select>
                </div>
                <div class="filter-group">
                    <select class="form-select filter-select">
                        <option value="">All Ratings</option>
                        <option value="5">5 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="2">2 Stars</option>
                        <option value="1">1 Star</option>
                    </select>
                </div>
                <div class="filter-group">
                    <select class="form-select filter-select">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="responded">Responded</option>
                        <option value="resolved">Resolved</option>
                    </select>
                </div>
                <div class="search-group">
                    <input type="text" class="form-control search-input" placeholder="Search feedbacks...">
                    <i class="bi bi-search search-icon"></i>
                </div>
            </div>

            <!-- Stats Overview -->
            <div class="feedback-stats">
                <div class="stat-item">
                    <div class="stat-value">247</div>
                    <div class="stat-label">Total Feedbacks</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">18</div>
                    <div class="stat-label">Pending Response</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">4.7</div>
                    <div class="stat-label">Avg Rating</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">89%</div>
                    <div class="stat-label">Response Rate</div>
                </div>
            </div>

            <!-- Feedback Cards -->
            <div class="feedback-list">
                <!-- Feedback Item 1 -->
                <div class="feedback-card">
                    <div class="feedback-header">
                        <div class="customer-info">
                            <div class="customer-avatar">MR</div>
                            <div class="customer-details">
                                <h6 class="customer-name">Maya Rodriguez</h6>
                                <span class="feedback-date">
                                    <i class="bi bi-clock"></i> 2 hours ago
                                </span>
                            </div>
                        </div>
                        <div class="feedback-meta">
                            <span class="category-badge product">Product</span>
                            <div class="rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <span class="rating-text">5.0</span>
                            </div>
                            <div class="status-badge pending">Pending</div>
                        </div>
                    </div>
                    
                    <div class="feedback-content">
                        <p class="feedback-text">
                            Absolutely love the new features! The interface is so intuitive and the performance has improved significantly. Really impressed with the quality and attention to detail.
                        </p>
                        <div class="feedback-image">
                            <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=400&h=250&fit=crop" alt="Product screenshot" class="attached-image">
                        </div>
                    </div>
                    
                    <div class="feedback-actions">
                        <button class="btn btn-primary btn-sm reply-btn">
                            <i class="bi bi-reply"></i> Reply
                        </button>
                        <button class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-bookmark"></i> Save
                        </button>
                        <button class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-three-dots"></i>
                        </button>
                    </div>
                    
                    <div class="reply-form" style="display: none;">
                        <div class="reply-input-group">
                            <textarea class="form-control reply-textarea" placeholder="Write your response..." rows="3"></textarea>
                            <div class="reply-actions">
                                <button class="btn btn-sm btn-outline-secondary">Cancel</button>
                                <button class="btn btn-sm btn-primary">Send Reply</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feedback Item 2 -->
                <div class="feedback-card">
                    <div class="feedback-header">
                        <div class="customer-info">
                            <div class="customer-avatar">JD</div>
                            <div class="customer-details">
                                <h6 class="customer-name">Jackson Davis</h6>
                                <span class="feedback-date">
                                    <i class="bi bi-clock"></i> 5 hours ago
                                </span>
                            </div>
                        </div>
                        <div class="feedback-meta">
                            <span class="category-badge service">Service</span>
                            <div class="rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star"></i>
                                <span class="rating-text">4.0</span>
                            </div>
                            <div class="status-badge responded">Responded</div>
                        </div>
                    </div>
                    
                    <div class="feedback-content">
                        <p class="feedback-text">
                            Great customer service experience! The team was very helpful and resolved my issue quickly. However, I think the response time could be improved during peak hours.
                        </p>
                    </div>
                    
                    <div class="business-response">
                        <div class="response-header">
                            <div class="business-avatar">AJ</div>
                            <div class="response-info">
                                <span class="business-name">Alex Johnson (Owner)</span>
                                <span class="response-date">3 hours ago</span>
                            </div>
                        </div>
                        <p class="response-text">
                            Thank you for the feedback, Jackson! We're glad we could resolve your issue. We're actively working on reducing response times during peak hours. Your patience is appreciated!
                        </p>
                    </div>
                    
                    <div class="feedback-actions">
                        <button class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-chat-dots"></i> Follow Up
                        </button>
                        <button class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-bookmark-fill"></i> Saved
                        </button>
                        <button class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-three-dots"></i>
                        </button>
                    </div>
                </div>

                <!-- Feedback Item 3 -->
                <div class="feedback-card">
                    <div class="feedback-header">
                        <div class="customer-info">
                            <div class="customer-avatar">SK</div>
                            <div class="customer-details">
                                <h6 class="customer-name">Sarah Kim</h6>
                                <span class="feedback-date">
                                    <i class="bi bi-clock"></i> 1 day ago
                                </span>
                            </div>
                        </div>
                        <div class="feedback-meta">
                            <span class="category-badge complaint">Complaint</span>
                            <div class="rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star"></i>
                                <i class="bi bi-star"></i>
                                <i class="bi bi-star"></i>
                                <span class="rating-text">2.0</span>
                            </div>
                            <div class="status-badge pending">Pending</div>
                        </div>
                    </div>
                    
                    <div class="feedback-content">
                        <p class="feedback-text">
                            I encountered several bugs in the latest update. The app crashes frequently when I try to upload images, and some features are not working as expected. Please fix these issues soon.
                        </p>
                        <div class="feedback-image">
                            <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=400&h=250&fit=crop" alt="Error screenshot" class="attached-image">
                        </div>
                    </div>
                    
                    <div class="feedback-actions">
                        <button class="btn btn-danger btn-sm reply-btn priority">
                            <i class="bi bi-exclamation-triangle"></i> Priority Reply
                        </button>
                        <button class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-bookmark"></i> Save
                        </button>
                        <button class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-three-dots"></i>
                        </button>
                    </div>
                    
                    <div class="reply-form" style="display: none;">
                        <div class="reply-input-group">
                            <textarea class="form-control reply-textarea" placeholder="Write your response..." rows="3"></textarea>
                            <div class="reply-actions">
                                <button class="btn btn-sm btn-outline-secondary">Cancel</button>
                                <button class="btn btn-sm btn-danger">Send Reply</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feedback Item 4 -->
                <div class="feedback-card">
                    <div class="feedback-header">
                        <div class="customer-info">
                            <div class="customer-avatar">TW</div>
                            <div class="customer-details">
                                <h6 class="customer-name">Tyler Wilson</h6>
                                <span class="feedback-date">
                                    <i class="bi bi-clock"></i> 2 days ago
                                </span>
                            </div>
                        </div>
                        <div class="feedback-meta">
                            <span class="category-badge suggestion">Suggestion</span>
                            <div class="rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star"></i>
                                <span class="rating-text">4.0</span>
                            </div>
                            <div class="status-badge resolved">Resolved</div>
                        </div>
                    </div>
                    
                    <div class="feedback-content">
                        <p class="feedback-text">
                            Would be great to have a dark mode option! Many users prefer it, especially for extended usage periods. Overall, loving the platform and its capabilities.
                        </p>
                    </div>
                    
                    <div class="business-response">
                        <div class="response-header">
                            <div class="business-avatar">AJ</div>
                            <div class="response-info">
                                <span class="business-name">Alex Johnson (Owner)</span>
                                <span class="response-date">1 day ago</span>
                            </div>
                        </div>
                        <p class="response-text">
                            Excellent suggestion, Tyler! Dark mode is actually in our development pipeline and should be available in the next major update. Thanks for the feedback!
                        </p>
                    </div>
                    
                    <div class="feedback-actions">
                        <button class="btn btn-success btn-sm">
                            <i class="bi bi-check-circle"></i> Resolved
                        </button>
                        <button class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-bookmark"></i> Save
                        </button>
                        <button class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-three-dots"></i>
                        </button>
                    </div>
                </div>

                <!-- Feedback Item 5 -->
                <div class="feedback-card">
                    <div class="feedback-header">
                        <div class="customer-info">
                            <div class="customer-avatar">EP</div>
                            <div class="customer-details">
                                <h6 class="customer-name">Emma Parker</h6>
                                <span class="feedback-date">
                                    <i class="bi bi-clock"></i> 3 days ago
                                </span>
                            </div>
                        </div>
                        <div class="feedback-meta">
                            <span class="category-badge support">Support</span>
                            <div class="rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <span class="rating-text">5.0</span>
                            </div>
                            <div class="status-badge responded">Responded</div>
                        </div>
                    </div>
                    
                    <div class="feedback-content">
                        <p class="feedback-text">
                            Outstanding support team! They helped me migrate all my data seamlessly and were available throughout the entire process. Couldn't ask for better service!
                        </p>
                        <div class="feedback-image">
                            <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?w=400&h=250&fit=crop" alt="Success screenshot" class="attached-image">
                        </div>
                    </div>
                    
                    <div class="business-response">
                        <div class="response-header">
                            <div class="business-avatar">AJ</div>
                            <div class="response-info">
                                <span class="business-name">Alex Johnson (Owner)</span>
                                <span class="response-date">2 days ago</span>
                            </div>
                        </div>
                        <p class="response-text">
                            Emma, thank you so much for this wonderful review! Our support team works hard to ensure smooth migrations. We're thrilled that your experience exceeded expectations!
                        </p>
                    </div>
                    
                    <div class="feedback-actions">
                        <button class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-heart"></i> Thank
                        </button>
                        <button class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-bookmark-fill"></i> Saved
                        </button>
                        <button class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-three-dots"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Load More Button -->
            <div class="load-more-section">
                <button class="btn btn-outline-primary load-more-btn">
                    <i class="bi bi-arrow-down-circle"></i>
                    Load More Feedbacks
                </button>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>