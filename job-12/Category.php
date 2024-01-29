<?php

require_once 'Product.php';

class Category{

    private ?int $id;
    private ?string $name;
    private ?string $description;
    private ?DateTime $createdAt;
    private ?DateTime $updatedAt;
    private ?PDO $db;

    public function __construct($id=null, $name=null, $description=null, $createdAt=null, $updatedAt=null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
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

     
    public function getDescription()
    {
        return $this->description;
    }

   
    public function setDescription($description)
    {
        $this->description = $description;

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


    public function getProducts()
    {
        $request= $this->db->prepare("SELECT * FROM product WHERE category_id = :id");
        $request->bindValue(':id', $this->id, PDO::PARAM_INT);
        $request->execute();
        $results= $request->fetchAll(PDO::FETCH_ASSOC);

       
        $productArray=[];
        foreach($results as $result) {
            $productArray[]=new Product(
                $result['id'],
                $result['name'],
                json_decode($result['photos']),
                $result['price'],
                $result['description'],
                $result['quantity'],
                new DateTime($result['createdAt']),
                new DateTime($result['updatedAt']),
                $result['category_id'],
            );

        }
        return $productArray;
    }

   

}





?>