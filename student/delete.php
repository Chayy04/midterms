<?php
    include '../header.php';
    include '../functions.php';
    guard();  // Protect the page to ensure only logged-in users can access

    // Retrieve student data from session or redirect if not found
    if (isset($_GET['student_id'])) {
        $student_id = $_GET['student_id'];
        $student = getStudentById($student_id);
        if (!$student) {
            header("Location: register.php");  // Redirect if student not found
            exit;
        }
    } else {
        header("Location: register.php");  // Redirect if no student ID provided
        exit;
    }

    // Handle form submission to delete student
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        deleteStudentById($student_id);  // Delete the student
        header("Location: register.php");  // Redirect to the register page
        exit;
    }
?>

<main>
    <div class="container mt-5">
        <h2>Delete Student</h2>

        <!-- Confirmation of Deletion -->
        <form method="POST" action="">
            <p>Are you sure you want to delete the student with ID: <?php echo $student['student_id']; ?>?</p>
            <button type="submit" class="btn btn-danger">Yes, Delete</button>
            <a href="register.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</main>

<?php
    include 'footer.php';
?>
