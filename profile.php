<?php 

//explode and implode
error_reporting(0);
session_start();
session_regenerate_id();
$tName="";
$tDate="";
$tFav="";
$successMsg="none";
$errMsg="none";
require 'connection.php';
$tday=$tmon=$tyear="";
$temp="";

if(empty($_SESSION) && empty($_SESSION['user_id'])){
    header("location: index.php");
}

function passerFunc(){
    if($_SESSION["parent"] == 0){
        $temp="main.php";
        return $temp;
    } else {
        $temp= "submain.php";
        return $temp;
    }
}

$user_id=$_SESSION["user_id"];
$query="SELECT `name`, `fav`, `bday` , `image`FROM `registered_user` WHERE id=$user_id";
$result = $conn->query($query);


while($row = $result->fetch_assoc()) {
                $tName= $row['name'];
                $tFav= $row['fav'];
                $tDate= $row['bday'];
                $imgpath= $row['image'];
                $_SESSION["image"]=$imgpath;
                // echo $imgpath;
                // die();
                }

                $arr=explode("/", $tDate , 3);
                // echo "<pre>";
                // print_r ($arr);
                
                $tday=$arr[0];
                $tmon=$arr[1];
                $tyear=$arr[2];

                // echo $tday;

        function generate_options($from,$to,$val)
        {   

            for($i=$from; $i <= $to; $i++){

                if($i == $val){
                    echo "<option value='$i' selected>";
                        echo $i;
                    echo "</option>;";

                    }else{
                    
                    echo "<option value='$i'>";
                        echo $i;
                    echo "</option>;";
                }
            }
        }

if($_POST){

$date=$_POST["day"]."/".$_POST["month"]."/".$_POST["year"];
$name=$_POST["name"];
$fav=$_POST['fav'];

    $errors= array();

    if($_FILES['image']['name']){
        $file_name = time().$_FILES['image']['name'];
        $file_tmp =$_FILES['image']['tmp_name'];
    
        move_uploaded_file($file_tmp,"uploads/".$file_name);
        

    }
    else{
        $file_name = "default.png";
    }

    

    $img="uploads/".$file_name;
 

$query="UPDATE `registered_user` SET `name` = '$name', `fav` = '$fav', `bday` = '$date' , `image` = '$img' WHERE `registered_user`.`id` = $user_id";
$result = $conn->query($query);
if($file_name!= "default.png"){
$sql=  "INSERT INTO `dp_user`(`user`,`path`) VALUES ('$user_id','$img')";
$dpresult= $conn->query($sql);
}
if($result){
    $successMsg="block";
    $errMsg="none";
}
else{
    $errMsg="block";
    $successMsg="none";

}

        $user_id=$_SESSION["user_id"];
        $query="SELECT `name`, `fav`, `bday` , `image` FROM `registered_user` WHERE id=$user_id";
        $result = $conn->query($query);
        while($row = $result->fetch_assoc()) {
                $tName= $row['name'];
                $tFav= $row['fav'];
                $tDate= $row['bday'];
                $imgpath= $row['image'];
                $_SESSION["image"]=$imgpath;
            }      
}

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
    body{
            background-image: url('pic.jpeg');
            background-repeat: no-repeat;
            background-size: cover;
            box-sizing: border-box;
    }
        .flex-c {
            display: flex;
            flex-direction: column;
        }

        .maxW {
            max-width: 400px;
        }

        .flex-r {
            display: flex;
            flex-direction: row;
        }

        .outer{
            padding:2%;
            max-width:500px;
            width:100%;
            border-radius:8px;
            border:1px solid black;
            margin: 0 auto;
            margin-top:1%;
        }

        .imgShow{
            max-width:150px;
            max-height:150px;
            height:100%;
            width:100%;
            border-radius: 10% 10% 0px 0px;
        }

        .formatBtn{
            max-height:40px;
            max-width:150px;
            width:100%;
            border-radius: 0px 0px 8px 8px;
        }

        .linkClass{
            color:white!important;
        }

    </style>
</head>

<body>
    <div class="outer">
    <h1 class="container">Profile section</h1>

    <h3 class="flex-c container">
        <img src="<?php echo $imgpath ?>" class="imgShow">
        <div>
        <a href="removedp.php" class="btn btn-info formatBtn">Remove dp</a>
        <a href="dpshow.php" class="btn btn-primary linkClass">Browse Dp</a>
        </div>
        <div>Name: <?php echo $tName; ?></div>
        <div>Favourite Subjects: <?php echo $tFav; ?></div>
        <div>DOB: <?php echo $tDate; ?></div>
    </h3>
    <form method="post" autocomplete="off" enctype="multipart/form-data">
        <div class="flex-c container">
            Name:<input name="name" type="text" value="<?php echo $tName; ?>"> <br>
            Fav Subject: <input name="fav" type="text" value="<?php echo $tFav; ?>"> <br>
            Birthday: <br>
            <div class="maxW">
                DD:<select name="day"> <?php generate_options(1,31,$tday)  ?> </select>
                MM:<select name="month"> <?php  generate_options(1,12,$tmon) ?> </select>
                YYYY:<select name="year">  <?php generate_options(1980,2019,$tyear) ?> </select>
            </div>

            <input type="file" name="image" class="btn">

            <button type="submit" class="btn btn-primary" style="max-width:100px; margin-top:5%;">Submit</button>
            <p style="display: <?php echo $successMsg; ?>; font-size:0.8em; color:green; ">Inserted Successfully!</p>
            <p style="display: <?php echo $errMsg; ?>; font-size:0.8em; color:red;">ERROR!</p>
            <a href="<?php echo passerFunc(); ?>"  style="font-size:0.8em; margin-left:75%;">Goto main page</a>
        </div>
    </form>
    </div>
</body>

</html>