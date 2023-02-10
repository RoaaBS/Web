<?php
session_start();
$connection = mysqli_connect('localhost', 'root', '');
$db = mysqli_select_db($connection, 'item');
;
if (isset($_POST['AddItem'])) {

    $product_name = $_POST['name'];
    $product_category = $_POST['category'];
    $product_price = $_POST['price'];


    $_SESSION['productID'] = $product_category;

    $data = $_POST;
    if (empty($data['name']) ||
        empty($data['category']) ||
        empty($data['price']) )
      {
        echo '<script type="text/javascript"> alert("Please fill all required fields!") </script>';
    } else  {
            $query = "SELECT * FROM item WHERE product_name= '$product_name'";
            $query_run = mysqli_query($connection, $query);

        {

            $query = "INSERT INTO user.item (ID,product_name,product_category,product_price)
                      VALUES (NULL,'$product_name','$product_category','$product_price')";

            $query_run = mysqli_query($connection, $query);


            if ($query_run) {
                $query2 = "SELECT * FROM USER.item WHERE product_name= '$product_name'";
                $query_run2 = mysqli_query($connection, $query2);
                $row2 = mysqli_fetch_array($query_run2);
                $productID = $row2['product_id'];

                $_SESSION['product_id_s'] = $productID;


                echo '<script type="text/javascript"> alert("Your successfully Added") </script>';
                header('location:admin.php');
            } else {
                echo '<script type="text/javascript"> alert("Add Failed") </script>';
            }
        }}


}
?>

<!DOCTYPE html>
<html lang="ar">
<html>

<head>
    <meta charset="UTF-8">
    <title>Add Item </title>

    <link rel="stylesheet" href="assest/css/all.min.css">
    <link rel="stylesheet" href="assest/css/style.css">



</head>

<body>

<div class="main">
    <div class="sign" id="addItem">
        <form action="addItem.php" method="post">
            <h2> Add Item</h2>

            <div class="formm">


                <input type="text" name="name" placeholder="product name" required="" >

                <input type="text" name="category" placeholder="product category" required="">

                <input type="text" name="price" placeholder="product_price" >

                <input type="submit"  value="Add Item" name="AddItem"/>


            </div>
        </form>

    </div>

</div>

</body>

