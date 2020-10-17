<?php

declare(strict_types=1);

namespace MikevanDiepen\Strictly\Analyser\Strategy;

use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode;

/**
 * Class AbstractAnalyser
 *
 * @package MikevanDiepen\Strictly\Analyser\Strategy\Options\AnalyserOptions
 */
abstract class AbstractAnalyser
{
    /**
     * The node which is subject for analysis.
     *
     * @var AbstractNode
     */
    protected AbstractNode $node;

    /**
     * AbstractAnalyser constructor.
     *
     * @param AbstractNode $node
     */
    public function __construct(AbstractNode $node)
    {
        // The node is an instance off HasType.
        $this->node = $node;
    }
}