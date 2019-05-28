<?php

require 'vendor/autoload.php';

use \Meteopark\FileUpload;

$t = new FileUpload();

echo $t->test();