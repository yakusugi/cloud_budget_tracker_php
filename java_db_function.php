<?php

require_once "java_db_config.php";

// User Insert function
function android_to_mysql($csvData) {
    // Global variable
    global $db;

    // Split the CSV data into lines
    $lines = explode("\n", $csvData);

    foreach ($lines as $line) {
        $data = str_getcsv($line);

        // Modify the following code according to your table structure
        $column1 = mysqli_real_escape_string($db, $data[0]);
        $column2 = mysqli_real_escape_string($db, $data[1]);
        $column3 = mysqli_real_escape_string($db, $data[2]);
        $column4 = mysqli_real_escape_string($db, $data[3]);
        $column5 = mysqli_real_escape_string($db, $data[4]);
        $column6 = mysqli_real_escape_string($db, $data[5]);
        $column7 = mysqli_real_escape_string($db, $data[6]);
        $column8 = mysqli_real_escape_string($db, $data[7]);

        // Example SQL query to insert data into a table named 'your_table_name'
        $query = "INSERT INTO your_table_name (column1, column2, column3, column4, column5, column6, column7, column8) VALUES ('$column1', '$column2', '$column3', '$column4', '$column5', '$column6', '$column7', '$column8')";

        if (mysqli_query($db, $query)) {
            $response['success'] = 1;
        } else {
            $response['success'] = 0;
            $response['error'] = mysqli_error($db);
            break;
        }
    }

    // Return the response
    return $response;
}
