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
</head>
<body>
    <div id="header-container"></div>
    <div id="nav-container"></div>
    <div class="content">
        <h1>IT/Software Sector</h1>
        <h2>Introduction</h2>
        <p>The Indian Information Technology/ Software industry is a global powerhouse today, and its impact on India has been incomparable. It has contributed immensely in positioning the country as a preferred investment destination amongst global investors and creating huge job opportunities in India, as well as in the USA, Europe and other parts of the world. In the last decade, the industry has grown many folds in revenue terms, and relative share to India’s GDP is around 7% in FY2023-24. India is the topmost off-shoring destination for IT companies across the world. Having proven its capabilities in delivering both on-shore and off-shore services to global clients, emerging technologies now offer an entire new gamut of opportunities for top IT firms in India. Indian IT/Software industry offers cost-effectiveness, great quality, high reliability, speedy deliveries and, above all, the use of state-of-the-art technologies globally.</p>
        <p>The Indian IT/ ITeS industry has a leading position globally and has been progressively contributing to the growth of exports and creation of employment opportunities. India’s IT-BPM industry (excluding e-commerce) is expected to reach at USD 254 billion, including exports of around 200 USD Billion in FY2023-24 (E). The IT-ITeS Industry has also created large employment opportunities and is estimated to employ 5.43 million professionals, an addition of 60,000 people over FY 2022-2023 (E). Women employees account for 36% share in total industry employee base.</p>
        <p>The Ministry of Electronics and Information Technology is coordinating strategic activities, promoting skill development programmes, enhancing infrastructure capabilities and supporting R&D for India’s leadership position in IT and IT-enabled Services.</p>
        
        <ul class="links">
            <li><a href="https://www.meity.gov.in/bpo-promotion-schemes">BPO promotion Schemes</a></li>
            <li><a href="#">Related Organizations</a></li>
            <li><a href="#">National Policy on Software Products (NPSP) – 2019</a></li>
            <li><a href="#">Domain Specific Centre for Entrepreneurship (CoE)</a></li>
            <li><a href="organization.php">projects</a></li>
        </ul>
    </div>
    

    


    
    <script src="include.js"></script>
</body>
</html>