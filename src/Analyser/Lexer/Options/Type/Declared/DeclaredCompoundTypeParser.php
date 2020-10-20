<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Declared\Options;

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
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Groups;
 */
final class DeclaredCompoundTypeParser implements DeclaredTypeLexerInterface
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
     * @param \PhpParser\Node $type
     *
     * @return bool
     */
    private function isArray(Node $type): bool
    {

    }

    /**
     * Whether the type is an object.
     *
     * @param \PhpParser\Node $type
     *
     * @return bool
     */
    private function isObject(Node $type): bool
    {

    }

    /**
     * Whether the type is callable.
     *
     * @param \PhpParser\Node $type
     *
     * @return bool
     */
    private function isCallable(Node $type): bool
    {

    }

    /**
     * Whether the type is iterable.
     *
     * @param \PhpParser\Node $type
     *
     * @return bool
     */
    private function isIterable(Node $type): bool
    {

    }
}