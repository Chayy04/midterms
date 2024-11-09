<?php
    include '../header.php';
    include '../functions.php';
    guard();  // Protect the page to ensure only logged-in users can access

    // Retrieve student data using index from session or redirect if not found
    if (isset($_GET['index'])) {
        $index = $_GET['index'];

        // Get the student data by index
        $student = getSelectedStudentData($index);
        if (!$student) {
            header("Location: register.php");  // Redirect if student not found
            exit;
        }
    } else {
        header("Location: register.php");  // Redirect if no index provided
        exit;
    }

    // Handle form submission to delete student data
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Delete student from the session data
        unset($_SESSION['student_data'][$index]);
        header("Location: register.php");  // Redirect after deleting
        exit;
    }
?>

<main>
    <div class="container justify-content-between align-items-center col-6">
        <div class="container m-4">
            <h4 class="mt-4"> Delete a Student</h4>
        </div>

        <div class=" border border-secondary-1 p-4 m-5">
            <!-- Confirm Deletion Form -->
            <form method="POST" action="">
                <div class="mb-2">
                              
                    <label class="form-label">Are you sure you want to delete this student?</label> 
                        <ul style="list-style-type:disc;">
                            <li><strong>Student ID:</strong> <?php echo htmlspecialchars($student['student_id']); ?></li>
                            <li><strong>First Name:</strong> <?php echo htmlspecialchars($student['first_name']); ?></li>
                            <li><strong>Last Name:</strong> <?php echo htmlspecialchars($student['last_name']); ?></li>
                        </ul>
                    
                    <!-- Buttons for Submit and Cancel -->
                    <div>
                        <a href="register.php" class="btn btn-secondary btn-sm">Cancel</a> <!-- Cancel button with gray background -->
                        <button type="submit" class="btn btn-primary btn-sm">Delete Student Record</button> <!-- Delete button -->
                    </div>  
                </div>
            
            </form>
        </div>
    </div>
</main>

<?php
    include '../footer.php';
?>
