<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> PDO Opdracht Product Toevoegen</title>
</head>

<body>
    <h1> Een product Toevoegen</h1>

    <form action="insert-product.php" method="POST">
        <label for="productNaam">Product Naam:</label>
        <input type="text" id="productNaam" name="productNaam" required><br>

        <label for="omschrijving">Omschrijving:</label>
        <textarea id="omschrijving" name="omschrijving" required></textarea><br>

        <label for="prijsPerStuk">Prijs per stuk:</label>
        <input type="number" id="prijsPerStuk" name="prijsPerStuk" step="0.01" required><br>

        <label for="foto">Foto:</label>
        <input type="file" id="foto" name="foto" accept="image/*" required><br>

        <button type="submit" name="submit">Product Toevoegen</button>
    </form>

</body>
</html>

<?php
require_once '../includes/Database.php';
require_once 'Product.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $productNaam = $_POST['productNaam'];
    $omschrijving = $_POST['omschrijving'];
    $prijsPerStuk = $_POST['prijsPerStuk'];
    $foto = $_FILES['foto'];

    $uploadDir = 'uploads/';
    $fotoNaam = time() . '_' . basename($foto['name']);
    $uploadBestand = $uploadDir . $fotoNaam;

    
    if (move_uploaded_file($foto['tmp_name'], $uploadBestand)) {
        
        $product = new Product();
        $result = $product->insertProduct($productNaam, $omschrijving, $prijsPerStuk, $fotoNaam);

        if ($result) {
            echo "Succesvol het product toegevoegd!";
        } else {
            echo "Het is niet gelukt om het product toe te voegen.";
        }
    } else {
        echo "Foto niet gelukt up te loaden.";
    }
}
?>
