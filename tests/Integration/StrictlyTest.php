<?php

namespace MikevanDiepen\Strictly\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use MikevanDiepen\Strictly\Exception\StrictlyException;
use MikevanDiepen\Strictly\Console\Input\StrictlyCommand;

class StrictlyTest extends TestCase
{
	public function testStrictly(): void
	{
		// Creating the analyser
		$command = new StrictlyCommand();

		// Executing the parser
		$analyser = new Application('Strictly');
		$analyser->add($command);
		$analyser->setDefaultCommand($command->getName());

		try {
			$analyser->run();
		} catch (StrictlyException $e) {
			// Do nothing.
		}
	}
}