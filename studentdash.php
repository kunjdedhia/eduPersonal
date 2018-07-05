<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
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
        $sql = "select admit.course, course.course_name, teacher.name from assign join course on (course.id=assign.course) join teacher on (assign.teacher=teacher.email) join admit on (course.id=admit.course) where student='".$_SESSION["email"]."'";
        $result = $conn->query($sql);

        if($result->num_rows>0){
                //output
                echo "<table border='1px'>";
                while($row = $result->fetch_assoc()){
                    echo "<tr><td>".$row["course"]."</td><td>".$row["course_name"]."</td><td>".$row["name"]."</td></tr>";
                }
                echo "</table>";
            }
    ?>

</body>
</html>