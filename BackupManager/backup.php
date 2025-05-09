<?php
    session_start();

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

    error_reporting(E_ALL);

    $user = 'root';
    $host = 'localhost';
    $dbfilename = 'srsWeb';
    $database = 'srsWeb';

    $now = new DateTime();

    $dbfilepath = $dbfilename.$now->format('_Y-m-d_H-i-s').'.sql';
    $fileName = $dbfilename . "_" . $now->format('Y-m-d_H-i-s') . '.sql';
    echo "<h3>Backing up database to <code>{$dbfilepath}</code></h3>";

    $command = "E:\\XAMPP\\mysql\\bin\\mysqldump --user={$user} --host={$host} {$database} --result-file={$dbfilepath} 2>&1";

    echo "<h3>Executing command`<code>{$command}</code>`</h3>";

    exec($command, $output);

    var_dump($output);

    $content = file_get_contents($dbfilepath);

    header("Content-type: application/octet-stream");
    header("Content-Transfer-Encoding: Binary"); 
    header("Content-disposition: attachment; filename=\"".$dbfilepath."\"");  

    echo $content; 
    exit;
?>