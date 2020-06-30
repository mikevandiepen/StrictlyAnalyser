<?php

namespace Mikevandiepen\Strictly\Configuration\Types;

/**
 * Class XMLConfiguration.
 *
 * @package Mikevandiepen\Strictly\Configuration\Types
 */
class XMLConfiguration extends AbstractConfiguration
{
    /** @var string The file extension for the YAML configuration file. */
    public const FILE_EXTENSION = '.xml';

    /**
     * YAMLConfiguration constructor.
     */
    public function __construct()
    {
        $configuration = [/** TODO: Parse the XML configuration */] ?? [];

        parent::__construct($configuration);
    }
}