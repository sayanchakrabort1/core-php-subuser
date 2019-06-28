<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

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
    .main-div {
        margin-top:17%;
        max-width: 500px;
    }

    .inner-div{
        max-width:300px;
    }

    #register{
        padding:3%;
    }

    #login{
        margin-left:40%;
    }

    .aliner{
        margin-left:-5%;
        margin-top:5%;
    }

    </style>
</head>

<body>

    <div class="flex-r container main-div">
        <div class="container inner-div">
            <button class="btn btn-primary" id="register"  onClick="window.location = 'register.php'" >Register</button>
            <button class="btn btn-primary" id="login" onClick="window.location = 'login.php'">Login</button>
    </div>
</body>

</html>