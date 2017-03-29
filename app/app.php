<?php
    date_default_timezone_set(‘America/Los_Angeles’);
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
    return $app;
 ?>
