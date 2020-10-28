<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Definition;

use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Contracts\TypeDefinitionInterface;

/**
 * Class TypeDefinedNode.
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Definition
 */
final class TypeDefinedNode implements TypeDefinitionInterface
{
    /**
     * All the types retrieved from the code.
     * The property type is an array since it can have multiple types, for example Union types or Nullable types.
     *
     * @var string[]
     */
    private array $type = [];

    /**
     * Adding a type to the list of registered types.
     *
     * @param array $type
     */
    public function setType(array $type): void
    {
        // Spreading both arrays into the list of types.
        $this->type = (array) [...$this->type, ...$type];
    }

    /**
     * Returning the types for analysis.
     *
     * @return string[]
     */
    public function getType(): array
    {
        return $this->type;
    }
}