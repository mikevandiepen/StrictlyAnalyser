<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Options;

use MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts\LexerOptionInterface;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Definition\TypeUndefinedNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\CompoundTypes\ArrayTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\CompoundTypes\CallableTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\CompoundTypes\IterableTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\CompoundTypes\ObjectTypeNode;
use PhpParser\Node;

/**
 * Class ParseCompoundTypes
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Groups;
 */
final class ParseCompoundTypes implements LexerOptionInterface
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
        if ($this->isArray($node)) {
            return new ArrayTypeNode();
        }

        if ($this->isObject($node)) {
            return new ObjectTypeNode();
        }

        if ($this->isCallable($node)) {
            return new CallableTypeNode();
        }

        if ($this->isIterable($node)) {
            return new IterableTypeNode();
        }

        return new TypeUndefinedNode();
    }

    /**
     * Whether the type is an array.
     *
     * @param \PhpParser\Node $node
     *
     * @return bool
     */
    private function isArray(Node $node): bool
    {

    }

    /**
     * Whether the type is an object.
     *
     * @param \PhpParser\Node $node
     *
     * @return bool
     */
    private function isObject(Node $node): bool
    {

    }

    /**
     * Whether the type is callable.
     *
     * @param \PhpParser\Node $node
     *
     * @return bool
     */
    private function isCallable(Node $node): bool
    {

    }

    /**
     * Whether the type is iterable.
     *
     * @param \PhpParser\Node $node
     *
     * @return bool
     */
    private function isIterable(Node $node): bool
    {

    }
}