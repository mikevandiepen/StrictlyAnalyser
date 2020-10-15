<?php

declare(strict_types=1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Traits;

use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Attributes\ParameterNode;

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
    private array $parameters;

    /**
     * Getting the parameters from the node.
     *
     * @return \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Attributes\ParameterNode[]
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * Setting the parameters from the node.
     *
     * @param \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Attributes\ParameterNode $parameterNode
     *
     * @return void
     * @throws \Exception
     */
    public function setParameters(ParameterNode $parameterNode): void
    {
        if ($parameterNode instanceof ParameterNode) {
            $this->parameters[] = $parameterNode;
        } else {
            throw new \Exception('Incorrect node supplied! Expected ParameterNode.');
        }
    }
}