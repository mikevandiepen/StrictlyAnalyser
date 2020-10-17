<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly;

use MikevanDiepen\Strictly\Analyser\Lexer\Lexer;
use MikevanDiepen\Strictly\Coverage\AnalysisResults;
use MikevanDiepen\Strictly\Analyser\Strategy\Director;
use MikevanDiepen\Strictly\Console\Input\StrictlyCommand;
use MikevanDiepen\Strictly\Configuration\StrictlyConfiguration;

/**
 * Class Strictly.
 *
 * @package MikevanDiepen\Strictly
 */
final class Strictly
{
	/**
	 * Running the main analysis process for strictly.
	 *
	 * @param string $output
	 * @param string $configType
	 *
	 * @return void
	 * @throws \MikevanDiepen\Strictly\Exception\StrictlyException
	 */
	public function analyse(
		string $output = StrictlyCommand::PRINT_RESULTS_PRETTY,
		string $configType = StrictlyConfiguration::YAML
	): void
	{
		$configuration = (new StrictlyConfiguration($configType))->run();

		// Collecting all the files which need to be parsed.
		$projectFiles = $configuration->getFiles();
		// Collecting the rules configured by the user.
		$analyserRules = $configuration->getAnalysers();

		// Parsing through each file which "may" be parsed.
		foreach ($projectFiles as $projectFile) {
			// Parsing the file and building a "mock" which will be used for the analysis process.
			$file = new Lexer($projectFile);

			// Running the analysis and applying the filters configured by the user.
			$director = new Director($file->getFile());
			$director->direct($analyserRules);

			// Analysing the results and building a metric report.
			$analysisResults = new AnalysisResults(
				$director->getAnalysisResults()
			);

			// Building a coverage report.


			// Building a report which can be prompted to the user in the console.

		}
	}
}