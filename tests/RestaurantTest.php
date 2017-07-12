<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */


    require_once "src/Restaurant.php";
    require_once "src/Cuisine.php";

    $server = 'mysql:host=localhost:8889;dbname=dining_test';
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

        function testSave()
        {
            $type = "italian";
            $test_cuisine = new Cuisine($type);
            $test_cuisine->save();

            $name = "Olive Garden";
            $cuisine_id = $test_cuisine->getId();

            $test_restaurant = new Restaurant($name, $cuisine_id);
            $executed = $test_restaurant->save();

            $this->assertTrue($executed, "Item was not saved to database");
        }

        function testGetAll()
        {
            $type = "italian";
            $test_cuisine = new Cuisine($type);
            $test_cuisine->save();
            $cuisine_id = $test_cuisine->getId();

            $name = "Roadhouse";
            $name2 = "Olive Garden";
            $test_restaurant = new Restaurant($name, $cuisine_id);
            $test_restaurant->save();
            $test_restaurant2 = new Restaurant($name2, $cuisine_id);
            $test_restaurant2->save();

            $result = Restaurant::getAll();

            $this->assertEquals([$test_restaurant, $test_restaurant2], $result);
        }

        function testDeleteAll()
        {
            $type = "italian";
            $test_cuisine = new Cuisine($type);
            $test_cuisine->save();
            $cuisine_id = $test_cuisine->getId();

            $name = "Roadhouse";
            $name2 = "Olive Garden";

            $test_restaurant = new Restaurant($name, $cuisine_id);
            $test_restaurant->save();
            $test_restaurant2 = new Restaurant($name2, $cuisine_id);
            $test_restaurant2->save();

            Restaurant::deleteAll();
            $result = Restaurant::getAll();

            $this->assertEquals([], $result);

        }

        function testGetId()
        {
            $type = "italian";
            $test_cuisine = new Cuisine($type);
            $test_cuisine->save();

            $name = "Claim Jumper";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $cuisine_id);
            $test_restaurant->save();


            $result = $test_restaurant->getId();
            $this->assertTrue(is_numeric($result));
        }

        function testGetCuisineId()
        {
            $type = "italian";
            $test_cuisine = new Cuisine($type);
            $test_cuisine->save();

            $name = "Claim Jumper";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $cuisine_id);
            $test_restaurant->save();

            $result = $test_restaurant->getCuisineId();

            $this->assertEquals($cuisine_id, $result);
        }

        function testFind()
        {
            $type = "italian";
            $test_cuisine = new Cuisine($type);
            $test_cuisine->save();
            $cuisine_id = $test_cuisine->getId();

            $name = "Roadhouse";
            $name2 = "Olive Garden";
            $test_restaurant = new Restaurant($name, $cuisine_id);
            $test_restaurant->save();
            $test_restaurant2 = new Restaurant($name2, $cuisine_id);
            $test_restaurant2->save();

            $id = $test_restaurant->getId();
            $result = Restaurant::find($id);

            $this->assertEquals($test_restaurant, $result);
        }

    }


?>
