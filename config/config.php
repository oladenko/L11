<?php
/**
 *
 * Dotenv config
 *
 */
$repository = Dotenv\Repository\RepositoryBuilder::createWithNoAdapters()
    ->addAdapter(Dotenv\Repository\Adapter\EnvConstAdapter::class)
    ->addWriter(Dotenv\Repository\Adapter\PutenvAdapter::class)
    ->immutable()
    ->make();

$dotenv = Dotenv\Dotenv::create($repository, realpath('../'));
$dotenv->load();

/**
 *
 * Eloquent config
 *
 */

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => getenv('DATABASE_DRIVER'),
    'host'      => getenv('DATABASE_HOST'),
    'database'  => getenv('DATABASE_DB'),
    'username'  => getenv('DATABASE_USERNAME'),
    'password'  => getenv('DATABASE_PASSWORD'),
    'charset'   => getenv('DATABASE_CHARSET'),
    'collation' => getenv('DATABASE_COLLATION'),
    'prefix'    => getenv('DATABASE_PREFIX'),
]);

// Set the event dispatcher used by Eloquent models... (optional)
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

$capsule->setEventDispatcher(new Dispatcher(new Container));
$capsule->setAsGlobal();
$capsule->bootEloquent();

\Illuminate\Pagination\Paginator::currentPageResolver(fn() => $_GET['page'] ?? 1);

/**
 *
 * Blade config
 *
 */

$engineResolver = new \Illuminate\View\Engines\EngineResolver();

$fileSystem = new \Illuminate\Filesystem\Filesystem();

$fileViewFinder = new \Illuminate\View\FileViewFinder(
    $fileSystem, ['../resources/views']
);

$compiler = new \Illuminate\View\Compilers\BladeCompiler($fileSystem, '../resources/cache');

$engineResolver->register('blade', function () use ($compiler) {
    return new \Illuminate\View\Engines\CompilerEngine($compiler);
});

$container = new \Illuminate\Container\Container();
$dispatcher = new \Illuminate\Events\Dispatcher($container);

$blade = new \Illuminate\View\Factory(
    $engineResolver,
    $fileViewFinder,
    $dispatcher
);

function view($view, $data = [], $mergeData = [])
{
    global $blade;

    return new \Illuminate\Http\Response(
        $blade->make($view, $data, $mergeData)->render()
    );
}

/**
 *
 * Validator config
 *
 */

use Illuminate\Validation\DatabasePresenceVerifier;


$loader = new Illuminate\Translation\FileLoader($fileSystem, realpath('../resources/lang'));
$translator = new \Illuminate\Translation\Translator($loader, 'en');
$validator = new Illuminate\Validation\Factory($translator);
global $capsule;
$databasePresenceVerifier = new DatabasePresenceVerifier($capsule->getDatabaseManager());
$validator->setPresenceVerifier($databasePresenceVerifier);

function validator()
{
    global $validator;

    return $validator;
}

/**
 *
 * Router config
 *
 */

//use Illuminate\Events\Dispatcher;

$request = \Illuminate\Http\Request::createFromGlobals();

function request() {
    global $request;

    return $request;
}

$dispatcher = new Dispatcher();
$container = new \Illuminate\Container\Container();
$router = new \Illuminate\Routing\Router($dispatcher, $container);
function router() {
    global $router;

    return $router;
}

$router->get('/', function(){

});

$router->get('/category/list', '\App\Controller\CategoryController@index');

$router->get('/category/create', '\App\Controller\CategoryController@create');
$router->post('/category/create', '\App\Controller\CategoryController@store');

$router->get('/category/{id}/edit', '\App\Controller\CategoryController@edit');
$router->post('/category/{id}/edit', '\App\Controller\CategoryController@update');

$router->get('/category/{id}/destroy', '\App\Controller\CategoryController@destroy');

// Request -> Application -> Response
// HTTP Request -> Server -> HTTP Response
$router->get('/tag/list', '\App\Controller\TagController@index');

$router->get('/tag/create', '\App\Controller\TagController@create');
$router->post('/tag/create', '\App\Controller\TagController@store');

$router->get('/tag/{id}/edit', '\App\Controller\TagController@edit');
$router->post('/tag/{id}/edit', '\App\Controller\TagController@update');

$router->get('/tag/{id}/destroy', '\App\Controller\TagController@destroy');

//Post


$router->get('/post/list', '\App\Controller\PostController@index');

$router->get('/post/create', '\App\Controller\PostController@create');
$router->post('/post/create', '\App\Controller\PostController@store');

$router->get('/post/{id}/edit', '\App\Controller\PostController@edit');
$router->post('/post/{id}/edit', '\App\Controller\PostController@update');

$router->get('/post/{id}/destroy', '\App\Controller\PostController@destroy');