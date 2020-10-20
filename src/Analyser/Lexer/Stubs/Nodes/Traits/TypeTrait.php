<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Traits;

use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Location\DeclaredTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Location\HintedTypeNode;

/**
 * Trait DeclaredType.
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Traits
 */
trait TypeTrait
{
    /**
     * The type which has been declared in the functional code.
     * This property can be accessed through:
     * @method setDeclaredType(DeclaredTypeNode $declaredTypeNode): self
     * @method getDeclaredTypeNode(): DeclaredTypeNode
     *
     * @var DeclaredTypeNode
     */
    private DeclaredTypeNode $declaredTypeNode;

    /**
     * The type which has been hinted in the docblock.
     * This property can be accessed through:
     * @method setHintedTypeNode(HintedTypeNode $hintedTypeNode): self
     * @method getHintedTypeNode(): DeclaredTypeNode
     *
     * @var HintedTypeNode
     */
    private HintedTypeNode $hintedTypeNode;

    /**
     * Getting the type which has been declared in the functional code.
     *
     * @return DeclaredTypeNode
     */
    public function getDeclaredTypeNode(): DeclaredTypeNode
    {
        return $this->declaredTypeNode;
    }

    /**
     * Setting the type which has been declared in the functional code.
     *
     * @param DeclaredTypeNode $declaredTypeNode
     *
     * @return $this
     */
    public function setDeclaredTypeNode(DeclaredTypeNode $declaredTypeNode): self
    {
        $this->declaredTypeNode = $declaredTypeNode;

        return $this;
    }

    /**
     * Getting the type which has been hinted in the docblock.
     *
     * @return HintedTypeNode
     */
    public function getHintedTypeNode(): HintedTypeNode
    {
        return $this->hintedTypeNode;
    }

    /**
     * Setting the type which has been hinted in the docblock.
     *
     * @param HintedTypeNode $hintedTypeNode
     *
     * @return $this
     */
    public function setHintedTypeNode(HintedTypeNode $hintedTypeNode): self
    {
        $this->hintedTypeNode = $hintedTypeNode;

        return $this;
    }
}