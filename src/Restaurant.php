<?php
    class Restaurant
    {
        private $id;
        private $name;
        private $cuisine_id;
        private $description;


        function __construct($description, $id = null, $cuisine_id, $name)
        {
            $this->id = $id;
            $this->name = $name;
            $this->cuisine_id = $cuisine_id;
            $this->description = $description;

        }


        function setDescription($new_description)
        {
            $this->description = (string) $new_description;
        }

        function getDescription()
        {
            return $this->description;
        }

        function getId()
        {
            return $this->id;
        }

        function getCuisineId()
        {
            return $this->cuisine_id;
        }

        function setName($new_name)
        {
            $this->description = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->exec("INSERT INTO restaurants (description, cuisine_id, name)
                VALUES ('{$this->getDescription()}', {$this->getCuisineId()}, '{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants ORDER BY name;");
            $restaurants = array();
            foreach($returned_restaurants as $restaurant){
                $description = $restaurant['description'];
                $id = $restaurant['id'];
                $cuisine_id = $restaurant['cuisine_id'];
                $name = $restaurant['name'];
                //var_dump($id);
                $new_restaurant = new Restaurant($description, $id, $cuisine_id, $name);
                array_push($restaurants, $new_restaurant);
            }
            return $restaurants;
        }

        static function find($search_id)
        {
            $found_restaurant = null;
            $restaurants = Restaurant::getAll();
            foreach ($restaurants as $restaurant) {
                $restaurant_id = $restaurant->getId();
                if ($restaurant_id == $search_id) {
                    $found_restaurant = $restaurant;
                }
            }
            return $found_restaurant;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM restaurants;");
        }




    }
?>
