<?php
// submit.php - Handle the AJAX request made by JavaScript

// Initialize response array
$response = array();

// Check if the form data is sent via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the data from the POST request
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    // Validate the name and email
    if (empty($name) || empty($email)) {
        // If fields are empty, send an error response
        $response['status'] = 'error';
        $response['message'] = 'Both name and email are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Validate email format
        $response['status'] = 'error';
        $response['message'] = 'Please enter a valid email address.';
    } else {
        // If validation passes, send a success response
        $response['status'] = 'success';
        $response['message'] = "Thank you, $name! Your email ($email) has been successfully submitted.";
    }
} else {
    // If request is not POST, return an error
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method.';
}

// Set the content type to JSON
header('Content-Type: application/json');

// Send the response as a JSON object
echo json_encode($response);
?>
