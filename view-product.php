<?php
require_once "Product.php";
$product = new Product();
$producten = $product->getAllProducts();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Producten Overzicht</title>
</head>

<body>
    <h1>Producten Overzicht</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ProductNaam</th>
                <th>Omschrijving</th>
                <th>Prijs Per Stuk</th>
                <th>Foto</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($producten as $product): ?>
            <tr>
                <td><?php echo htmlspecialchars($product['productNaam']); ?></td>
                <td><?php echo htmlspecialchars($product['omschrijving']); ?></td>
                <td>€<?php echo number_format($product['prijsPerStuk'], 2); ?></td>
                <td>
                    <img src="<?php echo htmlspecialchars($product['foto']); ?>" alt="Foto" width="50" height="50">
                </td>
                <td>
                    <a href="edit-product.php?id=<?php echo $product['productID']; ?>">Bewerken</a>
                    <a href="delete-product.php?id=<?php echo $product['productID']; ?>"
                        onclick="return confirm('Weet u zeker dat u dit product wilt verwijderen?')">Verwijderen</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>
