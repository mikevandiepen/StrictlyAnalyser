<?php

declare(strict_types=1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type;

use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Structural\AbstractTypeDefinition;

/**
 * Interface AbstractType.
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type
 */
abstract class AbstractType
{
    /**
     * The types parsed by the specific class.
     *
     * @var AbstractTypeDefinition[]
     */
    private array $type = [];

    /**
     * Setting the types from the class.
     *
     * @param \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Structural\AbstractTypeDefinition $type
     *
     * @return $this
     */
    public function setType(AbstractTypeDefinition $type): self
    {
        $this->type[] = $type;

        return $this;
    }

    /**
     * Getting the types from the class.
     *
     * @return AbstractTypeDefinition[]
     */
    public function getType(): array
    {
        // Sorting the array of types to avoid further complications in the analysis process.
        sort($this->type);

        return $this->type;
    }

    /**
     * The nodes are assigned in the constructor and that is where the process starts.
     * This method is purely so it can run recursively.
     *
     * @param $type
     *
     * @return void
     */
    abstract protected function getTypeFromNode($type): void;
}