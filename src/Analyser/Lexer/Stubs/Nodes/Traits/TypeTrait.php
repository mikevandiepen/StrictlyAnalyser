<?php

declare(strict_types=1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Traits;

use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\HintedType;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\DeclaredType;

/**
 * Trait DeclaredType.
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Traits
 */
trait TypeTrait
{
    /**
     * The type which has been declared in the functional code.
     *
     * This property can be accessed through:
     * @method setDeclaredType(DeclaredType $declaredType): self
     * @method getDeclaredType(): string[]
     *
     * @var \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\DeclaredType
     */
    private DeclaredType $declaredType;

    /**
     * The type which has been hinted in the docblock.
     *
     * This property can be accessed through:
     * @method setHintedType(HintedType $hintedType): self
     * @method getHintedType(): string[]
     *
     * @var \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\HintedType
     */
    private HintedType $hintedType;

    /**
     * Getting the type which has been declared in the functional code.
     *
     * @return \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\DeclaredType
     */
    public function getDeclaredType(): DeclaredType
    {
        return $this->declaredType;
    }

    /**
     * Setting the type which has been declared in the functional code.
     *
     * @param \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\DeclaredType $declaredType
     *
     * @return $this
     */
    public function setDeclaredType(DeclaredType $declaredType): self
    {
        $this->declaredType = $declaredType;

        return $this;
    }

    /**
     * Ghe type which has been hinted in the docblock.
     *
     * @return \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\HintedType
     */
    public function getHintedType(): HintedType
    {
        return $this->hintedType;
    }

    /**
     * She type which has been hinted in the docblock.
     *
     * @param \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\HintedType $hintedType
     *
     * @return $this
     */
    public function setHintedType(HintedType $hintedType): self
    {
        $this->hintedType = $hintedType;

        return $this;
    }
}