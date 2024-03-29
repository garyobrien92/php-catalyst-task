#!/usr/bin/php

<?php
include 'db.php';

$short_options = "u:p:h:";
$long_options = ["file:", "create-table::", "dry-run::", "help::"];
$options = getopt($short_options, $long_options);
$createTable = array_key_exists("create-table", $options);
$dryRun = array_key_exists("dry-run", $options);
$help = array_key_exists("help", $options);

if ($help) {
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

if (!isset($options["file"]) || empty(trim($options["file"]))) {
  fwrite(STDOUT,  "Please provide a file path for csv file");
  die;
}

if (!str_ends_with($options["file"], ".csv")) {
  echo "Please provide a valid csv file";
  die;
}

if (!isset($options["u"]) || empty(trim($options["u"]))) {
  fwrite(STDOUT,  "Please username for database");
  die;
}

if (!isset($options["p"]) || empty(trim($options["p"]))) {
  fwrite(STDOUT,  "Please password for database");
  die;
}

if (!isset($options["h"]) || empty(trim($options["h"]))) {
  fwrite(STDOUT, "Please host for database");
  die;
}

$dbInstance = DatabaseConnect::getInstance($options["h"], $options["u"], $options["p"], "users_csv_upload");
$db = $dbInstance->getConnection();

if ($createTable) {
  // Attempt create table query execution
  $sql = "CREATE TABLE IF NOT EXISTS users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(30) NOT NULL,
    surname VARCHAR(30) NOT NULL,
    email VARCHAR(70) NOT NULL UNIQUE
  )
  ";
  if ($db->query($sql) === true) {
    fwrite(STDOUT, "Table created successfully\n");
  } else {
    $message = "ERROR: Could not able to execute $sql. " . $db->error;
    fwrite(STDOUT, $message);
  }
}

if (!$dryRun) {
  $file = fopen($options["file"], "r");
  fgetcsv($file);
  while (($row = fgetcsv($file)) !== FALSE) {
    try {
      $stmt = $db->prepare("INSERT INTO users (name,surname,email) VALUES (?,?,?)");

      $nameLower = strtolower($row[0]);
      $name = ucfirst(trim($nameLower));
      $surnameLower = strtolower($row[1]);
      $surname = ucwords(trim($surnameLower));
      $email = strtolower(trim($row[2]));

      $validEmail = filter_var($email, FILTER_VALIDATE_EMAIL);

      if(!$validEmail) {
        $message = $row[2] . " is a invalid email.";
        fwrite(STDOUT, $message);
        $stmt->close();
        die;
      }

      $stmt->bind_param("sss", $name, $surname, $email);
      $stmt->execute();
    } catch (mysqli_sql_exception $e) {
      fwrite(STDOUT, $e->getMessage());
      die;
    }
  }
}

if ($dryRun) {
  echo "Dry run";
}

$db->close();
?>