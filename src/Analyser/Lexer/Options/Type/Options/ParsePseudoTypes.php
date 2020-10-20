<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Options;

use MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts\LexerOptionInterface;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Definition\TypeUndefinedNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\SpecialTypes\NullTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\SpecialTypes\ResourceTypeNode;
use PhpParser\Node;

/**
 * Class ParsePseudoTypes
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Groups
 */
final class ParsePseudoTypes implements LexerOptionInterface
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
        if ($this->isResource($node)) {
            return new ResourceTypeNode();
        }

        if ($this->isNull($node)) {
            return new NullTypeNode();
        }

        return new TypeUndefinedNode();
    }

    /**
     * Whether the type is a resource.
     *
     * @param \PhpParser\Node $node
     *
     * @return bool
     */
    private function isResource(Node $node): bool
    {

    }

    /**
     * Whether the type is null.
     *
     * @param \PhpParser\Node $node
     *
     * @return bool
     */
    private function isNull(Node $node): bool
    {

    }
}