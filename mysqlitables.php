<?php
    //This php script creates the mysqli tables required - STUDENT and ATTEMPT. This is a one to many relationship

    //check if STUDENT table exists and create it if it doesn't
    $query = "  CREATE TABLE IF NOT EXISTS student (
        studentID VARCHAR(10) PRIMARY KEY,
        fname VARCHAR(30),
        lname VARCHAR(30)
        )";
    $result = mysqli_query ($conn, $query);

    //insert values into STUDENT table
    $query = "  INSERT INTO student VALUES (
        '$StuID',
        '$fname',
        '$lname'
        )";

    $result = mysqli_query ($conn, $query);
?>