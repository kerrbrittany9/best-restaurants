<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";
    require_once "src/Restaurant.php";
    require_once "src/Review.php";

    $server = 'mysql:host=localhost:8889;dbname=dining_test';
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

        function testGetType()
        {
            $type = "thai food";
            $test_cuisine = new Cuisine($type);

            $result = $test_cuisine->getType();

            $this->assertEquals($type, $result);

        }

        function testSave()
        {
            $type = "thai food";

            $test_cuisine = new Cuisine($type);

            $executed = $test_cuisine->save();

            $this->assertTrue($executed, "Cuisine was not saved to database");
        }

        function testGetAll()
        {
            $type = "thai food";
            $type2 = "mexican food";
            $test_cuisine = new Cuisine($type);
            $test_cuisine->save();
            $test_cuisine2 = new Cuisine($type2);
            $test_cuisine2->save();

            $result = Cuisine::getAll();

            $this->assertEquals([$test_cuisine, $test_cuisine2], $result);

        }

        function testDeleteAll()
        {
            $type = "thai food";
            $type2 = "mexican food";
            $test_cuisine = new Cuisine($type);
            $test_cuisine->save();
            $test_cuisine2 = new Cuisine($type2);
            $test_cuisine2->save();

            Cuisine::deleteAll();

            $result = Cuisine::getAll();

            $this->assertEquals([], $result);

        }
        function testFind()
        {

            $type = "thai food";
            $type2 = "mexican food";
            $test_cuisine = new Cuisine($type);
            $test_cuisine->save();
            $test_cuisine2 = new Cuisine($type2);
            $test_cuisine2->save();
            $id = $test_cuisine->getId();

            $result = Cuisine::find($id);

            $this->assertEquals($test_cuisine, $result);
        }

        function testGetRestaurants()
        {
            $type = "mexican food";
            $test_cuisine = new Cuisine($type);
            $test_cuisine->save();
            $cuisine_id = $test_cuisine->getId();

            $name = "Por que no?";
            $description = "cool and hip tacos";
            $name2 = "Taqueria";
            $description2 = "autentico";
            $test_restaurant = new Restaurant($name, $cuisine_id, $description);
            $test_restaurant->save();
            $test_restaurant2 = new Restaurant($name2, $cuisine_id, $description2);
            $test_restaurant2->save();

            $result = $test_cuisine->getRestaurants();

            $this->assertEquals([$test_restaurant, $test_restaurant2], $result);

        }

        function testUpdate()
        {
            $type = "street food";
            $test_cuisine = new Cuisine($type);
            $test_cuisine->save();

            $new_type = "deli food";

            $test_cuisine->update($new_type);

            $this->assertEquals("deli food", $test_cuisine->getType());
        }

        function testDelete()
        {
            $type = "Scandonavian";
            $test_cuisine = new Cuisine($type);
            $test_cuisine->save();

            $type = "Hawaian";
            $test_cuisine2 = new Cuisine($type);
            $test_cuisine2->save();

            $test_cuisine->delete();

            $this->assertEquals([$test_cuisine2], Cuisine::getAll());
        }

        function testDeleteCuisineRestaurants()
        {
            $type = "Mexican";
            $test_cuisine = new Cuisine($type);
            $test_cuisine->save();

            $name = "Outback";
            $description = "steaks n shit";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $cuisine_id, $description);
            $test_restaurant->save();

            $test_cuisine->delete();

            $this->assertEquals([], Restaurant::getAll());
        }

    }


?>
