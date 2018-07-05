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
    }

    $name = $_POST["name"];
    $user = $_POST["user"];
    $pass = $_POST["pass"];
    $level = $_POST["level"];
   
    if($level=="student"){
        //Query
        $sql = "Use edupersonal";
        $result = $conn->query($sql);
        $sql = "insert into student values('$user','$pass','$name')";
        $result = $conn->query($sql);

        $_SESSION["username"] = $name;
        $_SESSION["email"] = $user;

        header("refresh:0;url=studentdash.php" );
    }
    else if($level=="teacher"){
        //Query
        $sql = "Use edupersonal";
        $result = $conn->query($sql);
        $sql = "insert into teacher values('$user','$pass','$name')";
        $result = $conn->query($sql);

        $_SESSION["username"] = $name;
        $_SESSION["email"] = $user;

        header("refresh:0;url=teacherdash.php" );
    }


        
?>