<?php

declare(strict_types = 1);

use MikevanDiepen\Strictly\Console\Input\StrictlyCommand;
use Symfony\Component\Console\Application;

// Including the composer autoloader
if (file_exists(__DIR__ . '/../../../autoload.php')) {
    require __DIR__ . '/../../../autoload.php';
} else {
    require_once __DIR__ . '/../vendor/autoload.php';
}

// Creating the analyser
$command = new StrictlyCommand();

// Executing the parser
$analyser = new Application('Strictly');
$analyser->add($command);
$analyser->setDefaultCommand($command->getName());

try {
    $analyser->run();
} catch (Exception $e) {
    // Do nothing.
}