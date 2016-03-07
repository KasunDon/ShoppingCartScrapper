<?php

require 'vendor/autoload.php';

use GetOptionKit\OptionCollection;
use GetOptionKit\OptionParser;
use GetOptionKit\OptionPrinter\ConsoleOptionPrinter;

$specs = new OptionCollection;
$specs->add('u|url:', 'Specify shopping cart url to be scrapped.')
        ->isa('String');

$parser = new OptionParser($specs);
$inputs = $parser->parse($argv);


if (empty($inputs->url)) {
    $printer = new ConsoleOptionPrinter();
    echo $printer->render($specs);
    exit();
}

echo SainsburysScrapper::scrape($inputs->url);

