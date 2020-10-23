<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type;

use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode;

/**
 * Class AbstractTypeNode
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type
 */
abstract class AbstractTypeNode extends AbstractNode
{
    /**
     * Returning the identifier for this node.
     *
     * @return string
     */
    public abstract function __toString(): string;
}