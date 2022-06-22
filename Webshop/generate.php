<?php
$base = connect();
$sql = sort_by_price();

$result = $base->query($sql);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "<div class='col-sm-6 col-xl-3'>        
                <div class='card card-shortdes'>              
                    <h4 class='card-title'>".$row["tittle"]."</h4>
                    <img alt='Coin Photo' class='card-img' src='photos/".$row["image"].".png'>               
                    <a href='cart/cart.php' class='btn btn-primary add-to-cart'>Add to cart</a>                       
                    <a href='see_more_description.php?id=" .$row['id'] ."' class='btn btn-primary see-more'>See more</a>                                       
                    <p class='card-text'>"
                        ."Price with shipping: " .$row["price_with_shipping"] ." $<br>"
                        ."Price without shipping: " .$row["price_without_shipping"] ." $<br>"
                        ."Available amount: " .$row["amount"] ."<br>"
                        ."Short description: \"" .$row["short_description"] ."\"<br>"
                    ."</p>                 
                </div>                        
        </div>";
    }
} else {
    echo "<h3 style='text-align: center ; margin-top: 30px'>No such products </h3>";
    //to be continued
}

?>