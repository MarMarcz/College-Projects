<?php
    function add_product(){
        include_once ("validation_text.php");
        $base = connect();
        if (isset($_POST['tittle']) && isset($_POST['img']) && isset($_POST['p_with_s']) && isset($_POST['p_without_s']) && isset($_POST['amount']) && isset($_POST['short_d']) && isset($_POST['long_d'])) {
            $directory = "../photos"; // Returns an array of files
            $files = scandir($directory); // Count the number of files and store them inside the variable..
            $num_files = count($files) - 2; // Removing 2 because we do not count '.' and '..'.

            if ($num_files <= $_POST['img']){
                echo "No such an img to put";
            } else {
                $title = get_rid_of_bad_char($_POST['tittle']);
                $img = $_POST['img'];
                $p_with_s = $_POST['p_with_s'];
                $p_without_s = $_POST['p_without_s'];
                $amount = $_POST['amount'];
                $short_d = get_rid_of_bad_char($_POST['short_d']);
                $long_d = get_rid_of_bad_char($_POST['long_d']);

                $sql = "INSERT INTO coin(id, tittle, image, price_with_shipping, price_without_shipping, amount, short_description, long_description) VALUES ('','$title','$img','$p_with_s','$p_without_s','$amount','$short_d','$long_d')";
                $base->query($sql);
                echo "Added Successfully";
            }
        }
    }

    function delete_product(){
        $base = connect();
        if(isset($_POST['product_id'])) {

            $sql = "SELECT id FROM opinions WHERE coin_id=" .$_POST['product_id'];
            $result = $base->query($sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $base->query("DELETE FROM opinions WHERE id=$id");
                }
            }

            $product_id = $_POST['product_id'];
            $sql = "SELECT id FROM coin WHERE id=" . $_POST['product_id'];
            $result = $base->query($sql);
            if (mysqli_num_rows($result) > 0) {
                $Single_row = mysqli_fetch_assoc($result);
                if ($Single_row['id'] == $_POST['product_id']) {
                    $base->query("DELETE FROM coin WHERE id=$product_id");
                    return "Successfully deleted";
                }
            } else {
                echo "No such product";
            }
        }
    }

?>
