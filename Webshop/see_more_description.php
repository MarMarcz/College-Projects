<html lang="en">
<link href="design3.css" rel="stylesheet">
<a class="nav-link" href="index.php">return</a>
<?php
include_once ("head.php");
include_once ("functions/database.php");
include_once ("header/header_start.php");
include_once ("header/header_end.php");
include_once("functions/add_opinion.php");
include_once("functions/see_opinions.php");
$base = connect();
if(isset($_GET['id'])) {
    $sql = "SELECT id,tittle,image,price_with_shipping, price_without_shipping,amount,long_description FROM coin WHERE id=" . $_GET['id'];
    $result = $base->query($sql);
    if (mysqli_num_rows($result) > 0) {
        $singleRow = mysqli_fetch_assoc($result);
        echo "<div class='container'>
        <div class='card-group'> 
              <div class='card card-longdes'>           
                  <h4 class='card card-title' style='font-size: xx-large'>" . $singleRow["tittle"] . "</h4>       
                  <img class='card-img card-img-longdes' alt='Coin Photo' src='photos/" . $singleRow["image"] . ".png'>
              </div> 
              <div class='card card-longdes'>                                                                                                          
                  <p class='card-text card-text-longdes'>"
            . "Price with shipping: " . $singleRow["price_with_shipping"] . " $<br>"
            . "Price without shipping: " . $singleRow["price_without_shipping"] . " $<br>"
            . "Available amount: " . $singleRow["amount"] . "<br>"
            . "Long description: \"" . $singleRow["long_description"] . "\"<br>"
            . "Available shipping methods: Parcel locker, FedEx, UPS"
            . "</p>
                  
                  <form method='POST' action='cart/cart.php'>
                  <label>                  
                    <input name='amount_to_cart' class='form-control' type='number' max='10' min='1' placeholder='amount to cart' required>
                    <button class='btn btn-success' type='submit'>Add to cart</button>
                    </label>
                  </form>
                                                 
                  <form method='POST'>  
                  <label>
                        <label for='op_content'>Have an opinion about this product?</label><br>                                      
                        <textarea name='op_content' maxlength='255' placeholder='What do you think about this product?' required></textarea>
                        <br><label for='stars'>Stars range:</label>
                        <input name='stars' class='form-control' type='range' max='10' min='1' placeholder='how many stars' required>                     
                        <button class='btn btn-success' type='submit'>Add opinion</button>  
                        <label>" . add_opinion() . "</label>      
                  </label>                                                                              
                  </form>
              </div>                                               
           </div>
                    
           <div class='opinions'>
            <h2>See opinions</h2><hr>";
        see_opinions();
        echo "</div>
       </div> 
           <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js' integrity='sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p' crossorigin='anonymous'></script>";
    } else
        echo "Something went wrong :(";
} else
    echo "Something went wrong :(";
?>

</html>
