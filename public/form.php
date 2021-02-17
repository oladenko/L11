<?php
require_once '../vendor/autoload.php';
require_once '../config/eloquent.php';
require_once '../config/blade.php';

/** @var $blade */

if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
    var_dump($_POST);
    $category = new \App\Model\Category();
    $category->title = $_POST['title'];
    $category->slug = $_POST['slug'];
    $category->save();
    header('Location: index.php');
}

echo $blade->make('category/form')->render();