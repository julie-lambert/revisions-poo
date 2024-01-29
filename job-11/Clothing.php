<?php
require_once "Product.php";
class Clothing extends Product
{
    protected ?PDO $db;
    // size, color, type, material_fee
    public function __construct(protected ?int $id = null, protected ?string $name = null, protected ?string $description = null, protected ?int $price = null, protected ?string $image = null, protected ?DateTime $createdAt = null, protected ?DateTime $updatedAt = null, protected ?int $category_id = null, protected ?string $size = null, protected ?string $color = null, protected ?string $type = null, protected ?int $materialFee = null)
    {
        parent::__construct($id, $name, $description, $price, $image, $createdAt, $updatedAt, $category_id);
    }
}