#!/usr/bin/php

<?php
include 'db.php';

$short_options = "u:p:h:";
$long_options = ["file:", "create-table::", "dry-run::", "help::"];
$options = getopt($short_options, $long_options);
$createTable = array_key_exists("create-table", $options);
$dryRun = array_key_exists("dry-run", $options);
$help = array_key_exists("help", $options);

if(!isset($options["file"]) || empty(trim($options["file"])) ) {
    echo "Please provide a file path for csv file";
    return;
}

if(!str_ends_with($options["file"],".csv")) {
    echo "Please provide a valid csv file";
    return;
}

if(!isset($options["u"]) || empty(trim($options["u"])) ) {
    echo "Please username for database";
    return;
}

if(!isset($options["p"]) || empty(trim($options["p"])) ) {
    echo "Please password for database";
    return;
}

if(!isset($options["h"]) || empty(trim($options["h"])) ) {
    echo "Please host for database";
    return;
}

if($help) {
    echo "\r\n";

    echo "--file [csv file name] – this is the name of the CSV to be parsed" . "\n";

    echo "--create_table – this will cause the MySQL users table to be built (and no further action will be taken)" . "\n";

    echo "--dry_run – this will be used with the --file directive in case we want to run the script but not insert
    into the DB. All other functions will be executed, but the database won't be altered" . "\n";

    echo "-u – MySQL username" . "\n";

    echo "-p – MySQL password" . "\n";

    echo "-h – MySQL host" . "\n";

    echo "\r\n";

    exit(1);
}

var_dump($options);

$dbInstance = DatabaseConnect::getInstance( $options["h"], $options["u"], $options["p"], "users_csv_upload");
$db = $dbInstance->getConnection();

var_dump($db);

if($createTable) {
    echo "Create table fresh";
}

if($dryRun) {
    echo "Dry run";
}
?>