<?php

declare(strict_types=1);

namespace MikevanDiepen\Strictly\Console\Input;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use MikevanDiepen\Strictly\Analyser\Lexer\Lexer;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use MikevanDiepen\Strictly\Analyser\Strategy\Director;
use MikevanDiepen\Strictly\Configuration\StrictlyConfiguration;

/**
 * Class StrictlyCommand.
 *
 * @package MikevanDiepen\Strictly\Console\Input
 */
final class StrictlyCommand extends Command
{
    /**
     * How the analysis command is run.
     * (php bin/strictly) in this case.
     *
     * @var string
     */
    protected static $defaultName = 'strictly';

    /**
     * The configuration for the format option.
     *
     * @var array
     */
    private array $outputOption = [
        'name'          => 'output',
        'shortcut'      => 'o',
        'mode'          => InputOption::VALUE_REQUIRED,
        'description'   => 'How the output should be formatted.',
        'default'       => 'abstract',
    ];

    /**
     * Configuring the command.
     *
     * @return void
     */
    protected function configure(): void
    {
        $this
            ->setDescription('Analysing the strictness of your project.')
            ->setHelp('This command allows you to analyse your project and assert the strictness of your code.')
            ->addOption(
                $this->outputOption['name'],
                $this->outputOption['shortcut'],
                $this->outputOption['mode'],
                $this->outputOption['description'],
                $this->outputOption['default'],
            );
    }

	/**
	 * Executing the strictly command.
	 *
	 * @param InputInterface  $input
	 * @param OutputInterface $output
	 *
	 * @return int
	 * @throws \Exception
	 */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
		$configuration = (new StrictlyConfiguration(StrictlyConfiguration::YAML))->run();

		$projectFiles	= $configuration->getFiles();
		$analyserRules	= $configuration->getAnalysers();

		$projectIssueCount = 0;
		foreach ($projectFiles as $projectFile) {
			$file = new Lexer($projectFile);

			$analyserStrategy = new Director($file->getFile());
			$analyserStrategy->direct($analyserRules);

			$output->writeln('Analysed file: [' . $file->getFile()->getFileName(). '] - File size: ' . $file->getFile()->getFileSize());
		}

		return 1;
    }
}
