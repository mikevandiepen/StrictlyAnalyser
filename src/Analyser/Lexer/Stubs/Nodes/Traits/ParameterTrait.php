<?php

declare(strict_types=1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Traits;

use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Attributes\ParameterNode;
use MikevanDiepen\Strictly\Exception\StrictlyException;

/**
 * Trait ParameterTrait.
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Traits
 */
trait ParameterTrait
{
    /**
     * The parameters which belong to the arrow function node.
     *
     * This property can be accessed through:
     * @method setParameter(ParameterNode $ParameterNode): self
     * @method getParameter(): ParameterNode[]
     *
     * @var ParameterNode[]
     */
    private array $parameters = [];

    /**
     * Getting the parameters from the node.
     *
     * @return \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Attributes\ParameterNode[]
     * @throws \MikevanDiepen\Strictly\Exception\StrictlyException
     */
    public function getParameters(): array
    {
        if (!$this->hasParameters()) {
            throw new StrictlyException('No parameter nodes found.');
        }

        return $this->parameters;
    }

    /**
     * Setting the parameters from the node.
     *
     * @param \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Attributes\ParameterNode $parameterNode
     *
     * @return void
     */
    public function setParameters(ParameterNode $parameterNode): void
    {
        $this->parameters[] = $parameterNode;
    }

    /**
     * Whether a FunctionLike node has parameters.
     *
     * @return bool
     */
    public function hasParameters(): bool
    {
        return (bool)(count($this->parameters) > 0);
    }
}