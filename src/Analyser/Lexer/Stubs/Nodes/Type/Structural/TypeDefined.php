<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Structural;

/**
 * Class TypeDefined.
 * This class exists to mark the type as defined in a structural way.
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Structural
 */
final class TypeDefined extends AbstractTypeDefinition
{
    /**
     * The type found in the parsing process.
     *
     * @var string
     */
    private string $type;

    /**
     * TypeDefined constructor.
     *
     * @param string $type
     */
    public function __construct(string $type)
    {
        $this->type = $type;
    }

    /**
     * Returning the type.
     *
     * @return string
     */
    public function get(): string
    {
        return $this->type;
    }
}