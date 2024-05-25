<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Group Assignment">
    <meta name="keywords" content="HTML">
    <meta name="author" content="Oshadi Pattiarachchi">
    <link rel="icon" type="image/x-icon" href="images/icon/favicon.ico">
    <title>Javascript Quiz</title>
    <!-- embedded code for external google font "Share Tech" -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Share+Tech&display=swap" rel="stylesheet">

    <!-- css  -->
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/quiz_style.css">
</head>

<body>
    <!-- HEADER -->
    <?php
        include_once("header.inc");
    ?>

    <!-- PAGE CONTENT -->

    <!-- JavaScript Quiz Form -->
    <form action="markquiz.php" method="post" novalidate="novalidate">
        <!-- Title section -->
        <div class="title">
            <h1>JavaScript Quiz</h1>
            <p class="title_box">Are you ready to put your JavaScript skills to the test? <br>Let's get started!</p>
        </div>

        <!-- Student information and image container -->
        <div class="container">

            <!-- Section on student info -->
            <div class="stu_details">
                <h2>User Details</h2>

                <!-- First name, last name, and student ID input fields -->
                <label for="fname">First Name:</label>
                <input type="text" id="fname" name="fname" pattern="[A-Za-z\- ]{1,30}" required><br>

                <label for="lname">Last Name:</label>
                <input type="text" id="lname" name="lname" pattern="[A-Za-z\- ]{1,30}" required><br>

                <label for="StuID">Student ID:</label>
                <input type="text" id="StuID" name="StuID" placeholder="7 to 9 digit ID" pattern="[0-9]{7,9}" required>
            </div>
            <div class="image">

                <img src="images/IMG_5561.JPG" alt="Quiz page image 1">
            </div>
        </div>

        <br>
        <br>
        <br>

        <!-- Question 1 -->
        <div class="text_input">
            <label for="text_input">What is the official name of JavaScript? </label>
            <input type="text" id="text_input" name="text_input" placeholder="Enter.." required><br>
        </div>

        <!-- Question 2 -->
        <div class="que_2">
            <div class="image_2">
                <img src="images/IMG_2.jpg" alt="Quiz page image 2">
            </div>
            <p>Who is the inventor of JavaScript?</p>

            <!-- Answer choices for question 2 -->
            <div class="ans">
                <div class="answer">
                    <input type="radio" id="ans_1" name="q2" value="Guido van Rossum">
                    <label for="ans_1">Guido van Rossum</label><br>
                </div>
                <div class="answer">
                    <input type="radio" id="ans_2" name="q2" value="Tim Berners-Lee">
                    <label for="ans_2">Tim Berners-Lee</label><br>
                </div>
                <div class="answer">
                    <input type="radio" id="ans_3" name="q2" value="Brendan Eich">
                    <label for="ans_3">Brendan Eich</label><br>
                </div>
                <div class="answer">
                    <input type="radio" id="ans_4" name="q2" value="Bill Gates">
                    <label for="ans_4">Bill Gates</label><br>
                </div>
            </div>

        </div>
        <br>
        <br>

        <!-- Question 3 -->
        <div class="que_3">
            <!-- Dropdown for question 3 -->
            <label for="date">When was JavaScript first created?</label>
            <select id="date" name="creation-date" required>
                <option value="">Select Your Answer</option>
                <option value="angular">1997</option>
                <option value="react">1995</option>
                <option value="vue">1996</option>
                <option value="svelte">1990</option>
            </select>
        </div>
        <br>

        <!-- Question 4 -->
        <div class="que_4">
            <div class="image_3">
                <img src="images/IMG_3.jpg" alt="Quiz page image 3">
            </div>

            <p>What are some notable frameworks built with JavaScript?</p>

            <!-- Question 4 checkboxes -->
            <div class="checkbox-container">
                <input type="checkbox" id="ans_a" name="q3_a" value="Angular.js">
                <label for="ans_a">Angular.js</label>
            </div>

            <div class="checkbox-container">
                <input type="checkbox" id="ans_b" name="q3_b" value="jQuery">
                <label for="ans_b">jQuery</label>
            </div>

            <div class="checkbox-container">
                <input type="checkbox" id="ans_c" name="q3_c" value="Django">
                <label for="ans_c">Django</label>
            </div>

            <div class="checkbox-container">
                <input type="checkbox" id="ans_d" name="q3_d" value="React.js">
                <label for="ans_d">React.js</label>
            </div>

            <div class="checkbox-container">
                <input type="checkbox" id="ans_e" name="q3_e" value="CakePHP">
                <label for="ans_e">CakePHP</label>
            </div>

        </div>

        <br>
        <br>

        <!-- Question 5 -->
        <div class="que_5">

            <!-- Textarea for question 5 -->
            <label for="favorite_number">What is the difference between JavaScript and Java??</label><br>
            <textarea id="favorite_number" name="favorite_number" placeholder="Enter.." rows="4" cols="40"
                required></textarea><br><br>
        </div>

        <!-- Submit button -->
        <input type="submit" value="Submit">
    </form>

    <!-- FOOTER -->
    <?php
        include_once("footer.inc");
    ?>
</body>

</html>