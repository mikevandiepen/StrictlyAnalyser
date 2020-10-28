<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options\Type;

use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Definition\TypeDefinedNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Definition\TypeUndefinedNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Location\DeclaredTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\TypeNode;
use PhpParser\Node;
use ReflectionClass;

/**
 * Class DeclaredTypeParser
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Options\Type
 */
final class DeclaredTypeParser
{
    /**
     * An option specific parser process.
     *
     * @param \PhpParser\Node $node
     *
     * @return TypeNode
     * @throws \ReflectionException
     */
    public function parse(Node $node): TypeNode
    {
        // Whether the node is typed, else returning undefined stub.
        $typeDefinition = empty($node->type) ? new TypeUndefinedNode() : new TypeDefinedNode();

        if ($typeDefinition instanceof  TypeDefinedNode) {
            /** @var Node\NullableType are the nullable types. */
            if ($node->type instanceof Node\NullableType) {
                $typeDefinition->setType(['null']);

                // Running a recursive call to collect the other type besides 'null'.
                $this->parse($node->type);
            }

            /** @var Node\Identifier are the standard types */
            if ($node->type instanceof Node\Identifier) {
                $typeDefinition->setType([$node->type]);
            }

            /** @var Node\Name are class or "self" / "parent" references. */
            if ($node->type instanceof Node\Name) {
                // Collecting the FQCN by class reference.
                $reflectionClass = new ReflectionClass($node->type);
                $typeDefinition->setType([$reflectionClass->getNamespaceName()]);
            }
        }

        return new TypeNode($typeDefinition, new DeclaredTypeNode());
    }
}