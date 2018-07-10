<?php

    function array_mode($array,$justMode=0) 
    {
        $count = array();
        foreach ( $array as $item) {
            if ( isset($count[$item]) ) {
                $count[$item]++;
            } else{
                $count[$item] = 1;
            };
        };
        $mostcommon = '';
        $iter = 0;
        foreach ( $count as $k => $v ) {
            if ( $v > $iter ) {
                $mostcommon = $k;
                $iter = $v;
            };
        };
        if ( $justMode==0 ) {
            return $mostcommon;
        } else {
            return array("mode" => $mostcommon, "count" => $iter);
        }
    }

    session_start();

    $questCount = ($_SESSION["count"]-1);
    $sel_ans = array();
    $opt_ans = array();
    $weaktopic = array();
    $marks = 0;

    for($i=1; $i<= $questCount; $i++){
        array_push($sel_ans, $_POST["answer".$i]);
    }

    $server="localhost";
    $username="root";
    $password="";

    $_SESSION["count"] = 1;

    //Create Connection
    $conn=new mysqli($server, $username, $password);

    //Check Connection
    if($conn -> connect_error){
        die("Connection failed: ".$conn -> connect_error);
    }

    //Query
    $sql = "Use edupersonal";
    $conn->query($sql);
    $sql = "select correct_opt, subtopic from question where course_topic=".$_SESSION["courseExam"];
    $result = $conn->query($sql);

    if($result->num_rows>0){
        //output
        while($row = $result->fetch_assoc()){
            array_push($opt_ans, $row["correct_opt"]);
        }

        if (sizeof($sel_ans)==sizeof($opt_ans)) {
            for($i = 0; $i < $questCount; $i++){
                if ($sel_ans[$i]==$opt_ans[$i]){
                    $marks++;
                } else {
                    array_push($weaktopic, $row["subtopic"]);
                }
            }

            $sql = "Use edupersonal";
            $conn->query($sql);

            $sql = "update admit set status='Exam Taken', weaktopic='".array_mode($weaktopic, 0)."' where student='".$_SESSION["email"]."' AND course=".$_SESSION["courseExam"];
            $result = $conn->query($sql);

            $sql = "update admit set score='".$marks."/".$questCount."' where student='".$_SESSION["email"]."' AND course=".$_SESSION["courseExam"];
            $result = $conn->query($sql);

            echo "Congratulations! You scored ".$marks."/".$questCount." Please wait. Redirecting to dashboard...";

            echo array_mode($weaktopic, 0);

            header("refresh:4;url=studentdash.php");

        } else {
            //error - size does not match
            echo "Array length doesn't match";
        }
    }

?>