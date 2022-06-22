<?php
    function sort_by_price ()
    {
        include_once ("validation_text.php");
        if (isset($_POST['how_sort'])) {
            switch ($_POST['how_sort']) {
                case 'ascending': { //rosnaca
                    $sql = "SELECT id, tittle,image,price_with_shipping, price_without_shipping,amount, short_description FROM coin ORDER BY price_with_shipping ASC";
                }
                    break;
                case 'descending': { //malejaca
                    $sql = "SELECT id, tittle,image,price_with_shipping, price_without_shipping,amount, short_description FROM coin ORDER BY price_with_shipping DESC";
                }
                    break;
                default:
                    $sql = "SELECT id, tittle,image,price_with_shipping, price_without_shipping,amount, short_description FROM coin";
            }
        } else if (isset($_POST['min']) && isset($_POST['max'])) {
            $_POST['min'] = get_rid_of_bad_char($_POST['min']);
            $_POST['max'] = get_rid_of_bad_char($_POST['max']);
            $sql = "SELECT id, tittle,image,price_with_shipping, price_without_shipping,amount, short_description FROM coin WHERE price_with_shipping BETWEEN " .$_POST['min'] ." AND " .$_POST['max'];
        } else if(isset($_POST['product_search'])) {
            $title = $_POST['product_search'];
            $title = get_rid_of_bad_char($title);
            $sql = 'SELECT id, tittle,image,price_with_shipping, price_without_shipping,amount, short_description FROM coin WHERE tittle="'.$title.'"';
        }
        else {
            $sql = "SELECT id, tittle,image,price_with_shipping, price_without_shipping,amount, short_description FROM coin";
        }

        return $sql;
    }

?>