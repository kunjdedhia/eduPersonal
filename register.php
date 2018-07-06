<?php
    
    session_start();

    $server="localhost";
    $username="root";
    $password="";

    //Create Connection
    $conn=new mysqli($server, $username, $password);

    //Check Connection
    if($conn -> connect_error){
        die("Connection failed: ".$conn -> connect_error);
        echo "Redirecting back to registration page...";
        header("refresh:3;url=register.html");
    }

    $name = $_POST["name"];
    $user = $_POST["user"];
    $pass = $_POST["pass"];
    $level = $_POST["level"];
   
    if($level=="student"){
        //Query
        $sql = "Use edupersonal";
        $result = $conn->query($sql);

        $sql = "select * from teacher where email='$user'";
        $result = $conn->query($sql);
        if($result->num_rows>0){
            //already exists as teacher
            echo "Unsuccessful attempt. This email is already registered as a Teacher. Redirecting back to registration page...";
            header("refresh:3;url=register.html");
        } else {
            $sql = "insert into student values('$user','$pass','$name')";
            $result = $conn->query($sql);

            $_SESSION["username"] = $name;
            $_SESSION["email"] = $user;

            header("refresh:0;url=studentdash.php" );
        }

    } else if($level=="teacher"){
        //Query
        $sql = "Use edupersonal";
        $result = $conn->query($sql);

        $sql = "select * from student where email='$user'";
        $result = $conn->query($sql);
        if($result->num_rows>0){
            //already exists as student
            echo "Unsuccessful attempt. This email is already registered as a Student. Redirecting back to registration page...";
            header("refresh:3;url=register.html");
        } else {
            $sql = "insert into teacher values('$user','$pass','$name')";
            $result = $conn->query($sql);

            $_SESSION["username"] = $name;
            $_SESSION["email"] = $user;

            header("refresh:0;url=teacherdash.php" );
        }

    }


        
?>