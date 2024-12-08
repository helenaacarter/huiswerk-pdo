<?php
require_once '../includes/Database.php';

class Product
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function insertProduct($productNaam, $omschrijving, $prijsPerStuk, $foto)
    {
        $sql = "INSERT INTO products (productNaam, omschrijving, prijsPerStuk, foto) 
                VALUES (:productNaam, :omschrijving, :prijsPerStuk, :foto)";
        $params = [
            ':productNaam' => $productNaam,
            ':omschrijving' => $omschrijving,
            ':prijsPerStuk' => $prijsPerStuk,
            ':foto' => $foto
        ];

        return $this->db->run($sql, $params);
    }

    public function getAllProducts()
    {
        $sql = "SELECT id, productNaam, omschrijving, prijsPerStuk, foto FROM products";
        $stmt = $this->db->run($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
}
?>
