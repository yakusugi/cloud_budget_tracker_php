<?php
require_once "together_again_db_function.php";

$response = array();

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
        }
    } else {
        $response['success'] = 0;
    }
} else {
    $response['success'] = 0;
}

echo json_encode($response);