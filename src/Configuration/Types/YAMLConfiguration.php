<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Configuration\Types;

use Symfony\Component\Yaml\Yaml;

/**
 * Class YAMLConfiguration.
 *
 * @package MikevanDiepen\Strictly\Configuration\Types
 */
class YAMLConfiguration extends AbstractConfiguration
{
    /** @var string The file extension for the YAML configuration file. */
    public const FILE_EXTENSION = '.yml';

    /**
     * YAMLConfiguration constructor.
     */
    public function __construct()
    {
        $configuration = Yaml::parseFile(self::STRICTLY_CONFIGURATION_FILE_NAME . self::FILE_EXTENSION) ?? [];

        parent::__construct($configuration);
    }
}