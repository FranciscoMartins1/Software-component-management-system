<?php
    require_once __DIR__ . '/db.php';

    // Set the error reporting level
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    // Show all errors
    error_reporting(E_ALL);

    // Database config variables
    $user = 'root';
    $host = 'localhost';
    $dbfilename = 'srsWeb';
    $database = 'srsWeb';

    $now = new DateTime();
    // Path to store the backup file with the current date
    $dbfilepath = dirname(__FILE__).'/'.$dbfilename.$now->format('_Y-m-d_H-i-s').'.sql';


    // Build the command to backup the database
    $command = "E:\XAMPP\mysql\bin\mysqldump --user={$user} --host={$host} {$database} --result-file={$dbfilepath} 2>&1";

    // Execute the command to backup the database
    exec($command, $output);

    // clears the variable data
    var_dump($output);

    // Get the file data
    $backupData = file_get_contents($dbfilepath);
    $backupName = basename($dbfilepath);
    $backupFileType = mime_content_type($dbfilepath);
    $backupFileSize = filesize($dbfilepath);
    echo "<h3>File size: {$fileSize}</h3>";
    $backupFileTmpName = $dbfilepath;
    $backupFileError = 0;
    $backFileURL;


    $sql = "INSERT INTO srsBackup(backupData, backupName, backupFileType, backupFileSize, backupFileTmpName, backupFileError, backFileURL, backupUpload_on) VALUES(?, ?, ?, ?, ?, ?, ?, NOW())";
    $statement = $conn->prepare($sql);


    $statement->bind_param('sssssss', $backupData, $backupName, $backupFileType, $backupFileSize, $backupFileTmpName, $backupFileError, $backFileURL);
    $current_id = $statement->execute() or die("<b>Error:</b> Problem on File Insert<br/>" . mysqli_connect_error());

    header("Location: /projetoweb/adminUser.html");
?>