<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Hinted\Options;

use MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts\HintedTypeLexerInterface;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\AbstractTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Definition\TypeUndefinedNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\SpecialTypes\NullTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\SpecialTypes\ResourceTypeNode;
use phpDocumentor\Reflection\Type;

/**
 * Class HintedPseudoTypeParser
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Groups
 */
final class HintedPseudoTypeParser implements HintedTypeLexerInterface
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
        if ($this->isResource($type)) {
            return new ResourceTypeNode();
        }

        if ($this->isNull($type)) {
            return new NullTypeNode();
        }

        return new TypeUndefinedNode();
    }

    /**
     * Whether the type is a resource.
     *
     * @param \phpDocumentor\Reflection\Type $type
     *
     * @return bool
     */
    private function isResource(Type $type): bool
    {

    }

    /**
     * Whether the type is null.
     *
     * @param \phpDocumentor\Reflection\Type $type
     *
     * @return bool
     */
    private function isNull(Type $type): bool
    {

    }
}