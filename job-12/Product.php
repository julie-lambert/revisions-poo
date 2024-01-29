<?php

require_once 'Category.php';

class Product{

    protected ?int $id;
    protected ?string $name;
    protected ?array $photos;
    protected ?int $price;
    protected ?string $description;
    protected ?int $quantity;
    protected ?DateTime $createdAt;
    protected ?DateTime $updatedAt;
    protected ?int $category_id;
    protected ?PDO $db;

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

    public function findOneById(int $id): Product|bool
    {
        $request= $this->db->prepare("SELECT * FROM product WHERE id = :id");
        $request->bindValue(':id', $id, PDO::PARAM_INT);
        $request->execute() ;
        $result= $request->fetch(PDO::FETCH_ASSOC);
        $result['photos']=json_decode($result['photos']);
        
        if($result){

        $this->setId($result['id']);
        $this->setName($result['name']);
        $this->setPhotos($result['photos']);
        $this->setPrice($result['price']);
        $this->setDescription($result['description']);
        $this->setQuantity($result['quantity']);
        $this->setCreatedAt(new DateTime($result['createdAt']));
        $this->setUpdatedAt(new DateTime($result['updatedAt']));
        $this->setCategory_id($result['category_id']);

        return $this;
        }else{
            return false;
        }
    }

    public function findAll()
    {
        $request= $this->db->prepare("SELECT * FROM product");
        $request->execute() ;
        $results= $request->fetchAll(PDO::FETCH_ASSOC);
        $products = [];
        foreach($results as $result){
            $product = new Product($result['id'], $result['name'], json_decode($result['photos']), $result['price'], $result['description'], $result['quantity'] , new DateTime($result['createdAt']), new DateTime($result['updatedAt']), $result['category_id']);
            $products[]=$product;
        }
        return $products;

    }

    public function create()
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

    public function update()
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