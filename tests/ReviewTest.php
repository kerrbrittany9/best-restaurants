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
      function testGetAll()
      {
          $title = "Lovely Venue";
          $summary = "i took my grandma and she had a ball";
          $test_review = new Review($title, $summary);
          $test_review->save();
          $title2 = "i loved the food";
          $summary2 = "it was the best meal of my life";
          $test_review2 = new Review($title2, $summary2);
          $test_review2->save();

          $result = Review::getAll();

          $this->assertEquals([$test_review, $test_review2], $result);
      }

    }

?>
