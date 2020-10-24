<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type;

use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Contracts\TypeDefinitionInterface;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Contracts\TypeLocationInterface;

/**
 * Class TypeNode
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type
 */
final class TypeNode extends AbstractNode
{
    /**
     * Whether the type is defined, either defined or undefined.
     *
     * @var TypeDefinitionInterface
     */
    private TypeDefinitionInterface $type;

    /**
     * The location for the type, either declared or hinted.
     *
     * @var TypeLocationInterface
     */
    private TypeLocationInterface $location;

    /**
     * TypeNode constructor.
     *
     * @param \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Contracts\TypeDefinitionInterface $type
     * @param \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Contracts\TypeLocationInterface   $location
     */
    public function __construct(TypeDefinitionInterface $type, TypeLocationInterface $location)
    {
        $this->type = $type;
        $this->location = $location;
    }

    /**
     * Returning the definition of the type.
     *
     * @return TypeDefinitionInterface
     */
    public function getType(): TypeDefinitionInterface
    {
        return $this->type;
    }

    /**
     * Returning the location of the type.
     *
     * @return TypeLocationInterface
     */
    public function getLocation(): TypeLocationInterface
    {
        return $this->location;
    }
}