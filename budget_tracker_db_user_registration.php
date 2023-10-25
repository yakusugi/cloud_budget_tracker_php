<?php

require_once "budget_tracker_db_function.php";

//Let's initialize the response here and set it to array
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errorLogFilePath = "/var/log/php_logs/reg.log";

    //Define the varibales
    $username = $_POST['user_name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    
    //Check if all variable is set
    if (isset($_POST['user_name'])  && isset($_POST['password']) && isset($_POST['email'])) {

        //Now call the insertData function from db_function.php
        $result = userRegistrationInsert($username, $password, $email);

        //if the result variable return true, then insert user into the table in the db.
        if ($result) {
            //Now let's set a response call back in json format
            //at this point a user has been insterted into the db already, we just want to return a response to user
            $response['success'] = 1;
            $response['message'] = "User data inserted...";
            //echo it on json format
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
