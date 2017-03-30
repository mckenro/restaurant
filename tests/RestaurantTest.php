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
            $test_Restaurant = new Restaurant($name, '2323 N Street', 'Seattle', 'WA', 98101, 4);
            $test_Restaurant->save();

            //Act
            $result = $test_Restaurant->getId();

            //Assert
            $this->assertTrue(is_numeric($result));
        }

        function test_getCuisineId()
        {
            //Arrange
            $name = "Pasta Mammas";
            $test_Restaurant = new Restaurant($name, '2323 N Street', 'Seattle', 'WA', 98101, 4);

            //Act
            $result = $test_Restaurant->getCuisineId();

            //Assert
            $this->assertEquals(4, $result);
        }

        function test_setCuisineId()
        {
            //Arrange
            $name = "Pasta Mammas";
            $test_Restaurant = new Restaurant($name, '2323 N Street', 'Seattle', 'WA', 98101, 4);
            $new_cuisine_id = 2;

            //Act
            $test_Restaurant->setCuisineId($new_cuisine_id);
            $result = $test_Restaurant->getCuisineId();

            //Assert
            $this->assertEquals($new_cuisine_id, $result);
        }

        function test_find()
        {
            //Arrange
            $cuisine_id = 4;
            $cuisine_id2 = 2;
            $cuisine_id3 = 4;
            $test_cuisine_id = new Restaurant('Restaurant 1', '2323 N Street', 'Seattle', 'WA', 98101, 4);
            $test_cuisine_id->save();
            $test_cuisine_id2 = new Restaurant('Restaurant 2', '3333 S Evanston St', 'Seattle', 'WA', 98132, 3);
            $test_cuisine_id2->save();
            $test_cuisine_id3 = new Restaurant('Restaurant 3', '3333 S Evanston St', 'Seattle', 'WA', 98132, 4);
            $test_cuisine_id3->save();

            //Act
            $result = Restaurant::find(4);

            //Assert
            $this->assertEquals([$test_cuisine_id, $test_cuisine_id3], $result);
        }


    }
?>
