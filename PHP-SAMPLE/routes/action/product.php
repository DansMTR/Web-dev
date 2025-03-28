<?php
class Product {
    public $name;
    public $price;
    public $model;
    public $description;
    public $date;
    public $id;
    public $category;
    
    public function __construct($name, $price, $model, $description, $category = null,$date = '', $id = null ) {
        $this->name = $name;
        $this->price = $price;
        $this->model = $model;
        $this->description = $description;
        $this->date = $date;
        $this->id = $id;
        $this->category = $category;
    }
}
?>
