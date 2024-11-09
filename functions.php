<?php

function getUsers() {
    return [
        ["email" => "admin1@example.com", "password" => "admin1"],
        ["email" => "admin@example.com", "password" => "admin2"],
        ["email" => "admin@example.com", "password" => "admin3"],
        ["email" => "admin@example.com", "password" => "admin4"],
        ["email" => "admin@example.com", "password" => "admin5"]
    ];
}

function validateLoginCredentials($email, $password) {
    $errors = [];

    // Validate email
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    // Validate password
    if (empty($password)) {
        $errors[] = "Password is required.";
    }

    return $errors;
}

function checkLoginCredentials($email, $password, $users) {
    foreach ($users as $user) {
        if ($user['email'] === $email && $user['password'] === $password) {
            return true;
        }
    }
    return false;
}

function checkUserSessionIsActive() {
    // Removed session_start() here
    if (isset($_SESSION['email']) && isset($_SESSION['current_page'])) {
        // Redirect to the current page
        header("Location: " . $_SESSION['current_page']);
        exit;
    }
}

function guard() {
    // Removed session_start() here
    if (empty($_SESSION['email'])) {
        // Redirect to the login page if the user is not logged in
        header("Location: " . getBaseURL() . "/index.php");
        exit;
    }
}

function displayErrors($errors) {
    $output = "<div class='alert alert-danger'><strong>System Errors</strong><ul>";
    foreach ($errors as $error) {
        $output .= "<li>" . htmlspecialchars($error) . "</li>";
    }
    $output .= "</ul></div>";
    return $output;
}

function renderErrorsToView($error) {
    if (empty($error)) {
        return null;
    }
    return "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                $error
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
}

function getBaseURL() {
    return 'http://' . $_SERVER['HTTP_HOST'] . '/midterms';
}

function checkDuplicateStudentData($student_data) {
    // Check if the student_id already exists in the session
    if (!empty($_SESSION['student_data'])) {
        foreach ($_SESSION['student_data'] as $existing_student) {
            if ($existing_student['student_id'] === $student_data['student_id']) {
                return $existing_student; // Return the existing student if there's a match
            }
        }
    }
    return null; // Return null if no duplicate is found
}

function validateStudentData($student_data) {
    $errors = [];

    // Check if student ID is provided
    if (empty($student_data['student_id'])) {
        $errors[] = "Student ID is required.";
    }

    // Check if first name is provided
    if (empty($student_data['first_name'])) {
        $errors[] = "First Name is required.";
    }

    // Check if last name is provided
    if (empty($student_data['last_name'])) {
        $errors[] = "Last Name is required.";
    }

    // Optional: Add more validation rules as needed (e.g., length check, format validation)
    return $errors;
}

?>
