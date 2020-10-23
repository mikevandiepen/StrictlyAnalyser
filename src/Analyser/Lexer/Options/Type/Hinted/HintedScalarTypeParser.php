<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Hinted;

use MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts\HintedTypeLexerInterface;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\AbstractTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Definition\TypeUndefinedNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\ScalarTypes\BooleanTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\ScalarTypes\FloatTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\ScalarTypes\IntegerTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\ScalarTypes\StringTypeNode;
use phpDocumentor\Reflection\Type;

/**
 * Class HintedPseudoTypeParser
 *
 * @package  MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Hinted
 */
final class HintedScalarTypeParser implements HintedTypeLexerInterface
{
    /**
     * An option specific parser process.
     *
     * @param \phpDocumentor\Reflection\Type $type
     *
     * @return \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\AbstractTypeNode
     */
    public function parse(Type $type): AbstractTypeNode
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
     * @param \phpDocumentor\Reflection\Type $type
     *
     * @return bool
     */
    private function isBoolean(Type $type): bool
    {

    }

    /**
     * Whether the type is an integer.
     *
     * @param \phpDocumentor\Reflection\Type $type
     *
     * @return bool
     */
    private function isInteger(Type $type): bool
    {

    }

    /**
     * Whether the type is a float.
     *
     * @param \phpDocumentor\Reflection\Type $type
     *
     * @return bool
     */
    private function isFloat(Type $type): bool
    {

    }

    /**
     * Whether the type is a string.
     *
     * @param \phpDocumentor\Reflection\Type $type
     *
     * @return bool
     */
    private function isString(Type $type): bool
    {

    }
}