<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Strategy\Options;

use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Contracts\FunctionLikeNode;
use MikevanDiepen\Strictly\Analyser\Strategy\AbstractAnalyser;
use MikevanDiepen\Strictly\Analyser\Strategy\Options\AnalyserTraits\FunctionLikeTrait;
use MikevanDiepen\Strictly\Analyser\Strategy\Options\Contracts\AnalyserInterface;
use MikevanDiepen\Strictly\Analyser\Strategy\Options\Contracts\FunctionLikeInterface;
use MikevanDiepen\Strictly\Analyser\Strategy\Options\FunctionLike\AnalyseParameters;
use MikevanDiepen\Strictly\Analyser\Strategy\Options\FunctionLike\AnalyseReturn;

/**
 * Class AnalyseClosure.
 *
 * @package MikevanDiepen\Strictly\Analyser\Strategy\Options
 */
final class AnalyseClosure extends AbstractAnalyser implements AnalyserInterface, FunctionLikeInterface
{
    use FunctionLikeTrait;

    /**
     * AnalyseClosure constructor.
     *
     * @param AbstractNode $node
     */
    public function __construct(AbstractNode $node)
    {
        parent::__construct($node);
    }

    /**
     * Analysing only the declared types.
     *
     * @return void
     * @throws \MikevanDiepen\Strictly\Exception\StrictlyException
     */
    public function onlyDeclared(): void
    {
        if ($this->node instanceof FunctionLikeNode) {
            // Analysing parameters.
            if ($this->node->hasParameters()) {
                foreach ($this->node->getParameters() as $parameter) {
                    $analyseParameter = new AnalyseParameters($parameter);

                    if ($this->declaredParameters) {
                        $analyseParameter->onlyDeclared();
                    }
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
     * @throws \MikevanDiepen\Strictly\Exception\StrictlyException
     */
    public function onlyHinted(): void
    {
        if ($this->node instanceof FunctionLikeNode) {
            // Analysing parameters.
            if ($this->node->hasParameters()) {
                foreach ($this->node->getParameters() as $parameter) {
                    $analyseParameter = new AnalyseParameters($parameter);

                    if ($this->hintedParameters) {
                        $analyseParameter->onlyHinted();
                    }
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
     * @throws \MikevanDiepen\Strictly\Exception\StrictlyException
     */
    public function bothDeclaredAndHinted(): void
    {
        if ($this->node instanceof FunctionLikeNode) {
            // Analysing parameters.
            if ($this->node->hasParameters()) {
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