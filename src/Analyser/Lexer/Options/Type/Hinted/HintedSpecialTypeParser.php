<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Hinted;

use MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts\HintedTypeLexerInterface;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\AbstractTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Definition\TypeUndefinedNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\PseudoTypes\MixedTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\PseudoTypes\NumberTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\PseudoTypes\VoidTypeNode;
use phpDocumentor\Reflection\Type;

/**
 * Class HintedPseudoTypeParser
 *
 * @package  MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Hinted
 */
final class HintedSpecialTypeParser implements HintedTypeLexerInterface
{
    /**
     * An option specific parser process.
     *
     * @param \phpDocumentor\Reflection\Type $type
     *
     * @return \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\AbstractTypeNode
     */
    public function parse(Type $type): AbstractTypeNode
    {
        if ($this->isMixed($type)) {
            return new MixedTypeNode();
        }

        if ($this->isNumber($type)) {
            return new NumberTypeNode();
        }

        if ($this->isVoid($type)) {
            return new VoidTypeNode();
        }

        return new TypeUndefinedNode();
    }

    /**
     * Whether the type is mixed.
     *
     * @param \phpDocumentor\Reflection\Type $type
     *
     * @return bool
     */
    private function isMixed(Type $type): bool
    {

    }

    /**
     * Whether the type is number.
     *
     * @param \phpDocumentor\Reflection\Type $type
     *
     * @return bool
     */
    private function isNumber(Type $type): bool
    {

    }

    /**
     * Whether the type is void.
     *
     * @param \phpDocumentor\Reflection\Type $type
     *
     * @return bool
     */
    private function isVoid(Type $type): bool
    {

    }
}