<?php

namespace Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Traits;

use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Type\HintedType;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Type\DeclaredType;

/**
 * Trait DeclaredType.
 *
 * @package Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Traits
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
     * @var \Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Type\DeclaredType
     */
    private DeclaredType $declaredType;

    /**
     * The type which has been hinted in the docblock.
     *
     * This property can be accessed through:
     * @method setHintedType(HintedType $hintedType): self
     * @method getHintedType(): string[]
     *
     * @var \Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Type\HintedType
     */
    private HintedType $hintedType;

    /**
     * Setting the type which has been declared in the functional code.
     *
     * @param \Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Type\DeclaredType $declaredType
     *
     * @return $this
     */
    public function setDeclaredType(DeclaredType $declaredType): self
    {
        $this->declaredType = $declaredType;

        return $this;
    }

    /**
     * Getting the type which has been declared in the functional code.
     *
     * @return \Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Type\DeclaredType
     */
    public function getDeclaredType(): DeclaredType
    {
        return $this->declaredType;
    }

    /**
     * She type which has been hinted in the docblock.
     *
     * @param \Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Type\HintedType $hintedType
     *
     * @return $this
     */
    public function setHintedType(HintedType $hintedType): self
    {
        $this->hintedType = $hintedType;

        return $this;
    }

    /**
     * Ghe type which has been hinted in the docblock.
     *
     * @return \Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Type\HintedType
     */
    public function getHintedType(): HintedType
    {
        return $this->hintedType;
    }
}