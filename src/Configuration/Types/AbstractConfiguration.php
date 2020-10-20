<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Configuration\Types;

use Symfony\Component\Finder\Finder;

/**
 * Class AbstractConfiguration.
 *
 * @package MikevanDiepen\Strictly\Configuration\Types
 */
abstract class AbstractConfiguration
{
    // Global analysis scopes.
    public const FUNCTIONAL = 'functional';
    public const DOCBLOCK = 'docblock';
    // Parameter analysis scopes.
    public const PARAMETER = 'parameter';
    public const PARAMETER_FUNCTIONAL = 'parameter-functional';
    public const PARAMETER_DOCBLOCK = 'parameter-docblock';
    // Return analysis scopes.
    public const RETURN = 'return';
    public const RETURN_FUNCTIONAL = 'return-functional';
    public const RETURN_DOCBLOCK = 'return-docblock';
    // Property analysis scopes.
    public const PROPERTY = 'property';
    public const PROPERTY_FUNCTIONAL = 'property-functional';
    public const PROPERTY_DOCBLOCK = 'property-docblock';
    // Callable analysis scopes.
    public const CALLABLE = 'callable';
    public const CALLABLE_FUNCTIONAL = 'callable-functional';
    public const CALLABLE_DOCBLOCK = 'callable-docblock';
    // Arrow function analysis scopes.
    public const ARROW_FUNCTION = 'arrow-function';
    public const ARROW_FUNCTION_FUNCTIONAL = 'arrow-function-functional';
    public const ARROW_FUNCTION_DOCBLOCK = 'arrow-function-docblock';
    public const ARROW_FUNCTION_PARAMETER_FUNCTIONAL = 'arrow-function-parameter-functional';
    public const ARROW_FUNCTION_PARAMETER_DOCBLOCK = 'arrow-function-parameter-docblock';
    public const ARROW_FUNCTION_RETURN_FUNCTIONAL = 'arrow-function-return-functional';
    public const ARROW_FUNCTION_RETURN_DOCBLOCK = 'arrow-function-return-docblock';
    // Closure analysis scopes.
    public const CLOSURE = 'closure';
    public const CLOSURE_FUNCTIONAL = 'closure-functional';
    public const CLOSURE_DOCBLOCK = 'closure-docblock';
    public const CLOSURE_PARAMETER_FUNCTIONAL = 'closure-parameter-functional';
    public const CLOSURE_PARAMETER_DOCBLOCK = 'closure-parameter-docblock';
    public const CLOSURE_RETURN_FUNCTIONAL = 'closure-return-functional';
    public const CLOSURE_RETURN_DOCBLOCK = 'closure-return-docblock';
    // Function analysis scopes.
    public const FUNCTION = 'function';
    public const FUNCTION_FUNCTIONAL = 'function-functional';
    public const FUNCTION_DOCBLOCK = 'function-docblock';
    public const FUNCTION_PARAMETER_FUNCTIONAL = 'function-parameter-functional';
    public const FUNCTION_PARAMETER_DOCBLOCK = 'function-parameter-docblock';
    public const FUNCTION_RETURN_FUNCTIONAL = 'function-return-functional';
    public const FUNCTION_RETURN_DOCBLOCK = 'function-return-docblock';
    // Magic method analysis scopes.
    public const MAGIC_METHOD = 'magic-method';
    public const MAGIC_METHOD_FUNCTIONAL = 'magic-method-functional';
    public const MAGIC_METHOD_DOCBLOCK = 'magic-method-docblock';
    public const MAGIC_METHOD_PARAMETER_FUNCTIONAL = 'magic-method-parameter-functional';
    public const MAGIC_METHOD_PARAMETER_DOCBLOCK = 'magic-method-parameter-docblock';
    public const MAGIC_METHOD_RETURN_FUNCTIONAL = 'magic-method-return-functional';
    public const MAGIC_METHOD_RETURN_DOCBLOCK = 'magic-method-return-docblock';
    // Method analysis scopes.
    public const METHOD = 'method';
    public const METHOD_FUNCTIONAL = 'method-functional';
    public const METHOD_DOCBLOCK = 'method-docblock';
    public const METHOD_PARAMETER_FUNCTIONAL = 'method-parameter-functional';
    public const METHOD_PARAMETER_DOCBLOCK = 'method-parameter-docblock';
    public const METHOD_RETURN_FUNCTIONAL = 'method-return-functional';
    public const METHOD_RETURN_DOCBLOCK = 'method-return-docblock';

