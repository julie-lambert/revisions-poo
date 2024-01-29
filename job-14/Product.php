<?php

require_once 'Category.php';

abstract class Product{


    protected ?PDO $db;

    public function __construct(
    protected ?int $id = null,
    protected ?string $name = null,
    protected ?array $photos = null,
    protected ?int $price = null,
    protected ?string $description = null,
    protected ?int $quantity = null,
    protected ?DateTime $createdAt = null,
    protected ?DateTime $updatedAt = null,
    protected ?int $category_id = null
    )
    {

        $dName = "mysql:host=localhost;dbname=draft-shop;";

        $host = "root";

        $password = "";

try {
        $this->db = new PDO($dName, $host, $password);
        echo "connexion réussie";
    } catch (PDOException $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    

    public function getId()
    {
        return $this->id;
    }

    
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

 
    public function getName()
    {
        return $this->name;
    }

 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

  
    public function getPhotos()
    {
        return $this->photos;
    }

    public function setPhotos($photos)
    {
        $this->photos = $photos;

        return $this;
    }

   
    public function getPrice()
    {
        return $this->price;
    }

   
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    
    public function getDescription()
    {
        return $this->description;
    }

   
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

   
    public function getQuantity()
    {
        return $this->quantity;
    }

 
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

   
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

  
    public function getCategory_id()
    {
        return $this->category_id;
    }

    
    public function setCategory_id($category_id)
    {
        $this->category_id = $category_id;

        return $this;
    }




 

    /**
     * Get the value of db
     */ 
    public function getDb()
    {
        return $this->db;
    }

    /**
     * Set the value of db
     *
     * @return  self
     */ 
    public function setDb($db)
    {
        $this->db = $db;

        return $this;
    }


    public function getCategory()
    {

        $request= $this->db->prepare("SELECT * FROM category WHERE id = :id");
        $request->bindValue(':id', $this->category_id, PDO::PARAM_INT);
        $request->execute() ;
        $result= $request->fetch(PDO::FETCH_ASSOC);
        
        $category = new Category($result['id'],$result['name'],$result['description'],(new DateTime($result['createdAt'])),(new DateTime($result['updatedAt'])));
        return $category;
        

    }

    abstract public function findOneById(int $id): Product|bool;
    

    abstract public function findAll();


    protected function create()
    {

      // vérification qu'on a bien tous les attributs nécessaires
      if (!$this->name || !$this->photos || !$this->price || !$this->description || !$this->quantity || !$this->category_id) {
        return false;

    }
    // insertion dans la bdd
    $query = $this->db->prepare("INSERT INTO product (name, photos, price, description, quantity, createdAt, updatedAt, category_id) VALUES (:name, :photos, :price, :description, :quantity, :createdAt, :updatedAt, :category_id)");
    $query->execute([
        "name" => $this->name,
        "photos" => json_encode($this->photos),
        "price" => $this->price,
        "description" => $this->description,
        "quantity" => $this->quantity,
        "createdAt" => $this->createdAt->format('Y-m-d H:i:s'),
        "updatedAt" => $this->updatedAt->format('Y-m-d H:i:s'),
        "category_id" => $this->category_id
    ]);
    // Si la requête a fonctionné, on récupère l'id généré
    if ($query->rowCount() > 0) {
        $this->id = $this->db->lastInsertId();
        return $this;
    } else {
        return false;
    }
    
    }

    protected function update()
    {
        // vérification qu'on a bien tous les attributs nécessaires
        if (!$this->id || !$this->name || !$this->photos || !$this->price || !$this->description || !$this->quantity || !$this->category_id) {
            return false;
        }
        // insertion dans la bdd
        $query = $this->db->prepare("UPDATE product SET name = :name, photos = :photos, price = :price, description = :description, quantity = :quantity, createdAt = :createdAt, updatedAt = :updatedAt, category_id = :category_id WHERE id = :id");
        $query->execute([
            "id" => $this->id,
            "name" => $this->name,
            "photos" => json_encode($this->photos),
            "price" => $this->price,
            "description" => $this->description,
            "quantity" => $this->quantity,
            "createdAt" => $this->createdAt->format('Y-m-d H:i:s'),
            "updatedAt" => $this->updatedAt->format('Y-m-d H:i:s'),
            "category_id" => $this->category_id
        ]);
        // Si la requête a fonctionné, on récupère l'id généré
        if ($query->rowCount() > 0) {
            return $this;
        } else {
            return false;
        }
    }


}


?>