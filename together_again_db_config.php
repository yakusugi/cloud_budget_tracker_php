<?php

//Database Constants
define("DB_NAME", "togather_again_db");
define("DB_USER", "johnny");
define("DB_PASSWORD", "JohnUnity0216$#@!");
define("DB_HOST", "localhost");
//
////Database connection
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
//
//Check if the connection is successful
if ($db == false) {
    echo "Unable to connect";
}
