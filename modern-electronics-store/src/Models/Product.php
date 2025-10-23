<?php

class Product {
    private $id;
    private $name;
    private $description;
    private $price;
    private $quantity;

    public function __construct($id, $name, $description, $price, $quantity) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public static function all() {
        // Logic to retrieve all products from the database
    }

    public static function find($id) {
        // Logic to find a product by its ID
    }

    public function save() {
        // Logic to save the product to the database
    }

    public function delete() {
        // Logic to delete the product from the database
    }
}