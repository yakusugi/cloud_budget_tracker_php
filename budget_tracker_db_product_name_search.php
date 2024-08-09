<?php
require_once "budget_tracker_db_function.php";

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email']) && isset($_POST['product_name']) && isset($_POST['date_from']) && isset($_POST['date_to'])) {
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $productName = mysqli_real_escape_string($db, $_POST['product_name']);
        $dateFrom = mysqli_real_escape_string($db, $_POST['date_from']);
        $dateTo = mysqli_real_escape_string($db, $_POST['date_to']);
        
        // Log productName if received
        if (!empty($productName)) {
            // Logs the product name to the PHP error log
            error_log("Received productName: " . $productName);
        } else {
            // Logs a message if productName is empty or not set
            error_log("No productName received");
        }
        
        $result = displayProductNameList($email, $productName, $dateFrom, $dateTo);
        if ($result !== false && mysqli_num_rows($result) > 0) {
            $response['success'] = 1;
            $response['result'] = array();

            while ($row = mysqli_fetch_assoc($result)) {
                $response['result'][] = $row;
            }
        } else {
            $response['success'] = 0;
        }
    } else {
        $response['success'] = 0;
        // Log a message if required parameters are not set
        error_log("Missing required parameters");
    }
} else {
    $response['success'] = 0;
    // Log a message if request method is not POST
    error_log("Invalid request method");
}

echo json_encode($response);
