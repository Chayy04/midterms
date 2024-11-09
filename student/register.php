<?php
    session_start();
    include '../header.php';  // Corrected path to header.php
    include '../functions.php';  // Corrected path to functions.php
    guard();  // Protect the page to ensure only logged-in users can access

    $errors = [];
    $student_data = [];

    // Process the form submission for registering a student
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get student data from the form
        $student_data = [
            'student_id' => $_POST['student_id'],
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name']
        ];

        // Validate the student data
        $errors = validateStudentData($student_data);

        // Check for duplicate student ID
        if (empty($errors)) {
            $duplicate = checkDuplicateStudentData($student_data);
            if (empty($duplicate)) {
                $_SESSION['student_data'][] = $student_data; // Store student in session
                header("Location: register.php"); // Redirect to the same page to refresh the student list
                exit;
            } else {
                $errors[] = "Duplicate Student ID.";
            }
        }
    }
?>

<main>
    <div class="container mt-5">
        <!-- Page Header -->
        <h2 class="text-center">Register a Student</h2>

        <!-- Display error messages only if the form was submitted and there are errors -->
        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($errors)): ?>
            <?php echo renderErrorsToView(displayErrors($errors)); ?>
        <?php endif; ?>

        <!-- Student Registration Form -->
        <form method="POST" action="">
            <div class="mb-3">
                <label for="student_id" class="form-label">Student ID</label>
                <input type="text" class="form-control" id="student_id" name="student_id" required>
            </div>

            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required>
            </div>

            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Register Student</button>
        </form>

        <!-- List of Registered Students -->
        <?php if (!empty($_SESSION['student_data'])): ?>
            <div class="mt-5">
                <h3 class="text-center">Registered Students</h3>

                <!-- Table displaying student information -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['student_data'] as $index => $student): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($student['student_id']); ?></td>
                                <td><?php echo htmlspecialchars($student['first_name']); ?></td>
                                <td><?php echo htmlspecialchars($student['last_name']); ?></td>
                                <td>
                                    <!-- Edit Button -->
                                    <a href="edit.php?index=<?php echo $index; ?>" class="btn btn-warning btn-sm">Edit</a>
                                    
                                    <!-- Delete Button -->
                                    <a href="delete.php?index=<?php echo $index; ?>" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <!-- If no students are registered, show this message 
            <p class="text-center">No students registered yet.</p> -->
        <?php endif; ?>
    </div>
</main>

<?php
    include '../footer.php';  // Corrected path to footer.php if it's outside the 'student' folder
?>
