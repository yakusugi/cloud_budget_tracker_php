<?php

// Enable error reporting for debugging purposes
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "budget_tracker_db_function.php";

// Let's initialize the response here and set it to an array
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errorLogFilePath = "/var/log/php_logs/reg.log";

    // Check if all variables are set
    if (
        isset($_POST['email']) &&
        isset($_POST['bank_name']) &&
        isset($_POST['balance']) &&
        isset($_POST['note']) &&
        isset($_POST['currency_code'])
    ) {
        // Define the variables
        $email = $_POST['email'];
        $bankName = $_POST['bank_name'];
        $balance = $_POST['balance'];
        $note = $_POST['note'];
        $currencyCode = $_POST['currency_code'];

        // Now call the insertData function from db_function.php
        $result = bankInsert($email, $bank_name, $balance, $note, $currency_code);

        // If the result variable returns true, then insert the user into the table in the database.
        if ($result) {
            // Now let's set a response callback in JSON format
            // At this point, a user has been inserted into the database already, and we just want to return a response to the user
            $response['success'] = 1;
            $response['message'] = "User data inserted...";
            // Echo it in JSON format
            echo json_encode($response);
        } else {
            error_log("An error occurred while inserting user data.", 3, $errorLogFilePath);
            $response['success'] = 0;
            $response['message'] = "An error occurred";
            echo json_encode($response);
        }
    } else {
        $response['success'] = 0;
        $response['message'] = "Required fields are missing";
        echo json_encode($response);
    }
} else {
    $response['success'] = 0;
    $response['message'] = "Invalid request";
    echo json_encode($response);
}
?>