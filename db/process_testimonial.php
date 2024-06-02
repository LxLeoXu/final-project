<?php
include 'testimonials.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $question = $_POST['question'];
    $answer = $_POST['answer'];
    $imagePath = null;

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Handle image upload
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $imagePath = $targetFile;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    switch ($action) {
        case "Create":
            createTestimonial($question, $answer, $imagePath);
            break;
        case "Update":
            updateTestimonial($id, $question, $answer, $imagePath);
            break;
        case "Delete":
            deleteTestimonial($id);
            break;
    }
}

// Redirect back to the form
header("Location: index.php");
?>