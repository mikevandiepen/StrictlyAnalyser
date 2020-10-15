<?php

declare(strict_types=1);

namespace MikevanDiepen\Strictly\Analyser\Strategy;

use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Contracts\HasType;

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
     * @var \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Contracts\HasType
     */
    protected HasType $node;

    /**
     * AbstractAnalyser constructor.
     *
     * @param \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Contracts\HasType $node
     */
    public function __construct(HasType $node)
    {
        // The node is an instance off HasType.
        $this->node = $node;
    }
}