<?php

namespace Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Contracts;

use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Attributes\ParameterNode;

/**
 * Interface FunctionLikeNode.
 *
 * @package Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Contracts
 */
interface FunctionLikeNode
{
    /**
     * Setting the parameters from the node.
     *
     * @param \Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Attributes\ParameterNode $parameterNode
     *
     * @return void
     * @throws \Exception
     */
    public function setParameters(ParameterNode $parameterNode): void;

    /**
     * Getting the parameters from the node.
     *
     * @return \Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Attributes\ParameterNode[]
     */
    public function getParameters(): array;
}