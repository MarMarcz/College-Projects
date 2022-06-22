<?php
    function add_opinion()
    {
        include_once ("validation_text.php");
        $base = connect();
        session_start();

        if(isset($_POST['op_content']) && isset($_POST['stars'])) {
                $op_content = $_POST['op_content'];
                $op_content = get_rid_of_bad_char($op_content);
                $stars = $_POST['stars'];
                $id=$_GET['id'];
                $sql = "INSERT INTO opinions(id, op_content, stars, coin_id) VALUES ('','$op_content','$stars','$id')";
                $base->query($sql);
                return "(added opinion)";
        }
    }

?>