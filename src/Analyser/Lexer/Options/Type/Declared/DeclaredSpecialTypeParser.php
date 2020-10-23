<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Declared;

use MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts\DeclaredTypeLexerInterface;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\AbstractTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Definition\TypeUndefinedNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\SpecialTypes\NullTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\SpecialTypes\ResourceTypeNode;
use PhpParser\Node\Identifier;

/**
 * Class DeclaredPseudoTypeParser
 *
 * @package  MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Declared
 */
final class DeclaredSpecialTypeParser implements DeclaredTypeLexerInterface
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
     * @param \PhpParser\Node\Identifier $type
     *
     * @return bool
     */
    private function isResource(Identifier $type): bool
    {

    }

    /**
     * Whether the type is null.
     *
     * @param \PhpParser\Node\Identifier $type
     *
     * @return bool
     */
    private function isNull(Identifier $type): bool
    {

    }
}