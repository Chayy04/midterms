<?php
include 'header.php'; // Include the header for layout and session start
include 'functions.php'; // Include functions for validation and other actions
guard();
// Initialize variables for errors and notifications
$errors = [];
$notification = null;
$isSuccess = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get email and password from the POST data
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validate the login credentials
    $errors = validateLoginCredentials($email, $password);

    // If no errors, check if the credentials match
    if (empty($errors)) {
        $users = getUsers(); // Assume getUsers() returns an array of users
        if (checkLoginCredentials($email, $password, $users)) {
            // If login is successful, store the session data and redirect
            $_SESSION['email'] = $email;  // Store email in session
            $_SESSION['current_page'] = $_SERVER['REQUEST_URI'];  // Store the current page for redirection later
            header("Location: dashboard.php"); // Redirect to dashboard
            exit;
        } else {
            // If login fails, display notification
            $notification = "Invalid login credentials.";
        }
    } else {
        // Display form validation errors
        $notification = displayErrors($errors);
    }
}
?>

<main>
    <div class="container mt-5">
        <h2 class="text-center">Login</h2>

        <!-- Display error notification -->
        <?php echo renderErrorsToView($notification); ?>

        <!-- Login form -->
        <form method="POST" action="">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" >
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" >
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</main>

<?php
include 'footer.php'; // Include the footer
?>
