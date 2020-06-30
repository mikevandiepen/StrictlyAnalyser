<?php

namespace Mikevandiepen\Strictly\Analyser\Strategy\Options;

use Mikevandiepen\Strictly\Analyser\Strategy\AbstractAnalyser;
use Mikevandiepen\Strictly\Analyser\Strategy\Options\FunctionLike\AnalyseReturn;
use Mikevandiepen\Strictly\Analyser\Strategy\Options\Contracts\AnalyserInterface;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Contracts\FunctionLikeNode;
use Mikevandiepen\Strictly\Analyser\Strategy\Options\FunctionLike\AnalyseParameters;
use Mikevandiepen\Strictly\Analyser\Strategy\Options\Contracts\FunctionLikeInterface;
use Mikevandiepen\Strictly\Analyser\Strategy\Options\AnalyserTraits\FunctionLikeTrait;

/**
 * Class AnalyseMethod.
 *
 * @package Mikevandiepen\Strictly\Analyser\Strategy\Options
 */
final class AnalyseMethod extends AbstractAnalyser implements AnalyserInterface, FunctionLikeInterface
{
    use FunctionLikeTrait;

    /**
     * Analysing only the declared types.
     *
     * @return void
     */
    public function onlyDeclared(): void
    {
        if ($this->node instanceof FunctionLikeNode) {
            // Analysing parameters.
            foreach ($this->node->getParameters() as $parameter) {
                $analyseParameter = new AnalyseParameters($parameter);

                if ($this->declaredParameters) {
                    $analyseParameter->onlyDeclared();
                }
            }

            // Analysing return.
            $analyseReturn = new AnalyseReturn($this->node);

            if ($this->declaredReturns) {
                $analyseReturn->onlyDeclared();
            }
        }
    }

    /**
     * Analysing only the hinted types.
     *
     * @return void
     */
    public function onlyHinted(): void
    {
        if ($this->node instanceof FunctionLikeNode) {
            // Analysing parameters.
            foreach ($this->node->getParameters() as $parameter) {
                $analyseParameter = new AnalyseParameters($parameter);

                if ($this->hintedParameters) {
                    $analyseParameter->onlyHinted();
                }
            }

            // Analysing return.
            $analyseReturn = new AnalyseReturn($this->node);

            if ($this->hintedReturns) {
                $analyseReturn->onlyHinted();
            }
        }
    }

    /**
     * Analysing both the declared and hinted types.
     *
     * @return void
     */
    public function bothDeclaredAndHinted(): void
    {
        if ($this->node instanceof FunctionLikeNode) {
            // Analysing parameters.
            foreach ($this->node->getParameters() as $parameter) {
                $analyseParameter = new AnalyseParameters($parameter);

                if ($this->declaredParameters && $this->hintedParameters) {
                    $analyseParameter->bothDeclaredAndHinted();
                }

                if ($this->declaredParameters && !$this->hintedParameters) {
                    $analyseParameter->onlyDeclared();
                }

                if (!$this->declaredParameters && $this->hintedParameters) {
                    $analyseParameter->onlyHinted();
                }
            }

            // Analysing return.
            $analyseReturn = new AnalyseReturn($this->node);

            if ($this->declaredReturns && $this->hintedReturns) {
                $analyseReturn->bothDeclaredAndHinted();
            }

            if ($this->declaredReturns && !$this->hintedReturns) {
                $analyseReturn->onlyDeclared();
            }

            if (!$this->declaredReturns && $this->hintedReturns) {
                $analyseReturn->onlyHinted();
            }
        }
    }
}