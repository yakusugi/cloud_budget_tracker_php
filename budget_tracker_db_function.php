<?php

require_once "budget_tracker_db_config.php";

//Insert function
function userRegistrationInsert($username, $password, $email) {
    //global variable
    global $db;

    //SQL insertion query
    $sql = "INSERT INTO users(username, password, email) VALUES ('$username', '$password', '$email')";

    //This enables us to query the database
    $result = mysqli_query($db, $sql) or die (mysqli_error($db));

    //Return the result from the database
    return $result;
}

function loginToTheSystem($email, $password) {
    global $db;

    //SQL select query
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    error_log("SQL Query: " . $sql); // Log the SQL query

    //This enables me to query the database
    $result = mysqli_query($db, $sql) or die (mysqli_error($db));

    //Return the result from the database
    
    return $result;
}

//Insert function (spending)
function spendingInsert($email, $date, $storeName, $productName, $productType, $vatRate, $price, $note) {
    //global variable
    global $db;

    //SQL insertion query
    $sql = "INSERT INTO user_spending(email, spending_date, store_name, product_name, product_type, vat_rate, price, note) 
    VALUES ('$email', '$date', '$storeName', '$productName', '$productType', '$vatRate', '$price', '$note')";

    //This enables us to query the database
    $result = mysqli_query($db, $sql) or die (mysqli_error($db));
    error_log("Spending inserted - Email: $email, Date: $date, Store Name: $store_name, Product Name: $product_name, Product Type: $product_type, VAT Rate: $vat_rate, Price: $price, Note: $note", 3, "/var/log/api_error_log/error.log");

    //Return the result from the database
    return $result;
}

function displayStoreNameList($email, $storeName, $dateFrom, $dateTo) {
    global $db;

    //SQL select query
    $sql = "SELECT spending_date, store_name, product_name, product_type, vat_rate, price, note, currency_code, quantity
    FROM user_spending
    WHERE email = '$email'
      AND store_name = '$storeName'
      AND spending_date BETWEEN '$dateFrom' AND '$dateTo'
    ORDER BY spending_date ASC";

    //Attempt to open the log file for writing
    $logFilePath = "/var/log/api_error_log/query.log";
    $file = fopen($logFilePath, "w");

    if ($file === false) {
        error_log("Failed to open log file for writing: $logFilePath");
        return false; // Return an error indicator
    }

    // Write the SQL query to the file
    $writeResult = fwrite($file, $sql);

    if ($writeResult === false) {
        error_log("Failed to write SQL query to log file: $logFilePath");
        fclose($file);
        return false; // Return an error indicator
    }

    // Close the file
    fclose($file);

    // If writing was successful, execute the SQL query
    $result = mysqli_query($db, $sql);

    if ($result === false) {
        error_log("Failed to execute SQL query: " . mysqli_error($db));
    }

    return $result;
}

function displayProductNameList($email, $productName, $dateFrom, $dateTo) {
    global $db;

    //SQL select query
    $sql = "SELECT spending_date, store_name, product_name, product_type, vat_rate,  price, note, currency_code, quantity
    FROM user_spending
    WHERE email = '$email'
      AND product_name LIKE '%$productName%'
      AND spending_date BETWEEN '$dateFrom' AND '$dateTo'
      ORDER BY spending_date ASC";

    //Attempt to open the log file for writing
    $logFilePath = "/var/log/api_error_log/query.log";
    $file = fopen($logFilePath, "w");

    if ($file === false) {
        error_log("Failed to open log file for writing: $logFilePath");
        return false; // Return an error indicator
    }

    // Write the SQL query to the file
    $writeResult = fwrite($file, $sql);

    if ($writeResult === false) {
        error_log("Failed to write SQL query to log file: $logFilePath");
        fclose($file);
        return false; // Return an error indicator
    }

    // Close the file
    fclose($file);

    // If writing was successful, execute the SQL query
    $result = mysqli_query($db, $sql);

    if ($result === false) {
        error_log("Failed to execute SQL query: " . mysqli_error($db));
    }

    return $result;
}

function displayProductTypeList($email, $productType, $dateFrom, $dateTo) {
    global $db;

    //SQL select query
    $sql = "SELECT spending_date, store_name, product_name, product_type, vat_rate, price, note, currency_code, quantity
    FROM user_spending
    WHERE email = '$email'
    AND product_type LIKE '%\$productType%'
    AND spending_date BETWEEN '$dateFrom' AND '$dateTo'
    ORDER BY spending_date ASC";

    //Attempt to open the log file for writing
    $logFilePath = "/var/log/api_error_log/query.log";
    $file = fopen($logFilePath, "w");

    if ($file === false) {
        error_log("Failed to open log file for writing: $logFilePath");
        return false; // Return an error indicator
    }

    // Write the SQL query to the file
    $writeResult = fwrite($file, $sql);

    if ($writeResult === false) {
        error_log("Failed to write SQL query to log file: $logFilePath");
        fclose($file);
        return false; // Return an error indicator
    }

    // Close the file
    fclose($file);

    // If writing was successful, execute the SQL query
    $result = mysqli_query($db, $sql);

    if ($result === false) {
        error_log("Failed to execute SQL query: " . mysqli_error($db));
    }

    return $result;
}



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
