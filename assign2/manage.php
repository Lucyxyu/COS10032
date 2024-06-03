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
        <p>The following content is for the control of the Website Supervisor, if you are not an Authoritative member of that group please exit immediately, and contact support.</p>
        <p><strong>Related Pages: - manage.php - setting.php - mysqlitables.php - </strong></p>
<!----------------------------------------------------------------------------------->
    <?php
        require_once ("settings.php");//connection info
        $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
        /*
        Below line attempts to establish a connection to the MySQL database using the mysqli_connect function 
        with the parameters defined in settings.php. The @ symbol is used to suppress any error messages 
        that might be generated during the connection attempt.
        */
        //checks if connection is fails 
        if (!$conn) 
        {
            echo "<p>Connection failed: " . mysqli_connect_error()."</p>";
            exit();
        }
        /*
        This block checks if the connection to the database failed. 
        If it did, it prints an error message with the reason for the failure and exits the script.
        */

    //---TABLE 1. [ATTEMPTS]
//------------------------------------------------------------------------------------>     
    echo "<h2>1. All Attempts Logged</h2>"; 
        $query = "SELECT studentID, attemptNumber, attemptID, attemptDateTime, attemptScore 
                  FROM attempt 
                  ORDER BY attemptNumber";
        //>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        $result = mysqli_query($conn, $query);
        
        // if the execution is sucessful
        if ($result) 
        {
            echo "<table border='0'>";
            echo "<tr><th>Student ID</th><th>Attempt Number</th><th>Attempt ID</th><th>Date & Time</th><th>Score</th></tr>";
            // retreieve and display curren record pointed by the result pointer
            while ($row = mysqli_fetch_assoc($result)) 
            {
                echo "<tr>";
                echo "<td>{$row['studentID']}</td>"; //ID
                echo "<td>{$row['attemptNumber']}</td>"; //Number of attempts Made
                //-------------------------------------
                echo "<td>{$row['attemptID']}</td>"; //ID of the attempt
                echo "<td>{$row['attemptDateTime']}</td>"; //Date and time of the event
                echo "<td>{$row['attemptScore']}</td>"; //Current Score
                echo "</tr>";
            }
            echo "</table>";
        } 
        else 
        {
            echo "<p>omething is wrong with ", $query, "</p>";
            echo "<p>Error: " . mysqli_error($conn). "</p>";
        }
        // free up the memory, after using the result pointer
        mysqli_free_result($result);
        mysqli_close($conn);
?>
        <p> <!--The delete Function-->
            <input type="text" name= "Supervisor" id="std" pattern = "^\d{7,9}$" placeholder="Name OR Student ID"> <input type= "submit" value="Find">
		    <label for="std"><h3>- Select A Student Record -</h3></label> 
		</p>
<?php
//=====================================================================================
    require_once ("settings.php");//connection info
        $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
        if (!$conn) 
        {
            echo "<p>Connection failed: " . mysqli_connect_error()."</p>";
            exit();
        }

    //---TABLE 2. [LIST ATTEMPT PER PERSON] - \\JOIN attempts ON attemptID, attemptNumber, attemptScore\\
//------------------------------------------------------------------------------------>
        echo "<h2>2. Select Per Student Attempt</h2>"; 
        $query = "SELECT studentID, fname, lname 
                  FROM student 
                  
                  ORDER BY fname";
        //>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        $result = mysqli_query($conn, $query);
        
        if ($result) 
        {
            echo "<table border='1'>";
            echo "<tr><th>Student ID</th><th>Name</th><th>Surname</th></tr>";
            // retreieve and display curren record pointed by the result pointer
            while ($row = mysqli_fetch_assoc($result)) 
            {
                echo "<tr>";
                echo "<td>{$row['studentID']}</td>";
                echo "<td>{$row['fname']}</td>"; //First Name
                echo "<td>{$row['lname']}</td>"; //First Name
                echo "</tr>";
            }
            echo "</table>";
        } 
        else 
        {
            echo "<p>omething is wrong with ", $query, "</p>";
            echo "<p>Error: " . mysqli_error($conn). "</p>";
        }
        // free up the memory, after using the result pointer
        mysqli_free_result($result);
        mysqli_close($conn); 

//=====================================================================================
    require_once ("settings.php");//connection info
        $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
        if (!$conn) 
        {
            echo "<p>Connection failed: " . mysqli_connect_error()."</p>";
            exit();
        }

    //---TABLE 3. [ALL STUDENTS WITH 100% (1st Attempt)]
//------------------------------------------------------------------------------------>
        echo "<h2>3. 100% (First Attempt)</h2>"; 
        $query = "SELECT studentID, fname, lname 
                  FROM student 
                  ORDER BY fname";
        //>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    
        $result = mysqli_query($conn, $query);
        
        if ($result) 
        {
            echo "<table border='0'>";
            echo "<tr><th>Student ID</th><th>Name</th><th>Surname</th></tr>";
            // retreieve and display curren record pointed by the result pointer
            while ($row = mysqli_fetch_assoc($result)) 
            {
                echo "<tr>";
                echo "<td>{$row['studentID']}</td>";
                echo "<td>{$row['fname']}</td>"; //First Name
                echo "<td>{$row['lname']}</td>"; //First Name
                echo "</tr>";
            }
            echo "</table>";
        } 
        else 
        {
            echo "<p>omething is wrong with ", $query, "</p>";
            echo "<p>Error: " . mysqli_error($conn). "</p>";
        }
        // free up the memory, after using the result pointer
        mysqli_free_result($result);
        mysqli_close($conn); 

