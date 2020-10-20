<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Declared\Options;

use MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts\DeclaredTypeLexerInterface;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\AbstractTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Definition\TypeUndefinedNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\ScalarTypes\BooleanTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\ScalarTypes\FloatTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\ScalarTypes\IntegerTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\ScalarTypes\StringTypeNode;
use PhpParser\Node;

/**
 * Class DeclaredPseudoTypeParser
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Groups
 */
final class DeclaredScalarTypeParser implements DeclaredTypeLexerInterface
{
    /**
     * An option specific parser process.
     *
     * @param \PhpParser\Node $type
     *
     * @return \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\AbstractTypeNode
     */
    public function parse(Node $type): AbstractTypeNode
    {
        if ($this->isBoolean($type)) {
            return new BooleanTypeNode();
        }

        if ($this->isInteger($type)) {
            return new IntegerTypeNode();
        }

        if ($this->isFloat($type)) {
            return new FloatTypeNode();
        }

        if ($this->isString($type)) {
            return new StringTypeNode();
        }

        return new TypeUndefinedNode();
    }

    /**
     * Whether the type is a boolean.
     *
     * @param \PhpParser\Node $type
     *
     * @return bool
     */
    private function isBoolean(Node $type): bool
    {

    }

    /**
     * Whether the type is an integer.
     *
     * @param \PhpParser\Node $type
     *
     * @return bool
     */
    private function isInteger(Node $type): bool
    {

    }

    /**
     * Whether the type is a float.
     *
     * @param \PhpParser\Node $type
     *
     * @return bool
     */
    private function isFloat(Node $type): bool
    {

    }

    /**
     * Whether the type is a string.
     *
     * @param \PhpParser\Node $type
     *
     * @return bool
     */
    private function isString(Node $type): bool
    {

    }
}