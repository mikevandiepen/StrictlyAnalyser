<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Contracts;

use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Location\DeclaredTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Location\HintedTypeNode;

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
     * @return DeclaredTypeNode
     */
    public function getDeclaredTypeNode(): DeclaredTypeNode;

    /**
     * Setting the type which has been declared in the functional code.
     *
     * @param DeclaredTypeNode $declaredTypeNode
     *
     * @return $this
     */
    public function setDeclaredTypeNode(DeclaredTypeNode $declaredTypeNode): self;

    /**
     * Getting the type which has been hinted in the docblock.
     *
     * @return HintedTypeNode
     */
    public function getHintedTypeNode(): HintedTypeNode;

    /**
     * Setting the type which has been hinted in the docblock.
     *
     * @param HintedTypeNode $hintedTypeNode
     *
     * @return $this
     */
    public function setHintedTypeNode(HintedTypeNode $hintedTypeNode): self;
}