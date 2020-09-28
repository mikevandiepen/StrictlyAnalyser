<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts;

use PhpParser\Node;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode;

/**
 * Interface LexerOptionInterface.
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Contracts
 */
interface LexerOptionInterface
{
    /**
     * An option specific parser process.
     *
     * @param \PhpParser\Node $node
     *
     * @return \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode
     */
    public function parse(Node $node): AbstractNode;
}