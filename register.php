<?php
// error_reporting(0); //no error reporting

    if(!empty($_SESSION) && !empty($_SESSION['user_id'])){
        header("location: main.php");
    }


    $passwordStore="";
    $emailDisplay="none";
    $passDisplay="none";
    $conPassDisplay="none";
    $mismatchDisplay="none";
    $already="none";
    $error=0;

    if($_POST){


    if($_POST["email"] == NULL){
        $emailDisplay= "inline";
        $error=1;
    } else {
        $emailDisplay= "none";
    }

    if($_POST["pass"] == NULL){
        $passDisplay= "inline";
        $error=1;
    } else {
        $passDisplay= "none";
    }

    if($_POST["conPass"] == NULL){
        $conPassDisplay= "block";
        $error=1;
    } else {
        $conPassDisplay= "none";
    }

    if($_POST["pass"] != $_POST["conPass"] && $_POST["pass"] != NULl && $_POST["conPass"] != NULL){
        $mismatchDisplay= "block";
        $error=1;
    } else {
        $mismatchDisplay= "none";
    }

    require 'connection.php';
    $query="SELECT * FROM `registered_user` WHERE email='".$salt.$_POST["email"]."'";
    $run=mysqli_query($conn, $query);

    if(mysqli_num_rows($run) > 0){
        $error=1;
        $already="block";
    }
    mysqli_close($conn);

    if($error==0){
        require 'connection.php';
        $passwordStore= md5($salt.$_POST["pass"].$salt);
        // Check connection
        if ($conn->connect_error) {
        echo "error";
        } else {
        $sql=  "INSERT INTO `registered_user`(`email`, `password`) VALUES ('".$salt.$_POST["email"]."','".$passwordStore."')";

        if(mysqli_query($conn, $sql)){
            header("location: login.php");
        } else{
            echo "ERROR";
        }
        mysqli_close($conn);
    }
    }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form</title>
    <!---------------Import Font------------->
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <!---------------Import Font------------->

    <!-- ------------Start BOOTSTRAP------------ -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <!-- ------------End BOOTSTRAP------------ -->

    <style>
        body {
            background-color: #2f2f2d;
            font-family: 'Roboto', sans-serif;
        }

        .outerField {
            width: 50%;
            margin-top: 2%;
            padding: 3%;
            border-radius: 8px;
            background-color: #dbdbdb;
            color: black;
        }

        small {
            color: red;
        }

        .radioDiv {
            margin-left: 10%;
        }

        .errorReport {
            font-size: 0.7em;
            color: red;
        }

        #emailErr {
            display: <?php echo $emailDisplay ?>;
        }


        #passErr {
            display: <?php echo $passDisplay ?>;
        }

        #conPassErr {
            display: <?php echo $conPassDisplay ?>;
        }

        #mismatchErr {
            display: <?php echo $mismatchDisplay ?>;
        }

        #alreadyErr{
            display: <?php echo $already ?>;
        }

        .flex-r{
            display:flex;
            flex-direction:row;
        }

        .loginOne{
            font-size: 0.8em;
            margin-left:50%;
        }

        .errorReport {
            font-size: 0.7em;
            color: red;
        }
    </style>
</head>

<body>

    <div class="container outerField">
        <h1>Register </h1>

        <form method="post" autocomplete="off">
            <div class="form-group">
                <label for="">Email</label><small>*</small>
                <input type="email" name="email" class="form-control" placeholder=" Eg: John@doe.com">
                <p class="errorReport" id="emailErr">Email cannot be empty</p>
            </div>
            <div class="form-group">
                <label for="">Password</label><small>*</small>
                <input type="password" name="pass" class="form-control">
                <p class="errorReport" id="passErr">Password cannot be empty</p>
                <p class="errorReport" id="mismatchErr">Passwords do not match</p>
            </div>
            <div class="form-group">
                <label for="">Confirm Password</label><small>*</small>
                <input type="password" name="conPass" class="form-control">
                <p class="errorReport" id="conPassErr">Confirm password cannot be empty</p>
                <p class="errorReport" id="mismatchErr">Passwords do not match</p>
                <p class="errorReport" id="alreadyErr">User Already Exists</p>
            </div>
            <div class="flex-r">
            <button type="submit" class="btn btn-primary pt-2 mt-4 form-group">Submit</button>
            <a href="login.php" class="pt-2 mt-4 form-group loginOne">Already registered? Click to Login</a>
            </div>
        </form>
    </div>


</body>

</html>