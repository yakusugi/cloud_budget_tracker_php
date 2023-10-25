<?php

//Database Constants
define("DB_NAME", "db");
define("DB_USER", "user_name");
define("DB_PASSWORD", "xxxxx");
define("DB_HOST", "localhost");
//
////Database connection
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
//
//Check if the connection is successful
if ($db == false) {
    echo "Unable to connect";
}
