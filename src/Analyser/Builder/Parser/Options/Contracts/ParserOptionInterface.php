<?php

namespace Mikevandiepen\Strictly\Analyser\Builder\Parser\Options\Contracts;

use PhpParser\Node;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\AbstractNode;

/**
 * Interface ParserOptionInterface.
 *
 * @package Mikevandiepen\Strictly\Analyser\Builder\Parser\Options\Contracts
 */
interface ParserOptionInterface
{
    /**
     * An option specific parser process.
     *
     * @param \PhpParser\Node $node
     *
     * @return \Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\AbstractNode
     */
    public function parse(Node $node): AbstractNode;
}