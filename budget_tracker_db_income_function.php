<?php

require_once "budget_tracker_db_config.php";

function displayIncomeNameList($email, $incomeName, $dateFrom, $dateTo) {
    global $db;

    //SQL select query for income name
    $sql = "SELECT income_date, income_category, income_name, income, currency_code, note, currency_code
    FROM user_income
    WHERE email = '$email'
      AND income_name = '$incomeName'
      AND income_date BETWEEN '$dateFrom' AND '$dateTo'
    ORDER BY income_date ASC";

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


//Insert function (income)
function incomeInsert($email, $date, $incomeCategory, $incomeName, $income, $note) {
    //global variable
    global $db;

    //SQL insertion query
    $sql = "INSERT INTO user_income(email, income_date, income_category, income_name, income, note) 
    VALUES ('$email', '$date', '$incomeCategory', '$incomeName', '$income', '$note')";

    //This enables us to query the database
    $result = mysqli_query($db, $sql) or die (mysqli_error($db));
    error_log("Income inserted - Email: $email, Date: $date, Income Category: $income_category, Income Name: $income_name, Income: $income, Note: $note", 3, "/var/log/api_error_log/error.log");

    //Return the result from the database
    return $result;
}
