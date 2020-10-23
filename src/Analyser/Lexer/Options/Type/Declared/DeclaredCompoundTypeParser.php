<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Declared;

use MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts\DeclaredTypeLexerInterface;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\AbstractTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Definition\TypeUndefinedNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\CompoundTypes\ArrayTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\CompoundTypes\CallableTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\CompoundTypes\IterableTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\CompoundTypes\ObjectTypeNode;
use PhpParser\Node;

/**
 * Class DeclaredCompoundTypeParser
 *
 * @package  MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Declared;
 */
final class DeclaredCompoundTypeParser implements DeclaredTypeLexerInterface
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
     * @param \PhpParser\Node\Identifier $type
     *
     * @return bool
     */
    private function isArray(Identifier $type): bool
    {

    }

    /**
     * Whether the type is an object.
     *
     * @param \PhpParser\Node\Identifier $type
     *
     * @return bool
     */
    private function isObject(Identifier $type): bool
    {
    }

    /**
     * Whether the type is callable.
     *
     * @param \PhpParser\Node\Identifier $type
     *
     * @return bool
     */
    private function isCallable(Identifier $type): bool
    {

    }

    /**
     * Whether the type is iterable.
     *
     * @param \PhpParser\Node\Identifier $type
     *
     * @return bool
     */
    private function isIterable(Identifier $type): bool
    {
        // Todo: figure this one out.
    }
}