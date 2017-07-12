<?php
    class restaurant
    {
        private $name;
        private $id;

        function __construct($name, $id = null)
        {
            $this->name = $name;
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

        function save()
        {
            $executed = $GLOBALS['DB']->exec("INSERT INTO restaurants (name) VALUES ('{$this->getName()}');");
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
                $id = $item['id'];
                $new_restaurant = new Restaurant($name, $id);
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
            $returned_restaurants->bindParam('id', $search_id, PDO::PARAM_STR);
            $returned_restaurants->execute();
            foreach($returned_restaurants as $item) {
                $item_name = $item['name'];
                $item_id = $item['id'];
                if ($item_id == $search_id) {
                    $new_restaurant = new Restaurant($item_name, $item_id);

                }
            }
            return $new_restaurant;
        }

    }



?>
