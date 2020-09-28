<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Configuration\Types;

/**
 * Class JSONConfiguration.
 *
 * @package MikevanDiepen\Strictly\Configuration\Types
 */
class JSONConfiguration extends AbstractConfiguration
{
    /** @var string The file extension for the YAML configuration file. */
    public const FILE_EXTENSION = '.json';

    /**
     * YAMLConfiguration constructor.
     */
    public function __construct()
    {
        $configuration = [/** TODO: Parse the JSON configuration */] ?? [];

        parent::__construct($configuration);
    }
}