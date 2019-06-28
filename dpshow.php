<?php
session_start();
session_regenerate_id();
require 'connection.php';
if(empty($_SESSION) && empty($_SESSION['user_id'])){
    header("location: index.php");
}

$user_id=$_SESSION['user_id'];
$style="width:150px; height:150px; margin:5%; margin-right:0; border:2px solid black; border-radius:10%;";
$bStyle=" font-size:0.8em;";
$query="SELECT `path` FROM `dp_user` WHERE user=$user_id";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$i=1;
// while($row = $result->fetch_assoc()) {
//     $imgShow=$row["path"];
//     echo "<img src='$imgShow' style='$style'> </img>";
//     echo "<br>";
//     }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

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
    <style>
    .profileAnc{
        margin-left:35%!important;
        border-radius:0px 0px 8px 8px;
    }

    .fixedDiv{
        position:fixed;
        top:0;
        width:100%;
    }
    </style>
</head>
<body>
    <div class="container">
    <div class="fixedDiv"><a href="profile.php" class="btn btn-primary profileAnc">Goto profile page</a></div>
        
    <div> <?php while($row = $result->fetch_assoc()) {
        $imgShow=$row["path"];
        echo " <div>$i)<img src='$imgShow' style='$style'> </img></div>";
        $i++;
        } ?>
    </div>

        
    </div>
</body>
</html>