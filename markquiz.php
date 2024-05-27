

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="mark quiz page for COS10032 assignment 2 on topic Javascript">
    <meta name="keywords" content="PHP, quiz, Javascript, educational, mysqli">
    <meta name="author" content="Eloise Ridder-Strickland, Oshadi Dewmini Pattiarachchi, Lucy Yu">
    <link rel="icon" type="image/x-icon" href="images/icon/favicon.ico">
    <title>Quiz submitted!</title>
    <!-- embedded code for external google font "Share Tech" -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Share+Tech&display=swap" rel="stylesheet">
    <!-- css  -->
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>
    <!-- HEADER -->
    <?php
        include_once("header.inc");
    ?>

<!-- BODY -->
    <?php

    //use this script to validate input fields have all been completed
    require_once("validatequizinputs.php");

    //connect to database *******MAKE SURE TO ADD YOUR OWN settings.php file**********
    require_once("settings.php");
    $conn = mysqli_connect (
        $host,
        $user,
        $pwd,
        $sql_db
    );

    if (!$conn) {
        //error message
        echo "<h1>Database Error!</h1>
        <p>Database connection failure. Please contact us.</p>";
    } else {

        //create tables
        require_once("mysqlitables.php");

    echo "<h1>Your Quiz results</h1>";








echo "<p>everything pass </p>";

    }
    ?>

    <!-- FOOTER -->
    <?php
        include_once("footer.inc");
    ?>

</body>



</html>