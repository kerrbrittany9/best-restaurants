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





    }


?>
