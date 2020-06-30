<?php

namespace Mikevandiepen\Strictly\Analyser\Builder\File\Nodes;

use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Traits\TypeTrait;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Traits\LineTrait;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Contracts\HasType;

/**
 * Class PropertyNode.
 *
 * @package Mikevandiepen\Strictly\Analyser\Builder\File\Nodes
 */
final class PropertyNode extends AbstractNode implements HasType
{
    use TypeTrait, LineTrait;
}