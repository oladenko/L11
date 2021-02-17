<?php

require_once '../vendor/autoload.php';
require_once '../config/eloquent.php';
require_once '../config/blade.php';

/** @var $blade */
$category = \App\Model\Category::find($_GET['id']);
$category->delete();
header('Location:index.php');
//$categories = \App\Model\Category::all();

//compact('categories'); // ['categories' => $categories]

//echo $blade->make('category/table', compact('categories'))->render();