    /** @var array All the analysers which can be applied. */
    protected const STRICTLY_ANALYSER_OPTIONS = [
        // Global analysis scopes.
        self::FUNCTIONAL,
        self::DOCBLOCK,
        // Parameter analysis scopes.
        self::PARAMETER,
        self::PARAMETER_FUNCTIONAL,
        self::PARAMETER_DOCBLOCK,
        // Return analysis scopes.
        self::RETURN,
        self::RETURN_FUNCTIONAL,
        self::RETURN_DOCBLOCK,
        // Property analysis scopes.
        self::PROPERTY,
        self::PROPERTY_FUNCTIONAL,
        self::PROPERTY_DOCBLOCK,
        // Callable analysis scopes.
        self::CALLABLE,
        self::CALLABLE_FUNCTIONAL,
        self::CALLABLE_DOCBLOCK,
        // Arrow function analysis scopes.
        self::ARROW_FUNCTION,
        self::ARROW_FUNCTION_FUNCTIONAL,
        self::ARROW_FUNCTION_DOCBLOCK,
        self::ARROW_FUNCTION_PARAMETER_FUNCTIONAL,
        self::ARROW_FUNCTION_PARAMETER_DOCBLOCK,
        self::ARROW_FUNCTION_RETURN_FUNCTIONAL,
        self::ARROW_FUNCTION_RETURN_DOCBLOCK,
        // Closure analysis scopes.
        self::CLOSURE,
        self::CLOSURE_FUNCTIONAL,
        self::CLOSURE_DOCBLOCK,
        self::CLOSURE_PARAMETER_FUNCTIONAL,
        self::CLOSURE_PARAMETER_DOCBLOCK,
        self::CLOSURE_RETURN_FUNCTIONAL,
        self::CLOSURE_RETURN_DOCBLOCK,
        // Function analysis scopes.
        self::FUNCTION,
        self::FUNCTION_FUNCTIONAL,
        self::FUNCTION_DOCBLOCK,
        self::FUNCTION_PARAMETER_FUNCTIONAL,
        self::FUNCTION_PARAMETER_DOCBLOCK,
        self::FUNCTION_RETURN_FUNCTIONAL,
        self::FUNCTION_RETURN_DOCBLOCK,
        // Magic method analysis scopes.
        self::MAGIC_METHOD,
        self::MAGIC_METHOD_FUNCTIONAL,
        self::MAGIC_METHOD_DOCBLOCK,
        self::MAGIC_METHOD_PARAMETER_FUNCTIONAL,
        self::MAGIC_METHOD_PARAMETER_DOCBLOCK,
        self::MAGIC_METHOD_RETURN_FUNCTIONAL,
        self::MAGIC_METHOD_RETURN_DOCBLOCK,
        // Method analysis scopes.
        self::METHOD,
        self::METHOD_FUNCTIONAL,
        self::METHOD_DOCBLOCK,
        self::METHOD_PARAMETER_FUNCTIONAL,
        self::METHOD_PARAMETER_DOCBLOCK,
        self::METHOD_RETURN_FUNCTIONAL,
        self::METHOD_RETURN_DOCBLOCK,
    ];

    /** @var string The basename of the configuration file, file type is not of the importance. */
    protected const STRICTLY_CONFIGURATION_FILE_NAME = 'strictly';

    /**
     * The path of the current working directory.
     *
     * @var string|null
     */
    private ?string $currentWorkingDirectory;

    /**
     * The finder which will be used to locate and parse the file.
     *
     * @var \Symfony\Component\Finder\Finder
     */
    private Finder $finder;

    /**
     * The configuration for the analyser.
     *
     * @var array
     */
    private array $configuration;

    /**
     * StrictlyConfiguration constructor.
     *
     * @param array $configuration The contents of the configuration, configuration file type is not of the importance.
     */
    public function __construct(array $configuration = [])
    {
        $this->finder = new Finder();
        $this->configuration = $configuration;
    }

