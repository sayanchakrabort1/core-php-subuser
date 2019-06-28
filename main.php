<?php 
session_start();
session_regenerate_id();

if(empty($_SESSION) && empty($_SESSION['user_id'])){
    header("location: index.php");
}

$user_id=$_SESSION["user_id"];


$email=$_SESSION['semail'];
$email=substr($email, 22);

$emailDisplay="none";
$passDisplay="none";
$error=0;
$msgDis="none";
$errDis="none";
require "connection.php";

$query="SELECT `image` FROM `registered_user` WHERE id=$user_id";
$result = $conn->query($query);


while($row = $result->fetch_assoc()) {
                if($row['image'] == "" ){
                    $imgpath= "uploads/default.png";
                } else {
                $imgpath= $row['image'];
                $_SESSION["image"]=$imgpath; 
                    }
                }

if($_POST){

    if($_POST['subEmail'] == ""){
        $emailDisplay="block";
        $error=1;
    } else {
        $emailDisplay="none";
    }

    if($_POST['subPass'] == ""){
        $passDisplay="block";
        $error=1;
    } else {
        $passDisplay="none";
    }

    if($error==0){

        require 'connection.php';
        $passwordStore= md5($salt.$_POST["subPass"].$salt);
        $emailStore=$salt.$_POST["subEmail"];

        $sql=  "INSERT INTO `registered_user`(`email`, `password`,`parent`) VALUES ('$emailStore','$passwordStore','$user_id')";

        if(mysqli_query($conn, $sql)){
            $msgDis="block";
            $errDis="none";
        } else {
            $msgDis="none";
            $errDis="block";
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
    <title></title>

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
            background-image: url('pic.jpeg');
            background-repeat: no-repeat;
            background-size: cover;
            box-sizing: border-box;
        }

        .distri {
            margin-left: 10%;

        }

        .distriLog {
            margin-left: 30%;
        }

        .commonSpace {
            padding-top: 4%;
        }

        .topDiv {
            position: fixed;
            top: 0;
            margin-left: 9%;
        }

        .flex-r {
            display: flex;
            flex-direction: row;
        }

        #emailErr {
            display: <?php echo $emailDisplay ?>;
        }


        #passErr {
            display: <?php echo $passDisplay ?>;
        }

        .errorReport {
            font-size: 0.7em;
            color: red;
        }

        .editBtn{
            border-radius:0px 0px 8px 8px;
            background-color:black;
        }

        .messageDis{
            font-size:1.2em;
            display: <?php echo $msgDis; ?>;
            color:green;
        }

        .errorDis{
            font-size:1.2em;
            display: <?php echo $errDis; ?>;
            color:red;
        }

        .imgShow{
            max-width:50px;
            max-height:50px;
            height:100%;
            width:100%;
        }
    </style>

</head>

<body>
    <div class="topDiv flex-r container">
        <a href="#home" class="btn btn-primary editBtn">Home</a>
        <a href="#about" class="btn btn-primary distri editBtn">About us</a>
        <a href="#subUser" class="btn btn-primary distri editBtn">Sub User</a>
        <a href="profile.php" class="btn btn-primary distri editBtn">Profile</a>
        <a href="logout.php" class="btn btn-primary distriLog editBtn"> Logout </a>
    </div>

    <h1 class="container commonSpace">Hello! <img src="<?php echo $imgpath; ?>" class="imgShow"> <?php echo $email; ?></h1>

    <div id="home" class="container commonSpace">

        <h3>Lorem Ipsum</h3>
        <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet vehicula lectus, sit amet aliquet
            lorem. Nullam commodo, nulla nec sagittis vulputate, turpis elit suscipit dolor, quis aliquet quam enim quis
            ligula. Etiam iaculis rutrum magna id dictum. Suspendisse potenti. Suspendisse et nibh ipsum. Vestibulum
            tincidunt eleifend eros et gravida. Vestibulum quis sollicitudin tellus, sit amet dignissim augue. Quisque
            sed lacus eget tortor mollis elementum in sed nunc. Sed placerat, mi eu auctor lacinia, tortor mi commodo
            lectus, id semper ex est sit amet mauris. Donec a erat eu massa euismod sodales. Nam commodo auctor egestas.
            In faucibus augue eu tincidunt tempus. Donec tristique ultricies leo sit amet bibendum.

            In hac habitasse platea dictumst. Vivamus sagittis bibendum odio at auctor. Sed suscipit tempor tellus, et
            sagittis lorem ullamcorper in. Interdum et malesuada fames ac ante ipsum primis in faucibus. Etiam
            scelerisque ornare purus sit amet lobortis. Aenean dictum urna sit amet dolor viverra, et molestie nisl
            commodo. Maecenas quis diam porttitor, accumsan felis et, cursus massa. Nulla tincidunt ornare enim vel
            vulputate. Donec aliquam nulla nunc, porttitor faucibus augue vehicula iaculis. Integer porttitor bibendum
            ornare. Phasellus quis lectus massa. </p>
    </div>

    <div class="container commonSpace" id="about">

        <h3>About us</h3>

        <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet vehicula lectus, sit amet aliquet
            lorem. Nullam commodo, nulla nec sagittis vulputate, turpis elit suscipit dolor, quis aliquet quam enim quis
            ligula. Etiam iaculis rutrum magna id dictum. Suspendisse potenti. Suspendisse et nibh ipsum. Vestibulum
            tincidunt eleifend eros et gravida. Vestibulum quis sollicitudin tellus, sit amet dignissim augue. Quisque
            sed lacus eget tortor mollis elementum in sed nunc. Sed placerat, mi eu auctor lacinia, tortor mi commodo
            lectus, id semper ex est sit amet mauris. Donec a erat eu massa euismod sodales. Nam commodo auctor egestas.
            In faucibus augue eu tincidunt tempus. Donec tristique ultricies leo sit amet bibendum.

            In hac habitasse platea dictumst. Vivamus sagittis bibendum odio at auctor. Sed suscipit tempor tellus, et
            sagittis lorem ullamcorper in. Interdum et malesuada fames ac ante ipsum primis in faucibus. Etiam
            scelerisque ornare purus sit amet lobortis. Aenean dictum urna sit amet dolor viverra, et molestie nisl
            commodo. Maecenas quis diam porttitor, accumsan felis et, cursus massa. Nulla tincidunt ornare enim vel
            vulputate. Donec aliquam nulla nunc, porttitor faucibus augue vehicula iaculis. Integer porttitor bibendum
            ornare. Phasellus quis lectus massa. </p>
    </div>

    <div class="container commonSpace" id="subUser">

        <h3>Sub User</h3>

        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet vehicula lectus, sit amet aliquet
            lorem. Nullam commodo, nulla nec sagittis vulputate, turpis elit suscipit dolor, quis aliquet quam enim quis
            ligula.</p>

        <form method="post" autocomplete="off">
        <div class="form-group">
            <label for="">Name</label><small>*</small>
            <input type="text" name="subEmail" class="form-control" placeholder=" Eg: John">
            <p class="errorReport" id="emailErr">Email cannot be empty</p>
        </div>
        <div class="form-group">
            <label for="">Password</label><small>*</small>
            <input type="password" name="subPass" class="form-control">
            <p class="errorReport" id="passErr">Password cannot be empty</p>
        </div>
        <div class="flex-r">
        <button type="submit" class="btn btn-primary pt-2 mt-4 form-group">Submit</button>
        </div>

        <p class="messageDis">Sub user Created!</p>
        <p class="errorDis">Error!</p>
    </div>

</body>

</html>