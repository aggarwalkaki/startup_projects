<?php
include "db.php";
session_start();
$userprofile = $_SESSION['username'];
   if($userprofile==true){

   }
   else{
    header("location:division.html");
   }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organization Page</title>
    <link rel="stylesheet" href="newstyles.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="header-container"></div>
    <div id="nav-container"></div>
    <div class="content">
        <!-- <h2>Organization Topics</h2> -->
        <div class="grid-container">
            <a href="stpi.php" class="grid-item blue">STPI</a>
            <a href="esc.html" class="grid-item yellow">ESC</a>
            <a href="NeGD.html" class="grid-item green"> NeGD</a>
            <a href="msh.html" class="grid-item green"> msh</a>
            <a href="nasscom.html" class="grid-item green"> NASSCOM</a>
            
        </div>
    </div>
    <script src="include.js"></script>
</body>
</html>
