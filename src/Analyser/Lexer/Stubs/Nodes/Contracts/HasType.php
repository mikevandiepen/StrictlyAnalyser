<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Contracts;

use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\Location\DeclaredType;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\Location\HintedType;

/**
 * Interface HasType.
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Contracts
 */
interface HasType
{
    /**
     * Setting the type which has been declared in the functional code.
     *
     * @param \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\Location\DeclaredType $declaredType
     *
     * @return $this
     */
    public function setDeclaredType(DeclaredType $declaredType): self;

    /**
     * Getting the type which has been declared in the functional code.
     *
     * @return \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\Location\DeclaredType
     */
    public function getDeclaredType(): DeclaredType;

    /**
     * Setting the type which has been hinted in the docblock.
     *
     * @param \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\Location\HintedType $hintedType
     *
     * @return $this
     */
    public function setHintedType(HintedType $hintedType): self;

    /**
     * Getting the type which has been hinted in the docblock.
     *
     * @return \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\Location\HintedType
     */
    public function getHintedType(): HintedType;
}