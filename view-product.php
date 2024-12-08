<?php
require_once 'Product.php';

$productModel = new Product();
$products = $productModel->getAllProducts();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Overzicht Producten</title>
</head>

<body>
    <h1> Overzicht van producten </h1>

    <?php if (empty($products)): ?>
        <p> Er zijn geen producten </p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Product Naam</th>
                    <th>Prijs Per Stuk</th>
                    <th>Omschrijving</th>
                    <th>Foto</th>
                    <th>Actie</th>
                </tr>
            </thead>


            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= htmlspecialchars($product['naam']) ?></td>
                        <td>€<?= htmlspecialchars(number_format($product['prijs_per_stuk'], 2)) ?></td>
                        <td><?= htmlspecialchars($product['omschrijving']) ?></td>
                        <td>
                            <?php if ($product['foto']): ?>
                                <img src="<?= htmlspecialchars($product['foto']) ?>" alt="Product afbeelding">
                            <?php else: ?>
                                Geen afbeelding
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="edit-product.php?id=<?= htmlspecialchars($product['id']) ?>"> Bewerk Foto </a> |
                            <a href="delete-product.php?id=<?= htmlspecialchars($product['id']) ?>" onclick="return confirm('Wil je echt dat het product verwijderd wordt?')">Verwijderen</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
