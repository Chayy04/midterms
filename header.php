<?php
// Start the session for all pages
session_start();

// Include Bootstrap or other required resources
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<!-- Breadcrumbs section -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
    <?php
    // Check if we're on specific pages and add breadcrumb items
    if (basename($_SERVER['PHP_SELF']) == 'dashboard.php') {
        echo '<li class="breadcrumb-item active" aria-current="page">Dashboard</li>';
    } elseif (basename($_SERVER['PHP_SELF']) == 'register.php') {
        echo '<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>';
        echo '<li class="breadcrumb-item active" aria-current="page">Register Student</li>';
    } elseif (basename($_SERVER['PHP_SELF']) == 'edit.php') {
        echo '<li class="breadcrumb-item"><a href="register.php">Register Student</a></li>';
        echo '<li class="breadcrumb-item active" aria-current="page">Edit Student</li>';
    } elseif (basename($_SERVER['PHP_SELF']) == 'delete.php') {
        echo '<li class="breadcrumb-item"><a href="register.php">Register Student</a></li>';
        echo '<li class="breadcrumb-item active" aria-current="page">Delete Student</li>';
    } elseif (basename($_SERVER['PHP_SELF']) == 'logout.php') {
        echo '<li class="breadcrumb-item active" aria-current="page">Logout</li>';
    }
    ?>
  </ol>
</nav>
