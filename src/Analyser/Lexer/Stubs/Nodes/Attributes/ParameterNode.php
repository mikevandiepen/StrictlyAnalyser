<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Attributes;

use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Contracts\HasType;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Traits\TypeTrait;

/**
 * Class ParameterNode.
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Attributes
 */
final class ParameterNode extends AbstractNode implements HasType
{
    use TypeTrait;

    /**
     * The index of the parameter.
     * This property can be accessed through:
     * @method setParameterIndex(int $index): self
     * @method getParameterIndex(): int
     *
     * @var int
     */
    private int $parameterIndex;

    /**
     * The name of the parameter.
     * This property can be accessed through:
     * @method setParameterName(string $parameterName): self
     * @method getName(): string
     *
     * @var string
     */
    private string $parameterName;

    /**
     * Getting the index of the parameter.
     *
     * @return int
     */
    public function getParameterIndex(): int
    {
        return $this->parameterIndex;
    }

    /**
     * Setting the index of the parameter.
     *
     * @param int $parameterIndex
     *
     * @return $this
     */
    public function setParameterIndex(int $parameterIndex): self
    {
        $this->parameterIndex = $parameterIndex;

        return $this;
    }

    /**
     * Getting the name of the parameter.
     *
     * @return string
     */
    public function getParameterName(): string
    {
        return $this->parameterName;
    }

    /**
     * Setting the name of the parameter.
     *
     * @param string $parameterName
     *
     * @return $this
     */
    public function setParameterName(string $parameterName): self
    {
        $this->parameterName = $parameterName;

        return $this;
    }
}