#!/usr/bin/env php
<?php
require __DIR__ . '/vendor/autoload.php';

use App\AnalyzeCommand;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new AnalyzeCommand());
$application->run();