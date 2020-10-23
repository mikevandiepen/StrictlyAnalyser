<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\ScalarTypes;

use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\AbstractTypeNode;

/**
 * Class StringTypeNode
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\ScalarTypes
 */
final class StringTypeNode extends AbstractTypeNode
{
    /** @var string The identifier of this type. */
    private const TYPE = 'string';

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