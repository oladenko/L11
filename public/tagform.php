<?php
require_once '../vendor/autoload.php';
require_once '../config/eloquent.php';
require_once '../config/blade.php';

/** @var $blade */

if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
    var_dump($_POST);
    $tag = new \App\Model\Tag();
    $tag->title = $_POST['title'];
    $tag->slug = $_POST['slug'];
    $tag->save();
    header('Location: tagindex.php');
}

echo $blade->make('tag/form')->render();