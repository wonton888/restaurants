<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Restaurant.php";
    require_once __DIR__."/../src/Cuisine.php";

    $app = new Silex\Application();

    // $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=restaurant_reviews';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {

        return $app['twig']->render('index.html.twig',
        array('cuisines' => Cuisine::getAll()));
    });

    $app->post("/cuisines", function() use ($app) {
        // $input = $_POST['type'];
        // $clean_input = preg_quote($input, "'");
        // // "/[-[\]{}()*+?.,\\^$|#']/"
        // echo $clean_input;
        $cuisine = new Cuisine(preg_quote($_POST['type'], "'"));
        $cuisine->save();
        return $app['twig']->render('index.html.twig',
        array('cuisines' => Cuisine::getAll()));
    });

    $app->post("/delete_cuisines", function() use ($app) {
        Cuisine::deleteAll();
        return $app['twig']->render('delete_cuisines.html.twig');
    });

    //
    $app->get("/cuisines/{id}", function($id) use ($app) {
        $cuisine = Cuisine::find($id);

        return $app['twig']->render('cuisine.html.twig',
        array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
//        return $app['twig']->render('cuisine.html.twig',
//        array('cuisine' => $cuisine));
    });

    $app->post("/restaurants", function() use ($app){
        $cuisine_id = $_POST['cuisine_id'];
        $name = preg_quote($_POST['name'], "'");
        $description = preg_quote($_POST['description'], "'");
        $restaurant = new Restaurant($description, $id = null, $cuisine_id, $name);
        $restaurant->save();
        $cuisine = Cuisine::find($cuisine_id);
        return $app['twig']->render('cuisine.html.twig',
        array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
        // return $app['twig']->render('category.html.twig',
        // array('category' => $category, 'tasks' => $category->getTasks()));

    });

    $app->patch("/cuisines/{id}", function($id) use ($app) {
        $type = $_POST['type'];
        $cuisine = Cuisine::find($id);
        $cuisine->update($type);
        return $app['twig']->render('cuisine_edit.html.twig',
        array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });

    $app->delete("/cuisines/{id}", function($id) use ($app) {
        $cuisine = Cuisine::find($id);
        $cuisine->delete();
        return $app['twig']->render('index.html.twig',
        array('cuisines' => Cuisine::getAll()));
    });

    $app->get("/cuisines/{id}/edit", function($id) use ($app) {
        $cuisine = Cuisine::find($id);
        return $app['twig']->render('cuisine_edit.html.twig',
        array('cuisine' => $cuisine));
    });


    // NEED HTML
    $app->post("/delete_restaurants", function() use ($app) {
        Restaurant::deleteAll();
        return $app['twig']->render('delete_restaurants.html.twig');
    });

    // $app->get("/restaurants", function() use ($app) {
    //     return $app['twig']->render('restaurants.html.twig',
    //     array('restaurants' => Restaurant::getAll()));
    // });

    // displays all restaurants, form for adding or deleting restaurants

    return $app;

?>
