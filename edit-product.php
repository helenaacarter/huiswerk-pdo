<?php
require_once "Product.php";

if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $product = new Product();
    $productData = $product->getProductById($productId);

    if (!$productData) {
        echo "Lukte niet om product te vinden";
        exit;
    }
} else {
    echo "Er is geen product ID opgegeven";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $productNaam = $_POST['productNaam'];
    $omschrijving = $_POST['omschrijving'];
    $prijsPerStuk = $_POST['prijsPerStuk'];
    $foto = $_FILES['foto'];

    
    $fotoPad = $productData['foto'];
    if ($foto['name']) {
        $fotoPad = "../uploads/" . basename($foto['name']);
        $fotoSaved = move_uploaded_file($foto['tmp_name'], $fotoPad);
        if (!$fotoSaved) {
            echo "Niet gelukt om foto te uploaden";
            exit;
        }
    }

    // Werk het product bij
    $success = $product->updateProduct($productId, $productNaam, $omschrijving, $prijsPerStuk, $fotoPad);

    if ($success) {
        echo "Bijwerken van product is gelukt";
    } else {
        echo "Niet gelukt om product bij te werken";
    }
}
?>



<!DOCTYPE html>
<html>

<head>
    <title>Product Bijwerken</title>
</head>

<body>
    <h1>Product Bijwerken</h1>
    
    <form action="edit-product.php?id=<?php echo $productData['id']; ?>" method="POST" enctype="multipart/form-data">
        <label for="productNaam">Productnaam:</label>
        <input type="text" name="productNaam" value="<?php echo $productData['productNaam']; ?>" required><br>

        <label for="omschrijving">Omschrijving:</label>
        <input type="text" name="omschrijving" value="<?php echo $productData['omschrijving']; ?>" required><br>

        <label for="prijsPerStuk">Prijs Per Stuk:</label>
        <input type="number" name="prijsPerStuk" value="<?php echo $productData['prijsPerStuk']; ?>" required><br>

        <label for="foto">Foto:</label>
        <input type="file" name="foto" accept="image/*"><br>

        <button type="submit">Product Bijwerken</button>
    </form>
</body>

</html>
