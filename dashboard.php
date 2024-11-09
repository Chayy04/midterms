<?php
include 'header.php';  // Include the header for session start and breadcrumbs
include 'functions.php'; // Include functions for validation and other actions
guard();  // Protect the page to ensure only logged-in users can access

// Welcome message for the logged-in user
//echo "<h3 class='text-center'>Welcome, " . $_SESSION['email'] . "</h3>";
?>

<main>
    <div class="container mt-5">
        <!-- Breadcrumb for navigation -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>

        <!-- Dashboard Section -->
        <div class="d-flex justify-content-between align-items-center">
            <!-- Welcome Text -->
            <h3>Welcome, <?php echo $_SESSION['email']; ?></h3>

            <!-- Logout Button aligned to the right -->
            <button onclick="window.location.href='logout.php'" class="btn btn-danger">Logout</button>
        </div>

        <!-- Register Student Card -->
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Register a Student</h4>
                    </div>
                    <div class="card-body">
                        <p class="text-center">Register a new student by providing their details below.</p>

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
include 'footer.php';  // Include the footer
?>
