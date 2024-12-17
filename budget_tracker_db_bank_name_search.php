<?php
require_once "budget_tracker_db_function.php";

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email']) && isset($_POST['bank_name'])) {
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $bankName = mysqli_real_escape_string($db, $_POST['bank_name']);
        
        // Log productName if received
        if (!empty($bankName)) {
            // Logs the product name to the PHP error log
            error_log("Received productName: " . $bankName);
        } else {
            // Logs a message if productName is empty or not set
            error_log("No productName received");
        }
        
        $result = displayBankNameList($email, $bank_name);
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
