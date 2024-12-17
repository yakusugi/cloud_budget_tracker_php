<?php
require_once "budget_tracker_db_function.php";

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email']) && isset($_POST['store_name']) && isset($_POST['currency_code']) && isset($_POST['date_from']) && isset($_POST['date_to'])) {
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $storeName = mysqli_real_escape_string($db, $_POST['store_name']);
        $currencyCode = mysqli_real_escape_string($db, $_POST['currency_code']);
        $dateFrom = mysqli_real_escape_string($db, $_POST['date_from']);
        $dateTo = mysqli_real_escape_string($db, $_POST['date_to']);
        $result = storeStatsList($email, $storeName, $currencyCode, $dateFrom, $dateTo);
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
    }
} else {
    $response['success'] = 0;
}

echo json_encode($response);

