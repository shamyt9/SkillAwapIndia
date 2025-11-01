<?php
session_start();


//  Check if user is logged in or not
if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {

    //  Prepare user data array from session
    $userData = [
        'userid' => $_SESSION['userid'],

        'username' => $_SESSION['username'],

        'created_at' =>
            $_SESSION['created_at']
    ];

} else {
    header('Location: userLogin.html');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Profile - Skill Swap</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <link rel="stylesheet" href="../css/userProfile.css" />
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-exchange-alt"></i>
                </div>
                <div class="logo-text">Skill Swap</div>
            </div>
            <div class="nav-links">
                <a href="#" class="active">Dashboard</a>
                <a href="#">Explore</a>
                <a href="#">Messages</a>
                <a href="./index.php">Back to Home</a>
            </div>
            <div class="user-menu">
                <div class="notification-icon">
                    <i class="fas fa-bell"></i>
                    <div class="notification-badge">3</div>
                </div>

            </div>
        </div>

        <!-- Dashboard -->
        <div class="dashboard">
            <!-- Sidebar -->
            <div class="sidebar">
                <div class="profile-card">
                    <div class="profile-avatar">

                        <div class="edit-avatar">
                            <i class="fas fa-camera"></i>
                        </div>
                    </div>

                    <div class="profile-name"></div>

                    <div class="profile-stats">

                        <div class="stat">
                            <div class="stat-value">0</div>
                            <div class="stat-label">Reviews</div>
                        </div>
                        <div class="stat">
                            <div class="stat-value">0</div>
                            <div class="stat-label">Rating</div>
                        </div>
                    </div>
                </div>
                <ul class="sidebar-menu">
                    <li>
                        <a href="#" class="active"><i class="fas fa-user"></i> Profile</a>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-cog"></i> Settings</a>
                    </li>


                    <li>
                        <a href="#"><i class="fas fa-question-circle"></i> Help</a>
                    </li>
                    <li>
                        <a href="../api/userLogout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <!-- Profile Information -->
                <div class="card">
                    <div class="section-header">
                        <h2 class="section-title">Profile Information</h2>
                        <button class="edit-btn" id="editProfileBtn">
                            <i class="fas fa-edit"></i> Edit Profile
                        </button>
                    </div>
                    <div class="profile-info">
                        <div class="info-group">
                            <div class="info-label">Full Name</div>
                            <div class="info-value" id="nameInfo"></div>
                        </div>
                        <div class="info-group">
                            <div class="info-label">Username</div>
                            <div class="info-value"><?php echo htmlspecialchars($userData['username']); ?></div>
                        </div>
                        <div class="info-group">
                            <div class="info-label">Email</div>
                            <div class="info-value" id="emailInfo"></div>
                        </div>
                        <div class="info-group">
                            <div class="info-label">Phone</div>
                            <div class="info-value" id="phoneInfo"></div>
                        </div>
                        <div class="info-group">
                            <div class="info-label">Location</div>
                            <div class="info-value" id="locationInfo"></div>
                        </div>
                        <div class="info-group">
                            <div class="info-label">Member Since</div>
                            <div class="info-value">
                                <?php
                                $date = date("F Y", strtotime($userData['created_at']));
                                echo htmlspecialchars($date);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Skills Section -->
                <div class="card">
                    <div class="skills-header">
                        <h2 class="section-title">My Skills</h2>
                        <button class="add-skill-btn" id="addSkillBtn">
                            <i class="fas fa-plus"></i> Add New Skill
                        </button>
                    </div>
                    <div class="skills-grid" id="skillsGrid">
                        <!-- Skills will be dynamically loaded here -->
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div class="modal" id="profileModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Edit Profile</h2>
                <button class="close-modal">&times;</button>
            </div>
            <form id="profileForm">
                <input type="hidden" id="user_id" name="user_id"
                    value="<?php echo htmlspecialchars($userData['userid']); ?>" />

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Full Name</label>
                        <input type="text" id="full_name" name="full_name" class="form-input" value="" />
                    </div>

                </div>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-input" value="" />
                </div>

                <div class="form-group">
                    <label class="form-label">Phone</label>
                    <input type="tel" id="phone" name="phone" class="form-input" value="" />
                </div>

                <div class="form-group">
                    <label class="form-label">City</label>
                    <input type="text" id="city" name="city" class="form-input" value="" />
                </div>

                <div class="form-group">
                    <label class="form-label">Country</label>
                    <input type="text" id="country" name="country" class="form-input" value="" />
                </div>

                <div class="form-group">
                    <label class="form-label">Bio</label>
                    <textarea id="bio" name="bio" class="form-textarea"></textarea>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary close-modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>

        </div>
    </div>

    <!-- Add Skill Modal -->
    <div class="modal" id="skillModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Add New Skill</h2>
                <button class="close-modal">&times;</button>
            </div>
            <form id="skillForm">
                <input type="hidden" id="username" name="username"
                    value="<?php echo htmlspecialchars($userData['userid']); ?>" />

                <div class="form-group">
                    <label class="form-label" for="role">Role</label>
                    <select id="role" name="role" class="form-select" required>
                        <option value="">Select your role</option>
                        <option value="teacher">Teacher</option>
                        <option value="learner">Learner</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="skill_name">Skill Name</label>
                    <input type="text" id="skill_name" name="skill_name" class="form-input"
                        placeholder="e.g., Web Development, Guitar, Spanish" required />
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="skill_level">Skill Level</label>
                        <select id="skill_level" name="skill_level" class="form-select" required>
                            <option value="">Select level</option>
                            <option value="beginner">Beginner</option>
                            <option value="intermediate">Intermediate</option>
                            <option value="expert">Expert</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="preferred_mode">Preferred Mode</label>
                        <select id="preferred_mode" name="preferred_mode" class="form-select" required>
                            <option value="">Select mode</option>
                            <option value="online">Online</option>
                            <option value="in-person">In-person</option>
                            <option value="both">Both</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="availability">Availability</label>
                    <input type="text" id="availability" name="availability" class="form-input"
                        placeholder="e.g., Weekends, 6-9 PM" />
                </div>

                <div class="form-group">
                    <label class="form-label" for="description">Description</label>
                    <textarea id="description" name="description" class="form-textarea"
                        placeholder="Describe your skill, teaching style, or what you're looking to learn"></textarea>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary close-modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Skill</button>
                </div>
            </form>



        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function () {
            // ===== Global Variables =====
            const $profileModal = $('#profileModal');
            const $skillModal = $('#skillModal');
            const $profileForm = $('#profileForm');
            const $skillForm = $('#skillForm');
            const $skillsGrid = $('#skillsGrid');



            //! ===============================
            // LOAD Profile
            //!==================================
            loadProfile();

            function loadProfile() {
                const user_id = $('#user_id').val();

                $.ajax({
                    url: '../api/load_profile.php',
                    type: 'GET',
                    data: { userid: user_id },
                    dataType: 'json',
                    success: function (response) {
                        if (response.status === 'success') {
                            const user = response.data;

                            // form me value set hua hai

                            $('#full_name').val(user.full_name);

                            $('#email').val(user.email);
                            $('#phone').val(user.phone);
                            $('#city').val(user.city);
                            $('#country').val(user.country);
                            $('#bio').val(user.bio);

                            // Set profile info in divs
                            $('#nameInfo').text(user.full_name);
                            $('#emailInfo').text(user.email);
                            $('#phoneInfo').text(user.phone);
                            $('#locationInfo').text(user.city + ', ' + user.country);

                            // Profile avatar handling
                            const $avatarContainer = $('.profile-avatar');
                            $avatarContainer.find('.avatar-img, .default-avatar').remove();
                            if (user.profile_photo && user.profile_photo !== '') {
                                // Agar profile photo exist karta hai
                                $avatarContainer.prepend('<img src="../' + user.profile_photo + '" alt="Profile Photo" class="avatar-img">');
                            } else {
                                // Default avatar (first letter of full name)
                                const initials = user.full_name ? user.full_name.charAt(0).toUpperCase() : 'U';
                                $avatarContainer.prepend('<div class="default-avatar">' + initials + '</div>');
                            }
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function () {
                        alert('Failed to load profile!');
                    }
                });
            }



            // ===============================
            // 🔹 Helper Function: Modal Toggle
            // ===============================
            function toggleModal($modal, show = true) {
                if (show) $modal.fadeIn();
                else $modal.fadeOut();
            }

            // ===============================
            // 🔹 Open / Close Modal Handlers
            // ===============================
            $('#editProfileBtn').on('click', function () {
                toggleModal($profileModal, true);
            });

            $('#addSkillBtn').on('click', function () {
                // Reset form
                $skillForm.trigger('reset');
                $skillForm.removeData('edit-id'); // Add mode

                // Update modal title & button
                $skillModal.find('.modal-title').text('Add New Skill');
                $skillForm.find('button[type="submit"]').text('Add Skill');

                toggleModal($skillModal, true);
            });

            $('.close-modal').on('click', function () {
                toggleModal($profileModal, false);
                toggleModal($skillModal, false);
            });

            // Click outside to close
            $(window).on('click', function (e) {
                if ($(e.target).is($profileModal)) toggleModal($profileModal, false);
                if ($(e.target).is($skillModal)) toggleModal($skillModal, false);
            });

            // ===============================
            // 🔹 Profile Form Submit
            // ===============================
            $('#profileForm').on('submit', function (e) {
                e.preventDefault();

                const formData = {
                    user_id: $('#user_id').val(),
                    full_name: $('#full_name').val(),
                    username: $('#username').val(),
                    email: $('#email').val(),
                    phone: $('#phone').val(),
                    city: $('#city').val(),
                    country: $('#country').val(),
                    bio: $('#bio').val()
                };

                $.ajax({
                    url: '../api/update_profile.php',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status === 'success') {

                            alert('Profile updated successfully!');
                            loadProfile();

                            toggleModal($profileModal, false);
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function () {
                        alert('Server error! Please try again.');
                    }
                });
            });


            // ===============================
            // 🔹 Load Skills Function
            // ===============================
            function loadSkills() {
                $.ajax({
                    url: '../api/getSkills.php',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        username: $('#username').val()
                    },
                    success: function (skills) {
                        $skillsGrid.empty();
                        if (!skills.data || skills.data.length === 0) {
                            $skillsGrid.append('<p>No skills added yet.</p>');
                            return;
                        }
                        skills.data.forEach((skill) => {
                            const skillCard = `
                        <div class="skill-card" data-id="${skill.id}">
                            <div class="skill-header">
                                <div>
                                    <div class="skill-title">${skill.skill_name}</div>
                                    <span class="skill-role">${skill.role === 'teacher' ? 'Teacher' : 'Learner'}</span>
                                </div>
                            </div>
                            <div class="skill-meta">
                                <span class="skill-tag">${capitalize(skill.skill_level)}</span>
                                <span class="skill-tag">${capitalize(skill.preferred_mode)}</span>
                            </div>
                            <div class="skill-description">${skill.description || 'No description provided.'}</div>
                            <div class="skill-actions">
                                <button class="skill-action-btn edit-skill"><i class="fas fa-edit"></i> Edit</button>
                                <button class="skill-action-btn delete-skill"><i class="fas fa-trash"></i> Delete</button>
                            </div>
                        </div>
                    `;
                            $skillsGrid.append(skillCard);
                        });
                    },
                    error: function () {
                        alert('Error loading skills!');
                    }
                });
            }

            // Helper: Capitalize first letter
            function capitalize(str) {
                if (!str) return '';
                return str.charAt(0).toUpperCase() + str.slice(1);
            }

            // ===============================
            // 🔹 Delete Skill
            // ===============================
            $(document).on('click', '.delete-skill', function () {
                const $card = $(this).closest('.skill-card');
                const skillId = $card.data('id');
                const skillTitle = $card.find('.skill-title').text();

                if (confirm(`Are you sure you want to delete "${skillTitle}"?`)) {
                    $.ajax({
                        url: '../api/delete_skill.php',
                        type: 'POST',
                        data: { id: skillId },
                        success: function () {
                            alert('Skill deleted successfully!');
                            loadSkills();
                        },
                        error: function () {
                            alert('Error deleting skill!');
                        }
                    });
                }
            });

            // ===============================
            // 🔹 Edit Skill (open modal)
            // ===============================
            $(document).on('click', '.edit-skill', function () {
                const $card = $(this).closest('.skill-card');
                const skillId = $card.data('id');

                $.ajax({
                    url: '../api/get_skill_to_Update.php',
                    type: 'GET',
                    data: { id: skillId },
                    dataType: 'json',
                    success: function (skill) {
                        console.log(skill);
                        $('#role').val(skill.role);
                        $('#skill_name').val(skill.skill_name);
                        $('#skill_level').val(skill.skill_level);
                        $('#preferred_mode').val(skill.preferred_mode);
                        $('#availability').val(skill.availability);
                        $('#description').val(skill.description);


                        // Store edit ID
                        $skillForm.data('edit-id', skill.id);

                        // Update modal title & button
                        $skillModal.find('.modal-title').text('Edit Skill');
                        $skillForm.find('button[type="submit"]').text('Update Skill');

                        toggleModal($skillModal, true);
                    },
                    error: function () {
                        alert('Failed to fetch skill details!');
                    }
                });
            });

            // ===============================
            // 🔹 Submit Skill Form (Add / Update)
            // ===============================
            $skillForm.on('submit', function (e) {
                e.preventDefault();

                const editId = $skillForm.data('edit-id');

                // Form values
                const role = $skillForm.find('select').eq(0).val();
                const skillName = $skillForm.find("input[type='text']").eq(0).val().trim();
                const skillLevel = $skillForm.find('select').eq(1).val();
                const preferredMode = $skillForm.find('select').eq(2).val();
                const availability = $skillForm.find("input[type='text']").eq(1).val().trim();
                const description = $skillForm.find('textarea').val().trim();
                const username = $('#username').val();

                // Validation
                if (!role || !skillName || !skillLevel || !preferredMode) {
                    alert('Please fill all required fields!');
                    return;
                }

                let url = editId ? '../api/update_skill.php' : '../api/saveSkills.php';
                let data = {
                    role,
                    skill_name: skillName,
                    skill_level: skillLevel,
                    preferred_mode: preferredMode,
                    availability,
                    description,
                    username
                };

                if (editId) data.id = editId;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status === 'success') {
                            alert(editId ? 'Skill updated successfully!' : 'Skill added successfully!');
                            $skillForm.trigger('reset');
                            $skillForm.removeData('edit-id');
                            toggleModal($skillModal, false);
                            loadSkills();
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        alert('Server error! Please try again later.\n' + error);
                    }
                });
            });

            // ===============================
            // 🔹 Initial Load
            // ===============================
            loadSkills();
        });
    </script>

</body>

</html>