<?php
    class Restaurant
    {
        private $name;
        private $address;
        private $city;
        private $state;
        private $zip;
        private $cuisine_id;
        private $id;

        function __construct($name, $address, $city, $state, $zip, $cuisine_id, $id=null)
        {
            $this->name = $name;
            $this->address = $address;
            $this->city = $city;
            $this->state = $state;
            $this->zip = $zip;
            $this->cuisine_id = $cuisine_id;
            $this->id = $id;
        }

        function getId()
        {
            return $this->id;
        }

        function getName()
        {
            return $this->name;
        }

        function getAddress()
        {
            return $this->address;
        }

        function getCity()
        {
            return $this->city;
        }

        function getState()
        {
            return $this->state;
        }

        function getZip()
        {
            return $this->zip;
        }

        function getCuisineId()
        {
            return $this->cuisine_id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function setAddress($new_name)
        {
            $this->address = (string) $new_name;
        }

        function setCity($new_name)
        {
            $this->city = (string) $new_name;
        }

        function setState($new_name)
        {
            $this->state = (string) $new_name;
        }

        function setZip($new_name)
        {
            $this->zip = (string) $new_name;
        }

        function setCuisineId($new_name)
        {
            $this->cuisine_id = (int) $new_name;
        }

        function save()
        {
            $executed = $GLOBALS['DB']->exec("INSERT INTO restaurants (name, address, city, state, zip, cuisine_id) VALUES ('{$this->getName()}', '{$this->getAddress()}', '{$this->getCity()}', '{$this->getState()}', '{$this->getZip()}', {$this->getCuisineId()})");
            if ($executed) {
                $this->id = $GLOBALS['DB']->lastInsertId();
                return true;
            } else {
                return false;
            }
        }

        static function getAll()
        {
            $returned_name = $GLOBALS['DB']->query("SELECT * FROM restaurants;");
            $restaurants = array();
            foreach($returned_name as $restaurant) {
                $name = $restaurant['name'];
                $id = $restaurant['id'];
                $address = $restarant['address'];
                $city = $restaurant['city'];
                $state = $restaurant['state'];
                $zip = $restaurant['zip'];
                $cuisine_id = $restaurant['cuisine_id'];
                $new_restaurant = new Restaurant($name, $address, $city, $state, $zip, $cuisine_id, $id);
                array_push($restaurants, $new_restaurant);
            }
            return $restaurants;
        }

        static function deleteAll()
        {
            $executed = $GLOBALS['DB']->exec("DELETE FROM restaurants;");
            if ($executed) {
                return true;
            } else {
                return false;
            }
        }

        static function find($search_id)
        {
            $found_name = array();
            $returned_name = $GLOBALS['DB']->prepare("SELECT * FROM restaurants WHERE cuisine_id = :id");
            $returned_name->bindParam(':id', $search_id, PDO::PARAM_STR);
            $returned_name->execute();
            foreach($returned_name as $restaurant) {
              $name = $restaurant['name'];
              $id = $restaurant['id'];
              $address = $restaurant['address'];
              $city = $restaurant['city'];
              $state = $restaurant['state'];
              $zip = $restaurant['zip'];
              $cuisine_id = $restaurant['cuisine_id'];
              if ($cuisine_id == $search_id) {
                  $found_names = new Restaurant($name, $address, $city, $state, $zip, $cuisine_id, $id);
                  array_push($found_name, $found_names);
              }
            }
            return $found_name;
        }
    }
?>
