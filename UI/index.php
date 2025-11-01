<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Skill Swap - Learn and Teach Skills</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="../css/index.css?v=<?php echo time(); ?>" />
</head>

<body>
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
                <a href="#" class="active">Home</a>
                <a href="collaborator.html">Collaborators</a>
                <a href="howToJoin.html">How to Join</a>
                <a href="about.html">About</a>
                <a href="contact&Support.html">Contact & Support</a>
            </div>


            <div class="auth-buttons">
                <?php if (isset($_SESSION['userid'])): ?>
                    <div class="user-profile">
                        <img src="../<?php echo !empty($_SESSION['profile_photo']) ? $_SESSION['profile_photo'] : 'assets/default-avatar.png'; ?>"
                            alt="Profile" class="profile-icon" id="profileIcon">
                        <div class="dropdown" id="dropdownMenu">
                            <ul>
                                <li><a href="userProfile.php">My Profile</a></li>
                                <li><a href="../api/userLogout.php">Logout</a></li>
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

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">
                    Learn New Skills. Teach What You Know.
                </h1>
                <p class="hero-subtitle">
                    Join us for exchanging knowledge in our global
                    community. Master new abilities while sharing your
                    expertise with others.
                </p>

                <?php if (isset($_SESSION['userid'])): ?>
                    <div class="hero-buttons">
                        <a href="collaborator.html" class="hero-btn hero-btn-primary">Start Learning</a>
                        <a href="userProfile.php" class="hero-btn hero-btn-secondary">My Profile</a>
                    </div>
                <?php else: ?>
                    <div class="hero-buttons">
                        <a href="collaborator.html" class="hero-btn hero-btn-primary">Start Learning</a>
                        <a href="userRegistration.html" class="hero-btn hero-btn-secondary">Become a Teacher</a>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">Why Choose Skill Swap?</h2>
            <p class="section-subtitle">
                Discover the unique advantages of learning and teaching
                through our innovative platform
            </p>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3>Skill Exchange</h3>
                    <p>
                        Trade your expertise for new knowledge without
                        financial barriers. Teach what you know, learn what
                        you don't.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-globe"></i>
                    </div>
                    <h3>Global Community</h3>
                    <p>
                        Connect with learners and teachers from around the
                        world. Gain diverse perspectives and cultural
                        insights.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <h3>Verified Experts</h3>
                    <p>
                        All teachers are verified for their skills and
                        expertise. Learn with confidence from qualified
                        instructors.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Skills Section -->
    <section class="section skills-section">
        <div class="container">
            <h2 class="section-title">Popular Skills Right Now</h2>
            <p class="section-subtitle">
                Discover the most in-demand skills being taught and learned
                on our platform
            </p>

            <div class="slider-container">
                <div class="skills-slider" id="skillsSlider">
                    <!-- Skill cards will be dynamically added -->
                </div>
            </div>

            <div class="slider-controls">
                <button class="slider-btn" id="prevBtn">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="slider-btn" id="nextBtn">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">How Skill Swap Works</h2>
            <p class="section-subtitle">
                Getting started is simple. Follow these steps to begin your
                skill exchange journey
            </p>

            <div class="steps-container">
                <div class="step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h3>Create Your Profile</h3>
                        <p>
                            Sign up and build your profile. List the skills
                            you can teach and what you'd like to learn.
                        </p>
                    </div>
                </div>

                <div class="step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h3>Find Your Match</h3>
                        <p>
                            Browse our community to find people with
                            complementary skills. Use filters to find
                            perfect matches.
                        </p>
                    </div>
                </div>

                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h3>Schedule Sessions</h3>
                        <p>
                            Use our booking system to schedule learning
                            sessions at times that work for both parties.
                        </p>
                    </div>
                </div>

                <div class="step">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <h3>Learn & Grow</h3>
                        <p>
                            Conduct sessions, track progress, and build
                            meaningful educational relationships.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="section testimonials-section">
        <div class="container">
            <h2 class="section-title">Success Stories</h2>
            <p class="section-subtitle">
                Hear from our community members about their Skill Swap
                experiences
            </p>

            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="testimonial-text">
                        "I've learned web development while teaching guitar
                        lessons. In just 3 months, I built my first website
                        and have 5 regular guitar students!"
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">MJ</div>
                        <div class="author-info">
                            <h4>Maria Johnson</h4>
                            <p>Web Developer & Guitar Teacher</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="testimonial-text">
                        "As a Spanish teacher, I've been able to learn data
                        analysis skills. Skill Swap helped me transition
                        into a new career while doing what I love."
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">CR</div>
                        <div class="author-info">
                            <h4>Carlos Rodriguez</h4>
                            <p>Spanish Teacher & Data Analyst</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="testimonial-text">
                        "The platform connected me with amazing teachers.
                        I've improved my cooking skills while teaching
                        photography. It's been life-changing!"
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">SW</div>
                        <div class="author-info">
                            <h4>Sarah Williams</h4>
                            <p>Photographer & Home Cook</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2 class="cta-title">
                Ready to Start Your Skill Swap Journey?
            </h2>
            <p class="cta-subtitle">
                Join thousands of learners and teachers who are already
                exchanging knowledge and growing together.
            </p>
            <a href="userRegistration.html" class="btn hero-btn-primary">Create Your Account Today</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-column">
                    <h3>Skill Swap</h3>
                    <ul class="footer-links">
                        <li><a href="about.html">About Us</a></li>
                        <li>
                            <a href="contact&Support.html">Contact & Support</a>
                        </li>
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
                &copy; 2025 Skill Swap India. All rights reserved.
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function () {

            const $skillsSlider = $("#skillsSlider");
            const $prevBtn = $("#prevBtn");
            const $nextBtn = $("#nextBtn");

            let currentSlide = 0;
            const slidesToShow = 3;

            // -------------------- LOAD SKILLS (AJAX) --------------------
            function loadSkills() {
                $.ajax({
                    url: "../api/allSkills.php",
                    type: "GET",
                    dataType: "json",
                    success: function (response) {
                        if (response.status === "success") {
                            const skills = response.data;
                            $skillsSlider.empty();

                            skills.forEach((skill) => {
                                const profileImg = skill.profile_photo && skill.profile_photo !== ''
                                    ? `<img src="${skill.profile_photo}" alt="${skill.full_name}" class="teacher-avatar">`
                                    : `<div class="teacher-avatar default-avatar">${skill.full_name.charAt(0).toUpperCase()}</div>`;

                                const card = `
                                                <div class="skill-card">
                                                    <div class="skill-teacher">
                                                        ${profileImg}
                                                        <div class="teacher-info">
                                                            <h4>${skill.full_name}</h4>
                                                            <p>Role: ${skill.role}</p>
                                                        </div>
                                                    </div>
                                                    <div class="skill-info">
                                                        <h3 class="skill-title">${skill.skill_name}</h3>
                                                    </div>
                                                    <div class="skill-actions">
                                                        <button class="btn-request" data-id="${skill.id}">Request</button>
                                                        <button class="btn-view" data-id="${skill.id}">View Details</button>
                                                    </div>
                                                </div>
                                            `;
                                $skillsSlider.append(card);
                            });

                            updateSlider();
                        } else {
                            $skillsSlider.html("<p>No skills found.</p>");
                        }
                    },
                    error: function () {
                        alert("Failed to load skills!");
                    }
                });
            }

            // -------------------- SLIDER FUNCTIONALITY --------------------
            function updateSlider() {
                const cardWidth = 280 + 20; // card width + gap
                const translateX = -currentSlide * cardWidth;
                $skillsSlider.css("transform", `translateX(${translateX}px)`);
            }

            $prevBtn.on("click", function () {
                if (currentSlide > 0) {
                    currentSlide--;
                    updateSlider();
                }
            });

            $nextBtn.on("click", function () {
                const totalCards = $(".skill-card").length;
                if (currentSlide < totalCards - slidesToShow) {
                    currentSlide++;
                    updateSlider();
                }
            });

            // -------------------- INITIAL LOAD --------------------
            loadSkills();

            // -------------------- HANDLE REQUEST BUTTON --------------------
            $(document).on("click", ".btn-request", function () {
                const skillId = $(this).data("id");
                const userId = 1;

                $.ajax({
                    url: "backend/skill_request.php",
                    type: "POST",
                    data: { skill_id: skillId, user_id: userId },
                    dataType: "json",
                    success: function (response) {
                        alert(response.message);
                    },
                    error: function () {
                        alert("Request failed!");
                    }
                });
            });

            // -------------------- HANDLE VIEW DETAILS BUTTON --------------------
            $(document).on("click", ".btn-view", function () {
                const skillId = $(this).data("id");

                window.location.href = `viewDetails.php?skill_id=${skillId}`;
            });

            // -------------------- PROFILE DROPDOWN --------------------
            const $profileIcon = $("#profileIcon");
            const $dropdownMenu = $("#dropdownMenu");

            if ($profileIcon.length && $dropdownMenu.length) {
                $profileIcon.on("click", function (e) {
                    e.stopPropagation();
                    $dropdownMenu.toggleClass("active");
                });

                $(document).on("click", function (e) {
                    if (!$(e.target).closest("#dropdownMenu, #profileIcon").length) {
                        $dropdownMenu.removeClass("active");
                    }
                });
            }

            // -------------------- MOBILE MENU TOGGLE --------------------
            const $mobileMenu = $(".mobile-menu");
            const $navLinks = $(".nav-links");
            const $authButtons = $(".auth-buttons");

            $mobileMenu.on("click", function () {
                const isVisible = $navLinks.css("display") === "flex";
                $navLinks.css("display", isVisible ? "none" : "flex");
                $authButtons.css("display", isVisible ? "none" : "flex");

                if (!isVisible) {
                    $navLinks.css({
                        flexDirection: "column",
                        position: "absolute",
                        top: "70px",
                        left: "0",
                        right: "0",
                        backgroundColor: "var(--card)",
                        padding: "20px",
                        boxShadow: "0 5px 10px rgba(0,0,0,0.1)",
                    });
                    $authButtons.css({
                        flexDirection: "column",
                        position: "absolute",
                        top: "250px",
                        left: "0",
                        right: "0",
                        backgroundColor: "var(--card)",
                        padding: "20px",
                    });
                }
            });

        });
    </script>

</body>

</html>