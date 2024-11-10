<?php
include 'header.php'; // Include the header for layout and session start
include 'functions.php'; // Include functions for validation and other actions

// Initialize variables for errors and notifications
$errors = [];
$notification = null;

// Assuming the validation and user checking functions are already included

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get email and password from the POST data
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validate the login credentials
    $errors = validateLoginCredentials($email, $password);

    // If no errors, proceed with login
    if (empty($errors)) {
        $users = getUsers();
        if (checkLoginCredentials($email, $password, $users)) {
            // If login is successful, store the session data and redirect
            $_SESSION['email'] = $email;
            $_SESSION['current_page'] = $_SERVER['REQUEST_URI'];
            header("Location: dashboard.php");
            exit;
        } else {
            // If login fails, display notification
            $notification = "<li>Invalid Email.</li>";
        }
    } else {
        // Display form validation errors
        $notification = displayErrors($errors);
    }
}

?>

<main>
    <div class="container d-flex flex-column align-items-center mt-5">
        <!-- Error Notification Area (Display All Errors/Notifications) -->
        <?php if (!empty($notification)): ?>
            <div class="col-md-4 mb-3">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>System Errors</strong>
                    <!-- Display errors here -->
                    <?php echo $notification; ?>
                    <!-- Dismiss Button -->
                    <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        <?php endif; ?>

        <div class="col-md-4">
            <!-- Card Component for Login Form -->
            <div class="card">
                <div class="card-header text-center">
                    <h5>Login</h5>
                </div>
                <div class="card-body">
                    <!-- Login Form -->
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include 'footer.php'; // Include the footer
?>
