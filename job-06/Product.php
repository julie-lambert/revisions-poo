<?php

require_once 'Category.php';

class Product{

    private ?int $id;
    private ?string $name;
    private ?array $photos;
    private ?int $price;
    private ?string $description;
    private ?int $quantity;
    private ?DateTime $createdAt;
    private ?DateTime $updatedAt;
    private ?int $category_id;
    private ?PDO $db;

    public function __construct($id = null, $name = null, $photos = null, $price = null, $description = null, $quantity= null, $createdAt = null, $updatedAt = null, $category_id= null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->photos = $photos;
        $this->price = $price;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->category_id = $category_id;
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
}


?>