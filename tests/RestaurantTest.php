<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */


    require_once "src/Restaurant.php";

    $server = 'mysql:host=localhost:8889;dbname=dining_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class RestaurantTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Restaurant::deleteAll();
        }

        function testSave()
        {
            $name = "Olive Garden";
            $test_restaurant = new Restaurant($name);

            $executed = $test_restaurant->save();

            $this->assertTrue($executed, "Item was not saved to database");

        }

        function testGetAll()
        {
            $name = "Roadhouse";
            $name2 = "Olive Garden";

            $test_restaurant = new Restaurant($name);
            $test_restaurant->save();
            $test_restaurant2 = new Restaurant($name2);
            $test_restaurant2->save();

            $result = Restaurant::getAll();

            $this->assertEquals([$test_restaurant, $test_restaurant2], $result);
        }

        function testDeleteAll()
        {
            $name = "Roadhouse";
            $name2 = "Olive Garden";

            $test_restaurant = new Restaurant($name);
            $test_restaurant->save();
            $test_restaurant2 = new Restaurant($name2);
            $test_restaurant2->save();

            Restaurant::deleteAll();
            $result = Restaurant::getAll();

            $this->assertEquals([], $result);

        }

    }


?>
