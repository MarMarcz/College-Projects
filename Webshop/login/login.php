<html lang="en">

<?php
    session_start();
    include_once ("../head.php");
    include_once ("check_login.php");
?>
<head>
    <link href="../design3.css" rel="stylesheet">
</head>


<body>
<a class="nav-link" href="../index.php">return</a>
    <h1>$YourCoin</h1>
<div class="container" style="margin-bottom: 100px">
    <div class="card card-login ">
        <?php
            echo check_login();
            if(!isset($_SESSION['email'])) { //if we aren't logged
                include_once("login_form.php");
            }
            else { //if we are logged
                echo "<h3>You are logged as Admin</h3>
                   <form action='logout.php' method='POST'>
                       <button type='submit' class='btn btn-success'>Logout</button>
                   </form>";
                include_once ("../admin/admin_panel.php");
                }

        ?>
    </div>
</div>




</body>


</html>
