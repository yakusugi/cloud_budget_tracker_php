<?php
require_once "budget_tracker_db_function.php";

$response = array();

// Custom error logging function
function customErrorLog($message) {
    $logFile = "/var/log/api_error_log/query.log";
    error_log(date("Y-m-d H:i:s") . " - " . $message . "\n", 3, $logFile);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        // $password = hash('sha256', mysqli_real_escape_string($db, $_POST['password'])); // Hash the incoming password
        $result = loginToTheSystem($email, $password);
        if (mysqli_num_rows($result) > 0) {
            $response['success'] = 1;
        } else {
            $response['success'] = 0;
            customErrorLog("Login failed for user: $email");
        }
    } else {
        $response['success'] = 0;
        customErrorLog("Required fields are missing.");
    }
} else {
    $response['success'] = 0;
    customErrorLog("Invalid Request Method.");
}

echo json_encode($response);
