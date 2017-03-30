<?php
    class Cuisine
    {
        private $category;
        private $id;

        function __construct($category, $id = null)
        {
            $this->category = $category;
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

        function setCategory($new_category)
        {
            $this->category = (string) $new_category;
        }

        function save()
        {
            $executed = $GLOBALS['DB']->exec("INSERT INTO cuisines (category) VALUES ('{$this->getCategory()}');");
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
    }
?>
