<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type;

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
     * @var string[]
     */
    protected array $type = [];

    /**
     * Getting the types from the class.
     *
     * @return string[]
     */
    public function getType(): array
    {
        return $this->type;
    }

    /**
     * Sorting the array of types to avoid further complications in the analysis process.
     *
     * @return $this
     */
    protected function sort(): self
    {
        $this->type = sort($this->type);

        return $this;
    }
}