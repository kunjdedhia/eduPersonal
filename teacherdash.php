<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Teacher Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>

<body>
    <?php
        session_start();
        echo "<center><h1>Welcome, ".$_SESSION["username"]."</h1></center><br><br><br>";

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
        $result = $conn->query($sql);
        $sql = "select admit.status, student.name, admit.student from admit join student on (admit.student=student.email) join assign on (admit.course = assign.course) where teacher='".$_SESSION["email"]."'";
        $result = $conn->query($sql);

        if($result->num_rows>0){
                //output
                echo "<center><table border='1px'><tr><td style='text-align:center;vertical-align:middle; width:150px;'>Student Name</td><td style='text-align:center;vertical-align:middle; width:150px;'>Student Email</td><td style='text-align:center;vertical-align:middle; width:150px;'>Status</td></tr>";
                while($row = $result->fetch_assoc()){
                    if ($row["status"]=="Take Exam" or $row["status"]==""){
                        echo "<tr><td style='text-align:center;vertical-align:middle'>".$row["name"]."</td><td style='text-align:center;vertical-align:middle'>".$row["student"]."</td><td style='text-align:center;vertical-align:middle'>Yet to take Exam</td></tr>";
                    } else if ($row["status"]=="Exam Taken"){
                        echo "<tr><td style='text-align:center;vertical-align:middle'>".$row["name"]."</td><td style='text-align:center;vertical-align:middle'>".$row["student"]."</td><td style='text-align:center;vertical-align:middle'><button type='button'>Grade Exam</button></td></tr>";
                    }
                }
                echo "</table></center>";
            }

    ?>

</body>
</html>