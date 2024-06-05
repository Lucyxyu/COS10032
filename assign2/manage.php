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
    <article>
        <h1 class="page-title">Quiz supervisor page</h1>
        <h3>Welcome to the Supervisor Page! In this section you are able to VEIW, SEARCH and MODIFY records within the QUIZ Database.</h3>
        <p>---(!) The following content is for the control of the Website Supervisor, if you are not an Authoritative member of that group please exit immediately, and contact support. (!)--- </p>
        <p><strong>Related Pages (Database):</strong> </br>
            <strong>- manage.php (YOU ARE HERE)</strong></br>
            - setting.php </br>
            - mysqlitables.php </br>
        </p>

<!--===================================================================================================-->  
<!---TABLE 1. [ATTEMPTS]-->
<!--===================================================================================================-->
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
//------------------------------------------------------------------------------------>     
    echo "<h2>1. All Attempts Logged</h2>"; 
        $query = "SELECT student.studentID, student.fname, student.lname, attempt.attemptNumber, attempt.attemptID, attempt.attemptDateTime, attempt.attemptScore 
                  FROM attempt 
                  INNER JOIN student
                  ON student.studentID = attempt.studentID
                  ORDER BY attempt.attemptNumber";
        //>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        $result = mysqli_query($conn, $query);
        
        // if the execution is sucessful
        if ($result) 
        {
            echo "<table border='0'>";
            echo "<tr><th>Student ID</th><th>Name</th><th>Surname</th><th>Date & Time</th><th>Attempt ID</th><th>Attempt Number</th><th>Score</th></tr>";
            // retreieve and display curren record pointed by the result pointer
            while ($row = mysqli_fetch_assoc($result)) 
            {
                echo "<tr>";
                echo "<td>{$row['studentID']}</td>"; //ID
                echo "<td>{$row['fname']}</td>";
                echo "<td>{$row['lname']}</td>";
                echo "<td>{$row['attemptDateTime']}</td>"; //Date and time of the event
                //-------------------------------------
                echo "<td>{$row['attemptID']}</td>"; //ID of the attempt
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
//===================================================================================================>
//---TABLE 1. [FEEDBACK DISPLAY] 
//===================================================================================================>
        require_once ("settings.php");//connection info
        $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
    
        if (!$conn) 
        {
            echo "<p>Connection failed: " . mysqli_connect_error()."</p>";
            exit();
        }
//------------------------------------------------------------------------------------>
        echo "<h2>Feedback Log</h2>"; 
        $query = "SELECT student.studentID, student.fname, student.lname, feedback.feedbackID, feedback.comment 
                  FROM feedback
                  INNER JOIN student
                  ON student.studentID = feedback.studentID
                  ORDER BY student.fname";
        //>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        $result = mysqli_query($conn, $query);
        
        // if the execution is sucessful
        if ($result) 
        {
            echo "<table border='0'>";
            echo "<tr><th>Student ID</th><th>Name</th><th>Surname</th><th>Feedback</th><th>Feedback</th></tr>";
            // retreieve and display curren record pointed by the result pointer
            while ($row = mysqli_fetch_assoc($result)) 
            {
                echo "<tr>";
                echo "<td>{$row['studentID']}</td>"; //ID
                echo "<td>{$row['fname']}</td>";
                echo "<td>{$row['lname']}</td>";
                echo "<td>{$row['comment']}</td>";
                echo "<td>{$row['feedbackID']}</td>";
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

//===================================================================================================>
//---TABLE 2. [LIST ATTEMPT PER PERSON] 
//===================================================================================================>
?>
<h2>2. Select Per Student Attempt</h2>
<form method="post" action="">
    <p>
        <input type="text" name="studentID_or_fname" id="std" pattern="^\d{7,9}$|^[a-zA-Z]+$" placeholder="Enter Student ID or Name">
        <input type="submit" value="Find">
        <input type="submit" name="reset" value="Reset Search">
        <label for="std"><h3>- Select A Student Record -</h3></label>
    </p>
</form>

<div id="results">
<?php
        require_once("settings.php"); //connection info
        $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

        if (!$conn) 
        {
            echo "<p>Connection failed: " . mysqli_connect_error() . "</p>";
            exit();
        }
        if (isset($_POST['studentID_or_fname'])) 
        {
            $input = mysqli_real_escape_string($conn, $_POST['studentID_or_fname']);
            $query = "";
        if (is_numeric($input)) //If the search is by the Student Number
        {
            //For Numeric Inputs
            $query = "SELECT student.studentID, student.fname, student.lname, attempt.attemptNumber, attempt.attemptID, attempt.attemptDateTime, attempt.attemptScore 
                      FROM attempt 
                      INNER JOIN student ON student.studentID = attempt.studentID
                      WHERE student.studentID = '$input' 
                      ORDER BY attempt.attemptNumber";
        } 
        else //If the search is by the Name
        {
            //For String Inputs
            $query = "SELECT student.studentID, student.fname, student.lname, attempt.attemptNumber, attempt.attemptID, attempt.attemptDateTime, attempt.attemptScore 
                      FROM attempt 
                      INNER JOIN student ON student.studentID = attempt.studentID
                      WHERE student.fname = '$input'
                      ORDER BY attempt.attemptNumber";
        }

        $result = mysqli_query($conn, $query);
        if ($result) 
        {
            echo "<table border='0'>";
            echo "<tr><th>Student ID</th><th>First Name</th><th>Last Name</th><th>Date & Time</th><th>Attempt ID</th><th>Attempt Number</th><th>Attempt Score</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['studentID']}</td>";
                echo "<td>{$row['fname']}</td>";
                echo "<td>{$row['lname']}</td>";
                echo "<td>{$row['attemptDateTime']}</td>";
                echo "<td>{$row['attemptID']}</td>";
                echo "<td>{$row['attemptNumber']}</td>";
                echo "<td>{$row['attemptScore']}</td>";
                echo "</tr>";
            }
            echo "</table>";
        } 
        else 
        {
            echo "<p>Something is wrong with the query: $query</p>";
            echo "<p>Error: " . mysqli_error($conn) . "</p>";
        }
        mysqli_free_result($result);
    }

    mysqli_close($conn);
    
//===================================================================================================>
//---TABLE 3. [ALL STUDENTS WITH 100% (1st Attempt)]
//===================================================================================================>
    require_once("settings.php"); // connection info
    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

    if (!$conn) {
        echo "<p>Connection failed: " . mysqli_connect_error() . "</p>";
        exit();
    }

    echo "<h2>3. 100% (First Attempt)</h2>";
    $query = "SELECT student.studentID, student.fname, student.lname, attempt.attemptNumber, attempt.attemptID, attempt.attemptScore 
            FROM attempt 
            INNER JOIN student ON student.studentID = attempt.studentID
            WHERE attempt.attemptNumber = 1 AND attempt.attemptScore = 5 
            ORDER BY student.studentID"; // Order by studentID

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<table border='0'>";
        echo "<tr><th>Student ID</th><th>Name</th><th>Surname</th><th>Attempt ID</th><th>Attempt Number</th><th>Score</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['studentID']}</td>"; // ID
            echo "<td>{$row['fname']}</td>"; // First Name
            echo "<td>{$row['lname']}</td>"; // Last Name
            echo "<td>{$row['attemptID']}</td>"; // Attempt ID
            echo "<td>{$row['attemptNumber']}</td>"; // Attempt Number
            echo "<td>{$row['attemptScore']}</td>"; // Score
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Something is wrong with ", $query, "</p>";
        echo "<p>Error: " . mysqli_error($conn) . "</p>";
    }

    // Free up the memory, after using the result pointer
    mysqli_free_result($result);
    mysqli_close($conn);

//===================================================================================================>
//---TABLE 4. [ALL STUDENTS LESS THAN 50% (1st Attempt)]
//===================================================================================================>
    require_once("settings.php"); // connection info
    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

    if (!$conn) {
        echo "<p>Connection failed: " . mysqli_connect_error() . "</p>";
        exit();
    }

    echo "<h2>4. Below 50% (Second Attempt)</h2>";
    $query = "SELECT student.studentID, student.fname, student.lname, attempt.attemptNumber, attempt.attemptID, attempt.attemptScore 
            FROM attempt 
            INNER JOIN student ON student.studentID = attempt.studentID
            WHERE attempt.attemptNumber = 2 AND attempt.attemptScore <= 2
            ORDER BY student.studentID"; // Order by studentID

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<table border='0'>";
        echo "<tr><th>Student ID</th><th>Name</th><th>Surname</th><th>Attempt ID</th><th>Attempt Number</th><th>Score</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['studentID']}</td>"; // ID
            echo "<td>{$row['fname']}</td>"; // First Name
            echo "<td>{$row['lname']}</td>"; // Last Name
            echo "<td>{$row['attemptID']}</td>"; // Attempt ID
            echo "<td>{$row['attemptNumber']}</td>"; // Attempt Number
            echo "<td>{$row['attemptScore']}</td>"; // Score
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Something is wrong with ", $query, "</p>";
        echo "<p>Error: " . mysqli_error($conn) . "</p>";
    }

    // Free up the memory, after using the result pointer
    mysqli_free_result($result);
    mysqli_close($conn);

//===================================================================================================>
//---TABLE 5. [DELETE ALL ATTEMPTS FOR A PERSON]
//===================================================================================================>
?>
    <h2>5. Modify Attempts</h2>  
    <form method="post" action="">
        <p>
            <input type="text" name="search_input" id="MAA" pattern="^\d{7,9}$" placeholder="Student ID">
            <input type="submit" value="Find Attempt">
            <input type="submit" name="reset" value="Reset Search">
            <label for="std"><h3>- Select A Student Record -</h3></label>
        </p>
    </form>

    <div id="results">
<?php
    require_once("settings.php"); // connection info
    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

    if (!$conn) 
    {
        echo "<p>Connection failed: " . mysqli_connect_error() . "</p>";
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        if (isset($_POST['reset'])) 
        {
            // Reset search logic (if any)
        } 
        else if (isset($_POST['update_score'])) 
        {
            $attemptID = mysqli_real_escape_string($conn, $_POST['attemptID']);
            $attemptNumber = mysqli_real_escape_string($conn, $_POST['attemptNumber']);
            $update_query = "UPDATE attempt SET attemptNumber = '$attemptNumber' WHERE attemptID = '$attemptID'";
            if (mysqli_query($conn, $update_query)) 
            {
                echo "<p>Attempt Number updated successfully.</p>";
            } 
            else 
            {
                echo "<p>Error updating attempt Number: " . mysqli_error($conn) . "</p>";
            }
        } 
        else if (isset($_POST['search_input'])) // Ensure search_input is set
        {
            $input = mysqli_real_escape_string($conn, $_POST['search_input']);
            if (is_numeric($input))  
            {
                $query = "SELECT student.studentID, student.fname, student.lname, attempt.attemptNumber, attempt.attemptID, attempt.attemptDateTime, attempt.attemptScore 
                    FROM attempt 
                    INNER JOIN student ON student.studentID = attempt.studentID
                    WHERE student.studentID = '$input'
                    ORDER BY attempt.attemptNumber";

            } 
            else 
            {
                echo "<p>Invalid input. Please enter a numeric Student ID (7-9 Characters).</p>";
                exit();
            }

            $result = mysqli_query($conn, $query);
            if ($result) 
            {
                echo "<table border='0'>";
                echo "<tr><th>Student ID</th><th>First Name</th><th>Last Name</th><th>Date & Time</th><th>Attempt ID</th><th>Attempt Score</th><th>Attempt Number</th><th>Edit Attempt</th></tr>";
                while ($row = mysqli_fetch_assoc($result)) 
                {
                    echo "<tr>";
                    echo "<td>{$row['studentID']}</td>";
                    echo "<td>{$row['fname']}</td>";
                    echo "<td>{$row['lname']}</td>";
                    echo "<td>{$row['attemptDateTime']}</td>";
                    echo "<td>{$row['attemptID']}</td>";
                    echo "<td>{$row['attemptScore']}</td>";
                    echo "<td>{$row['attemptNumber']}</td>";
                    echo "<td>";
                    echo "<form method='post' action=''>";
                    echo "<input type='hidden' name='attemptID' value='{$row['attemptID']}'>";
                    echo "<input type='number' name='attemptNumber' value='{$row['attemptNumber']}' required>";
                    echo "<input type='submit' name='update_score' value='Update'>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } 
            else 
            {
                echo "<p>Something is wrong with the query: $query</p>";
                echo "<p>Error: " . mysqli_error($conn) . "</p>";
            }
            mysqli_free_result($result);
        }
    }

    mysqli_close($conn);

//===================================================================================================>
//---TABLE 6. [MODIFY AN ATTEMPT]
//===================================================================================================>
?>
    </div>
    <h2>6. Modify Score</h2>  
    <form method="post" action="">
        <p>
        <input type="text" name="search_input" id="MAA" pattern="^\d{1,9}$" placeholder="Student ID or Attempt No.">
        <input type="submit" value="Find Score">
        <input type="submit" name="reset" value="Reset Search">
        <label for="std"><h3>- Select A Student Record -</h3></label>
        </p>
    </form>

    <div id="results">
    <?php
        require_once("settings.php"); // connection info
        $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

        if (!$conn) 
        {
            echo "<p>Connection failed: " . mysqli_connect_error() . "</p>";
            exit();
        }
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
            if (isset($_POST['reset'])) 
            {
            // Reset search logic (if any)
            } 
            else if (isset($_POST['update_score'])) 
            {
                $attemptID = mysqli_real_escape_string($conn, $_POST['attemptID']);
                $attemptNumber = mysqli_real_escape_string($conn, $_POST['attemptNumber']);
                $update_query = "UPDATE attempt SET attemptNumber = '$attemptNumber' WHERE attemptID = '$attemptID'";
                if (mysqli_query($conn, $update_query)) 
                {
                    echo "<p>Score updated successfully.</p>";
                } 
                else 
                {
                    echo "<p>Error updating attempt Number: " . mysqli_error($conn) . "</p>";
                }
            } 
            else if (isset($_POST['search_input'])) // Ensure search_input is set
            {
                $input = mysqli_real_escape_string($conn, $_POST['search_input']);
                if (is_numeric($input)) 
                {
                    $query = "SELECT student.studentID, student.fname, student.lname, attempt.attemptNumber, attempt.attemptID, attempt.attemptDateTime, attempt.attemptScore 
                        FROM attempt 
                        INNER JOIN student ON student.studentID = attempt.studentID
                        WHERE student.studentID = '$input' OR attempt.attemptNumber = '$input'
                        ORDER BY attempt.attemptNumber";
                } 
                else 
                {
                    echo "<p>Invalid input. Please enter a numeric Student ID or Attempt Number.</p>";
                    exit();
                }

                $result = mysqli_query($conn, $query);
                if ($result) 
                {
                    echo "<table border='0'>";
                    echo "<tr><th>Student ID</th><th>First Name</th><th>Last Name</th><th>Date & Time</th><th>Attempt ID</th><th>Attempt Number</th><th>Attempt Score</th><th>Edit Score</th></tr>";
                    while ($row = mysqli_fetch_assoc($result)) 
                    {
                        echo "<tr>";
                        echo "<td>{$row['studentID']}</td>";
                        echo "<td>{$row['fname']}</td>";
                        echo "<td>{$row['lname']}</td>";
                        echo "<td>{$row['attemptDateTime']}</td>";
                        echo "<td>{$row['attemptID']}</td>";
                        echo "<td>{$row['attemptNumber']}</td>";
                        echo "<td>{$row['attemptScore']}</td>";
                        echo "<td>";
                        echo "<form method='post' action=''>";
                        echo "<input type='hidden' name='attemptID' value='{$row['attemptID']}'>";
                        echo "<input type='number' name='attemptScore' value='{$row['attemptScore']}' required>";
                        echo "<input type='submit' name='update_score' value='Update'>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } 
                else 
                {
                    echo "<p>Something is wrong with the query: $query</p>";
                    echo "<p>Error: " . mysqli_error($conn) . "</p>";
                }
                mysqli_free_result($result);
            }
        }
    mysqli_close($conn);
?>
</div>

 <!-- FOOTER -->
<?php
        include_once("footer.inc");
?>
