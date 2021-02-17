<?php

require_once '../vendor/autoload.php';
require_once '../config/eloquent.php';
require_once '../config/blade.php';

/** @var $blade */

if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
    $tag = \App\Model\Tag::find($_POST['id']);
    $tag->title = $_POST['title'];
    $tag->slug = $_POST['slug'];
    $tag->save();
    header('Location: tagindex.php');
}
$tag = \App\Model\Tag::find($_GET['id']);

echo $blade->make('tag/formEdit', compact('tag'))->render();