<?php
    //This php script creates the mysqli tables required - STUDENT and ATTEMPT. This is a one to many relationship

    //check if STUDENT table exists and create it if it doesn't

    echo "<p> before</p>";
    $query = "  CREATE TABLE IF NOT EXISTS student (
        studentID VARCHAR(10) PRIMARY KEY,
        fname VARCHAR(30),
        lname VARCHAR(30)
        )";
   
    $result = mysqli_query ($conn, $query);
    echo "<p> created</p>";

    //insert values into STUDENT table
    $query = "  INSERT INTO student VALUES (
        '$StuID',
        '$fname',
        '$lname'
        )";
        echo "<p> before inseryt</p>";

    $result = mysqli_query ($conn, $query);

        echo "<p> inserted</p>";


?>