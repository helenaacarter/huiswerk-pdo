<?php
require_once "../includes/Database.php";

class Product
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function insertProduct($productNaam, $omschrijving, $prijsPerStuk, $fotoPad)
    {
        $sql = "INSERT INTO products (productNaam, omschrijving, prijsPerStuk, foto) 
                VALUES (:productNaam, :omschrijving, :prijsPerStuk, :foto)";
        $params = [
            ':productNaam' => $productNaam,
            ':omschrijving' => $omschrijving,
            ':prijsPerStuk' => $prijsPerStuk,
            ':foto' => $fotoPad
        ];

        return $this->db->run($sql, $params);
    }

    public function getAllProducts() {
        $sql = "SELECT * FROM products";
        return $this->db->run($sql)->fetchAll(); 
    }

    public function getProductById($productID) {
        $sql = "SELECT * FROM products WHERE productID = :productID";

        $params = ["productID" => $productID];

        return $this->db->run($sql, $params)->fetch(); 
    }

    public function updateProduct($productID, $productNaam, $omschrijving, $prijsPerStuk, $fotoPad) {
        $sql = "UPDATE products 
                SET productNaam = :productNaam, omschrijving = :omschrijving, prijsPerStuk = :prijsPerStuk, foto = :foto 
                WHERE productID = :productID";
        
        $params = [
            ':productNaam' => $productNaam,
            ':omschrijving' => $omschrijving,
            ':prijsPerStuk' => $prijsPerStuk,
            ':foto' => $fotoPad,
            ':productID' => $productID
        ];

        return $this->db->run($sql, $params) ? true : false;
    }

    public function deleteProduct($productID)
    {
        $product = $this->getProductById($productID);
        if ($product) {
            if ($product['foto'] && file_exists($product['foto'])) {
                unlink($product['foto']);
            }

            $sql = "DELETE FROM products WHERE productID = :productID";
            $params = [":productID" => $productID];
            return $this->db->run($sql, $params);
        }

        return false; 
    }
}
?>
