
<!DOCTYPE html>

<html lang="en">
<?php

    $message=

    "logged in successfully...redirecting to home page";
 

    session_start();

    if(isset($_SESSION["logged_in"])){

        header("Location:profile.php");

    }
 

    if($_SERVER["REQUEST_METHOD"]=="POST"){

        $con=mysqli_connect('localhost',

            'database_username',

            'database_pass','database_name');
 

        if($con);

        else

            echo "failed to connect to database";

        $username1=$_POST['username'];

        $prefix="_";

        $username=$prefix.$username1;

        $password=$_POST['Password'];
 

        $sql = "SELECT id,username, password FROM 1_user";

        $result = $con->query($sql); 
 

        if ($result->num_rows > 0) {

            $fnd=0;

            while($row = $result->fetch_assoc()) {
 

                /* echo "<br> id: ". $row["id"]. 

                " - username= ". $row["username"]. 

                " password= " . $row["password"] . "<br>"; */
 

                if($row["username"]==$username and

                    $row["password"]==$password) {    

                     

                    $_SESSION["username"] = $username;

                    $_SESSION["registration-going-on"]="0";

                    $fnd=1;

                    $_SESSION["logged_in"]="1";

                    echo '<div class="alert alert-success"

                        role="alert">'.$message.'</div>';
 

                    echo

"<script>setTimeout(\"location.href = 'profile.php';\",3000);</script>";

                }

            }

            if($fnd==0)

                echo(

"<script>alert('username password not matches')</script>");
 

        }

        else {

            echo(

"<script>alert('username password not matches')</script>");

        }

        $con->close();

    }
?>
 
<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content=

        "width=device-width, initial-scale=1.0">

    <title>Document</title>
 

    <link rel="stylesheet" type="text/css"

        href="css/style.css" media="screen" />
 

    <!--  Adding bootstrap  -->

    <link rel="stylesheet" href=
"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"

        integrity=
"sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"

        crossorigin="anonymous">
 

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"

        integrity=
"sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"

        crossorigin="anonymous">

    </script>

     

    <script src=
"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"

        integrity=
"sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"

        crossorigin="anonymous">

    </script>

     

    <script src=
"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"

        integrity=
"sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"

        crossorigin="anonymous">

    </script>

     

    <div class="nav-bar">

        <div class="title">

            <h3>welcome to my website</h3>

        </div>

    </div>
</head>
 
<body>

    <form class="form-login" action="index.php" method="POST">

        <div class="form-group">

            <label>username</label>

            <input type="text" class="form-control"

                name="username" id="username"

                aria-describedby="emailHelp"

                placeholder="username" required>

        </div>
 

        <div class="form-group">

            <label>Password</label>

            <input type="password" class="form-control"

                name="Password" id="Password"

                placeholder="Password" required>

        </div>
 

        <button type="submit"

            class="btn btn-primary btn-lg">Login

        </button>

         

        <button type="button"

            class="btn btn-warning btn-lg"

            id="register-button">

            Create Account

        </button>

    </form>

     

    <script>

            $("#register-button").click(function () {

                window.location.replace("register.php");

            });

    </script>
</body>
 
</html>
