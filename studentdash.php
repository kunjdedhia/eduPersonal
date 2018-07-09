<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Student Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />

    <script>
        function getRowIndex(obj){
            var course_id = document.getElementById('student_table').rows[obj.parentNode.rowIndex].cells[0].innerHTML;
            window.location.href = "exam.php?courseId=" + course_id;
            // pass course_id to exam.php
        }
    </script>

</head>

<body>
    <?php
        session_start();
        echo "<center><h1>Welcome, ".$_SESSION["username"]."</h1></center>";

        $server="localhost";
        $username="root";
        $password="";

        //Create Connection
        $conn=new mysqli($server, $username, $password);

        //Check Connection
        if($conn -> connect_error){
            die("Connection failed: ".$conn -> connect_error);
        }

        //Query
        $sql = "Use edupersonal";
        $conn->query($sql);
        $sql = "select admit.status, admit.course, course.course_name, teacher.name, admit.score from assign join course on (course.id=assign.course) join teacher on (assign.teacher=teacher.email) join admit on (course.id=admit.course) where student='".$_SESSION["email"]."'";
        $result = $conn->query($sql);

        if($result->num_rows>0){
                //output
                echo "<center><table id='student_table' border='1px'><tr><td style='text-align:center;vertical-align:middle; width:100px;'>Course ID</td><td style='text-align:center;vertical-align:middle; width:150px;'>Course Name</td><td style='text-align:center;vertical-align:middle; width:150px;'>Instructor Name</td><td style='text-align:center;vertical-align:middle; width:150px;'>Exam Status</td><td style='text-align:center;vertical-align:middle; width:150px;'>Score</td></tr>";
                while($row = $result->fetch_assoc()){
                    if ($row["status"]=="Take Exam" or $row["status"]==""){
                        echo "<tr><td style='text-align:center;vertical-align:middle'>".$row["course"]."</td><td style='text-align:center;vertical-align:middle'>".$row["course_name"]."</td><td style='text-align:center;vertical-align:middle'>".$row["name"]."</td><td onclick='getRowIndex(this)' style='text-align:center;vertical-align:middle'><button type='button'>Take Exam</button></td><td style='text-align:center;vertical-align:middle'>--</td></tr>";
                    } else if ($row["status"]=="Exam Taken"){
                        echo "<tr><td style='text-align:center;vertical-align:middle'>".$row["course"]."</td><td style='text-align:center;vertical-align:middle'>".$row["course_name"]."</td><td style='text-align:center;vertical-align:middle'>".$row["name"]."</td><td style='text-align:center;vertical-align:middle'>Exam Taken</td><td style='text-align:center;vertical-align:middle'>".$row["score"]."</td></tr>";
                    }
                }
                echo "</table></center>";
            }

    ?>

</body>

</html>