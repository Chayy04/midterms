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

    // Handle form submission to update student data
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $updated_data = [
            'student_id' => $_POST['student_id'],
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name']
        ];

        updateStudentData($updated_data);  // Update student data in the session
        header("Location: register.php");  // Redirect after updating
        exit;
    }
?>

<main>
    <div class="container mt-5">
        <h2>Edit Student</h2>

        <!-- Edit Student Form -->
        <form method="POST" action="">
            <div class="mb-3">
                <label for="student_id" class="form-label">Student ID</label>
                <input type="text" class="form-control" id="student_id" name="student_id" value="<?php echo $student['student_id']; ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $student['first_name']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $student['last_name']; ?>" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Update Student</button>
        </form>
    </div>
</main>

<?php
    include 'footer.php';
?>
