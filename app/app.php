<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Cuisine.php";
    require_once __DIR__."/../src/Restaurant.php";


    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=local_food';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
  ));

    $app->get("/", function() use ($app) {
    return $app['twig']->render('index.html.twig');
  });

    $app->post("/restaurant", function() use ($app) {
        $input_name = $_POST['name'];
        $input_address = $_POST['street'];
        $input_city = $_POST['city'];
        $input_state = $_POST['state'];
        $input_zip = $_POST['zip'];
        $input_cuisine_id = $_POST['category'];
        $new_restaurant = new Restaurant($input_name, $input_address, $input_city, $input_state, $input_zip, $input_cuisine_id);
        $new_restaurant->save();
        return $app['twig']->render('restaurant.html.twig', array('result' => $new_restaurant, "cuisine" => Cuisine::find($input_cuisine_id)));
    });

    $app->post("/results", function() use ($app) {
        $search_result = $_POST['select_cuisine'];
        $result = Restaurant::find($search_result);
        return $app['twig']->render('results.html.twig', array('output' => $result,"cuisine" => Cuisine::find($search_result)));
    });

    return $app;
 ?>
