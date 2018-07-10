<?php

session_start();

$student = $_GET["studentId"];

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

$sql = "select score, weaktopic from admit where student='".$student."' AND course=".$_SESSION["course"];
$result = $conn->query($sql);

if($result->num_rows>0){
    //output
    while($row = $result->fetch_assoc()){
        echo "Score: ".$row["score"];
        echo "<br>";
        echo "Weaktopic: ".$row["weaktopic"];

    }
}

?>