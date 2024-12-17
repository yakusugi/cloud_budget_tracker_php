<?php
require_once "java_db_config.php";

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['csvData'])) {
        $csvData = $_POST['csvData'];

        // Call the android_to_mysql function from java_db_config.php
        $result = android_to_mysql($csvData);

        // Update the response based on the result
        $response['success'] = $result['success'];

        if ($result['success'] == 0) {
            $response['error'] = $result['error'];
        }
    } else {
        $response['success'] = 0;
    }
} else {
    $response['success'] = 0;
}

echo json_encode($response);
