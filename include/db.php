<?php
// Establish the database connection
try {
    $conn = new PDO('mysql:host=localhost;dbname=martin_coiffure;charset=utf8', "root", "");
    //$conn = new PDO('mysql:host=localhost;dbname=u940744937_martincoiffure;charset=utf8', 'u940744937_martin', '0jIy0E3|2&mE');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // Show warnings instead of exceptions
} catch (Exception $e) {
    die('Error: ' . $e->getMessage());
}
?>