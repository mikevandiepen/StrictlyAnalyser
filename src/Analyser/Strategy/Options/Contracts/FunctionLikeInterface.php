<?php

namespace Mikevandiepen\Strictly\Analyser\Strategy\Options\Contracts;

/**
 * Interface FunctionLikeInterface.
 *
 * @package Mikevandiepen\Strictly\Analyser\Strategy\Options\Contracts
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
    public function analysedeclaredParameters(bool $declaredParameters): void;

    /**
     * Whether the return of the docblock may be analysed.
     *
     * @param bool $hintedParameters
     *
     * @return void
     */
    public function analysehintedParameters(bool $hintedParameters): void;

    /**
     * Whether the return of the functional code may be analysed.
     *
     * @param bool $declaredReturns
     *
     * @return void
     */
    public function analysedeclaredReturns(bool $declaredReturns): void;
    /**
     * Whether the return of the docblock may be analysed.
     *
     * @param bool $hintedReturns
     *
     * @return void
     */
    public function analysehintedReturns(bool $hintedReturns): void;
}