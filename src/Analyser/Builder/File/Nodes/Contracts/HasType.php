<?php

namespace Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Contracts;

use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Type\HintedType;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Type\DeclaredType;

/**
 * Interface HasType.
 *
 * @package Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Contracts
 */
interface HasType
{
    /**
     * Setting the type which has been declared in the functional code.
     *
     * @param \Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Type\DeclaredType $declaredType
     *
     * @return $this
     */
    public function setDeclaredType(DeclaredType $declaredType): self;

    /**
     * Getting the type which has been declared in the functional code.
     *
     * @return \Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Type\DeclaredType
     */
    public function getDeclaredType(): DeclaredType;

    /**
     * She type which has been hinted in the docblock.
     *
     * @param \Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Type\HintedType $hintedType
     *
     * @return $this
     */
    public function setHintedType(HintedType $hintedType): self;

    /**
     * Ghe type which has been hinted in the docblock.
     *
     * @return \Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Type\HintedType
     */
    public function getHintedType(): HintedType;
}