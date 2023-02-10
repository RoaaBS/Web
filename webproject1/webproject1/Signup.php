<?php


session_start();
$connection = mysqli_connect('localhost', 'root', '');
$db = mysqli_select_db($connection, 'user');// database name



if (isset($_POST['SignUp'])) {

    $user_name = $_POST['name'];
   $user_add = $_POST['city'];
    $user_email = $_POST['username'];
    $user_pw = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];


    $_SESSION['user_email_s'] = $user_email;

    $data = $_POST;
    if (empty($data['username']) ||
        empty($data['city']) ||
        empty($data['name']) ||
        empty($data['password']) ||
        empty($data['password_confirm'])) {
        echo '<script type="text/javascript"> alert("Please fill all required fields!") </script>';
    } else {

      if ($user_pw == $password_confirm) {
            $query = "SELECT * FROM LogSign WHERE username= '$user_email'";
            $query_run = mysqli_query($connection, $query);

            if (mysqli_num_rows($query_run) > 0) {
                echo '<script type="text/javascript"> alert("Email is already exists... try another Email") </script>';
            }else  {

              $query = "INSERT INTO USER.logsign (id,username,name,password,city)
                      VALUES (NULL,'$user_email','$user_name','$user_pw','$user_add')";

                $query_run = mysqli_query($connection, $query);


                if ($query_run) {
                    $query2 = "SELECT * FROM USER.logsign WHERE username= '$user_email'";
                    $query_run2 = mysqli_query($connection, $query2);
                    $row2 = mysqli_fetch_array($query_run2);
                    $user_id = $row2['user_id'];

                    $_SESSION['user_id_s'] = $user_id;




                    echo '<script type="text/javascript"> alert("Your successfully SignUp") </script>';
                    header('location:index.php');
                } else {
                    echo '<script type="text/javascript"> alert("SignUp Failed") </script>';
                }
            }
        } else {
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
    <title>SignUp </title>

    <link rel="stylesheet" href="assest/css/all.min.css">
    <link rel="stylesheet" href="assest/css/style.css">



</head>

<body>

<div class="main">
    <img src="assest/img/female.jpg">
    <div class="sign">
        <form action="Signup.php" method="post">
            <h2> Sign Up</h2>

            <div class="formm">
                <i class="fa fa-user"></i>
                <input type="text" name=" name" placeholder=" user name" required="">
                <i class="fa fa-user"></i>
                <i class="fas fa-envelope"></i>
                <input type="email" name="username" placeholder=" email" required="">

                <i class="fa fa-lock"></i>
                <input type="password" name="password" placeholder=" Password" required="" >
                <i class="fa fa-lock"></i>

                <input type="password" name="password_confirm" placeholder=" password_confirm" required="">
                <i class="fas fa-map"></i>

                <input type="text" name="city" placeholder=" city" >

                <input type="submit"  value="Sign up" name="SignUp"/>


            </div>
        </form>

    </div>

</div>

</body>