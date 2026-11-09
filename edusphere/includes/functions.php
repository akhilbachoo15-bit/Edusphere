<?php
/**
 * Helper functions used across the site
 */

// Clean user input to help prevent XSS
function clean($data) {
    global $conn;
    $data = trim($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $conn->real_escape_string($data);
}

// Check whether a user is currently logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Redirect helper
function redirect($url) {
    header("Location: $url");
    exit();
}

// Require login for protected pages
function requireLogin() {
    if (!isLoggedIn()) {
        redirect('login.php');
    }
}
