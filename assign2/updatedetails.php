<?php

//function used to sanitise data
function sanitise_input ($data) {
    $data = trim($data);
    $data = stripslashes ($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

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
    //connect to database *******MAKE SURE TO ADD YOUR OWN settings.php file**********
    require_once("settings.php");
    $conn = @mysqli_connect (
        $host,
        $user,
        $pwd,
        $sql_db
    );

    if (!$conn) {
        //if database connection fails display error message
        echo "<h1>Database Error!</h1>
        <p>Database connection failure. Please contact us.</p>";
        include_once("footer.inc");
        exit();
    } else {
        //database connection successful
        //assign and sanitise variables
        $StuID = (string)$_POST["StuID"];
        $StuID = sanitise_input($StuID); 
        $lname = $_POST["lname"];
        $lname = sanitise_input($lname);
        $fname = $_POST["fname"];
        $fname = sanitise_input($fname);
        
        //update the database details
        $query = "  UPDATE student 
            SET fname = '$fname', lname = '$lname'
            WHERE StudentID = '$StuID'";
        $result = mysqli_query ($conn, $query);

        //display message once fail or success
        if ($result == false){
            echo "<h1>Database Error!</h1>
            <p>Error: Unable to update database. Please try quiz submission again at <a href=\"quiz.php\">quiz</a></p>";
            include_once("footer.inc");
            //close the database connection
            mysqli_close($conn);            
            exit();
        } else {
            echo "<h1>Details updated. </h1>
            <p>Please complete <a href=\"quiz.php\">quiz</a> again with the correct details.</p>";
            include_once("footer.inc");
            //close the database connection
            mysqli_close($conn);      
            exit();
        }

        //close the database connection
        mysqli_close($conn);

        include_once("footer.inc");
    }

    ?>