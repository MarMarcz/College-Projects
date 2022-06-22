<!DOCTYPE html>
<html lang="en">

<?php
    session_start();
    include_once ("head.php");
?>

<body>
    <main>
        <?php
            include_once ("header/header_start.php");
            include_once ("header/sorting_buttons.php");
            include_once ("header/header_end.php");
        ?>

        <div class="row">
            <?php
                require_once ("functions/database.php");
                include_once ("functions/sort.php");
            //echo "<div class='card-deck'>";
                include_once ("generate.php");
            //echo "</div>";
            ?>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>