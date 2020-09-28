<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Configuration;

/**
 * Class StrictlyConfiguration.
 *
 * @package MikevanDiepen\Strictly\Configuration
 */
final class StrictlyConfiguration
{
    /**
     * StrictlyConfiguration constructor.
     */
    public function __construct()
    {
        // Determining the file type for the configuration.
    }

    /**
     * Whether the current configuration file is of type XML.
     *
     * @return bool
     */
    private function xmlConfiguration(): bool
    {
        return (bool) false;
    }
}
