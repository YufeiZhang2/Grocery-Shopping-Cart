<?php session_start();?>

<!doctype html>
<html class="MainPage">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/GroceryShop.css">


<head>
    <meta charset="UTF-8">
    <title>Grocery Store</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

    <script>

        //validate user input for quantity
        function validateForm()
        {
            var numbers = document.forms["quantityForm"]["number"].value;
            var message = document.getElementById('warningMessage');
            message.style.display='none';
            if (isNaN(numbers) | numbers < 1 | numbers > 50)
            {
                // alert("Please enter a valid quantity,[1 to 50]" );

                message.innerHTML='Please enter a valid quantity,[1 to 50]';
                message.style.display='block';

                return false;
            }
        }

        //warn users clicking the checkout button if the shopping cart is empty
        function AlertEmptyCart()
        {
            var message = document.getElementById('warningCheckMessage');

            message.innerHTML='Sorry, your cart is empty.';
            message.style.display='block';
        }

    </script>

</head>

<body>

<div class='mainContainer'>
<?php
include_once 'dbConnection.php';
include_once 'VisualBrowser.php';
$_SESSION['is_checked_out'] == false;
?>

<div class='rightHalf'>

<div class="topRightFrame container">
    <div class='header'>
        <div class='logo'><img src="imgs/logo.png"/></div>
        <div class='headerTitle'><span class='headerTitleFont'>Grocery Store</span></div>
    </div>
    <div id="studentIDBar"><h4 align="center" id="studentIDText"> Fell free to contact us: Yufei Zhang - 12191399 | Yanqiu Hu - 12704755</h4></div>
    <?php

    //show product details after check-out button clicked
    if(filter_input(INPUT_GET,'action') == 'checkout')
    {

        $_SESSION['is_checked_out'] = true;

        ?>

        <table width="100%">

        <?php
        if(!empty($_SESSION['cart'])):

            $total = 0;
            ?>
            <h2 align="center">Your Bill, Good Day!</h2>
            <tr>
                <td>Item(s)</td>
                <td>Subtotal</td>

            </tr>

            <?php
            foreach ($_SESSION['cart'] as $key => $product):

                ?>

                <tr>
                    <td><?php echo $product['name']; ?></td>
                    <td>$
                        <?php

                        if($product['quantity'] > $product['in_stock'])
                        {
                            echo number_format($product['in_stock'] * $product['price'], 2);
                        }
                        else{
                            echo number_format($product['quantity'] * $product['price'], 2);

                        } ?>

                    </td>
                </tr>


                <?php

                if($product['quantity'] > $product['in_stock'])
                {
                    $total = $total + ($product['in_stock'] * $product['price']);
                }
                else
                {
                    $total = $total + ($product['quantity'] * $product['price']);
                }

            endforeach;

            ?>
            </table>
            <br/>
            <tr>
                <td> <h3>Total: $ <?php echo number_format($total, 2); ?></h3></td>

            </tr>


        <?php
            //show a contact form after the checkout button is clicked
            if(filter_input(INPUT_POST,'purchase'))
            {
                ?>
            <script>alert('Thank you! Your order confirmation has been sent to your mail box. Welcome to go shopping again!');</script>
                <?php

                $address=$_POST['userMail'];
                $subject='Your Order Confirmation From Grocery Store';
                $header = "From: Grocery Store < Grocery Store@uts.edu.au>"."\r\n";
                $header .= "MIME-Version: 1.0\r\n";
                $header .= "Content-type:text/html; charset=utf-8\r\n";
                $header .= "X-Mailer: PHP\r\n";

                $message = '<html><body>';
                $message .= "Dear, ";
                $message .=$_POST['username'];
                $message .="<br>Thank you for shopping in Grocery Store.<h3><span style=\"color:#F00\">Please check your contact details!</span></h3><h2>Your contact details are:</h2>";
                $message .= '<table width="20%" border="1" >';
                $message .= "<tr><td>&nbsp;Name:</td><td>&nbsp;" . $_POST['username'] . "</td></tr>";
                $message .= "<tr><td>&nbsp;Address:</td><td>&nbsp;" . $_POST['address'] . "</td></tr>";
                $message .="<tr><td>&nbsp;Suburb:</td><td>&nbsp;".$_POST['suburb']."</td></tr>";
                $message .= "<tr><td>&nbsp;State:</td><td>&nbsp;" . $_POST['state'] . "</td></tr>";
                $message .= "<tr><td>&nbsp;Country:</td><td>&nbsp;" . $_POST['country'] . "</td></tr>";
                $message .= "<tr><td>&nbsp;Email:</td><td>&nbsp;" . $_POST['userMail'] . "</td></tr>";
                $message .= "</table>";
                $message .= "<br>";
                $message .= '<table align="center" border="1" style="background-color: #ffad83" style="text-align: center">';
                $message .= "<tr><th colspan=\"4\"><h3 align=\"center\">Order Details</h3></th></tr><tr><th width=\"25%\" >Product Name</th><th width=\"25%\" >Quantity</th><th width=\"25%\" >Unit Price</th><th width=\"25%\" >Subtotal</th></tr>";
                if(!empty($_SESSION['cart'])):
                    $total = 0;
                    $totalQuantity = 0;
                    foreach($_SESSION['cart'] as $key => $product):
                        $message .= "<tr><td style='text-align: left'>".$product['name']."</td><td style='text-align: center'>";
                        if($product['quantity'] >$product['in_stock'])
                        {
                            $message .= $product['in_stock'];
                        }
                        else{
                            $message .= $product['quantity'];}
                        $message .="</td><td style='text-align: center'>$ ".$product['price']."</td><td style='text-align: center'>$ ";
                        if($product['quantity'] > $product['in_stock'])
                        {
                            $message .= number_format($product['in_stock'] * $product['price'], 2);
                        }
                        else{
                            $message .= number_format($product['quantity'] * $product['price'], 2);
                        }
                        $message .= "</td></tr>";
                        if ($product['quantity'] > $product['in_stock']){
                            $total = $total + ($product['in_stock'] * $product['price']);

                        }
                        else {
                            $total = $total + ($product['quantity'] * $product['price']);
                        }
                        if ($product['quantity'] > $product['in_stock']){
                            $totalQuantity = $totalQuantity + $product['in_stock'];

                        }
                        else {
                            $totalQuantity = $totalQuantity + $product['quantity'];
                        }
                    endforeach;
                endif;
                $message .="<tr><td style='text-align: center'>".$totalquantity."</td>";
                $message .="<td style='text-align: center'>Total</td>";
                $message .="<td style='text-align: center'>$ ".$total."</td></tr>";
                $message .= "</table>";
                $message .= "</body></html>";

                mail($address,$subject,$message,$header);

                unset($_SESSION['cart']);
                unset($_SESSION['is_checked_out']);
            }


            ?>

            <div class="contactForm">
                <h1>Contact Information:</h1>

                <form method="post" autocomplete="on">
                    <p>
                        <label for="username" class="icon-user"> Name
                            <span style="color:red" class="required" >*</span>
                        </label>
                        <input type="text" name="username" id="username" required="required"/>
                    </p>

                    <p>
                        <label for="userMail" class="icon-envelope"> E-mail address
                            <span style="color:red" class="required">*</span>
                        </label>
                        <input type="email" name="userMail" id="userMail" required="required" />
                    </p>

                    <p>
                        <label for="address" class="icon-link"> Address </label>
                        <span style="color:red" class="required">*</span>
                        <input type="text" name="address" id="address" required="required"/>
                    </p>

                    <p>
                        <label for="suburb" class="icon-link"> Suburb </label>
                        <span style="color:red" class="required">*</span>
                        <input type="text" name="suburb" id="suburb" required="required"/>
                    </p>

                    <p>
                        <label for="state" class="icon-link"> State </label>
                        <span style="color:red" class="required">*</span>
                        <input type="text" name="state" id="state" required="required"/>
                    </p>

                    <p>
                        <label for="country" class="icon-link"> Country </label>
                        <span style="color:red" class="required">*</span>
                        <input type="text" name="country" id="country" required="required"/>
                    </p>

                    <p class="indication">Fields with
                        <span style="color:red" class="required"> * </span>are required</p>

                    <input type="submit" name="purchase" value="Purchase" required="required" class="btn btn-primary"/>

                </form>
            </div>

        <?php

        endif;

    }

    //Show the product details when they are clicked on the visual browser
    else{

        if($result):
            if(mysqli_num_rows($result) > 0):
                while($productRow = mysqli_fetch_assoc($result)):

               if($_SESSION['is_checked_out'] == false){

        ?>

        <form method="post" name="quantityForm" onsubmit="return validateForm()">
            <table class='table table-striped'>
                <thead>
                <tr>
                    <th>Item(s)</th>
                    <th>Unit Price</th>
                    <th>Unit Quantity</th>
                    <th>Units In Stock</th>
                    <th>Please Enter Quantity</th>
                </tr>
                </thead>
                <tr>
                    <th><?php echo $productRow['product_name']; ?></th>
                    <th><?php echo $productRow['unit_price']; ?></th>
                    <th><?php echo $productRow['unit_quantity']; ?></th>
                    <th><?php echo $productRow['in_stock']; ?></th>
                    <th><input type="text" name="number" value="0" required class="form-control"></th>
                    <th><input type="submit" name="addToCart" value="Add to cart" class="btn btn-primary"></th>
                    <input type="hidden" name="productName" value="<?php echo $productRow['product_name'] ?>">
                    <input type="hidden" name="productUnitPrice" value="<?php echo $productRow['unit_price']; ?>">
                    <input type="hidden" name="productInStock" value="<?php echo $productRow['in_stock']; ?>">
                </tr>

            </table>
        </form>


        <?php
    }else{

            ?>

        <h3>Sorry, items are not currently available before you proceed to check out or clear the cart.</h3>

    <?php

    }
                endwhile;
            endif;
        endif;
    }

    ?>
    <div id='warningMessage' class='alert alert-danger' style="display: none;"></div>
