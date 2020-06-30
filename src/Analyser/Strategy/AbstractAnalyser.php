<?php

namespace Mikevandiepen\Strictly\Analyser\Strategy;

use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Contracts\HasType;

/**
 * Class AbstractAnalyser
 *
 * @package Mikevandiepen\Strictly\Analyser\Strategy\Options\AnalyserOptions
 */
abstract class AbstractAnalyser
{
    /**
     * The node which is subject for analysis.
     *
     * @var \Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Contracts\HasType
     */
    protected HasType $node;

    /**
     * AbstractAnalyser constructor.
     *
     * @param \Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Contracts\HasType $node
     */
    public function __construct(HasType $node)
    {
        // The node is an instance off HasType.
        $this->node = $node;
    }
}