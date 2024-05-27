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
        exit();
    } else {
        //insert values into STUDENT table

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
        } else {
            //check if student number already exists
            if (mysqli_affected_rows($conn) != 1){
                //if student number already exists, check if the name matches, if not prompt the user
                //query first and last name
                $query = "  SELECT fname, lname
                    FROM student 
                    WHERE studentID = '$StuID' ";
                $nameresult = mysqli_query ($conn, $query);
                
                $row = mysqli_fetch_assoc($nameresult);

                //match first and last name to what the user has input
                if (!(($row['fname'] == $fname) && ($row['lname'] == $lname))){
                    //if stuID and name do not match prompt user to check. Pass the variables in hidden input types if they need to be updated
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
                    exit();
                }
            } 
        }
    }
    echo "<h1>outside</h1>";
?>