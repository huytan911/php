<?php 
if (isset($_GET['option'])){
    switch($_GET['option']){
        case 'home':
            include "views/showproduct.php";
            break;
        case 'checkout':
            include "views/checkout.php";
            break;
        case 'showproduct':
            include "views/showproduct.php";
            break;
        case 'productdetail':
            include "views/productdetail.php";
            break;
        case 'news':
            include "views/news.php";
            break;
        case 'cart':
            include "views/cart.php";
            break;
        case 'feedback':
            include "views/feedback.php";
            break; 
        case 'wishlist':
            include "views/wishlist.php";
            break;       
    }
}
else {
    include "views/showproduct.php";
}
?>