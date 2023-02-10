<?php

session_start();
$connection = mysqli_connect('localhost', 'root', '');
$db = mysqli_select_db($connection, 'user');
if(isset($_POST['SignIn'])){

    $user_email = $_POST['emailIn'];
    $user_pw = $_POST['passwordIn'];

    $_SESSION['user_email_s'] = $user_email;


    if ((empty($user_email)) || (empty($user_pw)) ){
        echo '<script type="text/javascript"> alert("Please fill all required fields!") </script>';

    } else {

        $query = "SELECT * FROM LogSign WHERE username= '$user_email' && password = '$user_pw'";
        $query_run = mysqli_query($connection, $query);


        if(mysqli_num_rows($query_run) > 0){

            $query2 = "SELECT * FROM LogSign WHERE username= '$user_email'";
            $query_run2 = mysqli_query($connection, $query2);
            $row2=mysqli_fetch_array($query_run2);
            $user_id=$row2['user_id'];

            $_SESSION['user_id_s'] = $user_id;

            if($user_email== 'aya.kanaan15@gmail.com' || $user_email== 'roaabsab15@gmail.com'){
                header('location:admin.php');
            }
            else{
                header('location:index.php');
            }

        }
        else{
            echo '<script type="text/javascript"> alert("Password and Confirm Password does not match") </script>';

        }
    }

}

?>

<!DOCTYPE html>
<html lang="ar">
<html>

<head>
    <meta charset="UTF-8">
    <title>LogIn </title>

    <link rel="stylesheet" href="assest/css/all.min.css">
    <link rel="stylesheet" href="assest/css/style.css">



</head>

<body>


<div class="main">
    <img src="assest/img/female.jpg">
    <div class="login">
        <form action="Login.php" method="post">
            <h2> Login</h2>
            <div class="formm">
                <i class="fa fa-user"></i>
                <input type="email" name="emailIn" placeholder=" email" required="">
                <i class="fa fa-lock"></i>
                <input type="password" name="passwordIn" placeholder=" Password" required="">

                <input type="submit" value="Login" name="SignIn" />
                <a href="#">Forget password ?</a>
                <a href="signup.php">Sign Up</a>

            </div>
        </form>
        </form>

    </div>

</div>

</body>
