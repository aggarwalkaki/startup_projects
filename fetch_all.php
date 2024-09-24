<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS'); 
header('Access-Control-Allow-Headers: Content-Type');

include "db.php";

// Fetch topics
$sql = "SELECT * FROM topics";
$result = mysqli_query($conn, $sql) or die("SQL Query Failed.");

$topics = [];
if(mysqli_num_rows($result) > 0) {
    $topics = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Fetch projects
$newsql = "SELECT * FROM projects";
$newresult = mysqli_query($conn, $newsql) or die("SQL Query Failed.");

$projects = [];
if(mysqli_num_rows($newresult) > 0) {
    $projects = mysqli_fetch_all($newresult, MYSQLI_ASSOC);
}

// Combine results
$response = [
    'topics' => $topics,
    'projects' => $projects,
];

echo json_encode($response);
?>
