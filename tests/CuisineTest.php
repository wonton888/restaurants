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

    class CuisineTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Cuisine::deleteAll();
            Restaurant::deleteAll();
        }

        function test_deleteAll()
        {
            //Arrange
            $type = "Italian";
            $type2 = "Japanese";
            $test_Cuisine = new Cuisine($type);
            $test_Cuisine->save();
            $test_Cuisine2 = new Cuisine($type2);
            $test_Cuisine2->save();

            //Act
            Cuisine::deleteAll();
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        // function test_getAll()
        // {
        //     //Arrange
        //     $type = "Work stuff";
        //     $type2 = "Home stuff";
        //     $test_Category = new Category($type);
        //     $test_Category->save();
        //     $test_Category2 = new Category($type2);
        //     $test_Category2->save();
        //
        //     //Act
        //     $result = Category::getAll();
        //
        //     //Assert
        //     $this->assertEquals([$test_Category, $test_Category2], $result);
        // }

    }

?>
