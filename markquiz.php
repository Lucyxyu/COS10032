<?php

//functions used to mark question data
function mark_question ($data, $answer) {
    //q4 is array format hence check here if we are marking question 4
    if (is_array($answer)) {
        //initialise score
        $marksReceived = 0;

        //iterate through user answer and correct answer array, matching same values. Each correct answer +1 mark
        for ($i = 0; $i < count($data); $i++){
            for ($j = 0; $j < count($answer); $j++){
                if ($data[$i] == $answer[$j]){
                    $marksReceived++;
                }
            }
        }
        //return the marks obtained value
        return $marksReceived;
    }

    if (is_string($answer)){
        //change string to upper case for easier validation
        $data = strtoupper($data);
        $answer = strtoupper ($answer);

        //return 1 mark if answers match, 0 if they don't
        if ($data == $answer) {
            return 1;
        } else {
            return 0;
        }
    }
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
    //use this script to validate input fields have all been completed and sanitise all the data
    require_once("validatequizinputs.php");

    //MARK THE QUIZ
    //first, define the correct answer for all questions
    define("ANSWERONECORRECT", "ECMAScript");
    define("ANSWERTWOCORRECT", "Brendan Eich");
    define("ANSWERTHREECORRECT", "1995");
    define("ANSWERFOURCORRECT", ["a", "d"]);

    //call the marking function and add the score together, save in quizScore variable
    $quizScore = mark_question($answerOne, ANSWERONECORRECT)
                + mark_question($answerTwo, ANSWERTWOCORRECT)
                + mark_question($answerThree, ANSWERTHREECORRECT)
                + mark_question($answerFour, ANSWERFOURCORRECT);

    //define the full marks
    define("QUIZFULLSCORE", 5);

    $percentageScore = $quizScore/QUIZFULLSCORE * 100;

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
        include_once("footer.inc");
        //close the database connection
        mysqli_close($conn);
        exit();
    } else {

        //create tables
        require_once("mysqlitables.php");

    echo "<h1>Your Quiz results</h1>

        <p>Student ID: $StuID<br>
        Name: $fname $lname<br>
        Attempt number: $attemptNumber</p>";

        if ($attemptNumber == 1) {
            echo "<p>To attempt the quiz again <a href=\"quiz.php\">click here</a>.</p>";
        }

        //message if quiz score was 0
        if ($quizScore == 0) {
            echo "<p id='congratulationsMessage'>You scored " .$quizScore. "%. Please reread the information again <a href='topic.php'>here.</a></p>";
        } else {
            echo "<p id='congratulationsMessage'>Congratulations! Your score is " .$percentageScore. "%</p>";
        }
    

    //close the database connection
    mysqli_close($conn);
    }
?>

<!-- FOOTER -->
    <?php
        include_once("footer.inc");
    ?>

</body>



</html>