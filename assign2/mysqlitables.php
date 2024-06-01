<?php

    //This php script creates the mysqli tables required - STUDENT and ATTEMPT. This is a one to many relationship

    //check if STUDENT table exists and create it if it doesn't
    $query = "  CREATE TABLE IF NOT EXISTS student (
        studentID VARCHAR(10) PRIMARY KEY,
        fname VARCHAR(30),
        lname VARCHAR(30)
        )";

    //store the result in $result
    $result = mysqli_query ($conn, $query);

    //check if table exists or was created successfully
    if (!$result){
        echo "<h1>Database Error!</h1>
        <p>Database table creation failure. Please contact us.</p>";
        include_once("footer.inc");      
        //close the database connection
        mysqli_close($conn);
        exit();
    } else {
        //insert values into STUDENT table

        //If the Student ID already exists then ignore the insert
        $query = "  INSERT IGNORE INTO student VALUES (
            '$StuID',
            '$fname',
            '$lname'
            )";
        $result = mysqli_query ($conn, $query);

        //check if value was inserted successfuly
        if (!$result){
            //error message if boolean returns false
            echo "<h1>Database Error!</h1>
            <p>Database insertion failure. Please contact us.</p>";
            include_once("footer.inc");      
            //close the database connection
            mysqli_close($conn);
            exit();
        } else {
            //check if student number already exists (if affected rows is 1, means the insert was successful, if not then the student ID already exists)
            if (mysqli_affected_rows($conn) != 1){
                //if student number already exists, check if the name matches, if not prompt the user
                //query first and last name
                $query = "  SELECT fname, lname
                    FROM student 
                    WHERE studentID = '$StuID' ";
                $nameresult = mysqli_query ($conn, $query);
                
                //save the names into $row
                $row = mysqli_fetch_assoc($nameresult);

                //match first and last name to what the user has input
                if (!((strtoupper($row['fname']) == strtoupper($fname)) && (strtoupper($row['lname']) == strtoupper($lname)))){
                    //if stuID and name do not match prompt user to check. Form has been used to pass the variables in hidden input types to updatedetails.php file
                    echo "<h1>Verification required</h1>

                    <form action='updatedetails.php' method='post'>
                    <p>The student number entered does not match the name records.
                    Please confirm the follow details:<br>
                    Student ID: $StuID <br>
                    First Name: $fname <br>
                    Last Name: $lname </p>
                    
                    <input type='hidden' name='fname' value= '$fname'>
                    <input type='hidden' name='lname' value= '$lname'>
                    <input type='hidden' name='StuID' value= '$StuID'>
                    <input type='submit' class='get-started' 
                    value='Details are correct, please update my name in the Database.'>
                    </form>

                    <a class='get-started' href='quiz.php'>Details are incorrect, go back and try again</a>

                    <p>*** Please note you will need to contact an administrator if your student ID has been incorrectly used for a previous quiz attempt</p>";
                    include_once("footer.inc");
                    exit();
                }
            } 
        }
    } 

    //ATTEMPT TABLE
    //check if ATTEMPT table exists and create it if it doesn't
    $query = "  CREATE TABLE IF NOT EXISTS attempt (
        attemptID INT AUTO_INCREMENT PRIMARY KEY,
        studentID VARCHAR(10),
        attemptDateTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        attemptNumber INT(1),
        attemptScore INT(1),
        FOREIGN KEY (studentID) REFERENCES student(studentID)
        )";
    //store the result 
    $result = mysqli_query ($conn, $query);

    //check if table exists or was created successfully
    if (!$result){
        echo "<h1>Database Error!</h1>
        <p>Database table creation failure. Please contact us.</p>";
        include_once("footer.inc");
        //close the database connection
        mysqli_close($conn);
        exit();
    } else {
        //create constant to set max number of quiz attemps
        define ("MAX_QUIZ_ATTEMPTS", 2);

        //first check table to see if maximum number of quiz attempts has been reached
        $query = "  SELECT *
            FROM attempt 
            WHERE studentID = '$StuID'
            AND attemptNumber = ".MAX_QUIZ_ATTEMPTS;
        $attemptresult = mysqli_query ($conn, $query);
        
        //save the result into $row
        $row = mysqli_fetch_assoc($attemptresult);

        if (mysqli_affected_rows($conn) == 1){
            echo "<h1>Quiz Error!</h1>
                <p>You have reached the Maximum number of attempts. Please contact us if this is an error.</p>";
                include_once("footer.inc");
                //close the database connection
                mysqli_close($conn);
                exit();
        } else {
            //check how many previous attempts student has had 
            $query = "  SELECT attemptNumber
                FROM attempt 
                WHERE studentID = '$StuID'";
            $attemptresult = mysqli_query ($conn, $query);
            $row = mysqli_fetch_assoc($attemptresult);

            //assign current attempt number based on query result
            if ($row['attemptNumber'] == 1) {
                $attemptNumber = 2;
            } else {
                $attemptNumber = 1;
            }

            $query = "  INSERT INTO attempt 
                (attemptID, studentID, attemptDateTime, attemptNumber, attemptScore)
                VALUES (NULL, '$StuID', NULL," .$attemptNumber. "," .$quizScore.")";
            $attemptresult = mysqli_query ($conn, $query);
                
            //check if table insertion was siccessful
            if (!$attemptresult){
                echo "<h1>Database Error!</h1>
                <p>Database table creation failure. Please contact us.</p>";
                include_once("footer.inc");
                //close the database connection
                mysqli_close($conn);
                exit();
            }
        }
    }


    //COMMENT TABLE
    //add a comment to the comment table if an optional comment has been input
    if (isset ($comment) && !empty($comment)) {
        //CREATE COMMENT TABLE
        $query = "  CREATE TABLE IF NOT EXISTS feedback (
            feedbackID INT AUTO_INCREMENT,
            studentID VARCHAR(10),
            comment VARCHAR(300),
            PRIMARY KEY (feedbackID, studentID),
            FOREIGN KEY (studentID) REFERENCES student(studentID)
            )";
    
        //store the result in $result
        $result = mysqli_query ($conn, $query);

        //check if table exists or was created successfully
        if (!$result){
            echo "<h1>Database Error!</h1>
            <p>Database table creation failure. Please contact us.</p>";
            include_once("footer.inc");      
            //close the database connection
            mysqli_close($conn);
            exit();
        } else {
       
            //Insert comment into table
            $query = "  INSERT INTO feedback VALUES (
                NULL,
                '$StuID',
                '$comment'
                )";
            $result = mysqli_query ($conn, $query);

            //throw error if not successful
            if (!$result){
                echo "<h1>Database Error!</h1>
                <p>Database table creation failure. Please contact us.</p>";
                include_once("footer.inc");      
                //close the database connection
                mysqli_close($conn);
                exit();
            }
        }
    }

?>