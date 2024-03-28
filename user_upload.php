<?php

$short_options = "";
$long_options = ["file:", "create-table::", "help::"];
$options = getopt($short_options, $long_options);
$file = $options["file"];
$createTable = array_key_exists("create-table", $options);

$help = array_key_exists("help", $options);

if($help) {
    echo "\r\n";

    echo "--file [csv file name] – this is the name of the CSV to be parsed" . "\r\n";

    echo "--create_table – this will cause the MySQL users table to be built (and no further action will be taken)" . "\r\n";

    echo "--dry_run – this will be used with the --file directive in case we want to run the script but not insert
    into the DB. All other functions will be executed, but the database won't be altered" . "\r\n";

    echo "-u – MySQL username" . "\r\n";

    echo "-p – MySQL password" . "\r\n";

    echo "-h – MySQL host" . "\r\n";

    echo "\r\n";

    exit(1);
}

if(!isset($file) || empty(trim($file)) ) {
    echo "Please provide a file path for csv file";
    return;
}

if(!str_ends_with($file,".csv")) {
    echo "Please provide a valid csv file";
    return;
}

if($createTable) {
    echo "Create table fresh";
}

// include 'db.php';

// $dbInstance = DatabaseConnect::getInstance();
// $db = $dbInstance->getConnection();
?>