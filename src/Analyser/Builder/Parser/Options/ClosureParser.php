<?php

namespace Mikevandiepen\Strictly\Analyser\Builder\Parser\Options;

use PhpParser\Node;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\AbstractNode;
use Mikevandiepen\Strictly\Analyser\Builder\Parser\Options\Traits\ParseDocblockTrait;
use Mikevandiepen\Strictly\Analyser\Builder\Parser\Options\Contracts\ParserOptionInterface;

/**
 * Class ClosureParser.
 *
 * @package Mikevandiepen\Strictly\Parser\Options
 */
final class ClosureParser implements ParserOptionInterface
{
    use ParseDocblockTrait;

    /**
     * An option specific parser process.
     *
     * @param \PhpParser\Node $node
     *
     * @return \Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\AbstractNode
     */
    public function parse(Node $node): AbstractNode
    {
        // TODO: Implement analyse() method.
    }
}