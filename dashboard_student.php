<?php
// dashboard_student.php

session_start();
require('connection.php');

// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    echo "
        <script>
            alert('Please log in to access the student dashboard.');
            window.location.href = 'index.php';
        </script>
    ";
    exit;
}

// Retrieve the username from the session
$username = $_SESSION['username'];

// Fetch the user's details from the database
$query = "SELECT * FROM `accounts` WHERE `username` = '$username' AND `user` = 'Student'";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) == 1) {
    $user_data = mysqli_fetch_assoc($result);
} else {
    echo "
        <script>
            alert('Access denied. This page is only for students.');
            window.location.href = 'index.php';
        </script>
    ";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>Welcome, <?php echo htmlspecialchars($user_data['full_name']); ?> (Student)</h1>
        <nav>
            <a href="dashboard_student.php">Dashboard</a>
            <a href="profile.php">Profile</a>
            <a href="logout.php">Logout</a>
            <a href="index.php">Home</a>
        </nav>
    </header>

    <main>
        <!-- Announcements Section -->
        <section>
            <h2>Student Announcements</h2>
            <p>Welcome to the student dashboard. Here, you will find student-specific announcements, assignments, and updates.</p>
        </section>

        <!-- Assignments Section -->
        <section>
            <h2>Assignments</h2>
            <ul>
                <li>Assignment 1: Complete the project proposal by Dec 15, 2024</li>
                <li>Assignment 2: Submit the mid-term project report by Jan 20, 2025</li>
                <li>Assignment 3: Final project submission by Mar 10, 2025</li>
            </ul>
        </section>

        <!-- Upcoming Events Section -->
        <section>
            <h2>Upcoming Events</h2>
            <ul>
                <li>Event 1: Coding Hackathon - Dec 18, 2024</li>
                <li>Event 2: Guest Lecture on AI - Jan 5, 2025</li>
                <li>Event 3: Project Showcase - Mar 25, 2025</li>
            </ul>
        </section>

        <!-- Student Resources Section -->
        <section>
            <h2>Student Resources</h2>
            <ul>
                <li><a href="resource1.pdf" target="_blank">Resource 1: Web Development Basics</a></li>
                <li><a href="resource2.pdf" target="_blank">Resource 2: Advanced PHP Guide</a></li>
                <li><a href="resource3.pdf" target="_blank">Resource 3: SQL Best Practices</a></li>
            </ul>
        </section>

        <!-- Lost and Found Button -->
        <section>
            <button id="lostFoundBtn" class="lost-found-btn">Lost and Found</button>
        </section>

        <!-- Lost and Found Form Popup -->
        <div class="popup-container" id="lostFoundPopup">
            <div class="popup">
                <form method="POST" action="lost_and_found.php" enctype="multipart/form-data">
                    <h2>
                        <span>Lost and Found Form</span>
                        <button type="reset" onclick="popup('lostFoundPopup')">X</button>
                    </h2>
                    <input type="text" placeholder="Full Name" name="name" required><br><br>
                    <input type="email" placeholder="Email" name="email" required><br><br>
                    <input type="text" placeholder="Phone" name="phone" required><br><br>

                    <label>User Type:</label><br>
                    Student: <input type="radio" name="user_type" value="Student" onclick="showStudentFields()" required>
                    Faculty: <input type="radio" name="user_type" value="Faculty" onclick="hideStudentFields()"><br><br>

                    <div id="studentFields" style="display:none;">
                        <label>Course:</label>
                        <select name="course">
                            <option value="BCA">BCA</option>
                            <option value="BBA">BBA</option>
                            <option value="BCom">BCom</option>
                        </select><br>

                        <label>Year:</label>
                        <select name="year">
                            <option value="1st">1st</option>
                            <option value="2nd">2nd</option>
                            <option value="3rd">3rd</option>
                        </select><br><br>
                    </div>

                    <div id="facultyFields" style="display:none;">
                        <label>Department:</label>
                        <select name="department">
                            <option value="CSE">CSE</option>
                            <option value="Commerce">Commerce</option>
                            <option value="EEE">EEE</option>
                        </select><br><br>
                    </div>

                    <input type="text" placeholder="Item Name" name="item_name" required><br><br>
                    <input type="file" name="photo" required><br><br>
                    <input type="text" placeholder="Where Item Was Found" name="location" required><br><br>
                    <textarea name="additional_notes" placeholder="Additional Notes"></textarea><br>

                    <button type="submit" class="submit-btn">Submit</button>
                </form>
            </div>
        </div>

    </main>

    <script>
        function popup(popup_name) {
            let popup = document.getElementById(popup_name);
            popup.style.display = (popup.style.display === "flex") ? "none" : "flex";
        }

        document.getElementById('lostFoundBtn').addEventListener('click', function () {
            popup('lostFoundPopup');
        });

        function showStudentFields() {
            document.getElementById('studentFields').style.display = 'block';
            document.getElementById('facultyFields').style.display = 'none';
        }

        function hideStudentFields() {
            document.getElementById('studentFields').style.display = 'none';
            document.getElementById('facultyFields').style.display = 'block';
        }
    </script>

</body>
</html>
