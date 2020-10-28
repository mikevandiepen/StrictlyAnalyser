<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options\Type;

use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Definition\TypeDefinedNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Definition\TypeUndefinedNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Location\HintedTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\TypeNode;
use phpDocumentor\Reflection\Type;

/**
 * Class HintedTypeParser
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Options\Type
 */
final class HintedTypeParser
{
    /**
     * An option specific parser process.
     *
     * @param \phpDocumentor\Reflection\Type|null $type
     *
     * @return TypeNode
     */
    public function parse(?Type $type): TypeNode
    {
        // Whether the node is typed, else returning undefined stub.
        $typeDefinition = empty($type) ? new TypeUndefinedNode() : new TypeDefinedNode();

        return new TypeNode($typeDefinition, new HintedTypeNode());
    }
}