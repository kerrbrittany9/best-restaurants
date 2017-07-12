<<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";

    $server = 'mysql:host=localhost:8889;dbname=dining_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CuisineTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Cuisine::deleteAll();
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

        function deleteAll()
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




    }


?>
