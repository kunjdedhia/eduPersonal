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
        $sql = "select student.name, admit.student from admit join student on (admit.student=student.email) join assign on (admit.course = assign.course) where teacher='".$_SESSION["email"]."'";
        $result = $conn->query($sql);

        if($result->num_rows>0){
                //output
                echo "<table border='1px'>";
                while($row = $result->fetch_assoc()){
                    echo "<tr><td>".$row["name"]."</td><td>".$row["student"]."</td></tr>";
                }
                echo "</table>";
            }

    ?>

</body>
</html>