<?php

require_once "budget_tracker_db_function.php";

// Let's initialize the response here and set it to an array
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errorLogFilePath = "/var/log/php_logs/reg.log";

    // Check if all variables are set
    if (
        isset($_POST['email']) &&
        isset($_POST['date']) &&
        isset($_POST['store_name']) &&
        isset($_POST['product_name']) &&
        isset($_POST['product_type']) &&
        isset($_POST['vat_rate']) &&
        isset($_POST['price']) &&
        isset($_POST['note'])
    ) {
        // Define the variables
        $email = $_POST['email'];
        $date = $_POST['date'];
        $storeName = $_POST['store_name'];
        $productName = $_POST['product_name'];
        $productType = $_POST['product_type'];
        $vatRate = $_POST['vat_rate'];
        $price = $_POST['price'];
        $note = $_POST['note'];

        // Now call the insertData function from db_function.php
        $result = spendingInsert($email, $date, $storeName, $productName, $productType, $vatRate, $price, $note);

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