<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Declared;

use MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts\DeclaredTypeLexerInterface;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\AbstractTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Definition\TypeUndefinedNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\PseudoTypes\MixedTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\PseudoTypes\NumberTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\PseudoTypes\VoidTypeNode;
use PhpParser\Node\Identifier;

/**
 * Class DeclaredPseudoTypeParser
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Declared
 */
final class DeclaredPseudoTypeParser implements DeclaredTypeLexerInterface
{
    /**
     * An option specific parser process.
     *
     * @param \PhpParser\Node\Identifier $type
     *
     * @return \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\AbstractTypeNode
     */
    public function parse(Identifier $type): AbstractTypeNode
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
     * @param \PhpParser\Node\Identifier $type
     *
     * @return bool
     */
    private function isMixed(Identifier $type): bool
    {

    }

    /**
     * Whether the type is number.
     *
     * @param \PhpParser\Node\Identifier $type
     *
     * @return bool
     */
    private function isNumber(Identifier $type): bool
    {

    }

    /**
     * Whether the type is void.
     *
     * @param \PhpParser\Node\Identifier $type
     *
     * @return bool
     */
    private function isVoid(Identifier $type): bool
    {

    }
}