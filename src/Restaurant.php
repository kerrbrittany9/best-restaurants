<?php
    class Restaurant
    {
        private $name;
        private $description;
        private $cuisine_id;
        private $id;

        function __construct($name, $cuisine_id, $description, $id = null)
        {
            $this->name = $name;
            $this->cuisine_id = $cuisine_id;
            $this->description = $description;
            $this->id = $id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function getId()
        {
            return $this->id;
        }

        function getCuisineId()
        {
            return $this->cuisine_id;
        }

        function getDescription()
        {
          return $this->description;
        }

        function save()
        {

            $executed = $GLOBALS['DB']->exec("INSERT INTO restaurants (name, cuisine_id, description) VALUES ('{$this->getName()}', {$this->getCuisineId()}, '{$this->getDescription()}');");
            if ($executed) {
                $this->id = $GLOBALS['DB']->lastInsertId();
                return true;
            } else {
                return false;
            }
        }

        static function getAll()
        {
            $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants;");
            $restaurants = array();
            foreach($returned_restaurants as $item) {
                $name = $item['name'];
                $cuisine_id = $item['cuisine_id'];
                $description = $item['description'];
                $id = $item['id'];
                $new_restaurant = new Restaurant($name, $cuisine_id, $description, $id);
                array_push($restaurants, $new_restaurant);
            }
            
            return $restaurants;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM restaurants;");
        }

        static function find($search_id)
        {
            $returned_restaurants = $GLOBALS['DB']->prepare("SELECT * FROM restaurants WHERE id = :id");
            $returned_restaurants->bindParam(':id', $search_id, PDO::PARAM_STR);
            $returned_restaurants->execute();
            foreach($returned_restaurants as $item) {
                $item_name = $item['name'];
                $cuisine_id = $item['cuisine_id'];
                $description = $item['description'];
                $item_id = $item['id'];
                if ($item_id == $search_id) {
                    $new_restaurant = new Restaurant($item_name, $cuisine_id, $description, $item_id);
                }
            }
            return $new_restaurant;
        }

    }



?>
