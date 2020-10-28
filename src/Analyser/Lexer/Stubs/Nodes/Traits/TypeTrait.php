<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Traits;

use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Location\DeclaredTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Location\HintedTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\TypeNode;

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
     * @method setDeclaredType(TypeNode $declaredTypeNode): self
     * @method getDeclaredTypeNode(): DeclaredTypeNode
     *
     * @var TypeNode
     */
    private TypeNode $declaredTypeNode;

    /**
     * The type which has been hinted in the docblock.
     * This property can be accessed through:
     * @method setHintedTypeNode(TypeNode $hintedTypeNode): self
     * @method getHintedTypeNode(): DeclaredTypeNode
     *
     * @var TypeNode
     */
    private TypeNode $hintedTypeNode;

    /**
     * Getting the type which has been declared in the functional code.
     *
     * @return TypeNode
     */
    public function getDeclaredTypeNode(): TypeNode
    {
        return $this->declaredTypeNode;
    }

    /**
     * Setting the type which has been declared in the functional code.
     *
     * @param TypeNode $declaredTypeNode
     *
     * @return $this
     */
    public function setDeclaredTypeNode(TypeNode $declaredTypeNode): self
    {
        $this->declaredTypeNode = $declaredTypeNode;

        return $this;
    }

    /**
     * Getting the type which has been hinted in the docblock.
     *
     * @return TypeNode
     */
    public function getHintedTypeNode(): TypeNode
    {
        return $this->hintedTypeNode;
    }

    /**
     * Setting the type which has been hinted in the docblock.
     *
     * @param TypeNode $hintedTypeNode
     *
     * @return $this
     */
    public function setHintedTypeNode(TypeNode $hintedTypeNode): self
    {
        $this->hintedTypeNode = $hintedTypeNode;

        return $this;
    }
}