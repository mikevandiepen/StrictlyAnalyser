<?php

namespace Mikevandiepen\Strictly\Analyser\Builder\File\Nodes;

use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Traits\LineTrait;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Traits\ReturnTrait;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Traits\ParameterTrait;

/**
 * Class ClosureNode.
 *
 * @package Mikevandiepen\Strictly\Analyser\Builder\File\Nodes
 */
final class ClosureNode extends AbstractNode
{
    use LineTrait, ParameterTrait, ReturnTrait;
}