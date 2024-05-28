<?php
//This page checks if the input fields on the quiz page have all been filled out and in the correct format


//function used to sanitise data
function sanitise_input ($data) {
    $data = trim($data);
    $data = stripslashes ($data);
    $data = htmlspecialchars($data);
    return $data;
}

//FNAME FIELD
    //check if the form was submitted properly or if user just navigated to this page via url
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //check if a value has been input for first name
        if (isset ($_POST["fname"]) && !empty($_POST["fname"])) {
            //sanitise data with function
            $fname = $_POST["fname"];
            $fname = sanitise_input($fname);

            //check if fname satisfies format requirement
            if (  //name is less than 30 char
                    !(strlen($fname) <= 30) ||
                    //name is in alpha, space or hyphen
                    (preg_match('/[^a-z\s-]/i', $fname)) 
            ) {
                echo "<h1>Quiz submission error!</h1>
                    <p>Error: First name does not satisfy required format. Please try again at <a href=\"quiz.php\">quiz</a></p>";
                    include_once("footer.inc");      
                    //close the database connection
                    mysqli_close($conn);
                    exit();
            }
        } else {
            //prompt user to enter their first name if no input detected
            echo "<h1>Quiz submission error!</h1>
            <p>Error:  enter first name in the <a href=\"quiz.php\">quiz</a></p>";
            include_once("footer.inc");
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

        //check if lname satisfies format requirement
        if (  //name is less than 30 char
            !(strlen($lname) <= 30) ||
            //name is in alpha, space or hyphen
            (preg_match('/[^a-z\s-]/i', $lname)) 
        ) {
            echo "<h1>Quiz submission error!</h1>
            <p>Error: Last name does not satisfy required format. Please try again at <a href=\"quiz.php\">quiz</a></p>";
            include_once("footer.inc");      
            //close the database connection
            mysqli_close($conn);
            exit();
        }
    }
    else {
        echo "<p><h1>Quiz submission error!</h1>
        <p>Error: Enter last name data in the <a href=\"quiz.php\">quiz</a></p>";
        include_once("footer.inc");      
        //close the database connection
        mysqli_close($conn);
        exit();
    }    

//STUDENT ID FIELD
    if (isset ($_POST["StuID"]) && !empty($_POST["StuID"])) {
        //typecast variable to string 
        $StuID = (string)$_POST["StuID"];
        $StuID = sanitise_input($StuID);

        // Check if student ID satisfies format requirement (7-10 number digits)
        if (!(preg_match('/^\d{7,10}$/', $StuID))) {
            echo "<h1>Quiz submission error!</h1>
            <p>Error: Student ID does not satisfy required format. Please enter a 7 - 10 digit student number. <a href=\"quiz.php\">Try again.</a></p>";
            include_once("footer.inc");      
            //close the database connection
            mysqli_close($conn);
            exit();
        }
    }
    else {
        echo "<h1>Quiz submission error!</h1>
        <p>Error: Enter student ID in the <a href=\"quiz.php\">quiz</a></p>";
        include_once("footer.inc");      
        //close the database connection
        mysqli_close($conn);
        exit();
    }
    
//QUESTION 1
    //check if question answered
    if (isset ($_POST["text_input"]) && !empty($_POST["text_input"])) {
        $answerOne = $_POST["text_input"];
        $answerOne = sanitise_input(strtoupper($answerOne));

        // Check if student ID satisfies format requirement (7-10 number digits)
        if (!(preg_match('/^[A-Z]+$/', $answerOne))) {
            echo "<h1>Quiz submission error!</h1>
            <p>Error in Question 1. Please enter alphabet characters only. <a href=\"quiz.php\">Try again.</a></p>";
            include_once("footer.inc");      
            //close the database connection
            mysqli_close($conn);
            exit();
        }
    }
    else {
        echo "<h1>Quiz submission error!</h1>
        <p>Error: Please enter an answer for Question 1. <a href=\"quiz.php\">Try again.</a></p>";
        include_once("footer.inc");      
        //close the database connection
        mysqli_close($conn);
        exit();
    }

//QUESTION 2
    //check if question answered
    if (isset ($_POST["q2"])) {
        $answerTwo = $_POST["q2"];
    }
    else {
        echo "<h1>Quiz submission error!</h1>
        <p>Error: Please enter an answer for Question 2. <a href=\"quiz.php\">Try again.</a></p>";
        include_once("footer.inc");      
        //close the database connection
        mysqli_close($conn);
        exit();
    }
    
//QUESTION 3
    //check if question answered
    if(isset ($_POST["creation-date"]) && !empty($_POST["creation-date"])) {
        $answerThree = $_POST['creation-date'];
    }
    else {
        echo "<h1>Quiz submission error!</h1>
        <p>Error: Please enter an answer for Question 3. <a href=\"quiz.php\">Try again.</a></p>";
        include_once("footer.inc");      
        //close the database connection
        mysqli_close($conn);
        exit();
    }

//QUESTION 4
    //checkbox answers, initialize array
    $answerFour = array();

    //save answers into the array
    if (isset ($_POST["q3_a"])) {
        $answerFour[] = "a";
    }

    if (isset ($_POST["q3_b"])) {
        $answerFour[] = "b";
    }

    if (isset ($_POST["q3_c"])) {
        $answerFour[] = "c";
    }

    if (isset ($_POST["q3_d"])) {
        $answerFour[] = "d";
    }

    if (isset ($_POST["q3_e"])) {
        $answerFour[] = "e";
    }

    //display error if array is empty (no selections ticked)
    if (count($answerFour) == 0) {
        echo "<h1>Quiz submission error!</h1>
        <p>Error: Please select an answer(s) for Question 4. <a href=\"quiz.php\">Try again.</a></p>";
        include_once("footer.inc");      
        //close the database connection
        mysqli_close($conn);
        exit();
    }
?>