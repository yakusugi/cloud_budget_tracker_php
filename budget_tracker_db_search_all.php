<?php
require_once "budget_tracker_db_function.php";

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $result = displayAll();
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
else {
    $response['success'] = 0;
}

echo json_encode($response);

