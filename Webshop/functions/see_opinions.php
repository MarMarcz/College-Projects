<?php
    function see_opinions()
    {
        $base = connect();
        $sql = "SELECT id, op_content, stars, coin_id FROM opinions WHERE coin_id=" . $_GET['id'];
        $result = $base->query($sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {

                echo "User: " .$row['op_content'] ." Stars: " .$row['stars'];
                if(isset($_SESSION['email']))
                    echo "<br>(Opinion ID: " .$row['id'] .")";
                //there will be better looking stuff later
                echo "<hr>";
            }
        } else
            echo "No opinions yet";
    }
?>