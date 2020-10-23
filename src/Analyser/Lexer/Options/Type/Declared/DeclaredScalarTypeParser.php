<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Declared;

use MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts\DeclaredTypeLexerInterface;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\AbstractTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Definition\TypeUndefinedNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\ScalarTypes\BooleanTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\ScalarTypes\FloatTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\ScalarTypes\IntegerTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\ScalarTypes\StringTypeNode;
use PhpParser\Node;
use PhpParser\Node\Identifier;

/**
 * Class DeclaredPseudoTypeParser
 *
 * @package  MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Declared
 */
final class DeclaredScalarTypeParser implements DeclaredTypeLexerInterface
{
    /**
     * An option specific parser process.
     *
     * @param \PhpParser\Node\Identifier $type
     *
     * @return \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\AbstractTypeNode
     */
    public function parse(Identifier $type): AbstractTypeNode
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
     * @param \PhpParser\Node\Identifier $type
     *
     * @return bool
     */
    private function isBoolean(Identifier $type): bool
    {
        return (bool) (strtolower($type->name)  === new BooleanTypeNode());
    }

    /**
     * Whether the type is an integer.
     *
     * @param \PhpParser\Node\Identifier $type
     *
     * @return bool
     */
    private function isInteger(Identifier $type): bool
    {
        return (bool) (strtolower($type->name)  === new IntegerTypeNode());
    }

    /**
     * Whether the type is a float.
     *
     * @param \PhpParser\Node\Identifier $type
     *
     * @return bool
     */
    private function isFloat(Identifier $type): bool
    {
        return (bool) (strtolower($type->name)  === new FloatTypeNode());
    }

    /**
     * Whether the type is a string.
     *
     * @param \PhpParser\Node\Identifier $type
     *
     * @return bool
     */
    private function isString(Identifier $type): bool
    {
        return (bool) (strtolower($type->name)  === new StringTypeNode());
    }
}