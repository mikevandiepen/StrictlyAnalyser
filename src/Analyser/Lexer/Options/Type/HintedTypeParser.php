<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Hinted;

use MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts\HintedTypeLexerInterface;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Hinted\Options\HintedCompoundTypeParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Hinted\Options\HintedPseudoTypeParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Hinted\Options\HintedScalarTypeParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Hinted\Options\HintedSpecialTypeParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\AbstractTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Definition\TypeUndefinedNode;
use phpDocumentor\Reflection\Type;

/**
 * Class HintedTypeParser
 * @see https://www.php.net/manual/en/language.types.intro.php
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Hinted
 */
final class HintedTypeParser implements HintedTypeLexerInterface
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
        if ($this->isScalar($type)) {
            return (new HintedScalarTypeParser())->parse($type);
        }

        if ($this->isCompound($type)) {
            return (new HintedCompoundTypeParser())->parse($type);
        }

        if ($this->isSpecial($type)) {
            return (new HintedSpecialTypeParser())->parse($type);
        }

        if ($this->isPseudo($type)) {
            return (new HintedPseudoTypeParser())->parse($type);
        }

        return new TypeUndefinedNode();
    }

    /**
     * Whether the type is a scalar type.
     * @example ("boolean", "integer", "float/double", "string").
     *
     * @param \phpDocumentor\Reflection\Type $type
     *
     * @return bool
     */
    private function isScalar(Type $type): bool
    {

    }

    /**
     * Whether the type is a compound type.
     * @example ("array", "object", "callable", "iterable").
     *
     * @param \phpDocumentor\Reflection\Type $type
     *
     * @return bool
     */
    private function isCompound(Type $type): bool
    {

    }

    /**
     * Whether the type is a special type.
     * @example ("resource", "null").
     *
     * @param \phpDocumentor\Reflection\Type $type
     *
     * @return bool
     */
    private function isSpecial(Type $type): bool
    {

    }

    /**
     * Whether the type is a scalar type.
     * @example ("mixed", "number", "void").
     *
     * @param \phpDocumentor\Reflection\Type $type
     *
     * @return bool
     */
    private function isPseudo(Type $type): bool
    {

    }
}