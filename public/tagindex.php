<?php
require_once '../vendor/autoload.php';
require_once '../config/eloquent.php';
require_once '../config/blade.php';

/** @var $blade */

$tags = \App\Model\Tag::all();

//compact('categories'); // ['categories' => $categories]

echo $blade->make('tag/table', compact('tags'))->render();