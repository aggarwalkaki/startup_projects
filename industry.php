
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
    <title>STPI</title>
    <link rel="stylesheet" href="newstyles.css">
    <link rel="stylesheet" href="it.css">
    <style>
        /* Inline CSS additions for new sections */
        .content-section {
            margin: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .content-card {
            display: flex;
            flex-direction: row;
            align-items: center;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: box-shadow 0.3s;
            width: 100%;
            max-width: 700px;
            cursor: pointer;
        }

        .content-card img {
            width: 250px;
            height: 200px;
            object-fit: cover;
            border-right: 5px solid #3a6ea5;
        }

        .content-card:hover {
            box-shadow: 0 6px 12px rgba(0,0,0,0.2);
        }

        .card-details {
            padding: 20px;
            flex-grow: 1;
        }

        .card-details h2 {
            font-size: 22px;
            color: #3a6ea5;
            margin-bottom: 10px;
        }

        .card-details p {
            font-size: 16px;
            color: #555;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <div id="header-container"></div>
    <div id="nav-container"></div>

    <h1>Software Industry Promotion</h1>

    <!-- New Content Section -->
    <div class="content-section">
        <!-- Card 1 -->
        <div class="content-card">
            <img src="cloud.jpg" alt="Cloud Computing">
            <div class="card-details">
                <h2>Cloud Computing</h2>
                <p>
                    Explore how cloud computing is transforming businesses by offering scalable resources and solutions. Learn about the benefits of cloud adoption in various industries.
                </p>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="content-card">
            <img src="ai.jpg" alt="Artificial Intelligence">
            <div class="card-details">
                <h2>Artificial Intelligence</h2>
                <p>
                    AI is revolutionizing the way we work and live. Discover the latest advancements in AI technology and its impact on different sectors.
                </p>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="content-card">
            <img src="cyber.jpg" alt="Cybersecurity">
            <div class="card-details">
                <h2>Cybersecurity</h2>
                <p>
                    As technology advances, so do the threats. Learn about the strategies and tools being used to protect data and ensure privacy in the digital world.
                </p>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="content-card">
            <img src="digi.webp" alt="Digital Transformation">
            <div class="card-details">
                <h2>Digital Transformation</h2>
                <p>
                    Digital transformation is reshaping the business landscape. Understand how companies are adapting to new technologies and what it means for future growth.
                </p>
            </div>
        </div>
    </div>

    <div class="sector-container">
        <div class="sector-card">
            <a href="ITsector.php"><p>IT/Software Sector</p></a>
        </div>
    </div>

    <script src="include.js"></script>
</body>
</html>
