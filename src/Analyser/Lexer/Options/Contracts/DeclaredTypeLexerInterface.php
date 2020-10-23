<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts;

use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\AbstractTypeNode;
use PhpParser\Node\Identifier;

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
     * @param \PhpParser\Node\Identifier $type
     *
     * @return \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\AbstractTypeNode
     */
    public function parse(Identifier $type): AbstractTypeNode;
}