<?php

function check_login()
{
    include_once ("../functions/check_email.php");
    include_once("../functions/database.php");
    $base = connect();
    if (isset($_POST['email']) && isset($_POST['password']) && (!empty($_POST['email']) || !empty($_POST['password']))) {
        if(check_email($_POST['email'])) {
            $sql = "SELECT email, password FROM users";
            $result = $base->query($sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($_POST['email'] == $row['email'] && $_POST['password'] == $row['password']) {
                        $_SESSION['email'] = $_POST['email'];
                        $_SESSION['password'] = $_POST['password'];
                        return "<h2>Welcome!</h2><br>";
                    }
                }
                return "<h4>Wrong email or password</h4>";
            }
        } else
            return "<h4>Wrong email type</h4>";

    } return "";
}

?>