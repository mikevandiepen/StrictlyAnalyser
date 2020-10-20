<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Declared;

use MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts\DeclaredTypeLexerInterface;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Declared\Options\DeclaredCompoundTypeParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Declared\Options\DeclaredPseudoTypeParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Declared\Options\DeclaredScalarTypeParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Declared\Options\DeclaredSpecialTypeParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\AbstractTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Definition\TypeUndefinedNode;
use PhpParser\Node;

/**
 * Class DeclaredTypeParser
 * @see https://www.php.net/manual/en/language.types.intro.php
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Declared
 */
final class DeclaredTypeParser implements DeclaredTypeLexerInterface
{
    /**
     * An option specific parser process.
     *
     * @param \PhpParser\Node $type
     *
     * @return \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\AbstractTypeNode
     */
    public function parse(Node $type): AbstractTypeNode
    {
        if ($this->isScalar($type)) {
            return (new DeclaredScalarTypeParser())->parse($type);
        }

        if ($this->isCompound($type)) {
            return (new DeclaredCompoundTypeParser())->parse($type);
        }

        if ($this->isSpecial($type)) {
            return (new DeclaredSpecialTypeParser())->parse($type);
        }

        if ($this->isPseudo($type)) {
            return (new DeclaredPseudoTypeParser())->parse($type);
        }

        return new TypeUndefinedNode();
    }

    /**
     * Whether the type is a scalar type.
     * @example ("boolean", "integer", "float/double", "string").
     *
     * @param \PhpParser\Node $type
     *
     * @return bool
     */
    private function isScalar(Node $type): bool
    {

    }

    /**
     * Whether the type is a compound type.
     * @example ("array", "object", "callable", "iterable").
     *
     * @param \PhpParser\Node $type
     *
     * @return bool
     */
    private function isCompound(Node $type): bool
    {

    }

    /**
     * Whether the type is a special type.
     * @example ("resource", "null").
     *
     * @param \PhpParser\Node $type
     *
     * @return bool
     */
    private function isSpecial(Node $type): bool
    {

    }

    /**
     * Whether the type is a scalar type.
     * @example ("mixed", "number", "void").
     *
     * @param \PhpParser\Node $type
     *
     * @return bool
     */
    private function isPseudo(Node $type): bool
    {

    }
}