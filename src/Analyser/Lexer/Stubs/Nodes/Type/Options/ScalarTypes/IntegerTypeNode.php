<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\ScalarTypes;

use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\AbstractTypeNode;

/**
 * Class IntegerTypeNode
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\ScalarTypes
 */
final class IntegerTypeNode extends AbstractTypeNode
{
    /** @var string The identifier of this type. */
    private const TYPE = 'int';

    /**
     * Returning the identifier for this node.
     *
     * @return string
     */
    public function __toString(): string
    {
        return self::TYPE;
    }
}