<?php

//function used to sanitise data
function sanitise_input ($data) {
    $data = trim($data);
    $data = stripslashes ($data);
    $data = htmlspecialchars($data);
    return $data;
}

//connect to database *******MAKE SURE TO ADD YOUR OWN settings.php file**********
require_once("settings.php");
$conn = @mysqli_connect (
    $host,
    $user,
    $pwd,
    $sql_db
);

if (!$conn) {
    //if database connection fails display error message
    echo "<h1>Database Error!</h1>
    <p>Database connection failure. Please contact us.</p>";
    include_once("footer.inc");
    exit();
} else {
    //database connection successful
    //assign and sanitise variables
    $StuID = (string)$_POST["StuID"];
    $StuID = sanitise_input($StuID); 
    $lname = $_POST["lname"];
    $lname = sanitise_input($lname);
    $fname = $_POST["fname"];
    $fname = sanitise_input($fname);
    
    //update the database details
    $query = "  UPDATE student 
        SET fname = '$fname', lname = '$lname'
        WHERE StudentID = '$StuID'";
    $result = mysqli_query ($conn, $query);

    //display message once fail or success
    if ($result == false){
        echo "<h1>Database Error!</h1>
        <p>Error: Unable to update database. Please try quiz submission again at <a href=\"quiz.php\">quiz</a></p>";
        include_once("footer.inc");
        exit();
    } else {
        echo "<h1>Details updated. </h1>
        <p>Please complete <a href=\"quiz.php\">quiz</a> again with the correct details.</p>";
        include_once("footer.inc");
        exit();
    }

    //close the database connection
    mysqli_close($conn);
}

?>