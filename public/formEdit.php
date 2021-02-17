<?php
require_once '../vendor/autoload.php';
require_once '../config/eloquent.php';
require_once '../config/blade.php';

/** @var $blade */

if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
    $category = \App\Model\Category::find($_POST['id']);
    $category->title = $_POST['title'];
    $category->slug = $_POST['slug'];
    $category->save();
    header('Location: index.php');
}
$category = \App\Model\Category::find($_GET['id']);

echo $blade->make('category/formEdit', compact('category'))->render();