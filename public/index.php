<?php
session_start();
require_once '../vendor/autoload.php';
require_once '../config/eloquent.php';
require_once '../config/blade.php';
require_once '../config/validator.php';
require_once '../config/router.php';

/** @var $blade */
$response = $router->dispatch($request);
echo $response->getContent();

//$categories = \App\Model\Category::all();
//
//compact('categories'); // ['categories' => $categories]
//
//echo $blade->make('category/table', compact('categories'))->render();