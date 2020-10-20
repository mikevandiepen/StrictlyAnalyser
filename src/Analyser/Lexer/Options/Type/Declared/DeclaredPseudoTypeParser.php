<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Declared\Options;

use MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts\DeclaredTypeLexerInterface;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\AbstractTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Definition\TypeUndefinedNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\SpecialTypes\NullTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\SpecialTypes\ResourceTypeNode;
use PhpParser\Node;

/**
 * Class DeclaredPseudoTypeParser
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Groups
 */
final class DeclaredPseudoTypeParser implements DeclaredTypeLexerInterface
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
     * @param \PhpParser\Node $type
     *
     * @return bool
     */
    private function isResource(Node $type): bool
    {

    }

    /**
     * Whether the type is null.
     *
     * @param \PhpParser\Node $type
     *
     * @return bool
     */
    private function isNull(Node $type): bool
    {

    }
}