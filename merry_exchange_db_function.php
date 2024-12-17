<?php

require_once "merry_exchange_db_config.php";

//Insert function
function userRegistrationInsert($username, $password, $email) {
    //global variable
    global $db;

    //SQL insertion query
    $sql = "INSERT INTO users(username, password_hash, email) VALUES ('$username', '$password', '$email')";

    //This enables us to query the database
    $result = mysqli_query($db, $sql) or die (mysqli_error($db));

    //Return the result from the database
    return $result;
}

function loginToTheSystem($email, $password) {
    global $db;

    //SQL select query
    $sql = "SELECT * FROM users WHERE email = '$email' AND password_hash = '$password'";
    error_log("SQL Query: " . $sql); // Log the SQL query

    //This enables me to query the database
    $result = mysqli_query($db, $sql) or die (mysqli_error($db));

    //Return the result from the database
    
    return $result;
}

//Insert function
// function insertData($date, $store_name, $product_name, $product_type, $price) {
//     //global variable
//     global $db;

//     //SQL insertion query
//     $sql = "INSERT INTO sample_tbl(date, store_name, product_name, product_type, price) VALUES ('$date', '$store_name', '$product_name', '$product_type', '$price')";

//     //This enables us to query the database
//     $result = mysqli_query($db, $sql) or die (mysqli_error($db));

//     //Return the result from the database
//     return $result;
// }

// function displayAll() {
//     global $db;

//     //SQL select query
//     $sql = "SELECT * FROM sample_tbl";

//     //This enables me to query the database
//     $result = mysqli_query($db, $sql) or die (mysqli_error($db));

//     //Return the result from the database
//     return $result;
// }

// function deleteData($id) {
//     //Global Variable
//     global $db;

//     //SQL delete query
//     $sql = "DELETE FROM sample_tbl WHERE id = '$id'";

//     //This enables me to query the database
//     $result = mysqli_query($db, $sql) or die (mysqli_error($db));

//     //Return the result from the database
//     return $result;
// }

// function updateData($id, $date, $store_name, $product_name, $product_type, $price) {
//     //Global Variable
//     global $db;

//     //SQL update query
//     $sql = "UPDATE `sample_tbl` SET `date`= '$date',`store_name`= '$store_name',`product_name`= '$product_name',`product_type`= '$product_type' ,`price`= '$price' WHERE id = '$id'";

//     //This enables me to query the database
//     $result = mysqli_query($db, $sql) or die (mysqli_error($db));

//     //Return the result from the database
//     return $result;
// }