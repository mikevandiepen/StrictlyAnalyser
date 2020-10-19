<?php

declare(strict_types=1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Contracts;

use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Attributes\ParameterNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Attributes\ReturnNode;
use MikevanDiepen\Strictly\Exception\StrictlyException;

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

    /**
     * Whether a FunctionLike node has parameters.
     *
     * @return bool
     */
    public function hasParameters(): bool;

    /**
     * Setting the return from the node.
     *
     * @param \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Attributes\ReturnNode $returnNode
     *
     * @return void
     */
    public function setReturn(ReturnNode $returnNode): void;

    /**
     * Getting the return from the node.
     *
     * @return \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Attributes\ReturnNode
     */
    public function getReturn(): ReturnNode;
}