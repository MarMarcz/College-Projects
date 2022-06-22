<html lang="en">

<?php
    session_start();
    include_once ("../head.php");
?>
<head>
    <link href="../design3.css" rel="stylesheet">
</head>

<body>
    <a class="nav-link" href="../index.php">return</a>
    <h1>$YourCoin</h1>
    <div class="container">
        <div class="card" style="margin: 30px">
            <h2>Shipping Form:</h2><hr>
            <?php include_once ("../functions/check_email.php");

            if (isset($_POST['email']) && isset($_POST) && !empty($_POST)){
                if(check_email($_POST['email']) && check_phone_number($_POST['phone_number'])) {
                    include_once("cart_submit.php");
                } else {
                    echo '<script type="text/javascript">
                          window.onload = function () { alert("Wrong email or phone number"); } 
                          </script><a href="cart.php">Fill the form again</a>';
                }
            } else {
                print ('<form method="POST" class="form-inline" style="width: auto">
                    <h4>Full Name *</h4>
                        <label>First Name
                            <input name="f_name" type="text" class="form-control" placeholder="Enter First Name" required>
                        </label>
                        <label>Last Name
                            <input name="l_name" type="text" min="1" class="form-control" placeholder="Enter Last Name" required>
                        </label> <br>
                    <br><hr><h4>Adress *</h4>
                        <label>Country
                            <select name="country">
                                <option>Poland</option>
                            </select>
                        </label>
                        <label>City
                            <input name="city" type="text" class="form-control" placeholder="Enter City" required>
                        </label>
                        <label>Street Address
                            <input name="street_address" type="text" class="form-control" placeholder="Enter Street Address" required>
                        </label>
                        <label>Flat number
                            <input name="flat_number" type="number" min="1" class="form-control" placeholder="Enter Flat Number" required>
                        </label><br>
                    <br><hr><h4>Contact Info *</h4>
                        <label> Email Adress
                            <input name="email" type="email" class="form-control" placeholder="Enter Email" required>
                        </label>
                        <label>Phone number
                            <select name="area_code">
                                <option>+48</option>
                            </select>
                            <input name="phone_number" type="number" min="0" max="999999999" class="form-control" placeholder="Enter Phone Number" required>
                        </label> <br>
                    <br><hr><h4>Delivery Type *</h4>
                        <select name="delivery_type">
                            <option>Parcel locker</option>
                            <option>FedEx</option>
                            <option>UPS</option>
                        </select>
                        <br><br>
                        <button type="submit" class="btn btn-success">Submit</button>
                </form>');
            }
            ?>
        </div>
    </div>
</body>

</html>