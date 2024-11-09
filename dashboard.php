<?php
    include 'header.php';
    include 'functions.php';
    guard();  // Protect the page to ensure only logged-in users can access

    // Welcome message
    echo "<h3 class='text-center'>Welcome, " . $_SESSION['email'] . "</h3>";
?>

<main>
    <div class="container mt-5">
        <!-- Row to hold the welcome message and logout button -->
        <div class="d-flex justify-content-between align-items-center">
            <!-- Welcome Text -->
            <h3>Welcome, <?php echo $_SESSION['email']; ?></h3>

            <!-- Logout Button aligned to the right -->
            <button onclick="window.location.href='logout.php'" class="btn btn-danger">Logout</button>
        </div>

        <!-- Dashboard Card for Registering a Student -->
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Register a Student</h4>
                    </div>
                    <div class="card-body">
                        <p class="text-center">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Explicabo accusantium fugiat ut eius minus vero et deleniti harum quaerat sit cum facilis voluptates numquam, aspernatur deserunt, perferendis quia expedita nisi?</p>

                        <!-- Button to proceed to register a student -->
                        <div class="d-grid gap-2">
                            <a href="student/register.php" class="btn btn-primary w-100">Register a Student</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
    include 'footer.php';
?>
