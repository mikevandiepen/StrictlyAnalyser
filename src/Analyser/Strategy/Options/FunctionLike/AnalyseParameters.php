<?php

declare(strict_types=1);

namespace MikevanDiepen\Strictly\Analyser\Strategy\Options\FunctionLike;

use MikevanDiepen\Strictly\Analyser\Strategy\AbstractAnalyser;
use MikevanDiepen\Strictly\Analyser\Strategy\Options\Contracts\AnalyserInterface;
use MikevanDiepen\Strictly\Analyser\Strategy\Options\AnalyserTraits\AnalyserTrait;

/**
 * Class AnalyseParameters.
 *
 * @package MikevanDiepen\Strictly\Analyser\Strategy\Options\FunctionNode
 */
final class AnalyseParameters extends AbstractAnalyser implements AnalyserInterface
{
    use AnalyserTrait;

    /**
     * Analysing only the declared types.
     *
     * @return void
     */
    public function onlyDeclared(): void
    {
        if (!$this->declaredTypeIsset()) {
            # Missing declared parameter type.
        }
    }

    /**
     * Analysing only the hinted types.
     *
     * @return void
     */
    public function onlyHinted(): void
    {
        if (!$this->hintedTypeIsset()) {
            # Missing hinted parameter type.
        }
    }

    /**
     * Analysing both the declared and hinted types.
     *
     * @return void
     */
    public function bothDeclaredAndHinted(): void
    {
        if ($this->declaredTypeIsset() && $this->hintedTypeIsset()) {
            if (!$this->typesMatch()) {
                if ($this->getMissingDeclaredTypes() > 0) {
                    # Missing declared parameter type.
                }

                if ($this->getMissingHintedTypes() > 0) {
                    # Missing hinted parameter type.
                }
            }
        } elseif ($this->declaredTypeIsset() && !$this->hintedTypeIsset()) {
            # Missing hinted parameter type.
        } elseif (!$this->declaredTypeIsset() && $this->hintedTypeIsset()) {
            # Missing declared parameter type.
        } else {
            # Missing declared parameter type.
            # Missing hinted parameter type.
        }
    }
}