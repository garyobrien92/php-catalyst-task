<?php

$short_options = "";
$long_options = ["file:", "create-table"];
$options = getopt($short_options, $long_options);
$file = $options["file"];

if(!isset($file) || empty(trim($file)) ) {
    echo "Please provide a file path for csv file";
    return;
}

if(!str_ends_with($file,".csv")) {
    echo "Please provide a valid csv file";
    return;
}

if(isset($file)) {
    echo $file;
}

// include 'db.php';

// $dbInstance = DatabaseConnect::getInstance();
// $db = $dbInstance->getConnection();
?>