    /**
     * Collecting all the files which should be subject of analysis.
     *
     * @return \Iterator|\Symfony\Component\Finder\SplFileInfo[]
     */
    public function getFiles(): \Traversable
    {
        // Configured directories.
        $includedDirectories = $this->getIncludedDirectories();
        $excludedDirectories = $this->getExcludedDirectories();

        // Whether the directories are configured.
        if (!isset($includedDirectories) && !isset($excludedDirectories)) {
            // Including all the configuration files.
            $this->finder->in($this->currentWorkingDirectory);
        } else {
            // Collecting the files which should be parsed from the configuration.
            if (isset($includedDirectories)) {
                $this->finder->in($includedDirectories);
            }
            // Collecting the files which shouldn't be parsed from the configuration.
            if (isset($excludedDirectories)) {
                $this->finder->exclude($excludedDirectories);
            }
        }
        // Including all the files which end on ".php".
        $this->finder->files()->name('*.php');

        return $this->finder->files()->getIterator();
    }

    /**
     * Collecting all the names of the directories which should be analysed.
     *
     * @return array
     */
    private function getIncludedDirectories(): array
    {
        return $this->configuration['project']['directories']['include'] ?? [];
    }

    /**
     * Collecting all the names of the directories which shouldn't be analysed.
     *
     * @return array
     */
    private function getExcludedDirectories(): array
    {
        return $this->configuration['project']['directories']['exclude'] ?? [];
    }

    /**
     * Collecting all analysers which can be applied in the analysis.
     *
     * @return array
     */
    public function getAnalysers(): array
    {
        // No enabled or disabled analysers have been configured, all analysers will be used.
        $analysers = self::STRICTLY_ANALYSER_OPTIONS;

        // The analyser configuration.
        $enabledAnalysers = $this->getEnabledAnalysers() ?? false;
        $disabledAnalysers = $this->getDisabledAnalysers() ?? false;

        // Whether the all ( * ) scope is set.
        if ($enabledAnalysers && in_array('*', $enabledAnalysers)) {
            $enabledAnalysers = self::STRICTLY_ANALYSER_OPTIONS;
        }
        if ($disabledAnalysers && in_array('*', $disabledAnalysers)) {
            $disabledAnalysers = self::STRICTLY_ANALYSER_OPTIONS;
        }

        // There are enabled and disabled analysers configured.
        // We will return the base analysers plus the enabled analysers minus the disabled analysers.
        if ($enabledAnalysers && $disabledAnalysers) {
            $analysers = self::STRICTLY_ANALYSER_OPTIONS;

            // Adding the enabled analysers to the base analysers.
            foreach ($enabledAnalysers as $enabledAnalyser) {
                $analysers[] = $enabledAnalyser;
            }

            // Removing the disabled analysers from the enabled and base analysers list.
            foreach ($disabledAnalysers as $disabledAnalyser) {
                $analysers = array_diff($analysers, [$disabledAnalyser]);
            }
        }

        // There are no enabled analysers, only disabled analysers.
        // The used analysers will be all the analysers minus the disabled ones.
        if ($disabledAnalysers && !$enabledAnalysers) {
            $analysers = array_diff(self::STRICTLY_ANALYSER_OPTIONS, $disabledAnalysers);
        }

        // There are no enabled analysers, only disabled analysers.
        // The used analysers will be all the analysers minus the disabled ones.
        if ($enabledAnalysers && !$disabledAnalysers) {
            $analysers = $enabledAnalysers;
        }

        return $analysers;
    }

    /**
     * Collecting all the analysers which have been enabled.
     *
     * @return array|null
     */
    private function getEnabledAnalysers(): ?array
    {
        if ($this->hasEnabledAnalysers()) {
            return (array) $this->configuration['project']['analysers']['enabled'];
        }

        return null;
    }

    /**
     * Whether the configuration has enabled analysers.
     *
     * @return bool
     */
    private function hasEnabledAnalysers(): bool
    {
        return (bool) (isset($this->configuration['project']['analysers']['enabled']));
    }

    /**
     * Collecting all the analysers which have been disabled.
     *
     * @return array|null
     */
    private function getDisabledAnalysers(): ?array
    {
        if ($this->hasDisabledAnalysers()) {
            return (array) $this->configuration['project']['analysers']['disabled'];
        }

        return null;
    }

    /**
     * Whether the configuration has disabled analysers..
     *
     * @return bool
     */
    private function hasDisabledAnalysers(): bool
    {
        return (bool) (isset($this->configuration['project']['analysers']['disabled']));
    }
}