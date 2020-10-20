<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Configuration;

use MikevanDiepen\Strictly\Configuration\Types\AbstractConfiguration;
use MikevanDiepen\Strictly\Configuration\Types\JSONConfiguration;
use MikevanDiepen\Strictly\Configuration\Types\XMLConfiguration;
use MikevanDiepen\Strictly\Configuration\Types\YAMLConfiguration;
use MikevanDiepen\Strictly\Exception\StrictlyException;

/**
 * Class StrictlyConfiguration.
 *
 * @package MikevanDiepen\Strictly\Configuration
 */
final class StrictlyConfiguration
{
    public const JSON = JSONConfiguration::class;
    public const XML = XMLConfiguration::class;
    public const YAML = YAMLConfiguration::class;

    /**
     * The configuration.
     *
     * @var \MikevanDiepen\Strictly\Configuration\Types\AbstractConfiguration
     */
    private AbstractConfiguration $configuration;

    /**
     * StrictlyConfiguration constructor.
     *
     * @param string $config
     *
     * @throws \MikevanDiepen\Strictly\Exception\StrictlyException
     */
    public function __construct(string $config)
    {
        if (!in_array($config, [
            self::JSON,
            self::XML,
            self::YAML
        ])) {
            throw new StrictlyException('Invalid configuration file format.');
        }

        $this->configuration = new $config();
    }

    /**
     * Parsing the configuration, preparing the subject and returning the object.
     *
     * @return \MikevanDiepen\Strictly\Configuration\Types\AbstractConfiguration
     */
    public function run(): AbstractConfiguration
    {
        return $this->configuration;
    }
}
