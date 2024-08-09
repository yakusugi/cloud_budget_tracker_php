<?php

require_once "budget_tracker_db_income_function.php";

// Let's initialize the response here and set it to an array
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errorLogFilePath = "/var/log/php_logs/reg.log";

    // Check if all variables are set
    if (
        isset($_POST['email']) &&
        isset($_POST['date']) &&
        isset($_POST['income_category']) &&
        isset($_POST['income_name']) &&
        isset($_POST['income']) &&
        isset($_POST['note'])
    ) {
        // Define the variables
        $email = $_POST['email'];
        $date = $_POST['date'];
        $incomeCategory = $_POST['income_category'];
        $incomeName = $_POST['income_name'];
        $income = $_POST['income'];
        $note = $_POST['note'];

        // Now call the insertData function from db_function.php
        $result = incomeInsert($email, $date, $incomeCategory, $incomeName, $income, $note);

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