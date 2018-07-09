<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Log In</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>

<body>

    <?php
        session_start();
        $_SESSION["courseExam"] = 0;
    ?>

    <center>
        <form action="logIn.php" method="post">
            <table>
                <tr>
                    <td>Email Id</td>
                    <td>
                        <input type="text" name="user" required="true" />
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>
                        <input type="password" name="pass" required="true" />
                    </td>
                </tr>
                <tr>
                    <td>Select One</td>
                    <td>
                        <input type="radio" name="level" value="student" required="true"/>Student
                        <input type="radio" name="level" value="teacher" />Teacher</td>
                </tr>
            </table>
            <input type="submit" value="Sign In" />
            <br>
            <a href="register.html">New User? Create an Account</a>
            <br>
            <a href="forgot.php">Forgot Password</a>
        </form>
    </center>

</body>

</html>