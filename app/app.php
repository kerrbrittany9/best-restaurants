<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Restaurant.php";
    require_once __DIR__."/../src/Cuisine.php";


    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=dining';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    $app->get("/", function() use ($app) {
      return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    $app->get("/restaurants", function() use ($app) {
      return $app['twig']->render('restaurants.html.twig', array('restaurants' => Restaurant::getAll()));
    });

    $app->get("/cuisine/{id}", function($id) use ($app) {
      $cuisine = Cuisine::find($id);
      return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });

    $app->post("/cuisine", function() use ($app) {
      $cuisine = new Cuisine($_POST['type']);
      $cuisine->save();
      return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    $app->post("/restaurants", function() use ($app) {
      $name = $_POST['input_name'];
      $cuisine_id = $_POST['cuisine_id'];
      $description = $_POST['description'];
      $restaurant = new Restaurant($name, $cuisine_id, $description);
      $restaurant->save();
      $cuisine = Cuisine::find($cuisine_id);
      return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });

    $app->post("/search", function() use ($app) {
      $type = $_POST['search'];
      $cuisines = Cuisine::getAll();
      $result;
      foreach($cuisines as $item) {
        if ($item->getType() == $type) {
          $result = $item;
        }
      }
      $items = $result->getRestaurants();
      return $app['twig']->render('search.html.twig', array('restaurants' => $items));
    });

    $app->get("/cuisines/{id}/edit", function($id) use ($app) {
    $cuisine = Cuisine::find($id);
    return $app['twig']->render('cuisine_edit.html.twig', array('cuisine' => $cuisine));
    });

  $app->patch("/cuisines/{id}", function($id) use ($app) {
    $name = $_POST['name'];
    $cuisine = Cuisine::find($id);
    $cuisine->update($name);
    return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    var_dump($name);
    });

    $app->post("/delete_cuisines", function() use ($app) {
    Cuisine::deleteAll();
    return $app['twig']->render('index.html.twig');
    });

  $app->delete("/cuisines/{id}", function($id) use ($app) {
      $cuisine = Cuisine::find($id);
      $cuisine->delete();
      return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });



    return $app;

?>