</div>

<div class="bottomRightFrame container">

    <?php
    //user defined array_column function, please use this function if the system runs on php version <  5.5
    if (! function_exists('array_column')) {
        function array_column(array $input, $columnKey, $indexKey = null) {
            $array = array();
            foreach ($input as $value) {
                if ( !array_key_exists($columnKey, $value)) {
                    trigger_error("Key \"$columnKey\" does not exist in array");
                    return false;
                }
                if (is_null($indexKey)) {
                    $array[] = $value[$columnKey];
                }
                else {
                    if ( !array_key_exists($indexKey, $value)) {
                        trigger_error("Key \"$indexKey\" does not exist in array");
                        return false;
                    }
                    if ( ! is_scalar($value[$indexKey])) {
                        trigger_error("Key \"$indexKey\" does not contain scalar value");
                        return false;
                    }
                    $array[$value[$indexKey]] = $value[$columnKey];
                }
            }
            return $array;
        }
    }


    //shopping cart
    $productIds = array();

    //check if add button has been submitted
    if(filter_input(INPUT_POST,'addToCart' ))
    {
        if(isset($_SESSION["cart"]))
        {

            //keep track of how many products are in the shopping cart
            $count = count($_SESSION["cart"]);

            //create sequential array for matching array keys to products' IDs
            $productIds = array_column($_SESSION["cart"], 'id');


            //pre_r($productIds);

            //check if the products' id already exists in the array
            if (!in_array(filter_input(INPUT_GET, 'productId'), $productIds))
            {
                $_SESSION["cart"][$count] = array
                (
                    'id' => filter_input(INPUT_GET, 'productId'),
                    'name' => filter_input(INPUT_POST, 'productName'),
                    'price' => filter_input(INPUT_POST, 'productUnitPrice'),
                    'in_stock' => filter_input(INPUT_POST, 'productInStock'),
                    'quantity' => filter_input(INPUT_POST, 'number')

                );

            }
            else {
                //product already exists, increase quantity
                //match array key to id of the product being added to the cart

                for ($i = 0; $i < count($productIds); $i++)
                {
                    if($productIds[$i] == filter_input(INPUT_GET,'productId'))
                    {
                        //add item quantity to the existing product in the array
                        $_SESSION['cart'][$i]['quantity'] += filter_input(INPUT_POST, 'number');
                    }
                }
            };

        }
        else
        {

            $_SESSION["cart"][0] = array
            (
                'id' => filter_input(INPUT_GET, 'productId'),
                'name' => filter_input(INPUT_POST, 'productName'),
                'price' => filter_input(INPUT_POST, 'productUnitPrice'),
                'in_stock' => filter_input(INPUT_POST, 'productInStock'),
                'quantity' => filter_input(INPUT_POST, 'number')

            );

        }
    }
    //delete the selected row of products
    if(filter_input(INPUT_GET,'action') == 'delete' )
    {

        //loop through all products in the shopping cart until it matches with GET id variable
        foreach ($_SESSION['cart'] as $key => $product)
        {

            if($product['id'] == filter_input(INPUT_GET,'id'))
            {

                //remove product from the shopping cart when it matches with the GET id
                unset($_SESSION['cart'][$key]);

            }
            // reset session array keys so that they match with $product_ids numeric array
            $_SESSION['cart'] = array_values($_SESSION['cart']);

        }

    }
    //clear the shopping cart
    if(filter_input(INPUT_GET,'action') == 'clear' )
    {
        //remove product from the shopping cart
        unset($_SESSION['cart']);
        unset($_SESSION['is_checked_out']);

    }

    ?>


    <table width="100%" class="table table-striped">

        <?php
        //show the status of the shopping cart when it is empty
        if (empty($_SESSION['cart']))
        {

            ?>
           <h2 align="center">Your Shopping Cart Is Empty.<br>Enjoy Your Shopping!</h2>
            <table>

                <tr>
                    <td>
                        <form><input class="btn btn-primary" type="button" value="Clear" onclick="window.location.href='MainPage.php?action=clear'">
                        </form>

                    </td>

                    <td>
                                <form> <input class="btn btn-primary" type="button" value="Check Out" onclick="AlertEmptyCart();">
                                </form>


                    </td>
                </tr>

            </table>
            <div id='warningCheckMessage' class='alert alert-danger' style="display: none;"></div>
            <?php


        }
        //show the status of the shopping cart when the checkout button is clicked
        else if (filter_input(INPUT_GET,'action') == 'checkout')
        {
            ?>
            <h2 align="center">Thank You!<br>Please Proceed To Check Out.</h2>
            <?php


        }
        //show the status of the shopping cart when it is not empty
        else if(!empty($_SESSION['cart']))
        {

        $total = 0;
        ?>
        <h2 align="center">Your Shopping Cart</h2>
        <thead>
        <tr>
            <td>Item(s)</td>
            <td>Quantity</td>
            <td>Unit Price</td>
            <td>Subtotal</td>
        </tr>
        </thead>
        <?php


        foreach ($_SESSION['cart'] as $key => $product):
            ?>

            <tr>
                <td><?php echo $product['name']; ?></td>
                <td><?php
                    if($product['quantity'] > $product['in_stock'])
                {
                    echo $product['in_stock'];
                }
                else
                    {
                        echo $product['quantity'];

                }

                     ?>
                </td>
                <td>$<?php echo $product['price']; ?></td>
                <td>$<?php
                    if($product['quantity'] > $product['in_stock'])
                {
                    echo number_format($product['in_stock'] * $product['price'], 2);
                }

                else{
                    echo number_format($product['quantity'] * $product['price'], 2);
                }
                ?>

                </td>
                <td>
                    <form><input type="button" class="btn btn-primary" value="Remove" onclick="window.location.href='MainPage.php?action=delete&id=<?php echo $product['id']; ?>'">
                    </form>
                </td>

            </tr>


            <?php
            if($product['quantity'] > $product['in_stock'])
            {
                $total = $total + ($product['in_stock'] * $product['price']);
            }
            else
                {
                $total = $total + ($product['quantity'] * $product['price']);
            }

        endforeach;

        ?>
<thead>
        <tr>
            <td align="right">Total</td>
            <td algin="right">$<?php echo number_format($total, 2); ?></td>

        </tr>
</thead>
<thead>
        <tr>
            <td>
                <form><input type="button" class="btn btn-primary" value="Clear" onclick="window.location.href='MainPage.php?action=clear'">
                </form>

            </td>

            <td>
                <?php

                if (isset($_SESSION['cart'])):

                    if (count($_SESSION['cart']) > 0):

                        ?>

                        <form> <input type="button" class="btn btn-primary" value="Check Out" onclick="window.location.href='MainPage.php?action=checkout'">
                        </form>

                    <?php

                    endif;

                endif;



                ?>
            </td>
        </tr>
</thead>
    </table>
<?php
}


?>

</div>
</div>


</div>
</body>
</html>
