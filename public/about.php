<?php

require_once '../vendor/autoload.php';
require_once '../config/blade.php';

/** @var $blade */

echo $blade->make('pages/about')->render();