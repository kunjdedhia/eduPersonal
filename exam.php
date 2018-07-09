<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />

</head>

<body>

    <center>
        <h1>Exam Time</h1>
        <p>Please do not refresh this page. Also, do not press the Back Button.</p>
        <p>Only use controls on the web page</p>
        <p><strong>Instructions</strong> - The following are Multiple Choice Questions. Please pick one of choices for each question that feel best answers the question alongside.</p>
        <br><br>
    </center>

    <?php
    session_start();

    //get course_id
    $_SESSION["courseExam"] = $_GET["courseId"];
   
    $server="localhost";
    $username="root";
    $password="";

    $_SESSION["count"] = 1;

    //Create Connection
    $conn=new mysqli($server, $username, $password);

    //Check Connection
    if($conn -> connect_error){
        die("Connection failed: ".$conn -> connect_error);
    }

    //Query
    $sql = "Use edupersonal";
    $conn->query($sql);
    $sql = "select mcq, optA, optB, optC, optD from question where course_topic=".$_SESSION["courseExam"];
    $result = $conn->query($sql);

    if($result->num_rows>0){
        //output
        echo "<center><form action='submitExam.php' method='post'>";
        echo "<table border='1px'><tr><td style='text-align:center;vertical-align:middle; width:700px;'>Question(s)</td><td style='text-align:center;vertical-align:middle; width:300px;'> Select one choice</td></tr>";
        while($row = $result->fetch_assoc()){
            echo "<tr><td>".$row["mcq"]."</td><td>
            <input type='radio' name='answer".$_SESSION["count"]."' value='a' required='true'/>".$row["optA"]."
            <br><input type='radio' name='answer".$_SESSION["count"]."' value='b'/>".$row["optB"]."
            <br><input type='radio' name='answer".$_SESSION["count"]."' value='c'/>".$row["optC"]."
            <br><input type='radio' name='answer".$_SESSION["count"]."' value='d'/>".$row["optD"]."
            <br></td></tr>";
            $_SESSION["count"]+=1;
        }
        echo "</table>";
        echo "<br><input type='submit' value='Submit Answers'/></form></center>";
    } else {
        echo "No questions found! Please contact your instructor";
    }

    ?>

</body>
</html>