<?php
// dashboard_faculty.php

session_start();
require('connection.php');

// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    echo "
        <script>
            alert('Please log in to access the faculty dashboard.');
            window.location.href = 'index.php';
        </script>
    ";
    exit;
}

// Retrieve the username from the session
$username = $_SESSION['username'];

// Fetch the user's details from the database
$query = "SELECT * FROM `accounts` WHERE `username` = '$username' AND `user` = 'Faculty'";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) == 1) {
    $user_data = mysqli_fetch_assoc($result);
} else {
    echo "
        <script>
            alert('Access denied. This page is only for faculty.');
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
    <title>Faculty Dashboard</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <header>
        <h1>Welcome, <?php echo htmlspecialchars($user_data['full_name']); ?> (Faculty)</h1>
        <nav>
            <a href="dashboard_faculty.php">Dashboard</a>
            <a href="profile.php">Profile</a>
            <a href="logout.php">Logout</a>
            <a href="index.php">Home</a>
        </nav>
    </header>

    <main>
        <section>
            <h2>Faculty Announcements</h2>
            <p>Welcome to the faculty dashboard. Here, you will find faculty-specific announcements, schedules, and updates.</p>
        </section>

        <section>
            <h2>Class Schedule</h2>
            <ul>
                <li>Class 1: Web Development - Dec 12, 2024 - 10:00 AM</li>
                <li>Class 2: Advanced PHP - Dec 14, 2024 - 12:00 PM</li>
                <li>Class 3: Project Review - Dec 20, 2024 - 02:00 PM</li>
            </ul>
        </section>

        <section>
            <h2>Student Submissions</h2>
            <p>Review and grade student project submissions.</p>
            <ul>
                <li><a href="submission1.pdf" target="_blank">Submission 1: Project Proposal</a></li>
                <li><a href="submission2.pdf" target="_blank">Submission 2: Mid-term Report</a></li>
                <li><a href="submission3.pdf" target="_blank">Submission 3: Final Submission</a></li>
            </ul>
        </section>

        <section>
            <h2>Faculty Resources</h2>
            <p>Access teaching resources, guides, and other faculty-related materials.</p>
            <ul>
                <li><a href="resource1.pdf" target="_blank">Resource 1: Advanced PHP Techniques</a></li>
                <li><a href="resource2.pdf" target="_blank">Resource 2: Classroom Management Tips</a></li>
                <li><a href="resource3.pdf" target="_blank">Resource 3: Research Paper Writing</a></li>
            </ul>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 HIND DHAROHAR | Faculty Dashboard</p>
    </footer>
</body>
</html>
