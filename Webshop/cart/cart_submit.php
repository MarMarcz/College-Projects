<form method="POST">
    <h4>Check Your Order</h4><br>
    <?php
    include_once ("../functions/validation_text.php");
    if(isset($_POST)){
        $f_name = get_rid_of_bad_char($_POST['f_name']);
        $l_name = get_rid_of_bad_char($_POST['l_name']);
        $country = $_POST['country'];
        $city = get_rid_of_bad_char($_POST['city']);
        $street_address = get_rid_of_bad_char($_POST['street_address']);
        $flat_number = get_rid_of_bad_char($_POST['flat_number']);
        $email = get_rid_of_bad_char($_POST['email']);
        $area_code = $_POST['area_code'];
        $phone_number = get_rid_of_bad_char($_POST['phone_number']);
        $delivery_type = $_POST['delivery_type'];
        echo "First Name: $f_name <br> Last Name: $l_name <br> Country: $country <br> City: $city <br> Street Adress: $street_address <br> Flat Number: $flat_number <br> Email: $email <br> Adrea Code: $area_code <br> Phone Number: $phone_number <br> Deliver Type: $delivery_type<br>";
    }

    ?>
    <br>
    <button name="reset" type="submit">Wrong data</button>
    <button name="button" onclick="alert('It was a pleasure doing business with you! Thank you for shopping')" type="submit">Correct</button>
</form>

<?php
    if(isset($_POST['button'])) {
        header("Location: ../index.php");
    }
    if (isset($_POST['reset'])) {
        header("Location: cart.php");
    }
?>
