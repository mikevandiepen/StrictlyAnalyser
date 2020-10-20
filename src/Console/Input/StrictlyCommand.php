<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Console\Input;

use MikevanDiepen\Strictly\Console\Output\GeneratePrettyOutput;
use MikevanDiepen\Strictly\Console\Output\GenerateSimpleOutput;
use MikevanDiepen\Strictly\Exception\StrictlyException;
use MikevanDiepen\Strictly\Strictly;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class StrictlyCommand.
 *
 * @package MikevanDiepen\Strictly\Console\Input
 */
final class StrictlyCommand extends Command
{
    /** @var string The types of output which can be printed. */
    public const PRINT_RESULTS_PRETTY = GeneratePrettyOutput::class;
    public const PRINT_RESULTS_SIMPLE = GenerateSimpleOutput::class;

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
        'name' => 'output',
        'shortcut' => 'o',
        'mode' => InputOption::VALUE_REQUIRED,
        'description' => 'How the output should be formatted.',
        'default' => 'abstract',
    ];

    /**
     * Configuring the command.
     *
     * @return void
     */
    protected function configure(): void
    {
        $this->setDescription('Analysing the strictness of your project.')
             ->setHelp('This command allows you to analyse your project and assert the strictness of your code.')
             ->addOption($this->outputOption['name'], $this->outputOption['shortcut'], $this->outputOption['mode'], $this->outputOption['description'], $this->outputOption['default'],);
    }

    /**
     * Executing the strictly command.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int
     * @throws StrictlyException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Running the analyser.
        $strictly = new Strictly();
        $strictly->analyse(self::PRINT_RESULTS_PRETTY);

        return 1;
    }
}
