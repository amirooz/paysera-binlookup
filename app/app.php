<?php

namespace App;

require_once('task.php');


$app = new Task();
$app->index($argv[1]);
