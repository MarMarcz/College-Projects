<?php
    function moderate_opinion() {
        $base = connect();
        if(isset($_POST['op_number'])){
                $op_id = $_POST['op_number'];
                $sql = "SELECT id FROM opinions WHERE id=" .$_POST['op_number'];
                $result = $base->query($sql);
                if (mysqli_num_rows($result) > 0) {
                    $Single_row = mysqli_fetch_assoc($result);
                            if($Single_row['id'] == $_POST['op_number']) {
                                $base->query("DELETE FROM opinions WHERE id=$op_id");
                                return "Successfully deleted";
                            }
                    } else
                        return"There are no opinions with this ID";

        } else
            return "";
    }
?>