//=====================================================================================
    require_once ("settings.php");//connection info
        $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
        if (!$conn) 
        {
            echo "<p>Connection failed: " . mysqli_connect_error()."</p>";
            exit();
        }

    //---TABLE 4. [ALL STUDENTS LESS THAN 50% (1st Attempt)]
//------------------------------------------------------------------------------------>
    echo "<h2>4. Below 50% (First Attempt)</h2>";
         $query = "SELECT studentID, attemptNumber, attemptID, attemptDateTime, attemptScore 
                  FROM attempt 
                  ORDER BY attemptNumber";
        //>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        $result = mysqli_query($conn, $query);
        
        if ($result) 
        {
            echo "<table border='0'>";
            echo "<tr><th>Student ID</th><th>Attempt Number</th><th>Attempt ID</th><th>Date & Time</th><th>Score</th></tr>";
            // retreieve and display curren record pointed by the result pointer
            while ($row = mysqli_fetch_assoc($result)) 
            {
                echo "<tr>";
                echo "<td>{$row['studentID']}</td>"; //ID
                echo "<td>{$row['attemptNumber']}</td>"; //Number of attempts Made
                //-------------------------------------
                echo "<td>{$row['attemptID']}</td>"; //ID of the attempt
                echo "<td>{$row['attemptDateTime']}</td>"; //Date and time of the event
                echo "<td>{$row['attemptScore']}</td>"; //Current Score
                echo "</tr>";
            }
            echo "</table>";
        } 
        else 
        {
            echo "<p>omething is wrong with ", $query, "</p>";
            echo "<p>Error: " . mysqli_error($conn). "</p>";
        }
        // free up the memory, after using the result pointer
        mysqli_free_result($result);
        mysqli_close($conn); 

    
//=====================================================================================
    require_once ("settings.php");//connection info
        $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
        if (!$conn) 
        {
            echo "<p>Connection failed: " . mysqli_connect_error()."</p>";
            exit();
        }

    //---TABLE 5. [DELETE ALL ATTEMPTS FOR A PERSON]
//------------------------------------------------------------------------------------>
    echo "<h2>5. Delete Attempts</h2>";
         $query = "SELECT studentID
                  FROM student 
                  ORDER BY studentID";
        //>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        $result = mysqli_query($conn, $query);
        
        if ($result) 
        {
            echo "<table border='0'>";
            echo "<tr><th>Student ID</th><th>Status</th>";
            // retreieve and display curren record pointed by the result pointer
            while ($row = mysqli_fetch_assoc($result)) 
            {
                echo "<tr>";
                echo "<td>{$row['studentID']}</td>"; //ID
                echo "</tr>";
            }
            echo "</table>";
        } 
        else 
        {
            echo "<p>omething is wrong with ", $query, "</p>";
            echo "<p>Error: " . mysqli_error($conn). "</p>";
        }
        // free up the memory, after using the result pointer
        mysqli_free_result($result);
        mysqli_close($conn); 
?>
        <p> <!--The delete Function-->
            <input type="text" name= "Supervisor" id="std" pattern = "^\d{7,9}$" placeholder="Score"> <input type= "submit" value="Delete">
		    <label for="std"><h3>- Select An Attempt Record to DELETE -</h3></label> 
		</p>

<?php
//=====================================================================================
    require_once ("settings.php");//connection info
        $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
        if (!$conn) 
        {
            echo "<p>Connection failed: " . mysqli_connect_error()."</p>";
            exit();
        }

    //---TABLE 6. [MODIFY AN ATTEMPT]
//------------------------------------------------------------------------------------>
    echo "<h2>6. Modify Attempt Score</h2>";
         $query = "SELECT studentID, attemptNumber, attemptScore 
                  FROM attempt 
                  ORDER BY attemptNumber";
        //>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        $result = mysqli_query($conn, $query);
        
        if ($result) 
        {
            echo "<table border='0'>";
            echo "<tr><th>Student ID</th><th>Attempt Number</th><th>Score</th>";
            // retreieve and display curren record pointed by the result pointer
            while ($row = mysqli_fetch_assoc($result)) 
            {
                echo "<tr>";
                echo "<td>{$row['studentID']}</td>"; //ID
                echo "<td>{$row['attemptNumber']}</td>"; //Number of attempts Made
                echo "<td>{$row['attemptScore']}</td>"; //Current Score
                echo "</tr>";
            }
            echo "</table>";
        } 
        else 
        {
            echo "<p>omething is wrong with ", $query, "</p>";
            echo "<p>Error: " . mysqli_error($conn). "</p>";
        }
        // free up the memory, after using the result pointer
        mysqli_free_result($result);
        mysqli_close($conn); 
    ?>
        <!--Form for entering the student ID to delete.-->
        <p>
            <input type="text" name= "Supervisor" id="std" pattern = "^\d{7,9}$" placeholder="Enter A Student ID">
            <label for="std"><h3>- Select A Student ID to MODIFY the Score Record -</h3></label> 
		</p>
        <p>
            <input type="number" name= "Supervisor" id="std" pattern = "^\d{7,9}$" placeholder="Enter the NEW Score"> <input type= "submit" value="Change">
            <label for="std"><h3>- Enter the NEW Score -</h3></label> 
		</p>
<!------------------------------------------------------------------------------------>


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