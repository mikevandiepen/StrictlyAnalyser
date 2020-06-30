<?php

namespace Mikevandiepen\Strictly\Analyser\Strategy\Options\Contracts;

/**
 * Interface AnalyserInterface.
 *
 * @package Mikevandiepen\Strictly\Analyser\Strategy\Options\Contracts
 */
interface AnalyserInterface
{
    /**
     * Analysing only the declared types.
     *
     * @return void
     */
    public function onlyDeclared(): void;

    /**
     * Analysing only the hinted types.
     *
     * @return void
     */
    public function onlyHinted(): void;

    /**
     * Analysing both the declared and hinted types.
     *
     * @return void
     */
    public function bothDeclaredAndHinted(): void;
}