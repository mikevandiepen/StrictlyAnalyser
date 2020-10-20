<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Options;

use MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts\LexerOptionInterface;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Definition\TypeUndefinedNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\PseudoTypes\MixedTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\PseudoTypes\NumberTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\PseudoTypes\VoidTypeNode;
use PhpParser\Node;

/**
 * Class ParsePseudoTypes
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Groups
 */
final class ParseSpecialTypes implements LexerOptionInterface
{
    /**
     * An option specific parser process.
     *
     * @param \PhpParser\Node $node
     *
     * @return \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode
     */
    public function parse(Node $node): AbstractNode
    {
        if ($this->isMixed($node)) {
            return new MixedTypeNode();
        }

        if ($this->isNumber($node)) {
            return new NumberTypeNode();
        }

        if ($this->isVoid($node)) {
            return new VoidTypeNode();
        }

        return new TypeUndefinedNode();
    }

    /**
     * Whether the type is mixed.
     *
     * @param \PhpParser\Node $node
     *
     * @return bool
     */
    private function isMixed(Node $node): bool
    {

    }

    /**
     * Whether the type is number.
     *
     * @param \PhpParser\Node $node
     *
     * @return bool
     */
    private function isNumber(Node $node): bool
    {

    }

    /**
     * Whether the type is void.
     *
     * @param \PhpParser\Node $node
     *
     * @return bool
     */
    private function isVoid(Node $node): bool
    {

    }
}