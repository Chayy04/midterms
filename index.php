<?php
    include 'header.php';
?>


    <?php
        // Include functions
        include 'functions.php';

        session_start();

        // Check if the user is already logged in (redirect if session is active)
        checkUserSessionIsActive();

        $errors = [];
        $notification = null;
        $isSuccess = false;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get the email and password from the form
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // Validate the login credentials
            $errors = validateLoginCredentials($email, $password);

            if (empty($errors)) {
                // Check if the credentials match any user
                $users = getUsers();
                if (checkLoginCredentials($email, $password, $users)) {
                    $_SESSION['email'] = $email; // Store email in session
                    $_SESSION['current_page'] = $_SERVER['REQUEST_URI']; // Store the current page in session

                    // Redirect to the dashboard or home page
                    header("Location: dashboard.php");
                    exit;
                } else {
                    $notification = "Invalid login credentials.";
                    $isSuccess = false;
                }
            } else {
                $notification = displayErrors($errors);
                $isSuccess = false;
            }
        }
    ?>

<main>

    <div class="container mt-5">
            <h2 class="text-center">Login</h2>

            <!-- Show notification if there's an error -->
            <?php echo renderErrorsToView($notification); ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</main>


<?php
    include 'footer.php';
?>
