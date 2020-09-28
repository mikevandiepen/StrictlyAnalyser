<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Strategy\Options\Contracts;

/**
 * Interface FunctionLikeInterface.
 *
 * @package MikevanDiepen\Strictly\Analyser\Strategy\Options\Contracts
 */
interface FunctionLikeInterface
{
    /**
     * Whether the parameters of the functional code may be analysed.
     *
     * @param bool $declaredParameters
     *
     * @return void
     */
    public function analyseDeclaredParameters(bool $declaredParameters): void;

    /**
     * Whether the return of the docblock may be analysed.
     *
     * @param bool $hintedParameters
     *
     * @return void
     */
    public function analyseHintedParameters(bool $hintedParameters): void;

    /**
     * Whether the return of the functional code may be analysed.
     *
     * @param bool $declaredReturns
     *
     * @return void
     */
    public function analyseDeclaredReturns(bool $declaredReturns): void;

    /**
     * Whether the return of the docblock may be analysed.
     *
     * @param bool $hintedReturns
     *
     * @return void
     */
    public function analyseHintedReturns(bool $hintedReturns): void;
}