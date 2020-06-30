<?php

namespace Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Traits;

use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\AbstractNode;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Attributes\ParameterNode;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Contracts\FunctionLikeNode;

/**
 * Trait ParameterTrait.
 *
 * @package Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Traits
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
     * Setting the parameters from the node.
     *
     * @param \Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Attributes\ParameterNode $parameterNode
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

    /**
     * Getting the parameters from the node.
     *
     * @return \Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Attributes\ParameterNode[]
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }
}