<?php
    class Cuisine
    {
        private $category;
        private $cuisine_id;
        private $id;

        function __construct($category, $assigned_cuisine_id, $id = null)
        {
            $this->category = $category;
            $this->cuisine_id = (int) $assigned_cuisine_id;
            $this->id = $id;
        }

        function getId()
        {
            return $this->id;
        }

        function getCategory()
        {
            return $this->category;
        }

        function getCuisineId()
        {
            return $this->cuisine_id;
        }

        function setCategory($new_category)
        {
            $this->category = (string) $new_category;
        }

        function setCuisineId($new_cuisine_id)
        {
            $this->cuisine_id = (int) $new_cuisine_id;
        }

        function save()
        {
            $executed = $GLOBALS['DB']->exec("INSERT INTO cuisines (category, cuisine_id) VALUES ('{$this->getCategory()}', {$this->getCuisineId()});");
            if ($executed) {
                $this->id = $GLOBALS['DB']->lastInsertId();
                return true;
            } else {
                return false;
            }
        }

        static function getAll()
        {
            $returned_category = $GLOBALS['DB']->query("SELECT * FROM cuisines;");
            $categories = array();
            foreach($returned_category as $category) {
                $category = $category['category'];
                $cuisine_id = $catgory['cuisine_id'];
                $id = $category['id'];
                $new_category = new Cuisine($category, $cuisine_id, $id);
                array_push($categories, $new_category);
            }
            return $categories;
        }

        static function deleteAll()
        {
            $executed = $GLOBALS['DB']->exec("DELETE FROM cuisines;");
            if ($executed) {
                return true;
            } else {
                return false;
            }
        }

        static function find($search_id)
        {
            $found_category = null;
            $returned_category = $GLOBALS['DB']->prepare("SELECT * FROM cuisines WHERE id = :id");
            $returned_category->bindParam(':id', $search_id, PDO::PARAM_STR);
            $returned_category->execute();
            foreach($returned_category as $category) {
                $category = $category['category'];
                $id = $category['id'];
                if ($id == $search_id) {
                    $found_category = new Cuisine($category, $id);
                }
            }
            return $found_category;
        }
    }
?>
