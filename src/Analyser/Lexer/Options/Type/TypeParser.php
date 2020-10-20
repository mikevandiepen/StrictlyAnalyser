<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options\Type;

use MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts\LexerOptionInterface;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Options\ParseCompoundTypes;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Options\ParsePseudoTypes;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Options\ParseScalarType;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Options\ParseSpecialTypes;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Definition\TypeUndefinedNode;
use PhpParser\Node;

/**
 * Class TypeParser
 * @see https://www.php.net/manual/en/language.types.intro.php
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Options\Type
 */
final class TypeParser implements LexerOptionInterface
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
        if ($this->isScalar($node)) {
            return (new ParseScalarType())->parse($node);
        }

        if ($this->isCompound($node)) {
            return (new ParseCompoundTypes())->parse($node);
        }

        if ($this->isSpecial($node)) {
            return (new ParseSpecialTypes())->parse($node);
        }

        if ($this->isPseudo($node)) {
            return (new ParsePseudoTypes())->parse($node);
        }

        return new TypeUndefinedNode();
    }

    /**
     * Whether the type is a scalar type.
     * @example ("boolean", "integer", "float/double", "string").
     *
     * @param \PhpParser\Node $node
     *
     * @return bool
     */
    private function isScalar(Node $node): bool
    {

    }

    /**
     * Whether the type is a compound type.
     * @example ("array", "object", "callable", "iterable").
     *
     * @param \PhpParser\Node $node
     *
     * @return bool
     */
    private function isCompound(Node $node): bool
    {

    }

    /**
     * Whether the type is a special type.
     * @example ("resource", "null").
     *
     * @param \PhpParser\Node $node
     *
     * @return bool
     */
    private function isSpecial(Node $node): bool
    {

    }

    /**
     * Whether the type is a scalar type.
     * @example ("mixed", "number", "void").
     *
     * @param \PhpParser\Node $node
     *
     * @return bool
     */
    private function isPseudo(Node $node): bool
    {

    }
}