<?php
require_once "budget_tracker_db_income_function.php";

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email']) && isset($_POST['income_name']) && isset($_POST['date_from']) && isset($_POST['date_to'])) {
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $incomeName = mysqli_real_escape_string($db, $_POST['income_name']);
        $dateFrom = mysqli_real_escape_string($db, $_POST['date_from']);
        $dateTo = mysqli_real_escape_string($db, $_POST['date_to']);
        $result = displayIncomeNameList($email, $incomeName, $dateFrom, $dateTo);
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

