<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="supervisor page">
    <meta name="keywords" content="javascript, educational, mysqli, php, supervisor">
    <meta name="author" content="Eloise Ridder-Strickland, Oshadi Dewmini Pattiarachchi, Lucy Yu">
    <link rel="icon" type="image/x-icon" href="images/icon/favicon.ico">
    <title>Supervisor page</title>
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

    <!-- PAGE CONTENT -->
        <h1 class="page-title">Quiz supervisor page</h1>
        <p>This page is for the supervisor to moniter student learning.</p>

<!-- List all attempts.
• List all attempts for a particular student (given a student id OR name).

GIVEN STUDENT ID
SELECT student.studentID AS 'Student ID', student.fname AS 'First Name',student.lname AS 'Last Name', attempt.attemptNumber AS 'Attempt Number', attempt.attemptScore AS 'Attempt Score'
FROM student
INNER JOIN attempt 
ON student.studentID = attempt.studentID
WHERE student.studentID = *************;

GIVEN STUDENT FIRST AND LAST NAME
SELECT student.studentID AS 'Student ID', student.fname AS 'First Name',student.lname AS 'Last Name', attempt.attemptNumber AS 'Attempt Number', attempt.attemptScore AS 'Attempt Score'
FROM student
INNER JOIN attempt 
ON student.studentID = attempt.studentID
WHERE student.fname = *************
AND student.lname = **********;


• List all students (id, first and last name) who got 100% on their first attempt.

SELECT student.studentID AS 'Student ID', student.fname AS 'First Name',student.lname AS 'Last Name' 
FROM student
INNER JOIN attempt 
ON student.studentID = attempt.studentID
WHERE attempt.attemptNumber = 1
AND attempt.attemptScore = 5;

• List all students (id, first and last name) got less than 50% on their second attempt.

SELECT student.studentID AS 'Student ID', student.fname AS 'First Name',student.lname AS 'Last Name', attempt.attemptScore AS 'Attempt Score'
FROM student
INNER JOIN attempt 
ON student.studentID = attempt.studentID
WHERE attempt.attemptNumber = 2
AND attempt.attemptScore < 5/2;

• Delete all attempts for a particular student (given a student id).

DELETE FROM attempt
WHERE studentID = **********;

Change the score for a quiz attempt (given a student id and attempt number). 

UPDATE attempt
SET attemptScore = *******
WHERE studentID = ********
AND attemptNumber = *******;

• ENHANCEMENT - view feedback.

SELECT studentID as 'StudentID', comment AS 'Student Feedback'
FROM feedback;
-->





    <!-- FOOTER -->
    <?php
        include_once("footer.inc");
    ?>
    
</body>

</html>