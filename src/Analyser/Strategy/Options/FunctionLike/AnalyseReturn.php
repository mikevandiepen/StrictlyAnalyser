<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Strategy\Options\FunctionLike;

use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode;
use MikevanDiepen\Strictly\Analyser\Strategy\AbstractAnalyser;
use MikevanDiepen\Strictly\Analyser\Strategy\Options\AnalyserTraits\AnalyserTrait;
use MikevanDiepen\Strictly\Analyser\Strategy\Options\Contracts\AnalyserInterface;

/**
 * Class AnalyseReturn.
 *
 * @package MikevanDiepen\Strictly\Analyser\Strategy\Options\FunctionNode
 */
final class AnalyseReturn extends AbstractAnalyser implements AnalyserInterface
{
    use AnalyserTrait;

    /**
     * AnalyseReturn constructor.
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
        if (!$this->declaredTypeIsset()) {
            echo 'Missing declared return for ' . $this->node->getName() . PHP_EOL;
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
        if (!$this->hintedTypeIsset()) {
            echo 'Missing hinted return for ' . $this->node->getName() . PHP_EOL;
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
        if ($this->declaredTypeIsset() && $this->hintedTypeIsset()) {
            if (!$this->typesMatch()) {
                if ($this->getMissingDeclaredTypes() > 0) {
                    echo 'Missing declared return for ' . $this->node->getName() . PHP_EOL;
                    echo 'Maybe use ' . implode('|' , $this->getMissingDeclaredTypes()) . PHP_EOL;
                }

                if ($this->getMissingHintedTypes() > 0) {
                    echo 'Missing hinted return for ' . $this->node->getName() . PHP_EOL;
                    echo 'Maybe use ' . implode('|' , $this->getMissingHintedTypes()) . PHP_EOL;
                }
            }
        } elseif ($this->declaredTypeIsset() && !$this->hintedTypeIsset()) {
            echo 'Missing declared return for ' . $this->node->getName() . PHP_EOL;
        } elseif (!$this->declaredTypeIsset() && $this->hintedTypeIsset()) {
            echo 'Missing hinted return for ' . $this->node->getName() . PHP_EOL;
        } else {
            echo 'Missing declared return for ' . $this->node->getName() . PHP_EOL;
            echo 'Missing hinted return for ' . $this->node->getName() . PHP_EOL;
        }
    }
}