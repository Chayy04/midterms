<?php
include 'header.php';  // Include the header for session start and breadcrumbs
include 'functions.php'; // Include functions for validation and other actions
guard();  // Protect the page to ensure only logged-in users can access

// Welcome message for the logged-in user
//echo "<h3 class='text-center'>Welcome, " . $_SESSION['email'] . "</h3>";
?>

<main>


        <!-- Dashboard Section -->
         <br>
        
        <div class="container  d-flex justify-content-between align-items-center col-md-7">
            <!-- Welcome Text -->
            <h3>Welcome to the System: <?php echo $_SESSION['email']; ?></h3>

            <!-- Logout Button aligned to the right -->
            <button onclick="window.location.href='logout.php'" class="btn btn-danger">Logout</button>
        </div>

        <!-- Register Student Card -->
        <div class="row justify-content-center mt-4">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h5>Register a Student</h5>
                    </div>
                    <div class="card-body">
                        <p class="justify-text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde molestias facere, cum debitis nam quis fugiat! Vero, mollitia. Nulla minima dolore molestiae eligendi ducimus beatae ipsum vitae impedit! Ipsa illo eum soluta dolorem earum libero quam necessitatibus dolorum culpa! In aliquid quo rem perspiciatis quibusdam voluptatem, repellat eum corrupti amet.</p>

                        <!-- Button to proceed to register a student -->
                        <div class="d-grid gap-2">
                            <a href="student/register.php" class="btn btn-primary w-100">Register a Student</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</main>

<?php
include 'footer.php';  // Include the footer
?>
