<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Contracts;

use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\TypeNode;

/**
 * Interface HasType.
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Contracts
 */
interface HasType
{
    /**
     * Getting the type which has been declared in the functional code.
     *
     * @return TypeNode
     */
    public function getDeclaredTypeNode(): TypeNode;

    /**
     * Setting the type which has been declared in the functional code.
     *
     * @param TypeNode $declaredTypeNode
     *
     * @return $this
     */
    public function setDeclaredTypeNode(TypeNode $declaredTypeNode): self;

    /**
     * Getting the type which has been hinted in the docblock.
     *
     * @return TypeNode
     */
    public function getHintedTypeNode(): TypeNode;

    /**
     * Setting the type which has been hinted in the docblock.
     *
     * @param TypeNode $hintedTypeNode
     *
     * @return $this
     */
    public function setHintedTypeNode(TypeNode $hintedTypeNode): self;
}