<?php
session_start();
require_once '../vendor/autoload.php';
require_once '../config/config.php';


/** @var $blade */
$response = $router->dispatch($request);
echo $response->getContent();

//$categories = \App\Model\Category::all();
//
//compact('categories'); // ['categories' => $categories]
//
//echo $blade->make('category/table', compact('categories'))->render();