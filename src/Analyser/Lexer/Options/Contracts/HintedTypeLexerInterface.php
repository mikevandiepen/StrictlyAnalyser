<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts;

use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\AbstractTypeNode;
use phpDocumentor\Reflection\Type;

/**
 * Interface HintedTypeLexerInterface.
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts
 */
interface HintedTypeLexerInterface
{
    /**
     * An option specific parser process.
     *
     * @param \phpDocumentor\Reflection\Type $type
     *
     * @return \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\AbstractTypeNode
     */
    public function parse(Type $type): AbstractTypeNode;
}