<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Strategy\Options\AnalyserTraits;

/**
 * Trait FunctionLikeTrait.
 *
 * @package MikevanDiepen\Strictly\Analyser\Strategy\Options\AnalyserTraits
 */
trait FunctionLikeTrait
{
    /**
     * Whether the declared parameters may be analysed.
     * This property can be accessed through:
     * @method analyseDeclaredParameters(bool $declaredParameters): void
     *
     * @var bool
     */
    protected bool $declaredParameters = false;

    /**
     * Whether the hinted parameters may be analysed.
     * This property can be accessed through:
     * @method analyseHintedParameters(bool $hintedParameters): void
     *
     * @var bool
     */
    protected bool $hintedParameters = false;

    /**
     * Whether the declared returns may be analysed.
     * This property can be accessed through:
     * @method analyseDeclaredReturns(bool $declaredReturns): void
     *
     * @var bool
     */
    protected bool $declaredReturns = false;

    /**
     * Whether the hinted returns may be analysed.
     * This property can be accessed through:
     * @method analyseHintedReturns(bool $hintedReturns): void
     *
     * @var bool
     */
    protected bool $hintedReturns = false;

    /**
     * Whether the declared parameters may be analysed.
     *
     * @param bool $declaredParameters
     *
     * @return void
     */
    public function analyseDeclaredParameters(bool $declaredParameters): void
    {
        $this->declaredParameters = $declaredParameters;
    }

    /**
     * Whether the hinted parameters may be analysed.
     *
     * @param bool $hintedParameters
     *
     * @return void
     */
    public function analyseHintedParameters(bool $hintedParameters): void
    {
        $this->hintedParameters = $hintedParameters;
    }

    /**
     * Whether the declared returns may be analysed.
     *
     * @param bool $declaredReturns
     *
     * @return void
     */
    public function analyseDeclaredReturns(bool $declaredReturns): void
    {
        $this->declaredParameters = $declaredReturns;
    }

    /**
     * Whether the hinted returns may be analysed.
     *
     * @param bool $hintedReturns
     *
     * @return void
     */
    public function analyseHintedReturns(bool $hintedReturns): void
    {
        $this->hintedReturns = $hintedReturns;
    }
}