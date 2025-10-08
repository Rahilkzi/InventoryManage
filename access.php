<?php
session_start();


// Call this at the top of protected pages
function requireLogin() {
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
        exit();
    }
}

// Optional: restrict based on role
function requireRole($role) {
    requireLogin();
    if ($_SESSION['role'] !== $role) {
        echo "Access denied: insufficient permissions.";
        exit();
    }
}
