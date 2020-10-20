<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts;

use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\AbstractTypeNode;
use PhpParser\Node;

/**
 * Interface DeclaredTypeLexerInterface.
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts
 */
interface DeclaredTypeLexerInterface
{
    /**
     * An option specific parser process.
     *
     * @param \PhpParser\Node $type
     *
     * @return \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\AbstractTypeNode
     */
    public function parse(Node $type): AbstractTypeNode;
}