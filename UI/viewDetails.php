<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Skill Details - Skill Swap</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        :root {
            --primary: #6366f1;
            --primary-light: #e0e7ff;
            --accent: #10b981;
            --accent-light: #d1fae5;
            --highlight: #fbbf24;
            --background: #f8fafc;
            --card: #ffffff;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --error: #ef4444;
            --success: #22c55e;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--background);
            color: var(--text-primary);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        .header {
            background-color: var(--card);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg,
                    var(--primary) 0%,
                    var(--accent) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .nav-links {
            display: flex;
            gap: 30px;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-secondary);
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: var(--primary);
        }

        .auth-buttons {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            border: none;
        }

        .btn-outline {
            background-color: transparent;
            border: 1.5px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline:hover {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary {
            background: linear-gradient(135deg,
                    var(--primary) 0%,
                    var(--accent) 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(99, 102, 241, 0.4);
        }

        .mobile-menu {
            display: none;
            font-size: 1.5rem;
            color: var(--text-primary);
            cursor: pointer;
        }

        /* 🔹 USER PROFILE SECTION */
        .user-profile {
            position: relative;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* 🔹 Profile image styling — fixed circular size */
        .profile-icon {
            width: 38px;
            height: 38px;
            min-width: 38px;
            min-height: 38px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary);
            transition: transform 0.3s ease, border-color 0.3s ease;
            flex-shrink: 0;
            /* prevents shrinking in flex layouts */
        }

        .profile-icon:hover {
            transform: scale(1.05);
            border-color: var(--primary-hover);
        }

        /* 🔹 Dropdown box styling (hidden by default) */
        .user-profile .dropdown {
            position: absolute;
            top: 52px;
            right: 0;
            background: var(--card);
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            display: none;
            z-index: 999;
            min-width: 160px;
            opacity: 0;
            transform: translateY(-5px);
            transition: all 0.25s ease;
        }

        /* 🔹 Dropdown visible when active (click toggle) */
        .user-profile .dropdown.active {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

        /* 🔹 Dropdown list styling */
        .user-profile .dropdown ul {
            list-style: none;
            margin: 0;
            padding: 8px 0;
        }

        .user-profile .dropdown ul li a {
            display: block;
            padding: 10px 18px;
            color: var(--text-secondary);
            text-decoration: none;
            transition: background 0.3s, color 0.3s;
        }

        .user-profile .dropdown ul li a:hover {
            background: rgba(0, 0, 0, 0.05);
            color: var(--primary);
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .mobile-menu {
                display: block;
            }

            .auth-buttons {
                display: none;
            }

            .user-profile .dropdown {
                right: 10px;
                top: 45px;
            }
        }

        /* Breadcrumb */
        .breadcrumb {
            padding: 20px 0;
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .breadcrumb a {
            color: var(--text-secondary);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .breadcrumb a:hover {
            color: var(--primary);
        }

        /* Skill Details Layout */
        .skill-details-container {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 30px;
            margin: 30px 0;
        }

        /* Skill Overview */
        .skill-overview {
            background-color: var(--card);
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .skill-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .skill-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .skill-meta {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .skill-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .badge-category {
            background-color: var(--primary-light);
            color: var(--primary);
        }

        .badge-level {
            background-color: var(--accent-light);
            color: var(--accent);
        }

        .skill-description {
            color: var(--text-secondary);
            line-height: 1.7;
            margin-bottom: 25px;
        }

        .skill-details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 25px;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .detail-label {
            font-size: 0.8rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .detail-value {
            font-weight: 600;
        }

        /* Teacher Info Card */
        .teacher-card {
            background-color: var(--card);
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            text-align: center;
        }

        .teacher-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg,
                    var(--primary) 0%,
                    var(--accent) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            font-weight: 600;
            margin: 0 auto 15px;
        }

        .teacher-avatar img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .teacher-name {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .teacher-role {
            color: var(--primary);
            font-weight: 500;
            margin-bottom: 10px;
        }

        .teacher-location {
            color: var(--text-secondary);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .teacher-rating {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            margin-bottom: 15px;
        }

        .rating-stars {
            color: var(--highlight);
        }

        .rating-value {
            font-weight: 600;
        }

        .learners-count {
            color: var(--text-secondary);
            font-size: 0.9rem;
            margin-bottom: 20px;
        }

        /* Actions Card */
        .actions-card {
            background-color: var(--card);
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            text-align: center;
        }

        .actions-card h3 {
            font-size: 1.2rem;
            margin-bottom: 20px;
            color: var(--text-primary);
        }

        .request-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg,
                    var(--primary) 0%,
                    var(--accent) 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 15px;
        }

        .request-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(99, 102, 241, 0.4);
        }

        .back-btn {
            width: 100%;
            padding: 12px;
            background-color: transparent;
            border: 1.5px solid var(--text-secondary);
            color: var(--text-secondary);
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .back-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        /* Success/Error Messages */
        .message {
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
            text-align: center;
            font-weight: 500;
            display: none;
        }

        .success-message {
            background-color: var(--accent-light);
            color: var(--success);
        }

        .error-message {
            background-color: #fee2e2;
            color: var(--error);
        }

        /* Footer */
        .footer {
            background-color: var(--text-primary);
            color: white;
            padding: 60px 0 30px;
            margin-top: 60px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-column h3 {
            font-size: 1.2rem;
            margin-bottom: 20px;
            color: white;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: #94a3b8;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: white;
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-link {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: #334155;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            background-color: var(--primary);
            transform: translateY(-2px);
        }

        .copyright {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid #334155;
            color: #94a3b8;
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 768px) {

            .nav-links,
            .auth-buttons {
                display: none;
            }

            .mobile-menu {
                display: block;
            }

            .skill-details-container {
                grid-template-columns: 1fr;
            }

            .skill-header {
                flex-direction: column;
                gap: 15px;
            }

            .skill-title {
                font-size: 1.7rem;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <!-- Header -->
    <header class="header">
        <div class="container nav-container">
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-exchange-alt"></i>
                </div>
                <div class="logo-text">Skill Swap India</div>
            </div>

            <div class="nav-links">
                <a href="#">Home</a>
                <a href="collaborator.html">Collaborators</a>
                <a href="howToJoin.html">How to Join</a>
                <a href="about.html">About</a>
                <a href="contact&Support.html">Contact & Support</a>
            </div>

            <div class="auth-buttons">
                <?php if (isset($_SESSION['userid'])): ?>
                    <div class="user-profile">
                        <img src="../<?php echo !empty($_SESSION['profile_photo']) ? $_SESSION['profile_photo'] : 'assets/default-avatar.png'; ?>"
                            alt="Profile" class="profile-icon" id="profileIcon" />
                        <div class="dropdown" id="dropdownMenu">
                            <ul>
                                <li>
                                    <a href="userProfile.php">My Profile</a>
                                </li>
                                <li>
                                    <a href="../api/userLogout.php">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="userLogin.html" class="btn btn-outline">Log In</a>
                    <a href="userRegistration.html" class="btn btn-primary">Sign Up</a>
                <?php endif; ?>
            </div>

            <div class="mobile-menu">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </header>

    <!-- Breadcrumb -->
    <div class="container">
        <div class="breadcrumb">
            <a href="index.php">Home</a>
            <i class="fas fa-chevron-right"></i>
            <a href="./explore.html">Explore Skills</a>
            <i class="fas fa-chevron-right"></i>
            <span id="currPath">Web Development</span>
        </div>
    </div>

    <!-- Skill Details -->
    <div class="container">
        <div class="skill-details-container">
            <!-- Main Content -->
            <div class="main-content">
                <!-- Skill Overview -->
                <div class="skill-overview">
                    <div class="skill-header">
                        <div>
                            <h1 class="skill-title" id="skillName">
                                Web Development
                            </h1>
                            <div class="skill-meta">
                                <span class="skill-badge badge-category" id="skillCategory">Technology</span>
                                <span class="skill-badge badge-level" id="skillLevel">Intermediate</span>
                            </div>
                        </div>
                    </div>

                    <p class="skill-description" id="skillDescription">
                        Learn how to build modern, responsive websites and
                        web applications using the latest technologies. This
                        course covers HTML, CSS, JavaScript, and React
                        fundamentals. You'll work on real-world projects and
                        build a portfolio to showcase your skills to
                        potential employers or clients.
                    </p>

                    <div class="skill-details-grid">
                        <div class="detail-item">
                            <span class="detail-label">Preferred Mode</span>
                            <span class="detail-value" id="preferredMode">Online</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Availability</span>
                            <span class="detail-value" id="availability">Weekends, 6-9 PM</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Posted On</span>
                            <span class="detail-value" id="postedOn">15 Oct 2023</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Duration</span>
                            <span class="detail-value">8 weeks</span>
                        </div>
                    </div>
                </div>



            </div>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Teacher Info -->
                <div class="teacher-card">
                    <div class="teacher-avatar" id="teacherAvatar">AJ</div>
                    <h2 class="teacher-name" id="teacherName">
                        Alex Johnson
                    </h2>
                    <div class="teacher-role" id="teacherRole">
                        Senior Web Developer
                    </div>
                    <div class="teacher-location">
                        <i class="fas fa-map-marker-alt"></i>
                        <span id="teacherLocation">San Francisco, USA</span>
                    </div>
                    <div class="teacher-rating">
                        <div class="rating-stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="rating-value">4.7</span>
                    </div>
                    <div class="learners-count">Taught 124 learners</div>
                    <a href="#" class="btn btn-outline">View Profile</a>
                </div>

                <!-- Actions -->
                <div class="actions-card">
                    <h3>Interested in this skill?</h3>
                    <button class="request-btn" id="requestBtn">
                        <i class="fas fa-handshake"></i> Request Collaboration
                    </button>
                    <a href="./explore.html" class="back-btn">
                        <i class="fas fa-arrow-left"></i> Back to Explore
                    </a>

                    <div class="message success-message" id="successMessage">
                        <i class="fas fa-check-circle"></i> Your request has
                        been sent successfully!
                    </div>

                    <div class="message error-message" id="errorMessage">
                        <i class="fas fa-exclamation-circle"></i> There was
                        an error sending your request.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-column">
                    <h3>Skill Swap</h3>
                    <ul class="footer-links">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Our Mission</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Press</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h3>Resources</h3>
                    <ul class="footer-links">
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Community Guidelines</a></li>
                        <li><a href="#">Safety Tips</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h3>Legal</h3>
                    <ul class="footer-links">
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Cookie Policy</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h3>Connect</h3>
                    <ul class="footer-links">
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">Instagram</a></li>
                        <li><a href="#">Facebook</a></li>
                    </ul>
                    <div class="social-links">
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>

            <div class="copyright">
                &copy; 2023 Skill Swap. All rights reserved.
            </div>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function () {
            // -------------------- PROFILE DROPDOWN --------------------
            const $profileIcon = $('#profileIcon');
            const $dropdownMenu = $('#dropdownMenu');

            if ($profileIcon.length && $dropdownMenu.length) {
                $profileIcon.on('click', function (e) {
                    e.stopPropagation();
                    $dropdownMenu.toggleClass('active');
                });

                $(document).on('click', function (e) {
                    if (
                        !$(e.target).closest('#dropdownMenu, #profileIcon')
                            .length
                    ) {
                        $dropdownMenu.removeClass('active');
                    }
                });
            }

            // -------------------- MOBILE MENU TOGGLE --------------------
            const $mobileMenu = $('.mobile-menu');
            const $navLinks = $('.nav-links');
            const $authButtons = $('.auth-buttons');

            $mobileMenu.on('click', function () {
                const isVisible = $navLinks.css('display') === 'flex';
                $navLinks.css('display', isVisible ? 'none' : 'flex');
                $authButtons.css('display', isVisible ? 'none' : 'flex');

                if (!isVisible) {
                    $navLinks.css({
                        flexDirection: 'column',
                        position: 'absolute',
                        top: '70px',
                        left: '0',
                        right: '0',
                        backgroundColor: 'var(--card)',
                        padding: '20px',
                        boxShadow: '0 5px 10px rgba(0,0,0,0.1)',
                    });
                    $authButtons.css({
                        flexDirection: 'column',
                        position: 'absolute',
                        top: '250px',
                        left: '0',
                        right: '0',
                        backgroundColor: 'var(--card)',
                        padding: '20px',
                    });
                }
            });

            // -------------------- LOAD DATA --------------------

            // Get skill_id from URL
            const urlParams = new URLSearchParams(window.location.search);
            const skillId = urlParams.get('skill_id');
            console.log('Skill ID:', skillId);

            if (!skillId) return;

            // Load skill details
            $.ajax({
                url: '../api/skill_details.php',
                type: 'GET',
                data: { skill_id: skillId },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        const skill = response.data;

                        // Populate main content
                        $('#skillName').text(skill.skill_name);
                        $('#skillLevel').text(skill.skill_level);
                        $('#skillDescription').text(skill.description);
                        $('#preferredMode').text(skill.preferred_mode);
                        $('#availability').text(skill.availability);
                        $('#postedOn').text(skill.posted_on);



                        // Populate sidebar / teacher info
                        $('#teacherName').text(skill.full_name);
                        $('#teacherRole').text(skill.role);
                        $('#teacherLocation').text(skill.city + ', ' + skill.country);

                        // UPDATE Breadcrumb
                        $('#currPath').text(skill.skill_name);

                        // Profile photo or initials
                        const avatarEl = $('#teacherAvatar');
                        if (skill.profile_photo && skill.profile_photo !== '') {
                            avatarEl.html(`<img src="../${skill.profile_photo}" alt="${skill.full_name}" style="width:100%;height:100%;border-radius:50%;">`);
                        } else {
                            const initials = skill.full_name.charAt(0).toUpperCase();
                            avatarEl.text(initials);
                        }
                    } else {
                        alert(response.message);
                    }
                },
                error: function () {
                    alert('Failed to load skill details.');
                }
            });

            // Handle Request button
            $('#requestBtn').on('click', function () {
                const userId = 1;
                $.ajax({
                    url: '../api/skill_request.php',
                    type: 'POST',
                    data: { skill_id: skillId, user_id: userId },
                    dataType: 'json',
                    success: function (resp) {
                        if (resp.status === 'success') {
                            $('#successMessage').fadeIn().delay(2000).fadeOut();
                        } else {
                            $('#errorMessage').fadeIn().delay(2000).fadeOut();
                        }
                    },
                    error: function () {
                        $('#errorMessage').fadeIn().delay(2000).fadeOut();
                    }
                });
            });


        });
    </script>
</body>

</html>