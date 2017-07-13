<<?php
    class Cuisine
    {
        private $type;
        private $id;



        function __construct($type, $id = null)
        {
            $this->type = $type;
            $this->id = $id;
        }

        function setType($new_type)
        {
            $this->type = (string) $new_type;
        }

        function getType()
        {
            return $this->type;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $executed = $GLOBALS['DB']->exec("INSERT INTO cuisines (type) VALUES ('{$this->getType()}')");
            if ($executed) {
                $this->id = $GLOBALS['DB']->lastInsertId();
                return true;
            } else {
                return false;
            }

        }

        static function getAll()
        {
            $returned_cuisines = $GLOBALS['DB']->query("SELECT * FROM cuisines;");
            $cuisines = array();
            foreach($returned_cuisines as $item) {
                $cuisine_type = $item['type'];
                $cuisine_id = $item['id'];
                $new_cuisine = new Cuisine($cuisine_type, $cuisine_id);
                array_push($cuisines, $new_cuisine);
            }
            return $cuisines;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM cuisines;");
        }

        static function find($search_id)
        {
            $found_cuisine = null;
            $returned_cuisines = $GLOBALS['DB']->prepare("SELECT * FROM cuisines WHERE id = :id");
            $returned_cuisines->bindParam(':id', $search_id, PDO::PARAM_STR);
            $returned_cuisines->execute();
            foreach($returned_cuisines as $item) {
                $cuisine_type = $item['type'];
                $cuisine_id = $item['id'];
                if ($cuisine_id == $search_id) {
                    $found_cuisine = new Cuisine($cuisine_type, $cuisine_id);
                }
            }
            return $found_cuisine;
        }
        function getRestaurants()
        {
            $restaurants = Array();
            $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants WHERE cuisine_id = {$this->getId()};");
            foreach($returned_restaurants as $item) {
                $name = $item['name'];
                $cuisine_id = $item['cuisine_id'];
                $description = $item['description'];
                $restaurant_id = $item['id'];
                $new_restaurant = new Restaurant($name, $cuisine_id, $description, $restaurant_id);
                array_push($restaurants, $new_restaurant);
            }
            return $restaurants;
        }

    }

?>
