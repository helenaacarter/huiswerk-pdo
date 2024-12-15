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

    
    public function getProductById($id) {
        $sql = "SELECT * FROM products WHERE id = :id";
        $params = [':id' => $id];
        return $this->db->run($sql, $params)->fetch();
    }

    
    public function updateProduct($id, $productNaam, $omschrijving, $prijsPerStuk, $fotoPad = null)
    {
        if ($fotoPad) {
            $sql = "UPDATE products SET productNaam = :productNaam, omschrijving = :omschrijving, 
                    prijsPerStuk = :prijsPerStuk, foto = :foto WHERE id = :id";
            $params = [
                ':productNaam' => $productNaam,
                ':omschrijving' => $omschrijving,
                ':prijsPerStuk' => $prijsPerStuk,
                ':foto' => $fotoPad,
                ':id' => $id
            ];
        } else {
            $sql = "UPDATE products SET productNaam = :productNaam, omschrijving = :omschrijving, 
                    prijsPerStuk = :prijsPerStuk WHERE id = :id";
            $params = [
                ':productNaam' => $productNaam,
                ':omschrijving' => $omschrijving,
                ':prijsPerStuk' => $prijsPerStuk,
                ':id' => $id
            ];
        }

        return $this->db->run($sql, $params);
    }
}
?>
