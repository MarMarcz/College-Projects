<div class="card-group">
    <div class="card">
        <h2>Admin Panel</h2>
        Here You can add new products also moderate opinions
        <br><hr>
        <?php include_once("../functions/moderate_opinions.php"); include_once("../functions/add_product.php"); moderate_opinion(); ?>
            <form method="POST" class="form-inline" style="width: auto">
                <fieldset><legend>Add product</legend>
                    <?php add_product(); echo "<br>"?>
                    <label>Tittle
                        <input name="tittle" type="text" class="form-control" placeholder="Enter Coin Title" required>
                    </label>
                    <label>Image
                        <input name="img" type="number" min="1" class="form-control" placeholder="Enter Image number" required>
                    </label> <br>
                    <label>Price with shipping
                        <input name="p_with_s" type="number" class="form-control" placeholder="Enter Price" required>
                    </label>
                    <label>Price without shipping
                        <input name="p_without_s" type="number" class="form-control" placeholder="Enter Price" required>
                    </label> <br>
                    <label>Amount
                        <input name="amount" type="number" class="form-control" placeholder="Enter available amount" required>
                    </label>
                    <label>Short description
                        <input name="short_d" type="text" class="form-control" placeholder="Enter short coin description" required>
                    </label> <br>
                    <label>Long description <br>
                        <textarea name="long_d" placeholder="Enter long coin description" required></textarea>
                    </label> <br>
                    <button type="submit" class="btn btn-success">Add</button>
                </fieldset>
            </form>
<hr>
            <form method="POST" class="form-inline" style="width: auto">
                <fieldset><legend>Delete product</legend>
                    <?php delete_product(); echo "<br>"?>
                    <label>Product id
                        <input name="product_id" type="number" min="1" class="form-control" placeholder="Enter product id" required>
                    </label>
                    <br>
                    <button type="submit" class="btn btn-success">Delete</button>

                </fieldset>
            </form>
    </div>
    <div class="card">
        <h2>List of Products:</h2>
        <?php
            $base = connect();
            $sql = "SELECT id, tittle FROM coin";
            $result = $base->query($sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "ID: " . $row['id'] . " Title: " . $row['tittle'] . "<br>";
                }
            }

            echo "<hr><h2>List of Opinions:</h2>";

            $sql= "SELECT id, op_content FROM opinions";
            $result = $base->query($sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)){
                    echo "ID: " .$row['id'] ." Opinion Content: \"" .$row['op_content'] ."\"<br>";
                }
            }
            ?>

    </div>


</div>


    <form method="POST" class="form-inline" style="width: auto">
        <fieldset>
            <legend>Moderating opinions</legend>
            <label>
                <select>
                    <option>Delete</option>
                    <option>Edit</option>
                </select>
                <input type="number" name="op_number" min="1" max="100" maxlength="4" class="form-control" placeholder="Enter opinion ID" required>
                <button type="submit" class="btn btn-success">Submit</button> <br>
            </label>
        </fieldset>
    </form>