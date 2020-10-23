<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Hinted;

use MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts\HintedTypeLexerInterface;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\AbstractTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Definition\TypeUndefinedNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\CompoundTypes\ArrayTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\CompoundTypes\CallableTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\CompoundTypes\IterableTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\CompoundTypes\ObjectTypeNode;
use phpDocumentor\Reflection\Type;

/**
 * Class HintedCompoundTypeParser
 *
 * @package  MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Hinted;
 */
final class HintedCompoundTypeParser implements HintedTypeLexerInterface
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
        if ($this->isArray($type)) {
            return new ArrayTypeNode();
        }

        if ($this->isObject($type)) {
            return new ObjectTypeNode();
        }

        if ($this->isCallable($type)) {
            return new CallableTypeNode();
        }

        if ($this->isIterable($type)) {
            return new IterableTypeNode();
        }

        return new TypeUndefinedNode();
    }

    /**
     * Whether the type is an array.
     *
     * @param \phpDocumentor\Reflection\Type $type
     *
     * @return bool
     */
    private function isArray(Type $type): bool
    {

    }

    /**
     * Whether the type is an object.
     *
     * @param \phpDocumentor\Reflection\Type $type
     *
     * @return bool
     */
    private function isObject(Type $type): bool
    {

    }

    /**
     * Whether the type is callable.
     *
     * @param \phpDocumentor\Reflection\Type $type
     *
     * @return bool
     */
    private function isCallable(Type $type): bool
    {

    }

    /**
     * Whether the type is iterable.
     *
     * @param \phpDocumentor\Reflection\Type $type
     *
     * @return bool
     */
    private function isIterable(Type $type): bool
    {

    }
}