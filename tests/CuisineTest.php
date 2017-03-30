<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";
    require_once "src/Restaurant.php";

    $server = 'mysql:host=localhost:8889;dbname=local_food_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class CuisineTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Cuisine::deleteAll();
            Restaurant::deleteAll();
        }

        function test_getId()
        {
            //Arrange
            $category = "American";
            $test_Cuisine = new Cuisine($category);
            $test_Cuisine->save();
            var_dump($test_Cuisine);
            //Act
            $result = $test_Cuisine->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_getCategory()
        {
            //Arrange
            $category = "American";
            $test_category = new Cuisine($category);

            //Act
            $result = $test_category->getCategory();

            //Assert
            $this->assertEquals($category, $result);
        }

        function test_setCategory()
        {
            //Arrange
            $category = "American";
            $test_category = new Cuisine($category);
            $new_category = "Italian";

            //Act
            $test_category->setCategory($new_category);
            $result = $test_category->getCategory();

            //Assert
            $this->assertEquals($new_category, $result);
        }
    }
?>
