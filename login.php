<?php
// error_reporting(0); //no error reporting
session_start();
session_regenerate_id();

    if(!empty($_SESSION) && !empty($_SESSION['user_id'])){
        header("location: main.php");
    }
    
    $emailDisplay="none";
    $passDisplay="none";
    $errPassDisplay="none";
    $errBothDisplay="none";
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


    if($error==0){
		
        require 'connection.php';
        if ($conn->connect_error) {
            echo "error";
            } else {

		$passwordStore= md5($salt.$_POST["pass"].$salt);
        $sql_e = "SELECT * FROM `registered_user` WHERE email='".$salt.$_POST["email"]."' and password='".$passwordStore."'";

		$result = $conn->query($sql_e);

        if(mysqli_num_rows($result) > 0){
            $errBothDisplay="none";
			
			
			while($row = $result->fetch_assoc()) {
                $parent=$row["parent"];
				passFunc($row);
            }

            if($parent == 0){
                header("location: main.php");
                $errPassDisplay="none";
            }
                else{
                header("location: submain.php");
                $errPassDisplay="none";
                }
        } else {
                $errBothDisplay="block";
        } 
    }  
    }
}

    function passFunc($row){
            $_SESSION["parent"] = $row["parent"];
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['semail'] = $row['email'];
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
            /* background-color:white; */
            font-family: 'Roboto', sans-serif;
        }
        
        .flex-r{
            display:flex;
            flex-direction: row;
        }

        .outerField {
            width: 50%;
            margin-top: 2%;
            padding: 3%;
            border-radius: 8px;
            background-color: #dbdbdb;
            /* background-color:white; */
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



        #errPass{
            display: <?php echo $errPassDisplay ?>;
        }

        #errBoth{
            display: <?php echo $errBothDisplay ?>;
        }

        .mar-left{
            font-size: 0.8em;
            text-decoration:none;
            margin-left:61%;
        }
    </style>
</head>

<body>

    <div class="container outerField">
        <h1>Please fill the following: </h1>

        <form method="post" autocomplete="off">
            <div class="form-group">
                <label for="">Email</label><small>*</small>
                <input type="text" name="email" class="form-control" placeholder=" Eg: John">
                <p class="errorReport" id="emailErr">Email cannot be empty</p>
            </div>
            <div class="form-group">
                <label for="">Password</label><small>*</small>
                <input type="password" name="pass" class="form-control">
                <p class="errorReport" id="passErr">Password cannot be empty</p>
            </div>
            <div class="flex-r">
            <button type="submit" class="btn btn-primary pt-2 mt-4 form-group">Submit</button>
            <a href="register.php" class="pt-2 mt-4 form-group mar-left">New User? Click to register</a>
            </div>
        </form>
        <p class="errorReport" id="errPass">Invalid Password</p>
        <p class="errorReport" id="errBoth">User doesn't exist</p>
    </div>


</body>

</html>