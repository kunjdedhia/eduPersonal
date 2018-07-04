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

    $user = $_POST["user"];
    $pass = $_POST["pass"];

    //Query
    $sql = "Use edupersonal";
    $result = $conn->query($sql);
    $sql = "select password,level from user where email='$user'";
    $result = $conn->query($sql);

    if($result->num_rows>0){
            //output
            while($row = $result->fetch_assoc()){
                if ($row["password"]==$pass) {
                    if($row["level"]=="student"){
                        header("refresh:0;url=studentdash.html" );
                    }
                    else if($row["level"]=="teacher"){
                        header("refresh:0;url=teacherdash.html" );
                    }
                } else {
                    echo "Email Id or Password is incorrect";
                    header("refresh:2;url=index.html" );

                }
            }
        }
        
    
?>