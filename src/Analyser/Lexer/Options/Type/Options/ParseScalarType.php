<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Options;

use MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts\LexerOptionInterface;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Definition\TypeUndefinedNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\ScalarTypes\BooleanTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\ScalarTypes\FloatTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\ScalarTypes\IntegerTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\ScalarTypes\StringTypeNode;
use PhpParser\Node;

/**
 * Class ParsePseudoTypes
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Groups
 */
final class ParseScalarType implements LexerOptionInterface
{
    /**
     * An option specific parser process.
     *
     * @param \PhpParser\Node $node
     *
     * @return \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode
     */
    public function parse(Node $node): AbstractNode
    {
        if ($this->isBoolean($node)) {
            return new BooleanTypeNode();
        }

        if ($this->isInteger($node)) {
            return new IntegerTypeNode();
        }

        if ($this->isFloat($node)) {
            return new FloatTypeNode();
        }

        if ($this->isString($node)) {
            return new StringTypeNode();
        }

        return new TypeUndefinedNode();
    }

    /**
     * Whether the type is a boolean.
     *
     * @param \PhpParser\Node $node
     *
     * @return bool
     */
    private function isBoolean(Node $node): bool
    {

    }

    /**
     * Whether the type is an integer.
     *
     * @param \PhpParser\Node $node
     *
     * @return bool
     */
    private function isInteger(Node $node): bool
    {

    }

    /**
     * Whether the type is a float.
     *
     * @param \PhpParser\Node $node
     *
     * @return bool
     */
    private function isFloat(Node $node): bool
    {

    }

    /**
     * Whether the type is a string.
     *
     * @param \PhpParser\Node $node
     *
     * @return bool
     */
    private function isString(Node $node): bool
    {

    }
}