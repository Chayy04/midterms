<?php
session_start();
include '../header.php';  // Include the header
include '../functions.php';  // Include functions for validation, etc.

guard();  // Protect the page to ensure only logged-in users can access

// Check if 'index' is passed in the URL and is valid
if (isset($_GET['index']) && is_numeric($_GET['index'])) {
    $index = $_GET['index'];

    // Check if the student exists in the session
    if (isset($_SESSION['student_data'][$index])) {
        $student = $_SESSION['student_data'][$index];
    } else {
        // If no student found at the given index, redirect back to register.php
        header("Location: register.php");
        exit;
    }
} else {
    // If no valid index is provided, redirect back to register.php
    header("Location: register.php");
    exit;
}

// Handle form submission for deleting the student
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_delete'])) {
    // Delete the student from the session array
    unset($_SESSION['student_data'][$index]);

    // Re-index the session array to ensure keys are continuous after deletion
    $_SESSION['student_data'] = array_values($_SESSION['student_data']);

    // Redirect back to the registration page after deletion
    header("Location: register.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Deletion</title>
</head>
<body>
<div class="container mt-5">
    <h2>Confirm Deletion</h2>

    <p><strong>Are you sure you want to delete the following student?</strong></p>
    <ul>
        <li><strong>Student ID:</strong> <?php echo htmlspecialchars($student['student_id']); ?></li>
        <li><strong>First Name:</strong> <?php echo htmlspecialchars($student['first_name']); ?></li>
        <li><strong>Last Name:</strong> <?php echo htmlspecialchars($student['last_name']); ?></li>
    </ul>

    <form method="POST" action="">
        <!-- Cancel Button (redirect to register.php without deletion) -->
        <a href="register.php">Cancel</a>

        <!-- Confirm Deletion Button -->
        <button type="submit" name="confirm_delete">Delete</button>
    </form>
</div>
</body>
</html>

<?php
include '../footer.php';  // Include the footer
?>
