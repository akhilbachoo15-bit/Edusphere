<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

requireLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['course_id'])) {
    $courseId = (int) $_POST['course_id'];
    $userId = (int) $_SESSION['user_id'];

    // Prevent duplicate enrolments
    $check = $conn->prepare("SELECT id FROM enrollments WHERE user_id = ? AND course_id = ?");
    $check->bind_param("ii", $userId, $courseId);
    $check->execute();

    if ($check->get_result()->num_rows === 0) {
        // Give new enrolments a small starting progress so the dashboard has something to show
        $startProgress = rand(5, 15);
        $stmt = $conn->prepare("INSERT INTO enrollments (user_id, course_id, progress) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $userId, $courseId, $startProgress);
        $stmt->execute();
    }
}

redirect('courses.php?enrolled=1');
