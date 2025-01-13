<?php
require_once "Product.php";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $productID = $_GET['id'];

    $product = new Product();

    if ($product->deleteProduct($productID)) {
        echo "Product succesvol verwijderd.";
    } else {
        echo "Het is niet gelukt met het verwijderen van het product.";
    }
} else {
    echo "Ongeldige product-ID.";
}
?>
