<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Restaurant.php";
    require_once "src/Cuisine.php";

    $server = 'mysql:host=localhost:8889;dbname=local_food_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class RestaurantTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Restaurant::deleteAll();
            Cuisine::deleteAll();
        }

        function test_getId()
        {
            //Arrange
            $name = "Pasta Mammas";
            $test_Restaurant = new Restaurant($name);
            $test_Restaurant->save();

            $category = "Italian";
            $cuisine_id = $test_Restaurant->getId();
            $test_Cuisine = new Cuisine($category, $cuisine_id);
            $test_Cuisine->save();

            //Act
            $result = $test_Cuisine->getCuisineId();
            //Assert
            $this->assertTrue(is_numeric($result));
        }

        function test_getName()
        {
            //Arrange
            $name = "Pasta Mammas";
            $test_Restaurant = new Restaurant($name);
            $test_Restaurant->save();
            $cuisine_id = $test_Restaurant->getId();
            $category = "Italian";
            $test_Cuisine = new Cuisine($category, $cuisine_id);

            //Act
            $result = $test_Restaurant->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_setName()
        {
            //Arrange
            $name = "Pasta Mammas";
            $test_Restaurant = new Restaurant($name);
            $test_Restaurant->save();
            $cuisine_id = $test_Restaurant->getId();

            $category = "Italian";
            $test_Cuisine = new Cuisine($category, $cuisine_id);
            $new_category = "American";

            //Act
            $test_Restaurant->setName($new_category);
            $result = $test_Restaurant->getName();

            //Assert
            $this->assertEquals($new_category, $result);
        }

        function test_getCuisineId()
        {
            //Arrange
            $name = "Pasta Mammas";
            $test_Restaurant = new Restaurant($name);
            $test_Restaurant->save();
            $cuisine_id = $test_Restaurant->getId();
            $category = "Italian";
            $test_Cuisine = new Cuisine($category, $cuisine_id);

            //Act
            $result = $test_Cuisine->getCuisineId();
        }

        function test_setCuisineId()
        {
            //Arrange
            $name = "Pasta Mammas";
            $test_Restaurant = new Restaurant($name);
            $test_Restaurant->save();
            $cuisine_id = $test_Restaurant->getId();

            $name = "Bubba Ganoush";
            $test_Restaurant2 = new Restaurant($name);
            $test_Restaurant2->save();
            $cuisine_id2 = $test_Restaurant2->getId();

            $category = "Italian";
            $test_Cuisine = new Cuisine($category, $cuisine_id);

            //Act
            $test_Cuisine->setCuisineId($cuisine_id2);
            $result = $test_Cuisine->getCuisineId();

            //Assert
            $this->assertEquals($cuisine_id2, $result);
        }

        function test_save()
        {
            //Arrange
            $name = "Pasta Mammas";
            $test_Restaurant = new Restaurant($name);
            $test_Restaurant->save();


            $category = "Italian";
            $cuisine_id = $test_Restaurant->getId();
            $test_Cuisine = new Cuisine($category, $cuisine_id);
            $test_Cuisine->save();

            //Act
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals($test_Cuisine, $result);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Pasta Mammas";
            $test_Restaurant = new Restaurant($name);
            $test_Restaurant->save();
            $cuisine_id = $test_Restaurant->getId();

            $category = "Italian";
            $category2 = "American";
            $test_Cuisine = new Cuisine($category, $cuisine_id);
            $test_Cuisine->save();
            $test_Cuisine2 = new Cuisine($category2, $cuisine_id);
            $test_Cuisine2->save();

            //Act
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals([$test_Cuisine, $test_Cuisine2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Pasta Mammas";
            $test_Restaurant = new Restaurant($name);
            $test_Restaurant->save();
            $cuisine_id = $test_Restaurant->getId();

            $category = "Italian";
            $category2 = "American";
            $test_Cuisine = new Cuisine($category, $cuisine_id);
            $test_Cuisine->save();
            $test_Cuisine2 = new Cuisine($category2, $cuisine_id);
            $test_Cuisine2->save();

            //Act
            Cuisine::deleteAll();
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Pasta Mammas";
            $test_Restaurant = new Restaurant($name);
            $test_Restaurant->save();
            $cuisine_id = $test_Restaurant->getId();

            $category = "Italian";
            $category2 = "American";
            $test_Cuisine = new Cuisine($category, $cuisine_id);
            $test_Cuisine->save();
            $test_Cuisine2 = new Cuisine($category2, $cuisine_id);
            $test_Cuisine2->save();

            //Act
            $result = Cuisine::find($test_Cuisine->getId());

            //Assert
            $this->assertEquals($test_Cuisine, $result);
        }
    }
?>
