<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";
    require_once "src/Restaurant.php";

    $server = 'mysql:host=localhost;dbname=restaurant_reviews_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class RestaurantTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Cuisine::deleteAll();
            Restaurant::deleteAll();
        }

        function testGetId()
        {
            //Arrange
            $type = "Italian";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();

            $name = "City Chinese";
            $description = "OK Chinese food";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($description, $id, $cuisine_id, $name);
            $test_restaurant->save();

            //Act
            $result = $test_restaurant->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function testGetCuisineId()
        {
            //Arrange
            $type = "Italian";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();

            $name = "City Chinese";
            $description = "OK Chinese food";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($description, $id, $cuisine_id, $name);
            $test_restaurant->save();

            //Act
            $result = $test_restaurant->getCuisineId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function testSave()
        {
            //Arrange
            $type = "Italian";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();

            $name = "City Chinese";
            $description = "OK Chinese food";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($description, $id, $cuisine_id, $name);

            //Act
            $test_restaurant->save();

            //Assert
            $result = Restaurant::getAll();
            $this->assertEquals($test_restaurant, $result[0]);
        }

        function testGetAll()
        {
            //Arrange
            $type = "Italian";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();

            $cuisine_id = $test_cuisine->getId();

            $name = "City Chinese";
            $description = "OK Chinese food";
            $test_restaurant = new Restaurant($description, $id, $cuisine_id, $name);
            $test_restaurant->save();

            $name2 = "City Mexican";
            $description2 = "OK Mexican food";
            $test_restaurant2 = new Restaurant($description2, $id, $cuisine_id, $name2);
            $test_restaurant2->save();

            //Act
            $result = Restaurant::getAll();

            //Assert
            $this->assertEquals([$test_restaurant, $test_restaurant2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $type = "Italian";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();

            $name = "City Chinese";
            $description = "OK Chinese food";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($description, $id, $cuisine_id, $name);
            $test_restaurant->save();

            $name2 = "City Mexican";
            $description2 = "OK Mexican food";
            $test_restaurant2 = new Restaurant($description2, $id, $cuisine_id, $name2);
            $test_restaurant2->save();

            //Assert
            Restaurant::deleteAll();

            //Assert
            $result = Restaurant::getAll();
            $this->assertEquals([], $result);
        }

        function testFind()
        {
            //Arrange
            $type = "Italian";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();

            $name = "City Chinese";
            $description = "OK Chinese food";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($description, $id, $cuisine_id, $name);
            $test_restaurant->save();

            $name2 = "City Mexican";
            $description2 = "OK Mexican food";
            $test_restaurant2 = new Restaurant($description2, $id, $cuisine_id, $name2);
            $test_restaurant2->save();

            //Act
            $result = Restaurant::find($test_restaurant->getId());

            //Assert
            $this->assertEquals($test_restaurant, $result);
        }

    }

?>
