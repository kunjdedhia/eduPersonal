<?php

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
   
    //Query
    $sql = "Use edupersonal";
    $result = $conn->query($sql);
    $sql = "insert into users values('$user','$pass','$name','$level')";
    $result = $conn->query($sql);

    
        
?>