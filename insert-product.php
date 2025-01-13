<?php
require_once "Product.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productNaam = $_POST['productNaam'];
    $omschrijving = $_POST['omschrijving'];
    $prijsPerStuk = $_POST['prijsPerStuk'];
    $foto = $_FILES['foto']; 

    $fotoPath = "../uploads/" . basename($foto['name']); 
    $fotoSaved = move_uploaded_file($foto['tmp_name'], $fotoPath); 

    if ($fotoSaved) {
        $product = new Product();
        $success = $product->insertProduct($productNaam, $omschrijving, $prijsPerStuk, $fotoPath);

        if ($success) {
            echo "Product goed toegevoegd!";
        } else {
            echo "Het is niet gelukt met het toevoegen van het product.";
        }
    } else {
        echo "Foto mislukt up te loaden ";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Nieuw Product Toevoegen</title>
</head>

<body>
    <h1>Nieuw Product Toevoegen</h1>
    <form action="insert-product.php" method="POST" enctype="multipart/form-data">
        <label for="productNaam">Productnaam:</label>
        <input type="text" name="productNaam" required><br>

        <label for="omschrijving">Omschrijving:</label>
        <input type="text" name="omschrijving" required><br>

        <label for="prijsPerStuk">Prijs Per Stuk:</label>
        <input type="number" name="prijsPerStuk" required><br>

        <label for="foto">Foto:</label>
        <input type="file" name="foto" accept="image/*"><br>

        <button type="submit">Product Toevoegen</button>
    </form>
</body>

</html>