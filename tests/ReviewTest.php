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

    class ReviewTest extends PHPUnit_Framework_TestCase
    {
      function testSave()
      {
          $title = "hated it";
          $summary = "it was the worst";
          $test_review = new Review($title, $summary);


          $executed = $test_review->save();

          $this->assertTrue($executed, "Review was not saved to database");

      }

    }

?>
