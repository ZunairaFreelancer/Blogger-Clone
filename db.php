<?php
// Debugging: Enable error reporting to find the 500 error cause
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = 'localhost';
$dbname = 'rsoa_20';
$username = 'rsoa_20';
$password = '123456';

try {
    // Attempt to connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    // Set PDO options for better error handling
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // If connection fails, stop and show the error
    die("<h3>Database Error:</h3> " . htmlspecialchars($e->getMessage()));
}

// Helper function: Escape HTML characters for security
function e($string)
{
    if ($string === null) {
        return '';
    }
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Helper function: Create URL-friendly slugs
function createSlug($string)
{
    $string = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
    return strtolower(trim($string)) . '-' . time();
}
// Note: Closing PHP tag is omitted to prevent accidental whitespace output
