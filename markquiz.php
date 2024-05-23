<!-- This function is used to sanitise the data -->
<?php
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

    echo "<h1>Quiz submitted!</h1>";

    //FNAME FIELD
    //check if the form was submitted properly or if user just navigated to this page via url
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset ($_POST["fname"]) && !empty($_POST["fname"])) {
            //assign fname variable
            $fname = $_POST["fname"];
            $fname = sanitise_input($fname);
        } else {
            //prompt user to enter their first name
            echo "<p>Error: Please enter first name in the <a href=\"quiz.php\">quiz</a></p>";
            exit();
        }
    //redirect back to the quiz if the form was not submitted properly
    } else {
            header("location: quiz.php");
    }

    //LNAME FIELD
    if (isset ($_POST["lname"]) && !empty($_POST["lname"])) {
        $lname = $_POST["lname"];
        $lname = sanitise_input($lname);
    }
    else {
        echo "<p>Error: Enter last name data in the <a href=\"quiz.php\">quiz</a></p>";
        exit();
    }    

    //STUDENT ID FIELD
    if (isset ($_POST["StuID"]) && !empty($_POST["StuID"])) {
        $StuID = $_POST["StuID"];
        $StuID = sanitise_input($StuID);
    }
    else {
        echo "<p>Error: Enter student ID in the <a href=\"quiz.php\">quiz</a></p>";
        exit();
    }    

    ?>

    <!-- FOOTER -->
    <?php
        include_once("footer.inc");
    ?>

</body>



</html>