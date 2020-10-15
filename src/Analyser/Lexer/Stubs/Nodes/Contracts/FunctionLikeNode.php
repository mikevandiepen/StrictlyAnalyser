<?php

declare(strict_types=1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Contracts;

use MikevanDiepen\Strictly\Exception\StrictlyException;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Attributes\ParameterNode;

/**
 * Interface FunctionLikeNode.
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Contracts
 */
interface FunctionLikeNode
{
    /**
     * Setting the parameters from the node.
     *
     * @param \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Attributes\ParameterNode $parameterNode
     *
     * @return void
     * @throws StrictlyException
     */
    public function setParameters(ParameterNode $parameterNode): void;

    /**
     * Getting the parameters from the node.
     *
     * @return \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Attributes\ParameterNode[]
     */
    public function getParameters(): array;
}