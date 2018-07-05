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

    $user = $_POST["user"];
    $pass = $_POST["pass"];
    $level = $_POST["level"];

    if ($level=="student"){
        //Query
        $sql = "Use edupersonal";
        $result = $conn->query($sql);
        $sql = "select password, name from student where email='$user'";
        $result = $conn->query($sql);

        if($result->num_rows>0){
            //output
            while($row = $result->fetch_assoc()){
                if ($row["password"]==$pass) {

                    $_SESSION["username"] = $row["name"];
                    $_SESSION["email"] = $user;

                    header("refresh:0;url=studentdash.php" );
                    
                } else {
                    echo "Password is incorrect";
                    header("refresh:2;url=index.html" );

                }
            }
        } else {
            echo "User not registered";
            header("refresh:1;url=register.html" );

        }

    } else if ($level == "teacher"){
        //Query
        $sql = "Use edupersonal";
        $result = $conn->query($sql);
        $sql = "select password, name from teacher where email='$user'";
        $result = $conn->query($sql);

        if($result->num_rows>0){
            //output
            while($row = $result->fetch_assoc()){
                if ($row["password"]==$pass) {

                    $_SESSION["username"] = $row["name"];
                    $_SESSION["email"] = $user;

                    header("refresh:0;url=teacherdash.php" );
                    
                } else {
                    echo "Password is incorrect";
                    header("refresh:2;url=index.html" );

                }
            }
        } else {
            echo "User not registered";
            header("refresh:1;url=register.html" );

        }
    }

    
?>