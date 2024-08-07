<?php

session_start();
$connection = mysqli_connect('localhost', 'root', '');
$db = mysqli_select_db($connection, 'user');
$status="";
if (isset($_POST['code']) && $_POST['code']!=""){
    $code = $_POST['code'];
    $result = mysqli_query(
        $connection,
        "SELECT * FROM `products` WHERE `code`='$code'"
    );
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $code = $row['code'];
    $price = $row['price'];
    $image = $row['image'];

    $cartArray = array(
        $code=>array(
            'name'=>$name,
            'code'=>$code,
            'price'=>$price,
            'quantity'=>1,
            'image'=>$image)
    );

    if(empty($_SESSION["shopping_cart"])) {
        $_SESSION["shopping_cart"] = $cartArray;
        $status = "<div class='box'>Product is added to your cart!</div>";
    }else{
        $array_keys = array_keys($_SESSION["shopping_cart"]);
        if(in_array($code,$array_keys)) {
            $status = "<div class='box' style='color:red;'>
	Product is already added to your cart!</div>";
        } else {
            $_SESSION["shopping_cart"] = array_merge(
                $_SESSION["shopping_cart"],
                $cartArray
            );
            $status = "<div class='box'>Product is added to your cart!</div>";
        }

    }
}
?>
<body>
<?php
if(!empty($_SESSION["shopping_cart"])) {
    $cart_count = count(array_keys($_SESSION["shopping_cart"]));
    ?>
    <div class="cart_div">
        <a href="cart.php"><img src="cart-icon.png" /> Cart<span>
<?php echo $cart_count; ?></span></a>
    </div>
    <?php
}
?>
<?php
$result = mysqli_query($connection,"SELECT * FROM `products`");
while($row = mysqli_fetch_assoc($result)){
    echo "<div class='product_wrapper'>
    <form method='POST' action='cart.php'>
    <input type='hidden' name='code' value=".$row['code']." />
    <div class='image'><img src='".$row['image']."' /></div>
    <div class='name'>".$row['name']."</div>
    <div class='price'>$".$row['price']."</div>
    <button type='submit' class='buy'>Buy Now</button>
    </form>
    </div>";
}
mysqli_close($connection);
?>

<div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px;">
    <?php echo $status; ?>
</div>
</body>
